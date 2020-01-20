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
      $dp = 1;
      $th = 0;
      $fechas = [];
      while ($fc <= $ff) {
        foreach ($dias as $d) {
          $dia = $d['dia_sesion'];
          $th += $d['num_horas'];
          if ($di == $df) {
            $da = 7;
          } else {
            $da = self::getDias($dp, $dia);
          }
          $dp = $d['dia_sesion'];

          $fc = $fc->add(new DateInterval('P'.$da.'D'));
          array_push($fechas, [
            'fecha' => str_replace('-', '/', $fc->format('d-m-Y')),
            'dia' => $dia
          ]);
        }
      }
      $res['total_horas'] = $th;
      $res['dias'] = $dias;
      $res['fechas'] = $fechas;
      return $res;
    }
  }
//1332	TAS  NOVIEMBRE/2019   ABRIL/2020	BASE DE DATOS II	0101678290	MARCELO MENDEZ	5	N5A	20	13

//1233	TDS  NOVIEMBRE/2019   ABRIL/2020 	FUNDAMENTOS DE REDES Y CONECTIVIDAD	0104399860	WILLIAMS TRELLES	5	M5A	30	26

//1228	TDS  NOVIEMBRE/2019   ABRIL/2020 	TENDENCIAS ACTUALES DE PROGRAMACIÓN	0104069968	PEDRO CORNEJO	5	M5A	30	26
  static function getSoloFechasClaseCurso($idCurso) {
    $res = SesionBD::getDiasByCurso($idCurso);
    if (isset($res['error'])) {
      return $res;
    } else {
      $fi = $res['prd_lectivo_fecha_inicio'];
      $ff = $res['prd_lectivo_fecha_fin'];
      $di = $res['dia_inicia'];
      $df = $res['dia_fin'];
      $asistenciaGuardada = $res['fechas_asistencia_guardada'];

      $fa = $fi;
      $dias = $res['dias'];
      $dias = json_decode($dias, true);

      $fc = new DateTime($fi);
      $ff = new DateTime($ff);

      $da = 0;
      $dp = 1;
      $th = 0;
      $fechas = [];

      while ($fc <= $ff) {
        foreach ($dias as $d) {
          $dia = $d['dia_sesion'];
          $th += $d['num_horas'];
          if ($di == $df) {
            $da = 7;
          } else {
            $da = self::getDias($dp, $dia);
          }
          $dp = $d['dia_sesion'];

          $fc = $fc->add(new DateInterval('P'.$da.'D'));

          $fechaGenerada = str_replace ('-', '/', $fc->format('d-m-Y'));

          $fechaGuardada = strpos(
            $asistenciaGuardada,
            $fechaGenerada
          ) != 0 ? 1 : 0;

          array_push($fechas, [
            'id_curso' => (int) $idCurso,
            'fecha' => $fechaGenerada,
            'dia' => $dia,
            'horas' => $d['num_horas'],
            'asistencia_guardada' => $fechaGuardada
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
        $asistenciaGuardada = $sesion['fechas_asistencia_guardada'];

        $fa = $fi;
        $dias = $sesion['dias'];
        $dias = json_decode($dias, true);

        $fc = new DateTime($fi);
        $ff = new DateTime($ff);

        $da = 0;
        $dp = 1;
        $th = 0;

        while ($fc <= $ff) {
          foreach ($dias as $d) {
            $dia = $d['dia_sesion'];
            $th += $d['num_horas'];
            if ($di == $df) {
              $da = 7;
            } else {
              $da = FechasClaseSV::getDias($dp, $dia);
            }
            $dp = $d['dia_sesion'];

            $fc = $fc->add(new DateInterval('P'.$da.'D'));

            $fechaGenerada = str_replace ('-', '/', $fc->format('d-m-Y'));

            $fechaGuardada = strpos(
              $asistenciaGuardada,
              $fechaGenerada
            ) != 0 ? 1 : 0;

            array_push($fechas, [
              'id_curso' => $sesion['id_curso'],
              'fecha' => $fechaGenerada,
              'dia' => $dia,
              'horas' => $d['num_horas'],
              'asistencia_guardada' => $fechaGuardada
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
