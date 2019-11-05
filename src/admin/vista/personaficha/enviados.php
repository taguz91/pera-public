<?php
$pagina = 'Fichas Enviadas';
require 'src/admin/vista/templates/header.php';
 ?>


<div class="card shadown mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Todas las fichas enviadas
        </h6>
      </div>

      <div class="col-4 col-lg-2">
        <a href="<?php echo constant('URL') ?>miad/correo/nuevo" class="btn btn-success btn-block">Ingresar </a>
      </div>

    </div>

    <?php if (isset($mensaje)): ?>
      <div class="row">
        <div class="col-10 mx-auto">
          <div class="alert alert-info my-2 text-center alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>

  <div class="card-body">
    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre Persona</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Modificación</th>
            <th scope="col">Reenviar</th>
            <th scope="col">Eliminar</th>
          </tr>
        </thead>

        <tbody>

          <?php if (isset($personaFichas)): ?>
            <?php foreach ($personaFichas as $pf): ?>
              <tr>
                <td><?php echo $pf['id_persona_ficha']; ?></td>
                <td><?php echo $pf['persona_nombre']; ?></td>
                <td><?php echo $pf['persona_ficha_fecha_ingreso']; ?></td>
                <td><?php echo $pf['persona_ficha_fecha_modificacion']; ?></td>

                <td>
                  <button class="btn btn-primary btn-sm" type="button"
                  onclick="enviar(
                  <?php echo $pf['id_persona_ficha']; ?>,
                  '<?php echo $pf['persona_correo'] ?>'
                  )" data-toggle="modal" data-target="#reenviar-correo">Reenviar</button>
                </td>

                <td> <a href="<?php echo constant('URL').'miad/correo/eliminar?id='.$pf['id_persona_ficha']; ?>">Eliminar</a> </td>
              </tr>
            <?php endforeach; ?>
            <?php else: ?>
              <?php Errores::errorBuscar("No encontramos las fichas de las personas"); ?>
          <?php endif; ?>
        </tbody>

      </table>

    </div>
  </div>

</div>

<?php
require 'src/admin/vista/personaficha/reenviar.php';
require 'src/admin/vista/templates/footer.php';
 ?>
