@extends('hrm.layout.index')

@section('link')
<!-- datatables -->
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

@endsection

@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Thông tin lương nhân viên</h3>
			</div>

			<div class="title_right">
				<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Tìm theo mã nhân viên..." id="search-emp">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="btn-search-emp">Go!</button>
						</span>
					</div>
					<div id="error-search"></div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>

		<div id="emp-salary-detail-notify"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" id="form-modal-emp-salary">

							<div class="form-group">
								<label class="col-md-2" >Mã nhân viên</label>
								<div class="col-md-4" id="input-user" >
									<input class="form-control" readonly="readonly" type="text"  name="emp_code" id="emp_code" required="" value="{{$emp->emp_code}}">
								</div>

								<label class="col-md-2">Họ tên</label>
								<div class="col-md-4">
									<input class="form-control" readonly="readonly" type="text"  name="emp_name" id="emp_name" value="{{$emp->name}}">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-2" >Chức vụ</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="emp_position" id="emp_position" readonly="" value="{{$emp->position}}">
								</div>

								<label class="col-md-2" >Phòng ban</label>
								<div class="col-md-4">
									<input class="form-control" type="text"  name="emp_department" id="emp_department" readonly="" value="{{$emp->department}}">
								</div>
							</div>
							<hr>

							<div class="form-group">
								<div class="col-md-2">
									<label>Mã số BHXH </label>
									<a id="edit-insurance" style="margin-left: 10px;" title="Sửa thông tin bảo hiểm" class="red" ><i class="fa fa-edit"></i></a>
								</div>
								
								<div class="col-md-4">
									<input type="text" name="insurance_code" class="form-control" id="insurance_code" value="{{$emp->insurance_code}}" readonly>
								</div>

								<label class="col-md-2"> Ngày bắt đầu</label>
								<div class='col-sm-4'>
									<div class='input-group date' id="insurance-begin-datepicker">
										<input type="text" class="form-control" placeholder="YYYY-mm-dd" name="date_begin_insurance" id="date_begin_insurance" value="{{$emp->date_begin_insurance}}" readonly />
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
									<div class="pull-right red"><small>Ghi chú*: Ngày bắt đầu thực hiện đóng bảo hiểm tại công ty </small></div>
								</div>
							</div>
							<hr>
							

							<div class="form-group" id="pay_scale_select">
								<label class="col-md-2">Ngạch lương</label>
								<div class="col-md-4">
									<select class="form-control" name="pay_scale" id="pay_scale">
										<option value="0">Ngạch lương</option>
										@foreach($pay_scales as $pay_scale)
										<option value="{{$pay_scale->pay_scale_code}}"
											@if($emp->pay_scale_code == $pay_scale->pay_scale_code)
											selected
											@endif
											>{{$pay_scale->pay_scale}}</option>
											@endforeach
										</select>
									</div>

									<label class="col-md-2">Bậc lương</label>
									<div class="col-md-4">
										<select class="form-control" name="pay_range" id="pay_range">
											<option value="0">Bậc lương</option>
											@foreach($pay_scales as $scale)
											@foreach(json_decode($scale->range) as $range)
											<option value="{{$range->level}}"
												@if($emp->pay_range == $range->level)
												selected
												@endif
												>{{$range->level}}</option>
												@endforeach
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-2">Áp dụng từ: </label>
										<div class='col-sm-4'>
											<div class='input-group date' id='scale-begin-datepicker'>
												<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="scale_applied_begin" id="scale_applied_begin" value="{{$emp->salary_begin}}" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
										<label class="col-md-2">đến</label>
										<div class='col-sm-4'>
											<div class='input-group date' id='scale-finish-datepicker'>
												<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="scale_applied_finish" id="scale_applied_finish" value="{{$emp->salary_finish}}" />
												<span class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</span>
											</div>
										</div>
									</div>

									<input type="hidden" name="id_emp" id="id_emp" value="{{$emp->id}}">

									
								</form>
								<div class="col-md-12">
									<div class="pull-right">
										
										<button class="btn btn-info" id="btn-edit-scale" value=""> Chỉnh sửa</button>
										<button class="btn btn-success" id="btn-update-scale" value=""> Cập nhật</button>
										
									</div>
								</div>

								<div class="clearfix"></div>

								<hr>
								

								<div class="btn-group" style="margin-bottom: 10px">
									<button class="btn btn-default" title="Thêm phụ cấp" id="btn-add-allowance"><span class="fa fa-plus"></span> Thêm </button>
									<button class="btn btn-default" title="Xem chi tiết phụ cấp" id="btn-view-allowance"><span class="fa fa-info-circle"></span> Xem</button>
									<button class="btn btn-default" title="Xóa phụ cấp" id="btn-delete-allowance"><span class="fa fa-minus"></span> Xóa</button>
								</div>
								<br>

								<div id="emp-allowance-notify"></div>

								<table id="table-allowance" class="table table-hover table-striped table-bordered" >
									<thead>
										<tr>
											<th><input type="checkbox" id="check-all-allowance" name=""></th>
											<th>Phụ cấp</th>
											<th>Mức phụ cấp</th>
											<th>Ngày áp dụng</th>
											<th>Ngày kết thúc</th>
										</tr>
									</thead>
									<tbody id="emp-allowance-list">
										@foreach($emp_allowances as $allowance)
										<tr id="{{$allowance->allowance_code}}">
											<td><input type="checkbox"  name="check-allowance" value="{{$allowance->id}}"></td>
											<td>{{$allowance->allowance}}</td>
											<td>{{$allowance->allowance_level}}</td>
											<td>{{$allowance->allowance_begin}}</td>
											<td>{{$allowance->allowance_finish}}</td>
										</tr>
										@endforeach
									</tbody>

								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<!-- modal emp allowance -->
