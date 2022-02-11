@extends('admin/admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Client Detail 
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort go">
           <div class="tab-content" id="v-pills-tabContent">
               <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <div class="row">
                        <div class="col-md-4">
                           <div class="card ">
                               <ul class="list-group list-group-flush">
                                  <li class="list-group-item"><i class="icon-home2"></i> <strong class="s-12"> Name</strong> <span class="float-right s-12">{{$data['name']}}</span></li>
                                   <li class="list-group-item"><i class="icon-phone_android"></i><strong class="s-12"> Mobile No</strong> <span class="float-right s-12">{{$data['mobile']}}</span></li>
                                   <li class="list-group-item"><i class="icon-envelope-o"></i><strong class="s-12"> Email</strong> <span class="float-right s-12">{{$data['email']}}</span></li>
                                </ul>
                           </div>
                        </div>
                        <div class="col-md-8">
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
                                                <th>Job Tittle</th>
                                                <th>City</th>         
                                                <th>Service Type</th>
                                                <th>Service Required</th>
                                                <th>Query</th>
                                                <th>status</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>                                  
                                            @foreach($client_jobs as $row)
                                        <tr>
                                            <td>
                                                <h6>{{$row['job_title']}}</h6>
                                            </td>
                                            <td>{{$row['city']}}</td>
                                            <td>@if($row['service_type']==1)
                                                Charted Accountant
                                                @elseif($row['service_type']==2)
                                                Company Secretary
                                                @elseif($row['service_type']==3)
                                                Accountant
                                                @elseif($row['service_type']==4)
                                                Forms/Return Filling
                                                @elseif($row['service_type']==5)
                                                Registration Services
                                                @endif
                                            </td>
                                            <td>{{$row['service_required']}}</td>
                                            <td>{{$row['query']}}</td>
                                            <td>
                                                @if($row['status']==0)
                                                <span class="badge badge-pill badge-success">Open</span>
                                                @elseif($row['status']==1)
                                                <span class="badge badge-pill badge-warning">InProgress</span>
                                                @elseif($row['status']==2)
                                               <span class="badge badge-pill badge-secondary">UnderReview</span>
                                                @elseif($row['status']==3)
                                                <span class="badge badge-pill badge-primary">Completed</span>
                                                @elseif($row['status']==4)
                                                <span class="badge badge-pill badge-danger">Cancelled</span>
                                                @endif
                                            </td>
                                            
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Job Tittle</th>
                                                <th>City</th>         
                                                <th>Service Type</th>
                                                <th>Service Required</th>
                                                <th>status</th>
                                                <th>Action</th>
                                            </tr>
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
    </div>
</div>
@endsection