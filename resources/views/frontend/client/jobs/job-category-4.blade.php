@extends('frontend.client.layout')
@section('content')
<div class="job-box">
        <div class="job-header">
         <h4>Add Job</h4>
        </div>
        <form method="post" action="{{ route('web.client.post.new.lead') }}" id="addform">
            @include ('frontend.client.jobs.job_title')
            
            <div class="form-group">
                <p>Service Required</p>
                <label class="check ">Income Tax Return
                        <input value="Income Tax Return" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">GST Return
                        <input value="GST Return" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">TDS Return
                        <input value="TDS Return" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">ROC Compliances
                        <input value="ROC Compliances" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>  
                @if($errors->has('service_required'))
                <p class="error-text"> {{ $errors->first('service_required')}}  </p>
            @endif                         
            </div>
         
            @include ('frontend.client.jobs.tags')
            @include ('frontend.client.jobs.budget')

            @include('frontend.client.jobs._city-partial')
         
            @include ('frontend.client.jobs.description')
           {{ csrf_field() }}
           <button class="kafe-btn kafe-btn-mint-small full-width">Submit</button>
        </form>
       </div>
@stop

@section('scripts')
<script type="text/javascript" src="{{ asset('assets/js/job_post_submission.js') }}"></script>
@stop