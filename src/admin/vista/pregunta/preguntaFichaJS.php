 <script>
  generarRespuestas();
  var bar=false;
  var x=1;
  document.getElementById("tipoRespuesta").addEventListener("change", generarRespuestas);

  function generarRespuestas(){
    if (document.getElementById("respuestasMenu")){
      document.getElementById("respuestasMenu").innerHTML="";
      bar=false;
    }

    if (document.getElementById("respuestas")){
      document.getElementById("respuestas").innerHTML="";
    }

    console.log(document.getElementById("tipoRespuesta").value) ;

    if (document.getElementById("tipoRespuesta").value!=3 && document.getElementById("tipoRespuesta").value!=4  ) {

      if (!bar){
        var div0 = document.createElement("div");
        var btn1 = document.createElement("button");
        var btn2 = document.createElement("button");
        var lbl = document.createElement("label");

        div0.setAttribute("class", "btn-group float-right");

        btn1.setAttribute("class", "btn btn-outline-info waves-effect" );
        btn2.setAttribute("class", "btn btn-outline-danger waves-effect");
        lbl.setAttribute("for", "listaRespuestas");

        btn1.setAttribute("type", "button" );
        btn1.setAttribute("id", "crearRespuesta" );
        btn1.innerHTML="Agregar";
        btn2.setAttribute("type", "button");
        btn2.setAttribute("id", "eliminarRespuesta" );
        btn2.innerHTML="Quitar";
        lbl.innerHTML="Respuesta | Puntaje:"

        div0.appendChild(lbl);
        div0.appendChild(btn1);
        div0.appendChild(btn2);

        var cont = document.getElementById("respuestasMenu");
        cont.appendChild(lbl);
        cont.appendChild(div0);

        bar=true;
      }

    }

    if (document.getElementById("tipoRespuesta").value==3 || document.getElementById("tipoRespuesta").value==4){

        var _div = document.createElement("div");
        var _lbl = document.createElement("label")
        var sel = document.createElement("select");
        var opt1 = document.createElement("option");
        var opt2 = document.createElement("option");
        var opt3 = document.createElement("option");

        sel.setAttribute("class", "browser-default custom-select");
        sel.setAttribute("id", "tipoCampo");
        sel.setAttribute("name", "tipoCampo");
        _div.setAttribute("class", "form-group");
        opt1.setAttribute("value", "text")
        opt2.setAttribute("value", "number")
        opt3.setAttribute("value", "date")

        _lbl.innerHTML="Tipo de Dato Admitido por el Campo:";
        opt1.innerHTML="Texto";
        opt2.innerHTML="Numérico";
        opt3.innerHTML="Fecha";

        sel.appendChild(opt1);
        sel.appendChild(opt2);
        sel.appendChild(opt3);

        _div.appendChild(_lbl);
        _div.appendChild(sel);

        var _cont = document.getElementById("respuestasMenu");
        _cont.appendChild(_div);

    }

    if (bar){
      document.getElementById("crearRespuesta").addEventListener("click", crearRespuesta);
      document.getElementById("eliminarRespuesta").addEventListener("click", eliminarRespuesta);
    }


  function crearRespuesta() {

    console.log(x);
    var div1 = document.createElement("div");
    var div2 = document.createElement("div");
    var div3 = document.createElement("div");
    var tpp = document.createElement("input");
    div1.setAttribute("class", "input-group mb-3");
    div2.setAttribute("class", "input-group-prepend");
    div3.setAttribute("class", "input-group-text ");

    tpp.setAttribute("onclick","return false");

    if (document.getElementById("tipoRespuesta").value == 1){
      tpp.setAttribute("type","radio");
    } else {
      tpp.setAttribute("type","checkbox");
    }

    tpp.setAttribute("onclick","return false");
    var input = document.createElement("input");
    var peso = document.createElement("input");

    input.setAttribute("class", "form-control col-lg-10")
    input.setAttribute("type", "text")
    input.setAttribute("id","respuesta"+x);
    input.setAttribute("name","respuesta"+x);

    peso.setAttribute("class", "form-control col-lg-2")
    peso.setAttribute("type", "number")
    peso.setAttribute("id","peso"+x);
    peso.setAttribute("name","peso"+x);
    peso.setAttribute("value",1);

    div1.appendChild(div2);
    div2.appendChild(div3);

    div3.appendChild(tpp);
    div1.appendChild(input);
    div1.appendChild(peso);

    var cont = document.getElementById("respuestas");

    cont.appendChild(div1);

    x=x+1;
    console.log(x);
  }

  function eliminarRespuesta() {
    var res=document.getElementById("respuestas");

    if (res.childElementCount>2){
      res.removeChild(res.lastChild);
      x=x-1;
    }
  }

}

