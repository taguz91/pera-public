<?php
require 'src/vista/templates/nav.php';
require_once 'src/datos/persona.php';
 ?>

<script type="text/javascript">

 function accionesCMB(url, cmb){
   if(cmb != null){
     cmb.forEach(c => {
       c.addEventListener('change', function(){
         if(c.value != 'Seleccione' && c.value != ''){
           editarInfo(url, c.name, c.value);
         }
       });
     })
   }
 }

 function accionesTXT(url, txt){
   if(txt != null){
     txt.forEach(i => {
       i.onblur =  function(){
         if(this.value.length > 0){
           editarInfo(url, i.name, i.value);
         }
       }
     });
   }
 }

 function accionesCBX(url, cbx){
   if(cbx != null){
     cbx.forEach(c => {
       c.addEventListener('change', function(){
         if(c.select){
           editarInfo(url, c.name, c.value);
         }
       });
     });
   }
 }

 function editarInfo(url, col, val){
   var data = new FormData();
   data.append('actualizar', 'true');
   data.append('valor', val);
   data.append('columna', col);

   fetch(url, {
     method: 'POST',
     body: data
   })
   .then(res => res.json())
   .then(data => {
     console.log(data);
   }).catch(err => {
     console.log('Obtuvimos un error: '+err);
   });;
 }
</script>

