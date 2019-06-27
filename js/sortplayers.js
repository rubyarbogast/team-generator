
    //For each roster (start with just 1 to test) 
      //If position == center:
        //new object: {name = name; currentTeam = team; position = C; number = number}
        //add new object to array
        //print array to console 
      //If position == LW, update values and add to LWs
      //If position == RW, update values and add to RWs
      //If position == D, save to D (handedness?)
      //If position == G, save to G
    //Store arrays in DB? Write to file?

//Will need to change this to loops
//Require teams files
var allTeams = [];
for (let i = 0; i < 31; i++) {
    var currentRoster = require('./rosters/' + i + '.json');
    allTeams.push(currentRoster);
}

console.log(allTeams);

//Use require to load JSON object from file
var team = require('./rosters/0.json');
//Save the team roster to a variable 
var teamRoster = team['teams'][0]['roster']['roster'];

//Instantiate array to hold Defensemen
var centers = [];
var lwings = [];
var rwings = [];
var defensemen = [];
var goalies = [];

for (let i = 0; i < teamRoster.length; i++){

    if (teamRoster[i]['position']['name'] == 'Defenseman') {
        player = {
            "name" : teamRoster[i]['person']['fullName'],
            "number" : teamRoster[i]['jerseyNumber'],
            "position" : teamRoster[i]['position']['name'],
            "currentTeam" : team['teams'][0]['name']
        };
        defensemen.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Center') {
        player = {
            "name" : teamRoster[i]['person']['fullName'],
            "number" : teamRoster[i]['jerseyNumber'],
            "position" : teamRoster[i]['position']['name'],
            "currentTeam" : team['teams'][0]['name']
        };
        centers.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Left Wing') {
        player = {
            "name" : teamRoster[i]['person']['fullName'],
            "number" : teamRoster[i]['jerseyNumber'],
            "position" : teamRoster[i]['position']['name'],
            "currentTeam" : team['teams'][0]['name']
        };
        lwings.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Right Wing') {
        player = {
            "name" : teamRoster[i]['person']['fullName'],
            "number" : teamRoster[i]['jerseyNumber'],
            "position" : teamRoster[i]['position']['name'],
            "currentTeam" : team['teams'][0]['name']
        };
        rwings.push(player);
    } else if (teamRoster[i]['position']['name'] == 'Goalie') {
        player = {
            "name" : teamRoster[i]['person']['fullName'],
            "number" : teamRoster[i]['jerseyNumber'],
            "position" : teamRoster[i]['position']['name'],
            "currentTeam" : team['teams'][0]['name']
        };
        goalies.push(player);
    }

}
/* console.log(defensemen);
console.log(centers);
console.log(rwings);
console.log(lwings);
console.log(goalies); */