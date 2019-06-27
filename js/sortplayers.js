//TODO: remove P Kane, E Kane, A Watson, N Cousins, D Doughty, S Varlamov, C DeSmith
//TODO: change Hawks names to just "Chicago"
//TODO: change JS objects to JSON? 
//TODO: figure out what to do with arrays -- DB? write to file?

//Require instance of the Player class
const Player = require('./playerclass.js');

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

//Use require to load JSON object from file
var team = require('./rosters/0.json');
//Save the team roster to a variable 
var teamRoster = team['teams'][0]['roster']['roster'];

//console.log(team);
//Instantiate arrays to hold players
var centers = [];
var lwings = [];
var rwings = [];
var defensemen = [];
var goalies = [];

//TODO: test results to make sure values are correct

//Loop through rosters to sort players into arrays according to position 
for (let i = 0; i < allRosters.length; i++){
    for (let j = 0; j < allRosters[i].length; j++){

        let playerName = allRosters[i][j]['person']['fullName'];
        let playerNumber = allRosters[i][j]['jerseyNumber'];
        let playerPosition = allRosters[i][j]['position']['name'];
        let playerCurrentTeam = allTeams[i]['teams'][0]['name'];

        if (allRosters[i][j]['position']['name'] == 'Left Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            lwings.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Center') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            centers.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Right Wing') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            rwings.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Defenseman') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            defensemen.push(currentPlayer);
        } else if (allRosters[i][j]['position']['name'] == 'Goalie') {
            let currentPlayer = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
            goalies.push(currentPlayer);
        }
    }

}
console.log(defensemen.length);
console.log(centers.length);
console.log(rwings.length);
console.log(lwings.length);
console.log(goalies.length); 