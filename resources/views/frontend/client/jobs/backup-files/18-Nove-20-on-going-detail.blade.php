@extends('frontend.client.layout')
@section('content')
<style>
    .jobpost {
        padding-top:0px;
        padding-bottom: 0px;
    }
    .card-box-profile{
        margin-bottom: 0px;
    }
    .card-box-profile h4,.card-box-profile h3{
        padding-left:0px;
    }
    
    .skill-badge {
        background: #fff;
        color: #30c4cf;
        border: 1px solid #30c4cf;
        padding: 4px 10px;
    }
    .proposal-summary{

    }

    ul.timeline {
        list-style-type: none;
        position: relative;
    }
    ul.timeline:before {
        content: ' ';
        background: #d4d9df;
        display: inline-block;
        position: absolute;
        left: 29px;
        width: 2px;
        height: 100%;
        z-index: 400;
    }
    ul.timeline > li {
        margin: 20px 0;
        padding-left: 20px;
    }
    ul.timeline > li:before {
        content: ' ';
        background: white;
        display: inline-block;
        position: absolute;
        border-radius: 50%;
        border: 3px solid #22c0e8;
        left: 20px;
        width: 20px;
        height: 20px;
        z-index: 400;
    }
  
    
   
</style>
<?php 

$newlist = [];
          if(is_array($lead['service_type']) && isset($lead['service_type']['name'])){
            $newlist[]=$lead['service_type']['name'];
          }
          if(is_array($lead['service_sub_type']) && isset($lead['service_sub_type']['name'])){
            $newlist[]=$lead['service_sub_type']['name'];
          }
          //dd($lead);
?>
<section class="jobpost">	
        <div class="">
         <div class="row"> 
         
          <div class="card-box-profile">
            <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
             
            <div class="row bottom-sec">
             <div class="col-lg-12">
             <h3>{{$lead['job_title']}} 
                    
             </h3>
             <h4>{{ implode(' / ',$newlist)}}@if($lead['status'] == 'InProgress')
                    <span class="label label-info pull-right">{{ $lead['status'] }}</span>
                @else
                    <span class="label label-warning pull-right">{{ $lead['status'] }}</span>
                @endif
                   
             </h4>
             <div>
                    <?php 
                    $list = explode(',',$lead['service_required']);
                    $list = array_filter($list);
                    $newlist = array_merge($newlist,$list);
                   
                    foreach($newlist as $item){
                      ?>
                      
                      <span class="label label-success skill-badge"><i class="fa fa-tag"></i> {{$item}}</span>
                      <?php 
                    }
                    
                  ?>
            </div>
              <div class="">
               <hr class="small-hr">
            
            </div>
              
             </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            <div class="media-body">
                    @if(count($lead['submission_history'])>0)
                	<div class="row">
                            <div class="col-md-12">
                                    <h4>Submission History</h4>
                                <ul class="timeline">
                                    @foreach($lead['submission_history'] as $submission_history)
                                    <li>
                                            <a href="#" class="float-right">{{$submission_history['created_at']}}</a> / <a target="_blank" href="javascript:void(0)">{{$submission_history['user']['name']}}</a>
                                        
                                        <p>{{$submission_history['message']}}</p>
                                        <div class="clearfix"></div>
                                            @foreach($submission_history['attachments'] as $attachments)
                                            <p><a href="{{$attachments['file_id']}}" class="card-link" target="_blank"  download><i class="fa fa-files-o"></i>  {{$attachments['file_name']}}</a></p>
                                            @endforeach
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif

                <br>
                @if($lead['status'] == 'InReview')
                <form id="submission-form"  method="post" action="{{route('web.client.ongoing.jobs.update-work',['leadProId'=>$leadProId])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input type="hidden" name="lead_id" id="lead_id">
                    <input type="hidden" name="pro_id" id="pro_id">
                    
                    <div class="modal-body">
                        <textarea name="message" class="form-control r-0 b-0 p-t-40 mb-3" placeholder="Write Something..." rows="10" name="message"></textarea>
                        @if($errors->has('message'))
                            <div class="error-text"> {{ $errors->first('message')}}  </div>
                            @endif 
                        <br/>
                    </div>
                    <div class="modal-footer">
                        <button onclick="refundWork()" type="button" class="kafe-btn kafe-btn-mint-small">
						Refund</button>
						
						<button onclick="updateWork(this,'accept')" type="button" class="kafe-btn kafe-btn-mint-small">
                            Accept
                        </button>
                        <button onclick="updateWork(this,'reject')" type="button" class="kafe-btn kafe-btn-mint-small btn-danger">
                            Reject
                        </button>
                    </div>
                </form>
                @endif

                
                
            </div>
            </div><!-- .col-lg-12 -->
            
          </div><!-- .card-box-profile --> 
          
         </div><!-- .row -->	  
        </div><!-- .container -->	

      
       </section>

     

@stop

@section('scripts')
<script>
    function updateWork(element,action){
        $(element).parents('form').append('<input type="hidden" name="action" value="'+action+'"/>');
        $(element).parents('form').submit();
    }
	
	function refundWork(){
        alert('In Refund');
	 //here fetch the records using job id and user id
    }
</script>
@stop
