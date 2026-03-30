<?php

class Coche extends Vehiculo{
    private $numeroPuertas;
    private $tipoCombustible;

    function __construct($marca, $modelo, $matricula, $precioDia, $numeroPuertas, $tipoCombustible, $id=0){
        parent::__construct($marca, $modelo, $matricula, $precioDia, $id);
        $this->numeroPuertas=$numeroPuertas;
        $this->tipoCombustible=$tipoCombustible;
    }

    public function getNumeroPuertas(){
        return $this->numeroPuertas;   
    }
    public function getTipoCombustible(){
        return $this->tipoCombustible;   
    }

    public function setNumeroPuertas($numeroPuertas){
        $this->numeroPuertas = $numeroPuertas;
    }
    public function setTipoCombustible($tipoCombustible){
        $this->tipoCombustible = $tipoCombustible;
    }

    public function calcularAlquiler($dias){
        $total =$dias * $this->precioDia;
        
        if($this->tipoCombustible == 'Electrico'){
            $total = $total*1.05;
        }
        return $total;
    }
    
}