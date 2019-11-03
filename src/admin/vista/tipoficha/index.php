<?php
$pagina = 'Tipo Ficha';
require 'src/admin/vista/templates/header.php';
 ?>


<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Tipos de ficha
        </h6>
      </div>
      <div class="col-4 col-lg-2">
        <a href="<?php echo constant('URL'); ?>miad/tipo/nuevo"
        class="btn btn-success btn-block">
          Ingresar
        </a>
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
            <th scope="col">Tipo Ficha</th>
            <th scope="col">Descripcion</th>
            <th scope="col">Editar</th>
          </tr>
        </thead>

        <tbody>
          <?php if(isset($tiposfichas)){?>
            <?php foreach ($tiposfichas as $tf): ?>
              <tr scope="row">
                <td><?php echo $tf['id_tipo_ficha']; ?></td>
                <td><?php echo $tf['tipo_ficha']; ?></td>
                <td><?php echo $tf['tipo_ficha_descripcion']; ?></td>
                <td> <a href="<?php echo constant('URL').'miad/tipo/editar/?editar='.$tf['id_tipo_ficha']; ?>"> Editar </a> </td>
              </tr>
            <?php endforeach; ?>
            <?php }else{
              Errores::errorBuscar("No encontramos tipos de fichas");
            }
           ?>
        </tbody>

      </table>
    </div>
  </div>

</div>


<?php
require 'src/admin/vista/templates/footer.php';
 ?>
