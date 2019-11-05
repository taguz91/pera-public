<?php
$pagina = 'Envío de correos';
require 'src/admin/vista/templates/header.php';
?>
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/scroll.css">

<div class="my-5">

  <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

    <h3 class="text-center my-3">Envío de correos</h3>
    <hr>
    <div id="ctn-msg"></div>

    <form class="form-horizontal" action="#" method="post" id="form-correos">

      <div class="form-group">
        <label for="permiso" class="control-label">Seleccione un Permiso:</label>
        <select class="form-control" name="permiso" required id="cmbPermisos">
          <option value="0">Permisos</option>

          <?php
          if (isset($permisos)) {
            foreach ($permisos as $pf) {
              echo '<option value="' . $pf['id_permiso_ingreso_ficha'] . '">' . $pf['tipo_ficha'] . ' - ' . $pf['prd_lectivo_nombre'] . '</option>';
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
        <label for="">Correo:</label>
        <textarea name="mensaje" class="form-control" rows="5" cols="5" placeholder="Escriba el correo que enviara." required></textarea>
      </div>

      <div class="form-group">
        <input class="btn btn-success btn-block" type="submit" name="guardar" value="Guardar" id="btnGuardar" onclick="enviarCorreos()">
      </div>

    </form>

  </div>


  <div class="card shadow my-4">
    <div class="card-header py-3">
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

const CMB_PERMISOS = document.querySelector('#cmbPermisos');
const CMB_CICLOS = document.querySelector('#cmbCiclos');

CMB_PERMISOS.addEventListener('change', function(){
  let permiso = CMB_PERMISOS.value;
  if (permiso > 0) {
    getCursos(permiso);
  }
});

CMB_CICLOS.addEventListener('change', function(){
  if (CMB_CICLOS.value > 0 && CMB_PERMISOS.value > 0) {
    getPersonas(CMB_PERMISOS.value, CMB_CICLOS.value);
  }
});


function getCursos(idPermiso) {
  fetch(URLAPI + 'v1/periodo/ciclos/' + idPermiso)
  .then(res => res.json())
  .then(data => {
    if(data.statuscode == '200') {
      llenarCiclos(data.items);
    } else {
      console.log(data);
    }
  })
  .catch( err => {
    console.log('Error: ' + err);
  });
}


function llenarCiclos(items) {
  while (CMB_CICLOS.firstChild) {
    CMB_CICLOS.removeChild(CMB_CICLOS.firstChild);
  }
  let opt = document.createElement('option');
  opt.appendChild(document.createTextNode('Ciclos'));

  CMB_CICLOS.appendChild(opt);

  items.forEach(i => {
    let c = document.createElement('option');
    c.value = i.ciclo;
    c.appendChild(document.createTextNode(i.ciclo));
    CMB_CICLOS.appendChild(c);
  });
}

function getPersonas(idPermiso, ciclo){
  fetch(URLAPI + 'v1/personaficha/correos/' + idPermiso + '-' + ciclo)
  .then(res => res.json())
  .then(data => {
    if (data.statuscode == 200) {
      llenarTblPersonas(data.items);
    } else {
      msgError(data.mensaje)
    }

  })
  .catch(err => {
    msgError('Error: ' + err);
  })
}

const TBODYPERSONAS = document.querySelector('#tb-personas');
function llenarTblPersonas(items) {
  while (TBODYPERSONAS.firstChild) {
    TBODYPERSONAS.removeChild(TBODYPERSONAS.firstChild);
  }

  num = 1;

  items.forEach(i => {
    let r = document.createElement('tr');
    let tp = document.createElement('th')
    let tid = document.createElement('td')
    let tn = document.createElement('td');
    let tc = document.createElement('td');
    let tb = document.createElement('td');
    let b = document.createElement('button');

    //tid.appendChild(document.createTextNode(i.id_persona))
    agregarTexto(tp, num);
    agregarTexto(tid, i.id_persona);
    agregarTexto(tn, i.persona_nombre);
    agregarTexto(tc, i.persona_correo);
    agregarTexto(b, 'Remover');
    // Clases del boton
    b.classList.add('btn', 'btn-danger', 'btn-sm');
    b.addEventListener('click', function() {
      removerRow(r);
    });
    tb.appendChild(b);

    r.appendChild(tp)
    r.appendChild(tid);
    r.appendChild(tn);
    r.appendChild(tc)
    r.appendChild(tb);

    TBODYPERSONAS.appendChild(r);
    num++;
  });

}

function removerRow(row){
  TBODYPERSONAS.removeChild(row);
}

function agregarTexto(ctn, value){
  ctn.appendChild(document.createTextNode(value))
}

// Al guardar
const FORMCORREOS = document.querySelector('#form-correos');

FORMCORREOS.addEventListener('submit', (e) => {
  e.preventDefault();
});

function enviarCorreos(){
  let form = new FormData(FORMCORREOS);
  if (form.get('permiso') != '0'
  && form.get('mensaje') != ''
  ) {
    let filas = TBODYPERSONAS.rows;
    for (var i = 0; i < filas.length; i++) {
      let id = filas[i].cells[1].innerHTML;
      let correo = filas[i].cells[3].innerHTML;
      console.log('ID: ' + id + ' Correo: ' + correo);

      let res = enviar(form, id, correo);
      if (res) {
        filas[i].cells[0].classList.add('bg-success', 'text-white');
      } else {
        filas[i].cells[0].classList.add('bg-danger', 'text-white');
      }
    }
    msgSuccess('Enviamos los correos. En la tabla se muestra de color verde todos los correos que se enviaron, y de color rojo los que no fueron enviados.');
    recetearValores();
  } else {
    msgError('No tenemos todo lo necesario.');
  }

}

function enviar(form, idPersona, correo){
  form.append('correo', correo);
  form.append('idpersona', idPersona);

  fetch(URLAPI + 'v1/correo/uno', {
    method: 'POST',
    body: form
  })
  .then(res => res.json())
  .then(data => {
    if(data.statuscode == 200){
      return true;
    } else {
      msgError('No enviamos el correo a: ' + correo);
      return false;
    }
  })
  .catch(e => {
    msgError('No enviamos el correo a: ' + correo + ' \n Error: ' + e);
    return false;
  });

  return true;
}

function recetearValores() {
  CMB_PERMISOS.value = 0;
  while (CMB_CICLOS.firstChild) {
    CMB_CICLOS.removeChild(CMB_CICLOS.firstChild);
  }
  FORMCORREOS.querySelector('textarea[name="mensaje"]').value = '';
}

</script>


<?php
require 'src/admin/vista/templates/footer.php';
?>
