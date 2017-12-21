<div class="x_content">
  <br />
  <?php
  $string = file_get_contents('json/tree.json');
  $json = json_decode($string, true);
  ?>
  <div class="clearfix"></div>
  @include('hrm.layout.notify')
  <form class="form-horizontal form-label-left" enctype="multipart/form-data" >

    <div class="form-group">
      <label class="col-md-2" >Mã nhân viên</label>
      <div class="col-md-4" style="color: black">
        <!-- <input class="form-control" type="text" readonly="readonly" value="{{convertIdEmp($emp->id)}}" name="id"> -->
        <b>{{$emp->emp_code}}</b> 
      </div>

      <label class="col-md-2">Số hồ sơ</label>
      <div class="col-md-4"  style="color: black">
        <!-- <input class="form-control" type="text"  value="{{$emp->profile_number}}" required="" name="profile_number"> -->
        <b>{{$emp->profile_number}}</b>
      </div>

    </div>

    <div class="form-group">
      <label class="col-md-2" >Họ và tên</label>
      <div class="col-md-4" style="color: black">
        <b>{{$emp->name}}</b>
      </div>
      <label class="col-md-2">Ngày vào</label>
      <div class="col-md-4" style="color: black">{{$emp->date_begin}}</div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Giới tính</label>
      <div class="col-md-4" style="color: black">
        @if($emp->gender == 1)
        Nam
        @else
        Nữ
        @endif 

      </div>

      <label class="col-md-2">Ngày sinh</label>
      <div class='col-sm-4' style="color: black">
        {{$emp->date_of_birth}}
      </div>
    </div>


    <div class="form-group">
      <label class="col-md-2" >Số điện thoại</label>
      <div class="col-md-4" style="color: black">
        {{$emp->phone}}
      </div>

      <label class="col-md-2">Email</label>
      <div class="col-md-4" style="color: black">
        {{$emp->email}}
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2" >Quốc gia</label>
      <div class="col-md-4" style="color: black">
        {{$emp->country}}
      </div>

      <label class="col-md-2">Số CMT</label>
      <div class="col-md-4" style="color: black">
        {{$emp->identity_card}}
      </div>
    </div>


    <div class="form-group">

      <label class="col-md-2" >Ngày cấp CMT</label>
      <div class='col-sm-4'  style="color: black">  
        {{$emp->id_date_of_issued}}
      </div>
      <label class="col-md-2">Nơi cấp CMT</label>
      <div class="col-md-4"  style="color: black">
        {!! $emp->id_issued_by !!}
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Số hộ chiếu</label>
      <div class="col-md-4" style="color: black">
        {{$emp->passport_number}}
      </div>

      <label class="col-md-2">Ngày cấp</label>
      <div class="col-md-4" style="color: black">
        {{$emp->passport_date_of_issued}}
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Nơi cấp</label>
      <div class="col-md-4" style="color: black">
        {{$emp->passport_issued_by}}
      </div>

      <label class="col-md-2">Ngày hết hạn</label>
      <div class="col-md-4" style="color: black">
        {{$emp->passport_expiration_date}}
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2">Ngày vào Đảng</label>
      <div class="col-md-4" style="color: black">
        {{$emp->date_of_adherent}}
      </div>

      <label class="col-md-2" >Mã thẻ Đảng</label>
      <div class="col-md-4" style="color: black">
        {{$emp->adherent_number}}
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Chức vụ Đảng</label>
      <div class="col-md-4" style="color: black">
        {{$emp->adherent_position}}
      </div>

      <label class="col-md-2">Nơi sinh hoạt Đảng</label>
      <div class="col-md-4" style="color: black">
        {{$emp->adherent_activies_place}}
      </div>
    </div>
    <hr>

    <div class="form-group">
      <label class="col-md-2" >Tình trạng hôn nhân</label>
      <div class="col-md-4" style="color: black">
        @if($emp->marial_status == 0)
        Độc thân
        @else
        Đã kết hôn
        @endif
      </div>

      <label class="col-md-2"></label>
      <div class="col-md-4">

      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2" >Dân tộc</label>
      <div class="col-md-4"  style="color: black">
        {{$emp->ethnic}}
      </div>

      <label class="col-md-2">Tôn giáo</label>
      <div class="col-md-4"  style="color: black">
        {{$emp->religion}}
      </div>
    </div>


    <div class="form-group">
      <label class="col-md-2">Hộ khẩu</label>
      <div class="col-md-10" style="color: black">
        {{showAddress($emp->household_address)}}
      </div>

    </div>


    <div class="form-group">
      <label class="col-md-2">Nơi sinh</label>
      <div class="col-md-10"  style="color: black">
        {{showAddress($emp->place_of_birth)}}
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-2">Nơi ở</label>
      <div class="col-md-10"  style="color: black">
        {{showAddress($emp->address)}}

      </div>

    </div>

    <div class="form-group">
      <label class="col-md-2">Ghi chú</label>
      <div class="col-md-10 blue">
        {{$emp->note}}
      </div>
    </div>

  </form>
