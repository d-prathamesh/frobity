@extends('frontend.client.layout')
@section('content')
<div class="job-box">
        <div class="job-header">
         <h4>Choose category</h4>
        </div>
        <div class="row">
        @foreach($categories as $category)
        <div class="col-lg-3 col-md-3 col-sm-6">
                <a href="{{ route('web.client.get.new.job.step2',['catId'=>$category['id']]) }}" class="hover">
                 <div class="features one">
                    <span class="fa-stack fa-3x">
                        <img class="category-image" src="{{$category['image_url']}}"/>
                 <!--<i class="fa fa-circle fa-stack-2x"></i>
                 <i class="fa fa-code fa-stack-1x fa-inverse"></i>		-->	
                </span><!-- /span -->
                <h4>{{$category['name']}}</h4>
                 </div><!-- /.features -->
                </a>		 
             </div>
        @endforeach
    </div>
        
       </div>
@stop