@extends('admin.layout.index')

@section('link')

<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

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

		<div id="user-notify"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						
							<div class="btn-group">
								<div class="btn-group">
									<button  type="button" data-toggle="dropdown" class="btn btn-app dropdown-toggle" title="Tạo tài khoản người dùng" > 
										<span class="fa fa-plus"></span>
										Tạo
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li><a id="btn-add-user"> Đơn</a>
										</li>
										<li><a id="btn-add-list-user"> Danh sách (.xlsx)</a>
										</li>
									</ul>
								</div>

								
								
								<button type="button" class="btn btn-app" id="btn-delete-group" title="Xóa">
									<span class="fa fa-minus"></span>
									Xóa
								</button>
								<button type="button" class="btn btn-app btn-xs" title="Xuất file">

									<span class="fa fa-file-pdf-o"></span>

									Xuất
								</button>

								<!-- <div class="btn-group">
									<button data-toggle="dropdown" class="btn btn-app dropdown-toggle" type="button"><span class="fa fa-filter"></span> Lọc <span class="caret"></span> </button>
									<ul class="dropdown-menu">
										<li><a href="#">Nhân viên</a>
										</li>
										<li><a href="#">Nhân viên nhân sự</a>
										</li>
										<li><a href="#">Nhân viên kế toán</a>
										</li>
									</ul>
								</div>
 -->

							</div>
							<!-- 	<div class="solid"></div> -->
					
						<table id="datatable" class="table table-striped table-bordered table-user">
							<thead>
								<tr>
									<th>
										<input type="checkbox" id="check-all">
									</th>
									<th>Người dùng</th>
									<th>Mail</th>
									<th>Vị trí</th>
									<th>Trạng thái</th>
									<th>Ngày tạo</th>
									<th>Thao tác</th>
								</tr>
							</thead>
							<tbody id="user-list">
								@foreach($list_user as $user )
								<tr id="user{{$user->id}}">
									<td>
										<input type="checkbox"  value="{{$user->id}}">
									</td>
									<td>{{$user->name}}</td>
									<td>{{$user->email}}</td>
									<td>
										@if($user->position == 1)
										Quản trị viên
										@elseif($user->position == 2)
										Quản lý nhân sự
										@elseif($user->position == 3)
										Nhân viên
										@else
										@endif
									</td>
									<td>
										@if($user->active == 1)
										Hoạt động
										@elseif($user->active == 0)
										Khóa
										@endif
									</td>
									<td>{{$user->created_at}}</td>
									<td>
										<span class="docs-tooltip" data-toggle="tooltip" title="Xem tài khoản người dùng">
											<button class="btn btn-primary btn-xs btn-view-user" id="btn-view-user" value="{{$user->id}}"><i class="fa fa-folder"></i></button>
										</span>
										<span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin người dùng">
											<button class="btn btn-info btn-xs btn-view-info" id="btn-view-info" value="{{$user->id}}"><i class="fa fa-info-circle"></i></button>
										</span>
										<span class="docs-tooltip" data-toggle="tooltip" title="Xóa tài khoản người dùng">
											<button class="btn btn-danger btn-xs btn-delete-user" id="btn-delete-user" value="{{$user->id}}"><i class="fa fa-trash-o"></i></button>
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



<!-- modal view user -->
<div id="modal-user" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-user-title"></b></h3>
			</div>
			<div class="modal-body">
				<div id="user-detail-notify"></div>
				<form class="form-horizontal form-label-left" id="form-user">
					<div class="form-group">
						<label class="col-md-2" >Người dùng</label>
						<div class="col-md-4" id="input-user" >
							<input class="form-control" readonly="readonly" type="text"  name="user" id="user">
						</div>

						<label class="col-md-2">Mail</label>
						<div class="col-md-4" id="input-mail">
							<input class="form-control" readonly="readonly" type="text"  name="mail" id="mail" required="">
						</div>
					</div>
					<div id="error-user"></div>
					<div class="form-group">
						<label class="col-md-2" >Vị trí</label>
						<div class="col-md-4">
							<select class="form-control" name="position" id="position">
								<option value="3">Nhân viên</option>
								<option value="2">Quản lý nhân sự</option>
								<option value="1">Quản trị viên</option>
								
								
							</select>
						</div>

						<label class="col-md-2">Trạng thái</label>
						<div class="col-md-4">
							<select class="form-control" id="active" name="active">
								<option value="1">Hoạt động</option>
								<option value="0">Khóa</option>
							</select>
						</div>
					</div>

				</form>

				<div id="role-table">
					<label>Danh sách vai trò</label>
					<table id="datatable" class="table table-striped table-bordered table-role-user">
						<thead>
							<tr>
								<th>#</th>
								<th>Vai trò</th>
								<th>Mô tả</th>
								<td>Thao tác</td>
							</tr>
						</thead>
						<tbody id="role-user-list">
							<tr id="role-user">
								<td></td>
								<td>Vai trò </td>
								<td>Mô tả </td>
								<td>
									<span class="docs-tooltip" data-toggle="tooltip" title="Xem chi tiết vai trò">
										<button class="btn btn-primary btn-xs btn-view-role" value=""><i class="fa fa-folder-o"></i></button>
									</span>
									<span class="docs-tooltip" data-toggle="tooltip" title="Xóa vai trò khỏi hoạt động người dùng">
										<button class="btn btn-danger btn-xs btn-remove-role" value=""><i class="fa fa-trash-o"></i></button>
									</span>
								</td>
								
							</tr>
						</tbody>
						
					</table>
				</div>


				<form class="form-horizontal form-label-left" id="form-role-list">
					<a class="blue" id="btn-add-role-user" value="0"><i class="fa fa-plus"></i> Thêm vai trò</a>
					<div id="list-role">
					</div>

				</form>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn btn-info" id="btn-save" value="add">Lưu</button>
				<button type="button" class="btn btn-danger" id="btn-delete" value="">Xóa</button>
				<input type="hidden" name="id_user" id="id_user" value="0">
				
			</div>

		</div>
	</div>
