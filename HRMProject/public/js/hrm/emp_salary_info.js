$(document).ready(function (){
	
	var base_url = "/laravel/HRMProject/public/hrm/salary/emp/";
	$('#btn-add').click(function(){
		console.log('hi');
		$('#modal-emp-salary').modal('show');
	});

	$('#btn-view').click(function(){
		var checked = getChecked();
		var id;
		if(checked.length == 0)
		{
			$('#notify-message').text('Không có mục nào được chọn!');
			$('#modal-notify').modal('show');
		}else if(checked.length > 1){
			$('#notify-message').text('Nhiều hơn một mục được chọn!');
			$('#modal-notify').modal('show');
		}else{
			id = checked[0];
			$.get(base_url + "emp-salary/" + id, function(data){

				$('#form-modal-emp-salary').trigger('reset');

				console.log('data: ', data)

				$('#id_emp').val(data.id);
				$('#emp_code').val(data.emp_code);
				$('#emp_name').val(data.name);
				$('#emp_position').val(data.position);
				$('#emp_department').val(data.department);

				if(data.pay_scale_code){
					$('#pay_scale').val(data.pay_scale_code);
					$.get('hrm/emp/pay_range/' + data.pay_scale_code, function(range){
						$('#pay_range').html('');
						$.each(range, function(index, value){
							var row = '<option value="' + value.level +'">'+value.level+'</option>';
							$('#pay_range').append(row);
						});
						$('#pay_range').val(data.pay_range);

					});

					$('#scale_applied_begin').val(data.salary_begin);
					$('#scale_applied_finish').val(data.salary_finish);

				}


				var row = '';
				$.each(data.allowance, function(index, value){
					row += '<tr id="' + value.allowance_code+'">';
					row += '<td><input type="checkbox"  name="check-allowance" value="'+ value.id +'"></td>';
					row += '<td>' + value.allowance        + '</td>';
					row += '<td>' + value.allowance_level  + '</td>';
					row += '<td>' + value.allowance_begin  + '</td>';
					row += '<td>' + value.allowance_finish + '</td>';
					row += '</tr>';

					// $('#emp-allowance-list').append('row')

					// $('#'+value.allowance_code).prop('checked', true);
					// $('#'+value.allowance_code+'_level').val(value.allowance_level);
					// $('#'+value.allowance_code+'_begin').val(value.allowance_begin);
				});

				$('#emp-allowance-list').html(row);

				$('#insurance_code').val(data.insurance_code);
				$('#date_begin_insurance').val(data.date_begin_insurance);

				$('#modal-emp-salary').modal('show');

			});
		}
	});


	$('#btn-modal-edit').click(function(){
		salaryExcute('edit');
	});

	$('#pay_scale').change(function(){
		var scale = $(this).val();
		$.get('hrm/emp/pay_range/' + scale, function(data){
			$('#pay_range').html('');
			$.each(data, function(index, value){
				var row = '<option value="' + value.level +'">'+value.level+'</option>';
				$('#pay_range').append(row);
			});
		});
	});

	$('#btn-add-allowance').click(function(){
		showAllowanceModal('add', '');

		
	});

	$('#btn-view-allowance').click(function(){
		var checked = getCheckedAllowance();
		var id;
		if(checked.length == 0){
			$('#emp-allowance-notify').html('<div class="alert alert-danger">Không có mục nào được chọn</div>');
		}else if(checked.length > 1){
			$('#emp-allowance-notify').html('<div class="alert alert-danger">Nhiều hơn 1 mục được chọn</div>');
		}else{
			id = checked[0];
			console.log('checked: ' +id);
			showAllowanceModal('view', id);
		}
	});

	$('#btn-delete-allowance').click(function(){

		var checked = getCheckedAllowance();
		var id;
		if(checked.length == 0){
			$('#emp-allowance-notify').html('<div class="alert alert-danger">Không có mục nào được chọn</div>');
		}else if(checked.length > 1){
			$('#emp-allowance-notify').html('<div class="alert alert-danger">Nhiều hơn 1 mục được chọn</div>');
		}else{
			$('#emp-allowance-notify').html('');
			id = checked[0];
			console.log('checked: ' +id);
			$('#delete-message').html('Xóa mục đã chọn?');
	 		$('#btn-confirm-delete').val(id);
			$('#modalConfirmDelete').modal('show');
		}

		
	});

	$('#btn-modal-delete-allowance').click(function(){
		var id = $(this).val();
		$('#delete-message').html('Xóa mục đã chọn?');
	 	$('#btn-confirm-delete').val(id);
		$('#modalConfirmDelete').modal('show');
	});

	$('#btn-confirm-delete').click(function(){
		var id = $(this).val();
		console.log(id);

		$.get(base_url + 'allowance/delete/' +id, function(data){
			console.log(data);
			if(data.last == 'true'){
				var row = '<tr id="' + data.allowance_code + '">';
				row += '<td><input type="checkbox"  name="check-allowance" value="'+ data.id+'"></td>';
				row += '<td>' + data.allowance + '</td>';
				row += '<td>' + data.allowance_level+ '</td>';
				row += '<td>' + data.applied_begin+ '</td>';
				row += '<td>' + data.applied_finish+ '</td>';

				$('#'+ data.allowance_code).replaceWith(row);
			}else if(data.last == 'false'){
				$('#' + data.allowance_code).remove();
			}

			$('#modalConfirmDelete').modal('hide');
			$('#emp-allowance-notify').html('<div class="alert alert-success">Đã xóa phụ cấp <b> '+data.allowance_level+' </b></div>');

		});
	})

	$('#btn-modal-edit-allowance').click(function(e){
		e.preventDefault();
		allowanceExcute('edit');
	});

	$('#btn-modal-update-allowance').click(function(e){
		e.preventDefault();
		allowanceExcute('update');
	});

	$('#btn-modal-save-allowance').click(function(e){
		e.preventDefault();
		allowanceExcute('add');
	});




	$('#btn-edit-scale').click(function(e){
		e.preventDefault();

		var ins = $(this).val();
		scaleExcute('edit', ins);
	});

	$('#btn-update-scale').click(function(e){
		e.preventDefault();
		var ins = $(this).val();
		scaleExcute('update', ins);
	});


	function showAllowanceModal(state, id)
	{
		// $('#modal-emp-salary').modal('hide');
		$('#form-allowance').trigger('reset');
		$.get(base_url + 'allowance-list', function(data){
			var opt = '<option value="">Chọn chức vụ</option>';
			$.each(data, function(index, value){
				opt += '<option value="'+ value.allowance_code+'">'+ value.allowance+'</option>';
			});
			$('#emp_allowance').html(opt);
			console.log(data);
		});

		if(state == 'add'){
			$('#modal-title-allowance').html('Thêm phụ cấp');
			$('#btn-modal-delete-allowance').hide();
			$('#btn-modal-edit-allowance').hide();
			$('#btn-modal-update-allowance').hide();
			$('#btn-modal-save-allowance').show();
		}else if(state == 'view'){
			$('#modal-title-allowance').html('Xem thông tin phụ cấp');
			$('#btn-modal-delete-allowance').val(id).show();
			$('#btn-modal-edit-allowance').show();
			$('#btn-modal-update-allowance').show();
			$('#btn-modal-save-allowance').hide();


			$.get(base_url + 'emp-allowance/' + id, function(allowance){
				console.log(allowance);
				
				
				$.get(base_url + 'allowance-level/' + allowance.allowance_code, function(level){
					var opt = '';
					$.each(level, function(index, value){
						opt += '<option value="'+ value.level+'">'+ value.level+'</option>';
					});
					$('#emp_allowance_level').html(opt);

					$('#emp_allowance_level').val(allowance.allowance_level);
					$('#emp_allowance').val(allowance.allowance_code);
					

				});
				$('#id_allowance').val(allowance.id);
				$('#allowance_applied_begin').val(allowance.applied_begin);
				$('#allowance_applied_finish').val(allowance.applied_finish);
				$('#emp_allowance_note').val(allowance.note);

			});
		}
		$('#modal-allowance').modal('show');
	}

	$('#emp_allowance').change(function(){
		var allowance = $(this).val();
		console.log('allowance: ' + allowance);
		$.get(base_url + 'allowance-level/' + allowance, function(data){
			console.log(data);
			var opt = '';
			$.each(data, function(index, value){
				opt += '<option value="'+ value.level+'">'+ value.level+'</option>';
			});
			$('#emp_allowance_level').html(opt);
		});
	});


	function getChecked()
	{
		var checked = [];
		$('#emp-salary-body input:checked').each(function(){
			check = $(this).val();
			checked.push(check);
		});
		return checked;
	}

	function getCheckedAllowance()
	{
		var checked = [];
		$('#emp-allowance-list input:checked').each(function(){
			checked.push($(this).val());
		});
		return checked;
	}

	$('#check-all').change(function(){
		$('#emp-salary-body input:checkbox').not(this).prop('checked', this.checked);
	});

	$('#check-all-allowance').change(function(){
		$('#emp-allowance-list input:checkbox').not(this).prop('checked', this.checked);
	});

	function scaleExcute(state, ins)
	{
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		var formData = {
			pay_scale_code: $('#pay_scale').val(),
			pay_range: $('#pay_range').val(),
			applied_begin: $('#scale_applied_begin').val(),
			applied_finish: $('#scale_applied_finish').val(),
		}


		if(ins == 'insurance'){
			// formData = {
			// 	insurance_code: $('#insurance_code').val(),
			// 	date_begin_insurance: $('#date_begin_insurance').val(),
			// 	pay_scale_code: $('#pay_scale').val(),
			// 	pay_range: $('#pay_range').val(),
			// 	applied_begin: $('#scale_applied_begin').val(),
			// 	applied_finish: $('#scale_applied_finish').val(),
			// }
			formData['insurance_code'] = $('#insurance_code').val();
			formData['date_begin_insurance'] = $('#date_begin_insurance').val();
		}

		console.log(formData);
		var id_emp = $('#id_emp').val();

		var type = "POST";
		var active_url = base_url;
		if(state == 'edit'){
			active_url += 'pay-scale/edit/'+id_emp;
		}else if(state == 'update'){
			active_url += 'pay-scale/update/' +id_emp;
		}

		$.ajax({
			type: type,
			url: active_url,
			data: formData,
			success: function(data){
				console.log('success: ',data);
				// $('#pay_scale').val(data.pay_scale.pay_scale_code);
				// $('#pay_range').val(data.pay_scale.pay_range);
				// $('#scale_applied_begin').val(data.pay_scale.applied_begin);
				// $('#scale_applied_finish').val(data.pay_scale.applied_finish);
				// if(ins == 'insurance'){
				// 	$('#insurance_code').val(data.insurance.insurance_code);
				// 	$('#date_begin_insurance').val(data.insurance.date_begin);
				// }
				if(state == 'edit'){
					$('#emp-salary-notify').html('<div class="alert alert-success">Chỉnh sửa bậc lương thành công!</div>');
				}else if(state == 'update'){
					$('#emp-salary-notify').html('<div class="alert alert-success">Cập nhật bậc lương thành công!</div>');
				}
				
			},
			error: function(data){
				console.log('error: ');
				$('#emp-salary-notify').html('<div class="alert alert-danger">Có lỗi xảy ra! Vui lòng thử lại</div>');
			},
		});
		


	}


	function allowanceExcute(state)
	{
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		var formData = {
			id_emp: $('#id_emp').val(),
			allowance_code: $('#emp_allowance').val(),
			allowance_level: $('#emp_allowance_level').val(),
			applied_begin: $('#allowance_applied_begin').val(),
			applied_finish: $('#allowance_applied_finish').val(),
			note: $('#emp_allowance_note').val(),
		}
		console.log('formData: ', formData);

		var id_allowance = $('#id_allowance').val();
		var type = 'POST';
		var active_url = base_url;
		if(state == 'edit'){
			active_url += 'allowance/edit/' + id_allowance;
		}else if(state == 'update'){
			active_url += 'allowance/update/' +id_allowance;
		}else if(state == 'add'){
			active_url += 'allowance/add';
		}

		$.ajax({
			type: type,
			url: active_url,
			data: formData,
			success: function(data){
				console.log('success: ',data);
				var row = '<tr id="'+ data.allowance_code + '">';
				row += '<td><input type="checkbox"  name="check-allowance" value="'+ data.id +'"></td>';
				row += '<td>' + data.allowance        + '</td>';
				row += '<td>' + data.allowance_level  + '</td>';
				row += '<td>' + data.applied_begin  + '</td>';
				row += '<td>' + data.applied_finish + '</td>';
				row += '</tr>';

				if(state == 'add'){
					$('#emp-allowance-list').append(row);
				}else{
					$('#'+data.allowance_code).replaceWith(row);
				}

				$('#modal-allowance').modal('hide');
				// $('#modal-emp-salary').modal('show');
			},
			error: function(data){
				console.log('error: ');
			}
		})

	}

	function salaryExcute(state)
	{
		// var formData = {
		// 	id_emp: $('#id_emp').val(),
		// 	emp_code: $('#emp_code').val(),
		// 	pay_scale_code: $('#pay_scale').val(),
		// 	pay_range: $('#pay_range').val(),
		// 	insurance_code: $('#insurance_code').val(),
		// 	date_begin_insurance: $('#date_begin_insurance').val(),
		// }
		var scaleData = {
			pay_scale_code: $('#pay_scale').val(),
			pay_range: $('#pay_range').val(),
			applied_begin: $('#scale_applied_begin').val(),
			scale_applied_finish: $('#scale_applied_finish').val(),
		}

		var insuranceData = {
			insurance_code: $('#insurance_code').val(),
			date_begin_insurance: $('#date_begin_insurance').val(),
		}

		var allowanceData = [];

		// $('#allowance_list input:checked').each(function(){
		// 	check = $(this).val();
		// 	formData[check] = check;
		// 	formData[check+'_level'] = $('#'+check+'_level').val();
		// });
		$('#allowance_list input:checked').each(function(){
			check = $(this).val();
			var al = {
				allowance_code: check,
				allowance_level: $('#'+check+'_level').val(),
				applied_begin: $('#'+check+'_begin').val(),
			}
			allowanceData[check] = al;
		});

		var type = 'POST';
		var active_url = base_url;
		var id_emp = $('#id_emp').val();


		var formData = {
			id_emp: id_emp,
			emp_code: $('#emp_code').val(),
			pay_scale: scaleData,
			insurance: insuranceData,
			allowance: allowanceData,
		}

		if(state == 'edit'){
			active_url += 'edit/' + id_emp;
		}else if(state == 'update'){
			active_url += 'update/' +id_emp;
		}



		console.log(formData);
	}

	$('#edit-insurance').click(function(){
		var count = $(this).val();
		if(count == ''){
			count = 0;
		}
		
		if(count % 2 == 0){
			$('#insurance_code').prop('readonly', false);
			$('#date_begin_insurance').prop('readonly', false);

			$('#btn-edit-scale').val('insurance');
			$('#btn-update-scale').val('insurance');

		}else{
			$('#insurance_code').prop('readonly', true);
			$('#date_begin_insurance').prop('readonly', true);

			$('#btn-edit-scale').val('');
			$('#btn-update-scale').val('');
		}
		$(this).val(parseInt(count)+1);

	});


	$('#btn-search-emp').click(function(){
		var code = $('#search-emp').val();
		if(code == ''){
			$('#error-search').html('<div class="alert alert-danger">Chưa nhập mã nhân viên</div>');
		}else{
			$.get(base_url +'search-emp/'+ code , function(data){
				console.log(data);
				if(data.id == null){
					$('#error-search').html('<div class="alert alert-danger">Không tìm thấy!</div>');
				}else{
					window.location.href = 'hrm/salary/emp/emp-salary/' +data.id;
				}
			});
		}
		console.log(code);
	})



	$('#insurance-begin-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#allowance-begin-idatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#allowance-finish-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#scale-begin-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#scale-finish-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});






});