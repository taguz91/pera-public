<?php
require 'src/vista/templates/nav.php';
require_once 'src/datos/persona.php';
 ?>
<div class="container my-5">
  <div class="col-md-8 mx-auto">
    <form class="form-horizontal" action="#" method="post">

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Identificacion:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col">

          <div class="form-group">

            <label for="" class="control-label d-block">Tipo identificacion:</label>

            <div class="p-1">

              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline1">Cedula</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                <label class="custom-control-label" for="customRadioInline2">Pasaporte</label>
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Primer nombre:</label>
            <input class="form-control" type="text" name=""
            value="<?php echo isset($U->primerNombre) ? $U->primerNombre : ''; ?>">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Segundo nombre:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>
      </div>


      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Primer apellido:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Segundo apellido:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>
      </div>


      <div class="form-row">

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Fecha nacimiento:</label>
            <input class="form-control" type="date" name="" value="">
          </div>
        </div>

        <div class="col">

          <label for="" class="control-label">Categoria migratoria:</label>


        </div>

      </div>

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Telefono</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Celular:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>
      </div>

      <div class="form-row">

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Tipo Sangre</label>

            <select class="form-control" name="">
              <?php echo llenarCmb($cmbTipoSangre); ?>
            </select>

          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Genero:</label>

            <select class="form-control" name="">
              <?php echo llenarCmb($cmbGenero); ?>
            </select>

          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Sexo:</label>

            <select class="form-control" name="">
              <?php echo llenarCmb($cmbSexo); ?>
            </select>

          </div>
        </div>

        <div class="col">
          <label for="" class="control-label">Estado civil:</label>

          <select class="form-control" name="">
            <?php echo llenarCmb($cmbEstadoCivil);?>
          </select>

        </div>

      </div>


      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Etnia:</label>

            <select class="form-control" name="">
              <?php echo llenarCmb($cmbEtnia); ?>
            </select>

          </div>
        </div>

        <div class="col">
          <label for="" class="control-label">Idioma raiz:</label>

          <select class="form-control" name="">
            <?php echo llenarCmb($cmbIdioma);?>
          </select>

        </div>

        <div class="col">
          <label for="" class="control-label">Idioma:</label>

          <select class="form-control" name="">
            <?php echo llenarCmb($cmbIdioma);?>
          </select>

        </div>

      </div>

      <div class="form-row">

        <div class="col">
          <label for="" class="control-label">Tipo discapacidad:</label>

          <select class="form-control" name="">
            <?php echo llenarCmb($cmbTipoDiscapacidad);?>
          </select>

        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Porcentaje discapacidad</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Carnet Conadis:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

      </div>


      <div class="form-row">

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Calle principal:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Calle secundaria:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

      </div>

      <div class="form-row">

        <div class="col-3">
          <div class="form-group">
            <label for="" class="control-label">Numero Casa:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col-5">
          <div class="form-group">
            <label for="" class="control-label">Sector:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>

        <div class="col">
          <label for="" class="control-label">Tipo residencia:</label>

          <select class="form-control" name="">
            <?php echo llenarCmb($cmbTipoResidencia);?>
          </select>
        </div>

      </div>

      <div class="form-row">
        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Referencia:</label>
            <input class="form-control" type="text" name="" value="">
          </div>
        </div>
      </div>

    </form>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4 mx-auto">
      <button class="btn btn-primary" type="button" name="button" onclick="actualizar('<?php echo constant('URL').'api/v1/persona/actualizar/548' ?>')">Actualizar Prueba</button>
    </div>
  </div>
</div>

<?php
require 'src/vista/templates/copy.php';
?>


<script type="text/javascript">
  function actualizar(url){

    var data = new FormData();
    data.append('actualizar', 'true');
    data.append('valor', 'GUSTAVO');
    data.append('columna', 'persona_primer_nombre');
    
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
