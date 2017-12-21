$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/admin/";

	// view role
	$('.table-role').on('click', '.btn-view-role', function(){	
		var id_role = $(this).val();
		console.log(base_url +'role/detail/' + id_role);

		$.get(base_url +'role/detail/' + id_role, function(data){
			console.log(data);

			$('#role').val(data.role);
			$('#description').val(data.description);

			$('#btn-edit').val(data.id);
			$('#btn-delete').val(data.id);
			$('#btn-add-permission').val(data.id);

			$('#id_role').val(data.id);
			$('#permission-table').show();

			var body = "";
			var i = 1;

			$.each(data.permission, function(index, value){
				body += '<tr id="permission-role' + value.id + '">';
				body += '<td>' + i + '</td>';
				body += '<td>' + value.permission + '</td>';
				body += '<td>' + value.description + '</td>';
				body += '<td>';
				body += '<span class="docs-tooltip" data-toggle="tooltip" title="Xóa khỏi role">';
				body += '<button class="btn btn-danger btn-xs btn-remove-permission" id="btn-remove-permission" value="' + value.id +'">';
				body += '<i class="fa fa-trash-o"></i>';
				body += '</button></span></td></tr>';
				i++;
			});

			
			$('#permission-role-list').html(body);

			$('#list-permission').html('');
			$('#modal-role-title').text('Chi tiết vai trò');
			$('#btn-save').val('update');
			$('#modal-role').modal('show');

		});
	});

	// show list permission to add for role
	$('#btn-add-permission').click(function(){
		var id_role = $(this).val();
		console.log(id_role);


		$.get(base_url + "role/permission-not/" +id_role, function(data){
			console.log(data);
			var per = "";
			$.each(data, function(index, value){
				per += '<div class="checkbox col-md-4 col-sm-6 col-xs-12">';
				per += '<label>';
				per += '<input type="checkbox" class="permission-checkbox" value="' + value.id + '">';
				per += value.permission + '</label>';
				per += '</div>';
			});

			$('#list-permission').html(per);
		});
	});

	// show modal add role
	$('#btn-add-role').click(function(){

		$('#form-role').trigger('reset');
		$('#btn-add-permission').val(0);
		$('#permission-table').hide();
		$('#list-permission').html('');
		$('#modal-role-title').text('Tạo mới vai trò');
		$('#btn-save').val('add');
		$('#modal-role').modal('show');
	});

	// add/update permission
	$('#btn-save').click(function(e){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		e.preventDefault();

		var checked = [];
		$('#list-permission input:checked').each(function(){
			checked.push($(this).attr('value'));
		});

		console.log(checked);
		console.log(checked.length);

		var formData = {
			role: $('#role').val(),
			description: $('#description').val(),
			permission: checked,
		}

		console.log("data: ", formData);

		var state = $('#btn-save').val();
		var type = "POST";
		var id_role = $('#id_role').val();
		console.log("id_role: " + id_role);
		var active_url = base_url;
		if(state == 'update')
			active_url += 'role/edit/' + id_role;
		else
			active_url += 'role/add';

		$.ajax({
			type: type,
			url: active_url,
			data: formData,
			success: function(data){
				console.log(data);
				var row = '<tr id="role' + data.role.id +'">';
				row += '<td><input type="checkbox" name="role-data" value="'+ data.role.id +'"></td>';
				row += '<td>' + data.role.role + '</td>';
				row += '<td>' + data.role.description + '</td>';
				row += '<td>' + data.role.created_at + '</td>';
				row += '<td>';
				row += '<span class="docs-tooltip" data-toggle="tooltip" title="Xem">';
				row += '<button class="btn btn-info btn-xs btn-view-role" id="btn-view-role" value="' + data.role.id + '">';
				row += '<i class="fa fa-info-circle"></i>';
				row += '</button></span>';
				row += '<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">';
				row += '<button class="btn btn-danger btn-xs btn-delete-role" id="btn-delete-role" value="' + data.role.id + '">';
				row += '<i class="fa fa-trash-o"></i>';
				row += '</button></span>';
				row += '</td>';
				row += '</tr>';

				if(state == 'add')
				{
					$('#role-list').append(row);
					$('#role-notify').html('<div class="alert alert-success">Tạo role <b>' +  data.role.role +'</b> thành công </div>');
				}else{
					$('#role'+id_role).replaceWith(row);
					$('#role-notify').html('<div class="alert alert-success">Cập nhật role <b>' +  data.role.role +'</b> thành công </div>');
				}

				$('#form-role').trigger('reset');
				$('#modal-role').modal('hide');
			},
			error: function(data){
				console.log('Error: ', data);
				$('#role-notify').html('<div class="alert alert-danger">Có lỗi xảy ra, xin vui lòng thử lại!</div>');
			}
		});			
	});


	// delete a role from table
	$('.table-role').on('click', '.btn-delete-role', function(){
		var id_role = $(this).val();
		$('#btn-confirm-delete').val(id_role);
		$('#delete-type').val('single');

		$.get(base_url + 'role/detail/' + id_role, function(data){
			$('#delete-message').html("Xóa vai trò <b> " + data.role + "</b>?");
			$('#modal-confirm-delete').modal('show');
		});
	});


	// delete role from modal detail
	$('#btn-delete').click(function(){
		var id_role = $(this).val();
		$('#btn-confirm-delete').val(id_role);
		$('#delete-type').val('single');

		$.get(base_url + 'role/detail/' + id_role, function(data){
			$('#delete-message').html("Xóa vai trò <b> " + data.role + "</b>?");
			$('#modal-confirm-delete').modal('show');
		});
	});

	// confrim delete
	$('#btn-confirm-delete').click(function(){
		var id = $(this).val();
		var delete_type = $('#delete-type').val();
		if(delete_type == 'single'){
			var active_url = base_url + "role/delete/" +id;
			$.ajax({
				type: "GET",
				url: active_url,
				success: function(data){
					console.log('delete: ', data);
					$('#role'+id).remove();
					$('#modal-confirm-delete').modal('hide');
					$('#modal-role').modal('hide');
					$('#role-notify').html('<div class="alert alert-success">Xóa thành công quyền <b>' + data.role+ '</b></div>')
				},
				error: function(data){
					$('#permission-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');
				}
			});
		}else if(delete_type == 'group'){
			console.log("id: "+id);
			var active_url = base_url + "role/delete-group/" +id;

			$.ajax({
				type: "GET",
				url: active_url,
				success: function(data){
					console.log(data);
					var role = "";
					$.each(data, function(index, value){
						console.log(value.role);
						$('#role'+value.id).remove();
						role += value.role + ", ";
					});

					$('#modal-confirm-delete').modal('hide');
					$('#role-notify').html('<div class="alert alert-success">Đã xóa <b>' + role + '</b></div>');


				},
				error: function(data){
					$('#role-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');

				}
			});

		}else if(delete_type == 'remove_permission'){
			var active_url = base_url + 'role/remove-permission/' + id;
			$.ajax({
				type: "GET",
				url: active_url,
				success: function(data){
					console.log('remove: ', data);
					if(data == 0){
						$('#role-detail-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');
					}else{
						$('#permission-role' + data.id).remove();
						$('#role-detail-notify').html('<div class="alert alert-success">Xóa thành công quyền <b>' + data.permission+ '</b> khỏi vai trò</div>');
					}
					$('#modal-confirm-delete').modal('hide');
					

				},
				error: function(data){
					$('#role-detail-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');
				}
			});

		}else{

		}
	});

	// remove permission from role == delere permission_role
	$('.table-permission-role').on('click', '.btn-remove-permission', function(){
		
		var id_permission = $(this).val();
		var id_role = $('#id_role').val();
		console.log(id_permission + " - id_role: " + id_role);
		$('#btn-confirm-delete').val(id_permission + "-" +id_role);
		$('#delete-type').val('remove_permission');

		$.get(base_url + 'permission-detail/' + id_permission, function(data){
			console.log(data);
			$('#delete-message').html("Xóa quyền <b> " + data.permission + "</b> khỏi vai trò?");
			$('#modal-confirm-delete').modal('show');
		});
	});

	$('#check-all').change(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	// delete roles from table
	$('#btn-delete-group').click(function(){
		var selected = [];
		$('tbody input:checked').each(function(){
			selected.push($(this).attr('value'));
		});

		var length = selected.length;

		console.log(selected);
		console.log(selected[1]);
		console.log(' length: ' +length);

		$('#btn-confirm-delete').val(selected);
		$('#delete-type').val('group');


		$('#delete-message').html("Xóa các mục đã chọn? ");
		$('#modal-confirm-delete').modal('show');
	});



	
});