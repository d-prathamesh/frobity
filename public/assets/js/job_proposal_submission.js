$(document).ready(function(){ 
    $("#jobProposalForm").submit( function(){
      console.log( $(this)['0'] );
      fd_proposal = new FormData( $(this)['0'] );

//      console.log( fd_proposal );
      frm_action = $("#jobProposalForm").attr('action');
    $("error-text").html('');
    $("#jobProposalForm button").attr('disabled');
      $.ajax({
        url: frm_action,  
        type: 'POST',
        data: fd_proposal,
        success:function(data){
//            $("#jobProposalForm button").removeAttr('disabled');
            $('#output').html(data);
            window.location.reload();

        },
        error:function( jqXHR, textStatus, errorThrown ){
            $("#jobProposalForm button").removeAttr('disabled');
              console.log('jqxhr');
              console.log( jqXHR.responseJSON );
                  resp_json = jqXHR.responseJSON;
              console.log('textStatus');
              console.log( textStatus );
              
              console.log('errorThrown');
              console.log( errorThrown );
              var first_err = '';
                  for( k in resp_json ){
                      if(  k != 'longitude' && k != 'latitude' && first_err=='' ){
                          first_err = k;                               
                      }
                      console.log(" key " + k );
                      console.log(" value " + resp_json[k]);
                      $("#error_"+k).html(resp_json[k]);
                      $("#error_"+k).removeClass('hidden');

                  }
                  if( first_err != '' ){
                      console.log( "#error_"+first_err );
                      $([document.documentElement, document.body]).animate({
                          scrollTop: $("#error_"+first_err).offset().top-50
                      }, 100);
                      $( "#error_"+first_err ).focus();
                  }
          },
          cache: false,
          contentType: false,
          processData: false
        });
      return false;
    });
  });