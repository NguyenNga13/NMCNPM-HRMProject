$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/admin/";



	// $('.btn-edit-permission').click(function(){
	// 	var id_permission = $(this).val();
	// 	console.log(id_permission);

	// 	$.get(base_url + 'permission-detail/' + id_permission, function(data){
	// 		console.log(data);

	// 		$('#permission').val(data.permission);
	// 		$('#description').val(data.description);
	// 		$('#id_permission').val(data.id);

	// 		$('#btn-save-permission').text('Sửa');
	// 		$('#btn-save-permission').val('update');
	// 		$('#permission-title').text('Sửa thông tin quyền');
	// 		$('#modal-permission').modal('show');

	// 	});
	// });


	// view permission to edit
	$('.table-permission').on('click', '.btn-edit-permission', function(){
		var id_permission = $(this).val();
		console.log(id_permission);

		$.get(base_url + 'permission-detail/' + id_permission, function(data){
			console.log(data);

			$('#permission').val(data.permission);
			$('#description').val(data.description);
			$('#id_permission').val(data.id);

			$('#btn-save-permission').text('Sửa');
			$('#btn-save-permission').val('update');
			$('#btn-delete').val(data.id);
			$('#btn-delete').show();
			$('#permission-title').text('Sửa thông tin quyền');
			$('#modal-permission').modal('show');

		});
	});

	// show modal to add permission
	$('#btn-add-permission').click(function(){
		$('#form-permission').trigger("reset");

		$('#permission-title').text('Tạo quyền mới');
		$('#btn-save-permission').val('add');
		$('#btn-save-permission').text('Tạo');
		$('#btn-delete').hide();
		$('#modal-permission').modal('show');
	});

	// add/edit permission
	$('#btn-save-permission').click(function(e){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		e.preventDefault();

		var formData = {
			permission: $('#permission').val(),
			description: $('#description').val(),
		}

		var state = $('#btn-save-permission').val();
		var type = "POST";
		var id_permission = $('#id_permission').val();
		var active_url = base_url;

		console.log(id_permission);

		if(state == 'update'){
			type = "PUT";
			active_url += 'permission-edit/' + id_permission;
		}
		if(state == 'add'){
			active_url += 'permission-add';
		}

		console.log(formData);
		console.log(active_url);

		$.ajax({
			type: type,
			url: active_url,
			data: formData,
			success: function(data){
				console.log(data);
				var row = '<tr id="permission'+ data.id +'">';
				row += '<td> <input type="checkbox" name="permission-data" value="' +data.id +'"></td>';
				row += '<td>' +data.permission + '</td>';
				row += '<td>' +data.description + '</td>';
				row += '<td>' + data.created_at + '</td>';
				row += '<td><span class="docs-tooltip" data-toggle="tooltip" title="Sửa">';
				row += '<button class="btn btn-success btn-xs btn-edit-permission" value="' + data.id + '" id="btn-edit-permission"><i class="fa fa-edit"></i></button>';
				row += '</span>';
				row += '<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">';
				row += '<button class="btn btn-danger btn-xs btn-delete-permission" id="btn-delete-permission" value="' + data.id + '" ><i class="fa fa-trash-o"></i></button>';
				row += '</span>';
				row += '</td></tr>';
				if(state == 'add'){
					$('tbody').append(row);
					$('#permission-notify').append('<div class="alert alert-success">Tạo mới thành công </div>');

				}else{
					// $('#permission'+id_permission).html(row);
					$('#permission'+id_permission).replaceWith(row);
					$('#permission-notify').html('<div class="alert alert-success">Cập nhật thành công </div>');

				}
				$('#form-permission').trigger('reset');
				$('#modal-permission').modal('hide');

			},
			error: function(data){
				console.log('Error: ', data);
				$('#permission-notify').html('<div class="alert alert-danger">Có lỗi xảy ra, xin vui lòng thử lại!</div>');
			}

		});
		// var formData = $('#userCreateEditFormPermission').serialize();

	});

	// delete a permission from table
	$('.table-permission').on('click', '.btn-delete-permission', function(){
		var id_permission = $(this).val();
		$('#btn-confirm-delete').val(id_permission);
		$('#delete-type').val('single');

		$.get(base_url + 'permission-detail/' + id_permission, function(data){
			$('#delete-message').html("Xóa quyền <b> " + data.permission + "</b>?");
			$('#modalConfirmDelete').modal('show');
		});
	});

	// delete permission from modal detail
	$('#btn-delete').click(function(){
		var id_permission = $(this).val();
		console.log(id_permission);

		$('#btn-confirm-delete').val(id_permission);
		$('#delete-type').val('single');

		$.get(base_url + 'permission-detail/' + id_permission, function(data){
			$('#delete-message').html("Xóa quyền <b> " + data.permission + "</b>?");
			$('#modalConfirmDelete').modal('show');
		});
	});

	// confirm delete
	$('#btn-confirm-delete').click(function(){
		var id = $(this).val();
		var delete_type = $('#delete-type').val();

		if(delete_type == 'single'){
			var active_url = base_url + "permission-delete/" +id;

			$.ajax({
				type: "GET", 
				url: active_url,
				success: function(data){
					console.log(data);
					$('#permission'+ id).remove();
					$('#modalConfirmDelete').modal('hide');
					$('#modal-permission').modal('hide');
					$('#permission-notify').html('<div class="alert alert-success">Xóa thành công quyền <b>' + data.permission+ '</b></div>');
				},
				error: function(data){
					$('#permission-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');
				}
			});
		}else{
			console.log("id: "+id);
			// console.log("id[0]: "+ id[0]);
			var active_url = base_url + "permission-delete-group/" +id;
			$.ajax({
				type: "GET",
				url: active_url,
				success: function(data){
					console.log(data)
					// var i = 0;
					// var arr = [];
					// arr = id.split(",");
					// var permit;
					// for(i= 0; i <id.length; i++){
					// 	$('#permission'+ arr[i]).remove();
					// }
					
					var permission = "";

					$.each(data, function(index, value){
						console.log(value.permission);
						$('#permission'+ value.id).remove();
						permission += value.permission + ", ";
					});

					$('#modalConfirmDelete').modal('hide');
					$('#permission-notify').html('<div class="alert alert-success">Đã xóa <b>' + permission+ '</b></div>');
				},
				error: function(data){
					console.log(data);
					$('#permission-notify').html('<div class="alert alert-danger">Đã xảy ra lỗi, xin vui lòng thử lại!</div>');
				}
			});
		}
		
	});




	$('#check-all').change(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	// delete permissions from table
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
		$('#modalConfirmDelete').modal('show');


		// var selected = [];
		// $('#checkboxes input:checked').each(function() {
		// 	selected.push($(this).attr('name'));
		// });
		// 
	});





});