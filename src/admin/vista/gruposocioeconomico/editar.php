<?php
$pagina = 'Grupo socioeconómico | Editar';
require 'src/admin/vista/templates/header.php';
 ?>

 <div class="container my-5">

   <div class="col-md-8 col-lg-6 mx-auto border rounded">

     <h3 class="text-center my-3">
       Edicion de grupo socieconómico
     </h3>
     <form class="form-horizontal" action="<?php echo constant('URL'); ?>miad/gruposocioeconomico/editar" method="post">

       <input type="hidden" name="id" value="<?php echo $gs['id_grupo_socioeconomico']; ?>">

       <div class="form-group">

         <label for="tipoficha"
         class="control-label"
         >Seleccione un tipo de ficha</label>
         <select name="tipoficha"
         class="form-control">
           <option value="<?php echo $gs['id_tipo_ficha']; ?>">Fichas</option>
           <?php
           if(isset($tipofichas)){
             foreach ($tipofichas as $tf) {
               if ($tf['id_tipo_ficha'] == $gs['id_tipo_ficha']) {
                  echo '<option selected  value="'.$tf['id_tipo_ficha'].'">'.$tf['tipo_ficha'].'</option>';
               } else {
                  echo '<option value="'.$tf['id_tipo_ficha'].'">'.$tf['tipo_ficha'].'</option>';
               }
             }
           }
            ?>
         </select>

       </div>

       <div class="form-group">
         <label for="nombreGrupo"
         class="control-label"
         >Grupo Socioeconomico</label>
         <input type="text" name="gruposocioeconomico"
         value="<?php echo $gs['grupo_socioeconomico']; ?>"
         class="form-control"
         placeholder="Ingrese el nuevo nombre del Grupo Socieconómico" >
       </div>

       <div class="form-row">

         <div class="col">
           <div class="form-group">
             <label for="puntajeMinimo"
             class="control-label"
             >Puntaje Minimo</label>
             <input type="number" name="puntajeMinimo" value="<?php echo $gs['puntaje_minimo']; ?>"
             class="form-control"
             placeholder="Ingrese el nuevo Puntaje Mínimo">
           </div>
         </div>

          <div class="col">
            <div class="form-group">
              <label for="puntajeMaximo"
              class="control-label"
              >Puntaje Máximo</label>
              <input type="number" name="puntajeMaximo" value="<?php echo $gs['puntaje_maximo']; ?>"
              class="form-control"
              placeholder="Ingrese el nuevo Puntaje Máximo">
            </div>
          </div>

       </div>


       <div class="form-group">
          <input class="btn btn-success btn-block"
          type="submit" name="editar" value="Guardar">
       </div>

     </form>

   </div>
 </div>

<?php
require 'src/admin/vista/templates/footer.php';
?>
