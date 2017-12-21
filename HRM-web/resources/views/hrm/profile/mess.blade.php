<script type="text/javascript">

  // $('#modalAddRelatives').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var name_emp = content.data('name_emp')

  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  // });


  // $('#modalViewRelatives').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var id = content.data('id')
  //   var name_emp = content.data('name_emp')
  //   var name = content.data('name')
  //   var birth = content.data('date_of_birth')
  //   var relationship = content.data('relationship')
  //   var career = content.data('career')
  //   var workplace = content.data('workplace')
  //   var phone = content.data('phone')
  //   var address = content.data('address')
  //   var address_district = content.data('address_district')
  //   var address_province = content.data('address_province')


  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  //   $(this).find('.modal-body input[name = "id"]').val(id)
  //   $(this).find('.modal-body input[name = "name"]').val(name)
  //   $(this).find('.modal-body input[name = "relationship"]').val(relationship)
  //   $(this).find('.modal-body input[name = "date_of_birth"]').val(birth)
  //   $(this).find('.modal-body input[name = "career"]').val(career)
  //   $(this).find('.modal-body input[name = "workplace"]').val(workplace)
  //   $(this).find('.modal-body input[name = "phone"]').val(phone)
  //   $(this).find('.modal-body input[name = "address"]').val(address)
  //   $(this).find('.modal-body select[name = "address_district"]').val(address_district)
  //   $(this).find('.modal-body select[name = "address_province"]').val(address_province)

  // });

  // $('#modalAddSpecialized').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var name_emp = content.data('name_emp')

  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  // });


  // $('#modalViewSpecialized').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var name_emp = content.data('name_emp')
  //   var id = content.data('id')
  //   var specialized = content.data('specialized')
  //   var issued_by = content.data('issued_by')
  //   var degree = content.data('degree')
  //   var level = content.data('level')
  //   var training_type = content.data('training_type')
  //   var date_of_issued = content.data('date')
  //   var begin = content.data('begin')
  //   var finish = content.data('finish')
  //   var note = content.data('note') 

  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  //   $(this).find('.modal-body input[name = "id"]').val(id)
  //   $(this).find('.modal-body input[name = "specialized"]').val(specialized)
  //   $(this).find('.modal-body input[name = "issued_by"]').val(issued_by)
  //   $(this).find('.modal-body select[name = "degree"]').val(degree)
  //   $(this).find('.modal-body select[name = "level"]').val(level)
  //   $(this).find('.modal-body select[name = "training_type"]').val(training_type)
  //   $(this).find('.modal-body input[name = "date_of_issued"]').val(date_of_issued)
  //   $(this).find('.modal-body input[name = "begin"]').val(begin)
  //   $(this).find('.modal-body input[name = "finish"]').val(finish)
  //   $(this).find('.modal-body textarea[name = "note"]').val(note)
  // });

  // $('#modalAddLanguage').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var name_emp = content.data('name_emp')

  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  // });


  // $('#modalViewLanguage').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var name_emp = content.data('name_emp')

  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  // });

  // $('#modalAddPosition').on('show.bs.modal', function(event){
  //   var content = $(event.relatedTarget)

  //   var id_emp = content.data('id_emp')
  //   var name_emp = content.data('name_emp')

  //   $(this).find('.modal-body input[name = "name_emp"]').val(name_emp)
  //   $(this).find('.modal-body input[name = "id_emp"]').val(id_emp)
  // });

  // /*ajax add position*/
  // $('#formAddPosition').on('submit', function(e){
  //   $.ajaxSetup({
  //     headers: {
  //       'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
  //     }
  //   })

  //   e.preventDefault();
  //   var form = $('#formAddPosition');
  //   var formData = form.serialize();
  //   var url = form.attr('action');
  //   $.ajax({
  //     type: 'POST',
  //     url: url,
  //     data: formData,
  //     success:function(data){
  //       console.log(data);
  //     }

  //   });
  // })

</script>

<script type="text/javascript">
//   $(document).ready(function(){
//     var url = "/laravel/HRMProject/public/hrm/emp/degree/";

//     /*---------------------------------- FOR LANGUAGE----------------------------------------*/
//     // display modal view language
//     $('.open-modal-language').click (function(){
//       var id_language = $(this).val();

//       $.get(url + 'language/detail/' + id_language, function(data){
//         // success data
//         console.log(data);

