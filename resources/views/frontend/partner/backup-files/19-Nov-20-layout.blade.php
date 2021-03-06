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
        <link type="text/css" href="{{ asset('assets/css/base.css') }}" rel="stylesheet" />
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
		 <a class="navbar-brand" href="{{ route('web.partner.dashboard') }}"><img src="{{ asset('assets/img/logo.png') }}" style="height: 18px; float: left;   margin-right: 10px;"/>Frobity</a>
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

			  
			  <!--<div  class="dropdown-menu w dropdown-menu-scale pull-right">
			  		<ul id="notification-list">
			  			
						<li class="no-notification">No new Notifications</li>
			  		</ul>
			  </div>-->
			  
			  
			  <div  class="dropdown-menu w dropdown-menu-scale pull-right" style="width:275px;">
			  		<div class="no-notification" style="padding:9px;">No new Notifications</div>
					
					<ul id="notification-list" style="overflow-y:auto;overflow-x:hidden;width:auto; max-height:400px;">
			  			
			  		</ul>
			  		<ul id="notification-list" style="width:auto;">
						<li><a href="{{ route('web.getpartner.notifications') }}">Show all notifications</a></li>
			  		</ul>

						
			  </div>
			  

		 	</li><li class="dropdown mega-avatar active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		   <span class="avatar w-32"><img src="{{ session('partner')['image'] }}" onError="this.onerror=null;this.src='/assets/img/default-user.svg';" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
		   <!-- hidden-xs hides the username on small devices so only the image appears. -->
		   <span>
			{{ session('partner')['name'] }}
		   </span>
		  </a>
			<div class="dropdown-menu w dropdown-menu-scale pull-right">
		   
				<a class="dropdown-item" href="{{ route('web.logout',['type'=>'partner'])}}">Sign out</a>
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


     <!-- ==============================================
	 Dashboard Section
	 =============================================== -->
     <section class="dashboard">
	  <div class="container-fluid">
	   <div class="row">
	   
	    <div class="col-sm-4 col-md-4">
		  
        @include ('frontend.partner.jobs.leftnav')
			 
		       		
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
			url:'{{ route('web.partner.notifications') }}',
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
			url:'{{ route('web.partner.notifications') }}',
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
					//noti_html = noti_html + '<li>'+newleads[ln]['notification_title']+'</li>';
						noti_html = noti_html + '<a href='+newleads[ln]['notification_link']+'><li>'+newleads[ln]['notification_title']+'</li><br></a>';
				}
				noti_html = noti_html ;// + '<a href="#"><li>Show ALL</li></a>';
				$("#notification-list").prepend(noti_html);
				$(".icon_no").hide();
			}
		});
	}
	
</script>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<!--script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script-->

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<!--script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
/*  var firebaseConfig = {
    apiKey: "AIzaSyBFVws-czCn4FoyrvRo13jFOqrx_Q3-Ibw",
    authDomain: "hirebunny-17728.firebaseapp.com",
    databaseURL: "https://hirebunny-17728.firebaseio.com",
    projectId: "hirebunny-17728",
    storageBucket: "hirebunny-17728.appspot.com",
    messagingSenderId: "701787204428",
    appId: "1:701787204428:web:fd330f2a57ba6453ecbde9",
    measurementId: "G-PNSXNEEYWF"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();*/
</script-->	
  </body>
</html>