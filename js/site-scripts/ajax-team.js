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
                        $('#secondaryButton').hide();
                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        document.getElementById('showTeam').innerHTML = html;
                        $('#showTeam').show();
                        $('#secondaryButton').show();
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
                        $('#showTeam').hide();
                        $('#secondaryButton').hide();

                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        document.getElementById('showTeam').innerHTML = html;

                        $('#showTeam').show();
                        $('#secondaryButton').show();

                        if (!desktop.matches) {$('#key').css("display","flex");}
                        if (desktop.matches) {$('.player-type').css("display", "block");}

                        $('#submitTeamButton').hide();
                        $('#submittedBy').hide();
                        $('#cancelPost').hide();
                        $('#logInButton').hide();
                        $('#registerButton').hide();

                        $('#login').hide();
                        $('#register').hide();
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
            $('#submitTeamButton').show();
            $('#submittedBy').show();
            $('#cancelPost').show();

        } else {
            $('#logInButton').show();
            $('#registerButton').show();
        }

        $('#secondaryButton').hide();
        $('#showHideSubmitButton').hide();

    });

    //Show login form
    $(document).on( 'click', '#logInButton', function( event ){
        event.preventDefault();

        $('#logInButton').hide();
        $('#registerButton').hide();

        $('#loginFromTeamView').show();

    });

    //When the user clicks the button to log in
    //Get the data from the form to pass to the form handler
    //Check to see if there's an error object? -- not sure if this is where to do that
    //If not, return a confirmation message, hide the form and button, and show the "Post" button
    //If data does not validate:
    //Show error messages; reload form

    //Show register form
    $(document).on( 'click', '#registerButton', function( event ){
        event.preventDefault();

        $('#logInButton').hide();
        $('#registerButton').hide();

        $('#registerFromTeamView').show();
    });

    //When the user clicks the button to register
    //If data validates:
    //Use wp create user to insert a new user into the db
    //Otherwise:
    //Show error messages (using plugin for banned words)

    $(document).on( 'click', '#cancelPost', function( event ){

        event.preventDefault();

        $('#secondaryButton').show();
        $('#showHideSubmitButton').show();

        $('#submittedBy').hide();
        $('#submitTeamButton').hide();
    });

    $(document).on( 'click', '.submit-team', function( event ) {

        event.preventDefault();

        //TODO: get the user ID from the form 
        //Get values from submitted form
        var submittedby = $('#submittedBy').val();

        //First line
        var lw1name = $('#lw1name').val();
        var lw1number = $('#lw1number').val();
        var lw1team = $('#lw1team').val();
        var lw1abbr = $('#lw1abbr').val();

        var c1name = $('#c1name').val();
        var c1number = $('#c1number').val();
        var c1team = $('#c1team').val();
        var c1abbr = $('#c1abbr').val();

        var rw1name = $('#rw1name').val();
        var rw1number = $('#rw1number').val();
        var rw1team = $('#rw1team').val();
        var rw1abbr = $('#rw1abbr').val();

        //Second line
        var lw2name = $('#lw2name').val();
        var lw2number = $('#lw2number').val();
        var lw2team = $('#lw2team').val();
        var lw2abbr = $('#lw2abbr').val();

        var c2name = $('#c2name').val();
        var c2number = $('#c2number').val();
        var c2team = $('#c2team').val();
        var c2abbr = $('#c2abbr').val();

        var rw2name = $('#rw2name').val();
        var rw2number = $('#rw2number').val();
        var rw2team = $('#rw2team').val();
        var rw2abbr = $('#rw2abbr').val();

        //Third line
        var lw3name = $('#lw3name').val();
        var lw3number = $('#lw3number').val();
        var lw3team = $('#lw3team').val();
        var lw3abbr = $('#lw3abbr').val();

        var c3name = $('#c3name').val();
        var c3number = $('#c3number').val();
        var c3team = $('#c3team').val();
        var c3abbr = $('#c3abbr').val();

        var rw3name = $('#rw3name').val();
        var rw3number = $('#rw3number').val();
        var rw3team = $('#rw3team').val();
        var rw3abbr = $('#rw3abbr').val();

        //Fourth line
        var lw4name = $('#lw4name').val();
        var lw4number = $('#lw4number').val();
        var lw4team = $('#lw4team').val();
        var lw4abbr = $('#lw4abbr').val();

        var c4name = $('#c4name').val();
        var c4number = $('#c4number').val();
        var c4team = $('#c4team').val();
        var c4abbr = $('#c4abbr').val();

        var rw4name = $('#rw4name').val();
        var rw4number = $('#rw4number').val();
        var rw4team = $('#rw4team').val();
        var rw4abbr = $('#rw4abbr').val();

        //First pair
        var d1name = $('#d1name').val();
        var d1number = $('#d1number').val();
        var d1team = $('#d1team').val();
        var d1abbr = $('#d1abbr').val();

        var d2name = $('#d2name').val();
        var d2number = $('#d2number').val();
        var d2team = $('#d2team').val();
        var d2abbr = $('#d2abbr').val();

        //Second pair
        var d3name = $('#d3name').val();
        var d3number = $('#d3number').val();
        var d3team = $('#d3team').val();
        var d3abbr = $('#d3abbr').val();

        var d4name = $('#d4name').val();
        var d4number = $('#d4number').val();
        var d4team = $('#d4team').val();
        var d4abbr = $('#d4abbr').val();

        //Third pair
        var d5name = $('#d5name').val();
        var d5number = $('#d5number').val();
        var d5team = $('#d5team').val();
        var d5abbr = $('#d5abbr').val();

        var d6name = $('#d6name').val();
        var d6number = $('#d6number').val();
        var d6team = $('#d6team').val();
        var d6abbr = $('#d6abbr').val();

        //Tandem
        var g1name = $('#g1name').val();
        var g1number = $('#g1number').val();
        var g1team = $('#g1team').val();
        var g1abbr = $('#g1abbr').val();

        var g2name = $('#g2name').val();
        var g2number = $('#g2number').val();
        var g2team = $('#g2team').val();
        var g2abbr = $('#g2abbr').val();



        $.ajax( {
            url: nhl_ajax_object.ajax_url,
            method: 'post',
            data: {
                action: 'get_team_desktop',
                submittedby: submittedby,

                lw1name: lw1name,
                lw1number: lw1number,
                lw1team: lw1team,
                lw1abbr: lw1abbr,
                c1name: c1name,
                c1number: c1number,
                c1team: c1team,
                c1abbr: c1abbr,
                rw1name: rw1name,
                rw1number: rw1number,
                rw1team: rw1team,
                rw1abbr: rw1abbr,

                lw2name: lw2name,
                lw2number: lw2number,
                lw2team: lw2team,
                lw2abbr: lw2abbr,
                c2name: c2name,
                c2number: c2number,
                c2team: c2team,
                c2abbr: c2abbr,
                rw2name: rw2name,
                rw2number: rw2number,
                rw2team: rw2team,
                rw2abbr: rw2abbr,

                lw3name: lw3name,
                lw3number: lw3number,
                lw3team: lw3team,
                lw3abbr: lw3abbr,
                c3name: c3name,
                c3number: c3number,
                c3team: c3team,
                c3abbr: c3abbr,
                rw3name: rw3name,
                rw3number: rw3number,
                rw3team: rw3team,
                rw3abbr: rw3abbr,

                lw4name: lw4name,
                lw4number: lw4number,
                lw4team: lw4team,
                lw4abbr: lw4abbr,
                c4name: c4name,
                c4number: c4number,
                c4team: c4team,
                c4abbr: c4abbr,
                rw4name: rw4name,
                rw4number: rw4number,
                rw4team: rw4team,
                rw4abbr: rw4abbr,

                d1name: d1name,
                d1number: d1number,
                d1team: d1team,
                d1abbr: d1abbr,
                d2name: d2name,
                d2number: d2number,
                d2team: d2team,
                d2abbr: d2abbr,

                d3name: d3name,
                d3number: d3number,
                d3team: d3team,
                d3abbr: d3abbr,
                d4name: d4name,
                d4number: d4number,
                d4team: d4team,
                d4abbr: d4abbr,

                d5name: d5name,
                d5number: d5number,
                d5team: d5team,
                d5abbr: d5abbr,
                d6name: d6name,
                d6number: d6number,
                d6team: d6team,
                d6abbr: d6abbr,

                g1name: g1name,
                g1number: g1number,
                g1team: g1team,
                g1abbr: g1abbr,
                g2name: g2name,
                g2number: g2number,
                g2team: g2team,
                g2abbr: g2abbr
            },
            dataType: "text",
            success: function(strMessage) {
                window.location='blog';
            },
            error: function() {
                $('#main').append('<h2>Oops! Something went wrong ...</h2>');
            }
        
        });
    
    });


})(jQuery);