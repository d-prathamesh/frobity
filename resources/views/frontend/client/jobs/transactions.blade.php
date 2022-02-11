@extends('frontend.client.layout')
@section('content')
<div class="page has-sidebar-left">
    <!--<header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Transactions List 
                    </h4>
                </div>
            </div>
        </div>
    </header>-->
	@if(!empty($transactions))
    <div class="container-fluid animatedParent animateOnce my-3">
        <div class="animated fadeInUpShort">
            <div class="row">
                <div class="col-md-12">
                    <div class="card no-b shadow">
                        <div class="card-body"><br>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover data-tables" data-options='{"searching":false}'>
                                    <thead>
                                        <tr>
                                            <th><strong>Job Title</strong></th>
                                            <th><strong>Transactions ID</strong></th>
                                            <th><strong>Amount</strong></th>
                                            <th><strong>Payment Status</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>  
											@foreach($transactions as $row)
                                        <tr>
                                            <td>{{$row['job_title']}}</td>
                                            <td>{{$row['transaction_id']}}</td>
                                           <td>{{$row['amount']}}</td>
                                           <td>
										   @if($row['payment_status']==1)
                                                <span class="badge badge-pill badge-success">Sucess</span>
                                                @elseif($row['payment_status']==-1)
                                                <span class="badge badge-pill badge-warning">Refunded</span>
                                           @endif
										   </td>
                                         </tr>
                                       @endforeach
                                    </tbody>
                                   
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
	@else
	<h3>Sorry No Data Found</h3>
	@endif
	
</div>

@endsection