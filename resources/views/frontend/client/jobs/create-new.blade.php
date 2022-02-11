@extends('frontend.client.layout')
@section('content')
<div class="job-box">
        <div class="job-header">
         <h4>Add Job</h4>
        </div>
        <form method="post" id="addform">
            <div class="form-group">
                        <p>Job Title</p>
                        <input type="text" name="tit" class="form-control" placeholder="Job title" value="">
            </div>
            <div class="form-group">
            <p>Classify your business</p>
            <label class="radio">Private Limited Company
                    <input value="Private Limited Company" type="radio" checked="checked" name="business_type">
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
                    
            </div>
            <div class="form-group">
                <p>Service Required</p>
                <label class="check ">Professional help
                        <input value="Professional help" type="checkbox" checked="checked" name="is_name">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Business/Company Registration
                        <input value="Business/Company Registration" type="checkbox" checked="checked" name="is_name">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">GST Registration
                        <input value="GST Registration" type="checkbox" checked="checked" name="is_name">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">CA Services
                        <input value="CA Services" type="checkbox" checked="checked" name="is_name">
                      <span class="checkmark"></span>
                </label>
                <label class="check ">Book Keeping
                        <input value="Book Keeping" type="checkbox" checked="checked" name="is_name">
                      <span class="checkmark"></span>
                </label>
                        
            </div>
            <div class="form-group">
                    <p>Annual Turnover</p>
                    <label class="radio">0-10 lac
                    <input value="0-10 lac" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">10-30 lac
                    <input value="10-30 lac" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">30-90 lac
                    <input value="30-90 lac" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">90-2.0 cr
                    <input value="90-2.0 cr" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Above 2.0 cr
                    <input value="Above 2.0 cr" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>
                    
            </div>
            <div class="form-group">
                    <p>Industry</p>
                    <label class="radio"> E-commerce
                    <input value=" E-commerce" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">IT
                    <input value="IT" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Retail/Trading Services
                    <input value="Retail/Trading" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Financial Services
                    <input value="Financial Services" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                    <label class="radio">Freelance Services
                    <input value="Freelance Services" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>

                     <label class="radio">Other
                    <input value="Other" type="radio" checked="checked" name="business_type">
                    <span class="checkround"></span>
                    </label>
            </div>

         
        		
         
           <div class="form-group">	
             <label>How would you like to pay?</label>
             <p>
              <a href="" class="selected">By Hour</a>
              <a href="" class="unselected">Fixed Cost</a>
             </p>
           </div>   
           
           <div class="form-group">	
             <label>Budget</label>
             <input type="text" name="budget" class="form-control" placeholder="Budget" value="">
           </div>   
        
           <div class="form-group">	
             <label>Hours per week</label>
             <p>
              <a href="" class="unselected">40+</a>
              <a href="" class="unselected">30-39</a>
              <a href="" class="selected">20-29</a>
              <a href="" class="unselected">10-19</a>
              <a href="" class="unselected">1-9</a>
             </p>
           </div> 
        
           <div class="form-group">	
             <label>Desired Experience Level</label>
             <p>
              <a href="" class="unselected">$ Entry Level</a>
              <a href="" class="unselected">$$ Intermediate</a>
              <a href="" class="selected">$$$ Expert</a>
             </p>
           </div> 
        
           <div class="form-group">	
             <label>Job Duration</label>
             <p>
              <a href="" class="unselected">Not Sure</a>
              <a href="" class="unselected">6+ Months</a>
              <a href="" class="selected">3 to 6 Months</a>
              <a href="" class="unselected">1 to 3 Months</a>
              <a href="" class="unselected">Less than 1 Month</a>
              <a href="" class="unselected">Less than 1 Week</a>
             </p>
           </div> 
           
           <div class="form-group">	
            <label>Description</label>
            <textarea class="form-control" rows="5" placeholder="Provide a more detailed description of your job to get better proposals."></textarea>
           </div> 
           
           <button class="kafe-btn kafe-btn-mint-small full-width">Submit</button>
        </form>
       </div>
@stop