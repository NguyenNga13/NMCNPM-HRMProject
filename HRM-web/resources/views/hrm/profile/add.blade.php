@extends('hrm.layout.index')

@section('link')

<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

@endsection 


@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<br />
	<?php
	$string = file_get_contents('json/tree.json');
	$json = json_decode($string, true);
	?>
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Thêm hồ sơ nhân viên</h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for...">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">

					<div class="x_content">
						@include('hrm.layout.notify')
						
						<form class="form-horizontal form-label-left" action="hrm/emp/add" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="form-group">
								<div class="col-md-9" >
									<div class="form-group">
										<label class="col-md-2" >Mã nhân viên</label>
										<div class="col-md-4">
											<input class="form-control" readonly="readonly" type="text"  name="id" value="{{$new_code}}">
										</div>

										<label class="col-md-2">Số hồ sơ *</label>
										<div class="col-md-4">
											<input class="form-control" required="" type="text"  name="profile_number">
										</div>

									</div>

									<div class="form-group">
										<label class="col-md-2" >Họ và tên *</label>

										<div class="col-md-4">
											<input type="text" class="form-control" placeholder="Họ" required="" name="last_name">
										</div>
										<div class="col-md-2">
											<input type="text" class="form-control" placeholder="Tên đệm" name="middle_name">
										</div>
										<div class="col-md-4">
											<input type="text" class="form-control" placeholder="Tên" required="" name="first_name">
										</div>
									</div>

									<div class="form-group">
										
										<label class="col-md-2">Ngày vào công ty</label>
										<div class='col-sm-4'>
											<div class='input-group date' id="JoinDatepicker">
												<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="date_join" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>

										<label class="col-md-2">Ngày sinh</label>
										<div class='col-sm-4'>
											<div class='input-group date' id="BirthDatepicker">
												<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="date_of_birth" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>


									<div class="form-group">
										<label class="col-md-2">Email</label>
										<div class="col-md-4">
											<input class="form-control" type="text"  name="email" >
										</div>
										
										<label class="col-md-2" >Số điện thoại</label>
										<div class="col-md-4">
											<input class="form-control" type="text"  name="phone" >
										</div>

										
									</div>

									<div class="form-group">
										

										<label class="col-md-2" >Giới tính</label>
										<div class="col-md-4">
											<select class="form-control" name="gender">
												<option>Chọn giới tính</option>
												<option value="1">Nam</option>
												<option value="0">Nữ</option>
											</select>
										</div>
										<label class="col-md-2" >Tình trạng hôn nhân</label>
										<div class="col-md-4">
											<select class="form-control" name="marial_status">
												<option value="0">Độc thân</option>
												<option value="1">Đã kết hôn</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<img  type="file" class="img-responsive avatar-view center-block" src="image/employee/cardimage/user.png" alt="Avatar" title="Change the avatar"">
									<input type="file" name="cardimage">
								</div>
							</div>
							<hr>

							<div class="form-group">
								<label class="col-md-2" >Quốc tịch</label>
								<div class="col-md-4">
									<select class="form-control" name="country">
										@foreach(country() as $country)
										<option 
										@if($country == "Việt Nam")
										{{"selected"}}
										@endif
										value="{{$country}}">{{$country}}</option>
										@endforeach
									</select>
								</div>

								<label class="col-md-2">Số CMT</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="identity_card" value="">
								</div>
							</div>


							<div class="form-group">

								<label class="col-md-2" >Ngày cấp CMT</label>
								<div class='col-sm-4'>  
									<div class='input-group date' id='CMTDatepicker'>
										<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="id_date_of_issued"/>
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<label class="col-md-2">Nơi cấp CMT</label>
								<div class="col-md-4">
									<select class="form-control" name="id_issued_by">
										<option value=""></option>
										@foreach ($json as $key => $value)
										
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2" >Số hộ chiếu</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="passport_number"/>
								</div>

								<label class="col-md-2">Ngày cấp</label>
								<div class="col-md-4">
									<div class='input-group date' id='PassportDatepicker'>
										<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="passport_date_of_issued" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2" >Nơi cấp</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="passport_issued_by"/>
								</div>

								<label class="col-md-2">Ngày hết hạn</label>
								<div class="col-md-4">
									<div class='input-group date' id='PassporExpiretDatepicker'>
										<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="passport_expiration_date" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
							</div>
							<hr>

							<div class="form-group">
								<label class="col-md-2">Ngày vào Đảng</label>
								<div class="col-md-4">
									<div class='input-group date' id='AdherenttDatepicker'>
										<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="date_of_adherent" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>

								<label class="col-md-2" >Mã thẻ Đảng</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="adherent_number"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2" >Chức vụ Đảng</label>
								<div class="col-md-4">
									<select class="form-control" name="adherent_position">
										<option>Không</option>
										<option>Đảng viên</option>
										<option>Ủy viên thường vụ Đảng</option>
										<option>Phó Bí thư Đảng</option>
										<option>Bí thư Đảng</option>
									</select>
								</div>

								<label class="col-md-2">Nơi sinh hoạt Đảng</label>
								<div class="col-md-4">
									<input type='text' class="form-control" name="adherent_address" />
								</div>
							</div>
							<hr>

							

							<div class="form-group">
								<label class="col-md-2" >Dân tộc</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="ethnic"/>
								</div>

								<label class="col-md-2">Tôn giáo</label>
								<div class="col-md-4">
									<input type='text' class="form-control" name="religion" />
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2">Hộ khẩu</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="household_address"/>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="household_address_district" id="household_address_district">
										<option value="">Quận/Huyện</option>
										@foreach ($json as $key => $value)
										@foreach ($value['quan-huyen'] as $key => $value)
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										@endforeach
										@endforeach
									</select>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="household_address_province" id="household_address_province">
										<option value="">Tỉnh/Thành phố</option>
										@foreach ($json as $key => $value)
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2">Nơi sinh</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="place_of_birth"/>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="place_of_birth_district" id="place_of_birth_district">
										<option value="">Quận/Huyện</option>
										@foreach ($json as $key => $value)
										@foreach ($value['quan-huyen'] as $key => $value)
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										@endforeach
										@endforeach
									</select>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="place_of_birth_province" id="place_of_birth_province">
										<option value="">Tỉnh/Thành phố</option>
										@foreach ($json as $key => $value)
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2">Nơi ở</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="address"/>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="address_district" id="address_district">
										<option value="">Quận/Huyện</option>
										@foreach ($json as $key => $value)
										@foreach ($value['quan-huyen'] as $key => $value)
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										@endforeach
										@endforeach
									</select>
								</div>
								<div class="col-md-3">
									<select class="form-control" name="address_province" id="address_province">
										<option value="">Tỉnh/Thành phố</option>
										@foreach ($json as $key => $value)
										<option value="{{$value['name']}}">{{$value['name']}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2">Ghi chú</label>
								<div class="col-md-10">
									<textarea class="form-control" rows="3" name="note"></textarea>
								</div>
							</div>

							<hr>

							<div>
								<a class="hover blue" id="add-position"><h4><i class="fa fa-plus-circle"></i><b> Thêm thông tin chức vụ </b></h4></a>
							</div>
							<br>
							<div id="position-content" class="hide">
								<div class="form-group">
									<label class="col-md-2" >Chức vụ</label>
									<div class="col-md-4">
										<select class="form-control" name="position" id="position">
											<option value="">Chức vụ</option>
											
										</select>
									</div>

									<label class="col-md-2">Phòng ban</label>
									<div class="col-md-4">
										<select class="form-control" name="department" id="department">
											<option value="">Phòng ban</option>
											
										</select>
									</div>

								</div>


								<div class="form-group">
									<label class="col-md-2">Ngày bắt đầu</label>
									<div class='col-sm-4'>
										<div class='input-group date' id="CurrentPositionDatepicker"'>
											<input type="text" class="form-control" placeholder="dd-mm-yyyy" name="date_begin" />
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
									</div>
									<label class="col-md-2" >Số Quyết định</label>
									<div class="col-md-4">
										<input class="form-control " type="text"  name="decided_number" >
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2" >Trạng thái</label>
									<div class="col-md-4">
										<select class="form-control" name="status">
											<option value="1">Chính thức</option>
											<option value="2">Thử việc</option>
											<option value="3">Thực tập</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-2">Ghi chú</label>
									<div class="col-md-10">
										<textarea class="form-control" name="position_note" rows="3"></textarea>
									</div>
								</div>
								
							</div>
							<hr>
							<div>
								<a class="hover blue" id="add-salary"><h4><i class="fa fa-plus-circle"></i><b> Thêm thông tin lương</b></h4></a>
							</div>
							<br>

							<div class="hide" id="salary-content">
								<label class="col-md-12 dark" style="font-size: 15px; margin-bottom: 10px"></i> Lương chính</label>
								
								<div class="form-group" id="pay_scale_select">
									<label class="col-md-2">Ngạch lương</label>
									<div class="col-md-4">
										<select class="form-control" name="pay_scale" id="pay_scale">
											<option value="0">Ngạch lương</option>
										</select>
									</div>

									<label class="col-md-2">Bậc lương</label>
									<div class="col-md-4">
										<select class="form-control" name="pay_range" id="pay_range">
											<option value="0">Bậc lương</option>
										</select>
									</div>
								</div>
								<hr>

								<label class="col-md-12 dark" style="font-size: 15px; margin-bottom: 10px"> Phụ cấp</label>
								<div class="form-group" id="allowance_list">
									<label class="col-md-2"></label>
									<div class="col-md-4">
										<div class="checkbox">
											<label>
												<input type="checkbox" value="" name="checkbox-op" class="flat"> <b> Phụ cấp chức vụ</b>
											</label>
										</div>
									</div>
									<label class="col-md-2" >Mức phụ cấp</label>
									<div class="col-md-4" id="allowance_level_select">
										<select class="form-control" name="allowance_level" id="allowance_level">
											<option value="0">Mức phụ cấp</option>
										</select>
									</div>
								</div>
								<hr>
								<label class="col-md-12 dark" style="font-size: 15px; margin-bottom: 10px"> Bảo hiểm xã hội</label>
								<div class="form-group">
									<label class="col-md-2">Mã số BHXH</label>
									<div class="col-md-4">
										<input type="text" name="bhxh" class="form-control">
									</div>

									<label class="col-md-2"> Ngày bắt đầu</label>
									<div class='col-sm-4'>
										<div class='input-group date' id="BeginInsuranceDatepicker">
											<input type="text" class="form-control" placeholder="dd-mm-yyyy" name="date_begin_insurance" />
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-calendar"></span>
											</span>
										</div>
										<div class="pull-right red"><small>Ghi chú*: Ngày bắt đầu thực hiện đóng bảo hiểm tại công ty </small></div>
									</div>
								</div>
								
								<!-- <div class="form-group">

									<label class="col-md-4">Số Bảo hiểm y tế (BHYT)</label>
									<div class="col-md-8">
										<input type="text" name="bhyt" class="form-control">
									</div>
								</div>
								<div class="form-group">

									<label class="col-md-4">Số Bảo hiểm thất nghiệp (BHTN)</label>
									<div class="col-md-8">
										<input type="text" name="bhtn" class="form-control">
									</div>
								</div>
								<div class="form-group">

									<label class="col-md-4">Số Bảo hiểm y tế (BHYT)</label>
									<div class="col-md-8">
										<input type="text" name="bhyt" class="form-control">
									</div>
								</div>
								<div class="form-group">

									<label class="col-md-4">Số Bảo hiểm tai nạn nghề nghiệp (BHTNNN)</label>
									<div class="col-md-8">
										<input type="text" name="bhtn" class="form-control">
									</div>
								</div>-->
							</div> 



							

							<div class="ln_solid"></div>
							<div class="pull-right">
								<div class=" button-group">
									<button type="button" class="btn btn-default">Hủy</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<button type="submit" class="btn btn-success">Lưu</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- /page content -->
@endsection


@section('script')
<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script>
	$(document).ready(function(){
		var base_url = "laravel/HRMProject/public/hrm/emp/";


		$('#add-position').click(function(){
			var hide = $('#position-content').attr('class');

			$.get('hrm/emp/pos_dept_list', function(data){
				console.log(data);
				$('#department').html('<option value="">Phòng ban</option>');
				$.each(data.departments, function(index, value){
					var row = '<option value="'+ value.id+'">'+value.department+'</option>';
					$('#department').append(row);

				});

				$('#position').html('<option value="">Chức vụ</option>');

				$.each(data.positions, function(index, value){
					var row = '<option value="'+ value.id +'">'+ value.position+'</option>';
					$('#position').append(row);
				});

				if(hide == 'hide'){
					$('#position-content').removeClass('hide');
				}else{
					$('#position-content').addClass('hide');
				}
			});
		});

		$('#add-salary').click(function(){
			var hide = $('#salary-content').attr('class');

			$.get('hrm/emp/salary_source', function(data){
				console.log(data);

				$('#pay_scale').html('<option value="">Chọn ngạch lương</option>')
				$.each(data.scale, function(index, value){
					var row = '<option value="'+ value.pay_scale_code+'">'+ value.pay_scale+'</option>';
					$('#pay_scale').append(row);
				});

				$('#allowance_list').html('');
				$.each(data.allowance, function(index, value){
					var row = '<div class="form-group">';
					row += '<label class="col-md-2"></label>';
					row    += '<div class="col-md-4">';
					row    += '<div class="checkbox">';
					row    += '<label><input type="checkbox" value="'+value.allowance_code +'" name="'+value.allowance_code +'">  '+value.allowance +'</label>';
					row    += '</div>';
					row    += '</div>';
					row    += '<label class="col-md-2" ></label>';
					row    += '<div class="col-md-4">';
					row    += '<select class="form-control" name="'+ value.allowance_code+'_level" id="'+ value.allowance_code+'_level">';
					row    += '<option value="0">Mức phụ cấp</option>';
					$.each(JSON.parse(value.value), function(index, value){
						row += '<option value="'+value.level+'">'+value.level+'</option>';
					});
					row += '</select>';
					row    += '</div>';
					row += '</div>';
					$('#allowance_list').append(row);
				});

			});
			if(hide == 'hide'){
				$('#salary-content').removeClass('hide');
			}else{
				$('#salary-content').addClass('hide');
			}
		});

		$('#pay_scale').change(function(){
			var scale = $(this).val();
			$.get('hrm/emp/pay_range/' + scale, function(data){
				console.log(data);
				$('#pay_range').html('');
				$.each(data, function(index, value){
					var row = '<option value="' + value.level +'">'+value.level+'</option>';
					$('#pay_range').append(row);
				});
			});
		});






		$('#household_address_province').change(function(){
			var province = $(this).val();
			$.get("ajax/address/"+province, function(data){
				$('#household_address_district').html(data);
			});
		});

		$('#place_of_birth_province').change(function(){
			var province = $(this).val();
			$.get("ajax/address/"+province, function(data){
				$('#place_of_birth_district').html(data);
			});
		});
		$('#address_province').change(function(){
			var province = $(this).val();
			$.get("ajax/address/"+province, function(data){
				$('#address_district').html(data);
			});
		});


		$('#household_address_district').change(function(){
			var district = $(this).val();
			$.get("ajax/province/"+district, function(data){
				$('#household_address_province').val(data);
			});
		});
		$('#place_of_birth_district').change(function(){
			var district = $(this).val();
			$.get("ajax/province/"+district, function(data){
				$('#place_of_birth_province').val(data);
			});
		});
		$('#address_district').change(function(){
			var district = $(this).val();
			$.get("ajax/province/"+district, function(data){
				$('#address_province').val(data);
			});
		});


	});
</script>

<script>
	$('#BeginInsuranceDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#JoinDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#BirthDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#CMTDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#PassportDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#PassporExpiretDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#AdherenttDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#CurrentPositionDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#ConcurrentPositionDatePicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

	$('#datetimepicker6').datetimepicker();

	$('#datetimepicker7').datetimepicker({
		useCurrent: false
	});

	$("#datetimepicker6").on("dp.change", function(e) {
		$('#datetimepicker7').data("DateTimePicker").minDate(e.date);
	});

	$("#datetimepicker7").on("dp.change", function(e) {
		$('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
	});

</script>
@endsection