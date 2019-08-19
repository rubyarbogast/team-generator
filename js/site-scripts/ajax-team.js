(function($) {

    $(document).on( 'click', '.get-team-button', function( event ) {

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
                        if (!desktop.matches) {$('#key').css("display","flex");}
                        if (desktop.matches) {$('.player-type').css("display", "block");}
                        $('#secondaryButton').show();
                    }
                });
            }

        } 
    });

    $(document).on( 'click', '.submit-team', function( event ) {

        event.preventDefault();
        //define variables
        var lw1name = $('#lw1name').val();
        var lw1number = $('#lw1number').val();
        var lw1team = $('#lw1team').val();

        $.ajax( {
            url: nhl_ajax_object.ajax_url,
            method: 'post',
            data: {
                action: 'get_team_desktop',
                lw1name: lw1name,
                lw1number: lw1number,
                lw1team: lw1team
            },
            dataType: "text",
            success: function(strMessage) {
                $("#main").text('Better');
            },
            error: function() {
                console.log('Error');
            }
        });
    });


})(jQuery);