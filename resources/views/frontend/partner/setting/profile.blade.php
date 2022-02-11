@extends('frontend.partner.layout')
@section('content')
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Profile Detail</p>
          </div> 
        </div> 
        <li class="job-box" style="">	
                        <div  class="col-md-3 text-center profile-image-border">
                                        <img src="{{ session('partner')['image'] }}" onError="this.onerror=null;this.src='/assets/img/default-user.svg';" class="img-resonsive" width="150px" height="150px" alt="...">
                        <form id="submission-form" method="post" action="{{route('web.partner.setting.save-profile-picture')}}" enctype="multipart/form-data">
                
                                <input type="hidden" name="_token" value="{{ csrf_token()}}">        <div class="identity-block-wrapper change-profile">
                                  <div class="identity-block">
                                          <input type="file" name="profileimage"  onchange="validateImage(this)"  accept=".jpg, .jpeg, .png"/>
                                  </div>
                              </div>
                        </form>
                        @if($errors->has('profileimage'))
                <p class="error-text"> {{ $errors->first('profileimage')}}  </p>
        @endif 
                        </div>
                        <div class="clear clearfix"></div>
                        <br/>
                <form method="post" action="{{ route('web.partner.setting.save-profile') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token()}}">
            <div class="form-group">
               <!-- <p>Your Name</p>-->
						<input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ $profile['name'] }}">
						@if($errors->has('name'))
						<p class="error-text"> {{ $errors->first('name')}}  </p>
						@endif 
            </div>
							
			<div class="form-group">
							<input name="pass" type="password"  class="form-control"  placeholder="Password" >
			</div>
			
            <div class="form-group">
						<input type="text"  class="form-control" placeholder="Your Name" value="{{ $profile['email'] }}" disabled / >
            </div>
			
			<div class="form-group">
                <input type="text"  class="form-control" placeholder="Your Name" value="{{ $profile['mobile'] }}" disabled />
                </div>
            <div class="form-group">
							<input type="text"  name="address" class="form-control" placeholder="Your Address" value="{{ $profile['address'] }}" />
						</div>          
                            
                <button class="kafe-btn kafe-btn-mint-small">Update</button>
                </form>

        </li>

    </ul>
   


@stop

@section('scripts')
<script>
                function validateImage(element){
                    $(element).parents('form').submit();
                }
            </script>
@stop
