<div class="">
  <div class="row">
    <div class="col-md-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Công việc hiện tại</h2>
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
          <br />
          <form class="form-horizontal form-label-left">

            <div class="form-group">
              <label class="col-md-2" >Chức vụ</label>
              <div class="col-md-4">
                <select class="form-control">
                  <option>Chức vụ</option>
                  @foreach($pos_list as $pos)
                  <option
                  @if($pos->position == $emp->position)
                  {{"selected"}}
                  @endif 
                  value="{{$pos->position}}">{{$pos->position}}</option>
                  @endforeach
                </select>
              </div>

              <label class="col-md-2">Phòng ban</label>
              <div class="col-md-4">
                <select class="form-control">
                  <option>Phòng ban</option>
                  @foreach($dep_list as $dep)
                  <option
                  @if($dep->department == $emp->department)
                  {{"selected"}}
                  @endif 
                  value="{{$dep->department}}">{{$dep->department}}</option>
                  @endforeach
                </select>
              </div>

            </div>


            <div class="form-group">
              <label class="col-md-2">Ngày bắt đầu</label>
              <div class='col-sm-4'>
                <div class='input-group date' id="CurrentPositionDatepicker">
                  <input type='text' class="form-control"  placeholder="dd-mm-yyyy" value="{{$emp->date_begin}}" />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <label class="col-md-2" >Số Quyết định</label>
              <div class="col-md-4">
                <input class="form-control" type="text"  name=""  value="{{$emp->decided_number}}">
              </div>
            </div>



            <div class="form-group">
              <label class="col-md-2" >Kiêm nhiệm</label>
              <div class="col-md-4">
                <select class="form-control">
                  <option value="">Kiêm nhiệm</option>

                  @foreach($pos_list as $pos)
                  <option
                  @if($emp_concurrent != null)
                  @if($pos->position == $emp_concurrent->position->position)
                  {{"selected"}}
                  @endif 
                  @endif
                  value="{{$pos->position}}">{{$pos->position}}</option>
                  @endforeach
                </select>
              </div>

              <label class="col-md-2">Phòng ban</label>
              <div class="col-md-4">
                <select class="form-control">
                  <option>Phòng ban</option>
                  @foreach($dep_list as $dep)
                  <option
                  @if($emp_concurrent != null)
                  @if($dep->department == $emp_concurrent->department->department)
                  {{"selected"}}
                  @endif
                  @endif  
                  value="{{$dep->department}}">{{$dep->department}}</option>
                  @endforeach
                </select>
              </div>

            </div>


            <div class="form-group">
              <label class="col-md-2">Ngày bắt đầu</label>
              <div class='col-sm-4'>
                <div class='input-group date' id="ConcurrentPositionDatePicker">
                  <input type='text' class="form-control" placeholder="dd-mm-yyyy" 
                  @if($emp_concurrent != null)
                  value="{{$emp_concurrent->date_begin}}"
                  @endif
                  />
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                </div>
              </div>
              <label class="col-md-2" >Số Quyết định</label>
              <div class="col-md-4">
                <input class="form-control" type="text"  name="" 
                @if($emp_concurrent != null)
                value="{{$emp_concurrent->decided_number}}"
                @endif
                />
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2">Ghi chú</label>
              <div class="col-md-10">
                <textarea class="form-control" rows="3" >
                  {{$emp->note}}
                </textarea>
              </div>
            </div>
          <!--   <div class="ln_solid"></div>
            <div class="form-group">
              <div class="center col-md-5 col-sm-5 col-md-offset-5">
                <button type="button" class="btn btn-primary">Cancel</button>
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-success">Submit</button>
              </div>
            </div> -->

          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-xs-12 col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Quá trình công tác</h2>
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
          <div id="position-notify"></div>


          <div class="">
            <div class="btn-group">
             <!--  <button type="button" class="btn btn-default" data-toggle="modal" 
              data-target="#favoritesModal"> 
              <span class="docs-tooltip" data-toggle="tooltip" title="Tìm kiếm">
                <span class="fa fa-search"></span>
              </span></button> -->
              <button type="button" class="btn btn-default" data-toggle="modal" id="btn-add-position" value="{{$emp->id}}"  data-id_emp="{{convertIdEmp($emp->id)}}" data-name_emp="{{$emp->name}}"> 
                <span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
                  <span class="fa fa-plus"></span>
                </span>
              </button>
              <button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
                <span class="docs-tooltip" data-toggle="tooltip" title="In">
                  <span class="fa fa-print"></span>
                </span>
              </button>
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#favoritesModal" data-method="setDragMode" data-option="move"> 
                <span class="docs-tooltip" data-toggle="tooltip" title="Xuất">
                  <span class="fa fa-file-pdf-o"></span>
                </span>
              </button>
            </div>
          </div>
          <br>
          <!-- start user projects -->
          <table class="data table table-striped no-margin">
            <thead>
              <tr>
                <th>#</th>
                <th>Từ ngày</th>
                <th>Đến ngày</th>
                <th>Chức vụ</th>
                <th>Phòng ban</th>
                <th>Trạng thái</th>
                <th>Chi tiết</th>
              </tr>
            </thead>
            <tbody id = "emp_position-list">
              @foreach($emp->emp_position as $pos)
              <tr id="position{{$pos->id}}">
                <td>{{$pos->id}}</td>
                <td>{{$pos->date_begin}}</td>
                <td>{{$pos->date_finish}}</td>
                <td>{{$pos->position->position}}</td>
                <td>{{$pos->department->department}}</td>
                <td>
                  @if($pos->status == 1)
                  Chức vụ chính
                  @else
                  Kiêm nhiệm
                  @endif
                </td>
                <td>
                  <span class="docs-tooltip" data-toggle="tooltip" title="Xem chi tiết">
                    <button class="btn btn-info btn-xs btn-detail-position" title="Xem thông tin chức vụ" value="{{$pos->id}}"> <i class="fa fa-info-circle"></i></button>
                  </span>
                  <span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
                    <button class="btn btn-danger btn-xs btn-delete-position" value="{{$pos->id}}"><i class="fa fa-trash"></i></button>
                  </span>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <!-- end user projects -->
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-xs-12 col-md-12">
     <div class="x_panel">
      <div class="x_title">
        <h2>Khen thưởng, kỷ luật</h2>
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
        <table class="data table table-striped no-margin">
          <thead>
            <tr>
              <th>#</th>
              <th>Project Name</th>
              <th>Client Company</th>
              <th class="hidden-phone">Hours Spent</th>
              <th>Contribution</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>New Company Takeover Review</td>
              <td>Deveint Inc</td>
              <td class="hidden-phone">18</td>
              <td class="vertical-align-mid">
                <div class="progress">
                  <div class="progress-bar progress-bar-success" data-transitiongoal="35"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>New Partner Contracts Consultanci</td>
              <td>Deveint Inc</td>
              <td class="hidden-phone">13</td>
              <td class="vertical-align-mid">
                <div class="progress">
                  <div class="progress-bar progress-bar-danger" data-transitiongoal="15">

                  </div>
                </div>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Partners and Inverstors report</td>
              <td>Deveint Inc</td>
              <td class="hidden-phone">30</td>
              <td class="vertical-align-mid">
                <div class="progress">
                  <div class="progress-bar progress-bar-success" data-transitiongoal="45"></div>
                </div>
              </td>
            </tr>
            <tr>
              <td>4</td>
              <td>New Company Takeover Review</td>
              <td>Deveint Inc</td>
              <td class="hidden-phone">28</td>
              <td class="vertical-align-mid">
                <div class="progress">
                  <div class="progress-bar progress-bar-success" data-transitiongoal="75">

                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal add position -->
