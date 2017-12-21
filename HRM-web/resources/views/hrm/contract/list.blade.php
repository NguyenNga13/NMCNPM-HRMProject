@extends('hrm.layout.index')

@section('link')
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<meta name="_token" content="{!! csrf_token() !!}" />
@endsection 

@section('content')

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Hợp đồng lao động<small>&nbsp Danh sách</small></h3>
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
						<div class="">
							<div class="btn-group">

								<button type="button" class="btn btn-default" id="btn-add-contract"> 
									<span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
										<span class="fa fa-plus"></span>
									</span>
								</button>

								<button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
									<span class="docs-tooltip" data-toggle="tooltip" title="In">
										<span class="fa fa-print"></span>
									</span>
								</button>
								<button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
									<span class="docs-tooltip" data-toggle="tooltip" title="Xuất">
										<span class="fa fa-file-pdf-o"></span>
									</span>
								</button>
								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button"> Báo cáo  <span class="caret docs-tooltip" data-toggle="tooltip" title="Báo cáo">
									</span> </button>
									<ul class="dropdown-menu">
										<li><a href="#">Thống kê báo cáo</a>
										</li>
										<li><a href="#"></a>
										</li>
										<li><a href="#">Hợp đồng thử việc</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<br>
						<table id="table" class="table table-striped table-bordered table-hover nowrap"  cellspacing="0" width="100%">

							<thead>
								<tr>
									<th>Số hợp đồng</th>
									<th>Số quyết định</th>
									<th>Mã nhân viên</th>
									<th>Nhân viên</th>
									<th>Thể loại</th>
									<th>Số hợp đồng gốc</th>
									<th>Loại hợp đồng</th>
									<th>Thời hạn</th>
									<th>Ngày ký</th>
									<th>Ngày hiệu lực</th>
									<th>Ngày kết thúc</th>
									<th>Thao tác</th>
								</tr>
								<tr>
									<th><input type="text" data-column="0" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="1" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="2" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="3" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="4" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="5" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="6" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="7" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="8" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="9" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="10" class="form-control" placeholder="Search"></th>
									<th><input type="text" data-column="11" class="form-control" placeholder="Search"></th>
								</tr>
							</thead>

							<tbody>
								@foreach($contract_list as $contract)
								<tr>
									<td class="blue">{{$contract->contract_number}}</td>
									<td>{{$contract->decided_number}}</td>
									<td>{{convertIdEmp($contract->emp_profile->id)}}</td>
									<td>{{$contract->emp_profile->name}}</td>
									<?php
									$classify = "";
									if($contract->classify == 1)
										$classify = "Hợp đồng";
									else {
										$classify = "Phụ lục";
									}
									?>

									<td>{{$classify}}</td>
									<td>{{$contract->original_contract_number}}</td>
									<td>{{$contract->contract_type->type}}</td>
									<td>{{$contract->duration}}</td>
									<td>{{$contract->date_signed}}</td>
									<td>{{$contract->date_begin}}</td>
									<td>{{$contract->date_finish}}</td>
									<td>
										<span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin chi tiết">
											<button class="btn btn-info btn-xs btn-edit-contract" value="{{$contract->id}}"><i class="fa fa-pencil"></i></button>
										</span>
										<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
											<button class="btn btn-danger btn-xs btn-delete-contract" value="{{$contract->id}}"><i class="fa fa-trash"></i></button>
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

<!-- Modal contract labor -->
<div id="modalContract" class="modal fade" role="diolog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b>Hợp đồng</b></h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left"  id="formContract" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<div class="form-group">
						<label class="col-md-2" >Nhân viên</label>
						<div class="col-md-4">
							<input class="form-control" type="text"  name="contract-name_emp" id="contract-name_emp">
						</div>

						<label class="col-md-2">Mã nhân viên</label>
						<div class="col-md-4">
							<input class="form-control" type="text"  name="contract-id_emp" id="contract-id_emp">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Số hợp đồng *</label>
						<div class="col-md-4">
							<input class="form-control"  type="text"  name="contract-number" required="" id="contract-number">
						</div>

						<label class="col-md-2" >Số quyết định *</label>
						<div class="col-md-4">
							<input class="form-control"  type="text"  name="contract-decided_number" required="" id="contract-decided_number">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Loại hợp đồng</label>
						<div class="col-md-4">
							<select class="form-control" id="contract-type" name="contract-type">
								@foreach($contract_type as $type)
								<option value="{{$type->id}}">{{$type->type}}</option>
								@endforeach

							</select>
						</div>

						<label class="col-md-2" >Thời gian (tháng)</label>
						<div class="col-md-4">
							<input class="form-control"  type="text"  name="contract-duration" id="contract-duration">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Số hợp đồng gốc</label>
						<div class="col-md-4">
							<input class="form-control"  type="text"  name="contract-original_number" required="" id="contract-original_number">
						</div>

						<label class="col-md-2" >Phân loại</label>
						<div class="col-md-4">
							<select class="form-control" id="contract-classify" name="contract-classify">
								<option value="1">Hợp đồng</option>
								<option value="0">Phụ lục</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Đại diện</label>
						<div class="col-md-4">
							<input class="form-control"  type="text"  name="contract-delegate" id="contract-delegate">
						</div>
						<label class="col-md-2">Ngày ký</label>
						<div class="col-md-4">
							<div class='input-group date' id="ContractDateSignedDatepicker">
								<input type='text' class="form-control" placeholder="YYYY-MM-DD" name="contract-date_signed" id="contract-date_signed" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2">Ngày hiệu lực</label>
						<div class="col-md-4">
							<div class='input-group date' id="ContractDateBeginDatepicker">
								<input type='text' class="form-control" placeholder="YYYY-MM-DD" name="contract-date_begin" id="contract-date_begin" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<label class="col-md-2">Ngày hết hạn</label>
						<div class="col-md-4">
							<div class='input-group date' id="ContractDateFinishDatepicker">
								<input type='text' class="form-control" placeholder="YYYY-MM-DD" name="contract-date_finish" id="contract-date_finish" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2" >Mức lương</label>
						<div class="col-md-4">
							<input class="form-control"  type="text"  name="contract-salary" required="" id="contract-salary">
						</div>

						<label class="col-md-2" >Văn bản</label>
						<div class=" form-group col-md-4" id="content">
							<a class="col-md-2 blue" href="" id="contract-content_file" name="contract-content_file" type="hidden"> <span class="docs-tooltip" data-toggle="tooltip" title="Xem văn bản hợp đồng"><i class="fa fa-file-pdf-o"></i></span></a>
							<input class="col-md-10" type="file" name="contract-content" id="contract-content">

						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2">Ghi chú</label>
						<div class="col-md-10">
							<textarea class="form-control" rows="3" name="contract-note"></textarea>
						</div>
					</div>

					<hr>
					<div class="col-md-5 col-md-offset-8">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-danger btn-delete-contract" id="btn-delete-contract" value="">Delete</button>
						<button type="button" class="btn btn-primary" id="btn-save-contract" value="add">Save</button>
						<input type="hidden" name="contract-id" id="contract-id" value="0">
					</div>

				</form> 
			</div>
		</div>
	</div>

</div>
<!-- /Modal contract labor -->

@include('hrm.layout.modal_confirm_delete')



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

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript" src="{{ asset('/js/contract.js') }}"></script>



@endsection