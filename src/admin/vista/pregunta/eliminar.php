<div class="modal fade" id="eliminarPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">'
          <h5 class="modal-title" id="actualizacion">¿Está seguro que desea eliminar esta Pregunta?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="<?php echo constant('URL'); ?>preguntaficha/eliminar" >
              <input type="hidden" name="idPregunta" id="idPreguntaE">
              <div class="form-group">
              <label for="tipoSeccion">Sección de la Pregunta:</label>

                <select class="browser-default custom-select" id="listaSeccionesEliminar" name="seccionPregunta" disabled>
                <?php
                if (isset($seccionesFicha)) {
                    foreach ($seccionesFicha as $seccionFicha) {
                        echo "<option value={$seccionFicha[0]}>{$seccionFicha[2]}</option>";
                    }
                }
                ?>


              </select>
              </div>

              <div class="form-group">
              <label for="pregunta">Pregunta:</label>
              <input type="text" class="form-control" id="preguntaE" name="pregunta" placeholder="Ingrese una pregunta..." readonly>
              </div>

              <div class="form-group">
                <label for="ayudaPregunta">Descripción para la Pregunta:</label>
                <textarea class="form-control rounded-0" id="ayudaPreguntaE" name="ayudaPregunta" rows="3" readonly></textarea>
              </div>

              <div class="form-group">
                <label for="tipoRespuesta">Tipo de Respuestas:</label>
                <select class="browser-default custom-select" id="tipoRespuestaE" name="tipoRespuesta"  disabled>
                  <option value="1">Única</option>
                  <option value="2">Múltiple</option>
                  <option value="3">Libre Única</option>
                  <option value="4">Libre Múltiple</option>
                  <option value="5">Selección</option>
                </select>
                </div>

                <div class="form-group" id="respuestasMenuE">

                </div>


                <div class="form-group" id="respuestasE">


                </div>

             <div></div>

             <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="tipoPreguntaE" name="tipoPregunta" disabled>
                    <label class="custom-control-label" for="tipoPreguntaA">Pregunta Obligatoria</label>
            </div>

             <div class="modal-footer">
              <button type="button" id="cancelarE" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-danger" >Eliminar</button>
            </div>

        </form>
        </div>

      </div>
    </div>
  </div>
