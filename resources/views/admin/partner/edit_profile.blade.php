@extends('admin/admin_header')
@section('content')
<div class="page has-sidebar-left">
    <header class="blue accent-3 relative">
        <div class="container-fluid text-white">
            <div class="row p-t-b-10 ">
                <div class="col">
                    <h4>
                        <i class="icon-package"></i>
                        Edit Partner Detail 
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
                            <div class="card-body">
                                <div id="success" class="trd-section-tittle">
                                    @include('admin/error')
                                </div> 
                                <form method="post" action="{{route('update_partner')}}">
                                  <input type="hidden" value="{{ csrf_token() }}" name="_token">  <input type="hidden" name="id" value="{{$data['id']}}">  

                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Subscription Id</label>
                                    <input type="text" class="form-control r-0" id="subscription_id" name="subscription_id" value="{{$data['subscription_id']}}">
                                  </div>

                                  <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Membership Id</label>
                                    <input type="text" readonly="true" class="form-control r-0" id="member_id" name="member_id" value="{{$data['member_id']}}">
                                  </div>
                                   <div class="form-group focused">
                                    <label for="exampleFormControlInput12">Account Id</label>
                                    <input type="text" class="form-control r-0" id="account_id" name="account_id" value="{{$data['account_id']}}">
                                  </div>

                                  <div class="form-group focused">
                                    <label for="exampleFormControlSelect4">Membership Status</label>
                                    <select class="form-control" id="member_id_status" name="member_id_status">
                                      <option value="Unverified" 
                                      @if($data['member_id_status'] == 'Unverified') selected 
                                      @endif
                                      >Unverified</option>
                                      <option value="Verification Failed" 
                                      @if($data['member_id_status'] == 'Verification Failed') selected 
                                      @endif
                                      >Verification Failed</option>
                                      <option value="Verified" 
                                      @if($data['member_id_status'] == 'Verified') selected 
                                      @endif
                                      >Verified</option>
                                    </select>
                                  </div>                          
                                    
                                  <input type="submit" class="btn btn-primary mt-3" name="submit" value="submit">
                                </form>
                            </div>
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