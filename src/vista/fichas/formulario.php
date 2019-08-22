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

    <?php include cargarVista('fichas/formato.php'); ?>

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
