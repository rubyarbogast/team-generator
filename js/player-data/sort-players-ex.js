//TODO: change Hawks names to just "Chicago" -- where? 
//TODO: catch errors: what if missing a file?

//Require instance of the Player class
const Player = require('./player-class.js');
//Require Lodash library in order to use array methods
const _ = require("lodash")

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

//Instantiate arrays to hold players
var centers = [];
var lwings = [];
var rwings = [];
var defensemen = [];
var goalies = [];

//TODO: try wrapping in function that will return Promise, then use promise.then to write files -- ok this wouldn't actually solve anything. still would have to loop through and use connection pooling. 
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

//Use Lodash to remove problematic players from arrays
var probLWings = _.remove(lwings, function(p) {
    return p.name == "Evander Kane";
});

var probCenters = _.remove(centers, function(p) {
    return p.name == "Nick Cousins";
});

var probRWings1 = _.remove(rwings, function(p) {
    return p.name == "Patrick Kane";
});

var probLWings2 = _.remove(lwings, function(p) {
    return p.name == "Austin Watson";
});

var probDMen = _.remove(defensemen, function(p) {
    return p.name == "Drew Doughty";
});

var probGoalies1 = _.remove(goalies, function(p) {
    return p.name == "Semyon Varlamov";
});

var probGoalies2 = _.remove(goalies, function(p) {
    return p.name == "Casey DeSmith";
});