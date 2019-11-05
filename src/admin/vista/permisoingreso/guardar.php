<?php
$pagina = 'Permiso Ingreso Ficha | Nuevo';
require 'src/admin/vista/templates/header.php';
?>

<div class="my-5">

    <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

        <h3 class="text-center my-3">Nuevo Permiso Ingreso Ficha</h3>
        <hr>
        <div id="ctn-msg"></div>

        <form class="form-horizontal" action="<?php echo constant('URL'); ?>miad/permiso/guardar" method="post"  id="form-permiso">

            <div class="form-group">

                <label for="tipoficha" class="control-label">Seleccione un tipo de ficha</label>
                <select name="tipoficha" class="form-control" id="cmbFichas" onchange="getPeriodos(this)">
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

            <div class="form-group" style="display: none;" id="form-periodo">
                <label for="periodo" class="control-label">Seleccione un periodo:</label>
                <select class="form-control" name="periodo" id="cmbPeriodos">
                </select>
            </div>

            <div class="form-row">
                <div class="col">
                    <div class="form-group">
                        <label for="fechaInicio" class="control-label">Fecha Inicio</label>
                        <input type="date" name="fechaInicio" value="" class="form-control" id="inInicio" required>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="fechaFin" class="control-label">Fecha Fin</label>
                        <input type="date" name="fechaFin" value="" class="form-control" id="inFin" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input class="btn btn-success btn-block" type="submit" name="guardar" value="Guardar" id="btnGuardar" onclick="guardarPermiso()">
            </div>

        </form>

    </div>
</div>

<?php
require 'src/admin/vista/templates/footer.php';
?>


<script type="text/javascript">
  // Direccion de la API para la peticion.
  const URLPCMBPERIODO = URLAPI + 'v1/periodo/cmbguardar/';

  const FORM_PERMISO = document.querySelector('#form-permiso');
  const URLPG = '<?php echo constant('URL'); ?>miad/permiso/guardar';

  /*const CTN_MSG = document.querySelector('#ctn-msg');*/

  FORM_PERMISO.addEventListener('submit', (e) => {
    e.preventDefault();
  });

  function guardarPermiso() {
    let formdata = new FormData(FORM_PERMISO);
    formdata.append('guardar', 'true');

    if (formdata.get('periodo') != '0'
    && formdata.get('tipoficha') != '0'
    && formdata.get('fechaInicio') != ''
    && formdata.get('fechaFin') != ''
    ) {

      if (fechaValida(formdata.get('fechaInicio'), formdata.get('fechaFin'))) {
        fetch(URLPG, {
          method: 'POST',
          body: formdata
        })
        .then(res => res.json())
        .then(data => {
          console.log(data);
          if (data.statuscode == 200) {
            msgSuccess('Guardamos correctamente');
            FORM_PERMISO.querySelector('select[name="periodo"]').value = 0;
            FORM_PERMISO.querySelector('select[name="tipoficha"]').value = 0;
            FORM_PERMISO.querySelector('input[name="fechaInicio"]').value = '';
            FORM_PERMISO.querySelector('input[name="fechaFin"]').value = '';

            // Ocultamos el combo de periodos
            FORMPERIODO.style.display = 'none';
          }
        })
        .catch(e =>{
          msgError('Error al guardar el formulario. \n' + e);
        });
      }

    }

  }

  function fechaValida(fechaInicio, fechaFin) {
    let FI = new Date(fechaInicio);
    let FF = new Date(fechaFin);
    if(FI > FF) {
      msgError('LA FECHA DE INICIO NO PUEDE SER MAYOR A LA FECHA DE FIN');
      return false;
    }
    return true;
  }

  const FORMPERIODO = document.querySelector('#form-periodo');

  function getPeriodos(cmb) {
    switch (cmb.value) {
      case '1':
        FORMPERIODO.style.display = 'block';
        cargarPeriodos(1);
        break;
      case '2':
        FORMPERIODO.style.display = 'block';
        cargarPeriodos(2);
        break;
      default:
        FORMPERIODO.style.display = 'none';
        break;
    }
  }

  function cargarPeriodos(idTipoFicha) {
    fetch(URLPCMBPERIODO + idTipoFicha)
    .then(res => res.json())
    .then(data => {
      if (data.statuscode == '200') {
        llenarCmbPeriodos(data.items);
      } else {
        msgError('No obtuvimos periodos vuelva a seleccionar el tipo de ficha.');
      }
    })
  }

  const CMBPERIODOS = document.querySelector('#cmbPeriodos');

  function llenarCmbPeriodos(items) {
    while (CMBPERIODOS.firstChild) {
      CMBPERIODOS.removeChild(CMBPERIODOS.firstChild);
    }

    let opt = document.createElement('option');
    opt.appendChild(document.createTextNode('Seleccione'));
    CMBPERIODOS.appendChild(opt);

    items.forEach(i => {
      let c = document.createElement('option');
      c.value = i.id_prd_lectivo;
      c.appendChild(document.createTextNode(i.prd_lectivo_nombre));
      CMBPERIODOS.appendChild(c);
    });
  }

</script>
