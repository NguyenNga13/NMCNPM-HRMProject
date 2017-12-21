<!-- modal emp salary -->
<div id="modal-emp-salary" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> <b id="modal-user-title">Thông tin lương nhân viên</b></h3>
			</div>
			<div class="modal-body">
				<div id="emp-salary-modal-notify"></div>
				<form class="form-horizontal form-label-left" id="form-modal-emp-salary">

					<div class="form-group">
						<label class="col-md-2" >Mã nhân viên</label>
						<div class="col-md-4" id="input-user" >
							<input class="form-control" readonly="readonly" type="text"  name="emp_code" id="emp_code" required="">
						</div>

						<label class="col-md-2">Họ tên</label>
						<div class="col-md-4">
							<input class="form-control" readonly="readonly" type="text"  name="emp_name" id="emp_name">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2" >Chức vụ</label>
						<div class="col-md-4">
							<input class="form-control" type="text"  name="emp_position" id="emp_position" readonly="">
						</div>

						<label class="col-md-2" >Phòng ban</label>
						<div class="col-md-4">
							<input class="form-control" type="text"  name="emp_department" id="emp_department" readonly="">
						</div>
					</div>
					<hr>
					<div class="form-group">
						<div class="checkbox">
							<label class="dark"><input type="checkbox" name="check-type" class="salary" id="insurance_code" value="1"><b> Bảo hiểm</b></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2">Mã số BHXH</label>
						<div class="col-md-4">
							<input type="text" name="insurance_code" class="form-control" id="insurance_code">
						</div>

						<label class="col-md-2"> Ngày bắt đầu</label>
						<div class='col-sm-4'>
							<div class='input-group date' id="insurance-begin-datepicker">
								<input type="text" class="form-control" placeholder="YYYY-mm-dd" name="date_begin_insurance" id="date_begin_insurance" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
							<div class="pull-right red"><small>Ghi chú*: Ngày bắt đầu thực hiện đóng bảo hiểm tại công ty </small></div>
						</div>
					</div>
					<hr>
					<div class="form-group">
						<div class="checkbox">
							<label class="dark"><input type="checkbox" name="check-type" class="salary" id="salary" value="2"> Bậc lương</label>
						</div>
					</div>

					<div class="form-group" id="pay_scale_select">
						<label class="col-md-2">Ngạch lương</label>
						<div class="col-md-4">
							<select class="form-control" name="pay_scale" id="pay_scale">
								<option value="0">Ngạch lương</option>
								@foreach($pay_scales as $pay_scale)
								<option value="{{$pay_scale->pay_scale_code}}">{{$pay_scale->pay_scale}}</option>
								@endforeach
							</select>
						</div>

						<label class="col-md-2">Bậc lương</label>
						<div class="col-md-4">
							<select class="form-control" name="pay_range" id="pay_range">
								<option value="0">Bậc lương</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2">Áp dụng từ: </label>
						<div class='col-sm-4'>
							<div class='input-group date' id='scale-begin-datepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="scale_applied_begin" id="scale_applied_begin" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
						<label class="col-md-2">đến</label>
						<div class='col-sm-4'>
							<div class='input-group date' id='scale-finish-datepicker'>
								<input type='text' class="form-control" placeholder="YYYY-mm-dd" name="scale_applied_finish" id="scale_applied_finish" />
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>

					<hr>
				</form>
				<div class="btn-group" style="margin-bottom: 10px">
					<button class="btn btn-default" title="Thêm phụ cấp" id="btn-add-allowance"><span class="fa fa-plus"></span> Thêm </button>
					<button class="btn btn-default" title="Xem chi tiết phụ cấp" id="btn-view-allowance"><span class="fa fa-info-circle"></span> Xem</button>
					<button class="btn btn-default" title="Xóa phụ cấp" id="btn-delete-allowance"><span class="fa fa-minus"></span> Xóa</button>
				</div>
				<br>

				<div id="emp-allowance-notify"></div>

				<table id="table-allowance" class="table table-hover table-striped table-bordered" >
					<thead>
						<tr>
							<th><input type="checkbox" id="check-all-allowance" name=""></th>
							<th>Phụ cấp</th>
							<th>Mức phụ cấp</th>
							<th>Ngày áp dụng</th>
							<th>Ngày kết thúc</th>
						</tr>
					</thead>
					<tbody id="emp-allowance-list">
						<tr>
							<td><input type="checkbox"  name="check-allowance"></td>
							<td>Phụ cấp chức vụ</td>
							<td>PCCV-1</td>
							<td>2017-09-12</td>
							<td>2017-09-12</td>
						</tr>
					</tbody>

				</table>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
				<button type="button" class="btn btn-danger" id="btn-modal-delete" value="">Xóa</button>
				<button type="button" class="btn btn-info" id="btn-modal-edit" value="edit">Sửa</button>
				<button type="button" class="btn btn-success" id="btn-modal-update" value="update">Cập nhật</button>

				<!-- <button type="button" class="btn btn-info" id="btn-save" value="add">Lưu</button> -->

				<input type="hidden" name="id_emp" id="id_emp" value="0">

			</div>

		</div>
	</div>
</div>

<!-- /modal emp salary -->