
<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> 
<!--<![endif]-->
<head>

	    <!-- ==============================================
		Title and Meta Tags
		=============================================== -->
		<meta charset="utf-8">
        <title>Hire Bunny  | Freelancing Platform</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Add your business website description here">
        <meta name="keywords" content="Add your, business, website, keywords, here">
        <meta name="author" content="Add your business, website, author here">
		
		<!-- ==============================================
		Favicons
		=============================================== --> 
		<link rel="shortcut icon" href="img/favicons/favicon.ico">
		<link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicons/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicons/apple-touch-icon-114x114.png">
		
	    <!-- ==============================================
		CSS
		=============================================== -->
        <!-- Style-->
        <link href="{{ asset('assets/home/css/style.css') }}" rel="stylesheet" type="text/css" />
		<!-- Vegas 2.2.1 CSS-->
        <link href="{{ asset('assets/home/js/vegas/vegas.css') }}" rel="stylesheet" type="text/css" />
				
		<!-- ==============================================
		Feauture Detection
		=============================================== -->
		<script src="{{ asset('assets/home/js/modernizr-custom.js') }}"></script>
		
		<!--[if lt IE 9]>
		 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->		
		
</head>

<body>

     <!-- ==============================================
	 Navbar
	 =============================================== -->
	 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
       <!-- Brand and toggle get grouped for better mobile display -->
	     <a class="navbar-brand" href="{{ route('web.home') }}"><img src="{{ asset('assets/img/logo.png') }}" style="height: 18px; float: left;   margin-right: 10px;">Hire Bunny</a>
       <input type="checkbox" id="toggle" />
	     <label for="toggle" class="toggle"></label>

       <!-- Collect the nav links, forms, and other content for toggling -->
    		<ul class="menu">
    		 <li><a href="{{ route('web.home') }}" >Home</a>
    		
    		 <li class="hidden"><a href="#">About</a></li>
    		 
    		 <li class="hidden" ><a href="#" >How it works</a>
    		  </li>
             <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
              <ul class="dropdown-menu">
               <li><a href="{{ route( 'web.getLoginWithEmail',['type'=>'client'])}}">Client Login</a></li>
               <li><a href="{{ route( 'web.getLoginWithEmail',['type'=>'partner'])}}">Partner Login</a></li>
              </ul>
             </li> 
             <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Register <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route( 'web.get.register',['type'=>'partner'])}}">{{ __("Partner Registration") }}</a></li>
                <li><a href="{{ route( 'web.get.register',['type'=>'client'])}}">{{ __("Client Registration") }}</a></li>
              </ul>
             </li> 
    		</ul><!-- /.ul.menu -->
      </div><!-- /.container -->
     </nav><!-- /.nav -->
	 


	@yield('content')
    <!-- ==============================================
        Footer Section
        =============================================== -->
        <div class="footer">
         <div class="container">
          <div class="row">
         
           <div class="col-md-4 col-sm-6 text-left">
            <h4 class="heading no-margin">About Us</h4>
            <hr class="mint">
            <p>The Kafe. Template is the Ultimate Freelance Marketplace Template for employers and freelancers to connect, collaborate, and get work done.</p>
            <p>We work hard to build a great product that is beautifully designed, simple to use, user friendly with great focus on user experience and customer service.</p>
           </div><!-- /.col-md-4 -->
          
           <div class="col-md-2 col-sm-6 text-left hidden">
            <h4 class="heading no-margin">Company</h4>
            <hr class="mint">
            <div class ="no-padding">
             <a href="index.html">Home</a>
             <a href="about.html">About</a>
             <a href="jobs.html">Jobs</a>
             <a href="services.html">Freelancers</a>
             <a href="how-1.html">How it works</a>
             <a href="contact.html">Contact</a>		 
            </div>
           </div><!-- /.col-md-2 -->	
           
           <div class="col-md-3 col-sm-6 text-left">
            <h4 class="heading no-margin">Other Services</h4>
            <hr class="mint">
            <div class="no-padding">
             <a href="<?php echo url("/") ?>/privacy-policy">Privacy Policy</a>
             <a href="<?php echo url("/") ?>/terms-of-services">Terms of Services</a>
             <a href="<?php echo url("/") ?>/refund-policy">Refund Policy</a>
             <a href="faq.html" class="hidden">FAQ</a>		 
            </div>
           </div><!-- /.col-md-3 -->	
           
           <div class="col-md-3 col-sm-6 text-left hidden">
           <h4 class="heading no-margin">Browse</h4>
           <hr class="mint">
            <div class="no-padding">
              <a href="services.html">Top Freelancers this Month of June</a>
              <a href="services.html">Top Freelancers by Skill</a>
              <a href="services.html">Top Freelancers in USA</a>
              <a href="services.html">Top Freelancers in UK</a>
              <a href="services.html">Top Freelancers in Australia</a>
              <a href="services.html">Top Freelancers in Kenya</a>		  
             </div>
            </div><!-- /.col-md-3 -->
            
           </div><!-- /.row -->
          <div class="clearfix"></div>
         </div><!-- /.container-->
        </div><!-- /.footer -->			
        
        <!-- ==============================================
        Made Section
        =============================================== -->
        <!--<section class="made">
         <div class="container">
          <div class="row">
           <div class="col-lg-10 col-lg-offset-1 text-center">
            <h4 class="made-with-love">The Kafe. Template</h4>
            <p class="made-with-love-1">Handcrafted with <i class="fa fa-heart"></i> &amp; Much <i class="fa fa-coffee"></i> In Nairobi, Kenya.</p>
           </div>
           
          </div>
         </div>
        </section>-->
        
        <!-- ==============================================
        Bottom Footer Section
        =============================================== -->	
        <footer id="main-footer" class="main-footer">
         <div class="container">
          <div class="row">
          
           <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <p>Made with love in India </p>
            <ul class="social-links">

             <li class="revealOnScroll" data-animation="slideInLeft" data-timeout="800"><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
             <li class="revealOnScroll" data-animation="slideInLeft" data-timeout="600"><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
             <li class="revealOnScroll" data-animation="slideInLeft" data-timeout="400"><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
             <li class="revealOnScroll" data-animation="slideInLeft" data-timeout="200"><a href="#link"><i class="fa fa-pinterest fa-fw"></i></a></li>
             <li class="revealOnScroll" data-animation="slideInLeft"><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
            </ul>
           </div>
           <!-- /.col-sm-4 -->
           
           <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 revealOnScroll" data-animation="bounceIn" data-timeout="200">
            <div class="img-responsive text-center">
             <!--<i class="fa fa-coffee logo"></i>-->		 </div><!-- End image-->
           </div>
           <!-- /.col-sm-4 -->
           
           <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 text-right revealOnScroll" data-animation="slideInRight" data-timeout="200">
            <p>&copy;{{date('Y')}} | Hire Bunny</p>
           </div>
           <!-- /.col-sm-4 -->
                   
          </div><!-- /.row -->
         </div><!-- /.container -->
        </footer><!-- /.footer -->  
        
        <a id="scrollup">Scroll</a>
        
        <!-- ==============================================
        Scripts
        =============================================== -->
        
        <!-- jQuery 2.1.4 -->
        <script src="{{ asset('assets/home/js/jQuery-2.1.4.min.js') }}" type="text/javascript"></script>
        <!-- Bootstrap 3.3.6 JS -->
        <script src="{{ asset('assets/home/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <!-- Waypoints JS -->
        <script src="{{ asset('assets/home/js/waypoints.min.js') }}" type="text/javascript"></script>
        <!-- Vegas 2.2.1 JS -->
        <script src="{{ asset('assets/home/js/vegas/vegas.min.js') }}"></script>
        <!-- Jquery Animate Numbers -->
        <script src="{{ asset('assets/home/js/jquery.animateNumbers.js') }}" type="text/javascript"></script> 
        <!-- Jquery Flexslider -->
        <script src="{{ asset('assets/home/js/jquery.flexslider-min.js') }}" type="text/javascript"></script>
        <!-- Kafe Flexslider -->
        <script src="{{ asset('assets/home/js/kafe.flexslider.js') }}" type="text/javascript"></script>
        <!-- Jquery Appear -->
        <script  src="{{ asset('assets/home/js/jquery.appear.js') }}" type="text/javascript"></script>
        <!-- Kafe JS -->
        <script src="{{ asset('assets/home/js/kafe.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/js/jquery-validation.js') }}"></script>
        @yield('scripts')
   </body>
   </html>