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
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Hợp đồng lao động<small>&nbsp Chi tiết</small></h3>
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
								<label class="col-md-2" >Nhân viên</label>
								<div class="col-md-4">
									<input class="form-control" readonly="readonly" type="text"  name="name">
								</div>

								<label class="col-md-2">Mã nhân viên</label>
								<div class="col-md-4 inline">
									<input class="form-control" required="" type="text"  name="id">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2" >Số hợp đồng</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="contract_number" >
								</div>

								<label class="col-md-2">Văn bản</label>
								<div class="col-md-4">
									<span class="docs-tooltip" data-toggle="tooltip" title="Xem văn bản">
										<a href=""  class="btn btn-default"><i class="fa fa-file"></i></a>
									</span>
									<!-- <input type="file" name="file"> -->
								</div>
							</div>



							<div class="form-group">
								<label class="col-md-2" >Quyết định</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="decided_number" >
								</div>

								<label class="col-md-2">Người đại diện</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="delegate" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2">Hình thức</label>
								<div class="col-md-4">
									<select class="form-control" name="categories">
										<option>Hợp đồng</option>
										<option>Phụ lục</option>
									</select>
								</div>
								

								<label class="col-md-2">Loại hợp đồng</label>
								<div class="col-md-4">
									<select class="form-control" name="contract_type">
										<option>Chọn loại hợp đồng</option>
									</select>
								</div>
							</div>



							<div class="form-group">
								<label class="col-md-2" >Mức lương</label>
								<div class="col-md-4">
									<input class="form-control" type="text" name="salary_level">
								</div>

								<label class="col-md-2">Ngày ký</label>
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
								<label class="col-md-2">Ngày hiệu lực</label>
								<div class='col-sm-4'>
									<div class='input-group date' id="BirthDatepicker">
										<input type='text' class="form-control" placeholder="dd-mm-yyyy" name="date_of_birth" />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<label class="col-md-2">Ngày hết hạn</label>
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
								<label class="col-md-2">Ghi chú</label>
								<div class="col-md-10">
									<textarea class="form-control" rows="3" name="note"></textarea>
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-8">
									<button type="button" class="btn btn-primary">Cancel</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<button type="submit" class="btn btn-success">Submit</button>
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