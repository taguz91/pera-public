<?php
require 'src/vista/templates/nav.php';
 ?>
<?php if(isset($titulo)){ ?>
 <div class="border-top pt-3  ">
  <h1 class="text-muted text-center"><?php echo $titulo;?></h1>
 </div>
<?php } ?>

<div class="container my-4">

  <form class="" action="#" method="post">
<?php foreach ($secciones as $s) {
  ?>
  <div class="row my-3 seccion">

    <div class="col-md-8 border pb-2 mx-auto bg-blue">
        <h2 class="text-center text-white my-3 border-bottom pb-1"><?php echo $s->nombre; ?></h2>

        <?php foreach ($s->preguntas as $vp => $p) {?>

        <div class="card m-3 mb-4 border-0">
          <div class="card-header-blue">
            <h5 class="card-title"><?php echo $p->pregunta; ?></h5>
            <h6 class="card-subtitle text-white"><?php echo $p->ayuda; ?></h6>
          </div>

          <div class="card-body">

            <?php
            foreach ($p->respuestas as $vr => $r) {
             ?>
             <div class="custom-control custom-radio">
              <input type="radio" class="custom-control-input" id="<?php echo $vp.$vr; ?>" name="<?php echo $vp; ?>">
              <label class="custom-control-label" for="<?php echo $vp.$vr; ?>"><?php echo $r->respuesta; ?></label>
            </div>

           <?php } ?>

          </div>

        </div>
      <?php } ?>

    </div>

  </div>

<?php } ?>
  <div id="finfor">
    <button id="enviarficha" type="submit" class="btn btn-blue d-block w-50 mx-auto mb-3">Guardar</button>
  </div>
  </form>


  <div class="row" id="btnsnav">

    <div class="col-6 mx-auto" id="finant">
      <button id="anteriorsec" class="btn btn-info w-50 d-block mx-auto" type="button" name="button" onclick="clickAt()">Anterior</button>
    </div>

    <div class="col-6 mx-auto" id="finsig">
      <button id="seguientesec" class="btn btn-info w-50 d-block mx-auto" type="button" name="button" onclick="clickSg()">Siguiente</button>
    </div>

  </div>


</div>

<?php
require 'src/vista/templates/copy.php';
?>

<script type="text/javascript">
  var ss = document.getElementsByClassName('seccion');
  var btnev = document.getElementById('enviarficha');
  //var btnat = document.getElementById('anteriorsec');
  //var btnsg = document.getElementById('seguientesec');

  var btnat = document.getElementById('finant');
  var btnsg = document.getElementById('finsig');

  var pos = 0;
  var ult = ss.length;

  for (var i = 0; i < ss.length; i++) {
    ss[i].id = i + 'se' + i;
    if(i > 0) {
      ocultar(ss[i].id);
    }
  }

  function ocultar(id){
    var s = document.getElementById(id);
    if(s != null){
      s.style.display = 'none';
    }
  }

  function mostrar(id){
    var s = document.getElementById(id);
    if(s != null){
      s.style.display = 'block';
    }
  }

  function clickAt(){
    pos--;
    clickNav(pos);
    if(pos == 0){
      btnat.disabled = true;
      btnat.style.display = 'none';
    }
    ocultar('finfor');
  }

  function clickSg(){
    pos++;
    if(pos >= ult){
      btnsg.disabled = true;
      btnsg.style.display = 'none';
      mostrar('finfor');
    }
    clickNav(pos);

  }

  function clickNav(pos){
    console.log(pos);
    if(pos <= ult){

      if(pos > 0){
        btnat.disabled = false;
        btnat.style.display = 'block';
      }

      if(pos < ult){
        btnsg.disabled = false;
        btnsg.style.display = 'block';
      }

      for (var i = 0; i < ss.length; i++) {
        if(i == pos) {
          mostrar(ss[i].id);
        }else{
          ocultar(ss[i].id);
        }
      }
    }
  }

  if(pos == 0){
    btnat.disabled = true;
    ocultar('finfor');
    btnat.style.display = 'none';
  }

</script>
