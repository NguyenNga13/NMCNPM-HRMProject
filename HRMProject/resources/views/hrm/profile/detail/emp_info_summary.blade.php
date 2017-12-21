<div class="col-md-3 col-sm-3 col-xs-12 profile_left">
	<h4><b><p class="text-center">{{convertString($emp->name, 1)}}</p></b></h4>
	<br>
	<div class="profile_img center-block">
		<div id="crop-avatar">
			<!-- Current avatar -->
			<img class="img-responsive avatar-view center-block" src="image/employee/cardimage/{{$emp->photo_card}}" alt="Avatar" title="Change the avatar">
		</div>
	</div>
	
	<br>
	<ul class="list-unstyled user_data center-block center">
		<li><i class="fa fa-user" style="width:17px"></i> Mã nhân viên: {{$emp->emp_code}}
		</li>
		<li>
			<i class="fa fa-briefcase"  style="width:17px"></i>{{$emp->position}}
		</li>
		<li>
			<i style="width:17px"></i> <label style="padding-left: 17px">{{$emp->department}}</label>
		</li>
		<li class="m-top-xs">
			<i class="fa fa-envelope" style="width:17px"></i>
			<a target="_blank">  {{$emp->email}}</a>
		</li>
		<li>
			<i class="fa fa-phone "  style="width:17px"></i> {{$emp->phone}}
		</li>

		<li><i class="fa fa-map-marker"  style="width:17px"></i> {{showAddress($emp->address)}}
		</li>
	</ul>
	<br />

	<!-- start skills -->
	<!-- <h4>Skills</h4>
	<ul class="list-unstyled user_data">
		<li>
			<p>Web Applications</p>
			<div class="progress progress_sm">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
			</div>
		</li>
		<li>
			<p>Website Design</p>
			<div class="progress progress_sm">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="70"></div>
			</div>
		</li>
		<li>
			<p>Automation & Testing</p>
			<div class="progress progress_sm">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="30"></div>
			</div>
		</li>
		<li>
			<p>UI / UX</p>
			<div class="progress progress_sm">
				<div class="progress-bar bg-green" role="progressbar" data-transitiongoal="50"></div>
			</div>
		</li>
	</ul> -->
	<!-- end of skills -->

</div>