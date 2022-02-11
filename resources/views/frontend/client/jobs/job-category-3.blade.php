@extends('frontend.client.layout')
@section('content')
<div class="job-box">
        <div class="job-header">
         <h4>Add Job</h4>
        </div>
        <form method="post" action="{{ route('web.client.post.new.lead') }}" id="addform">
            @include ('frontend.client.jobs.job_title')
            <div class="form-group">
            <p>Classify you Accountant requirements*</p>
            <label class="radio">Once a week
                    <input value="Once a week" type="radio"  name="requirement_qualification">
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">Twice a week
                    <input value="Twice a week" type="radio" name="requirement_qualification">
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">Weekly
                    <input value="Weekly" type="radio"  name="requirement_qualification">
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">Monthly
                        <input value="Monthly" type="radio"  name="requirement_qualification">
                        <span class="checkround"></span>
                        </label>
                    
                    
            </div>
            <div class="form-group">
                <p>Service Required</p>
                <label class="check ">Book Keeping
                        <input value="Book Keeping" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Accounting
                        <input value="Accounting" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Monthly Accounting / Closing of books
                        <input value="Monthly Accounting / Closing of books" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Tally/Busy/Marg/Quickbooks Operator
                        <input value="Tally/Busy/Marg/Quickbooks Operator" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label> 
                <p  id="error_service_required" class="hidden error-text"></p>
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