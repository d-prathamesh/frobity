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
                    @if(count($data)>0)
                    <div class="card no-b shadow">
                        <div class="card-body">
                            @include('admin/error')
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile Number</th>
                                            <th>Device</th>
                                            <th>Jobs</th>
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
                                        <td>{{$row['device_type']}}</td>
                                        <td>
                                            <a href="{{route('client_jobs',['id'=>$row['id']])}}" class="btn btn-primary btn-xs">See Jobs</a>
                                        </td>
                                        <td>
                                            {{-- <a href="#" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a> --}}
                                            <a href="{{route('admin_client_view_profile',['id'=>$row['id']])}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-eye"></i></a>
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
                                            <th>Jobs</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    @else
                        <div class="text-center p-5">
                            <i class="icon-note-important s-64 text-primary"></i>
                            <h4 class="my-3">No Records Found</h4>
                            <a href="{{route('dashboard')}}" class="btn btn-primary shadow btn-lg"><i class="icon-plus-circle mr-2 "></i>Go to Dashboard</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection