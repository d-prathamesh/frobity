    $(document).ready( function(  ){
        $("#addform").submit( function(){
            ser_data = $("#addform").serialize();
            console.log( "Job data  "+ser_data );
            frm_action = $("#addform").attr('action');
            console.log( "action "+frm_action );
            $(".error-text").addClass('hidden');
            $(".error-text").html('');
            $("#addform button").attr('disabled','disabled');
            $.ajax({
                url: frm_action,
                type:"POST",
                data: ser_data,
                success:function(response){
                    console.log(response);
                    $("#addform").append( '<div Class="alert alert-success" id="addformMessage" > Job posted successfully</div>' );
                    setTimeout( function() {
                        $("#addformMessage").hide('slow');
                        window.location.href='/client/jobs/posted';

                    }, 2000 );

                },
                error:function( jqXHR, textStatus, errorThrown ){
                    $("#addform button").removeAttr('disabled');
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
                }
            });
            return false;
        })
    });