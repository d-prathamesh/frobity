@extends('frontend.layouts.home')
@section('content')
 <header class="header-login">
      <div class="container">
	   <div class="content">
	  <!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
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
          <form id="otp-form" action="{{ route('web.send-otp',['type'=>$type])}}" method="post">
                {{ csrf_field() }}
           <div class="form-head">
                <div class="row">
                        <h1 class="revealOnScroll" data-animation="fadeInDown"><i class="fa fa-coffee"></i> Login</h1>
                        <p>Log in and get to work.</p>
                        
                       </div>
           </div><!-- /.form-head -->
           <div class="form-body">
           
            <div class="form-row">
             <div class="form-controls">
              <input name="mobile" placeholder="Mobile" class="field @if($errors->has('mobile')) has-error @endif" type="number">
             </div><!-- /.form-controls -->
            
            </div><!-- /.form-row -->
            

            @if($errors->has('mobile'))
                <p class="error-text"> {{ $errors->first('mobile')}}  </p>
            @endif
           </div><!-- /.form-body -->
           

           <div class="form-foot">
            <div class="form-actions">					
             <button class="form-btn" type="submit">GET OTP</button>
            </div><!-- /.form-actions -->
            <div class="mt-2">
                <a  class="more-link" href="{{ route('web.getLoginWithEmail',['type'=>$type])}}">Login With Email</a>
                <!-- <a class="more-link" href="{{ route('web.get.google.register',['type'=>$type])}}">Google Login</a> -->
            </div>
            <div class="mt-2">
                <a  class="more-link" href="{{ route('web.get.register',['type'=>$type])}}">Create Account</a> | 
                <a href="{{ route('web.email.otp',['type'=>$type])}}" class="more-link">Forgot Password?</a>
                <!-- <a class="more-link" href="{{ route('web.get.google.register',['type'=>$type])}}">Google Login</a> -->
            </div>
            <div class="form-head">
             <!-- <a href="#" class="more-link">Forgot Password?</a> -->
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
     $('#otp-form').validate({
        errorClass:"has-error",
        rules: {
            mobile : {
                required: true,
                minlength: 10,
                maxlength: 10
            },
        },
        messages:{
            mobile:{
                required:"The mobile field is required.",
                minlength:"Please enter 10 digit mobile no",
                maxlength:"Please enter 10 digit mobile no"
            }
        }
     });
 });
</script>
@stop