</script>

<script>

  var bar=false;
  var x=1;
  document.getElementById("tipoRespuestaA").addEventListener("change", generarRespuestasA);

  function generarRespuestasA(){

    if (document.getElementById("respuestasMenuA")){
      document.getElementById("respuestasMenuA").innerHTML = "";
      bar=false;
    }

    if (document.getElementById("respuestasA")){
      document.getElementById("respuestasA").innerHTML = "";
    }

    console.log(document.getElementById("tipoRespuestaA").value) ;

    if (
      document.getElementById("tipoRespuestaA").value!=3 && document.getElementById("tipoRespuestaA").value!=4
    ) {

      document.getElementById('tipoCampoA').style.display = "none";
      document.getElementById('etiquetaCampo').style.display = "none";
        if (!bar){
            var div0 = document.createElement("div");
            var btn1 = document.createElement("button");
            var btn2 = document.createElement("button");
            var lbl = document.createElement("label");

            div0.setAttribute("class", "btn-group float-right");

            btn1.setAttribute("class", "btn btn-outline-info waves-effect" );
            btn2.setAttribute("class", "btn btn-outline-danger waves-effect");
            lbl.setAttribute("for", "listaRespuestasA");

            btn1.setAttribute("type", "button" );
            btn1.setAttribute("id", "crearRespuestaA" );
            btn1.innerHTML="Agregar";
            btn2.setAttribute("type", "button");
            btn2.setAttribute("id", "eliminarRespuestaA" );
            btn2.innerHTML="Quitar";
            lbl.innerHTML="Respuesta | Puntaje:"

            div0.appendChild(lbl);
            div0.appendChild(btn1);
            div0.appendChild(btn2);

            var cont = document.getElementById("respuestasMenuA");
            cont.appendChild(lbl);
            cont.appendChild(div0);

            bar=true;
        }

    }

    if (document.getElementById("tipoRespuestaA").value==3 || document.getElementById("tipoRespuestaA").value==4){

      document.getElementById('tipoCampoA').style.display = "block";
      document.getElementById('etiquetaCampo').style.display = "block";

    }

    if (bar){
      document.getElementById("crearRespuestaA").addEventListener("click", crearRespuestaA);
      document.getElementById("eliminarRespuestaA").addEventListener("click", eliminarRespuestaA);
    }


  function crearRespuestaA() {

    console.log(x);

    var div1 = document.createElement("div");
    var div2 = document.createElement("div");
    var div3 = document.createElement("div");
    var tpp = document.createElement("input");
    div1.setAttribute("class", "input-group mb-3");
    div2.setAttribute("class", "input-group-prepend");
    div3.setAttribute("class", "input-group-text ");

    tpp.setAttribute("onclick","return false");


    if (document.getElementById("tipoRespuestaA").value==1){
      tpp.setAttribute("type","radio");
    }else{
      tpp.setAttribute("type","checkbox");
    }

    tpp.setAttribute("onclick","return false");

    var input = document.createElement("input");
    var peso = document.createElement("input");

    input.setAttribute("class", "form-control col-lg-10")
    input.setAttribute("type", "text")
    input.setAttribute("id","respuesta"+x);
    input.setAttribute("name","respuesta"+x);

    peso.setAttribute("class", "form-control col-lg-2")
    peso.setAttribute("type", "number")
    peso.setAttribute("id","peso"+x);
    peso.setAttribute("name","peso"+x);
    peso.setAttribute("value",1);

    div1.appendChild(div2);
    div2.appendChild(div3);
    div3.appendChild(tpp);
    div1.appendChild(input);
    div1.appendChild(peso);

    var cont = document.getElementById("respuestasA");
    cont.appendChild(div1);

    x=x+1;
    console.log(x);
  }

  function eliminarRespuestaA() {
    var res=document.getElementById("respuestasA");
    if (res.childElementCount>2){
      res.removeChild(res.lastChild);
      x=x-1;
    }
  }

}

</script>


<script>

document.getElementById("cancelar").addEventListener("click", limpiar);
document.getElementById("cancelarA").addEventListener("click", limpiar);
document.getElementById("cancelarE").addEventListener("click", limpiar);


