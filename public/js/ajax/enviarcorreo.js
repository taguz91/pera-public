
const FORM_CORREO = document.querySelector('#form-correo');

function enviar(id, correo) {
  let fila = document.querySelector('#fila-'+id);

  FORM_CORREO.querySelector('input[name="idpersona"]').value = id;
  FORM_CORREO.querySelector('input[name="correo"]').value = correo;
  getPermisos(id);
}

const CMB_PERMISOS = document.querySelector('#cmbPermisos');

function getPermisos(idPersona) {
  fetch(URLAPIPERMISO + idPersona)
  .then(res => res.json())
  .then(data => {
    if(data.statuscode == '200') {
      llenarCmbPermisos(data.items);
    }
  })
  .catch( err => {
    msgError('Error al cargar los permisos. \n' + e);
  });
}

function llenarCmbPermisos(items) {
  // Borramos datos anteriores
  while (CMB_PERMISOS.firstChild) {
    CMB_PERMISOS.removeChild(CMB_PERMISOS.firstChild);
  }

  items.forEach(i => {
    let c = document.createElement('option');
    c.value = i.id_permiso_ingreso_ficha;
    c.appendChild(document.createTextNode(i.tipo_ficha  + ' ' + i.prd_lectivo_nombre));
    CMB_PERMISOS.appendChild(c);
  });
}

function enviarCorreo() {
  let form = new FormData(FORM_CORREO);

  if (
    form.get('permiso') != '0'
    && form.get('correo') != ''
    && form.get('idpersona') != ''
  ) {
    fetch(URLAPI + 'v1/correo/uno', {
      method: 'POST',
      body: form
    })
    .then(res => res.json())
    .then(data => {
      console.log(data);
    })
    .catch(e => {
      msgError('Error al enviar el correo. \n' + e);
    })
  } else {
    msgError('No tenemos  la informacion requerida.');
  }
}
