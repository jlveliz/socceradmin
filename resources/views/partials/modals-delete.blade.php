<div class="modal fade" id="delete-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
 <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro</h5>
        <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-4 col-lg-4 d-none d-sm-block text-danger text-center">
            <i class="display-4 i-File-Trash"></i>
          </div>
          <div class="col-md-8 col-lg-8 col-12 d-none d-sm-block">
            <span class="modal-message"></span>
            <strong class="modal-item-name"></strong>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <form action="" method="POST">
          <input type="hidden" name="_method" value="DELETE">
           {{ csrf_field() }}
          <input type="hidden" value="" class="modal-item-key" name="id">
          <button type="button" class="btn btn-secondary  close-modal" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-danger "><i class="i-File-Trash"></i> Eliminar</button>
        </form>
      </div>
    </div>
  </div>
</div>