//         $('#name_emp_language').val(data.language.emp_profile.name);
//         $('#id_emp_language').val(data.id_emp);
//         $('#id_language').val(data.language.id);
//         $('#language').val(data.language.language);
//         $('#certificate_type').val(data.language.certificate_type);
//         $('#level').val(data.language.level);
//         $('#issued_by').val(data.language.issued_by);
//         $('#date_of_issued').val(data.language.date_of_issued);
//         $('#expire').val(data.language.expire);
//         $('#note').val(data.language.note);

//         $('#btn-save-language').val('update');
//         $('#modalLanguage').modal('show');
//       });
//     });


//     //display modal add language
//     $('#btn-add-language').click(function(){
//       var id_emp = $(this).val();

//       $.get(url + 'add/' + id_emp, function(data){
//         console.log(data);

//         $('#formLanguage').trigger("reset");
//         $('#btn-save-language').val("add");

//         $('#name_emp_language').val(data.name_emp);
//         $('#id_emp_language').val(data.id_emp);

//         $('#modalLanguage').modal('show');
//       });
//     });

//     //create new/update language
//     $('#btn-save-language').click(function(e){
//       $.ajaxSetup({
//         headers: {
//           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//         }
//       })

//       e.preventDefault();

//       var formData = {
//         id_emp: $('#id_emp_language').val(),
//         language: $('#language').val(),
//         certificate_type: $('#certificate_type').val(),
//         level: $('#level').val(),
//         issued_by: $('#issued_by').val(),
//         date_of_issued: $('#date_of_issued').val(),
//         expire: $('#expire').val(),
//         note: $('#note').val(),
//       }

//       // console.log(formData);

//       // determine http verb to use add=POST, update=PUT
//       var state = $('#btn-save-language').val();

//       var type = "POST";
//       var id_language = $('#id_language').val();
//       var active_url = url;

//       if(state == 'update'){
//         type = "PUT"; 
//         active_url += 'language/edit/' + id_language;
//       }

//       if(state == 'add'){
//         active_url += 'language/add';
//       }

//       console.log(formData);
//       console.log(active_url);

//       $.ajax({
//         type: type,
//         url: active_url,
//         data: formData, 
//         dataType: 'json',
//         success: function(data){
//           console.log(data);

//           var language ='<tr id="language' + data.id + '"> <td>' + data.id + '</td> <td>' + data.language + '</td> <td>' + data.certificate_type + '</td> <td>' + data.issued_by + '</td> <td>' + data.level + '</td> <td> <span class="docs-tooltip" data-toggle="tooltip" title="Xem trình độ ngoại ngữ"> <button class="btn btn-info btn-xs btn-detail-language open-modal-language" value="' + data.id + '"><i class="fa fa-info-circle"></i> </button></span> <span class="docs-tooltip" data-toggle="tooltip" title="Xóa chức vụ"> <button class="btn btn-danger btn-xs btn-delete delete-language" value="' + data.id + '"><i class="fa fa-trash"></i></button> </span> </td></tr>';


//           if(state == "add"){
//             $('#language-list').append(language);
//             $('#notify_language').append('<div class="alert alert-success">Tạo mới thành công </div>');
//           }else{
//             $('#language' + id_language).replaceWith(language);
//             $('#notify_language').append('<div class="alert alert-success">Cập nhật thành công </div>');
//           }

//           $('#formLanguage').trigger("reset");
//           $('#modalLanguage').modal('hide');

//         },

//         error: function(data){
//           console.log('Error: ', data);
//         }
//       });

//     });

//     // delete and remove from list
//     $('.delete-language').click(function(){
//       var id_language = $(this).val();
//       $('#btn-confirm-delete').val(id_language);
//       $('#delete-type').val('language');
//       $('#delete-message').text('Bạn muốn xóa trình độ ngoại ngữ này?');
//       $('#modalConfirmDelete').modal('show');
//       console.log(id_language);
//     });




//     // $('#btn-confirm-delete').click(function(){
//     //   var id_language = $(this).val();

//     //   $.ajax({
//     //     type: "GET",
//     //     url: url + 'language/delete/' +id_language,
//     //     success: function(data){
//     //       console.log(data);
//     //       $('#language' + id_language).remove();
//     //       $('#modalConfirmDelete').modal('hide');
//     //       $('#notify_language').append('<div class="alert alert-success">Xóa thành công </div>');
//     //     },
//     //     error: function(data){
//     //       console.log('Error:', data);
//     //     }
//     //   });
//     // });




