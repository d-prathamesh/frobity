@extends('frontend.partner.layout')
@section('content')
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Notification Setting</p>
          </div> 
        </div> 
        <li class="job" style="">	
      <form method="post" action="{{ route('web.partner.setting.save-notification') }}">
            <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <div class="row bottom-sec">
                 <div class="col-lg-12">
                  
                  <div class="col-lg-12">
                   
                   <h5><a href="#"> SMS </a> 
                      <span class="pull-right">
                            <label class="switch">
                                    <input onchange="updateSetting(this)" name="sms_alert" value="1" type="checkbox" {{ $profile['sms_alert'] ? 'checked' : ''}}>
                                    <span class="slider round"></span>
                            </label>
                      </span>
                  </h5>
                  <br/>
                  <h5><a href="#"> Email </a> 
                    <span class="pull-right">
                            <label class="switch">
                                    <input onchange="updateSetting(this)" name="email_alert" value="1" type="checkbox" {{ $profile['email_alert'] ? 'checked' : ''}}>
                                    <span class="slider round"></span>
                            </label>
                    </span>
                </h5>
                  
                 </div>
                </div>
               
              
              <form>
        </li>

    </ul>
   


@stop

@section('scripts')
<script>
function updateSetting(element){
    $(element).parents('form').submit();
}
</script>
@stop
