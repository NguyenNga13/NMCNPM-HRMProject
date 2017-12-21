<!-- Modal confirm delete-->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" role="dialog" >
  <div class="modal-dialog">
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
<!-- /Modal confirm delete-->