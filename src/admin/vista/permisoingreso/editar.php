<?php
$pagina = 'Permiso Ingreso Ficha | Editar';
require 'src/admin/vista/templates/header.php';
 ?>

 <div class="my-5">

   <div class="col-md-8 col-lg-6 mx-auto border rounded shadow">

     <h3 class="text-center my-3">Editar Permiso Ficha</h3>

     <div id="ctn-msg"></div>

     <form class="" method="post" id="form-permiso">

       <input type="hidden" name="id" value="<?php echo $pi['id_permiso_ingreso_ficha']; ?>">

       <div class="form-group">
           <label for="periodo" class="control-label">Seleccione un periodo:</label>
           <select class="form-control" name="periodo" id="cmbPeriodos">
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


       <div class="form-group">

           <label for="tipoficha" class="control-label">Seleccione un tipo de ficha</label>
           <select name="tipoficha" class="form-control" id="cmbFichas">
               <option value="0">Fichas</option>
               <?php
               if (isset($tipofichas)) {
                   foreach ($tipofichas as $tf) {
                     if ($tf['id_tipo_ficha'] == $pi['id_tipo_ficha']) {
                       echo '<option selected value="' . $pi['id_tipo_ficha'] . '">' . $tf['id_tipo_ficha'] . '</option>';
                     } else {
                        echo '<option value="' . $tf['id_tipo_ficha'] . '">' . $tf['tipo_ficha'] . '</option>';
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

   const FORM_PERMISO = document.querySelector('#form-permiso');
   const URLPG = '<?php echo constant('URL'); ?>miad/permiso/editar';
   const CTN_MSG = document.querySelector('#ctn-msg');

   FORM_PERMISO.addEventListener('submit', (e) => {
     e.preventDefault();
   })

   function guardarPermiso() {
     let formdata = new FormData(FORM_PERMISO);
     formdata.append('editar', 'true');

     if (formdata.get('periodo') != '0' && formdata.get('tipoficha') != '0') {
       fetch(URLPG, {
         method: 'POST',
         body: formdata
       })
       .then(res => res)
       .then(data => {
         window.location.replace(URLPG.replace('editar', ''));
       })
       .catch(e =>{
         CTN_MSG.innerHTML = msgError('Error al guardar el formulario');
       });

     }

   }

   function msgError(msg) {
     return `<div class="alert alert-danger alert-dismissible fade show" role="alert">
     <span>` + msg + `</span>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button> </div>`;
   }

   function msgSuccess(msg) {
     return `<div class="alert alert-success alert-dismissible fade show" role="alert">
     <span>` + msg + `</span>
     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button> </div>`;
   }

 </script>



<?php
require 'src/admin/vista/templates/footer.php';
 ?>
