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

	.table tr {
		transition: background 0.2s ease-in;
	}

	.table tr:nth-child(odd) {
		background: silver;
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
	  background-color: #f1f1f1;
	}
</style>

<div class="container">
 <div class="row header">
    <div class="col-xs-12 text-center">
      	  <h1>Hire Freelanceer in the {{$city}}</h1>
    </div>
  </div>
 
  <!--
	<table class="table" style="font: 17px/20px normal Helvetica, Arial, sans-serif;">
		@if(!empty($data))
		<thead>
		<th><strong>Freelanceer Name </strong></th>
		<th><strong>City</strong></th>
		</thead>
		<tr>
            @foreach($data as $row)
                <tr>
                    <td>
                    <a href="{{route('top_freelancer_by_city_view_profile',['id'=>$row->id])}}">{{$row->name}}</a>
                    </td>
                    <td>{{$row->city}}
					</td>
                </tr>
            @endforeach
            @else
			<h3>Sorry No Data Found</h3>
			@endif
		</tr>
	</table>
-->	
	
	
	<div class="row">
	@if(!empty($data))
	@foreach($data as $row)
		  <div class="column">
			<div class="card">
			@if($row->image)
				<img src="{{ url('/profile-images/'. $row->image )}}" style=" width: 75px;
			  height: 75px;border-radius: 50%;" alt="{{$row->name}}" />
			@else
				
				<img src="https://frobity.com/profile-images/default.png" style=" width: 75px;
			  height: 75px;border-radius: 50%;" alt="{{$row->name}}" />
			@endif
			<!--  <p>@isset($row->image)<img src="{{ url('/profile-images/'. $row->image )}}" style=" width: 75px;
		  height: 75px;border-radius: 50%;" alt="{{$row->name}}" />@endisset</p>-->
			  <h3><a href="{{route('top_freelancer_by_city_view_profile',['id'=>$row->id])}}">{{$row->name}}</a></h3>
			  <p>{{$row->city}}</p>
			</div>
		  </div>
			@endforeach
					@else
					<h3>Sorry No Data Found</h3>
					@endif				
</div>

	
<!--
	<div class="row">
	@if(!empty($data))
	@foreach($data as $row)
                        <div class="col-md-4">
                           <div class="card ">
                              
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2">@isset($row->image)<img src="{{ url('/profile-images/'. $row->image )}}" style=" width: 75px;
  height: 75px;border-radius: 50%;" alt="{{$row->name}}" /></i>@endisset <strong class="s-12"> Name</strong> <span class="float-right s-12"><a href="{{route('top_freelancer_by_city_view_profile',['id'=>$row->id])}}">{{$row->name}}</a></span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> City</strong> <span class="float-right s-12">{{$row->city}}</span></li>
								
							    </ul>
                           </div>
                        </div>
	@endforeach
            @else
			<h3>Sorry No Data Found</h3>
			@endif					
</div>-->						

</div>
{{-- <nav class="pt-3" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> --}}


@stop
