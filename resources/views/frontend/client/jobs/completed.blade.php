@extends('frontend.client.layout')
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

  .img-thumbnail{
      height: 80px;
  }
  .contractor-info .contractor-name{
    font-size: 14px;
  }
  .contractor-info .contractor-name span{
    color: #30c4cf;

  }

  .contractor-info .contractor-location{
    font-size: 10px;
  }
</style>
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Completed Jobs</p>
          </div> 
        </div> 
   
    @forelse($completedJobs as $lead)
    <?php 
    $newlist = [];
          if(is_array($lead['service_type']) && isset($lead['service_type']['name'])){
            $newlist[]=$lead['service_type']['name'];
          }
          if(is_array($lead['service_sub_type']) && isset($lead['service_sub_type']['name'])){
            $newlist[]=$lead['service_sub_type']['name'];
          }
          

    ?>
     <li class="job">	
      
      <div class="row bottom-sec">
       <div class="col-lg-12">
        
        <!--<div class="col-lg-12">
         <hr class="small-hr">
        </div> -->
        
        <div class="col-lg-12">
         <div class="pull-left">
          <a href="">
           <!--<img class="img-responsive" src="assets/img/users/1.jpg" alt="Image">-->
          </a>
         </div><!-- /.col-lg-2 -->
         <h5><a href="#">  {{$lead['job_title']}} </a> 
        <span class="pull-right">
            @if($lead['status'] == 'InProgress')
                <span class="label label-info">{{ $lead['status'] }}</span>
            @else
                <span class="label label-warning">{{ $lead['status'] }}</span>
            @endif
            
        </span>
        </h5>
         <h6></h6>
         @if($lead['city'])
         <p><i class="fa fa-map-marker"></i> {{ $lead['city'] }}</p>
         @endif
        </div>
       <!-- <hr class="small-hr">
       -->
        
       </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
      
      <div class="row mid-sec">		
          	 
       <div class="col-lg-12">
            <div class="col-lg-12">
                <div class="col-md-3">
                        <img src="{{ asset('/assets/img/default-user.svg') }} " class="img-circle img-thumbnail" alt="Image">
                  
                </div>
                <div class="col-md-9 contractor-info">
                        <h3 class="contractor-name">
                            <span>Contractor : </span>{{ $lead['active_contract']['contractor']['name']}}
                       
                        </h3>
                        <h4 class="contractor-location"><span class=""><i class="fa fa-map-marker"></i> &nbsp;{{ $lead['active_contract']['contractor']['city'] ?$lead['active_contract']['contractor']['city'] : 'N/A'}}</span>
                        
                        </h4>
                </div>
                    
                   </div><!-- .col-lg-3 -->			 
       <div class="col-lg-12">
        <!--<hr class="small-hr">-->
        <p>{{$lead['query']}}</p>
        <?php 
          $list = explode(',',$lead['service_required']);
          $list = array_filter($list);
          $newlist = array_merge($newlist,$list);
         
          foreach($newlist as $item){
            ?>
            
            <span class="label label-success"><i class="fa fa-tag"></i> {{$item}}</span>
            <?php 
          }
          
        ?>
       </div><!-- /.col-lg-12 -->
       </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
     
    </li><!-- /.job -->
    @empty
    <div class="prop-info text-center" style="">
      <i class="fa fa-align-left fa-5x"></i>
      <h3>No completed jobs</h3>
     
   </div>
    @endforelse

    </ul>
   

@stop
@section('scripts')
<script src="{{ asset('/js/paginathing.min.js') }}"></script>
<script>
  $('ul.work').paginathing();
</script>
@stop