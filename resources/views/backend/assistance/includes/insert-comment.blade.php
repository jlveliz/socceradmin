<div class="modal fade" id="insertCommentModal" tabindex="-1" role="dialog" aria-labelledby="insertCommentModal" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar o Editar Comentario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          {{ csrf_field() }}
          <div class="row">
            <div class="col-12">
              <label for="" class="form-control-label">Comentario</label>
              <input type="hidden" id="button-target">
              <input type="text" name="comment" class="form-control" id="comment" autofocus="" required="">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="i-Data-Save"></i> Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>