//Script to run if user clicks "post" button
function loggedInOptions(event) {
    event.preventDefault();

    var loggedIn = document.getElementById("loggedIn").value;
    var submitTeamButton = document.getElementById("submitTeamButton");
    var cancelButton = document.getElementById("cancelPostButton");

    var logIn = document.getElementById("loginFromTeamView");

    var showHideSubmitButton = document.getElementById("showHideSubmitButton");
    var newTeamButton = document.getElementById("newTeam");

    if (loggedIn == 'true'){
        //Show user name field, submit and cancel buttons
        cancelButton.style.display = "inline-block";
        submitTeamButton.style.display = "inline-block";
    } else {
        logIn.style.display = "block";
    }

    showHideSubmitButton.style.display = "none";
    newTeamButton.style.display = "none";
}

//If logged-in user hits "cancel," hide "post" and "cancel" buttons; show "post team to blog" and "new team" buttons
function cancelPostLoggedIn(event) {
    event.preventDefault();

    var cancelButton = document.getElementById("cancelPostButton");
    var postButton = document.getElementById("submitTeamButton");

    var showHideSubmitButton = document.getElementById("showHideSubmitButton");
    var newTeamButton = document.getElementById("newTeam");

    cancelButton.style.display = "none";
    postButton.style.display = "none";

    showHideSubmitButton.style.display = "inline-block";
    newTeamButton.style.display = "inline-block";
}

//If a user who isn't logged in clicks "cancel" after clicking "post team to blog"
function cancelLogin() {
    //event.preventDefault();

    var loginDiv = document.getElementById("loginFromTeamView");
    var showHideSubmitButton = document.getElementById("showHideSubmitButton");
    var newTeamButton = document.getElementById("newTeam");
    
    loginDiv.style.display = "none";

    showHideSubmitButton.style.display = "inline-block";
    newTeamButton.style.display = "inline-block";
}

//Change the text after the button is clicked so user knows the form is being submitted
function changeText() {
    button = document.getElementById("registerUser");
    button.value = "Please wait ...";
}