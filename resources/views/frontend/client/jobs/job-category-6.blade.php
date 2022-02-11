@extends('frontend.client.layout')
@section('content')
<style>
    .city-text{
        font-size:10px;
    }
    .freelancer-list-item{
        text-align: center;
    }
    .freelancer-list-item .freelancer{
        border-radius: 5px;
        padding: 5px;
        border: 1px solid lightgray;
        margin-bottom: 10px;
    }
</style>
<div class="job-box">
        <div class="job-header">
         <h4>{{$category['name']}} - Add Job</h4>
        </div>
        <form method="post" action="{{ route('web.client.post.new.job') }}" id="addform">
            @include ('frontend.client.jobs.job_title')
            <div class="form-group">
                <p>Category</p>
		        <select class="form-control" name="service_sub_type">
				@foreach($category['subcategories'] as $subcat)				
                <option {{ $subId == $subcat['id'] ?'selected="selected"':'' }} value="{{ $subcat['id'] }}">{{ $subcat['name'] }}
				</option>
				@endforeach        
		
				</select>
                <p id="error_service_sub_type" class="hidden error-text"> {{ $errors->first('service_sub_type')}}  </p>
            </div>
         
           @include ('frontend.client.jobs.tags')
           @include ('frontend.client.jobs.budget')
           @include ('frontend.client.jobs.description')
         
            <input type="hidden" name="service_type" value="{{ $catId }}"/>
           {{ csrf_field() }}
           <div class="form-group freelancer-list">
                <p>Choose and Invite Top Freelancers</p>
               @forelse($freelancers as $freelancer)
               <div class="col-md-4 freelancer-list-item">
                <div class="freelancer">
                    <p> <label class="check">{{{ $freelancer['name']}}}
                        <input value="{{ $freelancer['id'] }}" type="checkbox"  name="users[]">
                        <span class="checkmark"></span>
                        </label>
                    </p>
                    <p class="city-text"><i class="fa fa-dollar"></i> {{ $freelancer['hourly_rate']  ? $freelancer['hourly_rate'].'/hr' : 'N/A' }}</p>
                    <p class="city-text"><i class="fa fa-map-marker"></i> {{ $freelancer['city']  ? $freelancer['city'] : 'N/A' }}</p>
                </div>
                </div>
                @empty
				<p class="city-text">No Freelancer available</p>
                @endforelse
           </div>

        
           <button class="kafe-btn kafe-btn-mint-small full-width">Submit</button>
        </form>
       </div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/js/job_post_submission.js') }}"></script>
@stop