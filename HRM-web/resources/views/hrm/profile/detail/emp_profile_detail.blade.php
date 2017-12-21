<div class="x_content">
  <br />
  <?php
  $string = file_get_contents('json/tree.json');
  $json = json_decode($string, true);
  ?>
  <form class="form-horizontal form-label-left" action="hrm/emp/edit" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">

    <div class="form-group">
      <label class="col-md-2" >Mã nhân viên</label>
      <div class="col-md-4">
        <input class="form-control" type="text" readonly="readonly" value="{{convertIdEmp($emp->id)}}" name="id">
      </div>

      <label class="col-md-2">Số hồ sơ *</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  value="{{$emp->profile_number}}" required="" name="profile_number">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Họ và tên *</label>
      <?php
      $name = $emp->name;
      $name = convertString($name, 1);
      ?>

      <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Họ" value="{{splitName($name)[0]}}" required="" name="last_name">
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control" placeholder="Tên đệm" value="{{splitName($name)[1]}}" name="middle_name">
      </div>
      <div class="col-md-4">
        <input type="text" class="form-control" placeholder="Tên" value="{{splitName($name)[2]}}" required="" name="first_name">
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Giới tính</label>
      <div class="col-md-4">
        <select class="form-control" name="gender">
          <option 
          @if($emp->gender == 1)
          {{"selected"}}
          @endif 
          value="1">Nam</option>
          <option
          @if($emp->gender == 0)
          {{"selected"}}
          @endif 
          value="0">Nữ</option>
        </select>
      </div>

      <label class="col-md-2">Ngày sinh</label>
      <div class='col-sm-4'>
        <div class='input-group date' id='BirthDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value="{{$emp->date_of_birth}}" name="date_of_birth" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>


    <div class="form-group">
      <label class="col-md-2" >Số điện thoại</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  value="{{$emp->phone}}" name="phone" >
      </div>

      <label class="col-md-2">Email</label>
      <div class="col-md-4">
        <input class="form-control" type="text" value="{{$emp->email}}" name="email">
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2" >Quốc gia</label>
      <div class="col-md-4">
        <select class="form-control" name="country">
          @foreach(country() as $country)
          <option 
          @if($emp->country == $country)
          {{"selected"}}
          @endif
          value="{{$country}}">{{$country}}</option>
          @endforeach
        </select>
      </div>

      <label class="col-md-2">Số CMT</label>
      <div class="col-md-4">
        <input class="form-control" type="text" value="{{$emp->identity_card}}" name="identity_card">
      </div>
    </div>


    <div class="form-group">

      <label class="col-md-2" >Ngày cấp CMT</label>
      <div class='col-sm-4'>  
        <div class='input-group date' id='CMTDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value="{{$emp->id_date_of_issued}}" name="id_date_of_issued" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
      <label class="col-md-2">Nơi cấp CMT</label>
      <div class="col-md-4">

        <select class="form-control" name="id_issued_by">

          @foreach ($json as $key => $value)
          <option
          @if($emp->id_issued_by == $value['name'])
          {{"selected"}}
          @endif 
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Số hộ chiếu</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="passport_number" value="{{$emp->passport_number}}"/>
      </div>

      <label class="col-md-2">Ngày cấp</label>
      <div class="col-md-4">
        <div class='input-group date' id='PassportDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value="{{$emp->passport_date_of_issued}}" name="passport_date_of_issued" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Nơi cấp</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="passport_issued_by" value="{{$emp->passport_issued_by}}"/>
      </div>

      <label class="col-md-2">Ngày hết hạn</label>
      <div class="col-md-4">
        <div class='input-group date' id='PassporInpiretDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value="{{$emp->passport_expiration_date}}" name="passport_expiration_date" />
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
        <div class='input-group date' id='AdherenttDatepicker'>
          <input type='text' class="form-control" placeholder="dd-mm-yyyy" value="{{$emp->date_of_adherent}}" name="date_of_adherent" />
          <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
          </span>
        </div>
      </div>

      <label class="col-md-2" >Mã thẻ Đảng</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="adherent_number" value="{{$emp->adherent_number}}" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Chức vụ Đảng</label>
      <div class="col-md-4">
        <select class="form-control" name="adherent_position" value="{{$emp->adherent_position}}">
          <option>Không</option>
          <option>Đảng viên</option>
          <option>Ủy viên thường vụ Đảng</option>
          <option>Phó Bí thư Đảng</option>
          <option>Bí thư Đảng</option>
        </select>
      </div>

      <label class="col-md-2">Nơi sinh hoạt Đảng</label>
      <div class="col-md-4">
        <input type='text' class="form-control" name="adherent_activies_place" value="{{$emp->adherent_activies_place}}" />
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2" >Tình trạng hôn nhân</label>
      <div class="col-md-4">
        <select class="form-control" name="marial_status">
          <option
          @if($emp->marial_status == 0)
          {{"selected"}}
          @endif
          value="0">Độc thân</option>
          <option
          @if($emp->marial_status == 1)
          {{"selected"}}
          @endif
          value="1"
          >Đã kết hôn</option>
        </select>
      </div>

      <label class="col-md-2"></label>
      <div class="col-md-4">

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Dân tộc</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="ethnic" value="{{$emp->ethnic}}" />
      </div>

      <label class="col-md-2">Tôn giáo</label>
      <div class="col-md-4">
        <input type='text' class="form-control" name="religion" value="{{$emp->religion}}" />
      </div>
    </div>
    <?php
    $household_address = json_decode($emp->household_address);
    ?>

    <div class="form-group">
      <label class="col-md-2">Hộ khẩu</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="household_address" value="{{$household_address->address}}"/>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="household_address_district" id="household_address_district">
          <option value="">Quận/Huyện</option>
          @foreach ($json as $key => $value)
          @foreach ($value['quan-huyen'] as $key => $value)
          <option 
          @if($value['name'] == $household_address->district)
          {{"selected"}}
          @endif
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="household_address_province" id="household_address_province">
          <option value="">Tỉnh/Thành phố</option>
          @foreach ($json as $key => $value)
          <option
          @if($value['name'] == $household_address->province)
          {{"selected"}}
          @endif 
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
        </select>
      </div>

    </div>
    <?php
    $place_of_birth = json_decode($emp->place_of_birth);
    ?>

    <div class="form-group">
      <label class="col-md-2">Nơi sinh</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="place_of_birth" value="{{$place_of_birth->address}}"/>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="place_of_birth_district" id="place_of_birth_district">
          <option value="">Quận/Huyện</option>
          @foreach ($json as $key => $value)
          @foreach ($value['quan-huyen'] as $key => $value)
          <option 
          @if($value['name'] == $place_of_birth->district)
          {{"selected"}}
          @endif
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="place_of_birth_province" id="place_of_birth_province">
          <option value="">Tỉnh/Thành phố</option>
          @foreach ($json as $key => $value)
          <option
          @if($value['name'] == $place_of_birth->province)
          {{"selected"}}
          @endif 
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <?php
    $address = json_decode($emp->address);
    ?>

    <div class="form-group">
      <label class="col-md-2">Nơi ở</label>
      <div class="col-md-4">
        <input class="form-control" type="text"  name="address" value="{{$address->address}}"/>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="address_district" id="address_district">
          <option value="">Quận/Huyện</option>
          @foreach ($json as $key => $value)
          @foreach ($value['quan-huyen'] as $key => $value)
          <option
          @if($value['name'] == $address->district)
          {{"selected"}}
          @endif 
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
          @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select class="form-control" name="address_province" id="address_province">
          <option value="">Tỉnh/Thành phố</option>
          @foreach ($json as $key => $value)
          <option
          @if($value['name'] == $address->province)
          {{"selected"}}
          @endif 
          value="{{$value['name']}}">{{$value['name']}}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2">Ghi chú</label>
      <div class="col-md-10">
        <textarea class="form-control" rows="3" value="{{$emp->note}}" name="note">{{$emp->note}}</textarea>
      </div>
    </div>

    <div class="ln_solid"></div>
    <div class="form-group">
      <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-8">
        <button type="button" class="btn btn-default">Cancel</button>
        <button type="reset" class="btn btn-success">Reset</button>
        <button type="submit" class="btn btn-primary">Edit</button>
      </div>
    </div>

  </form>
</div>
