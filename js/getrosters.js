//Instantiate new instance from the request library
const request = require('request')
//Instantiate new instance from the Node.js File System module
const fs = require('fs');

//Team IDs (non-sequential) hard coded for now
var teamIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 28, 29, 30, 52, 53, 54]

//For each team, get the roster and write it to a file
for (let i = 0; i < teamIds.length; i++){

    var requestURL = 'https://statsapi.web.nhl.com/api/v1/teams/' + teamIds[i] + '?expand=team.roster';

        request
        .get(requestURL)
        .on('error', function(err) {
            console.error(err)
        })
        .pipe(fs.createWriteStream('./rosters/' + i + '.json'))
}

    
    
