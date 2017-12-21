@extends('admin.layout.index')

@section('content')
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Quyền đăng nhập</h3>
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
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Tạo mới <small>different form elements</small></h2>
						
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<br />
						<form class="form-horizontal form-label-left">

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">ID</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" class="form-control" readonly="readonly" placeholder="Mã quyền đăng nhập">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tên quyền<span class="required">*</span>
								</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Chức vụ</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="select_single form-control" tabindex="-1">
										<option></option>
										<option value="NV">Nhân viên</option>
										<option value="PP">Phó phòng</option>
										<option value="TP">Trưởng phòng</option>
										<option value="GD">Giám đốc</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-md-3 col-sm-3 col-xs-12">Phòng ban</label>
								<div class="col-md-6 col-sm-6 col-xs-12">
									<select class="select2_single form-control" tabindex="-1">
										<option></option>
										<option value="PDH">Phòng điều hành</option>
										<option value="PKT">Phòng kỹ thuật</option>
										<option value="PNS">Phòng nhân sự</option>
										<option value="PTC">Phòng tài chính</option>
									</select>
								</div>
							</div>

							<div class="ln_solid"></div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
									<button type="button" class="btn btn-primary">Cancel</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<button type="submit" class="btn btn-success">Create</button>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content -->

@endsection