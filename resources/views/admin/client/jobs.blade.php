@extends('admin/admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Client List 
                    </h4>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <div class="row">
                <div class="col-md-12">
                    <div class="card no-b shadow">
                        <div class="card-body">
                            @include('admin/error')
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
                                        @foreach($data as $row)
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
@endsection