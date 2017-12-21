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
				<h3>Quản lý phụ cấp</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div id="notify-allowance"></div>

		<div class="row">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<div class="btn-group">
							<div class="btn-group">
								<button  type="button"  class="btn btn-app" title="Tạo Phụ cấp mới"  id="btn-add">
									<span class="fa fa-plus"></span>Tạo
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

						<form class="form-horizontal form-label-left" id="">
							<div class="form-group">
								<label class="col-md-2" >Phụ cấp</label>
								<div class="col-md-4"  >
									<select class="form-control" id="select-allowance">
										@foreach($allowance as $all)
										<option value="{{$all->id}}">{{$all->allowance}}</option>
										@endforeach
									</select>
								</div>

								<label class="col-md-2">Mã phụ cấp</label>
								<div class="col-md-4">
									<select class="form-control" id="select-allowance_code">
										@foreach($allowance as $all)
										<option value="{{$all->id}}">{{$all->allowance_code}}</option>
										@endforeach
									</select>
								</div>



							</div>
						</form>
						<label class="col-md-12 blue" style="margin-top: 10px; margin-bottom: 10px">Danh sách bậc phụ cấp</label>

						<div class="col-md-12">

							<table class="data table table-striped no-margin" id="table-allowance-level">
								<thead>
									<tr>
										<th>#</th>
										<th>Bậc</th>
										<th id="level-value">Tỷ lệ</th>
										<th>Giá trị</th>
										<th>Chú thích</th>
									</tr>
								</thead>
								<tbody id="allowance-level-list-body">
									@if(count($allowance) > 0)
									@foreach(json_decode($allowance[0]->value) as $key=>$level)
									<tr>
										<td>{{$key +1}}</td>
										<td>{{$level->level}}</td>
										<td>{{$level->rate}}</td>
										<td>{{$level->value}}</td>
										<td>{{$level->note}}</td>
									</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->


<!-- modal allowance -->
<div id="modal-allowance" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-title">Thêm phụ cấp</b></h3>
			</div>
			<div class="modal-body">
				<div id="allowance-notify"></div>
				<form class="form-horizontal form-label-left" id="form-allowance">
					<div class="form-group">
						<label class="col-md-2" >Phụ cấp</label>
						<div class="col-md-4" id="input-user" >
							<input class="form-control" type="text"  name="allowance" id="allowance">
						</div>

						<label class="col-md-2">Mã phụ cấp</label>
						<div class="col-md-4" id="input-mail">
							<input class="form-control" type="text"  name="allowance_code" id="allowance_code" >
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

					<label class="col-md-12 blue"><h4> Thêm mức phụ cấp</h4></label>
					<br>

					<div class="form-group">
						<div class="col-md-1">
							<a class=" blue" value="va" title="Thêm bậc" id="btn-add-allowance-level"><i class="fa fa-plus-circle fa-lg" ></i></a>
							
						</div>
						<label class="col-md-2 text-center" >Bậc</label>
						<label class="col-md-2 text-center" >Tỷ lệ (%)</label>
						<label class="col-md-2 text-center" >Mức phụ cấp</label>
						<label class="col-md-5 text-center" >Chú thích</label>
					</div>
					<div id="allowance-level-list">
					</div>
					<br>
					



				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				<button type="button" class="btn btn-success" id="btn-save" value="add">Lưu</button>
				<input type="hidden" name="id_allowance" id="id_allowance" value="0">
				
			</div>

		</div>
	</div>
</div>
<!-- /modal allowance -->

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

<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> -->



<script type="text/javascript" src="{{ asset('/js/hrm/allowance.js') }}"></script>


@endsection