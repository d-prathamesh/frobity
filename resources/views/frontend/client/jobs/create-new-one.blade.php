@extends('frontend.client.layout')
@section('content')
<div class="job-box">
        <div class="job-header">
         <h4>Add Job</h4>
        </div>
        <form method="post" id="addform">
        
           <div class="form-group">	
             <label>Title</label>
             <input type="text" name="title" class="form-control" placeholder="Title" value="">
           </div>   
         
         <div class="col-lg-6">
           <div class="form-group">	
             <label>Category</label>
              <select name="category" class="form-control">
               <option value="">Admin Support</option>
               <option value="">Web, Software &amp; IT</option>
               <option value="">Design, Art &amp; Multimedia</option>
               <option value="">Writing &amp; Translation</option>
               <option value="">Management &amp; Finance</option>
               <option value="">Sales &amp; Marketing</option>
               <option value="">Engineering &amp; Architecture</option>
               <option value="">Legal</option>
               <option value="">Other</option>	
              </select>	
           </div> 
         </div> 		
         
         <div class="col-lg-6 job-sec">
           <div class="form-group">	
             <label>Sub Category</label>
             <select class="form-control">
              <option value="">HTML5</option>	
              <option value="">CSS3</option>	
              <option value="">Bootstrap</option>	
              <option value="">PHP</option>	
             </select>
           </div> 
         </div>	
         
           <div class="form-group">	
             <label>Country</label>
             <select class="form-control">
              <option value="">USA</option>	
              <option value="">UK</option>	
              <option value="">Russia</option>	
              <option value="">Kenya</option>	
             </select>
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