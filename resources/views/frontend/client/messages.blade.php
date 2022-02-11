@extends('frontend.client.layout')
@section('content')
	<div class="work" style="padding:10px 0px;">	
	    <div class="col-lg-12">
	        <div class="icon">
	        <p class="tr-title"><i class="fa fa-bell" aria-hidden="true"></i>Messages</p>
	        </div> 
	    </div> 
		<div class="my-3">
            <div class="col-md-12">
                <div class="counter-box white r-5 p-3">
                    @if( count($responsedata) )
                        <ul>
                            @foreach( $responsedata as $notification )
                             	<li><a style="color: #337ab7;" href="{{route('web.client.ongoing.jobs.detail', '')}}/{{ $notification['job_id']}}-{{ $notification['job_application_id']}}">Your work for Job:{{ $notification['job_title']}} received Message: {{ $notification['message']}}</a></li>
                            @endforeach
                        </ul>
                    @else
                    <div> No New Notifications</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
            
@stop

