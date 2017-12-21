$(document).ready(function (){

	var base_url =  "/laravel/HRMProject/public/hrm/salary/paysheet/";


	$('#btn-add-by-emp').click(function(){
		
		checkCreatePaySheet("by_emp");

	});

	$('#btn-add-by-dep').click(function(){
		checkCreatePaySheet("by_dep");
	});

	function checkCreatePaySheet(type)
	{
		var current = new Date();
		var date = current.getDate();

		if(date < 15 || date > 25){
			$('#notify-message').text('Bảng lương được thống kê vào ngày 20 đến ngày 25 hàng tháng!');
			$('#modal-notify').modal('show');
		}else{
			$.get(base_url + 'add', function(data){
				console.log(data);
				if(!data.check){
					$('#notify-message').text('Bạn không có quyền thực hiện lập bảng lương!');
					$('#modal-notify').modal('show');
				}else{
					if(type == "by_emp"){
						$('#input-emp-code').show();
						$('#select-emp-code').hide();
						$('#add-by-emp-notify').html('');
						$('#form-add-by-emp').trigger('reset');
						$('#modal-add-by-emp').modal('show');

					}else if(type == "by_dep"){

						$('#form-add-by-dep').trigger('reset');

						$.get(base_url + 'list-dep', function(dep){
							console.log(dep);
							var dep_name = '';
							var dep_code = '';
							$.each(dep, function(index, value){
								dep_code += '<option value="'+ value.id +'">' +value.id +'</option>';
								dep_name += '<option value="'+ value.department +'">' +value.department +'</option>';
							});
							$('#add-dep-code').append(dep_code);
							$('#add-dep-name').append(dep_name);

							$('#modal-add-by-dep').modal('show');
						});
						
					}else{

					}
				}
			});
		}
	}


	//ajax load dep code
	$('#add-dep-code').change(function(){
		var code = $(this).val();
		console.log(code);
		$.get(base_url + 'get-dep-by-id/' + code ,function(data){
			console.log(data);
			$('#add-dep-name').val(data);
		});
	});

	//ajax load dep name
	$('#add-dep-name').change(function(){
		var dep = $(this).val();
		console.log(dep);

		$.get(base_url + 'get-dep-by-name/' + dep, function(data){
			console.log(data);

			$('#add-dep-code').val(parseInt(data));
		});
	});

	//ajax load emp name
	$('#add-emp-code').change(function(){
		var code = $(this).val();
		console.log(code);

		$.get(base_url + 'get-emp-by-code/' + code, function(data){
			console.log(data);
			if(data.name == null){
				$('#add-by-emp-notify').html('<div class="alert alert-danger">Không tìm thấy!</div>');
			}else{
				$('#add-emp-name').val(data.name);

				$('#btn-add-paysheet-by-emp').attr('href', 'hrm/salary/paysheet/get-emp-add/' +data.id);
			}
			
		});
	});


	$('#add-emp-name').change(function(){
		var name = $(this).val();
		console.log(name);

		$.get(base_url + 'get-emp-by-name/' + name, function(data){
			console.log(data);
			var length = data.length;

			if(length == 0){
				$('#add-by-emp-notify').html('<div class="alert alert-danger">Không tìm thấy!</div>');
			}else if(length == 1){
				$('#add-by-emp-notify').html('');
				$('#add-emp-code').val(data[0].emp_code);
			}else{
				$('#add-by-emp-notify').html('<div class="alert alert-warning">Tìm thấy nhiều hơn một nhân viên. Chọn mã nhân viên!</div>');

				var select = '';

				$.each(data, function(index, value){
					select += '<option value="'+ value.emp_code+'">'+ value.emp_code +'</option>';
				});

				$('#add-emp-code-select').append(select);
				$('#select-emp-code').show();
				$('#input-emp-code').hide();
			}
			console.log(length);

			// $('#add-emp-name').val(data);
		});
	});


	$('#check-all').change(function(){
		$('#body-paysheet input:checkbox').not(this).prop('checked', this.checked);
	});

	function getChecked()
	{
		var checked = [];
		$('#body-paysheet input:checked').each(function(){
			check = $(this).val();
			checked.push(check);
		});
		return checked;
	}
});