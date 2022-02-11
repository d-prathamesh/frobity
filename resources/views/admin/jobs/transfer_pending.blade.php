@extends('admin/admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Transfer  Job List 
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
                                            <th>Partner</th>
                                            <th>Job Title</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>  
                                      @foreach($transfer_pending_jobs as $row)
                                        <tr>
                                            <td>
                                                <?php
                                                    $jobData = $row->get_job_detail;
                                                    $clientData = App\User::where('id',$jobData->user_id)->first();

                                                ?>

                                                {{$clientData->name}}</td>
                                            <td>{{$row->jobpartner->name}}</td>
                                            <td>{{$row->get_job_detail->job_title}}</td>
                                            <td>{{$row->amount}}</td>
                                            <td><a href="javascript:void(0);" onClick="transferPayment('<?php echo $row->id; ?>','<?php echo $row->get_job_detail->id ?>','<?php echo $row->jobpartner->account_id; ?>');" class="btn btn-xs btn-primary">Transfer amount</a></td>

                                        </tr>
                                       @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Client</th>
                                            <th>Partner</th>
                                            <th>Job Title</th>
                                            <th>Amount</th>
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
<style href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"></style>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script> 
   function transferPayment(id,job_id,account_id){
    if(!account_id) account_id = 0;
            var confirmVal = confirm('Are you sure to transfer amount');
            if(confirmVal){
                $.ajax({
                    url:'<?php echo url('admin/jobapplication/transferamount') ?>',
                    type:'POST',
                    data:{id:id,job_id:job_id,account_id:account_id,_token:'{{ csrf_token() }}'},
                    beforeSend:function(){
                        $('#loader').show();
                    },
                    success:function(response){ console.log(response);
                        if(response && response.isSuccess){
                            toastr.success('Payment transfer successful.');
                            setTimeout(function(){
                                location.reload();
                            },3000);
                            
                        }
                       
                    },
                    error:function(error){
                         $('#loader').hide();
                           toastr.success(error.responseJSON.message);
                    },
                    complete:function(data){
                         $('#loader').hide();
                    }
                })
            }
    }

</script>
@endsection