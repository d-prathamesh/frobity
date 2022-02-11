@extends('admin.admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Partner List 
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
                            @include('admin.error')
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Membership Detail</th>
                                            <th>Service offered</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                  
                                        @foreach($data as $row)
                                    <tr>
                                        <td>
                                            <h6>{{$row['name']}}</h6>
                                        </td>
                                        <td>{{$row['email']}}</td>
                                        <td>{{$row['mobile']}}</td>
                                        <td>
                                            <p>
                                                <b>Id : </b>{{$row['member_id']}}
                                                </br>
                                                <b>Status : </b>{{$row['member_id_status']}}
                                            </p>
                                        </td>
                                        <td>{{$row['service_offered']}}</td>
                                        <td>
                                            <a href="#" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                            <a href="#" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Device</th>
                                            <th>Service offered</th>
                                            <th>Action</th>
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