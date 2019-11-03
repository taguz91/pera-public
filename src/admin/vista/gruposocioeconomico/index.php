<?php
$pagina = 'Grupo socioeconomico';
require 'src/admin/vista/templates/header.php';
 ?>


 <div class="card shadow mb-4">
   <div class="card-header py-3">
     <div class="row">
       <div class="col">
         <h6 class="m-0 font-weight-bold text-primary">Todos los grupos socieconómicos</h6>
       </div>
       <div class="col-4 col-lg-2">
         <a href="<?php echo constant('URL'); ?>miad/gruposocioeconomico/nuevo"
         class="btn btn-success btn-block">Ingresar</a>
       </div>
     </div>

     <?php if (isset($mensaje)): ?>
       <div class="row">
         <div class="col-10 mx-auto">
           <div class="alert alert-info my-2 text-center alert-dismissible fade show" role="alert">
             <?php echo $mensaje; ?>
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
         </div>
       </div>
     <?php endif; ?>

   </div>

   <div class="card-body">
     <div class="table-responsive">
       <table class="table table-bordered"
       id="dataTable" width="100%" cellspacing="0">

       <thead class="thead-dark bg-ista-blue">
         <tr>
           <th scope="col">ID</th>
           <th scope="col">Tipo Ficha</th>
           <th scope="col">GrupoSocienomico</th>
           <th scope="col">Puntaje Mínimo</th>
           <th scope="col">Puntaje Máximo</th>
           <th scope="col">Editar</th>
           <th scope="col">Eliminar</th>
         </tr>
       </thead>

      <tbody>
        <?php
        if(isset($gruposocioeconomico)){
          foreach ($gruposocioeconomico as $gs) {
            echo '<tr scope="row">';
            echo "<td>".$gs['id_grupo_socioeconomico']."</td>";
            echo "<td>".$gs['tipo_ficha']."</td>";
            echo "<td>".$gs['grupo_socioeconomico']."</td>";
            echo "<td>".$gs['puntaje_minimo']."</td>";
            echo "<td>".$gs['puntaje_maximo']."</td>";
            echo '<td> <a href="'.constant('URL').'miad/gruposocioeconomico/editar?id='.$gs['id_grupo_socioeconomico'].'">Editar</a> </td>';
            echo '<td> <a href="'.constant('URL').'miad/gruposocioeconomico/eliminar?id='.$gs['id_grupo_socioeconomico'].'">Eliminar</a> </td>';
            echo "</tr>";
          }
        }else{
          Errores::errorBuscar("No encontramos grupos socieconómicos");
        }
         ?>

      </tbody>


     </table>
   </div>
 </div>

 </div>

<?php
require 'src/admin/vista/templates/footer.php';
 ?>
