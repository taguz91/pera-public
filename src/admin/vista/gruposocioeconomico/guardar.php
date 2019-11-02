<?php
$pagina = 'Grupo socioeconómico | Ingresar';
require 'src/admin/vista/templates/header.php';
?>

<div class="my-5">

  <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

    <h3 class="text-center my-3">
      Ingreso de un grupo socieconómico
    </h3>

    <form class="form-horizontal" id="form-gp" action="<?php echo constant('URL'); ?>gruposocioeconomico/guardar" method="post">

      <div class="form-group">

        <label for="tipoficha" class="control-label">Seleccione un tipo de ficha</label>
        <select name="tipoficha" class="form-control" id="cmbFichas">
          <option value="0">Fichas</option>
          <?php
          if (isset($tipofichas)) {
            foreach ($tipofichas as $tf) {
              echo '<option value="' . $tf['id_tipo_ficha'] . '">' . $tf['tipo_ficha'] . '</option>';
            }
          }
          ?>
        </select>

      </div>

      <div class="form-group">
        <label for="nombreGrupo" class="control-label">Grupo socioeconomico</label>
        <input type="text" name="gruposocioeconomico" value="" class="form-control" placeholder="Ingrese el nuevo nombre del grupo socieconómico" id="inGrupo">
      </div>

      <div class="form-row">

        <div class="col">
          <div class="form-group">
            <label for="puntajeMin" class="control-label">Puntaje mínimo</label>
            <input type="number" name="puntajeMinimo" value="" min="1" class="form-control" placeholder="Ingrese el nuevo puntaje mínimo" id="inMinimo">
          </div>
        </div>

        <div class="col">
          <div class="form-group">
            <label for="puntajeMax" class="control-label">Puntaje máximo</label>
            <input type="number" name="puntajeMaximo" value="" class="form-control" min="2" placeholder="Ingrese el nuevo puntaje máximo" id="inMaximo">
          </div>
        </div>
      </div>
      <div class="form-row justify-content-center">
        <p class="text-danger text-center" id="err-puntajes" hidden>El puntaje minimo no puede ser mayor o igual que el puntaje maximo!!</p>
      </div>


      <div class="form-group">
        <input class="btn btn-success btn-block" type="submit" name="guardar" value="Guardar" onclick="" id="btnGuardar">
      </div>

    </form>

  </div>
</div>

<?php
require 'src/vista/templates/footer.php';
?>

<script>
  const cmbFicha = $("#cmbFichas");
  const inGrupo = $("#inGrupo");
  const inMinimo = $("#inMinimo");
  const inMaximo = $("#inMaximo");
  const btnGuardar = $("#btnGuardar")
  const errPuntaje = $("#err-puntajes");

  const validaciones = {
    valFicha: false,
    valGrupo: false,
    valPuntaje: false,
  }

  function activarBtn() {
    if (
      validaciones.valFicha &&
      validaciones.valGrupo &&
      validaciones.valPuntaje
    ) {
      btnGuardar.attr("disabled", false);
    } else {
      btnGuardar.attr("disabled", true);
    }
  }

  cmbFicha.change(async (event) => {

    if (cmbFicha.val() == 0) {
      alert("SELECCIONE OTRA OPCION")
      validaciones.valFicha = false;
    } else {
      validaciones.valFicha = true;
    }
    activarBtn();
  });


  inGrupo.keypress(async (event) => {
    if (inGrupo.val() == "") {
      validaciones.valGrupo = false;
    } else {
      validaciones.valGrupo = true;
    }
    activarBtn();
  })

  function validarPuntaje() {

    if (inMaximo.val() != "" && inMinimo != "") {

      if (parseFloat(inMinimo.val()) >= parseFloat(inMaximo.val())) {
        errPuntaje.attr("hidden", false);
        validaciones.valPuntaje = false;
      } else {
        errPuntaje.attr("hidden", true);
        validaciones.valPuntaje = true;
      }

    }


    activarBtn();
  }
  inMinimo.change(async (event) => validarPuntaje());
  inMaximo.change(async (event) => validarPuntaje());
</script>