</div>

<!-- /modal view user -->

<!-- modal view info user -->
<div id="modal-info" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-user-title">Thông tin nhân viên</b></h3>
			</div>
			<div class="clearfix"></div>
			<div class="modal-body">
				<div class="col-md-4 col-sm-4 col-xs-12">
					<div class="">
						<div class="profile_img" id="user-image">
							<img class="center-block" src="image/employee/cardimage/N0001.jpg" alt="Avatar">
						</div>
						
					</div>
					
				</div>
				<div class="col-xs-12 col-md-6 col-sm-6 pull-left" >
					<div class="text-center" ><h4><b>
						<div class="col-sm-10 col-md-10 col-xs-12" id="user-name" style="padding-bottom: 17px">Nguyễn Tuấn Anh</div>
					</b></h4></div>
					<br>
					
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<i class="fa fa-user col-md-1"></i>
							<label class="col-md-4">Mã nhân viên</label>
							<div class="col-md-7" id="user-code">E0001</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<i class="fa fa-calendar col-md-1"></i>
							<label class="col-md-4">Ngày băt đầu</label>
							<div class="col-md-7" id="user-begin">2012/01/13</div>
						</div>
						
					</div>
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<i class="fa fa-briefcase col-md-1"></i>
							<label class="col-md-4">Chức vụ</label>
							<div class="col-md-7" id="user-position">Nhân viên</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<i class="fa fa-map-marker col-md-1"></i>
							<label class="col-md-4">Phòng ban</label>
							<div class="col-md-7" id="user-department">Phòng nhân sự</div>
						</div>
						
					</div>
					<div class="form-group">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<i class="fa fa-phone-square col-md-1"></i>
							<label class="col-md-4">Điện thoại</label>
							<div class="col-md-7" id="user-phone">01633389723</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12">
							<i class="fa fa-envelope col-md-1"></i>
							<label class="col-md-4">Email</label>
							<div class="col-md-7" id="user-email">anhnh@gmail.com</div>
						</div>
						
					</div>

					
				</div>
				
			</div>
			<div class="clearfix"></div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-right" data-dismiss="modal">Thoát</button>

			</div>

		</div>
	</div>
</div>
<!-- /modal view info user -->



<!-- modal role's detail -->
<div id="modal-view-role" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-role-title">Chi tiết vai trò</b></h3>
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
								<!-- <td>Thao tác</td> -->
							</tr>
						</thead>
						<tbody id="permission-role-list">
							<tr>
								<td></td>
								<td>Vai trò </td>
								<td>Mô tả </td>
								<!-- <td class="center-block">
									<span class="docs-tooltip" data-toggle="tooltip" title="Xóa khỏi role">
										<button class="btn btn-danger btn-xs btn-remove-permission" value=""><i class="fa fa-trash-o"></i></button>
									</span>
								</td> -->
								
							</tr>
						</tbody>
						
					</table>
				</div>



				<a href="admin/role" class="blue" id="btn-add-permission" value="0"><i class="fa fa-share"></i> Quản lý vai trò </a>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
				
			</div>

		</div>
	</div>
</div>

<!-- /modal role's detail -->


@include('admin.layout.modal_confirm_delete')
@include('admin.layout.modal_notify')
@include('admin.layout.modal_upload_file')

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

<script type="text/javascript" src="{{ asset('/js/admin/user.js') }}"></script>

@endsection