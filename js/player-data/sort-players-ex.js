//TODO: remove P Kane, E Kane, A Watson, N Cousins, D Doughty, S Varlamov, C DeSmith -- where? 
//TODO: change Hawks names to just "Chicago" -- where? 
//TODO: catch errors: what if missing a file?
//TODO: how to do this? possible ways -- write directly to DB. but then harder to change names, make deletions, etc. or store to array, make changes, then write players in separate loop -- but due to async might have to do it in a different file (or figure out promises??). this would require writing the arrays somewhere and importing them in the second file -- seems dumb. other way would require either a separate file or functions to call in the for loop -- for loop would prob add too much time to the operation to be worth it. OR change name and delete from rosters before writing (seems more efficient) -- how? 
//TODO: may be able to skip storing files and use the API to write players directly to DB -- syntax will be more complicated but look into it

//Require instance of the Player class
const Player = require('./player-class.js/index.js');
//Require mysql module
var mysql = require('mysql');

//Require teams files and store in an array
var allTeams = [];
for (let i = 0; i < 31; i++) {
    var currentRoster = require('./rosters/' + i + '.json');
    allTeams.push(currentRoster);
}

//console.log(allTeams);

//Store all rosters to an array
var allRosters = [];
for (let i = 0; i < allTeams.length; i++) {
    allRosters.push(allTeams[i]['teams'][0]['roster']['roster']);
}

//Instantiate arrays to hold players
//TODO: remove these
var centers = [];
var lwings = [];
var rwings = [];
var defensemen = [];
var goalies = [];

//Connect to database
var con = mysql.createConnection({
    host: "localhost",
    user: "yourusername",
    password: "yourpassword",
    database: "mydb"
  });

//TODO: require mysql; use to create JSON objects and write to DB (if poss)
//Loop through rosters to sort players into arrays according to position 
for (let i = 0; i < allRosters.length; i++){
    for (let j = 0; j < allRosters[i].length; j++){

        let playerName = allRosters[i][j]['person']['fullName'];
        let playerNumber = allRosters[i][j]['jerseyNumber'];
        let playerPosition = allRosters[i][j]['position']['name'];
        let playerCurrentTeam = allTeams[i]['teams'][0]['name'];

        if (allRosters[i][j]['position']['name'] == 'Left Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            //TODO: Save to DB via MySQL
            lwings.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Center') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            //TODO: Save to DB via MySQL
            centers.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Right Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            //TODO: Save to DB via MySQL
            rwings.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Defenseman') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            //TODO: Save to DB via MySQL
            defensemen.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Goalie') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            //TODO: Save to DB via MySQL
            goalies.push(currentPlayer);
        }
    }

}

//Will there be problems with async again?
/* console.log("Defenseman " . defensemen[120]); -- do this in MySQL instead? 
console.log("Center " . centers[10]);
console.log("Right wing " . rwings[20]);
console.log("Left wing " . lwings[30]); */
//console.log(goalies); 