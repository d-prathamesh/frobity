@extends('frontend.layouts.home')
@section('content')
<!-- ==============================================
	Header
	=============================================== -->	 
	<style type="text/css">
		.modal a.close-modal{
			right:0!important;
			top:0!important;
		} 
	</style>
	<header id="video" class="header-two">
		 <div class="container">
		<div class="content">
		
			 <div class="row">
		<h1 class="name revealOnScroll" data-animation="fadeInDown">
		FROBITY.</h1>
		<p class="temp">The Ultimate Freelance Marketplace</p>
				<h2 class="hire revealOnScroll" data-animation="fadeInUp" data-timeout="400">Hire the best freelancers for your work in India.</h2>
			<div class="form-row animations scale-in d3">
		 <div class="radio radio-left">
			<a href="{{ route( 'web.otp',['type'=>'client'])}}">HIRE</a>		  
		 </div>
		 <div class="radio radio-right">
			<a href="{{ route( 'web.otp',['type'=>'partner'])}}">WORK</a>		  
		 </div><!--./radio -->
		 </div><!--./form-row -->
			 </div><!--./row -->
	 
			</div><!--./content -->
	 </div><!--./container -->
	<!-- Remember to include jQuery :) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

	<!-- jQuery Modal -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />	
	
	</header><!--./header -->
	
