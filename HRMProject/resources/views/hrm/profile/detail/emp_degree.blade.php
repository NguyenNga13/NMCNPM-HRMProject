<div class="col-md-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Trình độ chuyên môn</h2>
      <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <div id="notify_specialized"></div>

      <div class="">
        <div class="btn-group">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#favoritesModal"> 
            <span class="docs-tooltip" data-toggle="tooltip" title="Tìm kiếm">
              <span class="fa fa-search"></span>
            </span>
          </button>
          <!--  <button type="button" class="btn btn-default" data-toggle="modal" 
          data-target="#modalAddSpecialized" data-id_emp="{{convertIdEmp($emp->id)}}" data-name_emp="{{$emp->name}}"> 
          <span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
            <span class="fa fa-plus"></span>
          </span></button> -->
          <button type="button" class="btn btn-default" id="btn-add-specialized" name="btn-add-specialized" value="{{$emp->id}}" > 
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
              <th>Chuyên môn</th>
              <th>Bằng cấp</th>
              <th>Nơi đào tạo</th>
              <th>Trình độ</th>
              <th>Chi tiết</th>
            </tr>
          </thead>
          <tbody  id="specialized-list" name="specialized-list">
            @foreach($emp->emp_specialized as $specialized)
            <tr id="specialized{{$specialized->id}}">
              <td>{{$specialized->id}}</td>
              <td>{{$specialized->specialized}}</td>
              <td>{{$specialized->degree}}</td>
              <td>{{$specialized->issued_by}}</td>

              <td>{{$specialized->level}}</td>
              <td>
                <span class="docs-tooltip" data-toggle="tooltip" title="Xem trình độ chuyên môn">
                  <button class="btn btn-info btn-xs btn-detail-specialized open-modal-specialized" value="{{$specialized->id}}"><i class="fa fa-info-circle"></i></button>
                </span>
                <span class="docs-tooltip" data-toggle="tooltip" title="Xóa trình độ chuyên môn">
                  <button class="btn btn-danger btn-xs btn-delete delete-specialized" value="{{$specialized->id}}"><i class="fa fa-trash"></i></button>
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <div class="col-md-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Trình độ ngoại ngữ</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="">
          <div id="notify_language"></div>
          <div class="btn-group">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#favoritesModal"> 
              <span class="docs-tooltip" data-toggle="tooltip" title="Tìm kiếm">
                <span class="fa fa-search"></span>
              </span>
            </button>
            <button type="button" class="btn btn-default" id="btn-add-language" name="btn-add-language" value="{{$emp->id}}"> 
              <span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
                <span class="fa fa-plus"></span>
              </span>
            </button>
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
              <th>Ngoại ngữ</th>
              <th>Chứng chỉ</th>
              <th>Nơi cấp</th>
              <th>Trình độ</th>
              <th>Chi tiết</th>
            </tr>
          </thead>
          <tbody id="language-list" name="language-list">
            @foreach($emp->emp_language as $language)
            <tr id="language{{$language->id}}">
              <td>{{$language->id}}</td>
              <td>{{$language->language}}</td>
              <td>{{$language->certificate_type}}</td>
              <td>{{$language->issued_by}}</td>
              <td>{{$language->level}}</td>
              <td>
                <span class="docs-tooltip" data-toggle="tooltip" title="Xem trình độ ngoại ngữ">
                  <button class="btn btn-info btn-xs btn-detail-language open-modal-language" value="{{$language->id}}"><i class="fa fa-info-circle"></i> </button>
                </span>
                <span class="docs-tooltip" data-toggle="tooltip" title="Xóa trình độ ngoại ngữ">
                  <button class="btn btn-danger btn-xs btn-delete delete-language" value="{{$language->id}}"><i class="fa fa-trash"></i> </button>
                </span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal ADD specialized degree -->
  <div id="modalSpecialized" class="modal fade" role="diolog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title"> Trình độ chuyên môn</h3>
        </div>
        <div class="modal-body">
          <form class="form-horizontal form-label-left"  id="formSpecialized">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
              <label class="col-md-2" >Nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="name_emp_specialized" id="name_emp_specialized">
              </div>

              <label class="col-md-2">Mã nhân viên</label>
              <div class="col-md-4">
                <input class="form-control" readonly="readonly" type="text"  name="id_emp_specialized" id="id_emp_specialized">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Chuyên môn</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="specialized" required="" id="specialized">
              </div>

              <label class="col-md-2" >Nơi đào tạo</label>
              <div class="col-md-4">
                <input class="form-control"  type="text"  name="specialized_issued_by" required="" id="specialized_issued_by">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Bằng cấp</label>
              <div class="col-md-4">
                <select class="form-control" name="degree" id="degree">
                  <option value="Tiến sĩ">Tiến sĩ</option>
                  <option value="Thạc sĩ">Thạc sĩ</option>
                  <option value="Kỹ sư">Kỹ sư</option>
                  <option value="Cử nhân">Cử nhân</option>
                  <option value="Cao đẳng">Cao đẳng</option>
                  <option value="Trung cấp">Trung cấp</option>
                  <option value="Khác">Khác</option>
                </select>
              </div>
              <label class="col-md-2" >Hệ đào tạo</label>
              <div class="col-md-4">
                <select class="form-control" name="training_type" id="training_type">
                  <option value="Chính quy">Chính quy</option>
                  <option value="Tại chức">Tại chức</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2" >Trình độ</label>
              <div class="col-md-4">
                <select class="form-control" name="specialized_level" id="specialized_level">
                  <option value="Xuất sắc">Xuất sắc</option>
                  <option value="Giỏi">Giỏi</option>
                  <option value="Khá">Khá</option>
                  <option value="Trung bình">Trung bình</option>
                </select>
              </div>
              <label class="col-md-2">Ngày cấp</label>
              <div class="col-md-4">
                <div class='input-group date' id="SpecializedDatepicker">
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="specialized_date_of_issued"  id="specialized_date_of_issued" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Thời gian đào tạo</label>
              <div class="col-md-4">
                <div class='input-group date' id="SpecializedBeginDatepicker">
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="begin" id="begin" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <label class="col-md-2">đến</label>
              <div class="col-md-4">
                <div class='input-group date' id="SpecializedFinishDatepicker">
                  <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="finish" id="finish" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2">Ghi chú</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="3" name="specialized_note" id="specialized_note"></textarea>
              </div>
            </div>
            

            <hr>
            <div class="col-md-5 col-md-offset-8">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-success" > Reset</button>
              <button type="button" class="btn btn-primary" id="btn-save-specialized" value="add">Save</button>
              <input type="hidden" name="id_specialized" id="id_specialized" value="0">
            </div>

          </form> 
        </div>
      </div>
    </div>

  </div>
  <!-- /Modal ADD specialized degree -->

  <!-- Modal VIEW specialized degree -->
