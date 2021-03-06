<!DOCTYPE html>
<html lang="en">
  <head>

	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Frobity | Freelacing plateform</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Add your business website description here">
        <meta name="keywords" content="Add your, business, website, keywords, here">
        <meta name="author" content="Add your business, website, author here">
		
		<!-- ==============================================
		Favicons
		=============================================== --> 
		<link rel="icon" href="{{ asset('assets/img/logo.png') }}">
		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
		
	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link type="text/css" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="{{ asset('assets/js/modernizr-custom.js') }}"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->	
		
  </head>

  <body>

     <!-- ==============================================
     Navigation Section
     =============================================== -->  
      <nav class="navbar navbar-default navbar-fixed-top">
       <div class="container">
	    <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		 </button>
		 <a class="navbar-brand" href="{{ route('web.client.dashboard') }}"><img src="{{ asset('assets/img/logo.png') }}" style="height: 18px; float: left;   margin-right: 10px;"/>Frobity</a>
		</div><!-- /.navbar-header -->
		<div class="navbar-left">
		 <div class="collapse navbar-collapse" id="navbar-collapse">
		  <!--<ul class="nav navbar-nav">
		   <li><a href="hire.html">GoHire</a></li>
		   <li><a href="work.html">GoWork</a></li>
		   <li><a href="pricing.html">Pricing</a></li>
		   <li><a href="how.html">How it works</a></li>
		  </ul>-->
		 </div>
		</div><!-- /.navbar-left -->
		<div class="navbar-right">                          
		 <ul class="nav navbar-nav">
		 	<li class="topnav-notifications"><i class="fa fa-envelope fa-2x dropdown-toggle"  data-toggle="dropdown" aria-expanded="true"></i>
			  <div class="dropdown-menu w dropdown-menu-scale pull-right" style="width:275px; max-height:400px; scroll:auto;">
				<a class="dropdown-item" href="#">No new Messages</a>		   
			  </div>
		 	</li>
			
		 	<style>
			span.icon_no {
				background: red;
				color: #fff;
				border-radius: 50%;
/*				padding: 0px 0px 0px 4px;
				height: 20px;
				width: 15px;
				font-size: 10px;*/
				position: absolute;
				bottom: 10px;
				right: 0;
			}
			#notification-list li{
			padding: 5px;
			}
			ul#notification-list {
			padding: 5px;
			}
			</style>
		 	<li class="topnav-notifications"><i class="fa fa-bell fa-2x dropdown-toggle" onclick="ShowNotification()"  data-toggle="dropdown" aria-expanded="true"><span class="icon_no badge badge-light dropdown-toggle" style="cursor:pointer"></span></i>

			  
			  <div  class="dropdown-menu w dropdown-menu-scale pull-right" style="width:275px;">
			  <div class="no-notification" style="padding:9px;">No new Notifications</div>
			  		<ul id="notification-list" style="overflow-y:auto;overflow-x:hidden;width:auto; max-height:400px;">
			  			
			  		</ul>
			  		<ul id="notification-list" style="width:auto;">
						<li><a href="{{ route('web.getclient.notifications') }}">Show all notifications</a></li>
			  		</ul>

						
			  </div>

		 	</li><li class="dropdown mega-avatar active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		   <span class="avatar w-32"><img src="{{ session('client')['image'] }}" onError="this.onerror=null;this.src='/assets/img/default-user.svg';" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
		   <!-- hidden-xs hides the username on small devices so only the image appears. -->
		   <span>
			{{ session('client')['name'] }}
		   </span>
		  </a>
			<div class="dropdown-menu w dropdown-menu-scale pull-right">
		   
				<a class="dropdown-item" href="{{ route('web.logout',['type'=>'client'])}}">Sign out</a>
			 </div>
		 </li><!-- /navbar-item -->	
		 
		 </ul><!-- /.sign-in -->   
		 <!--<a href="addjob.html" class="kafe-btn kafe-btn-mint-small">Post a Job</a>-->
		</div><!-- /.nav-right -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     <header class="header-jobs">
      <div class="container">
	   <div class="content">
        <div class="row">
	     <h1 class="revealOnScroll animated fadeInDown" data-animation="fadeInDown"><i class="fa {{ isset($icon_class)? $icon_class : 'fa-dashboard' }}"></i> {{ isset($page_h1)? $page_h1 : 'Dashboard' }}</h1>
		 <p></p>
        </div><!-- /.row -->
       </div><!-- /.content -->
	  </div><!-- /.container -->
     </header>
     <?php /*     
     <header class="tr-header">
      <nav class="navbar navbar-default">
       <div class="container-fluid">
	    <div class="navbar-header">
		 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		  <span class="sr-only">Toggle navigation</span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		 </button>
		 <a class="navbar-brand" href="{{ route('web.client.dashboard') }}"><img src="{{ asset('assets/img/logo2.png') }}" style="width:200px"/></a>
		</div><!-- /.navbar-header -->
		<div class="navbar-left">
		 <div class="collapse navbar-collapse" id="navbar-collapse">
		  <!--<ul class="nav navbar-nav">
		   <li><a href="hire.html">GoHire</a></li>
		   <li><a href="work.html">GoWork</a></li>
		   <li><a href="pricing.html">Pricing</a></li>
		   <li><a href="how.html">How it works</a></li>
		  </ul>-->
		 </div>
		</div><!-- /.navbar-left -->
		<div class="navbar-right">                          
		 <ul class="nav navbar-nav">
		 	<li class="topnav-notifications"><i class="fa fa-envelope fa-2x dropdown-toggle"  data-toggle="dropdown" aria-expanded="true"></i>
		  <div class="dropdown-menu w dropdown-menu-scale pull-right">
			<a class="dropdown-item" href="#">No new Messages</a>		   
		  </div>
		 	</li> 
		 	<li class="topnav-notifications"><i class="fa fa-bell fa-2x dropdown-toggle"  data-toggle="dropdown" aria-expanded="true"></i>
			  <div class="dropdown-menu w dropdown-menu-scale pull-right">
				<a class="dropdown-item" href="#">No new Notifications</a>		   
			  </div>

		 	</li> 
		 <li class="dropdown mega-avatar active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		   <span class="avatar w-32"><img src="{{ session('client')['image'] }}" onError="this.onerror=null;this.src='/assets/img/default-user.svg';" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
		   <!-- hidden-xs hides the username on small devices so only the image appears. -->
		   <span>
			{{ session('client')['name'] }}
		   </span>
		  </a>
		  <div class="dropdown-menu w dropdown-menu-scale pull-right">
		   
		   <a class="dropdown-item" href="{{ route('web.logout',['type'=>'client'])}}">Sign out</a>
		  </div>
		 </li><!-- /navbar-item -->	
		 
		 </ul><!-- /.sign-in -->   
		 <!--<a href="addjob.html" class="kafe-btn kafe-btn-mint-small">Post a Job</a>-->
		</div><!-- /.nav-right -->
       </div><!-- /.container -->
      </nav><!-- /.navbar -->
     </header><!-- Page Header --> 
	
*/ ?>
     <!-- ==============================================
	 Dashboard Section
	 =============================================== -->
     <section class="dashboard">
	  <div class="container-fluid">
	   <div class="row">
	   
	    <div class="col-sm-4 col-md-4">
		  <ul class="sidebar-menu" data-widget="tree">
			<li class="{{ Session::get('currentRoute') == 'web.client.dashboard' ? 'active' : ''}}">
			  <a href="{{ route('web.client.dashboard') }}">
				<i class="fa fa-life-ring"></i> <span>Dashboard</span>
			  </a>
			</li>
			<li 
			class="{{ in_array(Session::get('currentRoute'),['web.client.get.new.job.step1','web.client.get.new.job.step2']) ? 'active' : ''}}"
			><a href="{{ route('web.client.get.new.job.step1') }}"><i class="fa fa-files-o"></i> Post new job</a></li>
			<li class="{{ Session::get('currentRoute') == 'web.client.posted.jobs' ? 'active' : ''}}"
			><a href="{{ route('web.client.posted.jobs') }}"><i class="fa fa-list"></i> Posted jobs</a></li>
	
			<li class="{{ Session::get('currentRoute') == 'web.client.ongoing.jobs' ? 'active' : ''}}">
			  <a href="{{ route('web.client.ongoing.jobs') }}">
				<i class="fa fa-align-left"></i> <span>On Going</span>
			  </a>
			</li>
			<li class="{{ Session::get('currentRoute') == 'web.client.completed.jobs' ? 'active' : ''}}">
					<a href="{{ route('web.client.completed.jobs') }}">
					<i class="fa fa-check-square-o"></i> <span>Completed Jobs</span>
					</a>
				</li>
			
		
			<li class="{{ Session::get('currentRoute') == 'web.client.posted.jobs.proposals' ? 'active' : ''}}" >
			  <a href="{{ route('web.client.posted.jobs.proposals') }}">
				<i class="fa fa-clone"></i> <span>Proposals</span>
				
			  </a>
		
			</li>
			
			<li class="{{ Session::get('currentRoute') == 'web.client.refunded.jobs' ? 'active' : ''}}" >
			  <a href="{{ route('web.client.refunded.jobs') }}">
				<i class="fa fa-clone"></i> <span>Refunded Jobs</span>
				
			  </a>
		
			</li>
		
			<!--<li>
			  <a href="messages.html">
				<i class="fa fa-envelope"></i> <span>Messages</span>
				<span class="pull-right-container">
				  <small class="label pull-right bg-green">4</small>
				</span>
			  </a>
			</li>-->
		 </ul>	

		<ul class="sidebar-menu" data-widget="tree">
			<li class="{{ Session::get('currentRoute') == 'web.client.setting.profile' ? 'active' : ''}}">
			  <a href="{{ route('web.client.setting.profile') }}">
				<i class="fa fa-user"></i> <span>Edit Profile</span>
			  </a>
			</li>
	
		 </ul>	

		 
		
		  <!--<ul class="sidebar-menu" data-widget="tree">
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-exchange"></i> <span>Wallet</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="deposits.html"><i class="fa fa-circle-o"></i> Deposits</a></li>
				<li><a href="withdrawals.html"><i class="fa fa-circle-o"></i> Withdrawals</a></li>
			  </ul>
			</li>
			<li>
			  <a href="payment_method.html">
				<i class="fa fa-dot-circle-o"></i> <span>Payment Method</span>
			  </a>
			</li>
			<li>
			  <a href="membership.html">
				<i class="fa fa-credit-card"></i> <span>Membership</span>
			  </a>
			</li>
		 </ul>	
		 
		  <ul class="sidebar-menu" data-widget="tree">
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-external-link-square"></i> <span>Feature a Job</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="featured_job_list.html"><i class="fa fa-circle-o"></i> Jobs Featured List</a></li>
				<li><a href="feature_a_job.html"><i class="fa fa-circle-o"></i> Feature a Job</a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-external-link-square"></i> <span>Feature a Profile</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="featured_profiles.html"><i class="fa fa-circle-o"></i> Profile Featured List</a></li>
				<li><a href="feature_your_profile.html"><i class="fa fa-circle-o"></i> Feature your Profile </a></li>
			  </ul>
			</li>
			<li class="treeview">
			  <a href="#">
				<i class="fa fa-external-link-square"></i> <span>Feature a Company</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
			  </a>
			  <ul class="treeview-menu">
				<li><a href="featured_companies.html"><i class="fa fa-circle-o"></i> Companies Featured List</a></li>
				<li><a href="feature_your_company.html"><i class="fa fa-circle-o"></i> Feature your Companies </a></li>
			  </ul>
			</li>
		 </ul>-->
		
		 			 
		       		
	    </div>
		
	    <div class="col-sm-8 col-md-8">
				@if(Session::has('errorMessage'))
				<div class="alert alert-danger alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('errorMessage') }}
				</div>
				@endif
				@if(Session::has('successMessage'))
				<div class="alert alert-success alert-dismissible">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					{{ Session::get('successMessage') }}
				</div>
				@endif
		 	@yield('content')
		
		
	    </div><!-- /.col-md-9 -->	
	        </div><!-- /.row -->
	    </div><!-- /.container -->
	</section>	 
	 
	 
	 <!-- ==============================================
	 Footer Section
	 =============================================== -->
	
  <footer class="footerWhite">

      <!-- COPY RIGHT -->
      <div class="clearfix copyRight">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <div class="copyRightWrapper">
                <div class="row">
                  <div class="col-sm-5 col-sm-push-7 col-xs-12">
                    <ul class="list-inline socialLink">
                      <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                      <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                      <li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                      <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                  </div>
                  <div class="col-sm-7 col-sm-pull-5 col-xs-12">
                    <div class="copyRightText">
                      <p>Copyright ?? 2018. All Rights Reserved</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </footer>	
	
     <a id="scrollup">Scroll</a>
     

	 <!-- ==============================================
	 Scripts
	 =============================================== -->
     <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- DATA TABES SCRIPT -->
    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <script>
    	/*============================================
	Navigation Functions
	==============================================*/
	if ($(window).scrollTop()===0){
		$('.navbar').removeClass('scrolled');
	}
	else{
		$('.navbar').addClass('scrolled');    
	}

	$(window).scroll(function(){
		if ($(window).scrollTop()===0){
			$('.navbar').removeClass('scrolled');
		}
		else{
			$('.navbar').addClass('scrolled');    
		}
	});
