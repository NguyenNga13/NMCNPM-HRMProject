$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/hrm/insurance/";

	// check all checkbox
	$('#check-all').change(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	

	// view to change
	$('.table-insurance').on('click', '.btn-change-rate', function(){
		var id_insurance = $(this).val();

		$('#modal-title-insurance').text('Điều chỉnh mức đóng');
		$('#modal-insurance-notify').html('');

		console.log(id_insurance);
		$.get(base_url + "detail/" + id_insurance, function(data){
			console.log(data);
			$('#insurance').val(data.insurance);
			$('#applied_begin').val(data.applied_begin);
			$('#rate_for_business').val(data.rate_for_business);
			$('#rate_for_laborer').val(data.rate_for_laborer);
			$('#note').val(data.note);

			$('#id_insurance').val(data.id);
			$('#btn-save').val('update');
			$('#btn-delete').val(data.id);
			$('#btn-delete').show();
			$('#modal-insurance').modal('show');
		});

	});

	// show modal to add insurance
	$('#btn-add-insurance').click(function(){
		$('#form-insurance').trigger('reset');
		$('#modal-title-insurance').text('Tạo loại bảo hiểm mới');
		$('#modal-insurance-notify').html('');
		$('#btn-delete').hide();
		$('#btn-save').val('add');
		$('#modal-insurance').modal('show');
	});


	// update/add
	$('#btn-save').click(function(e){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		e.preventDefault();

		var state = $(this).val();
		var type = "POST";
		var id_insurance = $('#id_insurance').val();
		var active_url = base_url;

		if(state == "add"){
			active_url += 'add';
		}else{
			type = "PUT";
			active_url += 'update/' +id_insurance;
		}
		if($('#insurance').val() == ''){
			$('#modal-insurance-notify').html('<div class="alert alert-danger">Chưa nhập tên loại bảo hiểm!</div>');
		}else if( $('#applied_begin').val() == ''){
			$('#modal-insurance-notify').html('<div class="alert alert-danger">Chưa nhập thời gian áp dụng!</div>');
		}else if($('#rate_for_business').val() == ''){
			$('#modal-insurance-notify').html('<div class="alert alert-danger">Chưa nhập tỷ lệ doanh nghiệp đóng!</div>');
		}else if($('#rate_for_laborer').val() == ''){
			$('#modal-insurance-notify').html('<div class="alert alert-danger">Chưa nhập tỷ lệ người lao động đóng!</div>');
		}else{

			var formData = {
				insurance: $('#insurance').val(),
				rate_for_business: $('#rate_for_business').val(),
				rate_for_laborer: $('#rate_for_laborer').val(),
				applied_begin: $('#applied_begin').val(),
				note: $('#note').val(),
			}

			$.ajax({
				type: type,
				url: active_url,
				data: formData,
				success: function(data){
					console.log('success: ', data);
					if(data.response == 0){
						$('#insurance-notify').html('<div class="alert alert-warning">'+ data.data+'</div>');
					}else{
						var row = '<tr id="insurance' + data.data.id + '">';
						row += '<td> <input type="checkbox" name="insurance-checkbox" value="'+ data.data.id +'"></td>';
						row += '<td>'+ data.data.insurance + '</td>';
						row += '<td class="text-center">'+ data.data.rate_for_business + '</td>';
						row += '<td class="text-center">'+ data.data.rate_for_laborer + '</td>';
						row += '<td>'+ data.data.applied_begin + '</td>';
						row += '<td class="text-center">';
						row += '<span class="docs-tooltip" data-toggle="tooltip" title="Thay đổi mức đóng">';
						row += '<button class="btn btn-success btn-xs btn-change-rate" value="'+ data.data.id+'">';
						row += '<i class="fa fa-pencil"></i></button></span>';
						row += '<span class="docs-tooltip" data-toggle="tooltip" title="Xóa">';
						row += '<button class="btn btn-danger btn-xs btn-delete-insurance" value="'+data.data.id+'">';
						row += '<i class="fa fa-trash-o"></i></button></span></td></tr>';

						if(state == 'add'){
							$('#insurance-list').append(row);
							$('#insurance-notify').html('<div class="alert alert-success">Tạo ' + data.data.insurance + ' thành công!</div>');
						}else{
							$('#insurance'+id_insurance).remove();
							$('#insurance-list').append(row);
							$('#insurance-notify').html('<div class="alert alert-success">Cập nhật '+ data.data.insurance + ' thành công!</div>');
						}

					}

					$('#form-insurance').trigger('reset');
					$('#modal-insurance').modal('hide');
				},
				error: function(data){
					$('#insurance-notify').html('<div class="alert alert-danger">Đã có lỗi xảy ra. Xin vui lòng thử lại!</div>');
				},
			});
		}
	});


	// delete ins from table
	$('.table-insurance').on('click', '.btn-delete-insurance', function(){
		var id_insurance = $(this).val();
		
		$('#btn-confirm-delete').val(id_insurance);
		$('#delete-type').val('single');
		$.get(base_url + 'detail/' +id_insurance, function(data){
			$('#delete-message').html("Xóa bảo hiểm <b> " + data.insurance + "</b>?");
			$('#modalConfirmDelete').modal('show');
		});
	});

	// delete from modal
	$('#btn-delete').click(function(){
		var id_insurance = $(this).val();
		$('#btn-confirm-delete').val(id_insurance);
		$('#delete-type').val('single');
		$.get(base_url + 'detail/' +id_insurance, function(data){
			$('#delete-message').html("Xóa bảo hiểm <b> " + data.insurance + "</b>?");
			$('#modalConfirmDelete').modal('show');
		});
	});

	// delete insurances from table
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
			$('#modalConfirmDelete').modal('show');

		}

	});

	// confirm delete
	$('#btn-confirm-delete').click(function(){
		var id = $(this).val();
		var delete_type = $('#delete-type').val();

		$.get(active_url = base_url + "delete/" +id, function(data){
			console.log(data);
			var insurance = "";
			$.each(data, function(index, value){
				$('#insurance' + value.id).remove();
				insurance += value.insurance + ", ";
			});

			$('#modalConfirmDelete').modal('hide');
				$('#modal-insurance').modal('hide');
				$('#insurance-notify').html('<div class="alert alert-success">Đã xóa <b>' + insurance + '</b></div>');

		})

	})
});