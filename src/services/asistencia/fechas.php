<?php

class FechasClaseSV {

  static function getFechasClaseCurso($idCurso) {
    $res = SesionBD::getDiasByCurso($idCurso);
    if (isset($res['error'])) {
      return $res;
    } else {
      $fi = $res['prd_lectivo_fecha_inicio'];
      $ff = $res['prd_lectivo_fecha_fin'];
      $di = $res['dia_inicia'];
      $df = $res['dia_fin'];

      $fa = $fi;
      $dias = $res['dias'];
      $dias = json_decode($dias, true);

      $fc = new DateTime($fi);
      $ff = new DateTime($ff);

      $da = 0;
      $dp = $di;
      $th = 0;
      $fechas = [];
      while ($fc <= $ff) {
        foreach ($dias as $d) {
          $dia = $d['dia_sesion'];
          $th += $d['num_horas'];
          if ($di == $df) {
            //echo "<br> Dia fin de clase: ".$dp."<br>";
            $da = 8;
          } else {
            //echo "<br> Dia anterior: ".$dp
            //." Dia toca: ".$dia."<br>";
            $da = self::getDias($dp, $dia);
          }
          $dp = $d['dia_sesion'];

          //echo "Dia actualizaremos: ".$da." <br>";

          $fc = $fc->add(new DateInterval('P'.$da.'D'));
          //echo "Dia: " . $fc->format('w') . '<br>';
          //echo $fc->format('d-m-y') . '<br>';
          array_push($fechas, [
            'fecha' => str_replace ('-', '/', $fc->format('d-m-Y')),
            'dia' => $dia
          ]);
        }
      }
      /*
      echo "Horas: " . $th;
      echo "<hr>";
      $json = [
        'fecha_inicio' => $res['prd_lectivo_fecha_inicio'],
        'fecha_fin' => $res['prd_lectivo_fecha_fin'],
        'total_horas' => $th,
        'fecha' => $fechas
      ];*/
      $res['total_horas'] = $th;
      $res['dias'] = $dias;
      $res['fechas'] = $fechas;
      return $res;
    }
  }

  static function getSoloFechasClaseCurso($idCurso) {
    $res = SesionBD::getDiasByCurso($idCurso);
    if (isset($res['error'])) {
      return $res;
    } else {
      $fi = $res['prd_lectivo_fecha_inicio'];
      $ff = $res['prd_lectivo_fecha_fin'];
      $di = $res['dia_inicia'];
      $df = $res['dia_fin'];

      $fa = $fi;
      $dias = $res['dias'];
      $dias = json_decode($dias, true);

      $fc = new DateTime($fi);
      $ff = new DateTime($ff);

      $da = 0;
      $dp = $di;
      $th = 0;
      $fechas = [];
      while ($fc <= $ff) {
        foreach ($dias as $d) {
          $dia = $d['dia_sesion'];
          $th += $d['num_horas'];
          if ($di == $df) {
            $da = 8;
          } else {
            $da = self::getDias($dp, $dia);
          }
          $dp = $d['dia_sesion'];

          $fc = $fc->add(new DateInterval('P'.$da.'D'));
          array_push($fechas, [
            'id_curso' => (int) $idCurso,
            'fecha' => str_replace ('-', '/', $fc->format('d-m-Y')),
            'dia' => $dia,
            'horas' => $d['num_horas']
          ]);
        }
      }
      return $fechas;
    }
  }


  static function getSoloFechasClaseIdentificacion($identificacion) {
    $res = SesionBD::getDiasByDocente($identificacion);
    if (isset($res['error'])) {
      return $res;
    } else {
      $fechas = [];
      foreach ($res as $sesion) {
        $fi = $sesion['prd_lectivo_fecha_inicio'];
        $ff = $sesion['prd_lectivo_fecha_fin'];
        $di = $sesion['dia_inicia'];
        $df = $sesion['dia_fin'];

        $fa = $fi;
        $dias = $sesion['dias'];
        $dias = json_decode($dias, true);

        $fc = new DateTime($fi);
        $ff = new DateTime($ff);

        $da = 0;
        $dp = $di;
        $th = 0;

        while ($fc <= $ff) {
          foreach ($dias as $d) {
            $dia = $d['dia_sesion'];
            $th += $d['num_horas'];
            if ($di == $df) {
              $da = 8;
            } else {
              $da = FechasClaseSV::getDias($dp, $dia);
            }
            $dp = $d['dia_sesion'];

            $fc = $fc->add(new DateInterval('P'.$da.'D'));
            array_push($fechas, [
              'id_curso' => $sesion['id_curso'],
              'fecha' => str_replace ('-', '/', $fc->format('d-m-Y')),
              'dia' => $dia,
              'horas' => $d['num_horas']
            ]);
          }
        }
      }
      return $fechas;
    }
  }

  static function getDias($di, $df){
    $c = 0;
    $continua = true;
    $d = $di;
    while($continua) {
      if ($df == $d) {
        $continua = false;
      } else {
        $c++;
        $d++;
        if ($d == 8) {
          $d = 1;
        }
        if ($d == $df) {
          $continua = false;
        }
      }
    }
    return $c;
  }

}
