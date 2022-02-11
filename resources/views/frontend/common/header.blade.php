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
        <a class="navbar-brand" href="{{ route('web.home') }}"><img src="{{ asset('assets/img/logo.jpg') }}" alt="Image"/>Frobity</a>
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
   