//     /*---------------------------------- FOR SPECIALIZED----------------------------------------*/
//   // display modal view specialized
//   $('.open-modal-specialized').click (function(){
//     var id_specialized = $(this).val();

//     $.get(url + 'specialized/detail/' + id_specialized, function(data){
//         // success data
//         console.log(data);

//         $('#name_emp_specialized').val(data.specialized.emp_profile.name);
//         $('#id_emp_specialized').val(data.id_emp);
//         $('#id_specialized').val(data.specialized.id);
//         $('#specialized').val(data.specialized.specialized);
//         $('#training_type').val(data.specialized.training_type);
//         $('#degree').val(data.specialized.degree);
//         $('#specialized_level').val(data.specialized.level);
//         $('#specialized_issued_by').val(data.specialized.issued_by);
//         $('#specialized_date_of_issued').val(data.specialized.date_of_issued);
//         $('#begin').val(data.specialized.begin);
//         $('#finish').val(data.specialized.finish);
//         $('#specialized_note').val(data.specialized.note);

//         $('#btn-save-specialized').val('update');
//         $('#modalSpecialized').modal('show');
//       });
//   });

//   //display modal add specialized
//   $('#btn-add-specialized').click(function(){
//     var id_emp = $(this).val();

//     $.get(url + 'add/' + id_emp, function(data){
//       console.log(data);

//       $('#formSpecialized').trigger("reset");
//       $('#btn-save-specialized').val("add");

//       $('#name_emp_specialized').val(data.name_emp);
//       $('#id_emp_specialized').val(data.id_emp);

//       $('#modalSpecialized').modal('show');
//     });
//   });

//   $('#btn-save-specialized').click(function(e){
//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//       }
//     })

//     e.preventDefault();

//     var formData = {
//       id_emp: $('#id_emp_specialized').val(),
//       specialized: $('#specialized').val(),
//       degree: $('#degree').val(),
//       training_type: $('#training_type').val(),
//       level: $('#specialized_level').val(),
//       issued_by: $('#specialized_issued_by').val(),
//       date_of_issued: $('#specialized_date_of_issued').val(),
//       begin: $('#begin').val(),
//       finish: $('#finish').val(),
//       note: $('#specialized_note').val(),
//     }
//     console.log(formData);


//     // determine http verb to use add=POST, update=PUT
//     var state = $('#btn-save-specialized').val();

//     var type = "POST";
//     var id_specialized = $('#id_specialized').val();
//     var active_url = url;

//     if(state == 'update'){
//       type = "PUT"; 
//       active_url += 'specialized/edit/' + id_specialized;
//     }

//     if(state == 'add'){
//       active_url += 'specialized/add';
//     }

//     console.log(formData);
//     console.log(active_url);

//     $.ajax({
//       type: type,
//       url: active_url,
//       data: formData, 
//       dataType: 'json',
//       success: function(data){
//         console.log(data);

//         var specialized ='<tr id="specialized' + data.id + '"> <td>' + data.id + '</td> <td>' + data.specialized + '</td> <td>' + data.degree + '</td> <td>' + data.issued_by + '</td> <td>' + data.level + '</td> <td> <span class="docs-tooltip" data-toggle="tooltip" title="Xem trình độ"> <button class="btn btn-info btn-xs btn-detail-language open-modal-language" value="' + data.id + '"><i class="fa fa-info-circle"></i></button></span> <span class="docs-tooltip" data-toggle="tooltip" title="Xóa trình độ"> <button class="btn btn-danger btn-xs btn-delete delete-language" value="' + data.id + '"><i class="fa fa-trash"></i></button> </span> </td></tr>';


//         if(state == "add"){
//           $('#specialized-list').append(specialized);
//           $('#notify_specialized').append('<div class="alert alert-success">Tạo mới thành công </div>');
//         }else{
//           $('#specialized' + id_specialized).replaceWith(specialized);
//           $('#notify_specialized').append('<div class="alert alert-success">Cập nhật thành công </div>');
//         }

//         $('#formSpecialized').trigger("reset");
//         $('#modalSpecialized').modal('hide');

