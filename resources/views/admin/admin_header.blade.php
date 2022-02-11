<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('assets/img/basic/logo.png')}}" type="image/x-icon">
    <title>Admin Panel - Fineagle</title>
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <style>
        .loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #F5F8FA;
            z-index: 9998;
            text-align: center;
        }

        .plane-container {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
      <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>
</head>
<body class="light">
<!-- Pre loader -->
<div id="loader" class="loader">
    <div class="plane-container">
        <div class="preloader-wrapper small active">
            <div class="spinner-layer spinner-blue">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-yellow">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>

            <div class="spinner-layer spinner-green">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                <div class="circle"></div>
            </div><div class="circle-clipper right">
                <div class="circle"></div>
            </div>
            </div>
        </div>
    </div>
</div>
<div id="app">
<aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
    <section class="sidebar">
        <div class="w-100px mt-3 mb-3 ml-3">
            <img src="{{asset('assets/img/basic/logo.png')}}" alt="">
        </div>
        <div class="relative">
            <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
               aria-controls="userSettingsCollapse" class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                <i class="icon icon-cogs"></i>
            </a>
            <div class="user-panel p-3 light mb-2">
                <div>
                    <div class="float-left image">
                        <img class="user_avatar" src="{{asset('assets/img/dummy/u2.png')}}" alt="User Image">
                    </div>
                    <div class="float-left info">
                        <h6 class="font-weight-light mt-2 mb-1">Fineagle Admin</h6>
                        <a href="#"><i class="icon-circle text-primary blink"></i> Online</a>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="collapse multi-collapse" id="userSettingsCollapse">
                    <div class="list-group mt-3 shadow">
                        <a href="index.html" class="list-group-item list-group-item-action ">
                            <i class="mr-2 icon-umbrella text-blue"></i>Profile
                        </a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-cogs text-yellow"></i>Settings</a>
                        <a href="#" class="list-group-item list-group-item-action"><i
                                class="mr-2 icon-security text-purple"></i>Change Password</a>
                    </div>
                </div>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header"><strong>MAIN NAVIGATION</strong></li>
             <li class="treeview"><a href="{{route('cms')}}">
                <i class="icon icon-dashboard s-18"></i> <span>CMS</span> </a>                
            </li>
			<li class="treeview"><a href="{{route('dashboard')}}">
                <i class="icon icon-dashboard s-18"></i> <span>Dashboard</span> </a>                
            </li>
           
            
            <li class="treeview"><a href="{{route('get_client')}}">
                <i class="icon icon-users s-18"></i> <span>Client List</span> </a>
            </li>
            <li class="treeview"><a href="{{route('get_partner')}}">
                <i class="icon icon-users s-18"></i> <span>Partner List</span> </a>
            </li>
             <!--li class="treeview">
                <a href="#">
                    <i class="icon icon-handshake-o s-18"></i> <span>Accounting Partners</span>
                    <i class=" icon-angle-left  pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-hand-o-right s-18"></i>Charted Accountant<i class=" icon-angle-left  pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('get_filter_partner',['service_type'=>1,'member_id_status'=>'Unverified'])}}"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>1,'member_id_status'=>'Verification Failed'])}}"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>1,'member_id_status'=>'Verified'])}}"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-hand-o-right s-18"></i>Company Secretary<i class=" icon-angle-left  pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('get_filter_partner',['service_type'=>2,'member_id_status'=>'Unverified'])}}"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>2,'member_id_status'=>'Verification Failed'])}}"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>2,'member_id_status'=>'Verified'])}}"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-hand-o-right s-18"></i>Accountant<i class=" icon-angle-left  pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('get_filter_partner',['service_type'=>3,'member_id_status'=>'Unverified'])}}"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>3,'member_id_status'=>'Verification Failed'])}}"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>3,'member_id_status'=>'Verified'])}}"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-hand-o-right s-18"></i>Forms/Return Filling<i class=" icon-angle-left  pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('get_filter_partner',['service_type'=>4,'member_id_status'=>'Unverified'])}}"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>4,'member_id_status'=>'Verification Failed'])}}"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>4,'member_id_status'=>'Verified'])}}"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-hand-o-right s-18"></i>Registration Services<i class=" icon-angle-left  pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('get_filter_partner',['service_type'=>5,'member_id_status'=>'Unverified'])}}"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>5,'member_id_status'=>'Verification Failed'])}}"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>5,'member_id_status'=>'Verified'])}}"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="treeview-menu">
                    <li><a href="#"><i class="icon icon-hand-o-right s-18"></i>Registration Services<i class=" icon-angle-left  pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('get_filter_partner',['service_type'=>5,'member_id_status'=>'Unverified'])}}"><i class="icon icon-cancel text-danger s-14"></i>Unverified</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>5,'member_id_status'=>'Verification Failed'])}}"><i class="icon icon-cancel text-warning s-14"></i>Verification Failed</a>
                            </li>
                            <li><a href="{{route('get_filter_partner',['service_type'=>5,'member_id_status'=>'Verified'])}}"><i class="icon icon-verified_user text-green s-14"></i>Verified</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                                
            </li>
            <li class="treeview">
                <a href="javascript:void(0);">
                    <i class="icon icon-handshake-o s-18"></i> <span>Other Partners</span>
                   <i class=" icon-angle-left  pull-right"></i>
                </a> 
               
                 <ul class="treeview-menu">
                    <li><a href="{{route('others',['member_id_status'=>'Unverified'])}}">
                    <i class="icon icon-briefcase s-14"></i>Unverified</a>
                    <li><a href="{{route('others',['member_id_status'=>'Verification Failed'])}}">
                    <i class="icon icon-briefcase s-14"></i>Verification Failed</a>
                    </li>
                    <li><a href="{{route('others',['member_id_status'=>'Verified'])}}">
                    <i class="icon icon-briefcase s-14"></i>Verified</a>
                    </li>
                </ul> 
               
            </li-->
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-briefcase s-18"></i> <span>Jobs</span>
                    <i class=" icon-angle-left  pull-right"></i>
                </a>
                 <ul class="treeview-menu">
                    <li><a href="{{route('transfer_pending_jobs')}}">
                    <i class="icon icon-briefcase s-14"></i>Transfer Pending Jobs</a>
                    
                    <li><a href="{{route('completed_jobs')}}">
                    <i class="icon icon-briefcase s-14"></i>Completed Jobs</a>
                    </li>
                    <li><a href="{{route('inprogress_jobs')}}">
                    <i class="icon icon-briefcase s-14"></i>On-Going Jobs</a>
                    </li>
                     <li><a href="{{route('open_jobs')}}">
                    <i class="icon icon-briefcase s-14"></i>Open Jobs</a>
                    </li>
					 <li><a href="{{route('refunded_jobs')}}">
                    <i class="icon icon-briefcase s-14"></i>Refunded Jobs</a>
                    </li>
                    
                </ul> 
               
            </li>
        </ul>
    </section>
