<?php
$pagina = 'Envío de correos';
require 'src/admin/vista/templates/header.php';
?>
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/scroll.css">

<div class="my-5">

  <div class="col-10 mx-auto border rounded shadow">

    <h3 class="text-center my-3">Envío de correos masivos</h3>
    <hr>
    <div id="ctn-msg"></div>

    <form class="form-horizontal" action="#" method="post" id="form-correos">


      <div class="form-row">

        <div class="col">
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
            <label for="">Asunto:</label>
            <input type="text" name="asunto" value="" class="form-control" placeholder="Asunto del correo." required>
          </div>

          <div class="form-group">
            <label for="">Correo usar:</label>
            <input type="email" name="correousar" value="" class="form-control" placeholder="Correo que usaremos para enviar los correos." required>
          </div>

          <div class="form-group">
            <label for="">Password usar:</label>
            <input type="password" name="passwordusar" value="" class="form-control" placeholder="Contraseña para el correo." required>
          </div>

        </div>

        <div class="col">

          <div class="form-group">
            <label for="" class="">Agregar correos de los alumnos:</label>
            <div class="btn-group btn-block" role="group">
              <input class="btn btn-info  border-left" type="button" value="Agregar " onclick="agregarCorreos()">
            </div>
          </div>

          <div class="form-group">
            <label for="">Mensaje:</label>
            <textarea name="mensaje" class="form-control" rows="6" cols="5" placeholder="Escriba el correo que enviara." required></textarea>
          </div>


          <div class="form-group">
            <label for="">Archivo adjunto:</label>
            <input type="file" name="adjunto">
          </div>

        </div>

      </div>

      <div class="form-group">
        <input class="btn btn-success " type="submit" value="Enviar Correos"  onclick="enviarCorreos()">
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
  const URLCORREOSAPI = URLAPI + 'v1/periodo/nomatriculados/';
</script>

<script type="text/javascript">

const CMB_PERIODOS = document.querySelector('#cmbPeriodos');


function agregarCorreos() {
  if (CMB_PERIODOS.value > 0) {
    getPersonas(CMB_PERIODOS.value);
  } else {
    msgError('Necesitamos que seleccione un periodo y un ciclo.');
  }
}

// Es para consultar en el API
function getPersonas(idperiodo){
  fetch(URLCORREOSAPI + idperiodo)
  .then(res => res.json())
  .then(data => {
    if (data.statuscode == 200) {
      llenarTblPersonas(data.items);
    } else {
      msgError(data.mensaje)
    }
  })
  .catch(err => {
    msgError('Error: \n' + err);
  })
}

const TBODYPERSONAS = document.querySelector('#tb-personas');
let num = 1;
function llenarTblPersonas(items) {

  items.forEach(i => {
    agregarFila(i)
  });

}

function agregarFila(i) {
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

let correos = '';

function enviarCorreos(){
  let form = new FormData(FORMCORREOS);
  if (form.get('mensaje') != ''
  && form.get('correousar') != ''
  && form.get('passwordusar') != ''
  && form.get('asunto')
  ) {
    let filas = TBODYPERSONAS.rows;
    for (var i = 0; i < filas.length; i++) {
      let id = filas[i].cells[1].innerHTML;
      let correo = filas[i].cells[3].innerHTML;

      if (!correos.includes(correo)) {
        correos += correo + ';;';
        enviar(filas[i].cells[0], form, id, correo);
      } else {
        filas[i].cells[0].classList.add('bg-warning', 'text-white');
      }
    }
    msgSuccess('En la tabla se muestra de color verde todos los correos que se enviaron, de color rojo los que no fueron enviados y de color amarillo los que son correos repetidos.');
    num = 1
  } else {
    msgError('No tenemos todo lo necesario.');
  }

}

function enviar(fila, form, idPersona, correo){
  form.append('correoenviar', correo);

  fetch(URLAPI + 'v1/correo/masivo', {
    method: 'POST',
    body: form
  })
  .then(res => res.json())
  .then(data => {
    if(data.statuscode == 200){
      console.log(data.mensaje);
      fila.classList.add('bg-success', 'text-white');
    } else {
      msgError(data.mensaje + '\nNo enviamos el correo a: ' + correo);
      fila.classList.add('bg-danger', 'text-white');
    }
  })
  .catch(e => {
    msgError('No enviamos el correo a: ' + correo + ' \n Error: ' + e);
    return false;
  });

  return true;
}

function recetearValores() {
  CMB_PERIODOS.value = 0;
  while (CMB_CICLOS.firstChild) {
    CMB_CICLOS.removeChild(CMB_CICLOS.firstChild);
  }
  FORMCORREOS.querySelector('textarea[name="mensaje"]').value = '';
}

// Buscador
const TXT_BUSQUEDA = document.querySelector('#busqueda');

function buscar() {
  let iden = TXT_BUSQUEDA.value;
  if (iden.length > 6) {
    console.log(URLAPI + 'v1/persona/correo?identificacion=' + iden);
    fetch(URLAPI + 'v1/persona/correo?identificacion=' + iden)
    .then(res => res.json())
    .then(data => {
      if(data.statuscode == 200){
        data.items.forEach(i => {
          agregarFila(i)
        });
        TXT_BUSQUEDA.value = '';
      } else {
        msgError(data.mensaje);
      }
    })
    .catch(e => {
      msgError('Error: ' + e);
    });
  }
}


</script>

<?php
require 'src/admin/vista/templates/footer.php';
?>
