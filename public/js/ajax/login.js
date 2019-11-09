const formlogin = document.querySelector('#loginform');
const errorlogin = document.querySelector('#errorlogin');
formlogin.addEventListener('submit', (e) => {
  e.preventDefault();
});

function loguear(url){
  var data = new FormData(formlogin);
  data.append('login', 'true');

  if(data.get('user') != '' && data.get('pass') != ''){
    comprobarLogin(url, data);
  }else{
    errorLogin('No ingreso usuario ni contrasena.');
  }
}

function comprobarLogin(url, data){
  fetch(url, {
    method: 'POST',
    body: data
  })
  .then(res => res.json())
  .then(data => {
    if(data.statuscode  == 200){
      formlogin.submit();
    }else{
      errorLogin(data.mensaje);
    }
  })
  .catch(e =>{
    errorLogin('Errores: ' + e);
  })
}

function errorLogin(msg){
  errorlogin.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <span>` + msg + `</span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button> </div>`;
}
