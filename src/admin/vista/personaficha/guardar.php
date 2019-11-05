<?php
$pagina = 'Envío de correos';
require 'src/admin/vista/templates/header.php';
?>
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/scroll.css">

<div class="my-5">

  <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

    <h3 class="text-center my-3">Envío de correos</h3>
    <hr>
    <div id="ctn-msg"></div>

    <form class="form-horizontal" action="#" method="post" id="form-correos">

      <div class="form-group">
        <label for="permiso" class="control-label">Seleccione un Permiso:</label>
        <select class="form-control" name="permiso" required id="cmbPermisos">
          <option value="0">Permisos</option>

          <?php
          if (isset($permisos)) {
            foreach ($permisos as $pf) {
              echo '<option value="' . $pf['id_permiso_ingreso_ficha'] . '">' . $pf['tipo_ficha'] . ' - ' . $pf['prd_lectivo_nombre'] . '</option>';
            }
          }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label for="ciclo" class="control-label">Seleccione un Ciclo:</label>
        <select class="form-control" name="ciclo" required id="cmbCiclos">
        </select>
      </div>

      <div class="form-group">
        <label for="">Correo:</label>
        <textarea name="mensaje" class="form-control" rows="5" cols="5" placeholder="Escriba el correo que enviara." required></textarea>
      </div>

      <div class="form-group">
        <input class="btn btn-success btn-block" type="submit" name="guardar" value="Guardar" id="btnGuardar" onclick="enviarCorreos()">
      </div>

    </form>

  </div>


  <div class="card shadow my-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
        Personas a las que se enviaran las fichas.
      </h6>
    </div>

    <div class="card-body">
      <div class="table-responsive scroll">
        <table class="table table-bordered" width="100%" cellspacing="0">

          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Remover</th>
            </tr>
          </thead>

          <tbody id="tb-personas"></tbody>

        </table>
      </div>

    </div>

  </div>

</div>

<script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/ajax/correomasivo.js"></script>

<?php
require 'src/admin/vista/templates/footer.php';
?>
