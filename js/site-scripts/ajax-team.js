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

/*     $(document).on( 'click', '#cancelPostButton', function( event ){

        event.preventDefault();

        $('#newTeam, #showHideSubmitButton').show();

        $('#submitTeamButton, #cancelPostButton').hide();
    }); */

    $(document).on( 'click', '#cancelPostNotLoggedIn', function( event ){

        event.preventDefault();

        $('#newTeam, #showHideSubmitButton').show();

        $('#logIn', '#register', '#cancelPostNotLoggedIn').hide();
    });

    /* $(document).on( 'click', '.submit-team', function( event ) {

        event.preventDefault();

        $.ajax( {
            url: nhl_ajax_object.ajax_url,
            method: 'post',
            data: {
                action: 'get_team_desktop',

                username: $('#username').val(),
                password: $('#password').val(),

                lw1name: $('#lw1name').val(),
                lw1number: $('#lw1number').val(),
                lw1team: $('#lw1team').val(),
                lw1abbr: $('#lw1abbr').val(),
                c1name: $('#c1name').val(),
                c1number: $('#c1number').val(),
                c1team: $('#c1team').val(),
                c1abbr: $('#c1abbr').val(),
                rw1name: $('#rw1name').val(),
                rw1number: $('#rw1number').val(),
                rw1team: $('#rw1team').val(),
                rw1abbr: $('#rw1abbr').val(),

                lw2name: $('#lw2name').val(),
                lw2number: $('#lw2number').val(),
                lw2team: $('#lw2team').val(),
                lw2abbr: $('#lw2abbr').val(),
                c2name: $('#c2name').val(),
                c2number: $('#c2number').val(),
                c2team: $('#c2team').val(),
                c2abbr: $('#c2abbr').val(),
                rw2name: $('#rw2name').val(),
                rw2number: $('#rw2number').val(),
                rw2team: $('#rw2team').val(),
                rw2abbr: $('#rw2abbr').val(),

                lw3name: $('#lw3name').val(),
                lw3number: $('#lw3number').val(),
                lw3team: $('#lw3team').val(),
                lw3abbr: $('#lw3abbr').val(),
                c3name: $('#c3name').val(),
                c3number: $('#c3number').val(),
                c3team: $('#c3team').val(),
                c3abbr: $('#c3abbr').val(),
                rw3name: $('#rw3name').val(),
                rw3number: $('#rw3number').val(),
                rw3team: $('#rw3team').val(),
                rw3abbr: $('#rw3abbr').val(),

                lw4name: $('#lw4name').val(),
                lw4number: $('#lw4number').val(),
                lw4team: $('#lw4team').val(),
                lw4abbr: $('#lw4abbr').val(),
                c4name: $('#c4name').val(),
                c4number: $('#c4number').val(),
                c4team: $('#c4team').val(),
                c4abbr: $('#c4abbr').val(),
                rw4name: $('#rw4name').val(),
                rw4number: $('#rw4number').val(),
                rw4team: $('#rw4team').val(),
                rw4abbr: $('#rw4abbr').val(),

                d1name: $('#d1name').val(),
                d1number: $('#d1number').val(),
                d1team: $('#d1team').val(),
                d1abbr: $('#d1abbr').val(),
                d2name: $('#d2name').val(),
                d2number: $('#d2number').val(),
                d2team: $('#d2team').val(),
                d2abbr: $('#d2abbr').val(),

                d3name: $('#d3name').val(),
                d3number: $('#d3number').val(),
                d3team: $('#d3team').val(),
                d3abbr: $('#d3abbr').val(),
                d4name: $('#d4name').val(),
                d4number: $('#d4number').val(),
                d4team: $('#d4team').val(),
                d4abbr: $('#d4abbr').val(),

                d5name: $('#d5name').val(),
                d5number: $('#d5number').val(),
                d5team: $('#d5team').val(),
                d5abbr: $('#d5abbr').val(),
                d6name: $('#d6name').val(),
                d6number: $('#d6number').val(),
                d6team: $('#d6team').val(),
                d6abbr: $('#d6abbr').val(),

                g1name: $('#g1name').val(),
                g1number: $('#g1number').val(),
                g1team: $('#g1team').val(),
                g1abbr: $('#g1abbr').val(),
                g2name: $('#g2name').val(),
                g2number: $('#g2number').val(),
                g2team: $('#g2team').val(),
                g2abbr: $('#g2abbr').val()
            },
            dataType: "text",
            success: function() {
                window.location='blog';
            },
            error: function() {
                $('#main').append('<h2>Oops! Something went wrong ...</h2>');
            }
        
        });
        
    }); */


})(jQuery);