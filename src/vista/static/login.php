

<div class="row border bg-white h-75 w-100 my-auto">

  <div class="col-12 col-md-7 col-lg-8  d-flex">
    <div class="m-auto">
      <img src="<?php echo constant('URL'); ?>public/img/icons/banner-ista.png" alt="No encontramos el logo" class="d-block mx-auto" style="width: 90%;">
    </div>
  </div>


  <div class="border-left col-12  col-md-5 col-lg-4 ml-auto px-2">

    <div class="h-100 d-flex">
      <form class="form-horizontal m-auto "
      action="<?php echo constant('URL'); ?>login/ingresar"
      method="post" id="loginform">

        <div class="form-group">
          <label for="txtUsuario" class="control-label">
              Usuario:
          </label>
          <div class="input-group">
            <div class="input-group-append">
              <span class="input-group-text input-icon">
                U
              </span>
            </div>
            <input type="text" class="form-control" id="pera-user" name="user" placeholder="Ingrese su usuario">
          </div>

        </div>

        <div class="form-group">
            <label for="txtPass" class="control-label">
                Password:
            </label>
            <div class="input-group">
              <div class="input-group-append">
                <span class="input-group-text input-icon">
                  P
                </span>
              </div>
              <input type="password" class="form-control" id="" name="pass" placeholder="Ingrese su password">
            </div>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-blue btn-block text-white"
          name="ingresar" onclick="loguear('<?php echo constant('URL').'api/v1/usuario/login/' ?>')">
              Ingresar
          </button>
          <button type="button" class="btn btn-link btn-block"
          name="olvide">
              Olvide la contrasena
          </button>
        </div>

        <div id="errorlogin">
          <?php if (isset($msg)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span><?php echo $msg; ?></span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button> </div>
          <?php endif; ?>
        </div>

      </form>

    </div>

  </div>
</div>

<script type="text/javascript">
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
      console.log('Errores: ' + e);
    })
  }

  function errorLogin(msg){
    errorlogin.innerHTML = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span>` + msg + `</span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button> </div>`;
  }
</script>
