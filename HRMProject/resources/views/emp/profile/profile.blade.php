@extends('emp.layout.index')

@section('link')
<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

@endsection



@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Hồ sơ cá nhân</h3>
			</div>
		</div>

		<div class="title_right">
			<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search for...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>


		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						@include('emp.profile.profile_summary')

						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="" role="tabpanel" data-example-id="togglable-tabs">
								<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
									<li role="presentation" class="active"><a href="#tab_content1" id="info-tab" role="tab" data-toggle="tab" aria-expanded="true">Thông tin</a>
									</li>
									<li role="presentation" class=""><a href="#tab_content2" role="tab" id="family-tab" data-toggle="tab" aria-expanded="false">Gia đình</a>
									</li>
									<li role="presentation" class=""><a href="#tab_content3" role="tab" id="degree-tab" data-toggle="tab" aria-expanded="false">Trình độ</a>
									</li>
								</ul>
								<div id="myTabContent" class="tab-content">
									<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="info-tab">
										@include('emp.profile.detail.emp_profile')
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="family-tab">
										@include('emp.profile.detail.emp_relatives')
									</div>
									<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="degree-tab-tab">
										@include('emp.profile.detail.emp_degree')
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- /page content -->
@endsection


@section('script')
<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<!-- <script type="text/javascript" src="{{ asset('/js/emp_detail.js') }}"></script> -->
<script type="text/javascript" src="{{ asset('/js/employee/profile.js') }}"></script>

<script>
	$(document).ready(function(){
		$('#household_address_province').change(function(){
			var province = $(this).val();
			$.get("ajax/address/"+province, function(data){
				$('#household_address_district').html(data);
			});
		});

		$('#place_of_birth_province').change(function(){
			var province = $(this).val();
			$.get("ajax/address/"+province, function(data){
				$('#place_of_birth_district').html(data);
			});
		});
		$('#address_province').change(function(){
			var province = $(this).val();
			$.get("ajax/address/"+province, function(data){
				$('#address_district').html(data);
			});
		});



		$('#household_address_district').change(function(){
			var district = $(this).val();
			$.get("ajax/province/"+district, function(data){
				$('#household_address_province').val(data);
			});
		});
		$('#place_of_birth_district').change(function(){
			var district = $(this).val();
			$.get("ajax/province/"+district, function(data){
				$('#place_of_birth_province').val(data);
			});
		});
		$('#address_district').change(function(){
			var district = $(this).val();
			$.get("ajax/province/"+district, function(data){
				$('#address_province').val(data);
			});
		});
		





	});
	
</script>


@endsection