//       },

//       error: function(data){
//         console.log('Error: ', data);
//       },
//     });
//   });



//   // delete specialized and remove from list
//   $('.delete-specialized').click(function(){
//     var id_specialized= $(this).val();
//     $('#btn-confirm-delete').val(id_specialized);
//     $('#delete-type').val('specialized');
//     $('#delete-message').text("Bạn muốn xóa trình độ chuyên môn này?");
//     $('#modalConfirmDelete').modal('show');
//     console.log(id_specialized);
//   });


//   // $('#btn-confirm-delete-specialized').click(function(){
//   //   var id_specialized = $(this).val();

//   //   $.ajax({
//   //     type: "GET",
//   //     url: url + 'specialized/delete/' + id_specialized,
//   //     success: function(data){
//   //       console.log(data);
//   //       $('#specialized' + id_specialized).remove();
//   //       $('#modalConfirmDeleteSpecialized').modal('hide');
//   //       $('#notify_specialized').append('<div class="alert alert-success">Xóa thành công </div>');
//   //     },
//   //     error: function(data){
//   //       console.log('Error:', data);
//   //     }
//   //   });
//   // });




//   var base_url = "/laravel/HRMProject/public/hrm/emp/";

//   /*---------------------------------- FOR RELATIVES----------------------------------------*/

//   $('.btn-detail-relatives').click (function(){ // display modal view relatives
//     var id_relatives = $(this).val();

//     $.get(base_url + 'relatives/detail/' + id_relatives, function(data){
//         // success data
//         console.log(data);

//         $('#relatives-name_emp').val(data.relatives.emp_profile.name);
//         $('#relatives-id_emp').val(data.id_emp);
//         $('#relatives-id').val(data.relatives.id);
//         $('#relatives-name').val(data.relatives.name);
//         $('#relationship').val(data.relatives.relationship);
//         $('#relatives-date_of_birth').val(data.relatives.date_of_birth);
//         $('#relatives-phone').val(data.relatives.phone);
//         $('#relatives-career').val(data.relatives.career);
//         $('#relatives-workplace').val(data.relatives.workplace);

//         var address = data.relatives.address;
//         console.log(address);
//         addr_obj = JSON.parse(address);
//         $('#relatives-address').val(addr_obj.address);
//         $('#relatives-address_district').val(addr_obj.district);
//         $('#relatives-address_province').val(addr_obj.province);
//         $('#relatives_note').val(data.relatives.note);

//         $('#btn-save-relatives').val('update');
//         $('#modalRelatives').modal('show');
//       });
//   });

  
//   $('#btn-add-relatives').click(function(){ //display modal add relatives
//     var id_emp = $(this).val();

//     $.get(base_url + 'relatives/add/' + id_emp, function(data){
//       console.log(data);

//       $('#formRelatives').trigger("reset");
//       $('#btn-save-relatives').val("add");

//       $('#relatives-name_emp').val(data.name_emp);
//       $('#relatives-id_emp').val(data.id_emp);

//       $('#modalRelatives').modal('show');
//     });
//   });
//   $('#btn-save-relatives').click(function(e){ // save relatives
//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//       }
//     })

//     e.preventDefault();

//     var formData = {
//       id_emp: $('#relatives-id_emp').val(),
//       name: $('#relatives-name').val(),
//       relationship: $('#relationship').val(),
//       date_of_birth: $('#relatives-date_of_birth').val(),
//       phone: $('#relatives-phone').val(),
//       career: $('#relatives-career').val(),
//       workplace: $('#relatives-workplace').val(),
//       address: $('#relatives-address').val(),
//       address_district: $('#relatives-address_district').val(),
//       address_province: $('#relatives-address_province').val(),
//       note: $('#relatives-note').val(),
//     }
//     console.log(formData);



//     var state = $('#btn-save-relatives').val();  // determine http verb to use add=POST, update=PUT

//     var type = "POST";
//     var id_relatives = $('#relatives-id').val();
//     var active_url = base_url;

//     if(state == 'update'){
//       type = "PUT"; 
//       active_url += 'relatives/edit/' + id_relatives;
//     }

//     if(state == 'add'){
//       active_url += 'relatives/add';
//     }

//     console.log(formData);
//     console.log(active_url);

