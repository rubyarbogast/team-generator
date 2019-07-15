function makeTeam() {

    var x = document.getElementById("buttonDiv");
    if (x.style.display === "none") {
        x.style.display = "block";

    } else {
        x.style.display = "none";
    }

    var windowSize = window.matchMedia("(max-width: 767px)")
    teamDisplaySize(windowSize) // Call listener function at run time
    windowSize.addListener(teamDisplaySize) // Attach listener function on state changes 

    //NB: drawback to this approach is that it won't change if window is resized 
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
                // This outputs the result of the ajax request
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
                // This outputs the result of the ajax request
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