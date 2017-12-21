@extends('hrm.layout.index')

@section('link')
<!-- css-datatables -->
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
        <h3>Phòng ban</h3>
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
          <div class="x_title">
            <h2>Thông tin <small>Phòng ban</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">


            <form class="form-horizontal form-label-left" action="hrm/emp/emp_add" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{csrf_token()}}">


              <div class="form-group">
                <label class="col-md-2" >Mã phòng ban</label>
                <div class="col-md-4">
                  <input class="form-control" readonly="readonly" type="text"  name="id">
                </div>

                <label class="col-md-2">Phòng ban *</label>
                <div class="col-md-4">
                  <input class="form-control" required="" type="text"  name="department">
                </div>

              </div>

              <div class="form-group">
                <label class="col-md-2" >Ngày thành lập</label>
                <div class="col-md-4">
                   <div class='input-group date' id="EstablishedDatepicker">
                    <input type='text' class="form-control" placeholder="YYYY-MM-DD" name="date_establish" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>

                <label class="col-md-2"> Vị trí</label>
                <div class="col-md-4">
                  <input class="form-control"  type="text"  name="location">
                </div>

              </div>
              <div class="form-group">
                <label class="col-md-2" >Điện thoại</label>
                <div class="col-md-4">
                  <input class="form-control"  type="text"  name="telephone">
                </div>

                <label class="col-md-2"> Fax</label>
                <div class="col-md-4">
                  <input class="form-control"  type="text"  name="fax">
                </div>

              </div>

              <div class="form-group">
                <label class="col-md-2">Ghi chú</label>
                <div class="col-md-10">
                  <textarea class="form-control" rows="3" name="note"></textarea>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-8">
                  <button type="button" class="btn btn-primary">Cancel</button>
                  <button type="reset" class="btn btn-primary">Reset</button>
                  <button type="submit" class="btn btn-success">Submit</button>
                </div>
              </div>

            </form>
          </div>
        </div>
      </div>

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Danh sách nhân viên <small>Phòng ban</small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              <li><a class="close-link"><i class="fa fa-close"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="">
              <div class="btn-group">

                <a href="hrm/emp/emp_add" type="button" class="btn btn-default"> 
                  <span class="docs-tooltip" data-toggle="tooltip" title="Thêm nhân viên mới">
                    <span class="fa fa-plus"></span>
                  </span>
                </a>

                <button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
                  <span class="docs-tooltip" data-toggle="tooltip" title="In danh sách nhân viên">
                    <span class="fa fa-print"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-default" data-method="setDragMode" data-option="crop">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Xuất danh sách nhân viên">
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
                  <th>Phòng ban</th>
                  <th>Ngày thành lập</th>
                  <th>Trưởng phòng</th>
                  <th>Vị trí</th>
                  <th>Chi tiết</th>
                </tr>
              </thead>

              <tbody>
                @for ($i = 0; $i < 10; $i++)
                <tr>
                  <td>$dep->id}}</td>
                  <td>$dep->department}}</td>
                  <td>$dep->date_established}}</td>
                  <td>$dep->description}}</td>
                  <td>$dep->location}}</td>
                  <td class="center">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Xem hồ sơ nhân viên">
                      <a href="" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                    </span>
                    <span class="docs-tooltip" data-toggle="tooltip" title="Xóa hồ sơ nhân viên">
                      <a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                    </span>

                  </td>
                </tr>
                @endfor
              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>


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

@endsection