//     $.ajax({
//       type: type,
//       url: active_url,
//       data: formData, 
//       dataType: 'json',
//       success: function(data){
//         console.log(data);

//         var addr_json = data.address;
//         obj = JSON.parse(addr_json);
//         var address = obj.address +', ' + obj.district + ', ' + obj.province;


//         var relatives ='<tr id="relatives' + data.id + '"> <td>' + data.id + '</td> <td>' + data.name + '</td> <td>' + data.relationship + '</td> <td>' + data.date_of_birth + '</td> <td>' + data.career +'</td> <td>' + address + '</td> <td> <span class="docs-tooltip" data-toggle="tooltip" title="Xem chi tiết"> <button class="btn btn-info btn-xs btn-detail-relatives" value="' + data.id + '"><i class="fa fa-info-circle"></i></button></span> <span class="docs-tooltip" data-toggle="tooltip" title="Xóa"> <button class="btn btn-danger btn-xs btn-delete-relatives" value="' + data.id + '"><i class="fa fa-trash-o"></i></button> </span></td></tr>';


//         if(state == "add"){
//           $('#relatives-list').append(relatives);
//           $('#relatives-notify').append('<div class="alert alert-success">Tạo mới thành công </div>');
//         }else{
//           $('#relatives' + id_relatives).replaceWith(relatives);
//           $('#relatives-notify').append('<div class="alert alert-success">Cập nhật thành công </div>');
//           // $('#relatives' + id_relatives).append(' <a class="fa fa-file-pdf-o" href="" id="contract-content_link" name="contract-content_link" type="hidden"></a>');
//         }

//         $('#formRelatives').trigger("reset");
//         $('#modalRelatives').modal('hide');

//       },

//       error: function(data){
//         console.log('Error: ', data);
//       },
//     });
//   });
//   $('.btn-delete-relatives').click(function(){    // delete relatives and remove from list
//     var id_relatives= $(this).val();
//     $('#btn-confirm-delete').val(id_relatives);
//     $('#delete-type').val('relatives');
//     $('#delete-message').text("Bạn muốn xóa quan hệ gia đình này?");
//     $('#modalConfirmDelete').modal('show');
//     console.log(id_relatives);
//   });

//   /*---------------------------------- FOR POSITIOn----------------------------------------*/
//   $('.btn-detail-position').click(function(){ //show modal view position 
//     var id_position = $(this).val();
//     console.log(id_position);

//     $.get(base_url + 'position/detail/' + id_position, function(data){
//       console.log(data);

//       $('#pos-name_emp').val(data.position.emp_profile.name);
//       $('#pos-id_emp').val(data.id_emp);

//       $('#pos-id').val(data.position.id);

//       $('#pos-position').val(data.position.id_position);
//       $('#pos-department').val(data.position.id_department);
//       $('#pos-decided_number').val(data.position.decided_number);
//       $('#pos-status').val(data.position.status);
//       $('#pos-date_begin').val(data.position.date_begin);
//       $('#pos-date_finish').val(data.position.date_finish);
//       $('#pos-note').val(data.position.note);

//       $('#modalViewPosition').modal('show');
      
//     });
//   });
//   $('#btn-update-position').click(function(e){ //edit position
//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//       }
//     })

//     e.preventDefault();

//     var formData = {
//       id_position: $('#pos-position').val(),
//       id_department: $('#pos-department').val(),
//       decided_number: $('#pos-decided_number').val(),
//       status: $('#pos-status').val(),
//       date_begin: $('#pos-date_begin').val(),
//       date_finish: $('#pos-date_finish').val(),
//       note: $('#pos-note').val(),
//     }
//     console.log(formData);
//     var type = "PUT";
//     var id_pos = $('#pos-id').val();
//     var active_url = base_url + 'position/edit/' + id_pos;
//     console.log(active_url);

//     $.ajax({
//       type: type,
//       url: active_url,
//       data: formData, 
//       dataType: 'json',
//       success: function(data){
//         console.log(data);

//         var status;
//         if(data.status == "1")
//           status = "Chức vụ chính";
//         else
//           status = "Kiêm nhiệm";

