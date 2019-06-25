<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

    <title>Teams</title>

    <link rel="stylesheet" href="style.css">
  </head>

  <script>
  
  var teamIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 28, 29, 30, 52, 53, 54]
  var rosters = [];

    //Loop through the array of team IDs
    for (let i = 0; i < teamIds.length; i++){
        //Store URL from which requesting JSON in a variable 
        var requestURL = 'https://statsapi.web.nhl.com/api/v1/teams/' + teamIds[i] + '/roster';

        //Create new object instance from XMLHttpRequest constructor
        let request = new XMLHttpRequest();
        request.open('GET', requestURL);
        //Set responseType to JSON so XHR knows we're getting JSON, and should convert to JS object
        request.responseType = 'json';
        request.send();

        request.onreadystatechange = function() {
            if(request.readyState === XMLHttpRequest.DONE && request.status === 200) {
                //Store response to request in variable roster
                var roster = request.response;
                //Add roster object to the array of rosters
                rosters.push(roster);
            }
        }
    }

    console.log(rosters);

    //Use code above to write file 
    //Declare object player
    //Initialize arrays to hold player objects
    //For each roster
    //(instead of == use "in," in case player plays more than one position?)
      //If position == center, update values and add to centers
      //If position == LW, update values and add to LWs
      //If position == RW, update values and add to RWs
      //If position == D, save to D (handedness?)
      //If position == G, save to G
    //Store arrays in DB? Write to file?
  </script>


  </html>