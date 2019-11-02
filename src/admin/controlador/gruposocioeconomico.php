<?php
require_once "src/admin/modelo/ficha/tipofichabd.php";
require_once "src/admin/modelo/ficha/gruposocioeconomicobd.php";

class GrupoSocioeconomicoCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct('admin');
  }

  public function inicio ($mensaje = null){
    $gruposocioeconomico = GrupoSocioEconomicoBD::getAll();
    require cargarVistaAdmin('gruposocioeconomico/index.php');
  }

  public function guardar(){
    if(isset($_POST['guardar'])){
      $gS = $this->grupoSocionomicoPOST();
      if($gS != null){
        $res = GrupoSocioEconomicoBD::guardar($gS);
        $mensaje = $res ? 'Guardamos correctamente.' : 'No pudimos guardarlo.';
        $this->inicio($mensaje);
      } else {
        $this->inicio('No tenemos datos para guardar');
      }
    } else {
      $tipofichas = TipoFichaBD::getParaCombo();
      require cargarVistaAdmin('gruposocioeconomico/guardar.php');
    }
  }

  public function editar(){

    if(isset($_GET['id'])){
      $gs = GrupoSocioEconomicoBD::getPorId($_GET['id']);
      $tipofichas = TipoFichaBD::getParaCombo();
      if($gs != null){
          require cargarVistaAdmin('gruposocioeconomico/editar.php');
      } else {
        Errores::errorEditar("Grupo Socioeconomico");
      }
    }

    if(isset($_POST['editar'])){
      $gS = $this->grupoSocionomicoPOST();
      if($gS != null && isset($_POST['id'])) {
        $gS['id_grupo_socioeconomico'] = $_POST['id'];

        $res = GrupoSocioEconomicoBD::editar($gS);
        $mensaje = $res ? 'Editamos correctamente.' : 'No pudimos editarlo.';
        $this->inicio($mensaje);
      } else {
        $this->inicio('No tenemos datos para editar.');
      }
    }
  }

  public function eliminar(){
    GrupoSocioEconomicoBD::eliminar(isset($_GET['id']) ? $_GET['id'] : 0);
  }

  private function grupoSocionomicoPOST(){
    if(
        isset($_POST['tipoficha']) &&
        isset($_POST['gruposocioeconomico']) &&
        isset($_POST['puntajeMinimo']) &&
        isset($_POST['puntajeMaximo'])
      ){
        $gs = [
          'id_tipo_ficha' => $_POST['tipoficha'],
          'grupo_socioeconomico' => $_POST['gruposocioeconomico'],
          'puntaje_minimo' => $_POST['puntajeMinimo'],
          'puntaje_maximo' => $_POST['puntajeMaximo']
        ];
        return $gs;
    }
  }

}

?>
