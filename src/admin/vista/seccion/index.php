<?php
$pagina = 'Secciones Ficha';
require 'src/admin/vista/templates/header.php';
require_once 'src/admin/vista/seccion/actualizar.php';
require_once 'src/admin/vista/seccion/insertar.php';
require_once 'src/admin/vista/seccion/eliminar.php';
 ?>


<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">Secciones creadas para las fichas</h6>
      </div>

      <div class="col-4 col-lg-2">
        <button type="button" class="btn btn-success btn-block insertarBtn" data-toggle='modal' data-target='#insertarSeccion'>
          Nuevo
        </button>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col">
        <div class="active-cyan-4 mb-2" >
          <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search" id="busqueda" name="busqueda" value="<?php if(isset($key)){echo $key;} ?>" >

          <?php
          if(isset($tiposSeccion)){
            foreach ($tiposSeccion as $ts) {
              echo "<input type='hidden' class='tiposSeccion' value='{$ts['id_tipo_ficha']}'>
              <input type='hidden' class='tiposSeccion' value='{$ts['tipo_ficha']}'>";
            }
          }
          ?>

        </div>
      </div>
    </div>

    <?php if (isset($mensaje)): ?>
      <div class="row">
        <div class="col-10 mx-auto">
          <div class="alert alert-info my-2 text-center">
            <?php echo $mensaje; ?>
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
              <th scope="col">#</th>
              <th scope="col">Tipo</th>
              <th scope="col">Nombre</th>

              <th style="display:none;">cols</th>
              <th style="display:none;">cols</th>

              <th scope="col">Editar</th>
              <!--
              <th scope="col">Eliminar</th>
            -->
            </tr>
          </thead>

          <tbody>
          <?php
            if (isset($secciones)) {
              foreach($secciones as $seccion){
                echo "<tr>
                <th scope='row'>{$seccion[0]}</th>
                <td>{$seccion[1]}</td>
                <td>{$seccion[2]}</td>

                <td style='display:none;'>{$seccion[4]}</td>
                <td style='display:none;'>{$seccion[5]}</td>

                <td>
                  <button type='button' class='btn btn-primary actualizarBtn'
                  data-toggle='modal' data-target='#actualizarSeccion'>
                    Actualizar
                  </button>
                </td>
                <!--
                <td>
                  <button type='button' class='btn btn-danger eliminarBtn'
                  data-toggle='modal' data-target='#eliminarSeccion'>
                    Eliminar
                  </button>
                </td>
                -->
                </tr>";
              }
            }
          ?>
          </tbody>

        </table>
      </div>
    </div>

</div>

<?php
require 'src/admin/vista/templates/footer.php';
require_once 'src/admin/vista/seccion/seccionFichaJS.php'
 ?>
