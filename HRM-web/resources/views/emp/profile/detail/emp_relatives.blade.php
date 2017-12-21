<div class="x_content">
  <?php
  $string = file_get_contents('json/tree.json');
  $json = json_decode($string, true);
  ?>
  <div class="clearfix"></div>

  <div id="relatives-notify"></div>
  <div class="">
    <div class="btn-group">
      <button type="button" class="btn btn-default" data-toggle="modal" 
      data-target="#favoritesModal"> 
      <span class="docs-tooltip" data-toggle="tooltip" title="Tìm kiếm">
        <span class="fa fa-search"></span>
      </span></button>
      <button type="button" class="btn btn-default" id="btn-add-relatives" value="{{$emp->id}}"> 
        <span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
          <span class="fa fa-plus"></span>
        </span></button>
        <button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
          <span class="docs-tooltip" data-toggle="tooltip" title="In">
            <span class="fa fa-print"></span>
          </span>
        </button>
        <button type="button" class="btn btn-default" data-toggle="modal" 
        data-target="#favoritesModal" data-method="setDragMode" data-option="move"> 
        <span class="docs-tooltip" data-toggle="tooltip" title="Xuất">
          <span class="fa fa-file-pdf-o"></span>
        </span></button>
      </div>
    </div>
    <br>

    <table class="data table table-striped no-margin">
      <thead>
        <tr>
          <th>#</th>
          <th>Quan hệ</th>
          <th>Họ tên</th>
          <th>Năm sinh</th>
          <th>Nghề nghiệp</th>
          <th class="col-md-3">Địa chỉ</th>
          <th>Chi tiết</th>
        </tr>
      </thead>
      <tbody id="relatives-list">
        @foreach($emp->emp_relative as $relative)
        <tr id="relatives{{$relative->id}}">
          <?php
          $addr = json_decode($relative->address);
          ?>
          <td>{{$relative->id}}</td>
          <td class="blue">{{$relative->relationship}}</td>
          <td>{{$relative->name}}</td>
          <td>{{$relative->date_of_birth}}</td>
          <td>{{$relative->career}}</td>
          <td class="col-md-3">{{showAddress($relative->address)}}</td>
          <td>
            <span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin chi tiết">
              <button class="btn btn-info btn-xs btn-detail-relatives" value="{{$relative->id}}"><i class="fa fa-info-circle"></i></button>
            </span>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>

  <!-- <i class="fa fa-info-circle"></i>   class="btn btn-default btn-xs" -->

  <div id="modalRelatives" class="modal fade" role="diolog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"> <b>Quan hệ gia đình</b></h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left"  id="formRelatives">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label class="col-md-2" >Nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="relatives-name_emp" id="relatives-name_emp">
              </div>

              <label class="col-md-2">Mã nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="relatives-id_emp" id="relatives-id_emp">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Họ tên *</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relatives-name" required="" id="relatives-name">
              </div>

              <label class="col-md-2" >Mối quan hệ *</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relationship" required="" id="relationship">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Ngày sinh</label>
              <div class="col-md-4">
                <div class='input-group date' id="RelativesDateOfBirthDatepicker">
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="relatives-date_of_birth" id="relatives-date_of_birth" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <label class="col-md-2" >Điện thoại</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relatives-phone" id="relatives-phone">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Nghề nghiệp</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relatives-career" required="" id="relatives-career">
              </div>

              <label class="col-md-2" >Nơi công tác</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relatives-workplace" id="relatives-workplace">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Địa chỉ</label>
              <div class="col-md-4">
                <input class="form-control" type="text"  name="relatives-address" id="relatives-address" />
              </div>
              <div class="col-md-3">
                <select class="form-control" name="relatives-address_district" id="relatives-address_district">
                  <option value="">Quận/Huyện</option>
                  @foreach ($json as $key => $value)
                  @foreach ($value['quan-huyen'] as $key => $value)
                  <option value="{{$value['name']}}">{{$value['name']}}</option>
                  @endforeach
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" name="relatives-address_province" id="relatives-address_province">
                  <option value="">Tỉnh/Thành phố</option>
                  @foreach ($json as $key => $value)
                  <option value="{{$value['name']}}">{{$value['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Ghi chú</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="3" name="relatives-note"></textarea>
              </div>
            </div>

            <hr>
            <div class="col-md-5 col-md-offset-8">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-success" > Reset</button>
              <button type="button" class="btn btn-primary" id="btn-save-relatives" value="add">Save</button>
              <input type="hidden" name="relatives-id" id="relatives-id" value="0">
            </div>

          </form> 
        </div>
      </div>
    </div>

  </div>








  <!-- Modal add family relatives -->
  <div id="modalAddRelatives" class="modal fade" role="diolog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"> <b>Thêm quan hệ gia đình</b></h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" action="hrm/emp/relatives/add" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label class="col-md-2" >Nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="name_emp">
              </div>

              <label class="col-md-2">Mã nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="id_emp">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Họ tên *</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="name" required="">
              </div>

              <label class="col-md-2" >Mối quan hệ *</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relationship" required="">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Ngày sinh</label>
              <div class="col-md-4">
                <div class='input-group date' id="RelativesDateOfBirthDatepicker">
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_of_birth" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <label class="col-md-2" >Điện thoại</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="phone">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Nghề nghiệp</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="career" required="">
              </div>

              <label class="col-md-2" >Nơi công tác</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="workplace">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Địa chỉ</label>
              <div class="col-md-4">
                <input class="form-control" type="text"  name="address"/>
              </div>
              <div class="col-md-3">
                <select class="form-control" name="address_district">
                  <option value="">Quận/Huyện</option>
                  @foreach ($json as $key => $value)
                  @foreach ($value['quan-huyen'] as $key => $value)
                  <option value="{{$value['name']}}">{{$value['name']}}</option>
                  @endforeach
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" name="address_province">
                  <option value="">Tỉnh/Thành phố</option>
                  @foreach ($json as $key => $value)
                  <option value="{{$value['name']}}">{{$value['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>



            <div class="form-group">
              <label class="col-md-2">Ghi chú</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="3" name="note"></textarea>
              </div>
            </div>

            <hr>
            <div class="col-md-5 col-md-offset-8">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-success" > Reset</button>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>

          </form> 
        </div>
      </div>
    </div>

  </div>
  <!-- /Modal add family relatives -->


  <!-- Modal view family relatives -->
  <div id="modalViewRelatives" class="modal fade" role="diolog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"> <b>Xem quan hệ gia đình</b></h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left" action="hrm/emp/relatives/edit" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label class="col-md-2" >Nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="name_emp">
              </div>

              <label class="col-md-2">Mã nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="id_emp">
              </div>
            </div>
            <input type="hidden" name="id">

            <div class="form-group">
              <label class="col-md-2" >Họ tên *</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="name" required="">
              </div>

              <label class="col-md-2" >Mối quan hệ</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="relationship">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Ngày sinh</label>
              <div class="col-md-4">
                <div class='input-group date' id="RelativesDateOfBirthDatepicker">
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_of_birth" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <label class="col-md-2" >Điện thoại</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="phone">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Nghề nghiệp</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="career" required="">
              </div>

              <label class="col-md-2" >Nơi công tác</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="workplace">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Địa chỉ</label>
              <div class="col-md-4">
                <input class="form-control" type="text"  name="address"/>
              </div>
              <div class="col-md-3">
                <select class="form-control" name="address_district">
                  <option value="">Quận/Huyện</option>
                  @foreach ($json as $key => $value)
                  @foreach ($value['quan-huyen'] as $key => $value)
                  <option value="{{$value['name']}}">{{$value['name']}}</option>
                  @endforeach
                  @endforeach
                </select>
              </div>
              <div class="col-md-3">
                <select class="form-control" name="address_province">
                  <option value="">Tỉnh/Thành phố</option>
                  @foreach ($json as $key => $value)
                  <option value="{{$value['name']}}">{{$value['name']}}</option>
                  @endforeach
                </select>
              </div>
            </div>



            <div class="form-group">
              <label class="col-md-2">Ghi chú</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="3" name="note"></textarea>
              </div>
            </div>

            <hr>
            <div class="col-md-5 col-md-offset-8">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-success" > Reset</button>
              <button type="submit" class="btn btn-primary">Edit</button>
              <button type="button" class="btn btn-danger"> Delete</button>
            </div>

          </form> 
        </div>
      </div>
    </div>

  </div>
  <!-- /Modal view family relatives -->