/*      $(function () {
        $("#example1").dataTable();
      });*/
    </script>
	<script src="{{ asset('assets/js/app.js') }}"></script>
  @yield('scripts')
  
  <script type="text/javascript">
//		notification check 

	setTimeout( checkNotification, 2000 );
	function checkNotification(){
		$.ajax({
			url:'{{ route('web.client.notifications') }}',
			success:function( response ){
				console.log( response );
				response_json = response;//JSON.parse(response);
				newleads = response_json.new_leads;
				console.log(newleads);
				$(".icon_no").html(newleads);
				setTimeout( checkNotification, 2000 );
			}
		});
	}
	function ShowNotification(){
		//alert("show notification");
		$.ajax({
			url:'{{ route('web.client.notifications') }}',
			method: 'post',
			data:{'_token':'{{csrf_token()}}' },
			success:function( response ){
				console.log( response );
				response_json = response;//JSON.parse(response);
				newleads = response_json.result;
				console.log(newleads);
				$(".no-notification").hide();
				noti_html= '';
				for( ln in newleads ){
					noti_html = noti_html + '<li><a href='+newleads[ln]['notification_link']+'>'+newleads[ln]['notification_title']+'</a></li>';
				}
				noti_html = noti_html ;//+ '<a href="#"><li>Show ALL</li></a>';
				$("#notification-list").prepend(noti_html);
				$(".icon_no").hide();
			}
		});
	}
	
</script>
  
  </body>
</html>