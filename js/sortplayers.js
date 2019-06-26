    //Initialize arrays to hold player objects -- not sure this will work
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

//Use require to load JSON object from file
var team = require('./rosters/0.json');
//Save the team roster to a variable 
var teamRoster = team['teams'][0]['roster']['roster'];

//console.log(typeof teamRoster);
//console.log(teamRoster.length);

for (let i = 0; i < teamRoster.length; i++){

    if (teamRoster[i]['position']['name'] == 'Defenseman') {
        console.log(teamRoster[i]);
    }
} 