<div id="modalAddPosition" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Chuyển công tác</b></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" id="formAddPosition">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="position-name_emp" id="position-name_emp">
            </div>

            <label class="col-md-2">Mã nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="position-id_emp" id="position-id_emp">
            </div>
          </div>

          <br>

          <!-- Chức vụ hiện tại -->
          <div>
            <h3 class="col-md-12 blue text-center">Chức vụ hiện tại</h3>
          </div>
          <br>
          <div class="form-group">
            <label class="col-md-2" >Chức vụ</label>
            <div class="col-md-4">
              <select class="form-control" name="position-position" id="position-position">
                <option>Chức vụ</option>
                @foreach($pos_list as $pos)
                <option value="{{$pos->id}}">{{$pos->position}}</option>
                @endforeach
              </select>
            </div>

            <label class="col-md-2">Phòng ban</label>
            <div class="col-md-4">
              <select class="form-control" name="position-department" id="position-department">
                <option>Phòng ban</option>
                @foreach($dep_list as $dep)
                <option value="{{$dep->id}}">{{$dep->department}}</option>
                @endforeach
              </select>
            </div>

          </div>


          <div class="form-group">
            <label class="col-md-2">Số Quyết định</label>
            <div class="col-md-4">
              <input class="form-control" type="text"  name="position-decided_number" id="position-decided_number">
            </div>
            <label class="col-md-2">Trạng thái</label>
            <div class='col-sm-4'>
              <select class="form-control" name="position-status" id="position-status">
                <option value="1">Chính thức</option>
                <option value="0">Kiêm nhiệm</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ngày bắt đầu</label>
            <div class='col-sm-4'>
              <div class='input-group date' id="AddBeginPositionDatepicker">
                <input type='text' class="form-control"  placeholder="dd-mm-yyyy" name="position-date_begin" id="position-date_begin" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <label class="col-md-2">Ngày kết thúc</label>
            <div class='col-sm-4'>
              <div class='input-group date' id="AddFinishPositionDatepicker">
                <input type='text' class="form-control"  placeholder="dd-mm-yyyy" name="position-date_finish" id="position-date_finish" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ghi chú</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="3" name="position-note" id="position-note"></textarea>
            </div>
          </div>

          <hr>
          <!-- Chức vụ mới -->
          <h3 class="col-md-12 blue text-center">Chức vụ mới</h3>
          <br>
          <div class="form-group">
            <label class="col-md-2" >Chức vụ mới</label>
            <div class="col-md-4">
              <select class="form-control" name="new_position" id="new_position">
                <option>Chức vụ</option>
                @foreach($pos_list as $pos)
                <option value="{{$pos->id}}">{{$pos->position}}</option>
                @endforeach
              </select>
            </div>

            <label class="col-md-2">Phòng ban mới</label>
            <div class="col-md-4">
              <select class="form-control" name="new_department" id="new_department">
                <option>Phòng ban</option>
                @foreach($dep_list as $dep)
                <option value="{{$dep->id}}">{{$dep->department}}</option>
                @endforeach
              </select>
            </div>

          </div>


          <div class="form-group">
            <label class="col-md-2">Số Quyết định</label>
            <div class="col-md-4">
              <input class="form-control" type="text"  name="new_decided_number" id="new_decided_number">
            </div>
            <label class="col-md-2">Trạng thái</label>
            <div class='col-sm-4'>
              <select class="form-control" name="new_status" id="new_status">
                <option value="1">Chính thức</option>
                <option value="0">Kiêm nhiệm</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ngày bắt đầu</label>
            <div class='col-sm-4'>
              <div class='input-group date' id="AddNewBeginPositionDatepicker">
                <input type='text' class="form-control"  placeholder="dd-mm-yyyy" name="new_date_begin" id="new_date_begin" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <label class="col-md-2">Ngày kết thúc</label>
            <div class='col-sm-4'>
              <div class='input-group date' id="AddNewFinishPositionDatepicker">
                <input type='text' class="form-control"  placeholder="dd-mm-yyyy" name="new_date_finish" id="new_date_finish" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ghi chú</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="3" name="note" id="new_note"></textarea>
            </div>
          </div>

          <hr>
          <div class="pull-right">
            <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
            <!-- <button type="reset" class="btn btn-success" > Reset</button> -->
            <button class="btn btn-success" id="btn-save-position" value="add">Lưu</button>
            <input type="hidden" name="position-id" id="position-id" value="0">
          </div>

        </form> 
      </div>
    </div>
  </div>

