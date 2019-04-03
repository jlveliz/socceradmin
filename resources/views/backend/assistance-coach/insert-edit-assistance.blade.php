<div class="modal fade" id="assistanceCoachModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Insertar Asistencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          {{ csrf_field() }}
          <div class="row">
            <input type="hidden" name="field_id" id="field-id">
            <input type="hidden" name="coach_id" id="coach-id">
            <input type="hidden" name="date" id="date">

            <div class="col-lg-6 col-12">
              <label for="" class="form-control-label">Asistió?</label>
              <select name="state" id="state" class="select-assistance-coach form-control">
                  <option value="1">Si</option>
                  <option value="2">No</option>
              </select>
            </div>
            <div class="col-lg-6 col-12">
              <label for="" class="form-control-label">Ganancia</label>
              <input type="text" name="profit" class="form-control" id="profit" autofocus="" required="">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="i-Danger"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary"><i class="i-Data-Save"></i> Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>