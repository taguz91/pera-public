<?php
require_once 'src/controlador/socioenomica.php';
require_once 'src/controlador/ocupacional.php';
require_once 'src/modelo/fichas/fichabd.php';
require_once 'src/modelo/fichas/seccionbd.php';
require_once 'src/modelo/persona/personafichabd.php';
require_once  'vendor/autoload.php';
class FichaCTR extends CTR implements DCTR {

  function __construct(){
    parent::__construct("todos");
  }

  function inicio($msg = '') {
    global $U;
    if(isset($_SESSION['id_persona_ficha'])){
      unset($_SESSION['id_persona_ficha']);
    }
    $fichas = FichaBD::getPorPersona($U->idPersona);
    require_once cargarVista('fichas/ficha.php');
  }

  function ingresar() {
    global $U;
    switch ($U->tipo) {
      case 'A':
        //Cargamos la ficha socioeconomica
        $this->ingresarFS();
        break;
      case 'D':
        echo "NO TENEMOS EL FORMULARIO OCUPACIONAL, ESTA EN DESARROLLO";
        break;
      default:
        $this->inicio(getErrorMsg('Debe indicar la consena para llenar la ficha.'));
        break;
    }
  }

  function verficha($idPersonaFicha){
    global $U;
    switch ($U->tipo) {
      case 'A':
        $this->verfichaFS($idPersonaFicha);
        break;
      case 'D':
        echo "NO TENEMOS EL FORMULARIO OCUPACIONAL, ESTA EN DESARROLLO";
        break;
      default:
        $this->inicio(getErrorMsg('No tiene permitido ver esta ficha.'));
        break;
    }
  }

