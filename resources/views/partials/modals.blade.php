<div class="modal fade" id="delete-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Desea Eliminar el <span></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-inverse" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary acept-delete-modal">Aceptar</button>
        <form class="delete-form" method="POST" action="" style="display: none">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="DELETE">
        </form>
      </div>
    </div>
  </div>
</div>