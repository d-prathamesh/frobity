	@if( @isset($job_categories) && $job_categories == 1 )
		<ul class="sidebar-menu" data-widget="tree">
			<li class="{{ Session::get('currentRoute') == 'web.partner.dashboard' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.dashboard') }}">
				<i class="fa fa-life-ring"></i> <span>  Dashboard</span>
			  </a>
			</li>
		</ul>
	@else
	<ul class="sidebar-menu" data-widget="tree">
			<li class="{{ Session::get('currentRoute') == 'web.partner.dashboard' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.dashboard') }}">
				<i class="fa fa-life-ring"></i> <span>  Dashboard</span>
			  </a>
			</li>
		
			<li class="{{ Session::get('currentRoute') == 'web.partner.jobs' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.jobs') }}">
				<i class="fa fa-files-o"></i> <span>Find Jobs</span>
				
			  </a>
			  
			</li>

			<li class="{{ Session::get('currentRoute') == 'web.partner.ongoing.jobs' ? 'active' : ''}}">
					<a href="{{ route('web.partner.ongoing.jobs') }}">
					<i class="fa fa-align-left"></i> <span>On Going Jobs</span>
					</a>
				</li>
				<li class="{{ Session::get('currentRoute') == 'web.partner.completed.jobs' ? 'active' : ''}}">
						<a href="{{ route('web.partner.completed.jobs') }}">
						<i class="fa fa-check-square-o"></i> <span>Completed Jobs</span>
						</a>
					</li>
			<li class="{{ Session::get('currentRoute') == 'web.partner.job.sent-proposal' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.job.sent-proposal') }}">
				<i class="fa fa-clone"></i> <span>Sent Proposals</span>
			
			  </a>
			</li>
			
			<li class="{{ Session::get('currentRoute') == 'web.partner.refunded.jobs' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.refunded.jobs') }}">
				<i class="fa fa-clone"></i> <span>Refunded Jobs</span>
			
			  </a>
			</li>
			
			<!-- <li>
			  <a href="messages.html">
				<i class="fa fa-envelope"></i> <span>Messages</span>
				<span class="pull-right-container">
				  <small class="label pull-right bg-green">4</small>
				</span>
			  </a>
			</li> -->
		 </ul>		
		
		  <!--<ul class="sidebar-menu" data-widget="tree">
	
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
		
		  <ul class="sidebar-menu" data-widget="tree">
					<li class="{{ Session::get('currentRoute') == 'web.partner.setting.bank' ? 'active' : ''}}">
							<a href="{{ route('web.partner.setting.bank') }}">
							<i class="fa fa-bank"></i> <span>Bank Detail</span>
							</a>
						</li>
			<li class="{{ Session::get('currentRoute') == 'web.partner.setting.profile' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.setting.profile') }}">
				<i class="fa fa-user"></i> <span>Edit Profile</span>
			  </a>
			</li>
			<li class="{{ Session::get('currentRoute') == 'web.partner.setting.aboutme' ? 'active' : ''}}">
			  <a href="{{ route('web.partner.setting.aboutme') }}">
				<i class="fa fa-user"></i> <span>Edit About me</span>
			  </a>
			</li>
			<li class="{{ Session::get('currentRoute') == 'web.partner.setting.identity' ? 'active' : ''}}">
				<a href="{{ route('web.partner.setting.identity') }}">
				<i class="fa fa-address-card"></i> <span>Identity Proofs</span>
				</a>
			</li>
			<li class="{{ Session::get('currentRoute') == 'web.partner.setting.notification' ? 'active' : ''}}">
				<a href="{{ route('web.partner.setting.notification') }}">
				<i class="fa fa-bell"></i> <span>Notification Setting</span>
				</a>
			</li>
		
		<!--	<li>
			  <a href="{{ route('web.partner.setting.password') }}">
				<i class="fa fa-lock"></i> <span>Change Password</span>
			  </a>
			</li>-->
		 </ul>
		 @endif