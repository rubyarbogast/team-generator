//TODO: write player class to use in loop
//TODO: remove P Kane, E Kane, A Watson, N Cousins, D Doughty, S Varlamov, C DeSmith
//TODO: change Hawks names to just "Chicago"
//TODO: separate into model, view, controller, data and rewrite code to reflect file locations
//TODO: change JS objects to JSON? 
//TODO: figure out what to do with arrays -- DB? write to file?

class Player {
    constructor(name, number, position, currentTeam) {
        this.name = name;
        this.number = number;
        this.position = position;
        this.currentTeam = currentTeam;
    }

    getName() {
        return this.name;
    }

    getNumber() {
        return this.number;
    }

    getPosition() {
        return this.position;
    }

    getCurrentTeam() {
        return this.currentTeam;
    }

    setName(value) {
        this._name = value;
    }

    setNumber(value) {
        this._number = value;
    }

    setPosition(value) {
        this._position = value;
    }

    setCurrentTeam(value) {
        this._team = value;
    }

}


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

console.log(allRosters.length);

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

//TODO: update loop
for (let i = 0; i < teamRoster.length; i++){

    let playerName = teamRoster[i]['person']['fullName'];
    let playerNumber = teamRoster[i]['jerseyNumber'];
    let playerPosition = teamRoster[i]['position']['name'];
    let playerCurrentTeam = team['teams'][0]['name'];

    if (teamRoster[i]['position']['name'] == 'Left Wing') {
        let player = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
        lwings.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Center') {
        let player = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
        centers.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Right Wing') {
        let player = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
        rwings.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Defenseman') {
        let player = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
        defensemen.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Goalie') {
        let player = new Player(playerName, playerNumber, playerPosition, playerCurrentTeam);
        goalies.push(player);
    }

}
console.log(defensemen);
console.log(centers);
console.log(rwings);
console.log(lwings);
console.log(goalies); 