<!-- <div id="modalViewSpecialized" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> Trình độ chuyên môn</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" action="hrm/emp/degree/specialized/edit" method="POST">
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
            <label class="col-md-2" >Chuyên môn</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="specialized" required="">
            </div>

            <label class="col-md-2" >Nơi đào tạo</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="issued_by" required="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Bằng cấp</label>
            <div class="col-md-4">
              <select class="form-control" name="degree">
                <option value="Tiến sĩ">Tiến sĩ</option>
                <option value="Thạc sĩ">Thạc sĩ</option>
                <option value="Kỹ sư">Kỹ sư</option>
                <option value="Cử nhân">Cử nhân</option>
                <option value="Cao đẳng">Cao đẳng</option>
                <option value="Trung cấp">Trung cấp</option>
                <option value="Khác">Khác</option>
              </select>
            </div>
            <label class="col-md-2" >Hệ đào tạo</label>
            <div class="col-md-4">
              <select class="form-control" name="training_type">
                <option value="Chính quy">Chính quy</option>
                <option value="Tại chức">Tại chức</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Trình độ</label>
            <div class="col-md-4">
              <select class="form-control" name="level">
                <option value="Xuất sắc">Xuất sắc</option>
                <option value="Giỏi">Giỏi</option>
                <option value="Khá">Khá</option>
                <option value="Trung bình">Trung bình</option>
              </select>
            </div>
            <label class="col-md-2">Ngày cấp</label>
            <div class="col-md-4">
              <div class='input-group date' id="ViewSpecializedDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_of_issued" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Thời gian đào tạo</label>
            <div class="col-md-4">
              <div class='input-group date' id="ViewSpecializedBeginDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="begin" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <label class="col-md-2">đến</label>
            <div class="col-md-4">
              <div class='input-group date' id="ViewSpecializedFinishDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="finish" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
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
          </div>

        </form> 
      </div>
    </div>
  </div>

