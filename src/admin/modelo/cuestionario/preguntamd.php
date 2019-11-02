<?php
declare(strict_types=1);

class PreguntaFichaMD{

    private $idPreguntaFicha;
    private $idSeccionFicha;
    private $preguntaFicha;
    private $preguntaFichaAyuda;
    private $preguntaFichaTipo;
    private $preguntaFichaRespuestaTipo;
    private $preguntaFichaActiva;
    private $preguntaFichaRespuestaCampo; 
    private $preguntaFichaPosicion;


    function __construct(int $idPreguntaFicha=null, int $idSeccionFicha=null, string $preguntaFicha=null,string $preguntaFichaAyuda=null,
                             int $preguntaFichaTipo=null, int $preguntaFichaRespuestaTipo=null , string $preguntaFichaRespuestaCampo=null, 
                             int $preguntaFichaPosicion=null, bool $preguntaFichaActiva=true)
    {
        
        if($idPreguntaFicha!=null){
            $this->idPreguntaFicha=$idPreguntaFicha;
        }

        $this->idSeccionFicha=$idSeccionFicha;
        $this->preguntaFicha=$preguntaFicha;
        $this->preguntaFichaAyuda=$preguntaFichaAyuda;
        $this->preguntaFichaTipo=$preguntaFichaTipo;
        $this->preguntaFichaRespuestaTipo=$preguntaFichaRespuestaTipo;
        $this->preguntaFichaActiva=$preguntaFichaActiva;
        $this->preguntaFichaRespuestaCampo=$preguntaFichaRespuestaCampo;
        $this->preguntaFichaPosicion=$preguntaFichaPosicion;

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


    public function getIdSeccionFicha():int
    {
        return $this->idSeccionFicha;
    }
 

    public function setIdSeccionFicha($idSeccionFicha)
    {
        $this->idSeccionFicha = $idSeccionFicha;

        return $this;
    }


    public function getPreguntaFicha():string
    {
        return $this->preguntaFicha;
    }


    public function setPreguntaFicha($preguntaFicha)
    {
        $this->preguntaFicha = $preguntaFicha;

        return $this;
    }


    public function getPreguntaFichaAyuda():string
    {
        return $this->preguntaFichaAyuda;
    }


    public function setPreguntaFichaAyuda($preguntaFichaAyuda)
    {
        $this->preguntaFichaAyuda = $preguntaFichaAyuda;

        return $this;
    }


    public function getPreguntaFichaTipo():int
    {
        return $this->preguntaFichaTipo;
    }


    public function setPreguntaFichaTipo($preguntaFichaTipo)
    {
        $this->preguntaFichaTipo = $preguntaFichaTipo;

        return $this;
    }


    public function getPreguntaFichaRespuestaTipo():int
    {
        return $this->preguntaFichaRespuestaTipo;
    }


    public function setPreguntaFichaRespuestaTipo($preguntaFichaRespuestaTipo)
    {
        $this->preguntaFichaRespuestaTipo = $preguntaFichaRespuestaTipo;

        return $this;
    }

    public function getPreguntaFichaActiva():bool
    {
        return $this->preguntaFichaActiva;
    }


    public function setPreguntaFichaActiva($preguntaFichaActiva)
    {
        $this->preguntaFichaActiva = $preguntaFichaActiva;

        return $this;
    }


    public function getPreguntaFichaRespuestaCampo():string
    {
        return $this->preguntaFichaRespuestaCampo;
    }


    public function setPreguntaFichaRespuestaCampo($preguntaFichaRespuestaCampo)
    {
        $this->preguntaFichaRespuestaCampo = $preguntaFichaRespuestaCampo;

        return $this;
    }

 
    public function getPreguntaFichaPosicion():int
    {
        return $this->preguntaFichaPosicion;
    }

 
    public function setPreguntaFichaPosicion($preguntaFichaPosicion)
    {
        $this->preguntaFichaPosicion = $preguntaFichaPosicion;

        return $this;
    }
}