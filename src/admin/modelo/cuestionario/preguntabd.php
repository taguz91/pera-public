<?php
declare (strict_types = 1);
require_once 'src/admin/modelo/cuestionario/preguntamd.php';

abstract class PreguntaFichaBD
{

    public static function insertarPreguntaFicha(PreguntaFichaMD $nuevaPregunta)
    {

        $pst = getCon()->prepare('INSERT INTO "PreguntasFicha"(
                                id_seccion_ficha, pregunta_ficha, pregunta_ficha_ayuda,
                                pregunta_ficha_respuesta_tipo, pregunta_ficha_tipo, pregunta_ficha_activa,
                                pregunta_ficha_respuesta_campo, pregunta_ficha_posicion)
                                VALUES ( ?, ?, ?, ?, ?, ?, ?, ?) RETURNING id_pregunta_ficha');

        $pst->execute(array($nuevaPregunta->getIdSeccionFicha(), $nuevaPregunta->getPreguntaFicha(),
            $nuevaPregunta->getPreguntaFichaAyuda(), $nuevaPregunta->getPreguntaFichaRespuestaTipo(),
            $nuevaPregunta->getPreguntaFichaTipo(), $nuevaPregunta->getPreguntaFichaActiva(),
            $nuevaPregunta->getPreguntaFichaRespuestaCampo(), $nuevaPregunta->getPreguntaFichaPosicion()));

        return $pst->fetchColumn();
    }

    public static function seleccionarPreguntaFicha($key, int $op)
    {

        $pst = null;
        if ($key == null) {
            $pst = getCon()->prepare('SELECT id_pregunta_ficha, sf.seccion_ficha_nombre, pregunta_ficha, pregunta_ficha_ayuda, pf.id_seccion_ficha,
                                         pregunta_ficha_activa, pregunta_ficha_respuesta_tipo, pregunta_ficha_tipo,pregunta_ficha_respuesta_campo, pregunta_ficha_posicion
                                    FROM "PreguntasFicha" pf JOIN "SeccionesFicha" sf
                                    ON pf.id_seccion_ficha = sf.id_seccion_ficha
                                    WHERE pregunta_ficha_activa=true
                                    ORDER BY id_pregunta_ficha');
            $pst->execute();
        } else {

            switch ($op) {

                case 1:
                    $pst = getCon()->prepare('SELECT id_pregunta_ficha, sf.seccion_ficha_nombre, pregunta_ficha, pregunta_ficha_ayuda, pf.id_seccion_ficha,
                                         pregunta_ficha_activa, pregunta_ficha_respuesta_tipo, pregunta_ficha_tipo, pregunta_ficha_respuesta_campo, pregunta_ficha_posicion
                                        FROM "PreguntasFicha" pf JOIN "SeccionesFicha" sf
                                        ON pf.id_seccion_ficha = sf.id_seccion_ficha
                                        WHERE pregunta_ficha_activa=true
                                        AND id_pregunta_ficha=?');
                    $pst->execute($key);

                    break;

                case 2:
                    $pst = getCon()->prepare('SELECT id_pregunta_ficha, sf.seccion_ficha_nombre, pregunta_ficha, pregunta_ficha_ayuda, pf.id_seccion_ficha,
                                         pregunta_ficha_activa, pregunta_ficha_respuesta_tipo, pregunta_ficha_tipo, pregunta_ficha_respuesta_campo, pregunta_ficha_posicion
                                        FROM "PreguntasFicha" pf JOIN "SeccionesFicha" sf
                                        ON pf.id_seccion_ficha = sf.id_seccion_ficha
                                        WHERE pregunta_ficha_activa=true
                                        AND sf.seccion_ficha_nombre=?');
                    $pst->execute($key);
                    break;

                case 3:
                    $pst = getCon()->prepare('SELECT id_pregunta_ficha, sf.seccion_ficha_nombre, pregunta_ficha, pregunta_ficha_ayuda, pf.id_seccion_ficha,
                                         pregunta_ficha_activa, pregunta_ficha_respuesta_tipo, pregunta_ficha_tipo, pregunta_ficha_respuesta_campo, pregunta_ficha_posicion
                                        FROM "PreguntasFicha" pf JOIN "SeccionesFicha" sf
                                        ON pf.id_seccion_ficha = sf.id_seccion_ficha
                                        WHERE pregunta_ficha_activa=true
                                        AND pregunta_ficha_respuesta_tipo=?');
                    $pst->execute($key);
                    break;

                case 4:

                    $pst = getCon()->prepare("SELECT id_pregunta_ficha, sf.seccion_ficha_nombre, pregunta_ficha, pregunta_ficha_ayuda, pf.id_seccion_ficha,
                                        pregunta_ficha_activa, pregunta_ficha_respuesta_tipo, pregunta_ficha_tipo, pregunta_ficha_respuesta_campo, pregunta_ficha_posicion
                                        FROM \"PreguntasFicha\" pf JOIN \"SeccionesFicha\" sf
                                        ON pf.id_seccion_ficha = sf.id_seccion_ficha
                                        WHERE pregunta_ficha_activa=true
                                        AND (pregunta_ficha ILIKE '%{$key}%' OR sf.seccion_ficha_nombre ILIKE '%{$key}%')");

                    $pst->execute();

                    break;

                default:
                    break;
            }

        }

        return $pst->fetchAll();

    }

    public static function actualizarPreguntaFicha(PreguntaFichaMD $pregunta)
    {

        $pst = getCon()->prepare('UPDATE "PreguntasFicha"
                                SET id_seccion_ficha=?, pregunta_ficha=?, pregunta_ficha_ayuda=?,
                                 pregunta_ficha_activa=?, pregunta_ficha_respuesta_tipo=?, pregunta_ficha_tipo=?,
                                 pregunta_ficha_respuesta_campo=?, pregunta_ficha_posicion=?
                                WHERE id_pregunta_ficha=?' );
        return $pst->execute(array($pregunta->getIdSeccionFicha(), $pregunta->getPreguntaFicha(),
            $pregunta->getPreguntaFichaAyuda(),  $pregunta->getPreguntaFichaActiva(),
             $pregunta->getPreguntaFichaRespuestaTipo(),$pregunta->getPreguntaFichaTipo(),
             $pregunta->getPreguntaFichaRespuestaCampo(),$pregunta->getPreguntaFichaPosicion(),
             $pregunta->getIdPreguntaFicha()));

    }

    public static function eliminarPreguntaFicha(PreguntaFichaMD $pregunta)
    {

        $pst = getCon()->prepare('UPDATE "PreguntasFicha"
                                SET  pregunta_ficha_activa=false
                                WHERE id_pregunta_ficha=?');

        return $pst->execute(array($pregunta->getIdPreguntaFicha()));

    }
}
