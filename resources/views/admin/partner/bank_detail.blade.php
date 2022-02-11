@extends('admin/admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Partner Bank Detail 
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
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                           <div class="card my-3 shadow no-b r-0">
                            @if(session('verify_session'))
                            <div class="card-body">
                                <div id="success" class="trd-section-tittle">
                                    @include('admin/error')
                                </div> 
                                {{-- <form method="post" action="{{route('update_bank_detail')}}"> --}}
                                  <input type="hidden" value="{{ csrf_token() }}" name="_token">  <input type="hidden" name="id" value="{{$data['id']}}">                           
                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Name</label>
                                    <input type="text" readonly="true" class="form-control r-0" id="name" name="name" value="{{$data['name']}}">
                                  </div>

                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Bank Name</label>
                                    <input type="text" readonly="true" class="form-control r-0" id="bank_name" name="bank_name" value="{{$data['bank_name']}}">
                                  </div>


                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">IFSC</label>
                                    <input type="text" readonly="true" class="form-control r-0" id="ifsc" name="ifsc" value="{{$data['ifsc']}}">
                                  </div>

                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Account Number</label>
                                    <input type="text" readonly="true" class="form-control r-0" id="acc_num" name="acc_num" value="{{$data['acc_num']}}">
                                  </div>
                                {{-- </form> --}}
                            </div>
                            @else
                            <div class="card-body">
                                <div id="success" class="trd-section-tittle">
                                    @include('admin/error')
                                </div> 
                                <form method="post" action="{{route('verify_session')}}">
                                  <input type="hidden" value="{{ csrf_token() }}" name="_token">  <input type="hidden" name="id" value="{{$data['id']}}">                           
                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Password</label>
                                    <input type="text" class="form-control r-0" id="b_pwd" name="b_pwd">
                                  </div>
                                  <input type="submit" class="btn btn-primary mt-3" name="submit" value="submit">
                                </form>
                              </div>
                              @endif
                        </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection