<?php
require 'src/vista/templates/nav.php';
$var = 'Pepe';
 ?>
<div class="container my-5">
  <div class="col-md-8 mx-auto">
    <form class="form-horizontal" action="#" method="post">

      <div class="form-group">
        <label for="" class="control-label">Nombre</label>
        <input class="form-control" type="text" name="" value="<?php echo isset($U->primerNombre) ? $U->primerNombre : ''; ?>">
      </div>

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
            <input class="form-control" type="text" name="" value="">
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
            <label for="" class="control-label">Genero</label>

            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio1">Hombre</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">Mujer</label>
            </div>

          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="" class="control-label">Sexo:</label>

            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio1">Femenino</label>
            </div>
            <div class="custom-control custom-radio">
              <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio2">Masculino</label>
            </div>

          </div>
        </div>

        <div class="col">
          <label for="" class="control-label">Estado civil:</label>

          <select class="form-control" name="">
            <option value="0">Seleccione</option>
            <option value="1">Casado</option>
            <option value="2">Soltero</option>
          </select>
        </div>

      </div>

    </form>
  </div>
</div>
<?php
function getString($o){
  return isset($o) ? $o : '';
}

require 'src/vista/templates/copy.php';
?>
