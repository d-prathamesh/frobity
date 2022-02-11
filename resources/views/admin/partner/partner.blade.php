@extends('admin/admin_header')
@section('content')
<style type="text/css">
    ul.btn-actions li{ display: inline; }
</style>
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Partner List 
                    </h4>
                    <div class="row p-t-b-10 ">
                        <div class="col-md-4">
                            <select onchange="window.location.href='/admin/partner/get_filter_partner/'+this.value" class="form-control form-control-sm">
                                <option value="">All</option>
                                <option {{ isset($service_type) &&  $service_type == 1 ? 'selected':'' }} value="1">Chartered Accountant</option>
                                <option {{ isset($service_type) &&  $service_type == 2 ? 'selected':'' }}  value="2">Company Secretary</option>
                                <option {{ isset($service_type) &&  $service_type == 3 ? 'selected':'' }}  value="3">Accountant</option>
                                <option {{ isset($service_type) &&  $service_type == 4 ? 'selected':'' }}  value="4">Form/Return Filling</option>
                                <option {{ isset($service_type) &&  $service_type == 5 ? 'selected':'' }}  value="5">registration Services</option>
                            </select>
                        </div>
                        @if(isset($service_type) &&  $service_type == 1)
                        <div class="col-md-8">
                            <ul class="btn-actions" style="display: block;">
                            <!--<li><a href="https://hirebunny.com/admin/partner/get_filter_partner/1/Unverified" class="btn btn-danger"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="https://hirebunny.com/admin/partner/get_filter_partner/1/Verification%20Failed"  class="btn btn-warning"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="https://hirebunny.com/admin/partner/get_filter_partner/1/Verified"  class="btn btn-success"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>-->
							<li><a href="https://frobity.com/admin/partner/get_filter_partner/1/Unverified" class="btn btn-danger"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="https://frobity.com/admin/partner/get_filter_partner/1/Verification%20Failed"  class="btn btn-warning"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="https://frobity.com/admin/partner/get_filter_partner/1/Verified"  class="btn btn-success"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                        </div>
                        @endif
                    </div>
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
                                            <th>Partner Detail</th>
                                            <th>Membership Detail</th>
                                            <th>Service Type</th>
                                            <th>Service offered</th>
                                            <th>Bank Detail</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                  
                                        @foreach($data as $row)
                                    <tr>
                                        <td>
                                            <h6>{{$row['name']}}</h6>
                                            <small>{{$row['email']}}</small>
                                        </td>
                                        <td>
                                            <p>
                                                <b>Id : </b>{{$row['member_id']}}
                                                </br>
                                                @if($row['member_id_status'] == 'Verification Failed')
                                                <span class="icon icon-circle s-12  mr-2 text-warning"></span>
                                                @elseif($row['member_id_status'] == 'Unverified')
                                                <span class="icon icon-circle s-12  mr-2 text-danger"></span>
                                                @elseif($row['member_id_status'] == 'Verified')
                                                <span class="icon icon-circle s-12  mr-2 text-success"></span>
                                                @endif
                                                {{$row['member_id_status']}}
                                            </p>
                                        </td>
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
                                            @endif</td>
                                        <td>{{$row['service_offered']}}</td>
                                        <td>
                                            @if($row['check_bank_detail_count']>0)
                                            <a href="{{route('view_bank_detail',['id'=>$row['id']])}}" class="btn btn-success btn-xs">View Detail</a>
                                            @else
                                            <a href="#" class="btn btn-danger btn-xs">Not Updated</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('edit_partner',['id'=>$row['id']])}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-pencil"></i></a>
                                            <a href="{{route('partner_view_profile',['id'=>$row['id']])}}" class="btn-fab btn-fab-sm btn-primary shadow text-white"><i class="icon-eye"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Partner Detail</th>
                                            <th>Membership Detail</th>
                                            <th>Service Type</th>
                                            <th>Service offered</th>
                                            <th>Bank Detail</th>
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