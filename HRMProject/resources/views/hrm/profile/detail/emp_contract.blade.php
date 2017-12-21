<div class="x_content">
  <div class="clearfix"></div>

  <div id="contract-notify"></div>
  <div class="">
    <div class="btn-group">
      <button type="button" class="btn btn-default" data-toggle="modal" 
      data-target="#favoritesModal"> 
      <span class="docs-tooltip" data-toggle="tooltip" title="Tìm kiếm">
        <span class="fa fa-search"></span>
      </span></button>
      <button type="button" class="btn btn-default" id="btn-add-contract" value="{{$emp->id}}"> 
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

  <table class="data table table-striped no-margin" id="table-contract">
    <thead>
      <tr>
        <th>Số hợp đồng</th>
        <th>Quyết định</th>
        <th>Mục</th>
        <th>Loại</th>
        <th>Thời hạn</th>
        <th>Ngày hiệu lực</th>
       
        <th>Chi tiết</th>
      </tr>
    </thead>
    <tbody id="contract-list">
      @foreach($emp->emp_labor_contract as $contract)
      <tr id="contract{{$contract->id}}">
        <td class="blue">{{$contract->contract_number}}</td>
        <td>{{$contract->decided_number}}</td>
        <?php
        $classify = "";
        if($contract->classify == '1')
          $classify = "Hợp đồng";
        else
          $classify = "Phụ lục";
        ?>
        <td>{{$classify}}</td>
        <td>{{$contract->contract_type->type}}</td>
        <td>{{$contract->duration}}</td>
        <td>{{$contract->date_begin}}</td>
        <td>
          <span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin chi tiết">

            <button class="btn btn-info btn-xs btn-detail-contract" value="{{$contract->id}}"><i class="fa fa-info-circle"></i></button>
          </span>
          <span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
            <button class="btn btn-danger btn-xs btn-delete-contract" value="{{$contract->id}}"><i class="fa fa-trash"></i></button>
          </span>
        </td>
      </tr>
      @endforeach

    </tbody>
  </table>
</div>

<!-- Modal contract labor -->
<div id="modalContract" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> <b>Hợp đồng</b></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left"  id="formContract" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="contract-name_emp" id="contract-name_emp">
            </div>

            <label class="col-md-2">Mã nhân viên</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="contract-id_emp" id="contract-id_emp">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Số hợp đồng *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="contract-number" required="" id="contract-number">
            </div>

            <label class="col-md-2" >Số quyết định *</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="contract-decided_number" required="" id="contract-decided_number">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Loại hợp đồng</label>
            <div class="col-md-4">
              <select class="form-control" id="contract-type" name="contract-type">
                @foreach($contract_type as $type)
                <option value="{{$type->id}}">{{$type->type}}</option>
                @endforeach
              </select>
            </div>

            <label class="col-md-2" >Thời gian (tháng)</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="contract-duration" id="contract-duration">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Số hợp đồng gốc</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="contract-original_number" required="" id="contract-original_number">
            </div>

            <label class="col-md-2" >Phân loại</label>
            <div class="col-md-4">
              <select class="form-control" id="contract-classify" name="contract-classify">
                <option value="1">Hợp đồng</option>
                <option value="0">Phụ lục</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Đại diện</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="contract-delegate" id="contract-delegate">
            </div>
            <label class="col-md-2">Ngày ký</label>
            <div class="col-md-4">
              <div class='input-group date' id="ContractDateSignedDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="contract-date_signed" id="contract-date_signed" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ngày hiệu lực</label>
            <div class="col-md-4">
              <div class='input-group date' id="ContractDateBeginDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="contract-date_begin" id="contract-date_begin" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <label class="col-md-2">Ngày hết hạn</label>
            <div class="col-md-4">
              <div class='input-group date' id="ContractDateFinishDatepicker">
                <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="contract-date_finish" id="contract-date_finish" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2" >Mức lương</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="contract-salary" required="" id="contract-salary">
            </div>

            <label class="col-md-2" >Văn bản</label>
            <div class=" form-group col-md-4" id="content">
              <a class="col-md-2 blue" href="" id="contract-content_file" name="contract-content_file" type="hidden"> <span class="docs-tooltip" data-toggle="tooltip" title="Xem văn bản hợp đồng"><i class="fa fa-file-pdf-o"></i></span></a>
              <input class="col-md-10" type="file" name="contract-content" id="contract-content">
             
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Ghi chú</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="3" name="contract-note"></textarea>
            </div>
          </div>

          <hr>
          <div class="col-md-5 col-md-offset-8">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger btn-delete-contract" id="btn-delete-contract" value="">Delete</button>
            <button type="reset" class="btn btn-success" > Reset</button>
            <button type="button" class="btn btn-primary" id="btn-save-contract" value="add">Save</button>
            <input type="hidden" name="contract-id" id="contract-id" value="0">
          </div>

        </form> 
      </div>
    </div>
  </div>

</div>
<!-- /Modal contract labor -->