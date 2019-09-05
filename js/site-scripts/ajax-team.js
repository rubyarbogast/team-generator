(function($) {

    $(document).on( 'click', '.get-team-button', function( event ) {

        //Stop the page from loading the default view
        event.preventDefault();

        //Depending on size of window, call either get_team or get_team_desktop functions in functions.php
        var windowSize = window.matchMedia("(max-width: 767px)")
        teamDisplaySize(windowSize) //Call listener function at runtime

        var desktop = window.matchMedia("(min-width: 1366px")

        function teamDisplaySize() {
            if (windowSize.matches) {
                $.ajax({
                    url: nhl_ajax_object.ajax_url,
                    type: 'get',
                    data: {
                        action: 'get_team'
                    },
                    beforeSend: function() {
                        $('#main').find( 'article' ).remove();
                        $('#main #buttonDiv').remove();
                        $('#showTeam').hide();
                        $('#newTeam').hide();
                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        document.getElementById('showTeam').innerHTML = html;
                        $('#showTeam').show();
                        $('#newTeam').show();
                    }
                });
            } else {
                $.ajax({
                    url: nhl_ajax_object.ajax_url,
                    type: 'get',
                    data: {
                        action: 'get_team_desktop'
                    },
                    beforeSend: function() {
                        $('#main').find( 'article' ).remove();
                        $('#main #buttonDiv').remove();
                        $('#showTeam, #newTeam').hide();

                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        document.getElementById('showTeam').innerHTML = html;

                        $('#showTeam, #newTeam, #showHideSubmitButton').show();

                        if (!desktop.matches) {$('#key').css("display","flex");}
                        if (desktop.matches) {$('.player-type').css("display", "block");}

                        $('#submitTeamButton, #cancelPostButton').hide();

                        $('#loginFromTeamView, #registerFromTeamView').hide();
                    }
                });
            }

        } 
    });

    $(document).on( 'click', '#showHideSubmitButton', function( event ) {

        event.preventDefault();

        var loggedIn = $('#loggedIn').val();

        if (loggedIn == 'true'){
            //Show user name field, submit and cancel buttons
            $('#submitTeamButton, #cancelPostButton').show();

        } else {
            $('#loginFromTeamView').show();
        }

        $('#newTeam, #showHideSubmitButton').hide();

    });

})(jQuery);