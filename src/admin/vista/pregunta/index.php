<?php
$pagina = 'Preguntas Ficha';
require_once 'src/admin/controlador/preguntaficha/preguntaFichaAJAX.php';
require 'src/admin/vista/templates/header.php';
require_once 'src/admin/vista/pregunta/insertar.php';
require_once 'src/admin/vista/pregunta/eliminar.php';
require_once 'src/admin/vista/pregunta/actualizar.php';
 ?>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Todas las preguntas ingresadas
        </h6>
      </div>
      <div class="col-4 col-lg-2">
        <button type="button" class="btn btn-success btn-block insertarBtn" data-toggle='modal' data-target='#insertarPregunta' id="insertarPregunta">
          Nuevo
        </button>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col">
        <div class="active-cyan-4 mb-2">
          <input class="form-control" type="text" placeholder="Buscar..." aria-label="Search" id="busquedaP" name="busqueda" value="<?php if(isset($key)){echo $key;} ?>" >
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
            <th scope="col">Seccion</th>
            <th scope="col">Pregunta</th>

            <th style="display:none;">cols</th>
            <th style="display:none;">cols</th>
            <th style="display:none;">cols</th>
            <th style="display:none;">cols</th>
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
            if (isset($preguntas)) {
              foreach($preguntas as $pregunta){
                echo "<tr idQuiz='{$pregunta[0]}'>
                <th  scope='row'>{$pregunta[0]}</th>
                <td>{$pregunta[1]}</td>
                <td >{$pregunta[2]}</td>
                <td style='display:none;'>{$pregunta[3]}</td>
                <td style='display:none;'>{$pregunta[4]}</td>
                <td style='display:none;'>{$pregunta[6]}</td>
                <td style='display:none;'>{$pregunta[7]}</td>
                <td style='display:none;'>{$pregunta[8]}</td>
                <td style='display:none;'>{$pregunta[9]}</td>
                <td>
                  <button type='submit' class='btn btn-primary actualizarBtnP'
                  data-toggle='modal' data-target='#actualizarPregunta'>Actualizar
                  </button>
                </td>
                <!--
                <td>
                  <button type='button' class='btn btn-danger eliminarBtnP'
                  data-toggle='modal' data-target='#eliminarPregunta'>
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
require_once 'src/admin/vista/pregunta/preguntaFichaJS.php';
 ?>
