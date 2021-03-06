@extends('frontend.layouts.home')
@section('content')
<!-- ==============================================
	Header
	=============================================== -->	 
	
<!-- ==============================================
	Freelance Services Section
	=============================================== -->
 	<header class="header-login">
      <div class="container">
	   <div class="content">
	  <!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
     </header><!-- /header -->
	 <style>
	 .conform{
	 padding: 10px;
     margin: 17px;
	 }
	 
	input[type=text],input[type=email], textarea {
		width: 100%;
		padding: 12px;
		border: 1px solid #ccc;
		border-radius: 4px;
		box-sizing: border-box;
		margin-top: 6px;
		margin-bottom: 16px;
		resize: vertical;
	}

	input[type=submit] {
		background: #64B5F6;
		margin: 0 auto;
		outline: 0;
		color: white;
		border: 0;
		padding: 12px 24px;
		border-radius: 4px;
		transition: all ease-in-out 0.1s;
		position: relative;
		display: inline-block;
		text-align: center;
	}
	 </style>
 	<section class="conform" id="cms-contact-us">
	 <div class="container">
				   @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif

		<div class="row">
		 	<div class="col-lg-6">
			<h1>Contact Us</h1>
			        <form method="POST" action="/contact">
		{{ csrf_field() }}
            <div class="form-group">
                <label for="email">Email address</label>
                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Enter your email">
                <span class="text-danger">{{ $errors->first('email') }}</span>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input name="name" type="text" class="form-control" id="name" aria-describedby="name" placeholder="Your name">
                <span class="text-danger">{{ $errors->first('name') }}</span>

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Comment</label>
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                <span class="text-danger">{{ $errors->first('comment') }}</span>
            </div>
		

			<div class="form-group">
				<div class="g-recaptcha"
					data-sitekey="{{ env('GOOGLE_RECAPTCHA_KEY') }}">
				</div>
				<span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
			</div>
			
		<button type="submit" class="btn btn-primary">Submit</button>
        </form>
			</div>
			
		
		<!--<div class="col-lg-6">
		<h1>Contact Us</h1>
		<i class="fa fa-envelope" aria-hidden="true"></i>
        </div>	-->
		 	
		 </div><!-- /.row -->
	 </div><!-- /.container -->
	</section><!-- /section -->


@stop
<script src="https://www.google.com/recaptcha/api.js" async defer></script>