function limpiar() {

  var respuestasMenu=document.getElementById("respuestasMenu");
  respuestasMenu.innerHTML="";
  var respuestas=document.getElementById("respuestas");
  respuestas.innerHTML="";
  var respuestasMenuA=document.getElementById("respuestasMenuA");
  respuestasMenuA.innerHTML="";
  var respuestasA=document.getElementById("respuestasA");
  respuestasA.innerHTML="";
  var respuestasA=document.getElementById("respuestasE");
  respuestasA.innerHTML="";
  document.getElementById("tipoRespuesta").value=1;
  document.getElementById("pregunta").value='';
  document.getElementById("ayudaPregunta").value='';
  document.getElementById("tipoPregunta").checked = true;
  document.getElementById("listaSeccionesInsertar").selectedIndex=0;
  generarRespuestas();
  console.log(document.cookie);
  // location.reload();
}

</script>


<script type="text/javascript">


    $(document).ready(function(){
      $('.actualizarBtnP').on('click',function(){

         var element= $(this)[0].parentElement.parentElement;
        var id = $(element).attr('idQuiz');
        var dataString ='id='+id;
        console.log(id);
        // document.cookie = 'idQuiz='+id;
        $('#actualizarPregunta').modal('show');


          $tr_a = $(this).closest('tr');
          var contador_a=0;

          var datos_a1 = $tr_a.children("th").map(function(){

             return $(this).text();

          }).get();

          var datos_a2 = $tr_a.children("td").map(function(){
            contador_a++;
            if(contador_a<9){
             return $(this).text();
            }

          }).get();

          var datos_a =datos_a1.concat(datos_a2)

          console.log(datos_a);


          $('#idPreguntaA').val(datos_a[0]);
          $('#preguntaA').val(datos_a[2]);
          $('textarea#ayudaPreguntaA').val(datos_a[3]);
          $('#listaSeccionesActualizar').val(datos_a[4]);
          $('select#tipoRespuestaA').val(datos_a[5]);
          $('select#tipoCampoA').val(datos_a[7]);
          $('#posicionPreguntaA').val(datos_a[8]);

          if(datos_a[6]=="1"){

            $('#tipoPreguntaA').prop('checked', true);
          }else{
            $('#tipoPreguntaA').prop('checked', false);
          }


      });
    }
    );
  </script>

<script type="text/javascript">


$(document).ready(function(){
  $('.eliminarBtnP').on('click',function(){

     var element_e= $(this)[0].parentElement.parentElement;
    var id_e = $(element_e).attr('idQuiz');
    // var dataString ='id='+id_ed;
    console.log(id_e);
    // document.cookie = 'idQuiz='+id;
    $('#eliminarPregunta').modal('show');


      $tr_e = $(this).closest('tr');
      var contador_e=0;

      var datos_e1 = $tr_e.children("th").map(function(){

         return $(this).text();

      }).get();

      var datos_e2 = $tr_e.children("td").map(function(){
        contador_e++;
        if(contador_e<8){
         return $(this).text();
        }

      }).get();

      var datos_e =datos_e1.concat(datos_e2)

      console.log(datos_e);

      $('#idPreguntaE').val(datos_e[0]);
      $('#preguntaE').val(datos_e[2]);
      $('textarea#ayudaPreguntaE').val(datos_e[3]);
      $('#listaSeccionesEliminar').val(datos_e[4]);
      $('select#tipoRespuestaE').val(datos_e[5]);



      if(datos_e[6]=="1"){

        $('#tipoPreguntaE').prop('checked', true);
      }else{
        $('#tipoPreguntaE').prop('checked', false);
      }


  });
}
);
</script>


  <script>
  $(document).ready(function(){
      $('.actualizarBtnP').on('click',function(){
      var element= $(this)[0].parentElement.parentElement;
      var id = $(element).attr('idQuiz');

      console.log(id);
     $.ajax({
      type: 'post',
      data: {ajax: 1,id_A: id},
      success: function(response){
        generarRespuestasA();
       $('#respuestasA').append(response);

      },

     });
    });
  });
  </script>

<script>
  $(document).ready(function(){
      $('.eliminarBtnP').on('click',function(){
      var element= $(this)[0].parentElement.parentElement;
      var id = $(element).attr('idQuiz');

      console.log(id);
     $.ajax({
      type: 'post',
      data: {ajax: 1,id_E: id},
      success: function(response){
       $('#respuestasE').append(response);

      },

     });
    });
  });
  </script>

<script type="text/javascript">

  var b = document.getElementById("busquedaP");

  if (b){
      b.addEventListener("keydown", function (e) {
        if (String(b.value).trim() !="" && e.keyCode === 13) {
          window.location.href = "<?php echo constant('URL'); ?>preguntaficha/buscar?key="+b.value;

        }
    });
  }

</script>
