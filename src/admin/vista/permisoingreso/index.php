<?php
$pagina = 'Permiso Ingreso Fichas';
require 'src/admin/vista/templates/header.php';
 ?>

 <div class="card shadown mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Todos los permiso fichas ingresados
        </h6>
      </div>
      <div class="col-4 col-lg-2">
        <a href="<?php echo constant('URL'); ?>miad/permiso/nuevo"
        class="btn btn-success btn-block">Ingresar</a>
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

      <div id="ctn-msg"></div>

      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead class="thead-dark">
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Periodo</th>
              <th scope="col">Tipo Ficha</th>
              <th scope="col">Fecha Inicio</th>
              <th scope="col">Fecha Fin</th>
              <th scope="col">Editar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>

            <?php if (isset($permisoingresos)): ?>

              <?php foreach ($permisoingresos as $pi): ?>

                <tr id="fila<?php echo $pi['id_permiso_ingreso_ficha']; ?>">

                  <td><?php echo $pi['id_permiso_ingreso_ficha']; ?></td>
                  <td><?php echo $pi['prd_lectivo_nombre'] ?></td>
                  <td><?php echo $pi['tipo_ficha']; ?></td>
                  <td><?php echo $pi['fecha_inicio'];?></td>
                  <td><?php echo $pi['fecha_fin']; ?></td>

                  <td> <a href="<?php echo constant('URL').'miad/permiso/editar?id='.$pi['id_permiso_ingreso_ficha']; ?>" class="btn btn-info btn-sm">Editar</a> </td>

                  <td> <button onclick="eliminar('<?php echo constant('URL').'miad/permiso/eliminar?id='; ?>', '<?php echo $pi['id_permiso_ingreso_ficha']; ?>')" type="button" class="btn btn-danger btn-sm">Eliminar</button> </td>

                </tr>

              <?php endforeach; ?>

              <?php else: ?>

                <?php Errores::errorBuscar("No encontramos tipos de fichas"); ?>

            <?php endif; ?>

          </tbody>
        </table>
      </div>

    </div>
</div>


<script type="text/javascript">

  function eliminar(url, id) {

    fetch(url + id, {
      method: 'GET'
    })
    .then(res => res.json())
    .then(data => {
      if (data.statuscode == '200') {
        msgSuccess(data.mensaje);
        let row = document.querySelector('#fila'+id);
        if (row != null) {
          row.parentNode.removeChild(row);
        }
      } else {
        console.log(data);
      }
    });

  }
</script>

<?php
require 'src/admin/vista/templates/footer.php';
 ?>