</div>
<!-- /Modal add position -->


<!-- Modal view position -->
<div id="modalViewPosition" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><b>Thông tin chức vụ</b></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left"  id="formViewPosition">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="pos-name_emp" id="pos-name_emp">
            </div>

            <label class="col-md-2">Mã nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="pos-id_emp" id="pos-id_emp">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Chức vụ</label>
            <div class="col-md-4">
              <select class="form-control" name="pos-position" id="pos-position">
                <option>Chức vụ</option>
                @foreach($pos_list as $pos)
                <option value="{{$pos->id}}">{{$pos->position}}</option>
                @endforeach
              </select>
            </div>

            <label class="col-md-2">Phòng ban</label>
            <div class="col-md-4">
              <select class="form-control" name="pos-department" id="pos-department">
                <option>Phòng ban</option>
                @foreach($dep_list as $dep)
                <option value="{{$dep->id}}">{{$dep->department}}</option>
                @endforeach
              </select>
            </div>

          </div>


          <div class="form-group">
            <label class="col-md-2">Số Quyết định</label>
            <div class="col-md-4">
              <input class="form-control" type="text"  name="pos-decided_number" id="pos-decided_number">
            </div>
            <label class="col-md-2">Trạng thái</label>
            <div class='col-sm-4'>
              <select class="form-control" name="pos-status" id="pos-status">
                <option value="1">Chính thức</option>
                <option value="0">Kiêm nhiệm</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ngày bắt đầu</label>
            <div class='col-sm-4'>
              <div class='input-group date' id="ViewBeginPositionDatepicker">
                <input type='text' class="form-control"  placeholder="dd-mm-yyyy" name="pos-date_begin" id="pos-date_begin" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <label class="col-md-2">Ngày kết thúc</label>
            <div class='col-sm-4'>
              <div class='input-group date' id="ViewFinishPositionDatepicker">
                <input type='text' class="form-control"  placeholder="dd-mm-yyyy" name="pos-date_finish" id="pos-date_finish" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ghi chú</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="3" name="pos-note" id="pos-note"></textarea>
            </div>
          </div>

          <hr>
          <div class="col-md-5 col-md-offset-8">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="reset" class="btn btn-success" > Reset</button>
            <button class="btn btn-primary" id="btn-update-position" value="update">Edit</button>

            <input type="hidden" name="pos-id" id="pos-id" value="0">
          </div>

        </form> 
      </div>
    </div>
  </div>

</div>
<!-- /Modal view position -->

<!-- Modal notify -->
<div id="modalNotifyPosition" class="modal fade" role="diolog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title red">Chú ý</h3>
      </div>
      <div class="modal-body">
        <p class="red">Chức vụ chính thức chưa kết thúc!!!</p>
        Kết thúc chức vụ chính thức cũ trước khi tạo chức vụ chính thức mới. (Hoặc chuyển chức vụ chính thức sang chức vụ kiêm nhiệm)
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
     </div>
   </div>
 </div>

</div>

<!-- /Modal notify -->


