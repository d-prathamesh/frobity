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
 	<section id="cms-{{$slug}}">
	 <div class="container">
	 
		<div class="row">
		 	<div class="col-lg-12">
			@foreach ($cms_content_values as $key => $meta_key_values)
			<!--<h1>{!! strtoupper(preg_replace("/[\-_]/", " ", $meta_key_values->slug)) !!}</h1>-->
			{!! $meta_key_values->content !!} <!-- For Fetching and Display HTML Content --> 
			@endforeach
			</div>
		 	
		 </div><!-- /.row -->
	 </div><!-- /.container -->
	</section><!-- /section -->


@stop