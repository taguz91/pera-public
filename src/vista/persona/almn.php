<?php require_once 'src/datos/alumno.php'; ?>

<div class="form-row">

  <div class="col-md-4">
    <label for="" class="control-label">Tipo de colegio:</label>

    <select class="form-control cmb-al" name="alumno_tipo_colegio">
      <?php echo llenarCmb($cmbTipoColegio,
      isset($alumno['alumno_tipo_colegio']) ? $alumno['alumno_tipo_colegio'] : ''); ?>
    </select>
  </div>

  <div class="col-md-5">
    <label for="" class="control-label">Tipo de bachillerato:</label>

    <select class="form-control cmb-al" name="alumno_tipo_bachillerato">
      <?php echo llenarCmb($cmbTipoBachiller,
      isset($alumno['alumno_tipo_bachillerato']) ? $alumno['alumno_tipo_bachillerato'] : ''); ?>
    </select>

  </div>


  <div class="col-md-3">
    <div class="form-group">
      <label for="" class="control-label">Año de graduación:</label>
      <input class="form-control txt-al" type="text" name="alumno_anio_graduacion"
      value="<?php echo isset($alumno['alumno_anio_graduacion']) ? $alumno['alumno_anio_graduacion'] : ''; ?>">
    </div>
  </div>

</div>

<!-- TITULO SUPERIOR -->
<div class="form-row">

  <div class="col-12">
    <div class="form-group">

      <label for="" class="control-label d-block">Tiene titulo de educación superior:</label>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="cr-educacion-superior-si" name="alumno_educacion_superior" class="custom-control-input cbx-al cbx-al" value="true"
        <?php
        if($alumno['alumno_educacion_superior']){echo "checked";}
        ?>>
        <label class="custom-control-label" for="cr-educacion-superior-si">Si</label>
      </div>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="cr-educacion-superior-no" name="alumno_educacion_superior" class="custom-control-input cbx-al cbx-al" value="false"
        <?php
        if(!$alumno['alumno_educacion_superior']){echo "checked";}
        ?>>
        <label class="custom-control-label" for="cr-educacion-superior-no">No</label>
      </div>


    </div>
  </div>

  <div class="col-12" id="frm-titulo-superior">
    <div class="form-group">
      <label for="" class="control-label">Titulo superior:</label>
      <input class="form-control txt-al" type="text" name="alumno_titulo_superior"
      value="<?php echo isset($alumno['alumno_titulo_superior']) ? $alumno['alumno_titulo_superior'] : ''; ?>">
    </div>
  </div>

</div>

<!-- PENSION -->
<div class="form-row">
  <div class="col-12">
    <div class="form-group">

      <label for="" class="control-label d-block">Recibe pensión:</label>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="cr-pension-si" name="alumno_pension" class="custom-control-input cbx-al" value="true"
        <?php
        if($alumno['alumno_pension']){echo "checked";}
        ?>>
        <label class="custom-control-label" for="cr-pension-si">Si</label>
      </div>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="cr-pension-no" name="alumno_pension" class="custom-control-input cbx-al" value="false"
        <?php
        if(!$alumno['alumno_pension']){echo "checked";}
        ?>>
        <label class="custom-control-label" for="cr-pension-no">No</label>
      </div>


    </div>
  </div>
</div>

<!-- OCUPACION -->

<div class="form-row">

  <div class="col-12">
    <div class="form-group">

      <label for="" class="control-label d-block">Trabaja:</label>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="cr-trabaja-si" name="alumno_trabaja" class="custom-control-input cbx-al" value="true"
        <?php
        if($alumno['alumno_trabaja']){echo "checked";}
        ?>>
        <label class="custom-control-label" for="cr-trabaja-si">Si</label>
      </div>

      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="cr-trabaja-no" name="alumno_trabaja" class="custom-control-input cbx-al" value="false"
        <?php
        if(!$alumno['alumno_trabaja']){echo "checked";}
        ?>>
        <label class="custom-control-label" for="cr-trabaja-no">No</label>
      </div>


    </div>
  </div>

  <div class="col-12" id="frm-ocupacion">
    <div class="form-group">
      <label for="" class="control-label">Ocupación:</label>
      <input class="form-control txt-al" type="text" name="alumno_ocupacion"
      value="<?php echo isset($alumno['alumno_ocupacion']) ? $alumno['alumno_ocupacion'] : ''; ?>">
    </div>
  </div>

