@extends('hrm.layout.index')

@section('link')
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endsection 

@section('content')

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Danh sách nhân viên</h3>
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
    <div id="emp-notify"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="">
              <div class="btn-group">

                <a href="hrm/emp/add" type="button" class="btn btn-app" title="Tạo hồ sơ nhân viên"> 
                  <span class="fa fa-plus"></span> Tạo
                </a>
                <button type="button" class="btn btn-app" id="btn-view">
                  <span class="fa fa-info-circle"></span> Xem
                </button>
                <button type="button" class="btn btn-app" >
                  <span class="fa fa-minus"></span> Xóa
                </button>
                 <button type="button" class="btn btn-app" >
                  <span class="fa fa-file-pdf-o"></span> pdf
                </button>
                <button type="button" class="btn btn-app" >
                  <span class="fa fa-file-excel-o"></span> excel
                </button>
                 <button type="button" class="btn btn-app" >
                  <span class="fa fa-print"></span> In
                </button>



              </div>
            </div>
            <br>

            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th><input type="checkbox" name="check-all" id="check-all"></th>
                  <th>Mã</th>
                  <th>Họ tên</th>
                  <th>Chức vụ</th>
                  <th>Phòng ban</th>
                  <th>SĐT</th>
                  <th>Email</th>
                  <th>Chi tiết</th>
                </tr>
              </thead>

              <tbody id="emp-list-body">
                @foreach($emp_list as $emp)
                <tr id = '{{$emp->id}}'>
                  <td><input type="checkbox" name="checked" value="{{$emp->id}}"></td>
                  <td class="blue">{{convertIdEmp($emp->id)}}</td>
                  <td>{{$emp->name}}</td>
                  <td>{{$emp->position}}</td>
                  <td>{{$emp->department}}</td>
                  <td>{{$emp->phone}}</td>
                  <td>{{$emp->email}}</td>
                  <td class="center">
                    <span class="docs-tooltip" data-toggle="tooltip" title="Xem hồ sơ nhân viên">
                      <a href="hrm/emp/detail/{{$emp->id}}" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i></a>
                    </span>
                  <!--   <span class="docs-tooltip" data-toggle="tooltip" title="Sửa hồ sơ nhân viên">
                      <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                    </span> -->
                    <span class="docs-tooltip" data-toggle="tooltip" title="Xóa hồ sơ nhân viên">
                      <a href="../delete/{{$emp->id}}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
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


<script type="text/javascript">
  $(document).ready(function(){
    $('#check-all').change(function(){
      $('#emp-list-body input:checkbox').not(this).prop('checked', this.checked);
    });
  });


  $('#btn-view').click(function(){
    var checked = getChecked();
    if(checked.length == 0){
      $('#emp-notify').html('<div class="alert alert-danger">Không có mục nào được chọn!</div>');
    }else if(checked.length > 1){
      $('#emp-notify').html('<div class="alert alert-danger">Nhiều hơn 1 mục được chọn!</div>');
    }else{
       $('#emp-notify').html('');
      window.location.href = 'hrm/emp/detail/' +checked[0];
    }
  });

  function getChecked()
  {
    var checked = [];
    $('#emp-list-body input:checked').each(function(){
      check = $(this).val();
      checked.push(check);
    });
    return checked;
  }
</script>

@endsection