<div class="container my-4">

  <div class="row">
    <div class="col-md-10 col-lg-8 mx-auto">
      <div class="alert alert-primary" role="alert">
        El formulario se guarda automaticamente.
      </div>
    </div>
  </div>

  <div class="col-md-10 col-lg-8 mx-auto">
    <form class="form-horizontal" action="#" method="post">

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Identificación:</label>
            <input disabled class="form-control txt" type="text" name="persona_identificacion"
            value="<?php echo isset($persona['persona_identificacion']) ? $persona['persona_identificacion'] : ''; ?>">
          </div>
        </div>

        <div class="col">

          <div class="form-group">

            <label for="" class="control-label d-block">Tipo de Identificación:</label>

            <div class="p-1">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" <?php
                if(strlen($persona['persona_identificacion']) == 10){echo "checked";}
                ?>>
                <label class="custom-control-label" for="customRadioInline1">Cédula</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input" <?php
                if(strlen($persona['persona_identificacion']) > 10){echo "checked";}  ?>>
                <label class="custom-control-label" for="customRadioInline2">Pasaporte</label>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Primer Nombre:</label>
            <input class="form-control txt" type="text" name="persona_primer_nombre"
            value="<?php echo isset($persona['persona_primer_nombre']) ? $persona['persona_primer_nombre'] : ''; ?>">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Segundo Nombre:</label>
            <input class="form-control txt" type="text" name="persona_segundo_nombre"
            value="<?php echo isset($persona['persona_segundo_nombre']) ? $persona['persona_segundo_nombre'] : ''; ?>">
          </div>
        </div>
      </div>


      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Primer Apellido:</label>
            <input class="form-control txt" type="text" name="persona_primer_apellido"
            value="<?php echo isset($persona['persona_primer_apellido']) ? $persona['persona_primer_apellido'] : ''; ?>">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Segundo Apellido:</label>
            <input class="form-control txt" type="text" name="persona_segundo_apellido"
            value="<?php echo isset($persona['persona_segundo_apellido']) ? $persona['persona_segundo_apellido'] : ''; ?>">
          </div>
        </div>
      </div>


      <div class="form-row">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control-label">Fecha nacimiento:</label>
            <input class="form-control txt" type="date" name="persona_fecha_nacimiento"
            value="<?php echo isset($persona['persona_fecha_nacimiento']) ? $persona['persona_fecha_nacimiento'] : ''; ?>">
          </div>
        </div>

        <div class="col-md-6">

          <label for="" class="control-label">Categoría Migratoria:</label>

          <select class="form-control cmb" name="persona_categoria_migratoria">
            <?php echo llenarCmb($cmbCategoriaMigratoria,
            isset($persona['persona_categoria_migratoria']) ? $persona['persona_categoria_migratoria'] : ''); ?>
          </select>
          <small class="form-text text-muted">
            Seleccione una si es migrante.
          </small>

        </div>

      </div>

      <div class="form-row mt-3 mt-md-0">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Teléfono</label>
            <input class="form-control txt" type="text" name="persona_telefono"
            value="<?php echo isset($persona['persona_telefono']) ? $persona['persona_telefono'] :  ''; ?>">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Celular:</label>
            <input class="form-control txt" type="text" name="persona_celular"
            value="<?php echo isset($persona['persona_celular']) ? $persona['persona_celular'] : ''; ?>">
          </div>
        </div>
      </div>

      <div class="form-row">

        <div class="col-6 col-md-3">
          <div class="form-group">
            <label for="" class="control-label">Tipo de Sangre</label>

            <select class="form-control cmb" name="persona_tipo_sangre">
              <?php echo llenarCmb($cmbTipoSangre,
              isset($persona['persona_tipo_sangre']) ? $persona['persona_tipo_sangre'] : ''); ?>
            </select>

          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="form-group">
            <label for="" class="control-label">Género:</label>

            <select class="form-control cmb" name="persona_genero">
              <?php echo llenarCmb($cmbGenero,
              isset($persona['persona_genero']) ? $persona['persona_genero'] : ''); ?>
            </select>

          </div>
        </div>

        <div class="col-6 col-md-3">
          <div class="form-group">
            <label for="" class="control-label">Sexo:</label>

            <select class="form-control cmb" name="persona_sexo">
              <?php echo llenarCmb($cmbSexo,
              isset($persona['persona_sexo']) ? $persona['persona_sexo'] : ''); ?>
            </select>

          </div>
        </div>

        <div class="col-6 col-md-3">
          <label for="" class="control-label">Estado Civil:</label>

          <select class="form-control cmb" name="persona_estado_civil">
            <?php echo llenarCmb($cmbEstadoCivil,
            isset($persona['persona_estado_civil']) ? $persona['persona_estado_civil'] : '');?>
          </select>

        </div>

      </div>


      <div class="form-row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="" class="control-label">Etnia:</label>

            <select class="form-control cmb" name="persona_etnia">
              <?php echo llenarCmb($cmbEtnia,
              isset($persona['persona_etnia']) ? $persona['persona_etnia'] : ''); ?>
            </select>

          </div>
        </div>

        <div class="col-6 col-md-4">
          <label for="" class="control-label">Idioma Raíz:</label>

          <select class="form-control cmb" name="persona_idioma_raiz">
            <?php echo llenarCmb($cmbIdioma,
            isset($persona['persona_idioma_raiz']) ? $persona['persona_idioma_raiz'] : '');?>
          </select>

        </div>

        <div class="col-6 col-md-4">
          <label for="" class="control-label">Idioma:</label>

          <select class="form-control cmb" name="persona_idioma">
            <?php echo llenarCmb($cmbIdioma,
            isset($persona['persona_idioma']) ? $persona['persona_idioma'] : '');?>
          </select>

        </div>

      </div>

      <?php if (isset($persona['persona_discapacidad']) ? $persona['persona_discapacidad'] : false): ?>
        <div class="form-row mt-3 mt-md-0">

          <div class="col">
            <label for="" class="control-label">Tipo de Discapacidad:</label>

            <select class="form-control cmb" name="persona_tipo_residencia">
              <?php echo llenarCmb($cmbTipoDiscapacidad,
              isset($persona['persona_tipo_residencia']) ? $persona['persona_tipo_residencia'] : '');?>
            </select>

          </div>

          <div class="col">
            <div class="form-group">
              <label for="" class="control-label">Porcentaje de Discapacidad</label>
              <input class="form-control txt" type="text" name="persona_porcenta_discapacidad"
              value="<?php echo isset($persona['persona_porcenta_discapacidad']) ? $persona['persona_porcenta_discapacidad'] : ''; ?>">
            </div>
          </div>

          <div class="col">
            <div class="form-group">
              <label for="" class="control-label">Carnet Conadis:</label>
              <input class="form-control txt" type="text" name="persona_carnet_conadis"
              value="<?php echo isset($persona['persona_carnet_conadis']) ? $persona['persona_carnet_conadis'] : ''; ?>">
            </div>
          </div>

        </div>
      <?php endif; ?>

      <div class="form-row mt-3 mt-md-0">

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control-label">Calle principal:</label>
            <input class="form-control  txt" type="text" name="persona_calle_principal"
            value="<?php echo isset($persona['persona_calle_principal']) ? $persona['persona_calle_principal'] : ''; ?>">
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <label for="" class="control-label">Calle secundaria:</label>
            <input class="form-control txt" type="text" name="persona_calle_secundaria"
            value="<?php echo isset($persona['persona_calle_secundaria']) ? $persona['persona_calle_secundaria'] : ''; ?>">
          </div>
        </div>

      </div>

      <div class="form-row">

        <div class="col-5 col-md-3">
          <div class="form-group">
            <label for="" class="control-label">Numero Casa:</label>
            <input class="form-control txt" type="text" name="persona_numero_casa"
            value="<?php echo isset($persona['persona_numero_casa']) ? $persona['persona_numero_casa'] : ''; ?>">
          </div>
        </div>

        <div class="col-7 col-md-5">
          <div class="form-group">
            <label for="" class="control-label">Sector:</label>
            <input class="form-control txt" type="text" name="persona_sector"
            value="<?php echo isset($persona['persona_sector']) ? $persona['persona_sector'] : ''; ?>">
          </div>
        </div>

        <div class="col-12 col-md-4">
          <label for="" class="control-label">Tipo de Residencia:</label>

          <select class="form-control cmb" name="persona_tipo_residencia">
            <?php echo llenarCmb($cmbTipoResidencia,
            isset($persona['persona_tipo_residencia']) ? $persona['persona_tipo_residencia'] : '');?>
          </select>
        </div>

      </div>

      <div class="form-row mt-3 mt-md-0">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Referencia:</label>
            <input class="form-control txt" type="text" name="persona_referencia"
            value="<?php echo isset($persona['persona_referencia']) ? $persona['persona_referencia'] : ''; ?>">
          </div>
        </div>

      </div>

      <?php if (isset($alumno)): ?>
        <!-- FORMULARIO ALUMNO -->
        <hr>
        <?php include 'src/vista/persona/almn.php' ?>
      <?php endif; ?>


    </form>
  </div>
</div>

<?php
require 'src/vista/templates/copy.php';
?>


<script type="text/javascript">

  const URLPER = '<?php echo constant('URL').'api/v1/persona/actualizar/'.$U->idPersona; ?>';

  const TXTSPER = document.querySelectorAll('.txt');
  const COLSPER = document.querySelectorAll('.cmb');
  accionesTXT(URLPER, TXTSPER);
  accionesCMB(URLPER, COLSPER);

</script>
