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

