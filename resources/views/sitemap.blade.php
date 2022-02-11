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
 	<section id="sitemap">
	 <div class="container">
		 <div class="row">
		 <?php 
		 //echo "<pre>";
		 //print_r($services); 
		 //echo "</pre>";
		 ?>
		 	<div class="col-lg-12" style="font: 17px/20px normal Helvetica, Arial, sans-serif;">
			<h1>www.frobity.com - Site Map</h1> 
			 <?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
			 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
			
				<ul style="clear:left;
						padding-top:25px;
						padding-left:20px;
						padding-right:20px;
						line-height:30px;
						text-align:justify;
						list-style-position: outside;
						list-style-type:disc;
						">
					<li><a href="#">Login</a></li>
					<a href="https://frobity.com/auth/client/getLoginWithEmail">
					<li>Client Login
					</a>
				<ul>
					<li><a href="https://frobity.com/auth/client/otp">Login with OTP</a></li>
					<li><a href="https://frobity.com/auth/client/email-otp">Login with Email</a></li>
				</ul>
				</li>
				<li><a href="https://frobity.com/auth/partner/getLoginWithEmail">Partner Login<a/></li>
				<ul>
					<li><a href="https://frobity.com/auth/partner/otp">Login with OTP</a></li>
					<li><a href="https://frobity.com/auth/partner/email-otp">Login with Email</a></li>
				</ul>
					<li><a href="#">Register</a></li>
					<ul>
					<li><a href="https://frobity.com/auth/partner/register">Partner Registration<a/></li>
					<li><a href="https://frobity.com/auth/client/register">Client Registration<a/></li>
					</ul>
					
				@foreach ($sitemap_pages as $key => $page_slug_name)
        		<li><a href="https://frobity.com/{{$page_slug_name->slug}}">{!! ucfirst(preg_replace("/[\-_]/", " ", $page_slug_name->slug)) !!}</a></li>
				@endforeach	
			</urlset> 
		
		</div>
		 </div><!-- /.row -->
		 
	 </div><!-- /.container -->
	</section><!-- /section -->


@stop