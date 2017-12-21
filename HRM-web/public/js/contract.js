$(document).ready(function (){
  // var table = $('#table').DataTable({
  //   responsive: true,
  //   orderCellsTop: true
  // });

  var base_url = "/laravel/HRMProject/public/hrm/contract/";

  var table = $('#table').DataTable({
    "scrollX": true,
    orderCellsTop: true
  });

  $('#table thead').on( 'click', '.form-control', function (e) {   // for text boxes
    e.stopPropagation();
  });

  $('#table thead').on( 'keyup change', '.form-control', function (e) {   // for text boxes
    var i = $(this).attr('data-column');  // getting column index
    console.log(i);
    var v = $(this).val();  // getting search input value
    var table = $('#table').DataTable();
    table.column(i).search(v).draw();
  });


  $('tr').on('dblclick', function() {
    // $('#modalContract').modal('show');
    var data = table.row( this ).data();
    var contract_number = data[0];

    $('#contract-content').show();
    $('#contract-content_file').show();
    $('#btn-delete-contract').show();

    $.get(base_url + 'detail_number/' + contract_number, function(data){
      console.log(data);
      $('#contract-name_emp').val(data.contract.emp_profile.name);
      $('#contract-id_emp').val(data.id_emp);
      $('#contract-id').val(data.contract.id);
      $('#contract-number').val(data.contract.contract_number);
      $('#contract-number').val(data.contract.contract_number);
      $('#contract-decided_number').val(data.contract.decided_number);
      $('#contract-type').val(data.contract.id_contract_type);
      $('#contract-duration').val(data.contract.duration);
      $('#contract-original_number').val(data.contract.contract_original_number);
      $('#contract-classify').val(data.contract.classify);
      $('#contract-delegate').val(data.contract.delegate);
      $('#contract-date_signed').val(data.contract.date_signed);
      $('#contract-date_begin').val(data.contract.date_begin);
      $('#contract-date_finish').val(data.contract.date_finish);
      $('#contract-salary').val(data.contract.salary);
      $('#contract-note').val(data.contract.note);

      $('#btn-delete-contract').val(data.contract.id);
      $('#btn-save-contract').val('update');
      $('#btn-save-contract').text('Edit');

      $('#modalContract').modal('show');
    });


  });

  $('.btn-edit-contract').click(function(){
    var id_contract = $(this).val();

    $('#contract-content').show();
    $('#contract-content_file').show();
    $('#btn-delete-contract').show();

    $.get(base_url + 'detail/' + id_contract, function(data){
      console.log(data);

      $('#contract-name_emp').val(data.contract.emp_profile.name);
      $('#contract-id_emp').val(data.id_emp);
      $('#contract-id').val(data.contract.id);
      $('#contract-number').val(data.contract.contract_number);
      $('#contract-number').val(data.contract.contract_number);
      $('#contract-decided_number').val(data.contract.decided_number);
      $('#contract-type').val(data.contract.id_contract_type);
      $('#contract-duration').val(data.contract.duration);
      $('#contract-original_number').val(data.contract.contract_original_number);
      $('#contract-classify').val(data.contract.classify);
      $('#contract-delegate').val(data.contract.delegate);
      $('#contract-date_signed').val(data.contract.date_signed);
      $('#contract-date_begin').val(data.contract.date_begin);
      $('#contract-date_finish').val(data.contract.date_finish);
      $('#contract-salary').val(data.contract.salary);
      $('#contract-note').val(data.contract.note);

      $('#btn-delete-contract').val(data.contract.id);
      $('#btn-save-contract').val('update');
      $('#btn-save-contract').text('Edit');

      $('#modalContract').modal('show');
    });
    
  });


  $('#btn-add-contract').click(function(){
    $('#contract-content_file').hide();
    $('#btn-delete-contract').hide();

    $('#formContract').trigger("reset");
    $('#btn-save-contract').val("add");

    $('#modalContract').modal('show');

  });


  $('#btn-save-contract').click(function(e){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    });

    e.preventDefault();

    var formData = {
      id_emp: $('#contract-id_emp').val(),
      contract_number: $('#contract-number').val(),
      decided_number: $('#contract-decided_number').val(),
      id_contract_type: $('#contract-type').val(),
      duration: $('#contract-duration').val(),
      original_contract_number: $('#contract-original_number').val(),
      classify: $('#contract-classify').val(),
      delegate: $('#contract-delegate').val(),
      date_signed: $('#contract-date_signed').val(),
      date_begin: $('#contract-date_begin').val(),
      date_finish: $('#contract-date_finish').val(),
      salary: $('#contract-salary').val(),
      content: $('#contract-content').val(),
      note: $('#contract-note').val(),
    }

    console.log(formData);

    var state = $('#btn-save-contract').val();

    var type = "POST";
    var id_contract = $('#contract-id').val();
    var active_url = base_url;

    if(state == 'update'){
      type = "PUT"; 
      active_url += 'edit/' + id_contract;
    }

    if(state == 'add'){
      active_url += 'add';
    }

    console.log(active_url);

    $.ajax({
      type: type,
      url: active_url,
      data: formData, 
      dataType: 'json',
      success: function(data){
        console.log(data);

        var classify = '';

        if(data.classify == '1'){
          classify = "Hợp đồng";
        }else{
          classify = "Phụ lục";
        }

        // var contract ='<tr id="contract' + data.id + '"> <td class="blue">' + data.contract_number + '</td> <td>' + data.decided_number + '</td> <td>' + classify + '</td> <td>' + data.contract_type.type+ '</td> <td>' + data.duration +'</td> <td>' + data.date_begin + '</td> <td> <span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin chi tiết"> <button class="btn btn-info btn-xs btn-detail-contract" value="' + data.id + '"><i class="fa fa-info-circle"></i></button></span> <span class="docs-tooltip" data-toggle="tooltip" title="Xóa"> <button class="btn btn-danger btn-xs btn-delete-contract" value="' + data.id + '"><i class="fa fa-trash-o"></i></button> </span></td></tr>';


        // if(state == "add"){
        //   $('#contract-list').append(contract);

        //   $('#contract-notify').append('<div class="alert alert-success">Tạo mới thành công </div>');
        // }else{
        //   $('#contract' + id_contract).replaceWith(contract);
        //   $('#contract-notify').append('<div class="alert alert-success">Cập nhật thành công </div>');
        //   // $('#relatives' + id_relatives).append(' <a class="fa fa-file-pdf-o" href="" id="contract-content_link" name="contract-content_link" type="hidden"></a>');
        // }

        $('#formContract').trigger("reset");
        $('#modalContract').modal('hide');


      },

      error: function(data){
        console.log('Error: ', data);
      },
    });

  });


  $('.btn-delete-contract').click(function(){
    var id_contract = $(this).val();
    $('#btn-confirm-delete').val(id_contract);
    $('#delete-type').val('contract');
    $('#delete-message').text("Bạn muốn xóa hợp đồng này? " + id_contract);
    $('#modalConfirmDelete').modal('show');
  });

  $('#btn-confirm-delete').click(function(){
    var id = $(this).val();
    var delete_type = $('#delete-type').val();
    console.log(id);
    console.log(delete_type);
    var active_url = base_url + 'delete/' + id;

    console.log(active_url);

    $.ajax({
      type: "GET",
      url: active_url,
      success: function(data){
        console.log(data);
        
        
        // $('#'+delete_type + id).remove();
        

        $('#modalConfirmDelete').modal('hide');
        $('#modalContract').modal('hide');
        $('#contract-notify').append('<div class="alert alert-success">Xóa thành công </div>');
      },
      error: function(data){
        console.log('Error: ', data);
      },
    });


  });
});