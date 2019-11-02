<?php
declare (strict_types = 1);
require_once 'src/admin/modelo/cuestionario/respuestamd.php';

abstract class RespuestaFichaBD
{

    public static function insertarRespuestaFicha(RespuestaFichaMD $nuevaRespuesta)
    {
        $pst = getCon()->prepare('INSERT INTO public."RespuestaFicha"(
                                 id_pregunta_ficha, respuesta_ficha, respuesta_ficha_puntaje, respuesta_ficha_activa)
                                 VALUES ( ?, ?, ?, ?)');

        return $pst->execute(array($nuevaRespuesta->getIdPreguntaFicha(), $nuevaRespuesta->getRespuestaFicha(),
                                    $nuevaRespuesta->getRespuestaFichaPuntaje(), $nuevaRespuesta->getRespuestaFichaActiva()));

    }

    static function seleccionarRespuestaFicha($key){
        $pst=getCon()->prepare('SELECT id_respuesta_ficha, id_pregunta_ficha, respuesta_ficha, respuesta_ficha_puntaje, respuesta_ficha_activa
                                    FROM "RespuestaFicha"
                                    WHERE respuesta_ficha_activa=true AND id_pregunta_ficha=?
                                    ORDER BY id_respuesta_ficha');
        $pst->execute(array($key));
        return $pst->fetchAll();
    }


    static function actualizarRespuestaFicha(RespuestaFichaMD $respuesta){

        $pst=getCon()->prepare('UPDATE public."RespuestaFicha"
                                SET id_pregunta_ficha=?, respuesta_ficha=?, respuesta_ficha_puntaje=?, respuesta_ficha_activa=?
                                WHERE id_respuesta_ficha=?');
        return $pst->execute(array($respuesta->getIdPreguntaFicha(), $respuesta->getRespuestaFicha(),
                                   $respuesta->getRespuestaFichaPuntaje(), $respuesta->getRespuestaFichaActiva(),
                                    $respuesta->getIdRespuestaFicha() ));

    }

    static function eliminarRespuestaFicha(RespuestaFichaMD $respuesta){

        $pst=getCon()->prepare('UPDATE "RespuestaFicha"
                                SET  respuesta_ficha_activa=false
                                WHERE id_respuesta_ficha=?');

        return $pst->execute(array($respuesta->getIdRespuestaFicha()));

    }





}
