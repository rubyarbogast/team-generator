//TODO: change Hawks names to just "Chicago" -- where? 
//TODO: catch errors: what if missing a file?
//TODO: use config file instead of "example," this feels cumbersome 

//Require instance of the Player class
const Player = require('./player-class.js');
//Require Lodash library in order to use array methods
const _ = require("lodash")
//Require MySQL to write to DB
var mysql = require('mysql');

//Require teams files and store in an array
var allTeams = [];
for (let i = 0; i < 31; i++) {
    var currentRoster = require('./rosters/' + i + '.json');
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

console.log(lWings.length, centers.length, rWings.length, defensemen.length, goalies.length);

//Remove problematic players from arrays
//Potential issue with this approach is players may change position. Print results to console to check
var probLWing = _.remove(lWings, function(p) {return p.name == "Evander Kane";});
var probLWing2 = _.remove(lWings, function(p) {return p.name == "Austin Watson";});
var probCenter = _.remove(centers, function(p) {return p.name == "Nick Cousins";});
var probRWing = _.remove(rWings, function(p) {return p.name == "Patrick Kane";});
var probDMan = _.remove(defensemen, function(p) {return p.name == "Drew Doughty";});
var probGoalie1 = _.remove(goalies, function(p) {return p.name == "Semyon Varlamov";});
var probGoalie2 = _.remove(goalies, function(p) {return p.name == "Casey DeSmith";});

console.log(probLWing, probLWing2, probCenter, probRWing, probDMan, probGoalie1, probGoalie2);

//Create new connection pool to DB
var pool  = mysql.createPool({
  connectionLimit : 10,
  host: "localhost",
  user: "wp_roster_admin",
  password: "835AcZXoM3Vm0HQ4",
  database: "hockey-players"
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

