function makeTeam() {
    //Toggle show/hide main button to create team
    var mainButton = document.getElementById("buttonDiv");
    mainButton.style.display = "none";

    //Toggle show/hide secondary buttons
    var secondaryButtons = document.getElementById("optionButtons");
    secondaryButtons.style.display = "flex";

    //Depending on size of window, call either get_team or get_team_desktop functions in functions.php
    var windowSize = window.matchMedia("(max-width: 767px)")
    teamDisplaySize(windowSize) //Call listener function at runtime
 
    function teamDisplaySize() {
    if (windowSize.matches) {
        jQuery.ajax({
            url:  nhl_ajax_object.ajax_url,
            type: "POST",
            data: {
                action: "get_team",
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
                action: "get_team_desktop",
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