</div> -->
<!-- /Modal view specialized degree -->

<!-- Modal ADD language degree -->
<!-- <div id="modalAddLanguage" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> Thêm trình độ ngoại ngữ</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" action="hrm/emp/degree/language/add" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="name_emp_language_add">
            </div>

            <label class="col-md-2">Mã nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="id_emp_language_add">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Ngoại ngữ *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="language" required="">
            </div>

            <label class="col-md-2" >Chứng chỉ *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="certificate_type" required="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Trình độ *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="level" required="">
            </div>
            <label class="col-md-2" >Nơi cấp</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="issued_by">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Ngày cấp</label>
            <div class="col-md-4">
              <div class='input-group date' id="LanguageIssuedDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_of_issued" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>

            <label class="col-md-2" >Ngày hết hạn</label>
            <div class="col-md-4">
              <div class='input-group date' id="LanguageExpireDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="expire" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
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

</div> -->
<!-- /Modal add language degree -->

<!-- Modal VIEW language degree -->
<div id="modalLanguage" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> Trình độ ngoại ngữ <small id="modal_action"></small></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left"  method="POST" id="formLanguage">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Nhân viên</label>
            <div class="col-md-4">
              <input class="form-control"  type="text" readonly="readonly" name="name_emp_language" id="name_emp_language">
            </div>

            <label class="col-md-2">Mã nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" type="text" readonly="readonly" name="id_emp_language" id="id_emp_language">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Ngoại ngữ *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="language" required="" id="language">
            </div>

            <label class="col-md-2" >Chứng chỉ *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="certificate_type" id="certificate_type" required="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Trình độ *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="level" id="level" required="">
            </div>
            <label class="col-md-2" >Nơi cấp</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="issued_by" id="issued_by">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Ngày cấp</label>
            <div class="col-md-4">
              <div class='input-group date' id="LanguageIssuedDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_of_issued" id="date_of_issued" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>

            <label class="col-md-2" >Ngày hết hạn</label>
            <div class="col-md-4">
             <div class='input-group date' id="LanguageExpireDatepicker">
              <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="expire" id="expire" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2">Ghi chú</label>
          <div class="col-md-10">
            <textarea class="form-control" rows="3" name="note" id="note"></textarea>
          </div>
        </div>

        <hr>
        <div class="col-md-5 col-md-offset-8">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="btn-save-language" value="add">Save</button>
          <input type="hidden" id="id_language" name="id_language" value="0">
        </div>

      </form> 
    </div>
  </div>
</div>

</div>
<!-- /Modal add language degree -->

<!-- Modal confirm delete language-->
<!-- <div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title red"> Xác nhận xóa</h3>
      </div>
      <div class="modal-body">
        <p id="message"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-danger btn-confirm-delete" id="btn-confirm-delete">Delete</button> 
      </div>
    </div>
  </div>
</div> -->
<!-- /Modal confirm delete-->

<!-- Modal confirm delete specialized -->
<!-- <div class="modal fade" id="modalConfirmDeleteSpecialized" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title red"> Xác nhận xóa</h3>
      </div>
      <div class="modal-body">
        <p>Bạn muốn xóa trình độ chuyên môn này?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button class="btn btn-danger btn-confirm-delete" id="btn-confirm-delete-specialized">Delete</button> 
      </div>
    </div>
  </div>
</div> -->
<!-- /Modal confirm delete-->