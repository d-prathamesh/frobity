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
                <label class="check ">Proprietorship Registration
                        <input value="Proprietorship Registration" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Partnership Registration
                        <input value="Partnership Registration" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check "> GST Registration
                        <input value="GST Registration" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label>
                <label class="check "> GST Registration
                        <input value="GST Registration" type="checkbox"  name="service_required[]">
                      <span class="checkmark"></span>
                </label> 
                <label class="check ">Public Company Registration
                    <input value="Public Company Registration" type="checkbox"  name="service_required[]">
                  <span class="checkmark"></span>
            </label>
            <label class="check ">Limited Liability Partnership(LLP)
                <input value="Limited Liability Partnership(LLP)" type="checkbox"  name="service_required[]">
              <span class="checkmark"></span>
        </label>
        <label class="check ">Trademark Registration
            <input value="Trademark Registration" type="checkbox"  name="service_required[]">
          <span class="checkmark"></span>
        </label>                       
            <label class="check ">Copyright Registration
                <input value="Copyright Registration" type="checkbox"  name="service_required[]">
            <span class="checkmark"></span>
        </label>
        <label class="check "> Patent Registration
            <input value="Patent Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
        <label class="check ">Design Registration
            <input value="Design Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
        <label class="check ">ISBN Registration
            <input value="ISBN Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
        <label class="check ">ESI and PF Registration
            <input value="ESI and PF Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
        <label class="check ">Shop and Establishment Registration
            <input value="Shop and Establishment Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
        <label class="check ">SSI Registration
            <input value="SSI Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
        <label class="check ">MSME Registration
            <input value="MSME Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
    </label>
        <label class="check ">Custome Excise Registration
            <input value="Custome Excise Registration" type="checkbox"  name="service_required[]">
        <span class="checkmark"></span>
        </label>
    </label>
    <label class="check ">80G and 12 License
        <input value="80G and 12 License" type="checkbox"  name="service_required[]">
    <span class="checkmark"></span>
    </label>
    </label>
    <label class="check ">FCRA Registration
        <input value="FCRA Registration" type="checkbox"  name="service_required[]">
    <span class="checkmark"></span>
    </label>
    <label class="check "> Other type of License and Registration
        <input value="Other type of License and Registration" type="checkbox"  name="service_required[]">
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