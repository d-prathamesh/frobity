@extends('frontend.layouts.home')
@section('content')
<!-- ==============================================
	Header
	=============================================== -->	 
	
<!-- ==============================================
	Freelance Services Section
	=============================================== -->
 	<header class="header-login">
      <div class="container">
	   <div class="content">
	  <!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
     </header><!-- /header -->
	 
 	<style type="text/css">
    ul.btn-actions li{ display: inline; }
	</style>

<div class="container">
 <div class="row header">
    <div class="col-xs-12 text-center" style="padding-top:10px;box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
    padding: 16px;">
	  	  <?php 
		   $user_profile_image = $data['image'] ;
		   $search = 'https://frobity.com/storage/../profile-images/' ;
           $trimmed_user_profile_image = str_replace($search, '', $user_profile_image) ;
		  ?>
		  @if($data['image'])
				<img src="{{ url('/profile-images/'. $trimmed_user_profile_image )}}" style=" width: 75px;
			  height: 75px;border-radius: 50%;" alt="{{$data['name']}}" />
			@else
				<img src="https://frobity.com/profile-images/default.png" style=" width: 75px;
			  height: 75px;border-radius: 50%;" alt="{{$data['name']}}" />
			@endif
		  <h1>{{$data['name']}}</h1>
    </div>
  </div>
 
	<div class="row" style="box-shadow: 0 4px 8px 0 rgb(0 0 0 / 20%);
    padding: 16px;">
                        <div class="col-md-4">
                           <!--<div class="card ">
                              <div class="card-header white">
                                  <strong> Partner Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Name</strong> <span class="float-right s-12">{{$data['name']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Mobile No</strong> <span class="float-right s-12">{{$data['mobile']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Email</strong> <span class="float-right s-12">{{$data['email']}}</span></li>
                                </ul>
                           </div>
						   
						   <div class="card ">
                              <div class="card-header white">
                                  <strong> Membership Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Membership Id</strong> <span class="float-right s-12">{{$data['member_id']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Status</strong> <span class="float-right s-12">{{$data['member_id_status']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Subscription Id</strong> <span class="float-right s-12">{{$data['subscription_id']}}</span></li>
                                </ul>
                           </div>
						   -->
						   <div class="card ">
                              <div class="card-header white">
                                  <strong>Service Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Service Offered</strong>
                                  <span class="float-right s-12">{{$data['service_offered']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Experince</strong> <span class="float-right s-12">{{$data['professional_experience']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> City</strong> <span class="float-right s-12">{{$data['city']}}</span></li>
                                </ul>
                           </div>
						       <div class="card ">
                              <div class="card-header white">
                                  <strong> Job History </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Total Jobs</strong>
                                  <span class="float-right s-12">{{$total_jobs}}</span></li>
                                  <!-- <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Ongoing Jobs</strong> <span class="float-right s-12">{{$ongoing_jobs}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Completed</strong> <span class="float-right s-12">{{$completed_jobs}}</span></li>-->
                                </ul>
                           </div>
                        </div>
						
                       
						<div class="col-md-8">
						    <div class="card ">
                              <div class="card-header white">
                                  <strong> Work History </strong>
                              </div>
							  
							<ul class="nav nav-tabs">
							  <li class="active"><a data-toggle="tab" href="#completed_jobs">Completed Jobs({{$completed_jobs}})</a></li>
							  <li><a data-toggle="tab" href="#jobs_inprogress">Jobs InProgress({{$ongoing_jobs}})</a></li>
							</ul>

							<div class="tab-content">
							  <div id="completed_jobs" class="tab-pane fade in active">
								<!--<h3>Completed Jobs</h3>-->
									@foreach($client_jobs as $row)
									@if($row->status==3)
										<h6><strong>{{$row->job_title}}</strong></h6>
										<small>{{$row->service_required}}</small><br><br>
										<small>₹ {{$row->amount}}</small>
									<hr>
									@endif
									@endforeach
								</div>
							  <div id="jobs_inprogress" class="tab-pane fade">
								<!--<h3>Jobs InProgress</h3>-->
									@foreach($client_jobs as $row)
									@if($row->status==1 or $row->status==2)
										<h6><strong>{{$row->job_title}}</strong></h6>
										<small>{{$row->service_required}}</small><br><br>
										<small>₹ {{$row->amount}}</small>
									<hr>
									@endif
									@endforeach
							  </div>
							</div>
							
						    <!--<div class="table-responsive">
                                    <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
                                        <thead>
                                                <th>Job Detail</th>
                                                <th>Amount</th>
                                                <th>Expected Days</th>
                                                <th>Proposal Status</th>
                                                <th>Payment Status</th>
                                           
                                        </thead>
                                        <tbody>                                  
                                            @foreach($client_jobs as $row)
                                        <tr>
                                            <td>
                                                <h6>{{$row->job_title}}</h6>
                                                <small>{{$row->service_required}}</small>
                                            </td>
                                            <td>₹ {{$row->amount}}</td>
                                            <td>{{$row->expected_days}}</td>
                                            
                                            <td>
											@if($row->proposal_status==1)
                                                <span class="badge badge-pill badge-success">Accepted</span>
                                                @elseif($row->proposal_status==2)
                                                <span class="badge badge-pill badge-warning">Declined</span>
                                                @elseif($row->proposal_status==0)
                                                <span class="badge badge-pill badge-primary">Pending</span>
                                                @endif
											@if($row->status==3)
                                                <span class="badge badge-pill badge-success">Completed</span>
                                                @elseif($row->status==1)
                                                <span class="badge badge-pill badge-primary">InProgress</span>
												@elseif($row->status==2)
                                                <span class="badge badge-pill badge-primary">InReview</span>
                                                @endif
												
                                              
                                            </td>
                                            <td>
                                              @if($row->payment_status == 1 and $row->status==3)
                                                Paid
                                              @else
                                                Pending
                                              @endif    

                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <th>Job Detail</th>
                                            <th>Amount</th>
                                            <th>Expected Days</th>
                                            <th>Proposal Status</th>
                                            <th>Payment Status</th>
                                        </tfoot>
                                    </table>
                                </div>-->
                           </div>	
						</div>
</div>
</div>
@stop
