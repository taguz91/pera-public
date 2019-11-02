<?php
require_once "src/admin/modelo/ficha/permisoingresobd.php";
require_once "src/modelo/periodo/periodobd.php";
require_once "src/admin/modelo/ficha/tipofichabd.php";

class PermisoCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct('admin');
  }

  public function inicio($mensaje = null){
    $permisoingresos =PermisoIngresoBD::getAll();
    require cargarVistaAdmin('permisoingreso/index.php');
  }

  public function guardar(){
    //Validarrrr
    if(isset($_POST['guardar'])){
      $pf = $this->permisoFichaPOST();

      if($pf != null){
        $res = PermisoIngresoBD::guardar($pf);
        $mensaje = $res ? 'Guardamos correctamente.' : 'No pudimos guardarlo.';
        $this->inicio($mensaje);
      }else{
        Errores::errorVariableNoEncontrada();
      }
    }else{
      // Cargamos el formulario
      $periodos = PeriodoLectivoBD::getParaCombo();
      $tipofichas = TipoFichaBD::getParaCombo();
      require cargarVistaAdmin('permisoingreso/guardar.php');
    }

  }

  public function editar(){
    if(isset($_GET['id'])){

      $pi = PermisoIngresoBD::getPorId($_GET['id']);
      // Cargamos el formulario
      $periodos = PeriodoLectivoBD::getParaCombo();
      $tipofichas = TipoFichaBD::getParaCombo();

      if($pi != null){
        require cargarVistaAdmin('permisoingreso/editar.php');
      }else{
        Errores::errorEditar("Permiso Ingreso Ficha");
      }
    }

    if(isset($_POST['editar'])){
      $pf = $this->permisoFichaPOST();
      if(isset($_POST['id']) && $pf != null){
        $pf['id_permiso_ingreso_ficha'] = $_POST['id'];
        $res = PermisoIngresoBD::editar($pf);
        $mensaje = $res ? 'Editamos correctamente.' : 'No pudimos editarlo.';
        $this->inicio($mensaje);
      } else {
        $this->inicio('No tenemos datos para editar.');
      }
    }
  }

  function eliminar(){
    PermisoIngresoBD::eliminar(isset($_GET['id']) ? $_GET['id'] : 0);
  }

  private function permisoFichaPOST() {
    if(
      isset($_POST['periodo']) &&
      isset($_POST['tipoficha']) &&
      isset($_POST['fechaInicio']) &&
      isset($_POST['fechaFin'])
    ){
      $pf = [
        'id_prd_lectivo' => $_POST['periodo'],
        'id_tipo_ficha' => $_POST['tipoficha'],
        'fecha_inicio' => $_POST['fechaInicio'],
        'fecha_fin' => $_POST['fechaFin']
      ];
      return $pf;
    }
  }

}


 ?>
