<?php
$pagina = 'Permiso Ingreso Ficha | Ingresar';
require 'src/admin/vista/templates/header.php';
?>

<div class="my-5">

    <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

        <h3 class="text-center my-3">Ingreso de Permiso Ficha</h3>

        <div id="ctn-msg"></div>

        <form class="form-horizontal" action="<?php echo constant('URL'); ?>permisoficha/guardar" method="post"  id="form-permiso">

            <div class="form-group">
                <label for="periodo" class="control-label">Seleccione un periodo:</label>
                <select class="form-control" name="periodo" id="cmbPeriodos">
                    <option value="0">Periodos</option>

                    <?php
                    if (isset($periodos)) {
                        foreach ($periodos as $pl) {
                            echo '<option value="' . $pl['id_prd_lectivo'] . '">' . $pl['prd_lectivo_nombre'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">

                <label for="tipoficha" class="control-label">Seleccione un tipo de ficha</label>
                <select name="tipoficha" class="form-control" id="cmbFichas">
                    <option value="0">Fichas</option>
                    <?php
                    //Cargamos todos los periodos de la base de datos
                    if (isset($tipofichas)) {
                        foreach ($tipofichas as $tf) {
                            echo '<option value="' . $tf['id_tipo_ficha'] . '">' . $tf['tipo_ficha'] . '</option>';
                        }
                    }
                    ?>
                </select>

            </div>


            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="fechaInicio" class="control-label">Fecha Inicio</label>
                        <input type="date" name="fechaInicio" value="" class="form-control" id="inInicio">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fechaFin" class="control-label">Fecha Fin</label>
                        <input type="date" name="fechaFin" value="" class="form-control" id="inFin">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input class="btn btn-success btn-block" type="submit" name="guardar" value="Guardar" disabled id="btnGuardar" onclick="guardarPermiso()">
            </div>

        </form>

    </div>
</div>

<?php
require 'src/admin/vista/templates/footer.php';
?>


<script type="text/javascript">

  const FORM_PERMISO = document.querySelector('#form-permiso');
  const URLPG = '<?php echo constant('URL'); ?>permisoficha/guardar';

  /*const CTN_MSG = document.querySelector('#ctn-msg');*/

  FORM_PERMISO.addEventListener('submit', (e) => {
    e.preventDefault();
  })

  function guardarPermiso() {
    let formdata = new FormData(FORM_PERMISO);
    formdata.append('guardar', 'true');

    if (formdata.get('periodo') != '0' && formdata.get('tipoficha') != '0' && formdata.get('fechaInicio') != '' &&
    formdata.get('fechaFin') != ''
    ) {
      fetch(URLPG, {
        method: 'POST',
        body: formdata
      })
      .then(res => res)
      .then(data => {
        msgSuccess('Guardamos correctamente');
        FORM_PERMISO.querySelector('select[name="periodo"]').value = 0;
        FORM_PERMISO.querySelector('select[name="tipoficha"]').value = 0;
        FORM_PERMISO.querySelector('input[name="fechaInicio"]').value = '';
        FORM_PERMISO.querySelector('input[name="fechaFin"]').value = '';
      })
      .catch(e =>{
        console.log('Errores: ' + e);
        msgError('Error al guardar el formulario');
      });

    }

  }

  function fechaValida(fechaInicio, fechaFin) {
    let FF = new Date(fechaInicio);
    let FI = new Date(fechaFin);
    if(FI > FF) {
      msgError('LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA DE FIN');
      return false;
    }
    return true;
  }

</script>


<script>
    let valPeriodos = false;
    let valFichas = false;
    let valFechas = false;

    const btnGuardar = $("#btnGuardar")

    function activarBtn() {
        if (valPeriodos && valFichas && valFechas) {
            btnGuardar.attr("disabled", false)
        } else {
            btnGuardar.attr("disabled", true)
        }
    }

    $("#cmbPeriodos").change(function(event) {
        const cmb = $(this)

        if (cmb.val() == 0) {
            cmb.val(1)
            alert("SELECCIONE UN PERIODO")
            valPeriodos = false;
        } else {
            valPeriodos = true;
        }
        activarBtn();
    });

    $("#cmbFichas").change(function(event) {
        const cmb = $(this)

        if (cmb.val() == 0) {
            cmb.val(1)
            alert("SELECCIONE UNA FICHA")
            valFichas = false;
        } else {
            valFichas = true;
        }
        activarBtn();

    });


    function validarFechas() {
        const fInicio = $("#inInicio").val()
        const fFin = $("#inFin").val()


        if (fFin != "") {
            const fechaInicio = new Date(fInicio)
            const fechaFin = new Date(fFin)

            if (fechaInicio > fechaFin) {

                $(this).val("")
                $("#inFin").val("")
                alert("LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA DE FIN")
                valFechas = false;
            } else {
                valFechas = true;
            }

        }

        if (fInicio == "" || fFin == "") {
            valFechas = false;
        }
        activarBtn();
    }

    $("#inInicio").change(async () => validarFechas());

    $("#inFin").change(async () => validarFechas());
</script>
