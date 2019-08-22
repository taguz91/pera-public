

<div class="row border bg-white h-75 w-100 my-auto">

  <div class="col-md-8 h-100 d-flex">
    <div class="m-auto">
      <img src="<?php echo constant('URL'); ?>public/img/icons/banner-ista.png" alt="No encontramos el logo" class="d-block mx-auto" style="width: 90%;">
    </div>
  </div>


  <div class="border-left col-md-4 h-100 ml-auto px-2">

    <div class="h-100 d-flex">
      <form class="form-horizontal m-auto "
      action="<?php echo constant('URL'); ?>login/ingresar"
      method="post">

        <div class="form-group">
          <label for="txtUsuario" class="control-label">
              Usuario:
          </label>
          <div class="input-group">
            <div class="input-group-append">
              <span class="input-group-text input-icon">
                <!--<i class="fas fa-key"></i>-->
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
                  <!--<i class="fas fa-key"></i>-->
                  P
                </span>
              </div>
              <input type="password" class="form-control" id="pera-password" name="pass" placeholder="Ingrese su password">
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-blue btn-block text-white"
            name="ingresar">
                Ingresar
            </button>
            <button type="submit" class="btn btn-link btn-block"
            name="olvide">
                Olvide la contrasena
            </button>
          </div>
      </form>
    </div>

  </div>
</div>
