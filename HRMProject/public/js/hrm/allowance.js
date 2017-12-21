$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/hrm/salary/source/allowance/";

	$('#btn-add').click(function(){
		$('#form-allowance').trigger('reset');
		$('#allowance-level-list').html('');
		$('#btn-add-allowance-level').val(1);
		$('#btn-save').val('add');
		$('#modal-allowance').modal('show');

	});

	$('#allowance').change(function(){
		var allowance = $(this).val();
		$.get(base_url + 'new-code/' + allowance, function(data){
			if(data == '0'){
				$('#allowance-notify').html('<div class="alert alert-danger alert-xs">Phụ cấp đã tồn tại!</div>');
				$('#btn-save').prop('disabled', true);
			}else{
				$('#allowance_code').val(data);
				$('#btn-save').prop('disabled', false);
				$('#allowance-notify').html('');
			}
		});
	});

	// add form to add allowance level
	$('#btn-add-allowance-level').click(function(){

		var add = $(this).val();
		add = parseInt(add);
		console.log(add);

		var allowance_code = $('#allowance_code').val();


		var row = '<div class="form-group" id="allowance-level' + add+ '">';
		row += '<div class="col-md-1">';
		row += '<a class="red remove-allowance-level" id="remove' + add +'" value="' + add +'" title="Xóa bậc"><i class="fa fa-minus-circle" ></i></a>';
		row += '</div>';
		row += '<div class="col-md-2">';
		row += '<input type="text" name="level' + add +'" id="level' + add +'" class="form-control">';
		row += '</div>'
		row += '<div class="col-md-2">';
		row += '<input type="number" name="rate' + add +'" id="rate' + add +'" class="form-control" step="any">';
		row += '</div>'
		row += '<div class="col-md-2">';
		row += '<input type="number" name="value' + add +'" id="value' + add +'" class="form-control" step="any">';
		row += '</div>'
		row += '<div class="col-md-5">';
		row += '<input type="text" name="note' + add +'" id="note' + add +'" class="form-control">';
		row += '</div>';
		row += '</div>';

		$('#allowance-level-list').append(row);
		$('#remove' +add).val(add);
		$('#level' +add).val(allowance_code + '-' + add);
		$('#btn-add-allowance-level').val(add +1);
		$('#remove' + (add-1)).prop('disabled', true).removeClass("red").addClass("gray");

	});

	$('#allowance-level-list').on('click', '.remove-allowance-level', function(){
		
		var remove = $(this).val();
		console.log('remove: ' + remove);
		remove = parseInt(remove);

		var level = $('#btn-add-allowance-level').val();
		level = parseInt(level);

		
		if(level >1 ){
			$('#btn-add-allowance-level').val(level-1);
		}
		
		$('#remove' + (remove-1)).prop('disabled', false).removeClass("gray").addClass("red");

		$('#allowance-level' + remove).remove();

	});

	$('#btn-save').click(function(e){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		e.preventDefault();

		var state = $(this).val();

		var allowance = $('#allowance').val();
		var allowance_code = $('#allowance_code').val();
		var applied_begin = $('#applied_begin').val();
		var level = $('#btn-add-allowance-level').val();

		console.log('save - level: ' + level);

		if(allowance == ''){
			$('#allowance-notify').html('<div class="alert alert-danger alert-xs">Chưa nhập phụ cấp!</div>');
		}else if(allowance_code == ''){
			$('#allowance-notify').html('<div class="alert alert-danger alert-xs">Chưa nhập mã phụ cấp!</div>');
		}else if(applied_begin == ''){
			$('#allowance-notify').html('<div class="alert alert-danger alert-xs">Chưa nhập thời gian bắt đầu áp dụng!</div>');
		}else if(level == 0 || level == ''){
			$('#allowance-notify').html('<div class="alert alert-danger alert-xs">Thêm mức phụ cấp!</div>');
		}else{

			var arr = [];
			for(var i = 1; i <level; i++){
				var valueData = {
					allowance_code: allowance_code,
					level: $('#level'+ i).val(),
					rate: $('#rate' +i).val(),
					value: $('#value' +i).val(),
					note: $('#note' +i).val(),
				}
				console.log(valueData);
				arr.push(valueData);
			}

			var value = JSON.stringify(arr);


			var formData = {
				allowance: allowance,
				allowance_code: allowance_code,
				value: value,
				applied_begin: applied_begin,
				applied_finish: $('#applied_finish').val(),
				note: $('#note').val(),
			}

			console.log(formData);

			var type = "POST";
			var active_url = base_url;
			var level_url = base_url;
			var id_allowance = $('#id_allowance').val();
			if(state == "add"){
				type = "POST";
				active_url += 'add';
				level_url += 'level/add';
			}else if(state == 'update'){
				type = "POST";
				active_url += 'update/' +id_allowance;
			}else{
				type = "PUT";
				active_url += 'edit/' + id_allowance;
				
			}

			$.ajax({
				type: type,
				url: active_url,
				data: formData,
				success: function(data){
					console.log('success: ', data);

					if(state == 'add'){
						var select_allowance = '<option value="' + data.id + '" selected >' + data.allowance +'</option>';
						$('#select-allowance').append(select_allowance);
						var select_code = '<option value="' + data.id + '" selected >' + data.allowance_code +'</option>';
						$('#select-allowance_code').append(select_code);

						$('#btn-edit').val(data.id);
						$('#btn-update').val(data.id);
						$('#btn-delete').val(data.id);


					}

					var row = "";

					$.each(JSON.parse(data.value), function(index, value){
						row += '<tr>';
						row += '<td>' + (index+1) + '</td>';
						row += '<td>' + value.level + '</td>';
						row += '<td>' + value.rate  + '</td>';
						row += '<td>' + value.value + '</td>';
						row += '<td>' + value.note  + '</td>';
						row += '</tr>';
					});
					$('#allowance-level-list-body').html(row);


					// var $arr = [];
					// for(var i = 1; i <level; i++){
					// 	var valueData = {
					// 		allowance_code: allowance_code,
					// 		level: $('#level'+ i).val(),
					// 		rate: $('#rate' +i).val(),
					// 		value: $('#value' +i).val(),
					// 		note: $('#note' +i).val(),
					// 	}
					// 	console.log(valueData);
					// 	$arr.push(valueData);

					// 	if(state == "update" || state == "edit"){
					// 		level_url += 'level/edit/' + i;
					// 	}

					// 	$.ajax({
					// 		type: type,
					// 		url: level_url,
					// 		data: valueData,
					// 		success: function(data){
					// 			console.log('success level: ', data);
					// 		},
					// 		error: function(data){
					// 			console.log('error level: ', data);
					// 		}
					// 	});
					// }

					// console.log(JSON.stringify($arr));
				},
				error: function(data){
					console.log('error: ', data);
				}
			});

			$('#form-allowance').trigger('reset');
			$('#modal-allowance').modal('hide');
			
		}
	});


	$('#btn-edit').click(function(){
		var id_allowance = $(this).val();
		console.log(id_allowance);

		$.get(base_url + 'allowance/' +id_allowance, function(data){
			console.log(data);
			$('#allowance').val(data.allowance);
			$('#allowance_code').val(data.allowance_code);
			$('#applied_begin').val(data.applied_begin);
			$('#applied_finish').val(data.applied_finish);
			$('#note').val(data.note);
			$('#id_allowance').val(data.id);

			var value = JSON.parse(data.value);
			// var row = '';
			$('#allowance-level-list').html('');
			$.each(value, function(index, value){
				console.log(value.level);
				console.log(index);
				index = parseInt(index);
				var row = '';

				row += '<div class="form-group" id="allowance-level' + (index+1) + '">';
				row += '<div class="col-md-1">';
				row += '<a class="gray remove-allowance-level" id="remove' + (index+1) +'" title="Xóa bậc" ><i class="fa fa-minus-circle" ></i></a>';
				row += '</div>';
				row += '<div class="col-md-2">';
				row += '<input type="text" name="level' + (index+1) +'" id="level' + (index+1) +'" class="form-control" value="' + value.level + '">';
				row += '</div>'
				row += '<div class="col-md-2">';
				row += '<input type="number" name="rate' + (index+1) +'" id="rate' + (index+1) +'" class="form-control" step="any" value="' + value.rate + '">';
				row += '</div>'
				row += '<div class="col-md-2">';
				row += '<input type="number" name="value' + (index+1) +'" id="value' + (index+1) +'" class="form-control" step="any" value="' + value.value + '">';
				row += '</div>'
				row += '<div class="col-md-5">';
				row += '<input type="text" name="note' + (index+1) +'" id="note' + (index+1) +'" class="form-control" value="' + value.note + '">';
				row += '</div>';
				row += '</div>';
				$('#allowance-level-list').append(row);
				$('#remove' + (index+1)).val(index+1).prop('disabled', true);
			});
			// $('#allowance-level-list').html(row);
			$('#btn-add-allowance-level').val(value.length+1);
			$('#remove'+value.length).prop('disabled', false).removeClass("gray").addClass("red");


			$('#btn-save').val('edit');

			$('#modal-allowance').modal('show');
		});
	});
	$('#btn-update').click(function(){
		var id_allowance = $(this).val();
		console.log(id_allowance);

		$.get(base_url + 'allowance/' +id_allowance, function(data){
			console.log(data);
			$('#allowance').val(data.allowance);
			$('#allowance_code').val(data.allowance_code);
			$('#applied_begin').val(data.applied_begin);
			$('#applied_finish').val(data.applied_finish);
			$('#note').val(data.note);
			$('#id_allowance').val(data.id);

			var value = JSON.parse(data.value);
			// var row = '';
			$('#allowance-level-list').html('');
			$.each(value, function(index, value){
				console.log(value.level);
				console.log(index);
				index = parseInt(index);
				var row = '';

				row += '<div class="form-group" id="allowance-level' + (index+1) + '">';
				row += '<div class="col-md-1">';
				row += '<a class="gray remove-allowance-level" id="remove' + (index+1) +'" title="Xóa bậc" ><i class="fa fa-minus-circle" ></i></a>';
				row += '</div>';
				row += '<div class="col-md-2">';
				row += '<input type="text" name="level' + (index+1) +'" id="level' + (index+1) +'" class="form-control" value="' + value.level + '">';
				row += '</div>'
				row += '<div class="col-md-2">';
				row += '<input type="number" name="rate' + (index+1) +'" id="rate' + (index+1) +'" class="form-control" step="any" value="' + value.rate + '">';
				row += '</div>'
				row += '<div class="col-md-2">';
				row += '<input type="number" name="value' + (index+1) +'" id="value' + (index+1) +'" class="form-control" step="any" value="' + value.value + '">';
				row += '</div>'
				row += '<div class="col-md-5">';
				row += '<input type="text" name="note' + (index+1) +'" id="note' + (index+1) +'" class="form-control" value="' + value.note + '">';
				row += '</div>';
				row += '</div>';
				$('#allowance-level-list').append(row);
				$('#remove' + (index+1)).val(index+1).prop('disabled', true);
			});
			// $('#allowance-level-list').html(row);
			$('#btn-add-allowance-level').val(value.length+1);
			$('#remove'+value.length).prop('disabled', false).removeClass("gray").addClass("red");


			$('#btn-save').val('update');

			$('#modal-allowance').modal('show');
		});




	});
	$('#btn-delete').click(function(){
		var id_allowance = $(this).val();
		console.log(id_allowance);

		$.get(base_url + 'allowance/' + id_allowance, function(data){
			$('#delete-message').html("Xóa phụ cấp <b> " + data.allowance + "</b>?");
			$('#btn-confirm-delete').val(data.id);
			$('#modalConfirmDelete').modal('show');
		});

	});

	$('#btn-confirm-delete').click(function(){
		var id = $(this).val();
		console.log(id);

		$.get(base_url + 'delete/' + id, function(allowance){
			$('#notify-allowance').html('<div class="alert alert-success">Xóa thành công <b>'+ allowance.allowance + '</b></div>');

			$.get(base_url + 'allowance/0', function(data){
				var select_allowance = '<option value="' + data.id + '" selected >' + data.allowance +'</option>';
						$('#select-allowance').append(select_allowance);
						var select_code = '<option value="' + data.id + '" selected >' + data.allowance_code +'</option>';
						$('#select-allowance_code').append(select_code);

						$('#btn-edit').val(data.id);
						$('#btn-update').val(data.id);
						$('#btn-delete').val(data.id);

						var row = "";

					$.each(JSON.parse(data.value), function(index, value){
						row += '<tr>';
						row += '<td>' + (index+1) + '</td>';
						row += '<td>' + value.level + '</td>';
						row += '<td>' + value.rate  + '</td>';
						row += '<td>' + value.value + '</td>';
						row += '<td>' + value.note  + '</td>';
						row += '</tr>';
					});
					$('#allowance-level-list-body').html(row);

			});

		});
	});


	$('#select-allowance').change(function(){
		var id_allowance = $(this).val();
		console.log(id_allowance);
		$('#select-allowance_code').val(id_allowance);

		$('#btn-edit').val(id_allowance);
		$('#btn-update').val(id_allowance);
		$('#btn-delete').val(id_allowance);

		$.get(base_url + 'list-level/' +id_allowance, function(data){
			console.log('list-level: ', data);
			var row = "";

			$.each(data, function(index, value){
				row += '<tr>';
				row += '<td>' + (index+1) + '</td>';
				row += '<td>' + value.level + '</td>';
				row += '<td>' + value.rate  + '</td>';
				row += '<td>' + value.value + '</td>';
				row += '<td>' + value.note  + '</td>';
				row += '</tr>';
			});
			$('#allowance-level-list-body').html(row);
		});
	});
	$('#select-allowance_code').change(function(){
		var id_allowance = $(this).val();
		$('#select-allowance').val(id_allowance);

		$('#select-allowance_code').val(id_allowance);

		$('#btn-edit').val(id_allowance);
		$('#btn-update').val(id_allowance);
		$('#btn-delete').val(id_allowance);

		$.get(base_url + 'list-level/' +id_allowance, function(data){
			console.log('list-level: ', data);
			var row = "";

			$.each(data, function(index, value){
				row += '<tr>';
				row += '<td>' + (index+1) + '</td>';
				row += '<td>' + value.level + '</td>';
				row += '<td>' + value.rate  + '</td>';
				row += '<td>' + value.value + '</td>';
				row += '<td>' + value.note  + '</td>';
				row += '</tr>';
			});
			$('#allowance-level-list-body').html(row);
		});

	});


 	// for datepicker
 	$('#applied-begin-datepicker').datetimepicker({
 		format: 'YYYY-MM-DD'
 	});
 	$('#applied-finish-datepicker').datetimepicker({
 		format: 'YYYY-MM-DD'
 	});
 });
