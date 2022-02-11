@extends('frontend.client.layout')
@section('content')
<div class="job-box">
        <div class="job-header">
         <h4>Add Job</h4>
        </div>
        <form method="post" action="{{ route('web.client.post.new.lead') }}" id="addform">
            @include ('frontend.client.jobs.job_title')
            <div class="form-group">
            <p>Classify your business</p>
            <label class="radio">Private Limited Company
                    <input value="Private Limited Company" type="radio"  name="business_type">
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">Limited Liability Partnership(LLp)
                    <input value="Limited Liability Partnership(LLp)" type="radio" name="business_type">
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">One person company
                    <input value="One person company" type="radio"  name="business_type">
                    <span class="checkround"></span>
                    </label>
                    <label class="radio">Proprietorship Firm
                        <input value="Proprietorship Firm" type="radio"  name="business_type">
                        <span class="checkround"></span>
                        </label>
                    <label class="radio">Partnership
                    <input value="Partnership" type="radio"  name="business_type">
                    <span class="checkround"></span>
                    </label>
                    <p  id="error_business_type" class="hidden error-text">  </p>
                
            </div>
            <div class="form-group">
                <p>Service Required</p>
                <label class="check ">Professional help
                        <input value="Professional help" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Business/Company Registration
                        <input value="Business/Company Registration" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">GST Registration
                        <input value="GST Registration" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">CA Services
                        <input value="CA Services" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Book Keeping
                        <input value="Book Keeping" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <p id="error_service_required" class="hidden error-text"></p>
            </div>
            <div class="form-group hidden">
                    <p>Annual Turnover</p>
                    <label class="radio">0-10 lac
                    <input value="0-10 lac" type="radio"  name="annual_turnover">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">10-30 lac
                    <input value="10-30 lac" type="radio"  name="annual_turnover">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">30-90 lac
                    <input value="30-90 lac" type="radio"  name="annual_turnover">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">90-2.0 cr
                    <input value="90-2.0 cr" type="radio"  name="annual_turnover">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Above 2.0 cr
                    <input value="Above 2.0 cr" type="radio"  name="annual_turnover">
                    <span class="checkround"></span>
                    </label>
                   
            </div>
            <div class="form-group">
                    <p>Industry</p>
                    <label class="radio"> E-commerce
                    <input value=" E-commerce" type="radio"  name="industry">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">IT
                    <input value="IT" type="radio"  name="industry">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Retail/Trading Services
                    <input value="Retail/Trading" type="radio"  name="industry">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Financial Services
                    <input value="Financial Services" type="radio"  name="industry">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Freelance Services
                    <input value="Freelance Services" type="radio"  name="industry">
                    <span class="checkround"></span>
                    </label>

                     <label class="radio">Other
                    <input value="Other" type="radio"  name="industry">
                    <span class="checkround"></span>
                    </label>
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