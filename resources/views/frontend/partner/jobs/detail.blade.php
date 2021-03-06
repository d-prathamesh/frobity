@extends('frontend.partner.layout')
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
             <h3>{{$lead['job_title']}} </h3>
             <h4>{{ implode(' / ',$newlist)}}</h4>
             <div>
               <hr class="small-hr">
               {{$lead['query']}}
               <hr class="small-hr">
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
              <div class="row">
              <div class="col-lg-2">
               <h5> Posted </h5>
               <p>{{ \Carbon\Carbon::parse($lead['created_at'])->format('jS M Y h:i A')}}</p>
              </div>
              <div class="col-lg-2">
                <h5> Proposals </h5>
                <p>{{ count($lead['proposals']) }}</p>
               </div>
              <div class="col-lg-5">
               <h5> Location </h5>
               <p><i class="fa fa-map-marker"></i> {{$lead['city'] or 'N/A'}}</p>
              </div>
              
              <?php
			  //echo "<pre>";
			  //print_r($proposalByUser);
			  //echo "</pre>";
			  ?>
              <div class="col-lg-3">
                @if(!empty($proposalByUser))
                <a href="#proposal-div" class="kafe-btn kafe-btn-mint-small"> Already Applied</a>
             
                @else
                <a href="#proposal-div" class="kafe-btn kafe-btn-mint-small"><i class="fa fa-align-left"></i> Apply</a>
             
                @endif
                </div>
            </div>
              
             </div><!-- /.col-lg-12 -->
            </div><!-- /.row -->
            <div class="media-body">
                    <p{{$lead['query']}}</p> <br>
            </div>
            </div><!-- .col-lg-12 -->
            
          </div><!-- .card-box-profile --> 
          
         </div><!-- .row -->	  
        </div><!-- .container -->	
       </section>

       <section class="profile-details">
            <div class="">
             <div class="row">
             
              <div class="" id="proposal-div">
               <div class="card-box-profile-details job-box">
      
                 <div class="description-profile">
                 
                  <ul class="tr-list resume-info">			
                 
                   <li>
                    <div class="icon">
                        @if(!empty($proposalByUser))
                        <p class="tr-title"><i class="fa fa-black-tie" aria-hidden="true"></i>Your proposal</p>
                        @else
                        <p class="tr-title"><i class="fa fa-black-tie" aria-hidden="true"></i>Send your proposal</p>
                       
                        @endif
                    </div>  
                    <div class="media-body">
					<?php 
					//echo "<pre>";
					//print_r($proposalByUser);
					//echo "</pre>";
					?>
                      @if(!empty($proposalByUser))
					  <?php //print_r($proposalByUser);?>
                          <div class="row">
                              <div class="col-lg-4">
                              <h5><strong> Proposed Budget</strong> </h5>
                              <p>{{ $proposalByUser['amount'].' INR' }}</p>
                              </div>
                              <div class="col-lg-4">
                                <h5> <strong>Estimated Time</strong> </h5>
                                <p>{{$proposalByUser['expected_days']}} Days</p>
                              </div>
                            </div>
                            <div class="">
                                <hr class="small-hr">
                              </div> 
                            <div class="row">
                                <div class="col-lg-12"> <p class="proposal-summary">{{ $proposalByUser['proposal_summary']}}</p></div>
                            </div>
							
							<div class="row">
                                <div class="col-lg-12">
								<p><strong>Attachment:</strong></p> 
								@if(empty($proposalByUser['file_id']))
								<p>N/A</p>
								@else
								<p><a style="color:black;" href="{{ url('/attachments/'. $proposalByUser['file_id']) }}" class="card-link" target="_blank"  download><i class="fa fa-files-o"></i>  {{$proposalByUser['file_name']}}</a></p>
								@endif
								
								
								
								<p>{{$proposalByUser['expected_days']}} Days</p>
								<p><strong>Proposal Status:</strong>{{$proposalByUser['proposal_status']}}</p>
                            </div>
							
                      @else
                    
                      <form method="post" action="{{ route('web.partner.job.send-proposal',['leadId'=>$lead['id']]) }}" id="jobProposalForm">
                        <div class="form-group">
                          <p>Bid Amount</p>
                          <input type="number" name="amount" class="form-control" placeholder="e.g. : 5000" value="">
                          <p id="error_amount" class="hidden error-text">  </p>
                        </div>
                        <div class="form-group">
                          <p>Expected Days</p>
                          <input id="expected_days" type="number"  name="expected_days" class="form-control" placeholder="8" value="">
                          <p id="error_expected_days" class="hidden error-text"></p>
                        </div>
                          <div class="form-group">
                            <p>Proposal Summary / Cover Letter</p>
                            <textarea name="proposal_summary" rows="10" class="form-control" placeholder="Write your cover letter..."></textarea>
                            <p id="error_proposal_summary" class="hidden error-text">  </p>
                          </div>

                          <div class="form-group">
                            <div class="wrapper-block">
                                <input type="file" name="attachments[]"  accept="image/*,.pdf,.doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" multiple/>
                            </div>
                          </div>



                         {{ csrf_field() }}
                          <div class="form-group">
                            <button class="kafe-btn kafe-btn-mint-small">Send Proposal</button>
                          </div>

                      </form>
                      @endif
                    </div>
                   </li><!-- /.career-objective-->			
                     
                   
                  </ul><!-- /.ul -->			
                   
                 </div><!-- /.description-profile -->	
                      
              </div><!-- .card-box-profile-details -->	
      
      
            
             </div><!-- .col-lg-9 -->
             
              <!-- .col-lg-3 -->
             
            </div><!-- .row -->	  
           </div><!-- .container -->
          </section>
          @if(isset($proposalByUser['chat_initiated']) && $proposalByUser['chat_initiated'])
          <div class="work-box">
              <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
               
                <div class="col-lg-12 top-sec">
                 <h3>Chat Room</h3>
                 <div id="chat-container" >
                    <ul class="chat-list" id="chat-list">
                       
                       
                    </ul> 
                 </div>
                 <div class="form-group">
                    <input class="form-control" id="messageInput" placeholder="Message..."/>
                 </div>
                 <br/><br/>
                </div> 
                     
               </div><!-- .col-lg-12 -->
              </div><!-- /.row -->
             </div>
             @endif

