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
	<div id="notify-this"></div>
	<div class="">
		<!-- <div class="page-title">
			<div class="title_left">
				<h3>Quản lý thang lương</h3>
			</div>
		</div> -->


		<div id="notify-paybasic"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title"><h2>Quản lý lương cơ bản</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="form-group">
							<div class="col-md-8 col-xs-12 col-sm-4">
								@if($pay_rate_basic)
								<div class="col-md-12">
									<label class="col-md-6 col-xs-6" >Mức lương cơ bản: </label>
									<b class="col-md-6 col-xs-6 dark" id="display-pay_rate_basic">
										{{number_format($pay_rate_basic->pay_rate_basic)}}
									VND</b>
								</div>
								<div class="col-md-12">
									<label class="col-md-6 col-xs-6 ">Áp dụng từ ngày: </label>
									<b class="col-md-6 col-xs-6 dark" id="display-applied_begin">{{$pay_rate_basic->applied_begin}}</b>
									
								</div>
								@else
								<div class="col-md-12">
									<label class="col-md-6 col-xs-6" >Mức lương cơ bản: </label>
									<b class="col-md-6 col-xs-6 dark">VND</b>
								</div>
								<div class="col-md-12">
									<label class="col-md-6 col-xs-6 ">Áp dụng từ ngày: </label>
									<b class="col-md-6 col-xs-6 dark"></b>
									
								</div>
								@endif
							</div>

							<div class="col-md-4 col-xs-12">
								<button class="btn btn-default" title="Chỉnh sửa mức lương cơ bản" id="btn-edit-payrate"><i class="fa fa-edit"></i>Chỉnh sửa</button>
								<button class="btn btn-default" title="Cập nhật mức lương cơ bản" id="btn-update-payrate"><i class="fa fa-share-square-o"></i>Cập nhật</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Quản lý thang lương</h2>
						<div class="clearfix"></div>
					</div>
					<div id="notify-payscale-manage"></div>
					<div class="x_content">
						<div class="btn-group">
							<div class="btn-group">
								<button  type="button"  class="btn btn-app" title="Tạo Phụ cấp mới"  id="btn-add">
									<span class="fa fa-plus"></span>Tạo
								</button>
								<button  type="button"  class="btn btn-app" title="Xem chi tiết"  id="btn-view">
									<span class="fa fa-info-circle"></span>Xem
								</button>
								<button type="button" class="btn btn-app" id="btn-edit" title="Chỉnh sửa phụ cấp" value="0">
									<span class="fa fa-edit"></span>Chỉnh sửa
								</button>
								<button type="button" class="btn btn-app" id="btn-update" title="Cập nhật phụ cấp" value="0">
									<span class="fa fa-share-square-o"></span>Cập nhật
								</button>
								<button type="button" class="btn btn-app" id="btn-delete" title="Xóa phụ cấp" value="0">
									<span class="fa fa-minus"></span>Xóa
								</button>

							</div>

							<div class="clearfix"></div>
						</div>

						<table class="table table-striped table-hover table-bordered" id="datatable" >
							<thead>
								<tr>
									<th><input type="checkbox" name="check-all" id="check-all"></th>
									<th>Mã</th>
									<th>Thang lương</th>
									<th>I</th>
									<th>II</th>
									<th>III</th>
									<th>IV</th>
									<th>V</th>
									<th>VI</th>
									<th>VII</th>
								</tr>
							</thead>
							<tbody id="pay-scale-list">
								@foreach($pay_scale as $scale)
								<tr id="pay_scale{{$scale->id}}">
									<td><input type="checkbox" name="check" id="check{{$scale->id}}" value="{{$scale->id}}"></td>
									<td class="dark"><b>{{$scale->pay_scale_code}}</b></td>
									<td><b class="dark">{{$scale->pay_scale}} </b>  <p class="green"> &nbsp - &nbsp Hệ số (%)</p><p class="blue"> &nbsp - &nbsp Mức lương (VND)</p></td>
									@foreach(json_decode($scale->range) as $key=>$value)
									<td class="text-right"><br><p class="green">{{number_format($value->rate, 2)}}</p><p class="blue">{{number_format($value->value)}}</p></td>
									@endforeach
									@for($i = 0; $i < (7-count(json_decode($scale->range))); $i++)
									<td></td>
									@endfor
								</tr>
								@endforeach
							</tbody>

						</table>
						<div class="text-right red"><h6>Ghi chú *: Đơn vị tính = 1 đồng</h6></div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->


