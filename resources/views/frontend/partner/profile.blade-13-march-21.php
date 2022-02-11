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
	.table tr {
    transition: background 0.2s ease-in;
}

.table tr:nth-child(even) {
    background: silver;
}

</style>

<div class="container">
 <div class="row header">
    <div class="col-xs-12 text-center">
      	  <h1>Freelanceer</h1>
    </div>
  </div>
 
	<div class="row" style="font: 17px/20px normal Helvetica, Arial, sans-serif;">
                        <div class="col-md-4">
                           <div class="card ">
                              <div class="card-header white">
                                  <strong> Partner Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Name</strong> <span class="float-right s-12">{{$data['name']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Mobile No</strong> <span class="float-right s-12">{{$data['mobile']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Email</strong> <span class="float-right s-12">{{$data['email']}}</span></li>
                                </ul>
                           </div>
                        </div>
						<div class="col-md-4">
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
                        </div>
                        <div class="col-md-4">
                           <div class="card ">
                              <div class="card-header white">
                                  <strong> Partner Service Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Service Offered</strong>
                                  <span class="float-right s-12">{{$data['service_offered']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Experince</strong> <span class="float-right s-12">{{$data['professional_experience']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> City</strong> <span class="float-right s-12">{{$data['city']}}</span></li>
                                </ul>
                           </div>
						</div>
						<hr>
						
						<div class="col-md-4">
                           <div class="card ">
                              <div class="card-header white">
                                  <strong> Job History </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Total Jobs</strong>
                                  <span class="float-right s-12">{{$total_jobs}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Ongoing Jobs</strong> <span class="float-right s-12">{{$ongoing_jobs}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Completed</strong> <span class="float-right s-12">{{$completed_jobs}}</span></li>
                                </ul>
                           </div>
						</div>
					


</div>
<div class="row" style="font: 17px/20px normal Helvetica, Arial, sans-serif;">
						<div class="col-md-12">
                           <div class="card ">
                              <div class="card-header white">
                                  <strong> Work History </strong>
                              </div>
                                                               <div class="table-responsive">
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
                                </div>
                           </div>
						</div>	

</div>
</div>

<div class="page has-sidebar-left">
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
                   <div class="row">
                        <div class="col-md-4">
                           <div class="card ">
                              <div class="card-header white">
                                  <strong> Partner Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Name</strong> <span class="float-right s-12">{{$data['name']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Mobile No</strong> <span class="float-right s-12">{{$data['mobile']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Email</strong> <span class="float-right s-12">{{$data['email']}}</span></li>
                                </ul>
                           </div>
                        </div>
                        <div class="col-md-4">
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
                        </div>
                        <div class="col-md-4">
                           <div class="card ">
                              <div class="card-header white">
                                  <strong> Partner Service Detail </strong>
                              </div>
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Service Offered</strong>
                                  <span class="float-right s-12">{{$data['service_offered']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Experince</strong> <span class="float-right s-12">{{$data['professional_experience']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> City</strong> <span class="float-right s-12">{{$data['city']}}</span></li>
                                </ul>
                           </div>
                        </div>
                        <div class="col-md-12 pt-3 pb-3">
                          <div class="row">
                            
                            <div class="col-lg-4">
                               <div class="card r-3">
                                   <div class="p-4">
                                       <div class="float-right">
                                           <span class="icon-award text-light-blue s-48"></span>
                                       </div>
                                       <div class="counter-title">Total Leads</div>
                                       <h5 class="sc-counter mt-3 ">{{$total_jobs}}</h5>
                                   </div>
                               </div>
                            </div>
                            <div class="col-lg-4">
                               <div class="card r-3">
                                   <div class="p-4">
                                       <div class="float-right"><span class="icon-stop-watch3 s-48"></span>
                                       </div>
                                       <div class="counter-title ">Ongoing Job</div>
                                       <h5 class="sc-counter mt-3">{{$ongoing_jobs}}</h5>
                                   </div>
                               </div>
                            </div>
                            <div class="col-lg-4">
                               <div class="white card">
                                   <div class="p-4">
                                       <div class="float-right"><span class="icon-orders s-48"></span>
                                       </div>
                                       <div class="counter-title">Completed Job</div>
                                       <h5 class="sc-counter mt-3">{{$completed_jobs}}</h5>
                                   </div>
                               </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-12 pt-3 pb-3">
                           <div class="card no-b shadow">
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
                                        <thead>
                                            <tr>
                                                <th>Job Detail</th>
                                                <th>Amount</th>
                                                <th>Expected Days</th>
                                                <th>Proposal Status</th>
                                                <th>Payment Status</th>
                                            </tr>
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
                                </div>
                            </div>
                        </div>
                      </div>
                    </div>
           
        </div>
    </div>
</div>
@stop
