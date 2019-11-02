<?php
declare(strict_types=1);

class RespuestaFichaMD{


    private $idRespuestaFicha;
    private $idPreguntaFicha;
    private $respuestaFicha;
    private $respuestaFichaPuntaje;
    private $respuestaFichaActiva;


    function __construct( int $idRespuestaFicha=null, int $idPreguntaFicha=null, string $respuestaFicha=null,
                            int $respuestaFichaPuntaje=null, bool $respuestaFichaActiva=true  )
    {
        if($idRespuestaFicha!=null){
           $this->idRespuestaFicha=$idRespuestaFicha;
        }

        $this->idPreguntaFicha=$idPreguntaFicha;
        $this->respuestaFicha=$respuestaFicha;
        $this->respuestaFichaPuntaje=$respuestaFichaPuntaje;
        $this->respuestaFichaActiva=$respuestaFichaActiva;
        
    }

    
    public function getIdRespuestaFicha():int
    {
        return $this->idRespuestaFicha;
    }

    public function setIdRespuestaFicha($idRespuestaFicha)
    {
        $this->idRespuestaFicha = $idRespuestaFicha;

        return $this;
    }

  
    public function getIdPreguntaFicha():int
    {
        return $this->idPreguntaFicha;
    }


    public function setIdPreguntaFicha($idPreguntaFicha)
    {
        $this->idPreguntaFicha = $idPreguntaFicha;

        return $this;
    }


    public function getRespuestaFicha():string
    {
        return $this->respuestaFicha;
    }

    public function setRespuestaFicha($respuestaFicha)
    {
        $this->respuestaFicha = $respuestaFicha;

        return $this;
    }

    public function getRespuestaFichaPuntaje()
    {
        return $this->respuestaFichaPuntaje;
    }


    public function setRespuestaFichaPuntaje($respuestaFichaPuntaje)
    {
        $this->respuestaFichaPuntaje = $respuestaFichaPuntaje;

        return $this;
    }


    public function getRespuestaFichaActiva():bool
    {
        return $this->respuestaFichaActiva;
    }

    public function setRespuestaFichaActiva($respuestaFichaActiva)
    {
        $this->respuestaFichaActiva = $respuestaFichaActiva;

        return $this;
    }
}