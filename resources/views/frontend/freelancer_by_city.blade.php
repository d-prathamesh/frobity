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
	 
 	<style type="text/css">
    ul.btn-actions li{ display: inline; }
	
	#container {
		margin: 10px;
		
	}
	.header {
	  padding-top: 25px;
	  padding-bottom: 25px;
	}


	* {
	  box-sizing: border-box;
	}


	/* Float four columns side by side */
	.column {
	  float: left;
	  width: 25%;
	  padding: 21px 10px;
	}

	/* Remove extra left and right margins, due to padding */
	.row {margin: 0 -5px;}

	/* Clear floats after the columns */
	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}

	/* Responsive columns */
	@media screen and (max-width: 600px) {
	  .column {
		width: 100%;
		display: block;
		margin-bottom: 20px;
	  }
	}

	/* Style the counter cards */
	.card {
	  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	  padding: 16px;
	  text-align: center;
	 /* background-color: #f1f1f1;*/
	}
</style>

<div class="container">
 <div class="row header">
    <div class="col-xs-12 text-center">
      	  <h1>Hire Freelanceer in the {{$city}}</h1>
    </div>
  </div>

	<div class="row">
	@if(!empty($data))
	@foreach($data as $row)
		  <a href="{{route('top_freelancer_by_city_view_profile',['id'=>$row->id])}}">
		  <div class="column">
			<div class="card">
			
			@if($row->image)
				<img src="{{ url('/profile-images/'. $row->image )}}" style=" width: 75px;
			  height: 75px;border-radius: 50%;" alt="{{$row->name}}" />
			@else
				<img src="https://frobity.com/profile-images/default.png" style=" width: 75px;
			  height: 75px;border-radius: 50%;" alt="{{$row->name}}" />
			@endif
			  <h3>{{$row->name}}</h3>
			  <p>{{$row->city}}</p>
			  
			</div>
			</a>
		  </div>
			@endforeach
					@else
					<h3>Sorry No Data Found</h3>
					@endif				
</div>
</div>
@stop
