@extends('hrm.layout.index')

@section('link')
@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="row">
			<div id="confirm-notify"></div>
			<div class="col-md-5 col-sm-5 col-xs-12">
				<h3 class="dark"><b>Yêu cầu cập nhật</b></h3>
				<ul class="list-unstyled user_data center-block center">
					<li style="padding-left: 30px">Yêu cầu: {{$notify_update->notify}}</li>
					<li style="padding-left: 30px">Thời gian gửi: {{$notify_update->emp_update_profile()->first()->created_at}}</li>
					<li style="padding-left: 30px">Trạng thái: <b id="update-status">
							@if($notify_update->emp_update_profile()->first()->status == -1)
							Bị từ chối
							@elseif($notify_update->emp_update_profile()->first()->status == 1)
							Đã chấp nhận 
							@elseif($notify_update->emp_update_profile()->first()->status == 2)
							Đang chờ duyệt
							@else
							Chưa xem
							@endif
						</b>
					</li>
					<li style="padding-left: 30px">Xác nhận bởi:<b id="update-confirmed_by"> {{$confirmed_by}}</b></li>
					<li style="padding-left: 30px">Thời gian xác nhận: <b id="update-confirmed_time"> {{$notify_update->emp_update_profile()->first()->updated_at}}</b></li>

				</ul>

			</div>
			<div class="col-md-7 col-sm-7 col-xs-12">
				<div class="col-md-4 col-sm-4">
					<div class="profile_img center-block">
						<div id="crop-avatar">
							<img class="img-responsive avatar-view center-block" src="image/employee/cardimage/{{$profile->photo_card}}" alt="Avatar">
						</div>
					</div>
				</div>
				<div class="col-md-8 col-sm-8">
					<ul class="list-unstyled user_data center-block center">
						<li><h4><b>{{$profile->name}}</b></h4></li>
						<li><i class="fa fa-user" style="width:18px"></i> Mã nhân viên: {{$profile->emp_code}}
						</li>
						<li>
							<i class="fa fa-briefcase"  style="width:18px"></i> {{$profile->position}} 
						</li>
						<li>
							<i class="fa fa-map-marker" style="width:18px"></i> {{$profile->department}}
						</li>
					</ul>
				</div>
			</div>

		</div>
		<br>
		@yield('update_content')


	</div>
</div>
<!-- /page content -->

<!-- modal message -->
<div class="modal fade" role="dialog" id="modal-message">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Gửi thông báo?</h3>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-label-left" id="form-message">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					
					<div class="form-group">
						<label class="col-md-2">Gửi tới: </label>
						{{$profile->emp_code}} - {{$profile->name}}
						<input type="hidden" name="message-user-id" id="message-user-id" value="{{$notify_update->from}}">
					</div>
					<div class="form-group">
						<label class="col-md-2"> Cho: </label>
						{{$notify_update->notify}}
						<input type="hidden" name="message-update-id" id="message-update-id" value="{{$notify_update->id_update}}">
						<input type="hidden" name="message-notify-id" id="message-notify-id" value="{{$notify_update->id}}">
						<
					</div>
					<div>
						<label class="col-md-2">Tin nhắn</label>
						<textarea class="form-control" rows="3" name="message" id="message"></textarea>
						
					</div>
					

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
				<button type="button" class="btn btn-primary" id="btn-send-message" value="later">Gửi</button>
			</div>
		</div>
	</div>
</div>

<!-- /modal message -->
@endsection

@section('script')
<script type="text/javascript">
	$(document).ready(function(){
		// $('#btn-agree').click(function(){
		// 	var data = $('#profile_number').text();
		// 	var gender = $('#gender').text();
		// 	alert(data);
		// 	console.log(gender);

		// });
		

		var base_url = "/laravel/HRMProject/public/hrm/emp/update/";
		$('#btn-later').click(function(){
			$('#btn-send-message').val('later');
			$('#modal-message').modal('show');
		});
		$('#btn-reject').click(function(e){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});

			e.preventDefault();
			var formData = {
				type: 'reject',
				to: $('#message-user-id').val(),
				for: $('#message-update-id').val(),
					id_notify: $('#message-notify-id').val(),
				message: '',
			}
			console.log(formData);
			var active_url = base_url + 'message';

			$.ajax({
				type: 'POST',
				url: active_url,
				data: formData,
				success: function(data){
					console.log('success: ', data);
					if(data.response_code == -1){
						$('#confirm-notify').append('<div class="alert alert-danger">' + data.data + '</div>');
					}else{
						$('#update-status').html('Bị từ chối');
						$('#update-confirmed_by').html(data.confirmed_by);
						$('#update-confirmed_time').html(data.data.created_at)
					}
				},
				error: function(data){
					console.log('error: ');
				},
			});

		});


		$('#btn-send-message').click(function(e){
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});

			e.preventDefault();
			var type_notify = $(this).val();
			var formData = {
				type: type_notify,
				to: $('#message-user-id').val(),
				for: $('#message-update-id').val(),
					id_notify: $('#message-notify-id').val(),
				message: $('#message').val(),
			}
			console.log(formData);
			var active_url = base_url + 'message';

			$.ajax({
				type: 'POST',
				url: active_url,
				data: formData,
				success: function(data){
					console.log('success: ', data);
					if(data.response_code == -1){
						$('#confirm-notify').append('<div class="alert alert-danger">' + data.data + '</div>');
					}else{
						$('#update-status').html('Đang chờ duyệt');
						$('#update-confirmed_by').html(data.confirmed_by);
						$('#update-confirmed_time').html(data.data.created_at)
					}
					$('#modal-message').modal('hide');

				},
				error: function(data){
					console.log('error: ');
				},
			});


		});
	});
</script>
@endsection