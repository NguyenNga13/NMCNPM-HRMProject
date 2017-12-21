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
		<div class="clearfix"></div>

		@include('hrm.layout.notify')
		<div id="emp-paysheet-notify"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">

						<div id="emp-info" style="margin-bottom: 15px">
							<form class="form-horizontal form-label-left" id="form-emp-info">
								<div class="text-center" style="color: black; font-size: 20px; margin-bottom: 20px"><b>PHIẾU LƯƠNG THÁNG {{date("m/Y", strtotime($sheet->time))}}</b></div>
								<div class="form-group">
									<label class="col-md-2">Họ tên</label>
									<div class="col-md-4">{{$sheet->name}}</div>
									<label class="col-md-2">Mã nhân viên</label>
									<div class="col-md-4">{{$sheet->emp_code}}</div>
								</div>
								<div class="form-group">
									<label class="col-md-2">Chức vụ</label>
									<div class="col-md-4">{{$sheet->position}}</div>
									<label class="col-md-2">Phòng ban</label>
									<div class="col-md-4">{{$sheet->department}}</div>
								</div>
							</form>
						</div>

						<div id="table-salary">
							
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>#</th>
										<th>Mục</th>
										<th>Diễn giải</th>
										<th>Thành tiền</th>
									</tr>
								</thead>
								<tbody>
									<tr style="font-weight: bold; color: black;">
										<td>1</td>
										<td>Lương cơ bản</td>
										<td></td>
										<td class="text-right">{{number_format($sheet->pay_value)}}</td>
									</tr>
									<tr>
										<td>2</td>
										<td>Ngày công</td>
										<td class="text-center">{{$sheet->workday->man_day}} </td>
										<td class="text-right"></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Nghỉ phép</td>
										<td class="text-center">{{$sheet->workday->paid_leave_day}}</td>
										<td class="text-right"></td>
									</tr>
									<tr>
										<td>4</td>
										<td>Nghỉ lễ</td>
										<td class="text-center">{{$sheet->workday->holiday_leave_day}}</td>
										<td class="text-right"></td>
									</tr>
									@foreach(json_decode($sheet->allowances) as $key=>$value)
									<tr>
										<td>{{$key+5}}</td>
										<td>{{$value->allowance}}</td>
										<td></td>
										<td class="text-right">{{number_format((int)$value->allowance_value)}}</td>
									</tr>
									@endforeach

									<?php
									$count = count(json_decode($sheet->allowances)) + 4;
									?>
									<tr style="font-weight: bold; color: black;">
										<td>{{$count+1}}</td>
										<td>Tổng thu</td>
										<td></td>
										<td class="text-right">{{number_format($sheet->real_income)}}</td>
									</tr>
									<tr>
										<td>{{$count+2}}</td>
										<td>Đóng hiểm xã hội</td>
										<td></td>
										<td class="text-right">{{number_format($sheet->bhxh)}}</td>
									</tr>
									<tr>
										<td>{{$count+3}}</td>
										<td>Đóng bảo hiểm y tế</td>
										<td></td>
										<td class="text-right">{{number_format($sheet->bhyt)}}</td>
									</tr>
									<tr>
										<td>{{$count+4}}</td>
										<td>Đóng bảo hiểm thất nghiệp</td>
										<td></td>
										<td class="text-right">{{number_format($sheet->bhtn)}}</td>
									</tr>
									<tr>
										<td>{{$count+5}}</td>
										<td>Đóng thuế thu nhập cá nhân</td>
										<td></td>
										<td class="text-right"></td>
									</tr>
									<tr>
										<td>{{$count+6}}</td>
										<td>Trừ tạm ứng</td>
										<td></td>
										<td class="text-right"></td>
									</tr>
									<tr  style="font-weight: bold; color: black; font-size: 15px">
										<td>{{$count+7}}</td>
										<td>Lương thực lĩnh</td>
										<td></td>
										<td class="text-right">{{number_format($sheet->salary)}}</td>
									</tr>
								</tbody>
							</table>

							<div class="text-right red"><h6>Ghi chú *: Đơn vị tính = 1 VND</h6></div>

						</div>




					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->
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



<script type="text/javascript" src="{{ asset('/js/hrm/emp_paysheet.js') }}"></script>
@endsection