<!-- modal pay scale -->
<div id="modal-scale" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-title-scale">Tạo thang lương</b></h3>
			</div>
			<div class="modal-body">
				<div id="modal-scale-notify"></div>
				<form class="form-horizontal form-label-left" id="form-scale">
					<div class="form-group">
						<label class="col-md-2" >Thang lương</label>
						<div class="col-md-4" id="input-user" >
							<input class="form-control" type="text"  name="pay_scale" id="pay_scale">
						</div>

						<label class="col-md-2">Mã thang lương</label>
						<div class="col-md-4" id="input-mail">
							<input class="form-control" type="text"  name="pay_scale_code" id="pay_scale_code" >
						</div>

					</div>

					<div class="form-group">
						<label class="col-md-2">Áp dụng từ: </label>
						<div class='col-sm-4'>
							<div class='input-group date' id='applied-begin-datepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="applied_begin" id="applied_begin" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<label class="col-md-2">đến</label>
						<div class='col-sm-4'>
							<div class='input-group date' id='applied-finish-datepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="applied_finish" id="applied_finish" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2" for="note"> Ghi chú</label>
						<div class="col-md-12">
							<textarea class="form-control" id="note" name="note" rows="3"></textarea>
						</div>
					</div>

					<label class="col-md-12 blue"><h4> Thêm bậc lương</h4></label>
					<br>

					<div class="form-group">
						<div class="col-md-1">
							<a class=" blue" value="1" title="Thêm bậc" id="btn-add-pay-range"><i class="fa fa-plus-circle fa-lg" ></i></a>

						</div>
						<label class="col-md-2 text-center" >Bậc lương</label>
						<label class="col-md-2 text-center" >Hệ số</label><label class="col-md-2 text-center" >Mức lương</label>
						<label class="col-md-5 text-center" >Chú thích</label>
					</div>
					<div id="pay-range-list">
					</div>
					<br>




				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				<button type="button" class="btn btn-danger" id="btn-modal-delete" value="0">Xóa</button>
				<button type="button" class="btn btn-warning" id="btn-modal-edit" value="edit">Chỉnh sửa</button>
				<button type="button" class="btn btn-success" id="btn-modal-update" value="update">Cập nhật</button>
				<button type="button" class="btn btn-success" id="btn-modal-save" value="add">Lưu</button>
				<input type="hidden" name="id_pay_scale" id="id_pay_scale" value="0">

			</div>

		</div>
	</div>
</div>
<!-- /modal scale -->

<!-- modal pay rate basic -->
<div id="modal-payrate" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-title-payrate"></b></h3>
			</div>
			<div class="modal-body">
				<div id="payrate-notify"></div>
				<form class="form-horizontal form-label-left" id="form-payrate">
					<div class="form-group">
						<label class="col-md-2 col-xs-4" for="pay_rate_basic"><p>Mức lương cơ bản</p></label>
						<div class="col-md-4 col-xs-8">
							<input type="text" name="pay_rate_basic" class="form-control"  id="pay_rate_basic" >
						</div>

						<label class="col-md-2 col-xs-4" for="payrate-applied_begin"><p>Áp dụng từ ngày: </p></label>
						<div class='col-md-4 col-xs-8 col-sm-4'>
							<div class='input-group date' id='payrate-applied-begin-datepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="payrate-applied_begin" id="payrate-applied_begin" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="payrate-note" class="col-md-2 col-xs-4">Ghi chú</label>:
						<div class="col-md-10 col-xs-8">
							<textarea  name="payrate-note" class="form-control" rows="3"  id="payrate-note" ></textarea>
						</div>
						
					</div>
					

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				<button type="button" class="btn btn-success" value="update" id="btn-save-payrate">Lưu</button>
				
			</div>

		</div>
	</div>
</div>
<!-- /modal pay rate basic -->

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



<script type="text/javascript" src="{{ asset('/js/hrm/pay_scale.js') }}"></script>


@endsection