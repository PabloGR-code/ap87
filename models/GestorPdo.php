<?php

class GestorPDO extends Connection{

    public function __construct() {
        parent::__construct();
    }

    public function listar() {
        $consulta="SELECT * FROM vehiculo";
        $rtdo=$this->conn->query($consulta);
        $arrayVehiculo=[];
        while ($value = $rtdo->fetch(PDO::FETCH_ASSOC)){
            if($value['tipoVehiculo'] == 'Coche'){
                $vehiculo=new Coche($value['marca'], $value['modelo'], $value['matricula'], $value['precioDia'], $value['numeroPuertas'], $value['tipoCombustible'], $value['id']);
            }else{
                $vehiculo=new Motocicleta($value['marca'], $value['modelo'], $value['matricula'], $value['precioDia'], $value['cilindrada'], $value['incluyeCasco'], $value['id']);
            }
            
            $arrayVehiculo[]=$vehiculo;
        }
        return $arrayVehiculo;
    }
    public function agregar($vehiculo) {
    try {

        if ($vehiculo instanceof Coche) {

            $sql = "INSERT INTO vehiculo 
            (tipoVehiculo, marca, modelo, matricula, precioDia, numeroPuertas, tipoCombustible) 
            VALUES ('Coche', :marca, :modelo, :matricula, :precioDia, :numeroPuertas, :tipoCombustible)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':marca', $vehiculo->getMarca());
            $stmt->bindValue(':modelo', $vehiculo->getModelo());
            $stmt->bindValue(':matricula', $vehiculo->getMatricula());
            $stmt->bindValue(':precioDia', $vehiculo->getPrecioDia());
            $stmt->bindValue(':numeroPuertas', $vehiculo->getNumeroPuertas());
            $stmt->bindValue(':tipoCombustible', $vehiculo->getTipoCombustible());

        } elseif ($vehiculo instanceof Motocicleta) {

            $sql = "INSERT INTO vehiculo 
            (tipoVehiculo, marca, modelo, matricula, precioDia, cilindrada, incluyeCasco) 
            VALUES ('Motocicleta', :marca, :modelo, :matricula, :precioDia, :cilindrada, :incluyeCasco)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':marca', $vehiculo->getMarca());
            $stmt->bindValue(':modelo', $vehiculo->getModelo());
            $stmt->bindValue(':matricula', $vehiculo->getMatricula());
            $stmt->bindValue(':precioDia', $vehiculo->getPrecioDia());
            $stmt->bindValue(':cilindrada', $vehiculo->getCilindrada());
            $stmt->bindValue(':incluyeCasco', $vehiculo->getIncluyeCasco());
        }

        return $stmt->execute();

    } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
    
}
    }

    
    public function buscar($id) {
    $sql = "SELECT * FROM vehiculo WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    $value = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$value) return null;

    if ($value['tipoVehiculo'] == 'Coche') {
        return new Coche(
            $value['marca'],
            $value['modelo'],
            $value['matricula'],
            $value['precioDia'],
            $value['numeroPuertas'],
            $value['tipoCombustible'],
            $value['id']
        );
    } else {
        return new Motocicleta(
            $value['marca'],
            $value['modelo'],
            $value['matricula'],
            $value['precioDia'],
            $value['cilindrada'],
            $value['incluyeCasco'],
            $value['id']
        );
    }
    }
    public function actualizar($vehiculo) {

    if ($vehiculo instanceof Coche) {

        $sql = "UPDATE vehiculo SET 
        marca=:marca, modelo=:modelo, matricula=:matricula, precioDia=:precioDia,
        numeroPuertas=:numeroPuertas, tipoCombustible=:tipoCombustible
        WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':numeroPuertas', $vehiculo->getNumeroPuertas());
        $stmt->bindValue(':tipoCombustible', $vehiculo->getTipoCombustible());

    } else {

        $sql = "UPDATE vehiculo SET 
        marca=:marca, modelo=:modelo, matricula=:matricula, precioDia=:precioDia,
        cilindrada=:cilindrada, incluyeCasco=:incluyeCasco
        WHERE id=:id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':cilindrada', $vehiculo->getCilindrada());
        $stmt->bindValue(':incluyeCasco', $vehiculo->getIncluyeCasco());
    }

    $stmt->bindValue(':marca', $vehiculo->getMarca());
    $stmt->bindValue(':modelo', $vehiculo->getModelo());
    $stmt->bindValue(':matricula', $vehiculo->getMatricula());
    $stmt->bindValue(':precioDia', $vehiculo->getPrecioDia());
    $stmt->bindValue(':id', $vehiculo->getId());

    return $stmt->execute();
    }
    public function eliminar($id) {
        $sql="DELETE FROM vehiculo WHERE id=:id";
        $stmt=$this->conn->prepare($sql);
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }
    public function registrarUsuario(Usuario $usuario) {
        try {
            $sql = "INSERT INTO Usuario (email, password) VALUES (:email, :password)";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());

            return $stmt->execute(); 
            
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getCode();
        }
    }
    public function buscarUsuarioPorEmail($email) {
        $sql = "SELECT * FROM Usuario WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $value = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($value) {
            return new Usuario($value['email'], $value['password'], $value['id']);
        }
        return false;
    }
}