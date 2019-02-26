<div class="modal fade" id="search-modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <form action="" method="POST" class="form-inline justify-content-center">
                  <div class="form-group col-5 mx-sm-3 mb-2">
                      <input type="text" class="form-control col-12" id="search-input" placeholder="Cédula, nombres o apellidos" autofocus="autofocus">
                  </div>
                  <button type="submit" class="btn btn-primary mb-2 btn-search"><i class="i-Data-Search"></i></button>
              </form>
            </div>
            <div class="col-12">
              <div class="alert d-none" id="alert-modal-search">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                
              </div>
              <table class="table table-hover" id="table-results-search">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td colspan="2"><p class="text-center">No existen datos a consultar</p></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <form action="" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            {{ csrf_field() }}
            <input type="hidden" value="" class="modal-item-key" name="id">
            <button type="button" class="btn btn-secondary btn-sm close-modal" data-dismiss="modal">Cerrar</button>
            {{-- <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i> Aceptar</button> --}}
          </form>
        </div>
      </div>
  </div>
</div>