//         var position = '<tr id="position' + data.id + '"><td>' + data.id + '</td><td>' + data.date_begin + '</td><td>' + data.date_finish + '</td><td>' + data.position.position + '</td><td>' + data.department.department + '</td><td>' + status + '</td><td><button class="btn btn-info btn-xs btn-detail-position" title="Xem thông tin chức vụ" value="' + data.id + '"> <i class="fa fa-info-circle"></i></button><button class="btn btn-danger btn-xs btn-delete-pos" value="' + data.id + '"><i class="fa fa-trash"></i></button></td></tr>';

//         $('#position' + id_pos).replaceWith(position);
//         $('#emp_position-notify').append('<div class="alert alert-success">Cập nhật thành công </div>');


//         $('#formViewPosition').trigger("reset");
//         $('#modalViewPosition').modal('hide');
//       },

//       error: function(data){
//         console.log('Error: ', data);
//       },

//     });
//   });
//   $('#btn-add-position').click(function(){ //show modal add position
//     var id_emp  = $(this).val();
//     console.log(id_emp);

//     $.get(base_url + 'position/add/' + id_emp, function(data){
//       console.log(data);

//       $('#formAddPosition').trigger("reset");

//       $('#position-name_emp').val(data.name_emp);
//       $('#position-id_emp').val(data.id_emp);

//       $('#position-id').val(data.position.id);

//       $('#position-position').val(data.position.id_position);
//       $('#position-department').val(data.position.id_department);
//       $('#position-decided_number').val(data.position.decided_number);
//       $('#position-status').val(data.position.status);
//       $('#position-date_begin').val(data.position.date_begin);
//       $('#position-date_finish').val(data.position.date_finish);
//       $('#position-note').val(data.position.note);

//       $('#modalAddPosition').modal('show');
//     });
//   });
//   $('#btn-save-position').click(function(e){

//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//       }
//     })

//     e.preventDefault();

//     var new_status = $('#new_status').val();
//     var date_finish = $('#position-date_finish').val();
//     var notify;
//     if(new_status == "1" && date_finish == "")
//     {
//       $('#modalAddPosition').modal('hide');
//       $('#modalNotifyPosition').modal('show');
//       // $('#notify-add-position').append(notify);
//     }else{
//       var formData = {
//         id: $('#position-id').val(),
//         id_emp: $('#position-id_emp').val(),
//         id_position: $('#position-position').val(),
//         id_department: $('#position-department').val(),
//         decided_number: $('#position-decided_number').val(),
//         status: $('#position-status').val(),
//         date_begin: $('#position-date_begin').val(),
//         date_finish: $('#position-date_finish').val(),
//         note: $('#position-note').val(),
//         new_position: $('#new_position').val(),
//         new_department: $('#new_department').val(),
//         new_decided_number: $('#new_decided_number').val(),
//         new_status: $('#new_status').val(),
//         new_date_begin: $('#new_date_begin').val(),
//         new_date_finish: $('#new_date_finish').val(),
//         new_note: $('#new_note').val(),
//       }
//       console.log(formData);
//       var type = "POST";
//       var id_old = $('#position-id').val();
//       var active_url = base_url + 'position/add';
//       console.log(active_url);

//       $.ajax({
//         type: type,
//         url: active_url,
//         data: formData, 
//         dataType: 'json',
//         success: function(data){
//           console.log(data);

//           var status;
//           if(data.old.status == "1")
//             status = "Chức vụ chính";
//           else
//             status = "Kiêm nhiệm";
//           var new_status;
//           if(data.new.status == "1")
//             new_status = "Chức vụ chính";
//           else
//             new_status = "Kiêm nhiệm";


//           var position = '<tr id="position' + data.old.id + '"><td>' + data.old.id + '</td><td>' + data.old.date_begin + '</td><td>' + data.old.date_finish + '</td><td>' + data.old.position.position + '</td><td>' + data.old.department.department + '</td><td>' + status + '</td><td><button class="btn btn-info btn-xs btn-detail-position" title="Xem thông tin chức vụ" value="' + data.old.id + '"> <i class="fa fa-info-circle"></i></button><button class="btn btn-danger btn-xs btn-delete-pos" value="' + data.old.id + '"><i class="fa fa-trash"></i></button></td></tr>';
//           var newposition = '<tr id="position' + data.new.id + '"><td>' + data.new.id + '</td><td>' + data.new.date_begin + '</td><td>' + data.new.date_finish + '</td><td>' + data.new.position.position + '</td><td>' + data.new.department.department + '</td><td>' + new_status + '</td><td><button class="btn btn-info btn-xs btn-detail-position" title="Xem thông tin chức vụ" value="' + data.new.id + '"> <i class="fa fa-info-circle"></i></button><button class="btn btn-danger btn-xs btn-delete-pos" value="' + data.new.id + '"><i class="fa fa-trash"></i></button></td></tr>';