@stop

@section('scripts')
@if(isset($proposalByUser['chat_initiated']) && $proposalByUser['chat_initiated'])
<script type="text/javascript" src="https://cdn.firebase.com/js/client/2.4.2/firebase.js"></script>
<script>

  var messageRef = new Firebase("https://fineagleclient.firebaseio.com/chats/<?=$proposalByUser['job_id']?>/<?=$proposalByUser['id']?>");
  $('#messageInput').keypress(function(e){
     if(e.keyCode == 13) {
    
    var text = $('#messageInput').val();
    messageRef.push({msgUser:"partner", msgText:text,timestamp:(new Date()).getTime()});
    // messageRef.child('currentMessage');
    $('#messageInput').val("");
     }
  
  });
  
  function formatDate(timestamp) {
    var nowDate = new Date(timestamp);
    return nowDate.getDate() +"/"+ nowDate.getMonth() + '/'+ nowDate.getFullYear()+' '+nowDate.getHours()+":"+nowDate.getMinutes();
  }

  messageRef.on('child_added',function(snapshot){
     var message = snapshot.val();
    
    if(message.msgText && message.msgUser){
      if(message.msgUser == "partner"){
        var htm= '<li style="width:100%;">';
            htm+='<div class="msj-rta macro">';
                htm+='<div class="text text-r">';
                    htm+='<p>'+message.msgText+'</p>';
                    if(message.timestamp){
                      htm+='<p><small>'+formatDate(message.timestamp)+'</small></p>';
                    }
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</li>';
                    $('#chat-list').append(htm);
                    $('#chat-list').scrollTop($('#chat-list')[0].scrollHeight);
      }else{
        var htm= '<li style="width:100%;">';
            htm+='<div class="msj macro">';
                htm+='<div class="text text-l">';
                    htm+='<p>'+message.msgText+'</p>';
                    if(message.timestamp){
                      htm+='<p><small>'+formatDate(message.timestamp)+'</small></p>';
                    }
                   
                    htm+='</div>';
                    htm+='</div>';
                    htm+='</li>';
                    $('#chat-list').append(htm);
                    $('#chat-list').scrollTop($('#chat-list')[0].scrollHeight);
      }
    }
    
  
  });
  
  </script>
  @else
  <script type="text/javascript" src="{{ asset('assets/js/job_proposal_submission.js') }}"></script>

  @endif
  @stop