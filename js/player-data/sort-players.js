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
var centers = [];
var lWings = [];
var rWings = [];
var defensemen = [];
var goalies = [];

//Loop through rosters to sort players into arrays according to position 
for (let i = 0; i < allRosters.length; i++){
    for (let j = 0; j < allRosters[i].length; j++){
        
        let playerName = allRosters[i][j]['person']['fullName'];
        let playerNumber = allRosters[i][j]['jerseyNumber'];
        let playerPosition = allRosters[i][j]['position']['name'];
        let playerCurrentTeam = allTeams[i]['teams'][0]['name'];

        if (allRosters[i][j]['position']['name'] == 'Left Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            lWings.push(currentPlayer); 
        } else if (allRosters[i][j]['position']['name'] == 'Center') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            centers.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Right Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            rWings.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Defenseman') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            defensemen.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Goalie') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            goalies.push(currentPlayer);
        }  
    } 
}

changeName(lWings);
changeName(rWings);
changeName(centers);
changeName(defensemen);
changeName(goalies);

//Create new connection pool to DB
var pool  = mysql.createPool({
  connectionLimit : 10,
  host: config.host,
  user: config.user,
  password: config.password,
  database: config.database
});

//Write players to the database, sorting them into tables according to position
var tableName = "";

function addRow(data) {
    //Escape MySQL so that names with apostrophes can be written to the DB
    let insertQuery = 'INSERT INTO ?? (??,??,??,??) VALUES (?,?,?,?)';
    let query = mysql.format(insertQuery,[tableName,"name","number","position","currentTeam",data.playerName,data.playerNumber,data.playerPosition,data.playerCurrentTeam]);

    pool.query(query,(err, response) => {
        if(err) {
            console.error(err);
            return;
        }
    });
}

lWings.forEach(function(Player) {
//Set a timeout to avoid sending query before connection is made
    setTimeout(() => {
        tableName = "lwing";
        addRow({
            "playerName": Player.name,
            "playerNumber": Player.number,
            "playerPosition": Player.position,
            "playerCurrentTeam": Player.currentTeam
        });
    },5000);
});

centers.forEach(function(Player) {
    setTimeout(() => {
        tableName = "center";
        addRow({
            "playerName": Player.name,
            "playerNumber": Player.number,
            "playerPosition": Player.position,
            "playerCurrentTeam": Player.currentTeam
        });
    },5000);
});

rWings.forEach(function(Player) {
    setTimeout(() => {
        tableName = "rwing";
        addRow({
            "playerName": Player.name,
            "playerNumber": Player.number,
            "playerPosition": Player.position,
            "playerCurrentTeam": Player.currentTeam
        });
    },5000);
});

defensemen.forEach(function(Player) {
    setTimeout(() => {
        tableName = "defenseman";
        addRow({
            "playerName": Player.name,
            "playerNumber": Player.number,
            "playerPosition": Player.position,
            "playerCurrentTeam": Player.currentTeam
        });
    },5000);
}); 

goalies.forEach(function(Player) {
    setTimeout(() => {
        tableName = "goalie";
        addRow({
            "playerName": Player.name,
            "playerNumber": Player.number,
            "playerPosition": Player.position,
            "playerCurrentTeam": Player.currentTeam
        });
    },5000);
}); 

