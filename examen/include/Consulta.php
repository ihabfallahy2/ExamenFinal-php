<?php
class Consulta {
    public $id;
    public $usuario;
    public $cantidad;
    public $criptomoneda;
    public $siglas;
    public $equivalencia;
    public $time;

    function __construct($row) {
        $this->id=$row['id'];
        $this->usuario=$row['usuario'];
        $this->cantidad=$row['cantidad'];
        $this->criptomoneda=$row['criptomoneda'];
        $this->siglas=$row['siglas'];
        $this->equivalencia=$row['equivalencia'];
        $this->time=$row['time'];
    }

    // public static function getId(){
        
    // }
    


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of usuario
     */ 
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Get the value of cantidad
     */ 
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Get the value of criptomoneda
     */ 
    public function getCriptomoneda()
    {
        return $this->criptomoneda;
    }

    /**
     * Get the value of siglas
     */ 
    public function getSiglas()
    {
        return $this->siglas;
    }

    /**
     * Get the value of equivalencia
     */ 
    public function getEquivalencia()
    {
        return $this->equivalencia;
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }
}
?>