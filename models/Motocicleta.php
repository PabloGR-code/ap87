<?php

class Motocicleta extends Vehiculo{
    private $cilindrada;
    private $incluyeCasco;

    function __construct($marca, $modelo, $matricula, $precioDia, $cilindrada, $incluyeCasco, $id=0){
        parent::__construct($marca, $modelo, $matricula, $precioDia, $id);
        $this->cilindrada=$cilindrada;
        $this->incluyeCasco=$incluyeCasco;
    }

    public function getCilindrada(){
        return $this->cilindrada;   
    }
    public function getIncluyeCasco(){
        return $this->incluyeCasco;   
    }

    public function setCilindrada($cilindrada){
        $this->cilindrada = $cilindrada;
    }
    public function setIncluyeCasco($incluyeCasco){
        $this->incluyeCasco = $incluyeCasco;
    }

    public function calcularAlquiler($dias){
        $total =$dias * $this->precioDia;
        
        if($this->incluyeCasco){
            $total = $total +10;
        }
        return $total;
    }
}