<!DOCTYPE html>
<html lang="en">
  <head>

	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Frobity | Freelancing Platform</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Add your business website description here">
        <meta name="keywords" content="Add your, business, website, keywords, here">
        <meta name="author" content="Add your business, website, author here">
		
		<!-- ==============================================
		Favicons
		=============================================== --> 
		<link rel="icon" href="{{ asset('assets/img/logo.png') }}">
		<link rel="apple-touch-icon" href="{{ asset('img/favicons/apple-touch-icon.png') }}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicons/apple-touch-icon-72x72.png') }}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/favicons/apple-touch-icon-114x114.png') }}">
		
	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link type="text/css" href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
				
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
            <a class="navbar-brand" href="{{ route('web.home') }}"><img src="{{ asset('assets/img/logo.png') }}" style="height: 18px; float: left;   margin-right: 10px;">
		FROBITY</a>
           </div><!-- /.navbar-header -->
           <div class="navbar-left">
            <div class="collapse navbar-collapse" id="navbar-collapse">
             <ul class="nav navbar-nav">
              <li><a href="hire.html">GoHire</a></li>
              <li><a href="work.html">GoWork</a></li>
              <li><a href="pricing.html">Pricing</a></li>
              <li><a href="how.html">How it works</a></li>
             </ul>
            </div>
           </div><!-- /.navbar-left -->
           <div class="navbar-right">                          
            <ul class="nav navbar-nav">
            <!-- <li><i class="fa fa-user"></i></li>-->
             <li><a href="{{ route('web.partner.signin') }}">Partner Sign In </a></li>
             <li><a href="{{ route('web.client.signin') }}">Client Sign In </a></li>
            @if(Auth::user())
            <li class="dropdown mega-avatar">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <span class="avatar w-32"><img src="{{ asset('assets/img/users/2.jpg') }}" class="img-resonsive img-circle" width="25" height="25" alt="..."></span>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span>
               Alex Grantte
              </span>
             </a>
             <div class="dropdown-menu w dropdown-menu-scale pull-right">
              <a class="dropdown-item" href="dashboard.html"><span>Dashboard</span></a> 
              <a class="dropdown-item" href="profile.html"><span>Profile</span></a> 
              <a class="dropdown-item" href="editprofile.html"><span>Settings</span></a> 
              <a class="dropdown-item" href="#">Sign out</a>
             </div>
            </li><!-- /navbar-item -->
            @endif	
            
            </ul><!-- /.sign-in -->   
            <!--<a href="addjob.html" class="kafe-btn kafe-btn-mint-small">Post a Job</a>-->
           </div><!-- /.nav-right -->
          </div><!-- /.container -->
         </nav><!-- /.navbar -->
        </header><!-- Page Header -->   
       

	 <!-- ==============================================
	 Header Section
	 =============================================== -->	
	@yield('content')
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
               </div><!-- /col-sm-5 -->
               
               <div class="col-sm-7 col-sm-pull-5 col-xs-12">
                <div class="copyRightText">
                 <p>Copyright © 2018. All Rights Reserved</p>
                </div>
               </div><!-- /col-sm-7 -->
             
              </div><!-- /row -->
             </div><!-- /copyRightWrapper -->
            </div><!-- /col-xs-2 -->
    
           </div><!-- /row -->
          </div><!-- /container -->
         </div><!-- /copyRight -->
         
       </footer>	
       
        <a id="scrollup">Scroll</a>
    
        
        <!-- ==============================================
        Scripts
        =============================================== -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
       <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
       <script src="{{ asset('assets/js/app.js') }}"></script>

  </body>
</html>