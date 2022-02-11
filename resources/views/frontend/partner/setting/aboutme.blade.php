@extends('frontend.partner.layout')
@section('content')
<?php $readOnly = 1; ?>
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>About me</p>
          </div> 
        </div> 
        <li class="job-box" style="">	
          @if($readOnly)
            <form id="hb_about_me" autocomplete="off" method="post" action="{{ route('web.partner.setting.save-aboutme') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
        @endif
            @if($profile['service_type'] == 1 )
            <div class="form-group">
                <label>Membership / COP Number</label>
                
                <input type="text" name="member_id" class="form-control" placeholder="Member Id" value="{{ $profile['member_id'] }}" @if(!$readOnly) disabled @endif>
                <p id="error_member_id" class="hidden error-text">  </p>
            </div>
            @endif
            <div class="form-group">
                <label>Professional experience</label>
               
                <input type="text" name="professional_experience" class="form-control" placeholder="Years of experience" value="{{ $profile['professional_experience'] }}"  @if(!$readOnly) disabled @endif>
                <p id="error_professional_experience" class="hidden error-text">  </p>
            </div>
            <div class="form-group">
                <label>Hourly Rate</label>
               
                <input type="text" name="hourly_rate" class="form-control" placeholder="Hourly Rate" value="{{ $profile['hourly_rate'] }}"  @if(!$readOnly) disabled @endif>
                <p id="error_hourly_rate" class="hidden error-text">   </p>
            </div>
            <div class="form-group">
                <label>Service Offered</label>
               
                <input type="text" name="service_offered" class="form-control" placeholder="Service offered" value="{{ $profile['service_offered'] }}"  @if(!$readOnly) disabled @endif>
                <p id="error_service_offered" class="hidden error-text"> </p>
            </div>
            <div class="form-group">
                <label class="radio">Male
                    <input value="male" type="radio"  name="gender" {{ strtolower($profile['gender']) == 'male' ? 'checked' : '' }}  @if(!$readOnly) disabled @endif>
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">Female
                    <input value="female" type="radio" name="gender" {{ strtolower($profile['gender']) == 'female' ? 'checked' : '' }}  @if(!$readOnly) disabled @endif>
                    <span class="checkround"></span>
                    </label>
                    <p id="error_gender" class="hidden error-text"> {{ $errors->first('gender')}}  </p>
            </div>
            <div class="form-group">
                <p>City</p>
                <input type="text" value="{{ $profile['city'] }}" autocomplete="false" name="city" id="city" class="form-control" id="city"  @if(!$readOnly) disabled @endif/>
                <p id="error_city" class="error-text"> </p>
            <input type="hidden" name="longitude" id="longitude" value="">
            <input type="hidden" name="latitude" id="latitude" value=""> 
            <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places&callback=initialize" async defer></script>
            <script>
                var autocomplete;
                function initialize() {
                    autocomplete = new google.maps.places.Autocomplete(
                    /** @type {HTMLInputElement} */(document.getElementById('city')),
                    { types: ['geocode'] });
                    autocomplete.setComponentRestrictions(
                    {'country': ['IN']});
                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
                        var place = autocomplete.getPlace();
                        document.getElementById('city').value = place.formatted_address;
                        document.getElementById('latitude').value = place.geometry.location.lat();
                        document.getElementById('longitude').value = place.geometry.location.lng();
                    });
                }
        
                function geolocate() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                        var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                        };
                        var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                        });
                        autocomplete.setBounds(circle.getBounds());
                        });
                    }
                }
        
                window.onload = initialize;
            </script>
            </div>
            <div class="form-group">
                <label>Introduction / Bio / Overview</label>
               
               <textarea rows="5" name="bio" class="form-control" placeholder="Write"  @if(!$readOnly) disabled @endif>{{ $profile['bio'] }}</textarea>
                <p id="error_bio" class="hidden error-text"> {{ $errors->first('bio')}}  </p>
            </div>
                            
                      
            @if($readOnly)         
                <button class="kafe-btn kafe-btn-mint-small">Update</button>
                </form>
                @endif

        </li>

    </ul>
   


@stop

@section('scripts')
        <!--script src="{{ asset('assets/js/formsubmition.js') }}"></script-->
<script>
    $(document).ready( function(){
        $("#hb_about_me").submit(function(){
            ser_data = $("#hb_about_me").serialize();
            console.log( "Bank data  "+ser_data );
            frm_action = $("#hb_about_me").attr('action');
            console.log( "action "+frm_action );
            $(".error-text").addClass('hidden');
            $(".error-text").html('');
            $.ajax({
                url: frm_action,
                type:"POST",
                data: ser_data,
                success:function(response){
                    console.log(response);
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
                    var first_err = '';
                        for( k in resp_json ){
                            if(  k != 'longitude' && k != 'latitude' ){
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
    //            alert("in submit");
                return false;
    //            in submit
        });

    });
</script>

@stop
