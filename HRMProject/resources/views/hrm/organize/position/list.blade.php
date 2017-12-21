@extends('hrm.layout.index')

@section('link')
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

<!-- bootstrap-daterangepicker -->
<link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
<!-- bootstrap-datetimepicker -->
<link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
@endsection 

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Danh sách chức vụ</h3>
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
    @include('hrm.layout.notify')
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x-title">

          </div>
          <div class="x_content">
            <div class="">
              <div class="btn-group">

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalAddPosition"> 
                  <span class="docs-tooltip" data-toggle="tooltip" title="Tạo mới">
                    <span class="fa fa-plus"></span>
                  </span>
                </button>

                <button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
                  <span class="docs-tooltip" data-toggle="tooltip" title="In">
                    <span class="fa fa-print"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Xuất">
                    <span class="fa fa-file-pdf-o"></span>
                  </span>
                </button>



              </div>
            </div>
            <br>

            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Chức vụ</th>
                  <th>Ngày lập</th>
                  <th>Quyết định</th>
                  <th class="col-sm-4 col-md-4">Mô tả</th>
                  <th>Chi tiết</th>
                </tr>
              </thead>

              <tbody>
                @foreach($pos_list as $pos)
                <tr>
                  <td>{{$pos->id}}</td>
                  <td>{{$pos->position}}</td>
                  <td>{{$pos->date_established}}</td>
                  <td>{{$pos->decided_established}}</td>
                  <td class="col-sm-4 col-md-4">{{$pos->description}}</td>
                  <td class="center">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Sửa thông tin chức vụ">
                      <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalEditPosition" data-id="{{$pos->id}}" data-position="{{$pos->position}}" data-date="{{$pos->date_established}}" data-decided="{{$pos->decided_established}}" data-description="{{$pos->description}}"><i class="fa fa-edit"></i> Edit </button>
                    </span>
                    <span class="docs-tooltip" data-toggle="tooltip" title="Xóa chức vụ">
                      <a href="" data-href="hrm/organize/pos_delete/{{$pos->id}}" data-position="{{$pos->position}}" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i> Delete </a>
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

<!-- Modal create position -->
<div id="modalAddPosition" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Tạo chức vụ</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" action="hrm/organize/pos_add" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Mã chức vụ</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="id">
            </div>

            <label class="col-md-2">Chức vụ *</label>
            <div class="col-md-4">
              <input class="form-control" required="" type="text"  name="position">
            </div>

          </div>

          <div class="form-group">
            <label class="col-md-2" >Ngày thành lập*</label>
            <div class="col-md-4">
             <div class='input-group date' id="EstablishedDatepicker">
              <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_established" required="" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span></span>
              </div>
            </div>

            <label class="col-md-2"> Số quyết định*</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="decided_established" required="">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Mô tả</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="3" name="description"></textarea>
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
<!-- /Modal create position -->

<!-- Modal edit position -->
<div id="modalEditPosition" class="modal fade" role="diolog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Sửa thông tin chức vụ</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal form-label-left" action="hrm/organize/pos_edit" method="POST">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group">
            <label class="col-md-2" >Mã chức vụ</label>
            <div class="col-md-4">
              <input class="form-control" readonly="readonly" type="text"  name="id" id="id">
            </div>

            <label class="col-md-2">Chức vụ *</label>
            <div class="col-md-4">
              <input class="form-control" required="" type="text"  name="position" id="position">
            </div>

          </div>

          <div class="form-group">
            <label class="col-md-2" >Ngày thành lập*</label>
            <div class="col-md-4">
             <div class='input-group date' id="EstablishedDatepicker">
              <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_established" required="" id="date_established" />
              <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span></span>
              </div>
            </div>

            <label class="col-md-2"> Số quyết định*</label>
            <div class="col-md-4">
              <input class="form-control"  type="text"  name="decided_established" required="" id="decided_established">
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2">Mô tả</label>
            <div class="col-md-10">
              <textarea class="form-control" rows="3" name="description" id="description"></textarea>
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

</div>
<!-- /Modal edit position -->

<!-- Modal confirm delete -->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Xác nhận xóa</h4>
      </div>
      <div class="modal-body">
        <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a class="btn btn-danger btn-ok" >Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- /Modal confirm delete-->



<!-- /page content -->
@endsection


@section('script')
<!-- <script type="text/javascript">

  $(document).ready(function(){


    var table = $('#datatable').DataTable();
    $('#datatable').on( 'click', 'tr', function () {
      var id = table.row( this ).id();

      alert( 'Clicked row id '+id);
    });



 // $('#example').on( 'click', 'tr', function () {
 //    var id = table.row( this ).id();
 //    alert( 'Clicked row id ' + id );
 //  });
});
</script> -->

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

<!-- bootstrap-daterangepicker -->
<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-datetimepicker -->    
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>

<script>
  $('#EstablishedDatepicker').datetimepicker({
    format: 'YYYY-MM-DD'
  });
</script>

<!-- modal for edit position -->
<script type="text/javascript">
  $('#modalEditPosition').on('show.bs.modal', function(event){
    var button = $(event.relatedTarget)
    var id = button.data('id')
    var position = button.data('position')
    var date_established = button.data('date')
    var decided_established = button.data('decided')
    var description = button.data('description')

    var modal = $(this)
    modal.find('.modal-body input[name="id"]').val(id)
    modal.find('.modal-body input[name="position"]').val(position)
    modal.find('.modal-body input[name="date_established"]').val(date_established)
    modal.find('.modal-body input[name="decided_established"]').val(decided_established)
    modal.find('.modal-body textarea[name="description"]').val(description)

  });

  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    $('.debug-url').html('Bạn muốn xóa chức vụ <strong>' + $(e.relatedTarget).data('position') + '</strong>' + '?');
  });
</script>

@endsection