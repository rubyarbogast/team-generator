

(function($) {

    $(document).on( 'click', '.get-team-button', function( event ) {

        event.preventDefault();

        //Depending on size of window, call either get_team or get_team_desktop functions in functions.php
        var windowSize = window.matchMedia("(max-width: 767px)")
        teamDisplaySize(windowSize) //Call listener function at runtime

        function teamDisplaySize() {
            if (windowSize.matches) {
                $.ajax({
                    url: nhl_ajax_object.ajax_url,
                    type: 'post',
                    data: {
                        action: 'get_team'
                    },
                    beforeSend: function() {
                        $('#main').find( 'article' ).remove();
                        $('#main #buttonDiv').remove();
                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        $('#main #showTeam').replaceWith( html );
                        $('#main #content #optionButtons').append( '<button class="secondary-button">New Team</button>' );
                    }
                });
            } else {
                $.ajax({
                    url: nhl_ajax_object.ajax_url,
                    type: 'post',
                    data: {
                        action: 'get_team_desktop'
                    },
                    beforeSend: function() {
                        $('#main').find( 'article' ).remove();
                        $('#main #buttonDiv').remove();
                        $('#secondaryButton').hide();
                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        document.getElementById('showTeam').innerHTML = html;
                        $('#secondaryButton').show();
                    }
                });
            }

        } 
    });


})(jQuery);