</aside>
<!--Sidebar End-->
<div class="has-sidebar-left">
    <div class="sticky">
        <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
            <div class="relative">
                <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                    <i></i>
                </a>
            </div>
            <!--Top Menu Start -->
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">        
        <!-- User Account-->
        <li class="dropdown custom-dropdown user user-menu ">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <img src="{{asset('assets/img/dummy/u8.png')}}" class="user-image" alt="User Image">
                <i class="icon-more_vert "></i>
            </a>
            <div class="dropdown-menu p-4 dropdown-menu-right">
                <div class="row box justify-content-between my-4">
                    <div class="col">
                        <a href="{{route('admin_logout')}}">
                            <i class="icon-apps purple lighten-2 avatar  r-5"></i>
                            <div class="pt-1">Logout</div>
                        </a>
                    </div>
                  
            </div>
        </li>
    </ul>
</div>
        </div>
    </div>
</div>
@yield('content')
<aside class="control-sidebar fixed white ">
    <div class="slimScroll">
        <div class="sidebar-header">
            <h4>Activity List</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-3">
            <div>
                <div class="my-3">
                    <small>25% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%;" aria-valuenow="25"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>45% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>60% Complete</small>
                    `
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%;" aria-valuenow="60"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>75% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="my-3">
                    <small>100% Complete</small>
                    <div class="progress" style="height: 3px;">
                        <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="100"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3 bg-primary text-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="font-weight-normal s-14">Sodium</h5>
                    <span class="font-weight-lighter text-primary">Spark Bar</span>
                    <div> Oxygen
                        <span class="text-primary">
                                                    <i class="icon icon-arrow_downward"></i> 67%</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <canvas width="100" height="70" data-chart="spark" data-chart-type="bar"
                            data-dataset="[[28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100,28,68,41,43,96,45,100]]"
                            data-labels="['a','b','c','d','e','f','g','h','i','j','k','l','m','n','a','b','c','d','e','f','g','h','i','j','k','l','m','n']">
                    </canvas>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="recent-orders" class="table table-hover mb-0 ps-container ps-theme-default">
                <tbody>
                <tr>
                    <td>
                        <a href="#">INV-281281</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 1228.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-01112</a>
                    </td>
                    <td>
                        <span class="badge badge-warning">Overdue</span>
                    </td>
                    <td>$ 5685.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-281012</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 152.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-01112</a>
                    </td>
                    <td>
                        <span class="badge badge-warning">Overdue</span>
                    </td>
                    <td>$ 5685.28</td>
                </tr>
                <tr>
                    <td>
                        <a href="#">INV-281012</a>
                    </td>
                    <td>
                        <span class="badge badge-success">Paid</span>
                    </td>
                    <td>$ 152.28</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="sidebar-header">
            <h4>Activity</h4>
            <a href="#" data-toggle="control-sidebar" class="paper-nav-toggle  active"><i></i></a>
        </div>
        <div class="p-4">
            <div class="activity-item activity-primary">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 5 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet conse ctetur which ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-danger">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 8 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit ametcon the sectetur that ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-success">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 10 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet cons the ecte tur and adip ascing elit users.</p>
                </div>
            </div>
            <div class="activity-item activity-warning">
                <div class="activity-content">
                    <small class="text-muted">
                        <i class="icon icon-user position-left"></i> 12 mins ago
                    </small>
                    <p>Lorem ipsum dolor sit amet consec tetur adip ascing elit users.</p>
                </div>
            </div>
        </div>
    </div>
</aside>
<!-- /.right-sidebar -->
<!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
<div class="control-sidebar-bg shadow white fixed"></div>
</div>
<!--/#app -->
<script src="{{asset('assets/js/app.js')}}"></script>
<!--
--- Footer Part - Use Jquery anywhere at page.
--- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
-->
<script>(function($,d){$.each(readyQ,function(i,f){$(f)});$.each(bindReadyQ,function(i,f){$(d).bind("ready",f)})})(jQuery,document)</script>
</body>
</html>