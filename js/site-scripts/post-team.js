(function($) {

    $(document).on( 'click', '#submitTeamButton', function( event ) {
    
          event.preventDefault();
          $.ajax( {
              url: team_ajax_object.ajax_url,
              method: "post",
              data: {
                action: 'rma_team_post',
            },
              dataType: "text",
              success: function(strMessage) {
                  $("#main").text('Give er a shot');
              }
          });
      });
    
    })(jQuery);
