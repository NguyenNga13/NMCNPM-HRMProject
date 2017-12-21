@extends('hrm.layout.index')

@section('link')

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
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Thông tin lương nhân viên</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div id="emp-salary-notify"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						
						<div class="btn-group">
							<button type="button" class="btn btn-app" title="Xem chi tiết" id="btn-view">
								<span class="fa fa-info-circle"></span>Xem
							</button>
							<button type="button" class="btn btn-app" title="Xuất file" id="btn-view">
								<span class="fa fa-file-excel-o"></span>Excel
							</button>
							<div class="btn-group">
								<button  type="button"  class="btn btn-app dropdown-toggle" data-toggle="dropdown" title="Tạo" id="btn-add" >
									<span class="fa fa-calculator"></span>Lập bảng lương
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a id="btn-add-by-user"> Theo nhân viên</a>
									</li>
									<li><a id="btn-add-by-department"> Theo phòng ban</a>
									</li>
									<li><a id="btn-add-all"> Tất cả</a></li>
								</ul>
							</div>
						</div>
						<table id="datatable" class="table table-striped table-bordered table-hover nowrap table-emp-salary" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><input type="checkbox" id="check-all"></th>
									<th>Mã NV</th>
									<th>Họ tên</th>
									<th>Phòng ban</th>
									<th>Chức vụ</th>
									<th>Số BHXH</th>
									<th>Lương chính</th>
									@foreach($allowances as $allowance)
									<th title="{{$allowance->allowance}}">{{$allowance->allowance}}</th>
									@endforeach
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody id="emp-salary-body">
								@foreach($emp_salary as $salary)
								<tr id="salary-{{$salary->id}}">
									<td><input type="checkbox" name="check" value="{{$salary->id}}"></td>
									<td>{{$salary->emp_code}}</td>
									<td>{{$salary->name}}</td>
									<td>{{$salary->department}}</td>
									<td>{{$salary->position}}</td>
									<td>{{$salary->insurance_code}}</td>
									<td>{{$salary->pay_range}}</td>
									@foreach($allowances as $source)
									<td>
										@foreach($salary->allowance as $key=>$value)
										@if($value->allowance_code == $source->allowance_code)
										{{$salary->allowance[$key]->allowance_level}}
										@endif
										@endforeach
									</td>
									@endforeach
									<td>
										<a href="hrm/salary/emp/emp-salary/{{$salary->id}}" class="btn btn-info btn-xs" id="btn-view-row" value="{{$salary->id}}" title="Xem chi tiết thông tiin lương nhân viên">
											<i class="fa fa-info-circle"></i>
										</a>
										<button class="btn btn-danger btn-xs" id="btn-delete-row" title="Xóa thông tin lương nhân viên" value="{{$salary->id}}">
											<i class="fa fa-trash-o"></i>
										</button>
										
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						<!-- 	<div class="solid"></div> -->


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

<!-- //if use modal to show detail->include('hrm.salary.emp_salary_info.modal_emp_salary_detail') -->



<!-- modal emo allowance -->
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
<!-- /modal emo allowance -->



@include('admin.layout.modal_confirm_delete')
@include('admin.layout.modal_notify')

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