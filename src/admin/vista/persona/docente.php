<?php
$pagina  = 'Persona';
require 'src/admin/vista/templates/header.php';
 ?>

<div class="card shadown mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col">
        <h6 class="m-0 font-weight-bold text-primary">
          Personas  | Docentes
        </h6>
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
            <th scope="col">Pasaporte / Cedula</th>
            <th scope="col">Nombre</th>
            <th scope="col">Telefono</th>
            <th scope="col">Celular</th>
            <th scope="col">Correo</th>
            <th scope="col">Enviar</th>
          </tr>
        </thead>

        <tbody>

          <?php if (isset($personas)): ?>
            <?php foreach ($personas as $p): ?>

              <tr id="fila-<?php echo $p['id_persona']; ?>">

                <td><?php echo $p['persona_identificacion']; ?></td>
                <td><?php echo $p['persona_primer_nombre'] . ' '
                .$p['persona_segundo_nombre'] . ' '
                .$p['persona_primer_apellido'] . ' '
                .$p['persona_segundo_apellido']; ?></td>
                <td><?php echo $p['persona_telefono']; ?></td>
                <td><?php echo $p['persona_celular']; ?></td>
                <td><?php echo $p['persona_correo']; ?></td>
                <!--
                <td><a href="<?php //echo constant('URL').'miad/correo/enviar?idpersona='.$p['id_persona'].'&correo='.$p['persona_correo']; ?>">Enviar</a></td>
              -->
                <td>
                  <button class="btn btn-primary btn-sm" type="button"
                  onclick="enviar(
                  <?php echo $p['id_persona']; ?>,
                  '<?php echo $p['persona_correo'] ?>'
                  )" data-toggle="modal" data-target="#enviar-correo">Enviar</button>
                </td>

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

<script type="text/javascript">
  const URLAPIPERMISO = URLAPI + 'v1/permiso/docente/';
</script>

<?php
// Modal
require 'src/admin/vista/persona/enviarcorreo.php';
require 'src/admin/vista/templates/footer.php';
 ?>