//           $('#position' + data.old.id).replaceWith(position);
//           $('#emp_position-list').append(newposition);
//           $('#emp_position-notify').append('<div class="alert alert-success">Tạo thành công </div>');


//           $('#formAddPosition').trigger("reset");
//           $('#modalAddPosition').modal('hide');
//         },

//         error: function(data){
//           console.log('Error: ', data);
//         },

//       });
//     }
//   });
//   $('.btn-delete-position').click(function(){    // delete relatives and remove from list
//     var id_position= $(this).val();
//     $('#btn-confirm-delete').val(id_position);
//     $('#delete-type').val('position');
//     $('#delete-message').text("Bạn muốn xóa chức vụ này?");
//     // $('#delete-message').text('Bạn muốn xóa trình độ chuyên môn này?');
//     $('#modalConfirmDelete').modal('show');
//     console.log(id);
//   });

//   /*---------------------------------- FOR CONTRACT----------------------------------------*/
//   $('.btn-detail-contract').click(function(){
//     var id_contract = $(this).val();
//     console.log(id_contract);
//     $('#contract-content').show();
//     $('#contract-content_file').show();
//     $('#btn-delete-contract').show();

//     $.get(base_url + 'contract/detail/' + id_contract, function(data){
//       console.log(data);

//       $('#contract-name_emp').val(data.contract.emp_profile.name);
//       $('#contract-id_emp').val(data.id_emp);
//       $('#contract-id').val(data.contract.id);
//       $('#contract-number').val(data.contract.contract_number);
//       $('#contract-number').val(data.contract.contract_number);
//       $('#contract-decided_number').val(data.contract.decided_number);
//       $('#contract-type').val(data.contract.id_contract_type);
//       $('#contract-duration').val(data.contract.duration);
//       $('#contract-original_number').val(data.contract.contract_original_number);
//       $('#contract-classify').val(data.contract.classify);
//       $('#contract-delegate').val(data.contract.delegate);
//       $('#contract-date_signed').val(data.contract.date_signed);
//       $('#contract-date_begin').val(data.contract.date_begin);
//       $('#contract-date_finish').val(data.contract.date_finish);
//       $('#contract-salary').val(data.contract.salary);
//       $('#contract-note').val(data.contract.note);

//       $('#btn-delete-contract').val(data.contract.id);
//       $('#btn-save-contract').val('update');
//       $('#modalContract').modal('show');
//     });
//   });

//   $('#btn-add-contract').click(function(){
//     var id_emp = $(this).val();
//     console.log(id_emp);

//     $('#contract-content_file').hide();
//     $('#btn-delete-contract').hide();
//     // $('#contract-content').show();

//     $.get(base_url + 'contract/add/' + id_emp, function(data){
//       console.log(data);

//       $('#formContract').trigger("reset");
//       $('#btn-save-contract').val("add");

//       $('#contract-name_emp').val(data.name_emp);
//       $('#contract-id_emp').val(data.id_emp);

//       $('#modalContract').modal('show');
//     });
//   });

//   $('#btn-save-contract').click(function(e){
//     $.ajaxSetup({
//       headers: {
//         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//       }
//     })

//     e.preventDefault();

//     var formData = {
//       id_emp: $('#contract-id_emp').val(),
//       contract_number: $('#contract-number').val(),
//       decided_number: $('#contract-decided_number').val(),
//       id_contract_type: $('#contract-type').val(),
//       duration: $('#contract-duration').val(),
//       original_contract_number: $('#contract-original_number').val(),
//       classify: $('#contract-classify').val(),
//       delegate: $('#contract-delegate').val(),
//       date_signed: $('#contract-date_signed').val(),
//       date_begin: $('#contract-date_begin').val(),
//       date_finish: $('#contract-date_finish').val(),
//       salary: $('#contract-salary').val(),
//       content: $('#contract-content').val(),
//       note: $('#contract-note').val(),
//     }

//     // var formData =  new FormData($('#formContract')[0]);


