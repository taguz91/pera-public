<?php
$pagina = 'Envío de correos';
require 'src/admin/vista/templates/header.php';
?>
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/scroll.css">

<div class="my-5">

  <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

    <h3 class="text-center my-3">Envío de correos masivos</h3>
    <hr>
    <div id="ctn-msg"></div>

    <form class="form-horizontal" action="#" method="post" id="form-correos">

      <div class="form-group">
        <label for="" class="control-label">Seleccione un periodo:</label>
        <select class="form-control" name="periodo" required id="cmbPeriodos">
          <option value="0">Periodos</option>
          <?php
          if (isset($periodos)) {
            foreach ($periodos as $pr) {
              echo '<option value="' . $pr['id_prd_lectivo'] . '">' . $pr['prd_lectivo_nombre'] . '</option>';
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
        <label for="">Asunto:</label>
        <input type="text" name="asunto" value="" class="form-control" placeholder="Asunto del correo." required>
      </div>

      <div class="form-group">
        <label for="">Mensaje:</label>
        <textarea name="mensaje" class="form-control" rows="10" cols="5" placeholder="Escriba el correo que enviara." required></textarea>
      </div>

      <div class="form-group">
        <label for="">Archivo adjunto:</label>
        <input type="file" name="adjunto">
      </div>

      <div class="form-group">
        <label for="">Correo usar:</label>
        <input type="email" name="correousar" value="" class="form-control" placeholder="Correo que usaremos para enviar los correos." required>
      </div>

      <div class="form-group">
        <label for="">Password usar:</label>
        <input type="password" name="passwordusar" value="" class="form-control" placeholder="Contraseña para el correo." required>
      </div>

      <div class="form-group">
        <input class="btn btn-info" type="button" value="Agregar" onclick="agregarCorreos()">

        <input class="btn btn-success " type="submit" value="Enviar"  onclick="enviarCorreos()">
      </div>

    </form>

  </div>


  <div class="card shadow my-4">
    <div class="card-header py-3">

      <h6 class="m-0 font-weight-bold text-primary">
        Personas extras para enviar fichas. (Solo se busca por identificación)
      </h6>

      <div class="row my-2">
        <div class="col">
          <div class="mb-1">
            <input class="form-control" type="number" placeholder="Buscar" id="busqueda">
          </div>
        </div>

        <div class="col-12 col-sm-2">
          <button class="btn btn-info" type="button" name="buscar" onclick="buscar()">Agregar</button>
        </div>
      </div>

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

<script type="text/javascript">
  const URLCORREOSAPI = URLAPI + 'v1/alumno/correos/';
</script>

<script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/ajax/correosmasivosalumnos.js?v=3"></script>

<?php
require 'src/admin/vista/templates/footer.php';
?>
