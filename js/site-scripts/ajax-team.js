//TODO: media queries
//TODO: remove button after click (second $(document) function w second button ID)
//TODO: get loader code; customize

(function($) {

    $(document).on( 'click', '.main-button', function( event ) {

        event.preventDefault();

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
                $.ajax({
                    url: nhl_ajax_object.ajax_url,
                    type: 'post',
                    data: {
                        action: 'get_team'
                    },
                    beforeSend: function() {
                        $('#main').find( 'article' ).remove();
                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        $('#showTeam').append( html );
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
                        $('#main').append( '<div class="flex-container"><div class="lds-roller" id="loader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>' );
                    },
                    success: function( html ) {
                        $('#main #loader').remove();
                        $('#showTeam').append( html );
                    }
                });
            }

        } 
    })

})(jQuery);