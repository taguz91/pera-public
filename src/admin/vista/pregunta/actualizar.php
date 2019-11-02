
  <div class="modal fade" id="actualizarPregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="actualizacion">Actualizacion de Pregunta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form method="post" action="<?php echo constant('URL'); ?>preguntaficha/actualizar" >
              <input type="hidden" name="idPregunta" id="idPreguntaA">
              <div class="form-group">
              <label for="tipoSeccion">Sección de la Pregunta:</label>

                <select class="browser-default custom-select" id="listaSeccionesActualizar" name="seccionPregunta">
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
              <input type="text" class="form-control" id="preguntaA" name="pregunta" placeholder="Ingrese una pregunta...">
              </div>

              <div class="form-group"> 
              <label for="posicionSeccion">Posición de la Pregunta:</label>
              <input type="number" class="form-control"  name="posicionPregunta" id="posicionPreguntaA"  min="1">
              </div>  

              <div class="form-group">
                <label for="ayudaPregunta">Descripción para la Pregunta:</label>
                <textarea class="form-control rounded-0" id="ayudaPreguntaA" name="ayudaPregunta" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="tipoRespuesta">Tipo de Respuestas:</label>
                <select class="browser-default custom-select" id="tipoRespuestaA" name="tipoRespuesta">
                  <option value="1">Única</option>
                  <option value="2">Múltiple</option>
                  <option value="3">Libre Única</option>
                  <option value="4">Libre Múltiple</option>
                  <option value="5">Selección</option>
                </select>
                </div>

                <div class="form-group" id="respuestasMenuA">

                </div>


                <div class="form-group" id="respuestasA">


                </div>

                <div class="form-group" id="respuestasA">
                <label for="pregunta" style="display:none" id="etiquetaCampo">Tipo de Dato Admitido por el Campo:</label>
                  <select class="browser-default custom-select" id="tipoCampoA" style="display:none" name="tipoCampo">
                    <option value="text">Texto</option>
                    <option value="number">Númerico</option>
                    <option value="date">Fecha</option>
                  </select>

                </div>



             <div></div>

             <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="tipoPreguntaA" name="tipoPregunta">
                    <label class="custom-control-label" for="tipoPreguntaA">Pregunta Obligatoria</label>
            </div>

             <div class="modal-footer">
              <button type="button" id="cancelarA" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary" >Guardar</button>
            </div>

        </form>
        </div>

      </div>
    </div>
  </div>
