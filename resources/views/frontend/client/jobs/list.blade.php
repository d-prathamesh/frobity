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
</style>
<ul class="work" style="padding:10px 0px;">
			
        <div class="col-lg-12">
          <div class="icon">
           <p class="tr-title"><i class="fa fa-list" aria-hidden="true"></i>Posted Jobs</p>
          </div> 
        </div> 
   
    @forelse($leads as $lead)
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
         <h4><a href="#">  {{$lead['job_title']}} </a> 
        <span class="pull-right"><a href="{{ route('web.client.jobs.proposals',['id'=>$lead['id']]) }}">Proposals : {{ count($lead['proposals']) }}</a></span>
        </h4>
         <h6>
           <?php 
          $list = explode(',',$lead['service_required']);
          $list = array_filter($list);
          $newlist = array_merge($newlist,$list);
         
          foreach($newlist as $key => $item){
            
            if( $key >= 1){
              echo " / ";
            } 
            ?>
            
            <span > {{$item}} </span>


            <?php 
          }?>
           
         </h6>
         @if($lead['city'])
         <p><i class="fa fa-map-marker"></i> {{ $lead['city'] }}</p>
         @endif
        </div>
       <!-- <hr class="small-hr">
       -->
        
       </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
      
      <div class="row mid-sec">	
      <hr />		 
       <div class="col-lg-12">			 
       <div class="col-lg-12">
        <!--<hr class="small-hr">-->
        <p>{{$lead['query']}}</p>
        <?php if( $lead['tags'] != '' ){
            $tag_list = explode(',',$lead['tags']);

        
  //        $list = array_filter($list);
//          $newlist = array_merge($newlist,$list);
           if( is_array( $tag_list ) ){
            foreach( $tag_list as $item){
              ?>
              
              <span class="label label-success"><i class="fa fa-tag"></i> {{$item}}</span>
              <?php 
            }
          }
        }
        ?>
          
       </div><!-- /.col-lg-12 -->
       </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
     <div class="row bottom-sec">
       <div class="col-lg-12">
      
      <div class="col-lg-12">
       <hr class="small-hr">
      </div> 
      
      <div class="col-lg-2">
       <h5> Posted </h5>
       <p>{{ $lead['created_at'] }}</p>
      </div>
      <div class="col-lg-2">
       <h5> Budget </h5>
       <p>{{ $lead['budget'] }}</p>
      </div>
      <div class="col-lg-2">
       <h5> Applicants </h5>
       <p>{{count($lead['proposals'])}}</p>
      </div>
      @if( $lead['status'] == 'Open' )
        <button class="pull-right col-lg-2" onclick="if(confirm('Are you sure to close this job?'))window.location.href='{{ route('web.client.cancel.job',['id'=>$lead['id']]) }}'">Close Job </button>
        @endif
      @if( $lead['status'] == 'Cancelled' )
        <h4 class="pull-right col-lg-2" >Closed Job</h4>
        @endif
       </div><!-- /.col-lg-12 -->
      </div>
    </li><!-- /.job -->
    @empty
    <div class="prop-info text-center" style="">
      <i class="fa fa-align-left fa-5x"></i>
      <h3>You have not posted  any job yet. </h3>
      <p>Start posting new jobs now. <a href="{{ route('web.client.get.new.job.step1') }}">Post Job</a></p>
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