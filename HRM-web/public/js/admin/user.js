$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/admin/user/";

	// check all checkbox
	$('#check-all').change(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	// view user
	$('.table-user').on('click', '.btn-view-user', function(){
		var id_user = $(this).val();
		$.get(base_url + "detail/" +id_user, function(data){
			console.log(data);
			$('#modal-user-title').text('Chi tiết người dùng');

			$('#user').val(data.name);
			$('#mail').val(data.email);
			$('#position').val(data.position);
			$('#active').val(data.active);

			$('#id_user').val(data.id);
			$('#btn-edit').val(data.id);
			$('#btn-delete').val(data.id);
			$('#btn-add-role-user').val(data.id);
			$('#role-table').show();
			
			var body = "";
			var i = 1;
			$.each(data.role, function(index, value){
				body += '<tr id="role-user' + value.id + '">';
				body += '<td>' + i + '</td>';
				body += '<td>' + value.role + '</td>';
				body += '<td>' + value.description + '</td>';
				body += '<td>';
				body += '<span class="docs-tooltip" data-toggle="tooltip" title="Xem chi tiết vai trò">';
				body += '<button class="btn btn-primary btn-xs btn-view-role" value="' + value.id + '">';
				body += '<i class="fa fa-folder-o"></i></button></span>';
				body += '<span class="docs-tooltip" data-toggle="tooltip" title="Xóa vai trò khỏi hoạt động người dùng">';
				body += '<button class="btn btn-danger btn-xs btn-remove-role" value="' + value.id + '">';
				body += '<i class="fa fa-trash-o"></i></button></span>';
				body += '</td></tr>';
				i++;
			});

			$('#role-user-list').html(body);
			$('#list-role').html('');
			
			$('#btn-save').val('update');
			$('#modal-user').modal('show');

		});
		
	});

	// show list role to add for user
	$('#btn-add-role-user').click(function(){
		var id_user = $(this).val();
		console.log('id_user: ' +id_user);

		$.get(base_url + 'role-not/' + id_user, function(data){
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


	// show modal add user
	$('#btn-add-user').click(function(){
		$('#form-user').trigger('reset');
		$('#modal-user-title').text('Tạo mới vai trò');

		$('#input-user').html('<input class="form-control"  type="text"  name="user" id="user">');
		// $('#input-mail').html('<input class="form-control"  type="text"  name="mail" id="mail">');
		
		$('#btn-add-role-user').val(0);

		$.get(base_url + 'role-not/0', function(data){
			console.log(data);
			var role = "";
			$.each(data, function(index, value){
				role += '<div class="checkbox col-md-4 col-sm-6 col-xs-12">';
				role += '<label>';
				role += '<input type="checkbox" class="role-checkbox" required="" value="' + value.id + '">';
				role += value.role + '</label>';
				role += '</div>';
			});

			$('#list-role').html(role);
		});

		$('#role-table').hide();
		
		$('#btn-save').val('add');
		$('#btn-delete').hide();

		$('#user').change(function(){
			var emp_code = $(this).val();

			$.get(base_url + 'create-mail/' + emp_code, function(data){
				console.log(data);
				if(data.response_code == 1){
					$('#error-user').html('');
					$('#mail').val(data.data);
				}else{
					$('#mail').val('');
					$('#error-user').html('<div class="alert alert-danger alert-xs">' + data.data + '</div>');
				}
			});
		});

		$('#modal-user').modal('show');
	});


	// update/add user
	$('#btn-save').click(function(e){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		e.preventDefault();

		$name = $('#user').val();
		$mail = $('#mail').val();

		if($name == '' || $mail == ''){
			$('#error-user').html('<div class="alert alert-danger alert-xs"> Nhập tên người dùng là mã nhân viên tương ứng!</div>')
		}else{
			var checked = [];
			$('#list-role input:checked').each(function(){
				checked.push($(this).attr('value'));
			});

			console.log(checked);
			var formData = {
				name: $('#user').val(),
				email: $('#mail').val(),
				position: $('#position').val(),
				active: $('#active').val(),
				role: checked,
			}

			console.log("formData: ", formData);

			var state = $('#btn-save').val();
			var type = "POST";
			var id_user = $('#id_user').val();
			var active_url = base_url;
			if(state == "add"){
				active_url += 'add';
			}else{
				type = "PUT";
				active_url += 'edit/' +id_user;
			}

			$.ajax({
				type: type,
				url: active_url,
				data: formData,
				success: function(data){
					console.log('success: ', data);



					var row = '<tr id=user' + data.user.id + '">';
					row += '<td><input type="checkbox" value="' + data.user.id + '"></td>';
					row += '<td>'+ data.user.name + '</td>';
					row += '<td>'+ data.user.email + '</td>';
					if(data.user.position == 1)
						row += '<td> Quản trị viên </td>';
					else if(data.user.position == 2)
						row += '<td> Quản lý nhân sự </td>';
					else
						row += '<td> Nhân viên </td>';
					if(data.user.active == 1)
						row += '<td> Hoạt động </td>';
					else
						row += '<td> Khóa </td>';
					row += '<td>'+ data.user.created_at + '</td>';
					row += '<td><span class="docs-tooltip" data-toggle="tooltip" title="Xem tài khoản người dùng">';
					row += '<button class="btn btn-primary btn-xs btn-view-user" id="btn-view-user" value="'+data.user.id+'">';
					row += '<i class="fa fa-folder"></i>';
					row += '</button></span>';
					row += '<span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin người dùng">';
					row += '<button class="btn btn-info btn-xs btn-view-info" id="btn-view-info" value="'+data.user.id+'">';
					row += '<i class="fa fa-info-circle"></i>';
					row += '</button></span>';
					row += '<span class="docs-tooltip" data-toggle="tooltip" title="Xóa tài khoản người dùng">';
					row += '<button class="btn btn-danger btn-xs btn-delete-user" id="btn-delete-user" value="'+data.user.id+'">';
					row += '<i class="fa fa-trash-o"></i>';
					row += '</button></span></td>';
					row += '</tr>';

					if(state == 'add'){
						$('#user-list').append(row);
						$('#user-notify').html('<div class="alert alert-success">Tạo tài khoản người dùng <b>' +  data.user.name +'</b> thành công </div>');
					}else{
						$('#user'+id_user).replaceWith(row);
						$('#user-notify').html('<div class="alert alert-success">Cập nhật tài khoản người dùng <b>' +  data.user.name +'</b> thành công </div>');
					}

					$('#form-user').trigger('reset');
					$('#modal-user').modal('hide');
				},
				error: function(data){
					console.log('error: ', data);
					$('#user-notify').html('<div class="alert alert-danger">Có lỗi xảy ra, xin vui lòng thử lại!</div>');
				}
			});

		}
		
	});


	// delete a user from table
	$('.table-user').on('click', '.btn-delete-user', function(){
		var id_user = $(this).val();
		$('#btn-confirm-delete').val(id_user);
		$('#delete-type').val('single');
		$.get(base_url + 'detail/' + id_user, function(data){
			$('#delete-message').html("Xóa tài khoản người dùng <b> " + data.name + "</b>?");
			$('#modal-confirm-delete').modal('show');
		});
		
	});


	// delete user from modal detail
	$('#btn-delete').click(function(){
		var id_user = $(this).val();
		$('#btn-confirm-delete').val(id_user);
		$('#delete-type').val('single');

		$.get(base_url + 'detail/' + id_user, function(data){
			$('#delete-message').html("Xóa tài khoản người dùng <b> " + data.name + "</b>?");
			$('#modal-confirm-delete').modal('show');
		});
	});

	// delete users from table
	$('#btn-delete-group').click(function(){
		var selected = [];
		$('tbody input:checked').each(function(){
			selected.push($(this).attr('value'));
		});

		if(selected.length == 0){
			$('#notify-message').html('<b> Không có mục nào được chọn! </b>');
			$('#modal-notify').modal('show');
		}else{
			console.log(selected);

			$('#btn-confirm-delete').val(selected);
			$('#delete-type').val('group');


			$('#delete-message').html("Xóa các mục đã chọn? ");
			$('#modal-confirm-delete').modal('show');

		}

	});

	// remove role from user == delete role_user
	$('.table-role-user').on('click', '.btn-remove-role', function(){
		var id_role = $(this).val();
		var id_user = $('#id_user').val();
		console.log(id_role + " - " +id_user);

		$('#btn-confirm-delete').val(id_role + "-" +id_user);
		$('#delete-type').val('remove_role');

		$.get("/laravel/HRMProject/public/admin/role/detail/" + id_role, function(data){
			$('#delete-message').html("Xóa vai trò <b> " + data.role + "</b> khỏi tài khoản?");
			$('#modal-confirm-delete').modal('show');
		});


	});


	// confirm delete
	$('#btn-confirm-delete').click(function(){
		var id= $(this).val();
		var delete_type = $('#delete-type').val();
		console.log(id);

		// if(delete_type == 'single'){
		// 	var active_url = base_url + "delete/" + id;

		// 	$.get(active_url, function(data){
		// 		console.log(data);
		// 	});
		// }else if(delete_type == 'group'){
		// 	var active_url = base_url + 'delete-group/' +id;


		// }else if(delete_type = 'remove_role'){

		// }else{

		// }

		if(delete_type == 'remove_role'){
			var active_url = base_url + "remove-role/" +id;
			$.get(active_url, function(data){
				if(data == 0){
					$('#user-detail-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');
				}else{
					$('#role-user' + data.id).remove();
					$('#user-detail-notify').html('<div class="alert alert-success">Xóa thành công role <b>' + data.role+ '</b> khỏi tài khoản</div>');					

				}
				$('#modal-confirm-delete').modal('hide');

			});

		}else{
			var active_url = base_url + "delete/" + id;
			console.log(active_url);
			$.get(active_url, function(data){
				console.log(data);
				var user = "";
				$.each(data, function(index, value){
					$('#user'+ value.id).remove();
					user += value.name + ", ";
				});

				$('#modal-confirm-delete').modal('hide');
				$('#modal-user').modal('hide');
				$('#user-notify').html('<div class="alert alert-success">Đã xóa tài khoản người dùng <b>' + user + '</b></div>');

			});
		}


	});


	$('.table-user').on('click', '.btn-view-info', function(){
		
		var id_user = $(this).val();
		console.log(id_user);

		$.get(base_url + 'info/' + id_user, function(data){
			$('#user-image').html('<img class="center-block" src="image/employee/cardimage/' + data.photo_card + '" alt="Avatar">');
			$('#user-name').text( data.name);
			$('#user-code').text(data.emp_code);
			$('#user-begin').text(data.date_begin);
			$('#user-position').text(data.position);
			$('#user-department').text(data.department);
			$('#user-phone').text(data.phone);
			$('#user-email').text(data.email);


			$('#modal-info').modal('show');
		});
		
	});


	$('.table-role-user').on('click', '.btn-view-role', function(){
		var id_role = $(this).val();
		console.log(id_role);

		$.get("/laravel/HRMProject/public/admin/role/detail/" + id_role, function(data){
			console.log(data);

			$('#role').val(data.role);
			$('#description').val(data.description);

			var body = "";
			var i = 1;

			$.each(data.permission, function(index, value){
				body += '<tr id="permission-role' + value.id + '">';
				body += '<td>' + i + '</td>';
				body += '<td>' + value.permission + '</td>';
				body += '<td>' + value.description + '</td>';
				body += '</tr>';
				i++;
			});

			$('#permission-role-list').html(body);

			$('#modal-view-role').modal('show');
		});
		
	});

	// show modal upload file to create user
	$('#btn-add-list-user').click(function(){
		$('#modal-upload').modal('show');
	})



});
