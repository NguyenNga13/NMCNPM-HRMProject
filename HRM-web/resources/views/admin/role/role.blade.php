@extends('admin.layout.index')

@section('link')
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<meta name="_token" content="{{csrf_token()}}" />
@endsection 

@section('content')

<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Quản lý vai trò</h3>
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
		<div id="role-notify"></div>
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<!-- <div class="x_title">
						<h2>Danh sách</h2>
						<div class="clearfix"></div>
					</div> -->
					<div class="x_content">
						
						<p>

							<div class="btn-group">
								<button type="button" class="btn btn-app" title="Tạo mới" id="btn-add-role"> 
										<span class="fa fa-plus"></span>
									Tạo
								</button>
								<button type="button" class="btn btn-app" title="Xem" id="btn-view"> 
										<span class="fa fa-info-circle"></span>
									Xem
								</button>
								<button type="button" class="btn btn-app" id="btn-delete-group" title="Xóa">
										<span class="fa fa-minus"></span>
									Xóa
								</button>
								<button type="button" class="btn btn-app" title="Xuất file">
										<span class="fa fa-file-pdf-o"></span>
									Xuất
								</button>
							</div>
						</p>

						<table id="datatable" class="table table-striped table-bordered table-role">

							<thead>
								<tr>
									<th> <input type="checkbox" id="check-all" ></th>
									<th>Vai trò</th>
									<th>Mô tả</th>
									<th>Ngày tạo</th>
									<td>Thao tác</td>
								</tr>
							</thead>
							<tbody id="role-list">
								@foreach($role as $role)
								<tr id="role{{$role->id}}">
									<td><input type="checkbox" name="role-data" value="{{$role->id}}"></td>
									<td>{{$role->role}}</td>
									<td>{{$role->description}}</td>
									<td>{{$role->created_at}}</td>
									<td class="center-block">
										<span class="docs-tooltip" data-toggle="tooltip" title="Xem">
											<button class="btn btn-info btn-xs btn-view-role" id="btn-view-role" value="{{$role->id}}"><i class="fa fa-info-circle"></i></button>
										</span>
									<!-- 	<span class="docs-tooltip" data-toggle="tooltip" title="Sửa">
											<button class="btn btn-success btn-xs btn-edit-role" id="btn-edit-role" value="{{$role->id}}"><i class="fa fa-edit"></i>
											</button>
										</span> -->
										<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
											<button class="btn btn-danger btn-xs btn-delete-role" id="btn-delete-role" value="{{$role->id}}"><i class="fa fa-trash-o"></i></button>
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


<!-- modal role's detail -->
<div id="modal-role" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-role-title"></b></h3>
			</div>
			<div class="modal-body">
				<div id="role-detail-notify"></div>
				<form class="form-horizontal form-label-left" id="form-role">
					<div class="form-group">
						<label for="name"><p>Vai trò</p></label>:
						<input type="text" value="" name="role" class="form-control" placeholder="" id="role" >
						<div id="errorUserName">
						</div>
					</div>
					<div class="form-group">
						<label for="description">Mô tả</label>:
						<textarea value="" name="description" class="form-control" placeholder="" id="description" ></textarea>
						<div id="errorUserDescription">
						</div>
					</div>
					

				</form>

				<div id="permission-table">
					<label>Danh sách quyền</label>
					<table id="datatable" class="table table-striped table-bordered table-permission-role">
						<thead>
							<tr>
								<th>#</th>
								<th>Quyền</th>
								<th>Mô tả</th>
								<td>Thao tác</td>
							</tr>
						</thead>
						<tbody id="permission-role-list">
							<tr>
								<td></td>
								<td>Vai trò </td>
								<td>Mô tả </td>
								<td class="center-block">
									<span class="docs-tooltip" data-toggle="tooltip" title="Xóa khỏi role">
										<button class="btn btn-danger btn-xs btn-remove-permission" value=""><i class="fa fa-trash-o"></i></button>
									</span>
								</td>
								
							</tr>
						</tbody>
						
					</table>
				</div>


				<form class="form-horizontal form-label-left" id="form-permission-list">
					<a class="blue" id="btn-add-permission" value="0"><i class="fa fa-plus"></i> Thêm quyền</a>
					<div id="list-permission">
					</div>

				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn btn-info" id="btn-save" value="add">Lưu</button>
				<button type="button" class="btn btn-danger" id="btn-delete" value="">Xóa</button>
				<input type="hidden" name="id_role" id="id_role" value="0">
				
			</div>

		</div>
	</div>
</div>

<!-- /modal role's detail -->

@include('admin.layout.modal_confirm_delete')

<!-- dialog -->

<!-- <div class="modal fade" id="favoritesModal" 
tabindex="-1" role="dialog" 
aria-labelledby="favoritesModalLabel">
<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" 
			data-dismiss="modal" 
			aria-label="Close">
			<span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" 
			id="favoritesModalLabel">Tạo vai trò</h4>
		</div>
		<div class="modal-body">

			<form id="userCreateEditFormPermission" method="post">
				<div class="modal-body">
					<div class="form-group">
						<label for="name"><p>Vai trò</p></label>:
						<input type="text" value="" name="name" class="form-control" placeholder="" id="name">
						<div id="errorUserName">
						</div>
					</div>
					<div class="form-group">
						<label for="description">Mô tả</label>:
						<textarea value="" name="description" class="form-control" placeholder="" id="description"></textarea>
						<div id="errorUserDescription">
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<button type="button" 
			class="btn btn-default" 
			data-dismiss="modal">Thoát</button>
			<button type="button" class="btn btn-info">Refresh</button>
			<span class="pull-right">
				<button type="button" class="btn btn-primary">
					Tạo
				</button>
			</span>
		</div>
	</div>
</div>



</div>
-->

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

<script type="text/javascript" src="{{ asset('/js/admin/role.js') }}"></script>

@endsection