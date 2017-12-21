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
				<h3>Quản lý người dùng</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div id="insurance-notify"></div>

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<div class="btn-group">
							<div class="btn-group">
								<button  type="button"  class="btn btn-app" title="Tạo tài khoản người dùng"  id="btn-add-insurance">
									<span class="fa fa-plus"></span>Tạo
								</button>
							</div>
							<button type="button" class="btn btn-app" id="btn-delete-group" title="Xóa">
								<span class="fa fa-minus"></span>Xóa
							</button>
							<button type="button" class="btn btn-app" title="Xem biểu đồ thay đổi mức đóng">
								<span class="fa fa-bar-chart"></span>Biểu đồ
							</button>

						</div>


						<table id="datatable" class="table table-striped table-bordered table-insurance">
							<thead>
								<tr>
									<th>
										<input type="checkbox" id="check-all">
									</th>
									<th class="text-center">Bảo hiểm</th>
									<th class="text-center">Doanh nghiệp đóng <p >(%)</p></th>
									<th class="text-center" >Người lao động đóng<p>(%)</p></th>
									<th class="text-center">Thời gian áp dụng</th>
									<th class="text-center">Thao tác</th>
								</tr>
							</thead>
							<tbody id="insurance-list">
								@foreach($insurance as $ins)
								<tr id="insurance{{$ins->id}}">
									<td> <input type="checkbox" name="insurance-checkbox" value="{{$ins->id}}"></td>
									<td>{{$ins->insurance}}</td>
									<td class="text-center">{{$ins->rate_for_business}}</td>
									<td class="text-center">{{$ins->rate_for_laborer}}</td>
									<td>{{$ins->applied_begin}}</td>
									<td class="text-center">
										<span class="docs-tooltip" data-toggle="tooltip" title="Thay đổi mức đóng">
											<button class="btn btn-success btn-xs btn-change-rate" value="{{$ins->id}}"><i class="fa fa-pencil"></i></button>
										</span>
										<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
											<button class="btn btn-danger btn-xs btn-delete-insurance" value="{{$ins->id}}"><i class="fa fa-trash-o"></i></button>
										</span>

									</td>
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
<!-- /page content -->

<!-- modal change rate -->
<div id="modal-insurance" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-title-insurance"></b></h3>
			</div>
			<div class="modal-body">
				<div id="-notify"></div>
				<form class="form-horizontal form-label-left" id="form-insurance">
					<div id="modal-insurance-notify"></div>
					<div class="form-group">
						<label class="col-md-2" >Bảo hiểm</label>
						<div class="col-md-4">
							<input class="form-control" type="text" required="" value="" name="insurance" id="insurance">
						</div>

						<label class="col-md-2">Áp dụng từ ngày</label>
						<div class='col-md-4'>
							<div class='input-group date' id='AppliedBeginDatepicker'>
								<input type='text' class="form-control" placeholder="dd-mm-yyyy" required="" value="" name="applied_begin" id="applied_begin" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" for="rate_for_business">Tỷ lệ doanh nghiệp đóng (%)</label>
						<div class="col-md-4">
							<input class="form-control" type="number" step="any" required="" name="rate_for_business" id="rate_for_business">
						</div>
						<label class="col-md-2" for="rate_for_laborer">Tỷ lệ người lao động đóng (%)</label>
						<div class="col-md-4">
							<input class="form-control" type="number" step="0.01" required="" name="rate_for_laborer" id="rate_for_laborer">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2">Ghi chú</label>
						<div class="col-md-12">
							<textarea class="form-control" rows="3" name="note" id="note"></textarea>
						</div>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn btn-danger" id="btn-delete" value="">Xóa</button>
				<button type="button" class="btn btn-success" form="form-insurance" id="btn-save" value="">Lưu</button>
				<input type="hidden" name="id_insurance" id="id_insurance" value="0">
			</div>

		</div>
	</div>
</div>
<!-- /modal change rate -->

@include('hrm.layout.modal_confirm_delete')
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

<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->



<script type="text/javascript" src="{{ asset('/js/hrm/insurance.js') }}"></script>

<script>
	$('AppliedBeginDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
</script>

@endsection