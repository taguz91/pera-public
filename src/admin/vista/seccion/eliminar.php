
  <div class="modal fade" id="eliminarSeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">¿Está seguro que desea eliminar esta Seccion de Ficha?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="<?php echo constant('URL'); ?>miad/seccion/eliminar">
            <input type="hidden" name="idSeccion" id="idSeccionE">
            <div class="form-group">
              <label for="nombreSeccion">Nombre de la Seccion:</label>
              <input type="text" class="form-control" id="nombreSeccionE" name="nombreSeccion" readonly>
              </div>
              <label for="tipoSeccion">Tipo de Sección:</label>
              <select class="browser-default custom-select" id="listaTiposEliminar" name="tipoSeccion" disabled>
            </select>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </div>
        </form>
        </div>

      </div>
    </div>
  </div>
