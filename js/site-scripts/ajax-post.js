(function($) {

    $(document).on( 'click', '.submit-team', function( event ) {
        $(document).find(':input[type=submit]').prop('disabled', true);
        event.preventDefault();

        $.ajax( {
            url: post_ajax_object.ajax_url,
            method: 'post',
            data: {
                action: 'rma_post_team',

                username: $('#username').val(),
                password: $('#password').val(),

                lw1Id: $('#lw1Id').val(),
                c1Id: $('#c1Id').val(),
                rw1Id: $('#rw1Id').val(),

                lw2Id: $('#lw2Id').val(),
                c2Id: $('#c2Id').val(),
                rw2Id: $('#rw2Id').val(),

                lw3Id: $('#lw3Id').val(),
                c3Id: $('#c3Id').val(),
                rw3Id: $('#rw3Id').val(),

                lw4Id: $('#lw4Id').val(),
                c4Id: $('#c4Id').val(),
                rw4Id: $('#rw4Id').val(),

                d1Id: $('#d1Id').val(),
                d2Id: $('#d2Id').val(),

                d3Id: $('#d3Id').val(),
                d4Id: $('#d4Id').val(),

                d5Id: $('#d5Id').val(),
                d6Id: $('#d6Id').val(),

                g1Id: $('#g1Id').val(),
                g2Id: $('#g2Id').val(),
            },
            dataType: "text",
            success: function() {
                window.location='blog';
            },
            error: function() {
                $('#main').append('<h2>Oops! Something went wrong ...</h2>');
            }
        
        });
    });

})(jQuery);