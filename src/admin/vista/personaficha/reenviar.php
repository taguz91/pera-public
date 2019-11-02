<?php
$pagina = 'Permiso Ingreso Ficha | Ingresar';
require 'src/admin/vista/templates/header.php';
 ?>

<div class="my-5">
  <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">
    <h3 class="text-center my-3">
      Reenviar correo a estudiante
    </h3>
    <form class="form-horizontal" action="<?php echo constant('URL'); ?>personaficha/editar/" method="post">
      <input type="hidden" name="idperficha" value="<?php echo $_GET['id']; ?>">
      <div class="form-group">
        <label class="control-label" for="">Correo:</label>
        <input class="form-control" type="text" name="correo"
        placeholder="Ingrese el correo" value="">
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
