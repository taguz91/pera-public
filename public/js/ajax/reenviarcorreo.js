
const FORM_CORREO = document.querySelector('#form-correo');

function enviar(idPersonaFicha, correo) {
  FORM_CORREO.querySelector('input[name="idperficha"]').value = idPersonaFicha;
  FORM_CORREO.querySelector('input[name="correo"]').value = correo;
}

function reenviarCorreo() {
  let form = new FormData(FORM_CORREO);
  if (
    form.get('idperficha') != '0'
    && form.get('correo') != ''
  ) {
    fetch(URLAPI + 'v1/correo/editar', {
      method: 'POST',
      body: form
    })
    .then(res => res.json())
    .then(data => {
      if (data.statuscode == 200) {
        msgSuccess(data.mensaje + '\n Puede cerrar el formulario.');
        recetear();
      } else {
        msgError(data.mensaje);
      }
    })
    .catch(e => {
      msgError('Error al enviar el correo. \n' + e);
    })
  } else {
    msgError('No tenemos  la informacion requerida.');
  }
}

function recetear() {
  FORM_CORREO.querySelector('input[name="idperficha"]').value = '';
  FORM_CORREO.querySelector('input[name="correo"]').value = '';
  FORM_CORREO.querySelector('textarea[name="mensaje"]').value = '';
}

function cerrarModal() {
  recetear();
  msgBorrar();
}
