<?php
declare (strict_types = 1);

require_once 'src/admin/ajax/preguntaajax.php';
require_once "src/admin/modelo/cuestionario/preguntabd.php";
require_once "src/admin/modelo/cuestionario/respuestabd.php";
require_once "src/admin/modelo/cuestionario/seccionbd.php";

class PreguntaCTR extends CTR implements DCTR {

    private $seccionesFicha;

    function __construct() {
        parent::__construct('admin');
    }

    function inicio($mensaje = null) {
      $seccionesFicha = SeccionFichaBD::seleccionarSeccionFicha(null, 0);
      $preguntas = PreguntaFichaBD::seleccionarPreguntaFicha(null, 0);

      require cargarVistaAdmin('pregunta/index.php');
    }

    function insertar(){

        if ($_POST) {
            $seccion = (int) $_POST['seccionPregunta'];

            $pregunta = $_POST["pregunta"];

            $ayudaPregunta = $_POST["ayudaPregunta"];

            $tipoRespuesta = (int) $_POST["tipoRespuesta"];


            $posicionPregunta = (int) $_POST["posicionPregunta"];


            $tipoCampo = "text";
            if (isset($_POST["tipoCampo"])) {
                $tipoCampo =$_POST["tipoCampo"];
            }


            $tipoPregunta = null;


            if (isset($_POST["tipoPregunta"])) {

                $tipoPregunta = 1;
            } else {

                $tipoPregunta = 0;
            }

            $nuevaPregunta = new PreguntaFichaMD(null, $seccion, $pregunta, $ayudaPregunta, $tipoPregunta, $tipoRespuesta,$tipoCampo, $posicionPregunta);

            $quiz = PreguntaFichaBD::insertarPreguntaFicha($nuevaPregunta);

            $x = 1;
            $aux = true;

            while ($aux) {

                if (isset($_POST["respuesta{$x}"]) && isset($_POST["peso{$x}"])) {

                    $nuevaRespuesta = new RespuestaFichaMD(null, (int) $quiz, $_POST["respuesta{$x}"], (int) $_POST["peso{$x}"]);
                    RespuestaFichaBD::insertarRespuestaFicha($nuevaRespuesta);
                } else {
                    $aux = false;
                }
                $x = $x + 1;

            }

            $ruta = constant('URL');

            echo "<script>window.location='{$ruta}preguntaficha'</script>";

            $this->inicio();

        }

    }

    function actualizar()
    {

        if ($_POST) {

            $id = (int) $_POST["idPregunta"];

            $seccion = (int) $_POST['seccionPregunta'];

            $pregunta = $_POST["pregunta"];

            $ayudaPregunta = $_POST["ayudaPregunta"];

            $tipoRespuesta = (int) $_POST["tipoRespuesta"];

            $posicionPregunta = (int) $_POST["posicionPregunta"];

            $tipoCampo = "text";
            if (isset($_POST["tipoCampo"])) {
                $tipoCampo =$_POST["tipoCampo"];
            }


            $tipoPregunta = null;
            if (isset($_POST["tipoPregunta"])) {

                $tipoPregunta = 1;
            } else {

                $tipoPregunta = 0;
            }

            $pregunta = new PreguntaFichaMD($id, $seccion, $pregunta, $ayudaPregunta, $tipoPregunta, $tipoRespuesta, $tipoCampo, $posicionPregunta);

             PreguntaFichaBD::actualizarPreguntaFicha($pregunta);

            $respuestasBD = RespuestaFichaBD::seleccionarRespuestaFicha($id);


            $x = 1;
            $aux = true;

            while ($aux) {

                if (isset($_POST["respuesta{$x}"]) && isset($_POST["peso{$x}"])) {

                    $nuevaRespuesta = new RespuestaFichaMD(null, $id, $_POST["respuesta{$x}"], (int) $_POST["peso{$x}"]);
                    RespuestaFichaBD::insertarRespuestaFicha($nuevaRespuesta);
                } else  {

                    foreach ($respuestasBD as $respuestaBD) {
                        if (isset($_POST["{$respuestaBD[0]}"]) && isset($_POST["p{$respuestaBD[0]}"])) {

                            if(isset($_POST["id{$respuestaBD[0]}"])){
                                $respuesta = new RespuestaFichaMD((int) $_POST["id{$respuestaBD[0]}"], $id, $_POST["{$respuestaBD[0]}"], (int) $_POST["p{$respuestaBD[0]}"]);

                                RespuestaFichaBD::actualizarRespuestaFicha($respuesta);
                            }


                        }else{

                            $respuesta=new RespuestaFichaMD((int) $respuestaBD[0],null,null,null,false);
                            RespuestaFichaBD::eliminarRespuestaFicha($respuesta);
                        }
                    }
                    $aux = false;
                }
                $x = $x + 1;

            }

            $ruta = constant('URL');

            echo "<script>window.location='{$ruta}preguntaficha'</script>";

            $this->inicio();

        }

    }

    function buscar(){

        if ($_GET){



            $key =$_GET["key"];




            $seccionesFicha = SeccionFichaBD::seleccionarSeccionFicha(null, 0);
            $preguntas = PreguntaFichaBD::seleccionarPreguntaFicha($key,4);

            require cargarVistaAdmin('pregunta/index.php');
        }

    }


    function eliminar(){
        if ($_POST){
          $id = (int) $_POST["idPregunta"];

          $pregunta = new PreguntaFichaMD($id, null, null ,null, null, null, null, null,  false);

          $ok = PreguntaFichaBD::eliminarPreguntaFicha($pregunta);
          $ruta=constant('URL');

          echo "<script>window.location='{$ruta}preguntaficha'</script>";
          $this->inicio();
        }
     }

}
