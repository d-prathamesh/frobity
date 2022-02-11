@extends('frontend.client.layout')
@section('content')
<style>
  .work{
      background: none;
      padding-top: 0px;
  }
  .work-box{
      margin-bottom: 15px;
  }
  .work-box .title a{
      color:#00C4CF;
  }
  .work-box .title a.kafe-btn{
      color:#fff;
  }
</style>
<ul class="work">
    @if($proposal)
    <?php 
    $newlist = [];
          if(is_array($proposal['job']['service_type']) && isset($proposal['job']['service_type']['name'])){
            $newlist[]=$proposal['job']['service_type']['name'];
          }
          if(is_array($proposal['job']['service_sub_type']) && isset($proposal['job']['service_sub_type']['name'])){
            $newlist[]=$proposal['job']['service_sub_type']['name'];
          }
    $taglist = explode(',', $proposal['job']['service_required']) ;
    $newlist = array_merge($newlist,$taglist);
    ?>
    <li class="work-box">
        <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
         
          <div class="col-lg-12 top-sec">
           <h3 class="title"><a href="{{ route('web.client.posted.jobs.proposal-detail',['proposalId'=>$proposal['id'],'id'=>$proposal['job']['id']]) }}">{{$proposal['job']['job_title']}}</a>
            
        </h3>
           <h4>{{ implode(' / ',$newlist)}}
              
           </h4>
          </div> 
          <div class="col-lg-12">
           <hr class="small-hr">
          </div> 
              
          <div class="col-lg-12 middle-sec">
           <div class="col-lg-12">
            <img src="{{ asset('/assets/img/default-user.svg') }} " class="img-circle img-thumbnail" alt="Image">
            <h3><a href="">{{ $proposal['proposal_by']['name']}}</a>
               
            </h3>
            <h4><span class=""><i class="fa fa-map-marker"></i> &nbsp;{{ $proposal['proposal_by']['city'] ? $proposal['proposal_by']['city'] : 'N/A'}}</span>
            
            </h4>
           </div><!-- .col-lg-3 -->
          </div>  
          
          <div class="col-lg-12">
           <hr class="small-hr">
          </div> 
          
          <div class="col-lg-12 bottom-sec">
           <div class="col-lg-6">
            <h5> Estimated Budget</h5>
            <p> {{ $proposal['amount']}} INR</p>
           </div>
           <div class="col-lg-6">
            <div class="pull-right">
             <h5> Estimated Time </h5>
             <p>{{ $proposal['expected_days']}} Day(s)</p>
            </div>  
           </div>
          
          </div>
          
          <!-- /.col-lg-12 -->
               
         </div><!-- .col-lg-12 -->
        </div><!-- /.row -->
    </li>
   
    <div class="work-box">
      <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
       
        <div class="col-lg-12 top-sec">
         <h3>Chat Room</h3>
         <div id="chat-container" >
            <ul class="chat-list" id="chat-list">
               
               
            </ul> 
         </div>
         @if(isset($proposal['chat_initiated']) && $proposal['chat_initiated'])
         <div class="form-group">
            <input class="form-control" id="messageInput" placeholder="Message..."/>
         </div>
         @else
         <div class="form-group">
           <br/>
           <form method="post" action="{{ route('web.client.initiate-chat',['leadId'=>$id,'proposalId'=>$proposalId]) }}"> 
              {{ csrf_field() }}  
            <button class="kafe-btn kafe-btn-mint-small">Initiate Chat</button>
           </form>
         </div>
         @endif
         <br/><br/>
        </div> 
             
       </div><!-- .col-lg-12 -->
      </div><!-- /.row -->
     </div>
    <div class="work-box">
        <div class="row">
         <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
         
          <div class="col-lg-12 top-sec">
           <h3>Proposal Summary</h3>
           <p>{{ $proposal['proposal_summary'] ? $proposal['proposal_summary'] : 'N/A'}}</p>
            <br/><br/>
           <div >
            <button id="rzp-button" class="kafe-btn kafe-btn-mint-small">Accept</button>
            <!--<a class="kafe-btn kafe-btn-mint-small btn-danger">View Other Proposals</a>-->
			<a class="kafe-btn kafe-btn-mint-small btn-danger" href="{{ route('web.client.posted.jobs.proposals') }}">
				View Other Proposals
		    </a>
           </div>
           <br/><br/>
          </div> 
               
         </div><!-- .col-lg-12 -->
        </div><!-- /.row -->
       </div>
       <form method="POST" action="{{route('web.client.posted.jobs.proposal',['id'=>$proposal['job']['id'],'proposalId'=>$proposal['id']])}}" id="verify-payment">
        <input type="hidden" name="_token" value="{{ csrf_token()}}">
        <input type="hidden" name="transaction_id" id="razorpay_payment_id">
        <input type="hidden" name="payment_status" value="1">
        <input type="hidden" name="amount" value="{{$proposal['amount']}}">
        <input type="hidden" name="lead_id" value="{{$proposal['job']['id']}}">
        <input type="hidden" name="proposal_id" value="{{$proposal['id']}}">
        
    </form>
       
       @else
				<p>No Proposal found</p>
    @endif
</ul>
   

@stop

@section('scripts')
@if(isset($proposal['chat_initiated']) && $proposal['chat_initiated'])
<script type="text/javascript" src="https://cdn.firebase.com/js/client/2.4.2/firebase.js"></script>
<script>

  var messageRef = new Firebase("https://fineagleclient.firebaseio.com/chats/<?=$proposal['job_id']?>/<?=$proposal['id']?>");
  $('#messageInput').keypress(function(e){
     if(e.keyCode == 13) {
    
    var text = $('#messageInput').val();
    messageRef.push({msgUser:"client", msgText:text,timestamp:(new Date()).getTime()});
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
      if(message.msgUser == "client"){
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
  @endif
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
      var options = {
        "key": "{{ env('RAZOR_API_KEY')}}",
        "amount":'{{$proposal['amount']*100}}',
        "payment_capture":1,
        "name": "Accronic Private Limited",
        "description": "Escrowing Fund",
        "handler": function (response){
          
          document.getElementById("razorpay_payment_id").value = response.razorpay_payment_id;
          
          console.log(response);
          document.getElementById("verify-payment").submit();
        },
        "modal": {
            "ondismiss": function(){}
        }
      };
      var rzp1 = new Razorpay(options);
      document.getElementById('rzp-button').onclick = function(e){
        //event.preventDefault();
        rzp1.open();
      }
    </script>
    @stop