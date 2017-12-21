<!-- modal upload file -->
<div class="modal fade" id="modal-upload"  role="dialog" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"> Upload file</h3>
      </div>
      <div class="modal-body">
        <p id="notify-message"></p>
        <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="POST" action="admin/user/add-by-file" id="form-upload" >
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="file" name="upload-file" id="upload-file">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Hủy</button>
        <button type="submit" class="btn btn-success" id="btn-confirm-upload" form="form-upload">Upload</button>
      </div>
    </div>
  </div>
</div>
<!-- /modal upload file -->