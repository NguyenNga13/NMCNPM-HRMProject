@extends('admin.layout.index')

@section('link')

<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="{{asset('/css/admin/user.css')}}">


<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/> -->

<!-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->

	@endsection 
	@section('content')


	<!-- page content -->
	<div class="right_col" role="main">
		<div class="">
			<div class="page-title">
				<div class="title_left">
					<h3>Tạo tài khoản người dùng</h3>
				</div>
			</div>

			<div class="clearfix"></div>

			<div id="user-notify"></div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="x_content">
							<div>
								<button class="btn btn-app" type="button" id="btn-upload-file"><i class="fa fa-upload"></i>Upload file</button>
								<form class="form-horizontal form-label-left">
									<input type="hidden" name="user-list" id="user-list" value="{{json_encode($user)}}">
								</form>
							</div>
							<hr>
							<h4 style="font-size: 160%;" class="text-primary">Danh sách thông tin tài khoản</h4>
							<br>
							
							

							<table id="datatable" class="table table-striped table-bordered table-user">
								<thead>
									<tr>
										<th> <input type="checkbox" id="check-all" ></th>
										<th>STT</th>
										<th>Mã nhân viên</th>
										<th>Họ tên</th>
										<th>Phòng ban</th>
										<th>Chức vụ</th>
										<th>Vị trí</th>
										<th>Vai trò</th>
										<th>Kết quả</th>
									</tr>
								</thead>
								<tbody id="user-list-excel">
									@foreach($user as $key=>$value)
									@if($value->ma_nhan_vien)
									<tr>
										<td><input type="checkbox" id="check-user" value="{{$value->stt}}"></td>
										<td>{{$value->stt}}</td>
										<td>{{$value->ma_nhan_vien}}</td>
										<td>{{$value->ho_ten}}</td>
										<td>{{$value->phong_ban}}</td>
										<td>{{$value->chuc_vu}}</td>
										<td>{{$value->vi_tri}}</td>
										<td>{{$value->vai_tro}}</td>
										<td id="success{{$value->stt}}"></td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>

							<form class="form-horizontal form-label-left" id="form-role-list">
								<a class="blue" id="btn-add-role-user" value="0"><i class="fa fa-plus"></i> Thêm vai trò</a>
								<div id="list-role">
								</div>

							</form>

							<button class="btn btn-primary pull-right" id="btn-confirm-create"><i class="fa fa-plus"></i> Tạo </button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /page content -->

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

	<!-- <script type="text/javascript" src="{{ asset('/js/admin/user.js') }}"></script> -->


	<script type="text/javascript">
		$(document).ready(function(){



			var base_url = "/laravel/HRMProject/public/admin/user/";

			$('#btn-upload-file').click(function(){

				$('#modal-upload').modal('show');
			});

			// $('#btn-confirm-upload').click(function(e){
			// 	$.ajaxSetup({
			// 		headers: {
			// 			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			// 		}
			// 	});

			// 	e.preventDefault();

			// 	var formData = new FormData($('#form-upload')[0]);
			// 	var active_url = base_url + 'upload-file';

			// 	$.ajax({
			// 		type: 'POST',
			// 		url: active_url,
			// 		processData: false,
			// 		contentType: false,
			// 		data: formData,
			// 		success: function(data){

			// 			if(data.response_code == 1){
			// 				var row = "";
			// 				$.each(data.data, function(index, value){
			// 					if(value.ma_nhan_vien){

			// 						row += '<tr id="row' +value.stt + '">';
			// 						row += '<td><input type="checkbox" name="user-data" value="'+ value.stt +'"></td>';
			// 						row += '<th scope="row">'+ value.stt + '</th>';
			// 						row += '<td>' +value.ma_nhan_vien + '</td>';
			// 						row += '<td>' +value.ho_ten + '</td>';
			// 						row += '<td>' +value.phong_ban + '</td>';
			// 						row += '<td>' +value.chuc_vu + '</td>';
			// 						row += '<td>' +value.vi_tri + '</td>';
			// 						row += '<td>' +value.vai_tro + '</td>';
			// 						row += '<td id="success' + value.stt + '"></td>';
			// 						row += '</tr>';

			// 					}


			// 				});
			// 				$('#user-list-excel').html(row);

			// 				console.log(data);
			// 			}else{
			// 				$('#user-notify').html('<div class="alert alert-danger alert-xs">' + data.data +'</div>');
			// 			}
			// 			$('#modal-upload').modal('hide');

			// 		},
			// 		error: function(data){
			// 			console.log(data);
			// 		}

			// 	});
			// });


		// show list role to add for user
		$('#btn-add-role-user').click(function(){
			var id_user = $(this).val();
			console.log('id_user: ' +id_user);

			$.get(base_url + 'role-not/0', function(data){
				console.log(data);
				var role = "";
				$.each(data, function(index, value){
					role += '<div class="checkbox col-md-4 col-sm-6 col-xs-12">';
					role += '<label>';
					role += '<input type="checkbox" class="role-checkbox" value="' + value.id + '">';
					role += value.role + '</label>';
					role += '</div>';
				});

				$('#list-role').html(role);
			});
		});

		// check all checkbox
		$('#check-all').change(function(){
			$('input:checkbox').not(this).prop('checked', this.checked);
		});

		// confirm create list user
		$('#btn-confirm-create').click(function(e){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});

			e.preventDefault();

			var user_list = $('#user-list').val();
			console.log(user_list);



			if(user_list == '[]'){
				$('#user-notify').html('<div class="alert alert-danger alert-xs"> Không có dữ liệu nào để tạo tài khoản. Vui lòng tải file thông tin tài khoản cần tạo.</div>')
			}
			var selected = [];
			$('tbody input:checked').each(function(){
				selected.push($(this).attr('value'));
			});
			console.log(selected);


			var checked = [];
			$('#list-role input:checked').each(function(){
				checked.push($(this).attr('value'));
			});
			console.log(checked);

			$.each(JSON.parse(user_list), function(index, value){
				var length = selected.length;

				if(length){
					var i = 0;
					for(i = 0; i< length; i++){
						if(selected[i] == value.stt){
							console.log(value.ma_nhan_vien);
							var formData = {
								emp_code: value.ma_nhan_vien,
								name: value.ho_ten,
								position: value.vi_tri,
								role: checked, 
							}
							console.log(formData);

							$.ajax({
								type: "POST",
								url: base_url + 'confirm-add-by-file',
								data: formData,
								success: function(data){
									console.log('success: ', data);

									if(data == -1){
										$('#success' + value.stt).html('<div class = "red">Không tồn tại mã nhân viên</div>');
									}else if(data == 0){
										$('#success' + value.stt).html('<div style="color:orange">Tài khoản đã tồn tại</div>');
									}else{
										$('#success' + value.stt).html('<div class = "green">Thành công</div>');
									}
								},
								error: function(data){
									console.log('error: ', data);
								}
							});
						}
					}
				}else{
					var formData = {
						emp_code: value.ma_nhan_vien,
						name: value.ho_ten,
						position: value.vi_tri,
						role: checked, 
					}

					$.ajax({
						type: "POST",
						url: base_url + 'confirm-add-by-file',
						data: formData,
						success: function(data){
							console.log('success: ', data);

							if(data == -1){
								$('#success' + value.stt).html('<div class = "red">Không tồn tại mã nhân viên</div>');
							}else if(data == 0){
								$('#success' + value.stt).html('<div style="color:orange">Tài khoản đã tồn tại</div>');
							}else{
								$('#success' + value.stt).html('<div class = "green">Thành công</div>');
							}
						},
						error: function(data){
							console.log('error: ', data);
						}
					});

				}
				
				// console.log(value);
			});


			// var formData = {
			// 	user_list: user_list,
			// 	selected: selected,
			// 	checked: checked,
			// }
			// console.log(formData);

			// $.ajax({
			// 	type: "POST",
			// 	url: base_url + 'confirm-add-by-file',
			// 	data: formData,
			// 	success: function(data){
			// 		console.log('success: ', data);
			// 	},
			// 	error: function(data){
			// 		console.log('error: ', data);
			// 	}
			// });



		});
	});
</script>

@endsection