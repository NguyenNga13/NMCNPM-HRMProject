<div class="col-md-3 left_col">
	<div class="left_col scroll-view">
		<div class="navbar nav_title" style="border: 0;">
			<a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>HRM</span></a>
		</div>

		<div class="clearfix"></div>

		<!-- menu profile quick info -->
		<div class="profile clearfix">
			@if(Auth::check())
			<div class="profile_pic">
				<img src="image/employee/cardimage/{{Auth::user()->emp_profile()->first()->photo_card}}" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">

				<span>Xin chào</span>
				<h2>{{Auth::user()->emp_profile()->first()->name}}</h2>
			</div>
			@else
			<div class="profile_pic">
				<img src="image/employee/cardimage/user.png}}" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Xin chào</span>
			</div>
			@endif
		</div>
		<!-- /menu profile quick info -->

		<br />

		@include('emp.layout.sidebar_menu')

		<!-- menu footer buttons -->
		<div class="sidebar-footer hidden-small">
			<a data-toggle="tooltip" data-placement="top" title="User">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Notify">
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Settings">
				<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
			</a>
			<a data-toggle="tooltip" data-placement="top" title="Logout" href="logout">
				<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
			</a>
		</div>
		<!-- /menu footer buttons -->
	</div>
</div>
<!-- top navigation -->
<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle">
				<a id="menu_toggle" class="active"><i class="fa fa-bars"></i></a>

			</div>

			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
				<li class="">
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="image/employee/cardimage/{{Auth::user()->emp_profile()->first()->photo_card}}" alt="">
						{{Auth::user()->name}}
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="javascript:;"> Settings</a></li>
						<li><a href="javascript:;">Help</a></li>
						<li><a href="logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
					</ul>
				</li>

				<li role="presentation" class="dropdown">
					<?php
					$notify_manager = new App\Manager\NotifyManager();
					$notify = $notify_manager->getNotify(Auth::user()->id);
					?>
					<a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
						<i class="fa fa-envelope-o"></i>
						<span class="badge bg-green">{{count($notify)}}</span>
					</a>
					<ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">

						@if(count($notify) > 0)
						@foreach($notify as $notify)
						<li>
							<a href="">
								<span class="image"><img src="image/employee/cardimage/{{$notify->photo_card}}" alt="Profile Image" /></span>
								<span>
									<span><small><b>{{$notify->name}}</b></small></span>
									<span class="time">{{getTimeGap($notify->created_at)}}</span>
								</span>
								<span class="message">
									{{$notify->notify}}
								</span>
							</a>
						</li>
						@endforeach
						@endif
						

						<li>
							<div class="text-center">
								<a>
									<strong>See All Alerts</strong>
									<i class="fa fa-angle-right"></i>
								</a>
							</div>
						</li>
					</ul>
				</li>
				@else
				<li class="">
					<a href="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="image/employee/cardimage/user.png" alt="">
						User
						<span class=" fa fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="javascript:;">Help</a></li>
						<li><a href="login"><i class="fa fa-sign-out pull-right"></i> Login</a></li>
					</ul>
				</li>

				<li role="presentation" class="dropdown">
				</li>

				@endif
			</ul>
		</nav>
	</div>
</div>
<!-- /top navigation -->