<div id="modal-allowance" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-title-allowance"></b></h3>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<div class="modal-body">
				<div id="allowance-notify"></div>
				<form class="form-horizontal form-label-left" id="form-allowance">
					<div class="form-group">
						<label class="col-md-2">Phụ cấp</label>
						<div class="col-md-4">
							<select class="form-control" name="emp_allowance" id="emp_allowance">
								<option value="">Chọn phụ cấp</option>
							</select>
						</div>
						<label class="col-md-2">Mức phụ cấp</label>
						<div class="col-md-4">
							<select class="form-control" name="emp_allowance_level" id="emp_allowance_level">
								<option value="">Mức phụ cấp</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2">Áp dụng từ: </label>
						<div class='col-sm-4'>
							<div class='input-group date' id='allowance-begin-idatepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="allowance_applied_begin" id="allowance_applied_begin" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<label class="col-md-2">đến</label>
						<div class='col-sm-4'>
							<div class='input-group date' id='allowance-finish-datepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="allowance_applied_finish" id="allowance_applied_finish" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2">Ghi chú</label>
							<div class="col-md-10">
								<textarea class="form-control" rows="3" id="emp_allowance_note" name="emp_allowance_note"></textarea>
							</div>
						</div>

					</div>


				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				<button type="button" class="btn btn-danger" id="btn-modal-delete-allowance" value="">Xóa</button>
				<button type="button" class="btn btn-info" id="btn-modal-edit-allowance" value="edit">Sửa</button>
				<button type="button" class="btn btn-success" id="btn-modal-update-allowance" value="update">Cập nhật</button>
				<button type="button" class="btn btn-info" id="btn-modal-save-allowance" value="add">Lưu</button>

				<input type="hidden" name="id_allowance" id="id_allowance" value="0">
			</div>

		</div>
	</div>
</div>
<!-- /modal emp allowance -->

@include('hrm.layout.modal_confirm_delete')
@endsection


@section('script')

<!-- Datatables -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>



<script type="text/javascript" src="{{ asset('/js/hrm/emp_salary_info.js') }}"></script>

@endsection