@extends('admin.layout.index')

@section('link')

<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection 

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Quản lý người dùng</h3>
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
					<div class="x_title">
						<h2>Tài khoản nhân viên</h2>
						<!-- <ul class="nav navbar-right panel_toolbox">
							<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="#">Settings 1</a>
									</li>
									<li><a href="#">Settings 2</a>
									</li>
								</ul>
							</li>
							<li><a class="close-link"><i class="fa fa-close"></i></a>
							</li>
						</ul> -->
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<p>

							<div class="btn-group">

								<button type="button" class="btn btn-primary" data-toggle="modal" 
								data-target="#favoritesModal" data-method="setDragMode" data-option="move" title="Move"> 
								<span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
									<span class="fa fa-plus"></span></span>
									Tạo
								</button>
								<button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
									<span class="docs-tooltip" data-toggle="tooltip" title="Sửa">
										<span class="fa fa-edit"></span>
									</span>
									Sửa
								</button>
								<button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
									<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
										<span class="fa fa-minus"></span>
									</span>
									Xóa
								</button>

								<div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button"><span class="fa fa-filter"></span> Lọc <span class="caret"></span> </button>
									<ul class="dropdown-menu">
										<li><a href="#">Nhân viên</a>
										</li>
										<li><a href="#">Nhân viên nhân sự</a>
										</li>
										<li><a href="#">Nhân viên kế toán</a>
										</li>
									</ul>
								</div>


							</div>
						</p>
						<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
							<thead>
								<tr>
									<th>
										<th><input type="checkbox" id="check-all" class="flat"></th>
									</th>
									<th>Người dùng</th>
									<th>Chức vụ</th>
									<th>Phòng ban</th>
									<th>Vai trò</th>
									<th>Trạng thái</th>
									<th>Ngày tạo</th>
								</tr>
							</thead>
							<tbody>
								@for($i = 0; $i < 15; $i++ )
								<tr>
									<td>
										<th><input type="checkbox" id="check-all" class="flat" value=""></th>
									</td>
									<td>N000{{$i}}</td>
									<td>Chức vụ {{$i}}</td>
									<td>Phòng ban {{$i}}</td>
									<td>Vai trò {{$i}}</td>
									<td>{{$i}}</td>
									<td>2011/04/{{$i}}</td>
								</tr>
								@endfor
							</tbody>
						</table>
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

@endsection