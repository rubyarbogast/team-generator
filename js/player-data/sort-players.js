//Require instance of the Player class
const Player = require('./player-class.js');
//Require Lodash library in order to use array methods
const _ = require("lodash")
//Require MySQL to write to DB
var mysql = require('mysql');
//Require config file to log in to DB
var config = require('../config.json');

//Delete player by name
function deletePlayer(name) {
    var theRoster = currentRoster['teams'][0]['roster']['roster'];
    var probPlayer = _.remove(theRoster, function(e) {
        return e.person.fullName == name;
    });
    console.log(probPlayer);
}

//Remove players accused of DV or SA from rosters
function removePlayer(roster) {
    for (let i = 0; i < (currentRoster['teams'][0]['roster']['roster']).length; i++) {

        var currentPlayer = currentRoster['teams'][0]['roster']['roster'][i]['person']['fullName'];

        if (currentPlayer == "Patrick Kane") {
            deletePlayer("Patrick Kane");
        }
        if (currentPlayer == "Evander Kane") {
            deletePlayer("Evander Kane");
        }
        if (currentPlayer == "Austin Watson") {
            deletePlayer("Austin Watson");
        }
        if (currentPlayer == "Nick Cousins") {
            deletePlayer("Nick Cousins");
        }
        if (currentPlayer == "Drew Doughty") {
            deletePlayer("Drew Doughty");
        }
        if (currentPlayer == "Semyon Varlamov") {
            deletePlayer("Semyon Varlamov");
        }
        if (currentPlayer == "Casey DeSmith") {
            deletePlayer("Casey DeSmith");
        }
    }
}

//Change team names as necessary
function changeName(playerArray) {
    for (let i = 0; i < playerArray.length; i++) {
        if (playerArray[i].getCurrentTeam() == "Chicago Blackhawks") {
            playerArray[i].setCurrentTeam("Chicago");
        }
        if (playerArray[i].getCurrentTeam() == "Montréal Canadiens") {
            playerArray[i].setCurrentTeam("Montreal Canadiens");
        }
    }
}

//Require team JSON and store in an array
var allTeams = [];
for (let i = 0; i < 31; i++) {
    var currentRoster = require('./rosters/' + i + '.json');
    //Remove problematic players from roster
    removePlayer(currentRoster);
    allTeams.push(currentRoster);
}

//Store all rosters to an array
var allRosters = [];
for (let i = 0; i < allTeams.length; i++) {
    allRosters.push(allTeams[i]['teams'][0]['roster']['roster']);
}

//Instantiate arrays to hold player objects
/* var centers = [];
var lWings = [];
var rWings = [];
var defensemen = [];
var goalies = []; */
var allPlayers = [];

var ids = [];

//Loop through rosters to sort players into arrays according to position 
for (let i = 0; i < allRosters.length; i++){
    for (let j = 0; j < allRosters[i].length; j++){
        
        let nhlId = allRosters[i][j]['person']['id'];
        let playerName = allRosters[i][j]['person']['fullName'];
        let playerNumber = allRosters[i][j]['jerseyNumber'];
        let playerPosition = allRosters[i][j]['position']['name'];
        let playerCurrentTeam = allTeams[i]['teams'][0]['name'];
        let playerTeamAbbr = allTeams[i]['teams'][0]['abbreviation'];
        let playerActiveStatus = true;

        let currentPlayer = new Player(nhlId, playerName, playerNumber, playerPosition, playerCurrentTeam, playerTeamAbbr, playerActiveStatus);
        allPlayers.push(currentPlayer);

        ids.push(nhlId);

/*         if (allRosters[i][j]['position']['name'] == 'Left Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam, playerTeamAbbr);
            lWings.push(currentPlayer); 
        } else if (allRosters[i][j]['position']['name'] == 'Center') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam, playerTeamAbbr);
            centers.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Right Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam, playerTeamAbbr);
            rWings.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Defenseman') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam, playerTeamAbbr);
            defensemen.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Goalie') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam, playerTeamAbbr);
            goalies.push(currentPlayer);
        }   */
    } 
}

/* changeName(lWings);
changeName(rWings);
changeName(centers);
changeName(defensemen);
changeName(goalies); */

changeName(allPlayers);

//Create new connection pool to DB
var pool  = mysql.createPool({
  connectionLimit : 10,
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database
});

//Function to add or update player values
var tableName = "";
function addOrUpdate(data) {

    //Escape MySQL so that names with apostrophes can be written to the DB
    let insertQuery = 'INSERT INTO ?? (??,??,??,??,??,??,??) VALUES (?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE ?? = ?, ?? = ?, ?? = ?, ?? = ?, ?? = ?, ?? = ?';
    let query = mysql.format(insertQuery,[tableName,"nhlId","name","number","position","currentTeam","teamAbbr","active",data.nhlId,data.playerName,data.playerNumber,data.playerPosition,data.playerCurrentTeam,data.playerTeamAbbr,data.playerActiveStatus,"name",data.playerName,"number",data.playerNumber,"position",data.playerPosition,"currentTeam",data.playerCurrentTeam,"teamAbbr",data.playerTeamAbbr,"active",data.playerActiveStatus]);

    pool.query(query,(err, response) => {
        if(err) {
            console.error(err);
            return;
        }
    });
}

function writeArrayToDB(playersArray, positionTable) {
    playersArray.forEach(function(Player) {
        
        //Set a timeout to avoid sending query before connection is made
            setTimeout(() => {
                tableName = positionTable;
                addOrUpdate({
                    "nhlId": Player.nhlId,
                    "playerName": Player.name,
                    "playerNumber": Player.number,
                    "playerPosition": Player.position,
                    "playerCurrentTeam": Player.currentTeam,
                    "playerTeamAbbr": Player.teamAbbr,
                    "playerActiveStatus": Player.active
                });
            },5000);
        });
}

writeArrayToDB(allPlayers, "rmaAllPlayers");

//Write the IDs of the players currently on rosters to a table for comparison
function temporary(data) {
    let insertQuery = 'INSERT INTO ?? (??) VALUES (?)';
    let query = mysql.format(insertQuery,["tempids","nhlId",data.nhlId]);

    pool.query(query,(err, response) => {
        if(err) {
            console.error(err);
            return;
        }
    });
}

function writeToTempTable(playersArray) {
    playersArray.forEach(function(Player) {
        
        //Set a timeout to avoid sending query before connection is made
            setTimeout(() => {
                temporary({
                    "nhlId": Player.nhlId
                });
            },5000);
        });
}

writeToTempTable(allPlayers);

//Compare the IDs in the temporary table to those in the table of all players
function temporaryTable(){
    //If the ID is not in the temporary table, set the status to "inactive"
    let compareQuery = "UPDATE rmaallplayers SET active = 0 WHERE NOT EXISTS (SELECT nhlId FROM tempids WHERE rmaallplayers.nhlId = tempids.nhlId)"

    pool.query(compareQuery,(err, response) => {
        if(err) {
            console.error(err);
            return;
        }
    });
}

temporaryTable();
console.log("Finished");

/* writeArrayToDB(lWings, "lwing");
writeArrayToDB(centers, "center");
writeArrayToDB(rWings, "rwing");
writeArrayToDB(defensemen, "defenseman");
writeArrayToDB(goalies, "goalie"); */