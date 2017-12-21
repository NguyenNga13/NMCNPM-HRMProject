@extends('hrm.layout.index')

@section('link')

<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

{!! Charts::assets() !!}







@endsection

@section('content')
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Thống kê theo cơ cấu</h3>
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
		</div>

		<div class="clearfix"></div>




		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<form class="form-horizontal form-label-left" id="form-report">
							<div class="form-group">
								<label class="col-md-1">Thống kê </label>
								<div class="col-md-2">
									<select class="form-control" id="report-type">
										<option value="gender">Giới tính</option>
										<option value="age">Độ tuổi</option>
									</select>
								</div>
								<?php
								$current = Carbon\Carbon::now()->format('Y-m');
								$begin = $current."-01";
								$finish = $current."-30";
								?>

								<label class="col-md-1">Thời gian</label>
								<div class="col-md-3">
									<div class="input-group date" id="StructureBeginDatepicker">
										<input type="text" name="begin" class="form-control" placeholder="YYYY-MM-DD", id="begin" value="{{$begin}}">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<label class="col-md-1"> đến </label>
								<div class="col-md-3">
									<div class="input-group date" id="StructureFinishDatepicker">
										<input type="text" name="finish" class="form-control" placeholder="YYYY-MM-DD", id="finish" value="{{$finish}}">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<div class="col-md-1">
									<button type="button" class="btn btn-dark" id="btn-report" value="">Thống kê</button>
								</div>
							</div>
						</form>

						<div class="form-group">
							<div class="col-md-6">
								<table class="data table table-striped no-margin" id="table_structure">
									<thead>
										<th>#</th>
										<th>Tên</th>
										<th>Số lượng</th>
										<th>Tỷ lệ</th>
									</thead>
									<tbody id="structure-list">
										@foreach($data as $key => $value)
										<tr>
											<td>{{$value->no}}</td>
											<td>{{$value->gender}}</td>
											<td>{{$value->num}}</td>
											<td>{{$value->rate}} %</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="col-md-6">
								<div class="container chart-gender" id="genderchart">
									{!! $chart->render() !!}
								</div>
								
							</div>
						</div>
						<div class="clearfix"></div>

						<!-- <button type="button" id="btn-click">Click</button> -->

						<!-- <div>
							<?php
							// echo Charts::create('line', 'highcharts')->labels(['One', 'Two'])->values([10, 20])->render();
							?>

						</div> -->
						<div id="dog"></div>






					</div>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection


@section('script')

<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<!-- ECharts -->
<script src="vendors/echarts/dist/echarts.min.js"></script>
<script src="vendors/echarts/map/js/world.js"></script>

<script>
	$('#StructureFinishDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});
	$('#StructureBeginDatepicker').datetimepicker({
		format: 'YYYY-MM-DD'
	});

</script>


<script type="text/javascript">

	var base_url = "/laravel/HRMProject/public/hrm/report/structure/";
	// $('#btn-click').click(function(){
	// 	$.ajax({
	// 		type: "GET",
	// 		url: "/laravel/HRMProject/public/test3",
	// 		success: function(data){
	// 			console.log(data);
	// 			$('#mychart').html(data);



	// 				// $('#ochart').html(data);
	// 				// $(".container").html();
	// 				// document.getElementById("ochart").innerHTML=data;
	// 			},
	// 			error: function(data){
	// 				console.log("Error: ", data);
	// 			},
	// 		});
	// 	});

	$('#btn-report').click(function(e){

		e.preventDefault();
		var formData = {
			type: $('#report-type').val(),
			begin: $('#begin').val(),
			finish: $('#finish').val(),
		}

		var type = $('#report-type').val();
		var active_url = base_url + '' +type;

		console.log(formData);

		$.ajax({
			type: "GET",
			url: "/laravel/HRMProject/public/hrm/report/structure/gender",
			success: function(data){
				console.log(data);
				
					$('#genderchart').html(data);
					$('#dog').append(data);
					



				}, 
				error: function(data){
					console.log('Error: ', data);
				},
			});
	});


</script>


@endsection