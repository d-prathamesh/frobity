  <ul id="joblist" >
    @forelse($leads['data'] as $lead)
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
          <a href="#">
           <!--<img class="img-responsive" src="assets/img/users/1.jpg" alt="Image">-->
          </a>
         </div><!-- /.col-lg-2 -->
         <h5><a href="{{ route('web.partner.job.detail',['leadId'=>$lead['id']]) }}">  {{$lead['job_title']}} </a> 
        <span class=" hidden pull-right">Proposals : {{ count($lead['proposals']) }}</span>
        </h5>
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
          }?></h6>
         @if($lead['city'])
         <p><i class="fa fa-map-marker"></i> {{ $lead['city'] }}</p>
         @endif
        </div>
        <hr class="small-hr">

        
       </div><!-- /.col-lg-12 -->
      </div><!-- /.row -->
      
      <div class="row mid-sec">			 
       <div class="col-lg-12">			 
       <div class="col-lg-12">
        <!--<hr class="small-hr">-->
        <p>{{$lead['query']}}</p>
        <?php 
        if( $lead['tags'] != '' ){
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
          <div class="col-lg-4">
           <a href="{{ route('web.partner.job.detail',['leadId'=>$lead['id']]) }}" class="kafe-btn kafe-btn-mint-small"><i class="fa fa-align-left"></i> Send Proposal</a>
          </div>
      
       </div><!-- /.col-lg-12 -->
      </div>
    </li><!-- /.job -->

        @empty
    <div class="prop-info text-center">
            <i class="fa fa-align-left fa-5x"></i>
            <h3>No jobs related to your skills.</h3>
            <p>Please update your profile setting <a href="{{ route('web.partner.setting.aboutme') }}">Settings</a></p>
         </div><!-- /.prop-info -->   
    @endforelse
    </ul>