
<script type="text/javascript">

    $(document).ready(function(){
      $('.actualizarBtn').on('click',function(){
        $('#actualizarSeccion').modal('show');
          $tr_a = $(this).closest('tr');
          var contador_a=0;

          var datos_a1 = $tr_a.children("th").map(function(){

             return $(this).text();

          }).get();

          var datos_a2 = $tr_a.children("td").map(function(){
            contador_a++;
            if(contador_a<5){
             return $(this).text();
            }

          }).get();

          var datos_a =datos_a1.concat(datos_a2)

          console.log(datos_a);

          $('#nombreSeccionA').val(datos_a[2]);
          $('#idSeccionA').val(datos_a[0]);
          $('#listaTiposActualizar').val(datos_a[3]);
          $('#posicionSeccionA').val(datos_a[4]);

      });
    }
    );
  </script>


  <script type="text/javascript">

  $(document).ready(function(){
      $('.eliminarBtn').on('click',function(){
        $('#eliminarSeccion').modal('show');
          $tr_e = $(this).closest('tr');
          var contador_e=0;

          var datos_e1 = $tr_e.children("th").map(function(){


             return $(this).text();


          }).get();

          var datos_e2 = $tr_e.children("td").map(function(){
            contador_e++;
            if( contador_e<4){
             return $(this).text();
            }

          }).get();

          var datos_e =datos_e1.concat(datos_e2)

          console.log(datos_e);

          $('#nombreSeccionE').val(datos_e[2]);
          $('#idSeccionE').val(datos_e[0]);
          $('#listaTiposEliminar').val(datos_e[3]);

      });
    }
    );

  </script>

  <script type="text/javascript">

      var b = document.getElementById("busqueda");

      if (b){
          b.addEventListener("keydown", function (e) {
            if (String(b.value).trim() !="" && e.keyCode === 13) {
              window.location.href = "<?php echo constant('URL'); ?>seccionficha/buscar?key="+b.value;

            }
        });
      }

  </script>

  <script type="text/javascript">


          var selIn = document.getElementById("listaTiposInsertar");
          var dimIn= document.getElementsByClassName("tiposSeccion").length;



          for(var i = 0; i<=dimIn-2; i+=2) {
              var elIn = document.createElement("option");
              elIn.textContent = document.getElementsByClassName("tiposSeccion")[i+1].value;
              elIn.value = document.getElementsByClassName("tiposSeccion")[i].value;
              selIn.appendChild(elIn);
          }

  </script>

  <script type="text/javascript">

          var selAc = document.getElementById("listaTiposActualizar");
          var dimAc= document.getElementsByClassName("tiposSeccion").length;



          for(var j = 0; j<=dimAc-2; j+=2) {
              var elAc = document.createElement("option");
              elAc.textContent = document.getElementsByClassName("tiposSeccion")[j+1].value;
              elAc.value = document.getElementsByClassName("tiposSeccion")[j].value;
              selAc.appendChild(elAc);
          }

  </script>

  <script type="text/javascript">

      var selEl = document.getElementById("listaTiposEliminar");
      var dimEl= document.getElementsByClassName("tiposSeccion").length;



      for(var k = 0; k<=dimEl-2; k+=2) {
          var elEl = document.createElement("option");
          elEl.textContent = document.getElementsByClassName("tiposSeccion")[k+1].value;
          elEl.value = document.getElementsByClassName("tiposSeccion")[k].value;
          selEl.appendChild(elEl);
      }

  </script>
