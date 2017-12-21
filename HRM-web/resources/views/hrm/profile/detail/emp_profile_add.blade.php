@section('link')

<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">

@endsection

@section('content')
<div class="x_content">
  <br />
  <form class="form-horizontal form-label-left">
    <div class="form-group">
      <label class="col-md-2" >Mã nhân viên</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="" value="">
      </div>

      <label class="col-md-2">Số hồ sơ</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="" value="">
      </div>

    </div>

    <div class="form-group">
      <label class="col-md-2" >Họ và tên</label>

      <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Họ">
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Tên đệm">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Tên">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Giới tính</label>
      <div class="col-md-4">
        <select class="form-control">
          <option>Chọn giới tính</option>
          <option>Nam</option>
          <option>Nữ</option>
        </select>
      </div>

      <label class="col-md-2">Ngày sinh</label>
      <div class='col-sm-4'>
        <div class='input-group date' id='BirthDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value=""/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>


    <div class="form-group">
      <label class="col-md-2" >Số điện thoại</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="" value="" >
      </div>

      <label class="col-md-2">Email</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="" value="">
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2" >Quốc gia</label>
      <div class="col-md-4">
        <select class="form-control">
          <option>Chọn Quốc gia</option>
          <option>Việt Nam</option>
          <option></option>
        </select>
      </div>

      <label class="col-md-2">Số CMT</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="" value="">
      </div>
    </div>


    <div class="form-group">

      <label class="col-md-2" >Ngày cấp CMT</label>
      <div class='col-sm-4'>  
        <div class='input-group date' id='CMTDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value=""/>
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
      <label class="col-md-2">Nơi cấp CMT</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="" value="">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Số hộ chiếu</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>

      <label class="col-md-2">Ngày cấp</label>
      <div class="col-md-4">
        <div class='input-group date' id='PassportDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Nơi cấp</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>

      <label class="col-md-2">Ngày hết hạn</label>
      <div class="col-md-4">
        <div class='input-group date' id='PassportInpireDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2">Ngày vào Đảng</label>
      <div class="col-md-4">
        <div class='input-group date' id='AdherentDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>

      <label class="col-md-2" >Mã thẻ Đảng</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Chức vụ Đảng</label>
      <div class="col-md-4">
        <select class="form-control">
          <option>Không</option>
          <option>Đảng viên</option>
          <option>Ủy viên thường vụ Đảng</option>
          <option>Phó Bí thư Đảng</option>
          <option>Bí thư Đảng</option>
        </select>
      </div>

      <label class="col-md-2">Nơi sinh hoạt Đảng</label>
      <div class="col-md-4">
        <input type='text' class="form-control"/>
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2" >Tình trạng hôn nhân</label>
      <div class="col-md-4">
        <select class="form-control">
          <option>Độc thân</option>
          <option>Đã kết hôn</option>
        </select>
      </div>

      <label class="col-md-2"></label>
      <div class="col-md-4">
      <button type="button" class="col-md-12 btn btn-default text-center" >
          <span class="fa fa-group left" style="width: 30px"></span>Thông tin gia đình
        </button>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Dân tộc</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>

      <label class="col-md-2">Tôn giáo</label>
      <div class="col-md-4">
        <input type='text' class="form-control"/>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2">Hộ khẩu</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>
      <div class="col-md-6">
        <select class="form-control">
          <option>Chọn</option>
          <option>---</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2">Nơi sinh</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>
      <div class="col-md-6">
        <select class="form-control">
          <option>Chọn</option>
          <option>---</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2">Nơi ở</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name=""/>
      </div>
      <div class="col-md-6">
        <select class="form-control">
          <option>Chọn</option>
          <option>---</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2">Ghi chú</label>
      <div class="col-md-10">
        <textarea class="form-control" rows="3"></textarea>
      </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
        <button type="button" class="btn btn-primary">Cancel</button>
        <button type="reset" class="btn btn-primary">Reset</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </div>
    </div>

  </form>
</div>
@endsection

@section('script')


<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script>
  $('#BirthDatepicker').datetimepicker({
    format: 'DD-MM-YYYY'
  });

  $('#CMTDatepicker').datetimepicker({
    format: 'DD-MM-YYYY'
  });

  $('#PassportDatepicker').datetimepicker({
    format: 'DD-MM-YYYY'
  });

  $('#PassporInpiretDatepicker').datetimepicker({
    format: 'DD-MM-YYYY'
  });
  $('#AdherenttDatepicker').datetimepicker({
    format: 'DD-MM-YYYY'
  });

  $('#myDatepicker3').datetimepicker({
    format: 'hh:mm A'
  });

  $('#myDatepicker4').datetimepicker({
    ignoreReadonly: true,
    allowInputToggle: true
  });

  $('#datetimepicker6').datetimepicker();

  $('#datetimepicker7').datetimepicker({
    useCurrent: false
  });

  $("#datetimepicker6").on("dp.change", function(e) {
    $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
  });

  $("#datetimepicker7").on("dp.change", function(e) {
    $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
  });

</script>

@endsection