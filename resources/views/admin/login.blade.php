@extends('admin.login_header')
@section('content')
<main>
    <div id="primary" class="p-t-b-100 height-full">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mx-md-auto paper-card">
                    <div class="text-center">
                        <img src="assets/img/dummy/u4.png" alt="">
                        <h3 class="mt-2">Welcome {{session('admin_data')['name'] }}</h3>
                        <p class="p-t-b-20"></p>
                    </div>
					
                    @include('admin.error');
					
                    <form action="{{route('admin_login')}}" id="reg-form" method="post">
                        <input type="hidden" value="{{ csrf_token() }}" name="_token">
                        <div class="form-group has-icon"><i class="icon-mail"></i>
                            <input type="text" class="form-control form-control-lg" name="email" id="email" placeholder="Your email">
                        </div>
                        
                        <div class="form-group has-icon"><i class="icon-user-secret"></i>
                            <input type="text" class="form-control form-control-lg" name="password" id="password" placeholder="Your password">
                        </div>
						
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Log In</button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #primary -->
</main>

@endsection
