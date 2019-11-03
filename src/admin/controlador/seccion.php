<?php
declare(strict_types=1);
require_once "src/admin/modelo/cuestionario/seccionbd.php";
require_once "src/admin/modelo/ficha/tipofichabd.php";

class SeccionCTR extends CTR implements DCTR {


    private $tiposSeccion;
    function __construct(){
      parent::__construct('admin');
    }

    function inicio($mensaje = null){
      $tiposSeccion = TipoFichaBD::getAll();
      $secciones = SeccionFichaBD::seleccionarSeccionFicha(null,0);
      require cargarVistaAdmin('seccion/index.php');
    }


    function buscar(){
      if ($_GET){
        $key =$_GET["key"];
        $tiposSeccion = TipoFichaBD::getAll();
        $secciones = SeccionFichaBD::seleccionarSeccionFicha($key,4);

        require cargarVistaAdmin('seccion/index.php');
      }
    }

  function insertar(){

     if ($_POST){

        $tipo=(int)$_POST['tipoSeccion'];
        $posicionSeccion=(int)$_POST['posicionSeccion'];
        $nombre=$_POST["nombreSeccion"];

        $nuevaSeccion = new SeccionFichaMD(null,$tipo,$nombre,$posicionSeccion);
        $ok = SeccionFichaBD::insertarSeccionFicha($nuevaSeccion);

        $ruta=constant('URL');
        echo "<script>window.location='{$ruta}seccionficha'</script>";
        $this->inicio();
     }

  }


    function actualizar(){
       if ($_POST){
          $id=(int)$_POST["idSeccion"];
          $tipo=(int)$_POST['tipoSeccion'];
          $posicionSeccion=(int)$_POST['posicionSeccion'];
          $nombre=$_POST["nombreSeccion"];

          $seccion = new SeccionFichaMD($id,$tipo,$nombre,$posicionSeccion);
          $ok = SeccionFichaBD::actualizarSeccionFicha($seccion);
          $ruta=constant('URL');
          echo "<script>window.location='{$ruta}seccionficha'</script>";
          $this->inicio();
        }
    }

    function eliminar(){
       if ($_POST){
          $id=(int)$_POST["idSeccion"];
          $seccion = new SeccionFichaMD($id,null,null,null,false);
          $ok = SeccionFichaBD::eliminarSeccionFicha($seccion);
          $ruta=constant('URL');
          echo "<script>window.location='{$ruta}seccionficha'</script>";
          $this->inicio();
       }
    }

}
