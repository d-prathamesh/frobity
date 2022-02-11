@extends('frontend.partner.layout')
@section('content')
<style>
  .job:before {
    border-bottom: 4px solid #f4f4f4;
  }
  .job .bottom-sec p i{
    font-size: 16px;
  }

  .job .mid-sec .label-success {
    background: #ffffff !important;
    color: #30c4cf !important;
    border: 1px solid #30c4cf;
  }
  .job .mid-sec p {
    padding-bottom: 20px;
  }
</style>
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>My Proposals</p>
          </div> 
        </div> 
   
    @forelse($proposals as $proposal)
    <?php 
   

    ?>
     <li class="job">	
      
      <div class="row bottom-sec">
       <div class="col-lg-12">
        
        <!--<div class="col-lg-12">
         <hr class="small-hr">
        </div> -->
        
        <div class="col-lg-12">
         <div class="pull-left">
          <a href="#">
           <!--<img class="img-responsive" src="assets/img/users/1.jpg" alt="Image">-->
          </a>
         </div><!-- /.col-lg-2 -->
         <h5><a href="{{ route('web.partner.job.detail',['leadId'=>$proposal['job']['id']]) }}">  {{$proposal['job']['job_title']}} </a> 
            <span class="pull-right">Applied on : {{ $proposal['created_at'] }}</span>
        </h5>
         <h6></h6>
         @if($proposal['job']['city'])
         <p><i class="fa fa-map-marker"></i> {{ $proposal['job']['city'] }}</p>
         @endif
        </div>
       <!-- <hr class="small-hr">
       -->
        
       </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
     
    </li><!-- /.job -->
    @empty
    <div class="prop-info text-center">
            <i class="fa fa-align-left fa-5x"></i>
            <h3>No Proposals</h3>
    </div><!-- /.prop-info -->		
    @endforelse

    </ul>
   

@stop
@section('scripts')
<script src="{{ asset('/js/paginathing.min.js') }}"></script>
<script>
  $('ul.work').paginathing();
</script>
@stop