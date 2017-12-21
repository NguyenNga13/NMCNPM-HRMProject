$(document).ready(function(){
	var base_url = "/laravel/HRMProject/public/emp/";

	$('#btn-update_profile').click(function(){
		$('#modal-profile').modal('show');
	});


	$('#datepicker-date_of_birth').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#datepicker-identity_issued').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#datepicker-passport_issued').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#datepicker-passport_expired').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#datepicker-adherent').datetimepicker({
		format: 'YYYY-MM-DD'
	});



});