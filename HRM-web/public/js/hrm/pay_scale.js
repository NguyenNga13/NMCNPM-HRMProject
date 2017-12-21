$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/hrm/salary/source/payscale/";

	$('#btn-add').click(function(){

		$.get(base_url + 'get-add', function(data){
			console.log("create p");
			console.log(data);
			if(!data.check){
				$('#notify-message').text('Bạn không có quyền tạo thang lương!');
				$('#modal-notify').modal('show');
			}else{
				$('#btn-add-pay-range').val(1);
				showButton('add', 0);

				$('#modal-scale').modal('show');
			}

		});
		
		
	});

	/**
	 * ajax to add pay_scale_code when change pay_scale
	 */
	 $('#pay_scale').change(function(){
	 	var pay_scale = $(this).val();
	 	$.get(base_url + 'new-code/' + pay_scale, function(data){
	 		if(data == '0'){
	 			$('#modal-scale-notify').html('<div class="alert alert-danger alert-xs">Thang lương đã tồn tại!</div>');
	 		}else{
	 			$('#pay_scale_code').val(data);
	 			$('#modal-scale-notify').html('');
	 		}

	 	});
	 });

	/**
	 * add row to add pay range
	 */
	 $('#btn-add-pay-range').click(function(){
	 	var add = $(this).val();
	 	add = parseInt(add);
	 	console.log('range add: '+add);

	 	var code = $('#pay_scale_code').val();

	 	var row = '<div class="form-group" id="pay-range' + add+ '">';
	 	row += '<div class="col-md-1">';
	 	row += '<a class="red remove-pay-range" id="remove' + add +'" title="Xóa bậc"><i class="fa fa-minus-circle" ></i></a>';
	 	row += '</div>';
	 	row += '<div class="col-md-2">';
	 	row += '<input type="text" name="level' + add +'" id="level' + add +'" class="form-control">';
	 	row += '</div>';
	 	row += '<div class="col-md-2">';
	 	row += '<input type="number" name="rate' + add +'" id="rate' + add +'" class="form-control pay-scale-rate" step="any">';
	 	row += '</div>';
	 	row += '<div class="col-md-2">';
	 	row += '<input type="number" name="value' + add +'" id="value' + add +'" class="form-control pay-scale-value" step="any">';
	 	row += '</div>';
	 	row += '<div class="col-md-5">';
	 	row += '<input type="text" name="note' + add +'" id="note' + add +'" class="form-control">';
	 	row += '</div>';
	 	row += '</div>';

	 	$('#pay-range-list').append(row);
	 	$('#remove' +add).val(add);
	 	$('#level' + add).val(code + "-" + add);
	 	$('#btn-add-pay-range').val(add+1);
	 	$('#remove' + (add-1)).prop('disabled', true).removeClass("red").addClass("gray");

	 });


	//
	$('#pay-range-list').on('change', '.pay-scale-rate', function(){
		var rate = $(this).val();
		var id = $(this).attr('id');
		$.get(base_url + 'pay-rate-basic', function(data){
			if(data != 0){
				var basic = data.pay_rate_basic;
				$('#value'+ id.slice(4)).val((basic*rate).toFixed(0));
			}
		});
		
	});

	$('#pay-range-list').on('change', '.pay-scale-value', function(){
		var value = $(this).val();
		var id = $(this).attr('id');
		$.get(base_url + 'pay-rate-basic', function(data){
			if(data != 0){
				var basic = data.pay_rate_basic;
				$('#rate'+ id.slice(5)).val((value/basic).toFixed(2));
			}
		});
		
	});


	/**
	 * remove row, which to add pay range
	 */
	 $('#pay-range-list').on('click', '.remove-pay-range', function(){
	 	var remove = $(this).val();
	 	console.log('range remove: ' +remove);
	 	remove = parseInt(remove);

	 	var level = $('#btn-add-pay-range').val();
	 	level = parseInt(level);

	 	if(level >1){
	 		$('#btn-add-pay-range').val(level-1);
	 	}
	 	console.log('btn-add-pay-range value: ' + $('#btn-add-pay-range').val());

	 	$('#remove' + (remove-1)).prop('disabled', false).removeClass("gray").addClass("red");
	 	$('#pay-range' +remove).remove();

	 });




	 $('#btn-view').click(function(){
	 	showButton('view');
	 	var checked = getChecked();
	 	console.log(checked);
	 	if(checked > 0){
	 		displayOnModal(checked);
	 	}


	 });

	 $('#btn-edit').click(function(){
	 	showButton('edit');
	 	var checked = getChecked();
	 	console.log(checked);
	 	if(checked > 0){
	 		displayOnModal(checked);
	 	}
	 });

	 $('#btn-update').click(function(){
	 	showButton('update');
	 	var checked = getChecked();
	 	console.log(checked);
	 	if(checked > 0){
	 		displayOnModal(checked);
	 	}
	 });

	 $('#btn-delete').click(function(){
	 	var checked = getChecked();
	 	console.log(checked);
	 	if(checked > 0){
	 		console.log('checked');
	 		$.get(base_url+ "scale/" +checked, function(data){
	 			$('#delete-message').html('Xóa thang lương <b>' + data.pay_scale+ '</b>?');
	 			$('#btn-confirm-delete').val(data.id);
	 			$('#modalConfirmDelete').modal('show');
	 		});
	 	}
	 });

	 $('#btn-modal-delete').click(function(){
	 	var id = $(this).val();
	 	console.log('delete: '+ id);
	 	$.get(base_url +"scale/" + id, function(data){
	 		$('#delete-message').html('Xóa thang lương <b>' + data.pay_scale+ '</b>?');
	 		$('#btn-confirm-delete').val(data.id);
	 		$('#modalConfirmDelete').modal('show');
	 	});
	 });

	 $('#btn-confirm-delete').click(function(){
	 	var id = $(this).val();
	 	$.get(base_url + 'delete/' +id, function(data){
	 		console.log(data);
	 		$('#pay_scale'+id).remove();
	 		$('#notify-allowance').html('<div class="alert alert-success">Xóa thành công thang lương <b>'+ data.pay_scale + '</b></div>');
	 	});
	 	$('#modalConfirmDelete').modal('hide');
	 });


	 $('#btn-modal-save').click(function(e){
	 	$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	 		}
	 	});

	 	e.preventDefault();

	 	var btn = $(this).val();
	 	console.log(btn); 

	 	scaleExecute(btn);
	 });

	 $('#btn-modal-edit').click(function(e){
	 	$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	 		}
	 	});

	 	e.preventDefault();

	 	var btn = $(this).val();
	 	console.log(btn); 
	 	console.log($('#id_pay_scale').val());

	 	scaleExecute(btn);
	 });
	 $('#btn-modal-update').click(function(e){
	 	$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	 		}
	 	});

	 	e.preventDefault();

	 	var btn = $(this).val();
	 	console.log(btn); 
	 	console.log($('#id_pay_scale').val());
	 	scaleExecute(btn);
	 });

	 $('#btn-modal-delete').click(function(){
	 	var btn = $(this).val();
	 	console.log(btn); 
	 });

	 function getChecked()
	 {
	 	var checked;
	 	var count = 0;
	 	$('#pay-scale-list input:checked').each(function(){
	 		// checked.push($(this).attr('value'));
	 		checked = $(this).val();
	 		count = count +1;
	 	});
	 	

	 	if (count == 0){
	 		$('#notify-message').text('Không có mục nào được chọn!');
	 		$('#modal-notify').modal('show');

	 		return 0;
	 	}
	 	else if(count > 1){
	 		$('#notify-message').text('Nhiều hơn một mục được chọn!');
	 		$('#modal-notify').modal('show');
	 		return -1;
	 	}
	 	else
	 		return checked;
	 }

	 function displayOnModal(id)
	 {
	 	$.get(base_url + 'scale/' + id, function(data){
	 		$('#pay_scale').val(data.pay_scale);
	 		$('#pay_scale_code').val(data.pay_scale_code);
	 		$('#applied_begin').val(data.applied_begin);
	 		$('#applied_finish').val(data.applied_finish);
	 		$('#note').val(data.note);

	 		$('#id_pay_scale').val(data.id);
	 		$('#btn-modal-delete').val(data.id);

	 		var range = JSON.parse(data.range);
	 		$.each(range, function(index, value){
	 			index = parseInt(index);
	 			var row = '';
	 			row += '<div class="form-group" id="pay-range' + (index+1) + '">';
	 			row += '<div class="col-md-1">';
	 			row += '<a class="gray remove-pay-range" id="remove' + (index+1) +'" title="Xóa bậc" ><i class="fa fa-minus-circle" ></i></a>';
	 			row += '</div>';
	 			row += '<div class="col-md-2">';
	 			row += '<input type="text" name="level' + (index+1) +'" id="level' + (index+1) +'" class="form-control" value="' + value.level + '">';
	 			row += '</div>'
	 			row += '<div class="col-md-2">';
	 			row += '<input type="number" name="rate' + (index+1) +'" id="rate' + (index+1) +'" class="form-control pay-scale-rate" step="any" value="' + value.rate + '">';
	 			row += '</div>'
	 			row += '<div class="col-md-2">';
	 			row += '<input type="number" name="value' + (index+1) +'" id="value' + (index+1) +'" class="form-control pay-scale-value" step="any" value="' + value.value + '">';
	 			row += '</div>'
	 			row += '<div class="col-md-5">';
	 			row += '<input type="text" name="note' + (index+1) +'" id="note' + (index+1) +'" class="form-control" value="' + value.note + '">';
	 			row += '</div>';
	 			row += '</div>';

	 			$('#pay-range-list').append(row);
	 			$('#remove' + (index+1)).val(index+1).prop('disabled', true);
	 		});

	 		$('#btn-add-pay-range').val(range.length+1);
	 		$('#remove'+range.length).prop('disabled', false).removeClass("gray").addClass("red");
	 		$('#modal-scale').modal('show');
	 	});
	 }

	 function scaleExecute(state)
	 {
	 	var pay_scale = $('#pay_scale').val();
	 	var pay_scale_code = $('#pay_scale_code').val();
	 	var applied_begin = $('#applied_begin').val();
	 	var range = $('#btn-add-pay-range').val();
	 	console.log('range:' + range);

	 	if(pay_scale == ''){
	 		$('#modal-scale-notify').html('<div class="alert alert-danger alert-xs">Chưa nhập thang lương!</div>');
	 	}else if(pay_scale_code == ''){
	 		$('#modal-scale-notify').html('<div class="alert alert-danger alert-xs">Chưa nhập mã thang lương!</div>');
	 	}else if(applied_begin == ''){
	 		$('#modal-scale-notify').html('<div class="alert alert-danger alert-xs">Chưa nhập thời gian bắt đầu áp dụng!</div>');
	 	}else if(range ==1 || range == 0 || range == ''){
	 		$('#modal-scale-notify').html('<div class="alert alert-danger alert-xs">Chưa có bậc lương!</div>');
	 	}else{

	 		var range_arr = [];
	 		for(var i = 1; i <range; i++){
	 			var data = {
	 				level: $('#level' + i).val(),
	 				rate:  $('#rate'  + i).val(),
	 				value: $('#value' + i).val(),
	 				note:  $('#note'  + i).val(),
	 			}
	 			range_arr.push(data);
	 		}

	 		var rangeData = JSON.stringify(range_arr);

	 		var formData = {
	 			pay_scale: pay_scale,
	 			pay_scale_code: pay_scale_code,
	 			range: rangeData,
	 			applied_begin: applied_begin,
	 			applied_finish: $('#applied_finish').val(),
	 			note: $('#note').val(),
	 		}

	 		console.log('formData: ', formData);

	 		var type = "POST";
	 		var active_url = base_url;
	 		var id_pay_scale = $('#id_pay_scale').val();
	 		if(state == 'add'){
	 			type = "POST";
	 			active_url += 'add';
	 		}else if(state == 'update'){
	 			type = "POST";
	 			active_url += 'update/' +id_pay_scale;
	 		}else if(state == 'edit'){
	 			type = "PUT";
	 			active_url += 'edit/' +id_pay_scale;
	 		}
	 		console.log('url: '+ active_url);

	 		$.ajax({
	 			type: type,
	 			url: active_url,
	 			data: formData,
	 			success: function(data){
	 				console.log('success: ', data);
	 				var row = '';
	 				row += '<tr id="pay_scale' + data.id+ '">';
	 				row += '<td><input type="checkbox" name="check" id="check' + data.id+ '" value="' + data.id+ '"></td>';
	 				row += '<td class="dark"><b>' + data.pay_scale_code + '</b></td>';
	 				row += '<td><b class="dark">' + data.pay_scale + '</b><p class="green"> &nbsp - &nbsp Hệ số (%) </p><p class="blue"> &nbsp - &nbsp Mức lương (VND)</p></td>';

	 				var range = JSON.parse(data.range);
	 				$.each( range, function(index, value){
	 					row += '<td class="text-right"><p class="green">' + value.rate + '</p><p class="blue">' + value.value +'</p></td>';
	 				});

	 				for(var i = 0; i < (7-range.length); i++){
	 					row += '<td></td>';
	 				}
	 				row += '</tr>';

	 				if(state == 'add'){
	 					$('#pay-scale-list').append(row);
	 					$('#notify-this').html('<div class="alert alert-danger alert-xs">Chưa nhập thang lương!</div>');
	 				}else if(state == 'update'){
	 					$('#pay_scale'+id_pay_scale).remove();
	 					$('#pay-scale-list').append(row);
	 					$('#notify-payscale').append('<div class="alert alert-success">Cập nhật thang lương <b>'+ data.pay_scale +'</b> thành công!</div>');
	 				}else if(state == 'edit'){
	 					$('#pay_scale'+id_pay_scale).replaceWith(row);
	 					$('#notify-payscale').append('<div class="alert alert-success">Chỉnh sửa thang lương <b>'+ data.pay_scale +'</b> thành công!</div>');
	 				}


	 			},
	 			error: function(data){
	 				console.log('error: ', data);
	 			}
	 		});

	 		$('#form-scale').trigger('reset');
	 		$('#modal-scale').modal('hide');
	 	}

	 }

	 function showButton(action){
	 	$('#form-scale').trigger('reset');
	 	$('#pay-range-list').html('');

	 	if(action == 'add'){
	 		$('#btn-modal-edit').hide();
	 		$('#btn-modal-update').hide();
	 		$('#btn-modal-save').show();
	 		$('#btn-modal-delete').hide();
	 		$('#modal-title-scale').text('Tạo thang lương');
	 	}else if(action == 'view'){
	 		$('#btn-modal-edit').show();
	 		$('#btn-modal-update').show();
	 		$('#btn-modal-save').hide();
	 		$('#btn-modal-delete').show();
	 		$('#modal-title-scale').text('Xem thang lương');
	 	}else if(action == 'edit'){
	 		$('#btn-modal-edit').show();
	 		$('#btn-modal-update').hide();
	 		$('#btn-modal-save').hide();
	 		$('#btn-modal-delete').show();
	 		$('#modal-title-scale').text('Chỉnh sửa thang lương');
	 	}else if(action == 'update'){
	 		$('#btn-modal-edit').hide();
	 		$('#btn-modal-update').show();
	 		$('#btn-modal-save').hide();
	 		$('#btn-modal-delete').show();
	 		$('#modal-title-scale').text('Cập nhật thang lương');
	 	}

	 }

	/**
	 * show modal ->edit pay rate basic
	 */
	 $('#btn-edit-payrate').click(function(){
	 	console.log('edit');
	 	$('#form-payrate').trigger('reset');
	 	$('#modal-title-payrate').html('Chỉnh sửa mức lương cơ bản');
	 	$('#btn-save-payrate').val('edit');
	 	$.get(base_url + 'pay-rate-basic', function(data){
	 		console.log(data);
	 		if(data == 0){
	 			console.log('null');
	 		}else{
	 			$('#pay_rate_basic').val(data.pay_rate_basic);
	 			$('#payrate-applied_begin').val(data.applied_begin);
	 			$('#payrate-note').val(data.note);
	 			
	 		}
	 		$('#modal-payrate').modal('show');
	 	});
	 });

	/**
	 * show modal ->update pay rate basic
	 */
	 $('#btn-update-payrate').click(function(){
	 	console.log('update');
	 	$('#form-payrate').trigger('reset');
	 	$('#modal-title-payrate').html('Cập nhật mức lương cơ bản');
	 	$('#btn-save-payrate').val('update');
	 	$.get(base_url + 'pay-rate-basic', function(data){
	 		if(data == 0){
	 			console.log('null');
	 			
	 		}else{
	 			$('#pay_rate_basic').val(data.pay_rate_basic);
	 			$('#payrate-applied_begin').val(data.applied_begin);
	 			$('#payrate-note').val(data.note);
	 		}
	 		$('#modal-payrate').modal('show');
	 	});
	 });

	/**
	 * update/edit pay rate basic
	 */
	 $('#btn-save-payrate').click(function(e){
	 	$.ajaxSetup({
	 		headers: {
	 			'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	 		}
	 	});

	 	e.preventDefault();


	 	var save = $(this).val();
	 	var active_url = base_url + 'pay-rate-basic/' +save;

	 	var formData = {
	 		pay_rate_basic: $('#pay_rate_basic').val(),
	 		applied_begin: $('#payrate-applied_begin').val(),
	 		note: $('#payrate-note').val(),
	 	}

	 	console.log(formData);
	 	$.ajax({
	 		type: "POST",
	 		url: active_url,
	 		data: formData,
	 		success: function(data){
	 			console.log('success: ', data);
	 			if(data != -1){
	 				$('#display-pay_rate_basic').html(number_format(data.pay_rate_basic, 0) + ' VND');
	 				$('#display-applied_begin').html(data.applied_begin);
	 			}
	 		},
	 		error: function(data){
	 			console.log('error');
	 		}
	 	});

	 	$('#form-payrate').trigger('reset');
	 	$('#modal-payrate').modal('hide');

	 });

	/**
	 * format currency
	 */
	 function number_format( number, decimals, dec_point, thousands_sep ) {


	 	var n = number, c = isNaN(decimals = Math.abs(decimals)) ? 2 : decimals;
	 	var d = dec_point == undefined ? "," : dec_point;
	 	var t = thousands_sep == undefined ? "." : thousands_sep, s = n < 0 ? "-" : "";
	 	var i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;

	 	return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	 }


	// check all checkbox
	$('#check-all').change(function(){
		$('input:checkbox').not(this).prop('checked', this.checked);
	});

	// for datepicker
	$('#applied-begin-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#applied-finish-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#payrate-applied-begin-datepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});





});