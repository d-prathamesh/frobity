@extends('frontend.partner.layout')
@section('content')
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Bank Account Detail</p>
          </div> 
        </div> 
        <li class="job-box" style="">	
            @if($editable)
                <form method="post" id="hb_bank_settings" action="{{ route('web.partner.setting.save-bank') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    @endif
            <div class="form-group">
               <!-- <p>Account Holder Name</p>-->
               
                <input type="text" name="name" class="form-control" placeholder="Account Holder Name" value="{{ $bankDetail['name'] }}" @if(!$editable) disabled @endif>
                <p id="error_name" class="error-text hidden"> {{ $errors->first('name')}}  </p>
                            </div>
                        <div class="form-group">
            <!--<p>Account No</p>-->
            <input type="text" name="acc_num" class="form-control" placeholder="Account Number" value="{{ $bankDetail['acc_num'] }}" @if(!$editable) disabled @endif>
                <p  id="error_acc_num" class="error-text hidden"> {{ $errors->first('acc_num')}}  </p>
                        </div>
            <div class="form-group">
                <!--<p>Bank Name</p>-->
                <input type="text" name="bank_name" class="form-control" placeholder="Bank Name e.g : ICICI Bank" value="{{ $bankDetail['bank_name'] }}" @if(!$editable) disabled @endif>
                <p id="error_bank_name" class="error-text hidden"> {{ $errors->first('bank_name')}}  </p>
                            </div>
            <div class="form-group">
                <!--<p>IFSC Code</p>-->
                <input type="text" name="ifsc" class="form-control" placeholder="IFSC Code" value="{{ $bankDetail['ifsc'] }}" @if(!$editable) disabled @endif>
                <p  id="error_ifsc" class="error-text hidden"> {{ $errors->first('ifsc')}}  </p>
                            </div>
            @if($editable)
                    <button class="kafe-btn kafe-btn-mint-small">Save</button>
                </form>
            @endif
        </li>

    </ul>
   


@stop

@section('scripts')
<script>
    $(document).ready( function(){
        $("#hb_bank_settings").submit(function(){
            ser_data = $("#hb_bank_settings").serialize();
            console.log( "Bank data  "+ser_data );
            frm_action = $("#hb_bank_settings").attr('action');
            console.log( "action "+frm_action );
            $(".error-text").addClass('hidden');
            $(".error-text").html('');
            $.ajax({
                url: frm_action,
                type:"POST",
                data: ser_data,
                success:function(response){
    //                console.log(response);
                    window.location.reload();

                },
                error:function( jqXHR, textStatus, errorThrown ){
                    console.log('jqxhr');
                    console.log( jqXHR.responseJSON );
                        resp_json = jqXHR.responseJSON;
                    console.log('textStatus');
                    console.log( textStatus );
                    
                    console.log('errorThrown');
                    console.log( errorThrown );
                        first_err = '';
                        for( k in resp_json ){
                            if( first_err == '' ){
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
                            }, 2000);
                            $( "#error_"+first_err ).focus();
                        }

                }
            });
                return false;
    //            in submit
        });

    });
</script>
@stop