</div>

<?php
$string = file_get_contents('json/tree.json');
$json = json_decode($string, true);
?>


<!-- Modal profile -->
<div id="modal-profile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> <b>Cập nhật hồ sơ</b></h3>
      </div>

      <div class="modal-body">
        <div class="danger">
          <h5 class="red"> <b>Lưu ý: </b>Nhân viên phải đảm bảo cung cấp thông tin trung thực, trong trường hợp cố tình cung cấp thông tin sai lệch sẽ phải chịu trách nhiệm về xử lý kỷ luật.</h5>
        </div>
        <div class="ln_solid"></div>
        <form  class="form-horizontal form-label-left"  id="form-profile" action="emp/profile/update/profile" method="POST" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">

          <div class="form-group">
            <label class="col-md-2" >Mã nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" type="text" readonly="readonly" value="{{$emp->emp_code}}" name="emp_code" required="">
            </div>


            <label class="col-md-2">Họ và tên</label>
            <div class="col-md-4">
              <input class="form-control" type="text" readonly="readonly" value="{{$emp->name}}" required="" name="name">
            </div>

            <?php
            $name = $emp->name;
            $name = convertString($name, 1);
            ?>

           <!--  <input type="hidden"  value="{{splitName($name)[0]}}" name="last_name">
            <input type="hidden"  value="{{splitName($name)[1]}}" name="middle_name">
            <input type="hidden" value="{{splitName($name)[2]}}" name="first_name">

            <input type="hidden"  value="{{$emp->profile_number}}" name="profile_number">
            <input type="hidden" name="date_begin" value="{{$emp->date_begin}}"> -->

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
              <div class='input-group date' id='datepicker-date_of_birth'>
                <input type='text' class="form-control" placeholder="dd-mm-yyyy" value="{{$emp->date_of_birth}}" name="date_of_birth" required="" />
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
              <div class='input-group date' id='datepicker-identity_issued'>
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
              <div class='input-group date' id='datepicker-passport_issued'>
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
              <div class='input-group date' id='datepicker-passport_expired'>
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
              <div class='input-group date' id='datepicker-adherent'>
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
                value="1">Đã kết hôn</option>
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
              <input type='text' class="form-control" name="religion" value="{{$emp->religion}}"/>
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
              <textarea class="form-control" rows="3" value="" name="note">{{$emp->note}}</textarea>
            </div>
          </div>

          <div class="ln_solid"></div>

          <div class="form-group">
            <input type="checkbox" class="flat" name="confirm" value="1" required=""> &nbsp; Tôi xin cam đoan những thay đổi trên đây là đúng sự thật và chịu trách nhiệm cho những thay đổi này.

            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-9">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Thoát </button>
                <button type="submit" class="btn btn-success"> Cập nhật </button>
              </div>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

</div>
<!-- /Modal profile -->

