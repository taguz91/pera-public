<?php
$pagina = 'Permiso Ingreso Ficha | Editar';
require 'src/admin/vista/templates/header.php';
 ?>

 <div class="my-5">

   <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">
     <h3 class="text-center my-3">Editar Permiso Ingreso Ficha</h3>
     <hr>

     <div id="ctn-msg"></div>

     <form action="<?php echo constant('URL') ?>miad/permiso/editar" method="post" id="form-permiso">

       <input type="hidden" name="id" value="<?php echo $pi['id_permiso_ingreso_ficha']; ?>">

       <div class="form-group">

           <label for="tipoficha" class="control-label">Seleccione un tipo de ficha</label>
           <select name="tipoficha" class="form-control" id="cmbFichas">
               <option value="0">Fichas</option>
               <?php
               if (isset($tipofichas)) {
                   foreach ($tipofichas as $tf) {
                     if ($tf['id_tipo_ficha'] == $pi['id_tipo_ficha']) {
                       echo '<option selected value="' . $pi['id_tipo_ficha'] . '">' . $tf['tipo_ficha'] . '</option>';
                     } else {
                        echo '<option value="' . $tf['id_tipo_ficha'] . '">' . $tf['tipo_ficha'] . '</option>';
                     }
                   }
               }
               ?>
           </select>

       </div>


       <div class="form-group" id="form-periodo">
           <label for="periodo" class="control-label">Seleccione un periodo:</label>
           <select class="form-control" name="periodo" id="cmbPeriodos" onchange="getPeriodos(this)">
               <option value="0">Periodos</option>

               <?php
               if (isset($periodos)) {
                   foreach ($periodos as $pl) {
                     if ($pi['id_prd_lectivo'] == $pl['id_prd_lectivo']) {
                       echo '<option selected value="' . $pi['id_prd_lectivo'] . '">' . $pl['prd_lectivo_nombre'] . '</option>';
                     } else {
                       echo '<option value="' . $pl['id_prd_lectivo'] . '">' . $pl['prd_lectivo_nombre'] . '</option>';
                     }
                   }
               }
               ?>
           </select>
       </div>


       <div class="form-row">
           <div class="col">
               <div class="form-group">
                   <label for="fechaInicio" class="control-label">Fecha Inicio</label>
                   <input type="date" name="fechaInicio" value="<?php echo $pi['permiso_ingreso_fecha_inicio']; ?>" class="form-control" id="inInicio">
               </div>
           </div>

           <div class="col">
               <div class="form-group">
                   <label for="fechaFin" class="control-label">Fecha Fin</label>
                   <input type="date" name="fechaFin" value="<?php echo $pi['permiso_ingreso_fecha_fin']; ?>" class="form-control" id="inFin">
               </div>
           </div>
       </div>

       <div class="form-group">
           <input class="btn btn-success btn-block" type="submit" name="editar" value="Guardar"  id="btnGuardar" onclick="guardarPermiso()">
       </div>

     </form>


   </div>

 </div>

 <script type="text/javascript">
 const FORMPERIODO = document.querySelector('#form-periodo');
 const CMBPERIODO = document.querySelector('#cmbPeriodos');

 if(CMBPERIODO != null){
   getPeriodos(CMBPERIODO);
 }
 
 function getPeriodos(cmb) {
   if (cmb.value == 1 ) {
     FORMPERIODO.style.display = 'block';
   } else {
     FORMPERIODO.style.display = 'none';
   }
 }

 </script>



<?php
require 'src/admin/vista/templates/footer.php';
 ?>
