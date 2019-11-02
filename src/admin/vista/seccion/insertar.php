
  <div class="modal fade" id="insertarSeccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Ingreso de Nueva Sección de Ficha</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="<?php echo constant('URL'); ?>seccionficha/insertar" >
            <div class="form-group">
              <label for="nombreSeccion">Nombre de la Sección:</label>
              <input type="text" class="form-control"  name="nombreSeccion" placeholder="Ingrese un nombre...">
              </div>
              <div class="form-group">
              <label for="tipoSeccion">Tipo de Sección:</label>
              <select class="browser-default custom-select" id="listaTiposInsertar" name="tipoSeccion">
            </select>
            </div>
            <div class="form-group">
              <label for="posicionSeccion">Posición de la Sección:</label>
              <input type="number" class="form-control"  name="posicionSeccion" id="posicionSeccion" value="1" min="1">
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
        </div>
        </form>
        </div>

      </div>
    </div>
  </div>
