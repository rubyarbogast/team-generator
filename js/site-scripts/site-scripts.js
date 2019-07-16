function makeTeam() {

    var x = document.getElementById("buttonDiv");
    if (x.style.display === "none") {
        x.style.display = "block";

    } else {
        x.style.display = "none";
    }

    //Depending on size of window, call either get_team or get_team_desktop functions in functions.php
    var windowSize = window.matchMedia("(max-width: 767px)")
    teamDisplaySize(windowSize) //Call listener function at runtime

    //TODO: output error messages to client 
    function teamDisplaySize() {
    if (windowSize.matches) {
        jQuery.ajax({
            url:  nhl_ajax_object.ajax_url,
            type: "POST",
            data: {
                action: 'get_team',
            },
            dataType: "html",
            success: function(data) {
                //Output the result of the AJAX request
                document.getElementById("showTeam").innerHTML = data;
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    } else {
        jQuery.ajax({
            url:  nhl_ajax_object.ajax_url,
            type: "POST",
            data: {
                action: 'get_team_desktop',
            },
            dataType: "html",
            success: function(data) {
                //Output the result of the AJAX request
                document.getElementById("showTeam").innerHTML = data;
            },
            error: function(errorThrown){
                console.log(errorThrown);
            }
        });
    }
    }

}

//TODO: prevent spam requests

//TODO: save team as image