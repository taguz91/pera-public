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
            <th scope="col">Periodo </th>
            <th scope="col">Ficha</th>
            <th scope="col">Numero de enviados</th>
            <th scope="col">Ver enviados</th>
          </tr>
        </thead>
        <tbody>

          <?php if (isset($permisos)): ?>
            <?php foreach ($permisos as $r): ?>
              <tr>
                <td><?php echo $r['id_permiso_ingreso_ficha']; ?></td>
                <td><?php echo $r['prd_lectivo_nombre']; ?></td>
                <td><?php echo $r['tipo_ficha']; ?></td>
                <td><?php echo $r['num_personas']; ?></td>
                <td> <a href="<?php echo constant('URL').'miad/correo/enviados/'.$r['id_permiso_ingreso_ficha']; ?>">Ver</a> </td>
              </tr>
            <?php endforeach; ?>
            <?php else: ?>
              <?php Errores::errorBuscar("No obtuvimos permisos."); ?>
          <?php endif; ?>

        </tbody>
      </table>
    </div>

  </div>

</div>

<?php
require 'src/admin/vista/templates/footer.php';
 ?>
