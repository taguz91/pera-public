

const CMB_PERIODOS = document.querySelector('#cmbPeriodos');
const CMB_CICLOS = document.querySelector('#cmbCiclos');

CMB_PERIODOS.addEventListener('change', function(){
  let periodo = CMB_PERIODOS.value;
  if (periodo > 0) {
    getCursos(periodo);
  }
});


function agregarCorreos() {
  if (CMB_CICLOS.value > 0 && CMB_PERIODOS.value > 0) {
    getPersonas(CMB_PERIODOS.value, CMB_CICLOS.value);
  } else {
    msgError('Necesitamos que seleccione un periodo y un ciclo.');
  }
}

function agregarCorreosPeriodo() {
  if (CMB_PERIODOS.value > 0) {
    getPersonas(CMB_PERIODOS.value);
  } else {
    msgError('Necesitamos que seleccione un periodo.');
  }
}

function getCursos(idperiodo) {
  fetch(URLAPI + 'v1/periodo/ciclos/?idPeriodo=' + idperiodo)
  .then(res => res.json())
  .then(data => {
    if(data.statuscode == '200') {
      llenarCiclos(data.items);
    } else {
      msgError(data.mensaje);
    }
  })
  .catch( err => {
    msgError('Error: \n' + err);
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

// Es para consultar en el API
function getPersonas(idperiodo, ciclo){
  fetch(URLCORREOSAPI + idperiodo + '-' + ciclo)
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
    num = 1;
    correos = '';
  } else {
    msgError('No tenemos todo lo necesario.');
  }

}

function enviar(fila, form, idPersona, correo){
  form.append('correoenviar', correo);
  console.log(URLAPI + 'v1/correo/masivo');
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
