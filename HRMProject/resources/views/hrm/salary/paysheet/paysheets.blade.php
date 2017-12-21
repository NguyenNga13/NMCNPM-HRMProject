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
				<h3>Bảng tổng hợp lương</h3>
			</div>
		</div>

		<div class="clearfix"></div>
		@include('hrm.layout.notify')

		<div id="emp-salary-notify"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						
						<div class="btn-group">
							<div class="btn-group">
								<button  type="button"  class="btn btn-app dropdown-toggle" data-toggle="dropdown" title="Tạo" id="btn-add" >
									<span class="fa fa-plus"></span>Lập
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a id="btn-add-by-emp"> Theo nhân viên</a>
									</li>
									<li><a id="btn-add-by-dep"> Theo phòng ban</a>
									</li>
									<li><a id="btn-add-all"> Tất cả</a></li>
								</ul>
							</div>
							
							
							<button type="button" class="btn btn-app" title="Xem chi tiết" id="btn-view">
								<span class="fa fa-info-circle"></span>Xem
							</button>
							<button type="button" class="btn btn-app" id="btn-delete" title="Xóa">
								<span class="fa fa-minus"></span>
								Xóa
							</button>
						</div>
						<table id="datatable" class="table table-striped table-bordered table-hover nowrap table-emp-salary" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th><input type="checkbox" id="check-all"></th>
									<th  style="color: black">Mã</th>
									<th>Họ tên</th>
									<th>Phòng ban</th>
									<th>Chức vụ</th>
									<th style="color: black">Lương cơ bản</th>
									@foreach($allowances as $allowance)
									<th title="{{$allowance->allowance}}">{{$allowance->allowance}}</th>
									@endforeach
									<th>Ngày công</th>
									<th>Nhỉ phép</th>
									<th>Nghỉ ốm</th>
									<th>Nghỉ lễ</th>
									<th style="color: black">Tổng thu</th>
									<th>BHXH</th>
									<th>BHYT</th>
									<th>BHTN</th>
									<th style="color: red">Tạm ứng</th>
									<th style=" color: black">Lương thực lĩnh</th>
									<th>Ngày thanh toán</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody id="body-paysheet">
								@foreach($paysheets as $sheet)
								<tr >
									<td><input type="checkbox" name="check" value="{{$sheet->id}}"></td>
									<td  style="color: black">{{$sheet->emp_code}}</td>
									<td>{{$sheet->name}}</td>
									<td>{{$sheet->department}}</td>
									<td>{{$sheet->position}}</td>
									<td class="text-right" style="color: black">{{number_format($sheet->pay_value)}}</td>
									@foreach($allowances as $source)
										@if(count(json_decode($sheet->allowances)))
											@foreach(json_decode($sheet->allowances) as $all)
												@if($all->allowance_code == $source->allowance_code)
													<td class="text-right">{{number_format((int)$all->allowance_value)}}</td>
												@else
													<td></td>
												@endif
											@endforeach
										@else
											<td></td>
										@endif
									
									@endforeach
									<td>{{$sheet->workday->man_day}}</td>
									<td>{{$sheet->workday->paid_leave_day}}</td>
									<td>{{$sheet->workday->sick_leave_day}}</td>
									<td>{{$sheet->workday->holiday_leave_day}}</td>
									<td class="text-right" style="color: black">{{number_format($sheet->real_income)}}</td>
									<td class="text-right">{{number_format($sheet->bhxh)}}</td>
									<td class="text-right">{{number_format($sheet->bhyt)}}</td>
									<td class="text-right">{{number_format($sheet->bhtn)}}</td>
									<td></td>
									<td class="text-right" style="color: black">{{number_format($sheet->salary)}}</td>
									<td></td>
									<td>
										<a href="hrm/salary/paysheet/paysheet/{{$sheet->id}}" class="btn btn-info btn-xs" id="btn-view-row" value="" title="Xem chi tiết bảng lương">
											<i class="fa fa-info-circle"></i>
										</a>
										<button class="btn btn-danger btn-xs" id="btn-delete-row" title="Xóa bảng lương nhân viên" value="">
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

<!-- modal select emp to create paysheet -->
<div id="modal-add-by-emp" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-title">Tạo bảng lương cho nhân viên</b></h3>
			</div>

			<div class="modal-body">
				<div id="add-by-emp-notify"></div>

				<form class="form-horizontal form-label-left" id="form-add-by-emp">
					<div class="form-group">
						<label class="col-md-2">Mã nhân viên</label>
						<div class="col-md-4" id="input-emp-code">
							<input type="text" name="add-emp-code" id="add-emp-code" class="form-control">
						</div>
						<div class="col-md-4" id="select-emp-code">
							<select class="form-control" name="add-emp-code" id="add-emp-code-select">
							</select>
						</div>
						<label class="col-md-2">Họ tên</label>
						<div class="col-md-4">
							<input type="text" name="add-emp-name" id="add-emp-name" class="form-control">
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				<a type="button" class="btn btn-success" form="form-add-by-emp" id="btn-add-paysheet-by-emp">Lập<a>

				</div>

			</div>
		</div>
	</div>
	<!-- /modal select emp to create paysheet -->

	<!-- modal select emp to create paysheet -->
	<div id="modal-add-by-dep" class="modal fade" role="dialog">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title"> <b>Tạo bảng lương cho phòng ban</b></h3>
				</div>

				<div class="modal-body">
					<div id="add-by-dep-notify"></div>

					<form class="form-horizontal form-label-left" id="form-add-by-dep">
						<div class="form-group">
							<label class="col-md-2">Mã phòng ban</label>
							<div class="col-md-3" id="input-dep-code">
								<select class="form-control" name="add-dep-code" id="add-dep-code">
									<option value="">Mã phòng ban</option>
								</select>
							</div>
							<label class="col-md-2">Phòng ban</label>
							<div class="col-md-5">
								<select class="form-control" name="add-dep-name" id="add-dep-name">
									<option value="">Phòng ban</option>
								</select>
							</div>

						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
					<button type="button" class="btn btn-success" form="form-add-by-dep">Lập</button>

				</div>

			</div>
		</div>
	</div>
	<!-- /modal select emp to create paysheet -->



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

	<script type="text/javascript" src="{{ asset('/js/hrm/paysheet.js') }}"></script>

	@endsection