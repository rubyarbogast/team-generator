function makeTeam() {

    var x = document.getElementById("buttonDiv");
    if (x.style.display === "none") {
        x.style.display = "block";

    } else {
        x.style.display = "none";
    }

    jQuery.ajax({
        url:  my_ajax_object.ajax_url,
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
}

//TODO: prevent spam requests

//TODO: save team as image