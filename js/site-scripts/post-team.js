(function($) {

    $(document).on( 'click', '.submit-team', function( event ) {

              event.preventDefault();

          $.ajax( {
              url: team_ajax_object.ajax_url,
              method: 'post',
              data: {
                action: 'rma_team_post',
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
