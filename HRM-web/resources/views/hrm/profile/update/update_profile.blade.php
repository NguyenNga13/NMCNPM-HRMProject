@extends('hrm.profile.confirm_update')

@section('update_content')
<div class="row">

	<div class="col-sm-6 col-md-6 col-xs-12 ">
		<div class="x_panel">
			<div class="x_title">
				<h2>Thông tin hiện tại</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a>
							</li>
							<li><a href="#">Settings 2</a>
							</li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<form class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="col-md-2" >Mã nhân viên</label>
						<div class="col-md-4" style="color: black">
							<b>{{$profile->emp_code}}</b>

						</div>

						<label class="col-md-2">Số hồ sơ</label>
						<div class="col-md-4"  style="color: black">
							<b>{{$profile->profile_number}}</b>
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-2" >Họ và tên</label>
						<div class="col-md-4" style="color: black">
							<b>{{$profile->name}}</b>

						</div>
						<label class="col-md-2">Ngày vào</label>
						<div class="col-md-4" style="color: black">
							<b>{{$profile->date_begin}}</b>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Giới tính</label>
						<div class="col-md-4" style="color: black">
							@if($profile->gender == 1)
							Nam
							@else
							Nữ
							@endif

						</div>

						<label class="col-md-2">Ngày sinh</label>
						<div class='col-sm-4' style="color: black">
							{{$profile->date_of_birth}}
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-2" >Số điện thoại</label>
						<div class="col-md-4" style="color: black">
							{{$profile->phone}}
						</div>


						<label class="col-md-2">Email</label>
						<div class="col-md-4" style="color: black">
							{{$profile->email}}
						</div>

					</div>
					<hr>

					<div class="form-group">
						<label class="col-md-2" >Quốc gia</label>
						<div class="col-md-4" style="color: black">
							{{$profile->country}}
						</div>

						<label class="col-md-2">Số CMT</label>
						<div class="col-md-4" style="color: black">
							{{$profile->identity_card}}
						</div>
					</div>


					<div class="form-group">

						<label class="col-md-2" >Ngày cấp CMT</label>
						<div class='col-sm-4'  style="color: black">  
							{{$profile->id_date_of_issued}}
						</div>
						<label class="col-md-2">Nơi cấp CMT</label>
						<div class="col-md-4"  style="color: black">
							{{$profile->id_issued_by}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Số hộ chiếu</label>
						<div class="col-md-4" style="color: black">
							{{$profile->passport_number}}
						</div>

						<label class="col-md-2">Ngày cấp</label>
						<div class="col-md-4" style="color: black">
							{{$profile->passport_date_of_issued}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Nơi cấp</label>
						<div class="col-md-4" style="color: black">
							{{$profile->passport_issued_by}}
						</div>

						<label class="col-md-2">Ngày hết hạn</label>
						<div class="col-md-4" style="color: black">
							{{$profile->passport_expiration_date}}
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-md-2">Ngày vào Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$profile->date_of_adherent}}
						</div>

						<label class="col-md-2" >Mã thẻ Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$profile->adherent_number}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Chức vụ Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$profile->adherent_position}}
						</div>

						<label class="col-md-2">Nơi sinh hoạt Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$profile->adherent_active_place}}
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-md-2" >Tình trạng hôn nhân</label>
						<div class="col-md-4" style="color: black">
							@if($profile->marial_status)
							Đã kết hôn
							@else
							Độc thân
							@endif
						</div>

						<label class="col-md-2"></label>
						<div class="col-md-4">

						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Dân tộc</label>
						<div class="col-md-4"  style="color: black">
							{{$profile->ethnic}}
						</div>

						<label class="col-md-2">Tôn giáo</label>
						<div class="col-md-4"  style="color: black">
							{{$profile->religion}}
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-2">Hộ khẩu</label>
						<div class="col-md-10" style="color: black">
							{{showAddress($profile->household_address)}}
						</div>

					</div>


					<div class="form-group">
						<label class="col-md-2">Nơi sinh</label>
						<div class="col-md-10"  style="color: black">
							{{showAddress($profile->place_of_birth)}}
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2">Nơi ở</label>
						<div class="col-md-10"  style="color: black">
							{{showAddress($profile->address)}}
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-2">Ghi chú</label>
						<div class="col-md-10 blue">
							{{$profile->note}}
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="col-sm-6 col-md-6 col-xs-12 ">
		<div class="x_panel">
			<div class="x_title">
				<h2>Thông tin thay đổi</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#">Settings 1</a>
							</li>
							<li><a href="#">Settings 2</a>
							</li>
						</ul>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<form class="form-horizontal form-label-left" id="form-update_profile" action="hrm/emp/update/profile" method="POST">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<label class="col-md-2" >Mã nhân viên</label>
						<div class="col-md-4 col-sm-4 col-xs-6" style="color: black">
							<b>{{$profile->emp_code}}</b>
							<input type="hidden" name="emp_code" value="{{$profile->emp_code}}">
							
						</div>

						<label class="col-md-2">Số hồ sơ</label>
						<div class="col-md-4" id="profile_number" style="color: black">
							<b>{{$profile->profile_number}}</b>
							<input type="hidden" name="profile_number" value="{{$profile->profile_number}}">
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-2" >Họ và tên</label>
						<div class="col-md-4" style="color: black">
							<b>{{$profile->name}}</b>
							<input type="hidden" name="name" value="{{$profile->name}}">
							
						</div>
						<label class="col-md-2">Ngày vào</label>
						<div class="col-md-4" style="color: black">
							<b>{{$profile->date_begin}}</b>
							<input type="hidden" name="date_begin" value="{{$profile->date_begin}}">
						</div>
					</div>
					<?php

					?>


					<div class="form-group">
						<label class="col-md-2" >Giới tính</label>
						<div class="col-md-4" style="color: black">
							@if($update->gender == 1)
							Nam
							@else
							Nữ
							@endif
							<input type="hidden" name="gender" value="{{$update->gender}}">
						</div>

						<label class="col-md-2">Ngày sinh</label>
						<div class='col-sm-4' style="color: black">
							{{$update->date_of_birth}}
							<input type="hidden" name="date_of_birth" value="{{$update->date_of_birth}}">

						</div>
					</div>


					<div class="form-group">
						<label class="col-md-2" >Số điện thoại</label>
						<div class="col-md-4" style="color: black">
							{{$update->phone}}
							<input type="hidden" name="phone" value="{{$update->phone}}">
						</div>

						<label class="col-md-2">Email</label>
						<div class="col-md-4" style="color: black">
							{{$update->email}}
							<input type="hidden" name="email" value="{{$update->email}}">
						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-md-2" >Quốc gia</label>
						<div class="col-md-4" style="color: black">
							{{$update->country}}
							<input type="hidden" name="country" value="{{$update->country}}">
						</div>

						<label class="col-md-2">Số CMT</label>
						<div class="col-md-4" style="color: black">
							{{$update->identity_card}}
							<input type="hidden" name="identity_card" value="{{$update->identity_card}}">
						</div>
					</div>


					<div class="form-group">

						<label class="col-md-2" >Ngày cấp CMT</label>
						<div class='col-sm-4'  style="color: black">  
							{{$update->id_date_of_issued}}
							<input type="hidden" name="id_date_of_issued" value="{{$update->id_date_of_issued}}">
						</div>
						<label class="col-md-2">Nơi cấp CMT</label>
						<div class="col-md-4"  style="color: black">
							{{$update->id_issued_by}}
							<input type="hidden" name="id_issued_by" value="{{$update->id_issued_by}}">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Số hộ chiếu</label>
						<div class="col-md-4" style="color: black">
							{{$update->passport_number}}
							<input type="hidden" name="passport_number" value="{{$update->passport_number}}">

						</div>

						<label class="col-md-2">Ngày cấp</label>
						<div class="col-md-4" style="color: black">
							{{$update->passport_date_of_issued}}
							<input type="hidden" name="passport_date_of_issued" value="{{$update->passport_date_of_issued}}">

						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Nơi cấp</label>
						<div class="col-md-4" style="color: black">
							{{$update->passport_issued_by}}
							<input type="hidden" name="passport_issued_by" value="{{$update->passport_issued_by}}">


						</div>

						<label class="col-md-2">Ngày hết hạn</label>
						<div class="col-md-4" style="color: black">
							{{$update->passport_expiration_date}}
							<input type="hidden" name="passport_expiration_date" value="{{$update->passport_expiration_date}}">


						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-md-2">Ngày vào Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$update->date_of_adherent}}
							<input type="hidden" name="date_of_adherent" value="{{$update->date_of_adherent}}">


						</div>

						<label class="col-md-2" >Mã thẻ Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$update->adherent_number}}
							<input type="hidden" name="adherent_number" value="{{$update->adherent_number}}">


						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Chức vụ Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$update->adherent_position}}
							<input type="hidden" name="adherent_position" value="{{$update->adherent_position}}">

						</div>

						<label class="col-md-2">Nơi sinh hoạt Đảng</label>
						<div class="col-md-4" style="color: black">
							{{$update->adherent_active_place}}
							<input type="hidden" name="adherent_active_place" value="{{$update->adherent_active_place}}">

						</div>
					</div>
					<hr>

					<div class="form-group">
						<label class="col-md-2" >Tình trạng hôn nhân</label>
						<div class="col-md-4" style="color: black">
							@if($update->marial_status == 1)
							Đã kết hôn
							@else
							Độc thân
							@endif
							<input type="hidden" name="marial_status" value="{{$update->marial_status}}">


						</div>

						<label class="col-md-2"></label>
						<div class="col-md-4">

						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Dân tộc</label>
						<div class="col-md-4"  style="color: black">
							{{$update->ethnic}}
							<input type="hidden" name="ethnic" value="{{$update->ethnic}}">


						</div>

						<label class="col-md-2">Tôn giáo</label>
						<div class="col-md-4"  style="color: black">
							{{$update->religion}}
							<input type="hidden" name="religion" value="{{$update->religion}}">


						</div>
					</div>


					<div class="form-group">
						<label class="col-md-2">Hộ khẩu</label>
						<div class="col-md-10" style="color: black">
							{{showAddress($update->household_address)}}
							<input type="hidden" name="household_address" value="{{$update->household_address}}">


						</div>

					</div>


					<div class="form-group">
						<label class="col-md-2">Nơi sinh</label>
						<div class="col-md-10"  style="color: black">
							{{showAddress($update->place_of_birth)}}
							<input type="hidden" name="place_of_birth" value="{{$update->place_of_birth}}">


						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2">Nơi ở</label>
						<div class="col-md-10"  style="color: black">

							{{showAddress($update->address)}}
							<input type="hidden" name="address" value="{{$update->address}}">

						</div>

					</div>

					<div class="form-group">
						<label class="col-md-2">Ghi chú</label>
						<div class="col-md-10 blue">
							{{$update->note}}
							<input type="hidden" name="note" value="{{$update->note}}">
						</div>
					</div>

					<input type="hidden" name="id_notify" value="{{$notify_update->id}}">
				</form>
			</div>
		</div>
	</div>

</div>
<div class="row">
	<div class="x_content">

		<div class="col-sm-4 col-md-4 col-xs-12 col-md-offset-4">
			<button type="button" class="btn btn-danger" id="btn-reject">Từ chối</button>
			<button type="button" class="btn btn-default" id="btn-later">Duyệt sau</button>
			<button type="submit" class="btn btn-primary" id="btn-agree" form="form-update_profile">Đồng ý</button>
		</div>
	</div>
</div>
@endsection

