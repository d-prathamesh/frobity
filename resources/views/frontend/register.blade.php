@extends('frontend.layouts.home')
@section('content')
 <header class="header-login">
      <div class="container">
	   <div class="content">
	  <!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
	  <style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
     </header><!-- /header -->
<!-- ==============================================
    Banner Login Section
    =============================================== -->
    <section class="banner-login">
     <div class="container">
      <div class="row">
      
       <main class="main main-signup col-lg-12">
        <div class="col-lg-6 col-lg-offset-3 text-center">
         <div class="form-sign">
          <form  id="registration-form" action="{{ route('web.post.register',['type'=>$type])}}" method="post">
                {{ csrf_field() }}
           <div class="form-head">
                <div class="row">
                        <h1 class="revealOnScroll" data-animation="fadeInDown"><i class="fa fa-coffee"></i> Create Account</h1>
                       <!-- <p>Log in and get to work.</p>-->
                       </div>
           </div><!-- /.form-head -->
           <div class="form-body">
           
            <div class="form-row">
             <div class="form-controls">
              <input name="name" value="{{ old('name')}}" placeholder="Full Name" class="field @if($errors->has('name')) has-error @endif" type="text">
             </div><!-- /.form-controls -->
             @if($errors->has('name'))
             <p class="error-text"> {{ $errors->first('name')}}  </p>
             @endif 
            </div><!-- /.form-row -->
            <div class="form-row">
                <div class="form-controls">
                 <input name="email" value="{{ old('email')}}" placeholder="Email" class="field @if($errors->has('email')) has-error @endif" type="email">
                </div><!-- /.form-controls -->
                @if($errors->has('email'))
                <p class="error-text"> {{ $errors->first('email')}}  </p>
                @endif 
            </div><!-- /.form-row -->

            <div class="form-row">
                <div class="form-controls">
                 <input name="mobile" value="{{ old('mobile')}}" placeholder="Mobile" class="field @if($errors->has('mobile')) has-error @endif" type="number">
                </div><!-- /.form-controls -->
                @if($errors->has('mobile'))
                <p class="error-text"> {{ $errors->first('mobile')}}  </p>
                @endif 
            </div><!-- /.form-row -->

            <div class="form-row">
                <div class="form-controls">
                 <input name="password" placeholder="Password" class="field @if($errors->has('password')) has-error @endif" type="password">
                </div><!-- /.form-controls -->
                @if($errors->has('password'))
                <p class="error-text"> {{ $errors->first('password')}}  </p>
                @endif 
            </div><!-- /.form-row -->
            @if($type == 'partner')
            <div class="form-row">
                <div class="form-controls">
                    <select name="service_type" class="field">
                        <option value="">Please choose an service type</option>
                        <optgroup label="Area of specialization">
                        @foreach($categories as $category)
                            <option  value="{{$category['id']}}" @if(old('service_type') == $category['id']) selected @endif>{{$category['name']}}</option>
                        @endforeach
                        </optgroup>
                    </select>
                 </div><!-- /.form-controls -->
                @if($errors->has('service_type'))
                <p class="error-text"> {{ $errors->first('service_type')}}  </p>
                @endif 
            </div><!-- /.form-row -->
            @endif
            @if($errors->has('errorMessage'))
                <p class="error-text"> {{ $errors->first('errorMessage')}}  </p>
            @endif
           </div><!-- /.form-body -->
           

           <div class="form-foot">
            <div class="form-actions">					
             <button class="form-btn" type="submit">Create Account</button>
            </div><!-- /.form-actions -->
            <div class="mt-2">
                <a  class="more-link" href="{{ route('web.otp',['type'=>$type])}}">Login</a> | 
                <a href="#" class="more-link">Forgot Password?</a>
                <!-- <a class="more-link" href="{{ route('web.get.google.register',['type'=>$type])}}">Google Login</a> -->
            </div>
            <div class="form-head">
             <!--<a href="#" class="more-link">Forgot Password?</a>-->
            </div>
           </div><!-- /.form-foot -->
          </form>
          
         </div><!-- /.form-sign -->
        </div><!-- /.col-lg-6 -->
       </main>
       
      </div><!-- /.row -->
     </div><!-- /.container -->
    </section><!-- /section -->
    <!--<div class="switch-field">
            <input type="radio" id="radio-one" name="switch-one" value="yes" checked/>
            <label for="radio-one">Yes</label>
            <input type="radio" id="radio-two" name="switch-one" value="no" />
            <label for="radio-two">No</label>
        </div>-->
@stop

@section('scripts')
<script>
 $(document).ready(function(){
     $('#registration-form').validate({
        errorClass:"has-error",
        rules: {
            mobile : {
                required: true,
                minlength: 10,
                maxlength: 10
            },
            name:{
                required:true
            },
            email:{
                required:true,
                email:true,
            },
            password:{
                required:true,
                minlength:6
            },<?php if($type == 'partner'){ ?>
            service_type:{
                required:true
            }
        <?php  } ?>
        },
        messages:{
            mobile:{
                required:"The mobile field is required.",
                minlength:"Please enter 10 digit mobile no",
                maxlength:"Please enter 10 digit mobile no"
            },
            name:{
                required:"The name field is required"
            },
            email:{
                required:"The email field is required",
                email:"Please enter an valid email address"
            },
            password:{
                required:"The password field is required",
                minlength:"Please enter min 6 character password"
            },<?php if($type == 'partner'){?>
            service_type:{
                required:"The service type field is required",
        }<?php } ?>
        }
     });
 });
</script>
@stop