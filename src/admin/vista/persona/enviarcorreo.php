
<!-- MODAL PARA ENVIAR CORREO -->

<div class="modal fade mx-auto" id="enviar-correo" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Envio correo</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div id="ctn-msg"></div>

        <form id="form-correo" class="form-horizontal" method="post">

          <input type="hidden" name="idpersona" value="">

          <div class="form-group">
            <label for="permiso" class="control-label">Seleccione un Permiso:</label>
            <select class="form-control" name="permiso" required id="cmbPermisos">

            </select>

          </div>

          <div class="form-group">
            <label class="control-label" for="">Correo:</label>
            <input class="form-control" type="email" name="correo"
            placeholder="Ingrese el correo"
            value="">
          </div>

          <div class="form-group">
            <label for="">Mensaje:</label>
            <textarea class="form-control" name="mensaje" rows="5" cols="5" placeholder="Escriba el mensaje que  enviara." required></textarea>
          </div>

          <div class="form-group">
            <button class="btn btn-success" type="button" name="guardar" onclick="enviarCorreo()">Guardar</button>
          </div>

        </form>

      </div>

    </div>

  </div>
</div>

<!-- MODAL PARA ENVIAR CORREO -->

<script type="text/javascript" src="<?php echo constant('URL') ?>public/js/ajax/enviarcorreo.js"></script>
