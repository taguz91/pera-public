<?php
$pagina = 'Permiso Ingreso Ficha | Ingresar';
require 'src/admin/vista/templates/header.php';
 ?>

<div class="my-5">
  <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">
    <h3 class="text-center my-3">
      Enviar correo
    </h3>
    <form class="form-horizontal" action="<?php echo constant('URL'); ?>miad/correo/solo/" method="post">

      <input type="hidden" name="idpersona" value="<?php echo $_GET['idpersona']; ?>">

      <div class="form-group">
        <label for="permiso" class="control-label">Seleccione un Permiso:</label>
        <select class="form-control" name="permiso" required id="cmbPermisos">

          <?php if (isset($permisos)): ?>
            <?php foreach ($permisos as $pf): ?>
              <?php echo '<option value="' . $pf['id_permiso_ingreso_ficha'] . '">' . $pf['tipo_ficha'] . ' - ' . $pf['prd_lectivo_nombre'] . '</option>'; ?>
            <?php endforeach; ?>
          <?php endif; ?>
        </select>
      </div>

      <div class="form-group">
        <label class="control-label" for="">Correo:</label>
        <input class="form-control" type="text" name="correo"
        placeholder="Ingrese el correo"
        value="<?php echo isset($_GET['correo']) ? $_GET['correo'] : ''; ?>">
      </div>

      <div class="form-group">
        <label for="">Mensaje:</label>
        <textarea class="form-control" name="mensaje" rows="5" cols="5" placeholder="Escriba el mensaje que  enviara." required></textarea>
      </div>

      <div class="form-group">
        <input class="btn btn-success btn-block" type="submit" name="guardar" value="Guardar" id="btnGuardar">
      </div>

    </form>
  </div>
</div>

<?php
 require 'src/admin/vista/templates/footer.php';
 ?>