//     console.log(formData);


//     var state = $('#btn-save-contract').val();  // determine http verb to use add=POST, update=PUT

//     var type = "POST";
//     var id_contract = $('#contract-id').val();
//     var active_url = base_url;

//     if(state == 'update'){
//       type = "PUT"; 
//       active_url += 'contract/edit/' + id_contract;
//     }

//     if(state == 'add'){
//       active_url += 'contract/add';
//     }

//     console.log(active_url);

//     $.ajax({
//       type: type,
//       url: active_url,
//       data: formData, 
//       dataType: 'json',
//       success: function(data){
//         console.log(data);

//         var classify = '';

//         if(data.classify == '1'){
//           classify = "Hợp đồng";
//         }else{
//           classify = "Phụ lục";
//         }

//         var contract ='<tr id="contract' + data.id + '"> <td class="blue">' + data.contract_number + '</td> <td>' + data.decided_number + '</td> <td>' + classify + '</td> <td>' + data.contract_type.type+ '</td> <td>' + data.duration +'</td> <td>' + data.date_begin + '</td> <td> <span class="docs-tooltip" data-toggle="tooltip" title="Xem thông tin chi tiết"> <button class="btn btn-info btn-xs btn-detail-contract" value="' + data.id + '"><i class="fa fa-info-circle"></i></button></span> <span class="docs-tooltip" data-toggle="tooltip" title="Xóa"> <button class="btn btn-danger btn-xs btn-delete-contract" value="' + data.id + '"><i class="fa fa-trash-o"></i></button> </span></td></tr>';


//         if(state == "add"){
//           $('#contract-list').append(contract);

//           $('#contract-notify').append('<div class="alert alert-success">Tạo mới thành công </div>');
//         }else{
//           $('#contract' + id_contract).replaceWith(contract);
//           $('#contract-notify').append('<div class="alert alert-success">Cập nhật thành công </div>');
//           // $('#relatives' + id_relatives).append(' <a class="fa fa-file-pdf-o" href="" id="contract-content_link" name="contract-content_link" type="hidden"></a>');
//         }

//         $('#formContract').trigger("reset");
//         $('#modalContract').modal('hide');


//       },

//       error: function(data){
//         console.log('Error: ', data);
//       },
//     });

//   });



//   $('.btn-delete-contract').click(function(){    // delete relatives and remove from list
//     var id_contract= $(this).val();
//     $('#btn-confirm-delete').val(id_contract);
//     $('#delete-type').val('contract');
//     $('#delete-message').text("Bạn muốn xóa hợp đồng này?");
//     // $('#delete-message').text('Bạn muốn xóa trình độ chuyên môn này?');
//     $('#modalConfirmDelete').modal('show');
//     console.log(id_contract);
//   });



//   // for view contract
//   // $('#contract-content').hide();
//   // $('#content').append(' <a class="fa fa-file-pdf-o" href="" id="contract-content_link" name="contract-content_link" type="hidden"></a>');



// // confirm delete

// $('#btn-confirm-delete').click(function(){
//   var id = $(this).val();
//   var delete_type = $('#delete-type').val();
//   console.log(id);
//   console.log(delete_type);
//   var active_url = base_url;
//   if(delete_type == 'specialized'){
//     active_url += 'degree/specialized/delete/' +id;
//   }
//   else if(delete_type == 'language'){
//     active_url += 'degree/language/delete/' +id;
//   }else{
//     active_url += '' + delete_type +'/delete/' +id;
//   }

//   console.log(active_url);

//   $.ajax({
//     type: "GET",
//     url: active_url,
//     success: function(data){
//       console.log(data);
//       // if(delete_type == "position"){
//       //   $('#position' + id).remove();
//       // }else if(delete_type == "language"){
//       //   $('#language' + id).remove();
//       // }else if(delete_type =="specialized"){
//       //   $('#specialized' +id).remove();
//       // }else if(delete_type == "relatives"){
//       //   $('#relatives' +id).remove();


//       $('#'+delete_type + id).remove();


//       $('#modalConfirmDelete').modal('hide');
//       $('#modalContract').modal('hide');
//       $('#contract-notify').append('<div class="alert alert-success">Xóa thành công </div>');
//     },
//     error: function(data){
//       console.log('Error: ', data);
//     },
//   });

// });
















// });





</script>