</div>

<!-- NIVEL FOMRACION PADRES -->
<div class="form-row">
  <div class="col-md-6">
    <label for="" class="control-label">Nivel formación padre:</label>

    <select class="form-control cmb-al" name="alumno_nivel_formacion_padre">
      <?php echo llenarCmb($cmbFormacion,
      isset($alumno['alumno_nivel_formacion_padre']) ? $alumno['alumno_nivel_formacion_padre'] : ''); ?>
    </select>

  </div>

  <div class="col-md-6">
    <label for="" class="control-label">Nivel formación madre:</label>

    <select class="form-control cmb-al" name="alumno_nivel_formacion_madre">
      <?php echo llenarCmb($cmbFormacion,
      isset($alumno['alumno_nivel_formacion_madre']) ? $alumno['alumno_nivel_formacion_madre'] : ''); ?>
    </select>

  </div>
</div>


<!-- CONTACTO DE EMERGENCIA -->
<div class="form-row mt-3">
  <div class="col-12">
    <div class="form-group">
      <label for="" class="control-label">Nombre contacto de emergencia:</label>
      <input class="form-control txt-al" type="text" name="alumno_nombre_contacto_emergencia"
      value="<?php echo isset($alumno['alumno_nombre_contacto_emergencia']) ? $alumno['alumno_nombre_contacto_emergencia'] : ''; ?>">
    </div>
  </div>

  <div class="col-md-6">
    <label for="" class="control-label">Parentesco contacto de emergencia:</label>

    <select class="form-control cmb-al" name="alumno_parentesco_contacto">
      <?php echo llenarCmb($cmbParentesco,
      isset($alumno['alumno_parentesco_contacto']) ? $alumno['alumno_parentesco_contacto'] : ''); ?>
    </select>
  </div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="" class="control-label">Número contacto de emergencia:</label>
      <input class="form-control txt-al" type="text" name="alumno_numero_contacto"
      value="<?php echo isset($alumno['alumno_numero_contacto']) ? $alumno['alumno_numero_contacto'] : ''; ?>">
    </div>
  </div>
</div>



<script type="text/javascript">
  const URLALM = '<?php echo constant('URL').'api/v1/alumno/actualizar/'.$alumno['id_alumno']; ?>';

  const TXTALM = document.querySelectorAll('.txt-al');
  const COLSALM = document.querySelectorAll('.cmb-al');
  const CBXALM = document.querySelectorAll('.cbx-al');

  accionesTXT(URLALM, TXTALM);
  accionesCMB(URLALM, COLSALM);
  accionesCBX(URLALM, CBXALM);

  /* TITULO SUPERIOR */
  const FRMTITULO_SUPERIOR = document.querySelector('#frm-titulo-superior');
  const CBXTITULO_SUPERIOR_SI = document.querySelector('#cr-educacion-superior-si');
  const CBXTITULO_SUPERIOR_NO = document.querySelector('#cr-educacion-superior-no');

  CBXTITULO_SUPERIOR_SI.addEventListener('change', function(){
    mostrarTxtTituloSuperior();
  });

  CBXTITULO_SUPERIOR_NO.addEventListener('change', function(){
    mostrarTxtTituloSuperior();
  });

  mostrarTxtTituloSuperior();

  function mostrarTxtTituloSuperior(){
    if(CBXTITULO_SUPERIOR_SI.checked){
      FRMTITULO_SUPERIOR.style.display = 'block';
      console.log('Seleccionado si ');
    }

    if(CBXTITULO_SUPERIOR_NO.checked){
      console.log('Seleccionado no ');
      FRMTITULO_SUPERIOR.style.display = 'none';
    }
  }

  /* OCUPACION */
  const FRMOCUPACION = document.querySelector('#frm-ocupacion');
  const CBXOCUPACION_SI = document.querySelector('#cr-trabaja-si');
  const CBXOCUPACION_NO = document.querySelector('#cr-trabaja-no');

  CBXOCUPACION_SI.addEventListener('change', function(){
    mostrarTxtOcupacion();
  });
  CBXOCUPACION_NO.addEventListener('change', function(){
    mostrarTxtOcupacion();
  });

  function mostrarTxtOcupacion(){
    if(CBXOCUPACION_SI.checked){
      FRMOCUPACION.style.display = 'block';
    }
    if(CBXOCUPACION_NO.checked){
      FRMOCUPACION.style.display = 'none';
    }
  }

</script>