  function finalizar(){
    $idPersonaFicha = isset($_SESSION['id_persona_ficha']) ? $_SESSION['id_persona_ficha'] : 0;
    if($idPersonaFicha != 0){
      $res = PersonaFichaBD::finalizar($idPersonaFicha);
      if($res != null){
        $this->inicio(getInfoMsg('Finalizamos correctamente su ficha.
        <a href="http://35.192.7.211/home" target="_blank">Ingresar Ficha Salud</a>'));
      } else {
        $this->inicio(getErrorMsg('En este momento no pudimos finalizar su ficha, por favor vuelva a intentarlo mas tarde.'));
      }
    } else {
      $this->inicio(getErrorMsg('No pudimos finalizar su ficha, porque no indico que ficha finalizara.'));
    }
  }

  private function ingresarFS(){
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';
    $idPer = isset($_POST['idper']) ? $_POST['idper'] : 0;

    if($pass != '' && $idPer != 0){
      $idPersonaFicha = PersonaFichaBD::getPorLogin(
        $idPer,
        $pass
      );
      PersonaFichaBD::actualizarFecha($idPersonaFicha);
      $_SESSION['id_persona_ficha'] = $idPersonaFicha;
      $secciones = $this->getFS($idPersonaFicha);
      require_once cargarVista('fichas/socioeconomica/ingresar.php');
    } else {
      $this->inicio(getErrorMsg('Debe ingresar su contrasena nuevamente.'));
    }
  }

  private function verfichaFS($idPersonaFicha){
    $secciones = $this->getFS($idPersonaFicha);
    require_once cargarVista('fichas/socioeconomica/ver.php');
  }

  private function getFS($idPersonaFicha){
    $res = SeccionBD::getFSPorIDPersonaFicha($idPersonaFicha);
    return json_decode($res['secciones'], true);
  }

  function rep(){
    $res = SeccionBD::getRep();
    var_dump($res);
  }

  function json(){
    

    $mpdf = new \Mpdf\Mpdf();

    $html='<html> 
    <style>
    *{
      font-family: sans-serif;
    }

    table, th,td {
      border-collapse: collapse;
    }

    th, td {
      padding: 0.6% 1%;
    }

    th {
      width: 40%;
      text-align: left; 
    }
    </style>
    <caption>
    <img src="src/vista/imagenes/1.png" width="450" height="100" >
    </caption>
    ';
   
    $res = SeccionBD::getJSON();
    //var_dump($res);
    $res  = json_decode($res['alumnos'], true);
    //var_dump($res);
    $alumno = $res[0];
    $ficha = $alumno['ficha'];
    $ficha = $ficha[0];
    $secciones = $alumno['secciones'];
    //var_dump($alumno);
   
    $html.='<caption><h2>'.$ficha['tipo_ficha'].'</h2></caption>';
    
    $html.='<h4>DATOS DE IDENTIFICACIÓN</h4>
    <table border="1"  width="100%">
<tr>
    <th >Nombres y Apellidos completos:</th>
    <td  >'.'      '.$alumno['persona_primer_nombre'].' '.$alumno['persona_segundo_nombre'].' '.$alumno['persona_primer_apellido'].' '.$alumno['persona_segundo_apellido'].'       '.'</td>
</tr>';
$html.='
<tr>
 
    <th WIDTH="200">Número de identificación:</th>
    <td>'.$alumno['persona_identificacion'].'</td>
</tr>';
$html.='
<tr>
    
    <th WIDTH="200">Pasaporte:</th>
    <td></td>
</tr>';
$html.='
<tr>
   
    <th WIDTH="200">Fecha de nacimiento:</th>
    <td>'.$alumno['persona_fecha_nacimiento'].'</td>
</tr>';
$html.='
<tr>
  
    <th WIDTH="200">País de nacimiento:</th>
    <td>'.$alumno['pais_nacimiento'].'</td>
</tr>';
$html.='
<tr>
  
    <th WIDTH="200">Provincia de nacimiento:</th>
    <td>'.$alumno['provincia_nacimiento'].'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Cantón de nacimiento:</th>
    <td>'.$alumno['ciudad_nacimiento'].'</td>
</tr>';
$html.='
<tr>
  
    <th WIDTH="200">Parroquia de nacimiento:</th>
    <td>'.$alumno['parroquia_nacimiento'].'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Pais de procedencia:</th>
    <td>'.$alumno['pais_nacimiento'].'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Provincia de procedencia:</th>
    <td>'.$alumno['provincia_nacimiento'].'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Cantón de procedencia:</th>
    <td>'.$alumno['ciudad_nacimiento'].'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Parroquia de procedencia:</th>
    <td>'.$alumno['parroquia_nacimiento'].'</td>
</tr>';


$html.='<tr>
  
    <th WIDTH="200">Sexo:</th>
    <td>'.$alumno['persona_sexo'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Orientacion Sexual:</th>
    <td>'.$alumno['persona_genero'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Estado civil:</th>
    <td>'.$alumno['persona_estado_civil'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Tipo de sangre:</th>
    <td>'.$alumno['persona_tipo_sangre'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Etnia:</th>
    <td>'.$alumno['persona_etnia'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">¿Tiene discapacidad?</th>
    <td>'.$alumno['persona_discapacidad'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Tipo de discapacidad:</th>
    <td>'.$alumno['persona_tipo_discapacidad'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Porcentaje de discapacidad:</th>
    <td>'.$alumno['persona_porcenta_discapacidad'].'</td>
    
</tr>';
$html.='<tr>
  
    <th WIDTH="200">N° carnet CONADIS o del MSP:</th>
   
    <td>'.$alumno['persona_carnet_conadis'].'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Auto percepción de clase social</th>
   
    <td>'.$alumno['persona_tipo_residencia'].'</td>
</tr>';
$html.='</table>';
$html.='<h4>NIVEL ACADÉMICO</h4>
<table border="1"  width="100%">
<tr>
    <th >Carrera:</th>
    <td  >  </td>
</tr>';

$html.='<tr>
  
    <th WIDTH="200">Nivel que cursa:</th>
   
    <td>'.'soy un unicorni'.'</td>
</tr>';
$html.='<tr>
  
    <th WIDTH="200">Ciclo académico:</th>
   
    <td>'.'soy un unicorni'.'</td>
</tr>';
$html.='</table>';
$html.='<h4>CONTACTO:</h4>
<table border="1"  width="100%">
<tr>
  
    <th WIDTH="200">País de residencia:</th>
   
    <td>'.$alumno['pais_residencia'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Provincia de residencia:</th>
   
    <td>'.$alumno['provincia_residencia'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Cantón de residencia:</th>
   
    <td>'.$alumno['ciudad_residencia'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Parroquia de residencia:</th>
   
    <td>'.$alumno['parroquia_residencia'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Sector de residencia:</th>
   
    <td>'.$alumno['sector_residencia'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Calle principal:</th>
   
    <td>'.$alumno['persona_calle_principal'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Calle secundaria:</th>
   
    <td>'.$alumno['persona_calle_secundaria'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Número de casa:</th>
   
    <td>'.$alumno['persona_numero_casa'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Teléfono móvil:</th>
   
    <td>'.$alumno['persona_celular'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Teléfono fijo:</th>
   
    <td>'.$alumno['persona_telefono'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Correo personal:</th>
   
    <td>'.$alumno['persona_correo'].'</td>
</tr>
<tr>
  
    <th WIDTH="200">Nombre de contacto de emergencia:</th>
   
    <td>'.'n/a'.'</td>
</tr>
<tr>
  
    <th WIDTH="200">Teléfono:</th>
   
    <td>'.'n/a'.'</td>
</tr>
<tr>
  
    <th WIDTH="200">E-mail:</th>
   
    <td>'.'n/a'.'</td>
</tr>
</table>



';
foreach ($secciones as $value) {
  $s = $value;
  //var_dump($s);
  $html.='<h4>'.$s['seccion_ficha_nombre'].'</h4>';
  $preguntas = $s['preguntas'];

  $html.='<table border="1"  width="100%">';
  
  $h = '<tr>';
  $b = '<tr>';

  foreach ($preguntas as $pre) {
      $r = $pre['respuesta'];
      $rl = $pre['respuesta_libre'];
      if($r != null){
        //$html.='<table border="1"  width="100%">';
        foreach ($r as $res) {
          $html.='<tr>';
          $html.='<th WIDTH="200">'.$pre['pregunta_ficha'].'</th>';
         
          $html.='<td>'.$res['respuesta_ficha'].'</td>
          </tr>';
        }
        //$html.='</table>';
      }

      if($rl != null){
        //$html.='<table border="1"  width="100%">';
        //$html.='<tr>';
        //$html.='<th WIDTH="200">'.$pre['pregunta_ficha'].'</th>';
        //$html.='</tr>';
        $b .= '<th WIDTH="200">'.$pre['pregunta_ficha'].'</th>';
        foreach ($rl as $resl) {
          //$html.='<tr>';
          //$html.='<td>'.$resl['alumno_fs_libre'].'</td>';
          //$html.='</tr>';
          $b .= '<td>'.$resl['alumno_fs_libre'].'</td>';
        }
        $b .= '</tr> <tr>';
        //$html.='</table>';
      }

      
      
  }
  $html.=  $b;
  $html.='</table>';
 
}

$html.='<p>'.'Yo, '.$alumno['persona_primer_nombre'].' '.$alumno['persona_segundo_nombre'].' '.$alumno['persona_primer_apellido'].' '.$alumno['persona_segundo_apellido'].' '.'  Acepto y declaro que: la información proporcionada en el presente formulario es real y puede ser utilizada para los fines pertinentes, autorizo que el Instituto Superior Tecnológico del Azuay - ISTA a realizar las verificaciones que crean oportunas sobre  la información detallada en el presente documento.'.'</p>';
$html.='<caption><h2>_________________________________</h2></caption> </html> ';
$variable='soy un footer';
$mpdf->SetHTMLHeader($this->header($variable));
$mpdf->setFooter("{PAGENO}");
$mpdf->WriteHTML($html);
$mpdf->Output();
//$mpdf->Output('dfgdfg.pdf',\Mpdf\Output\Destination::DOWNLOAD);
   
    /*$this->impr($alumno['id_persona']);
    $this->impr($alumno['pais_nacimiento']);
   
    $this->impr('Ficha');
    $ficha = $alumno['ficha'];
    $ficha = $ficha[0];
    //var_dump($ficha);
    $this->impr($ficha['tipo_ficha']);
    $this->impr($ficha['tipo_ficha_descripcion']);
    echo "<hr>";
    $secciones = $alumno['secciones'];
    foreach ($secciones as $value) {
      $s = $value;
      //var_dump($s);
      $this->impr($s['seccion_ficha_nombre']);
      $preguntas = $s['preguntas'];
      foreach ($preguntas as $pre) {
          $this->impr($pre['pregunta_ficha']);
          //var_dump($pre);
          $r = $pre['respuesta'];
          $rl = $pre['respuesta_libre'];
          if($r != null){
            foreach ($r as $res) {
              $this->ru($res['respuesta_ficha']);
            }
          }

          if($rl != null){
            foreach ($rl as $resl) {
              $this->rl($resl['alumno_fs_libre']);
            }
          }
      }
      echo "<hr>";
    }*/

  }

  function header($var){
    $footer='
    
    
    <p align="right">'.$var.'</p>
  ';
    return $footer;
  }

  function rl($val){
    echo "<h5>$val</h5>";
  }

  function ru($val){
    echo "<h3>$val</h3>";
  }

}
 ?>
