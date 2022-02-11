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
    @forelse($proposals as $proposal)
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
            <span class="pull-right">
                    <a href="{{ route('web.client.posted.jobs.proposal-detail',['proposalId'=>$proposal['id'],'id'=>$proposal['job']['id']]) }}" class="kafe-btn kafe-btn-mint-small">View Proposal</a>
                </span>
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
          
          <!--<div class="col-lg-12">
           <hr class="small-hr">
          </div> 
          
          <div class="col-lg-12 bottom-sec">
           <div class="col-lg-6">
            <h5> Freelancer Proposal </h5>
            <p> $20/hr</p>
           </div>
           <div class="col-lg-6">
            <div class="pull-right">
             <h5> Job Type </h5>
             <p>Hourly</p>
            </div>  
           </div>
          </div>-->
          <!-- /.col-lg-12 -->
               
         </div><!-- .col-lg-12 -->
        </div><!-- /.row -->
    </li>

    @empty
    <div class="prop-info text-center">
      <i class="fa fa-align-left fa-5x"></i>
      <h3>You have no pending proposals </h3>
      
   </div>
    @endforelse
</ul>
   

@stop
@if(count($proposals) > 0)
@section('scripts')
<script src="{{ asset('/js/paginathing.min.js') }}"></script>
<script>
  $('ul.work').paginathing();
</script>
@stop
@endif