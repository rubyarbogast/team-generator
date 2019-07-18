//TODO: media queries
//TODO: remove button after click (second $(document) function w second button ID)
//TODO: get loader code; customize

(function($) {

    $(document).on( 'click', '.main-button', function( event ) {
        event.preventDefault();
        $.ajax({
            url: nhl_ajax_object.ajax_url,
            type: 'post',
            data: {
                action: 'get_team'
            },
            beforeSend: function() {
                $('#main').find( 'article' ).remove();
                $('#main').append( '<div class="page-content" id="loader">Loading ...</div>' );
            },
            success: function( html ) {
                $('#main #loader').remove();
                $('#showTeam').append( html );
            }
        })
    })

})(jQuery);