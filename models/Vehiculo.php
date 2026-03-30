<?php

class Vehiculo {
    protected $id;
    protected $marca;
    protected $modelo;
    protected $matricula;
    protected $precioDia;

    public function __construct($marca, $modelo, $matricula, $precioDia, $id=0) {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->matricula = $matricula;
        $this->precioDia = $precioDia;
    }

    public function getId() { 
        return $this->id; 
    }
    public function getMarca() { 
        return $this->marca; 
    }
    public function getModelo() { 
        return $this->modelo; 
    }
    public function getMatricula() { 
        return $this->matricula; 
    }
    public function getPrecioDia() { 
        return $this->precioDia; 
    }

    public function setId($id) { 
        $this->id = $id; 
    }
    public function setMarca($marca) { 
        $this->marca = $marca; 
    }
    public function setNombre($modelo) { 
        $this->modelo = $modelo; 
    }
    public function setMatricula($matricula) { 
        $this->matricula = $matricula; 
    }
    public function setPrecioDia($precioDia) { 
        $this->precioDia = $precioDia; 
    }

    public function calcularAlquiler($dias){
        return $dias * $this->precioDia;
    }
}

?>