<!-- ==============================================
	Freelance Services Section
	=============================================== -->
	
	
		<section id="services" class="services">
	 <div class="container text-center">
	 
		<div class="row">
		 <div class="col-lg-12">
		<h3>Browse Freelance Services</h3>
		<hr class="mint">
		<h2 style="color:#fff;" class="top-p">View over 30,000 available services by category.</h2>
		<?php
		//echo "<pre>";
		//print_r($categories);
		//echo "</pre>";
		//die();
		?>
		
		@forelse ($categories as $category)
		
		<div class="col-lg-3 col-md-3 col-sm-6 mb-2">
			@if( count( $category['subcategories'] ) )
			<div id="subcat_{{$category['id']}}" class="modal">
				<h3 class="pb-4">Sub Categories of <strong>{{$category['name']}}</strong></h3>
				<div style="">
						@foreach($category['subcategories'] as $k)
						<h4><a href="{{ route('web.client.get.new.job.step2',['catId'=>$category['id'],'subId'=>$k['id']]) }}">{{$k['name']}}</a></h4>
						@endforeach	 
				</div>
				<a href="#" rel="modal:close">Close</a>
			</div>
			@endif
			
			@if( count( $category['subcategories'] ) )
				<a href="#subcat_{{$category['id']}}" 	value="{{$category['id']}}" rel="modal:open">
			@else
				@if( $category['name'] == "Accountant" )
                    <a href="https://frobity.com/freelance-tax-and-accountants-work" >
                    @elseif( $category['name'] == "Web Designer" )
                    <a href ="https://frobity.com/hire-freelance-web-designer">
                    @elseif( $category['name'] == "WordPress Developer" )
                    <a href ="https://frobity.com/freelance-wordpress-web-developer">
					@elseif( $category['name'] == "Web Developer" )
                    <a href ="https://frobity.com/freelance-platform-for-web-developers">
					@elseif( $category['name'] == "Intellectual Property Law" )
                    <a href ="https://frobity.com/intellectual-property-law">
					@elseif( $category['name'] == "Chartered Accountant" )
                    <a href ="https://frobity.com/freelance-chartered-accountant">
				@else
					<a href="{{ route('web.client.get.new.job.step2',['catId'=>$category['id']]) }}" >
                @endif
				
			@endif
				<div class="features one">
					<span class="fa-stack fa-3x">
						<img src="{{$category['image_url']}}" alt="{{$category['name']}}"/>
						<!--<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-code fa-stack-1x fa-inverse"></i>		-->	
					</span><!-- /span -->
					<h4>{{$category['name']}}</h4>
				</div><!-- /.features -->
				<div class="spacer">
				<?php shuffle($range) ;?>
				<p><b>Over {{ $range[0] }}+ jobs</b></p>
				<!--<p>Designer, Developer, Project Management, Front-End Developer.</p>
				<p><b>Over {{ rand(1000,9999)}} services</b></p>-->
				</div> <!-- /.spacer -->
			</a>
	    </div>
			
		@empty
				<p>No categories</p>
		@endforelse
		
		</div><!-- /.col-lg-12 -->
	 </div><!-- /.row -->


	 </div><!-- /.container -->
	</section><!-- /section -->

		<!-- ==============================================
		Banner Section
		=============================================== -->
	<section class="banner-comment">
	 <div class="container">
		<h2 style="color:#fff!important">Best way to help world society is to develop a concrete framework for high paying jobs and individual skills enhancements.</h2>
        <div class="row text-center"><img class="" style="width: 150px;" src="<?php echo url('/'); ?>/images/aatmanirbhar-bharat.png" alt="Aatmanirbhar Bharat"></div>

	 </div><!-- /container -->
	</section><!-- /section -->	  

		<!-- ==============================================
	Stats Section
	=============================================== -->	
	<section id="stats" class="stats hidden">
	 <div class="container text-center">
	 
		<div class="row">
			 
	 <div class="col-lg-3 col-sm-6 pro">
		<h5>Clients</h5>
		<h2><span class="number-animator" data-value="505" data-animation-duration="800">0</span></h2>
		 <div class="progress transparent progress-small no-radius">
			<div class="progress-bar progress-bar-black animated-progress-bar" data-percentage="45%" ></div>
		 </div><!-- /.progress -->
	 </div><!-- /.col-lg-3 -->
			 
	 <div class="col-lg-3 col-sm-6 pro">
		<h5>Freelancers</h5>					
		<h2><span class="number-animator" data-value="4500" data-animation-duration="800">0</span></h2>
		 <div class="progress transparent progress-small no-radius">
			<div class="progress-bar progress-bar-black animated-progress-bar " data-percentage="79%"></div>
		 </div><!-- /.progress -->
	 </div><!-- /.col-lg-3 -->
			 
	 <div class="col-lg-3 col-sm-6 pro">
		<h5>Jobs Completed</h5>
		<h2><span class="number-animator" data-value="14000" data-animation-duration="800">0</span></h2>
		 <div class="progress transparent progress-small no-radius">
			<div class="progress-bar progress-bar-black animated-progress-bar" data-percentage="85%"></div>
		 </div><!-- /.progress -->
	 </div><!-- /.col-lg-3 -->

			<div class="col-lg-3 col-sm-6 pro">
		<h5>Payed To Freelancers</h5>
		<h2><i class="fa fa-usd"></i><span class="number-animator" data-value="500K" data-animation-duration="800">0</span></h2>
		 <div class="progress transparent progress-small no-radius">
			<div class="progress-bar progress-bar-black animated-progress-bar" data-percentage="85%"></div>
		 </div><!-- /.progress -->
	 </div><!-- /.col-lg-3 -->
			 
		</div><!-- /.row -->
	 </div><!-- /.container -->
		</section><!-- /section -->
	 
		<!-- ==============================================
	Testimonials Section
	=============================================== -->	
		<!--<div id="testimonials">
	 <div class="container">  
		<div class="row">
		
		<h3>Testimonials</h3>
		<hr class="mint">
		
	 <div class="testimonials-slider">
		<ul class="slides">
				 <li>
			<p>The Kafe Template, is a powerful medium of expression and design in which its communications offers an infinite variety of perception, interpretation and execution.
			<span>John Doe</span></p>
		 </li>
		 <li>
					<p>I m wondering why I never contacted these guys sooner! Seriously, they all have commendable talent in their respective field and knocked my concept out of the ballpark. Thanks for an amazing experience!
			<span>Segero, NoranicMeds</span></p>
		 </li>
		 <li>
			<p>I m wondering why I never contacted these guys sooner! Seriously, they all have commendable talent in their respective field and knocked my concept out of the ballpark. Thanks for an amazing experience!
			<span>Jane Doe</span></p>
		 </li>
				</ul>
	 </div>
		</div>
	 </div>
		</div>-->
		<!-- /section --> 
@stop
