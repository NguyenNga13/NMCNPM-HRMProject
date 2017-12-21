@extends('admin.layout.index')

@section('link')
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<!-- ajax -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<meta name="_token" content="{{csrf_token()}}" />
@endsection 

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Quản lý phân quyền</h3>
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

    <div id="permission-notify"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <p>

              <div class="btn-group">
                <button type="button" class="btn btn-default btn-lg" title="Tạo mới" id="btn-add-permission"> 
                  <span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
                    <span class="fa fa-plus"></span>
                  </span>
                  Tạo
                </button>
                <button type="button" class="btn btn-default btn-lg" id="btn-delete-group" title="Xóa">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
                    <span class="fa fa-minus"></span>
                  </span>
                  Xóa
                </button>
                <button type="button" class="btn btn-default btn-lg" title="Xuất file">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Xuất file">
                    <span class="fa fa-file-pdf-o"></span>
                  </span>
                  Xuất
                </button>
              </div>
            </p>

            <table id="datatable" class="table table-striped table-bordered table-permission">
              <thead>
                <tr>
                  <th><input type="checkbox" id="check-all" ></th>
                  <th>ID</th>
                  <th>Quyền</th>
                  <th>Mô tả</th>
                  <th>Ngày tạo</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                @foreach($permission as $permission)
                <tr id="permission{{$permission->id}}" class="permission">
                  <td>
                    <input type="checkbox" name="permission-data" value="{{$permission->id}}">
                  </td>
                  <td>{{$permission->id}}</td>
                  <td>{{$permission->permission}}</td>
                  <td>{{$permission->description}}</td>
                  <td>{{$permission->created_at}}</td>
                  <td>
                    <span class="docs-tooltip" data-toggle="tooltip" title="Sửa">
                      <button class="btn btn-success btn-xs btn-edit-permission" value="{{$permission->id}}" id="btn-edit-permission"><i class="fa fa-edit"></i>
                      </button>
                    </span>
                    <span class="docs-tooltip" data-toggle="tooltip" title="Xóa">
                      <button class="btn btn-danger btn-xs btn-delete-permission" id="btn-delete-permission" value="{{$permission->id}}" ><i class="fa fa-trash-o"></i></button>
                    </span>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- modal permission -->
<div class="modal fade" id="modal-permission" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> <b id="permission-title"></b></h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" id="form-permission">
          <div class="form-group">
            <label for="name"><p>Quyền</p></label>:
            <input type="text" name="permission" class="form-control" id="permission">
            <div id="errorUserName">
            </div>
          </div>
          <div class="form-group">
            <label for="description">Mô tả chi tiết</label>:
            <textarea value="" name="description" class="form-control"  row="5" id="description"></textarea>
            <div id="errorUserDescription">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Thoát</button>
        <button type="button" class="btn btn-info" value="add" id="btn-save-permission">Lưu</button>
        <span class="pull-right">
          <button type="button" class="btn btn-danger" id="btn-delete" value="">
            Xóa
          </button>
        </span>
        <input type="hidden" name="id_permission" value="0" id="id_permission">
      </div>

    </div>
  </div>
</div>
<!-- /modal permission -->


<!-- modal confirm delete -->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title red"> Xác nhận xóa</h3>
      </div>
      <div class="modal-body">
        <!--         <p>Bạn muốn xóa mục này?</p> -->
        <p id="delete-message"></p>
        <input type="hidden" name="delete-type" id="delete-type">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button class="btn btn-danger btn-confirm-delete" id="btn-confirm-delete">Xóa</button> 
      </div>
    </div>
  </div>
</div>
<!-- /modal confirm delete -->

@endsection


@section('script')

<!-- Datatables -->
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>


<script type="text/javascript" src="{{ asset('/js/admin/permission.js') }}"></script>

@endsection