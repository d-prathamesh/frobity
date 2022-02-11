@extends('admin/admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Completed Job List 
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
                                            <th>Client</th>
                                            <th>Job Title</th>
                                            <th>Service Type</th>
                                            <th>Partner</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                      @foreach($data as $row)
                                        <tr>
                                            <td>{{$row->jobclient->name}}</td>
                                            <td>{{$row->job_title}}</td>
                                            <td>{{$row->jobservice->name}}</td>
                                           <td>{{$row->jobapplication[0]->jobpartner->name}}</td>
                                           <td>{{$row->jobapplication[0]->amount}}</td>
                                         </tr>
                                       @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Client</th>
                                            <th>Job Title</th>
                                            <th>Service Type</th>
                                            <th>Partner</th>
                                            <th>Amount</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            {{-- <nav class="pt-3" aria-label="Page navigation">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> --}}
        </div>
    </div>
</div>

@endsection