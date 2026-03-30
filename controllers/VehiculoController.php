<?php

class VehiculoController {
    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function index() {
        $vehiculos = $this->gestor->listar();
        require "views/listar.php";
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $tipo = $_POST['tipoVehiculo'];

            if ($tipo == 'Coche') {
                $vehiculo = new Coche(
                $_POST['marca'],
                $_POST['modelo'],
                $_POST['matricula'],
                $_POST['precioDia'],
                $_POST['numeroPuertas'],
                $_POST['tipoCombustible']
);
            } else {
                $vehiculo = new Motocicleta(
                    $_POST['marca'],
                    $_POST['modelo'],
                    $_POST['matricula'],
                    $_POST['precioDia'],
                    $_POST['cilindrada'],
                    isset($_POST['incluyeCasco']) ? 1 : 0
                );
            }

            $this->gestor->agregar($vehiculo);
            header("Location: index.php");
            exit;
        }

        require "views/crear.php";
    }

    public function editar() {
        $id = $_GET['id'];
        $vehiculo = $this->gestor->buscar($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $vehiculo->setMarca($_POST['marca']);
            $vehiculo->setNombre($_POST['modelo']);
            $vehiculo->setMatricula($_POST['matricula']);
            $vehiculo->setPrecioDia($_POST['precioDia']);

            if ($vehiculo instanceof Coche) {
                $vehiculo->setNumeroPuertas($_POST['numeroPuertas']);
                $vehiculo->setTipoCombustible($_POST['tipoCombustible']);
            } else {
                $vehiculo->setCilindrada($_POST['cilindrada']);
                $vehiculo->setIncluyeCasco(isset($_POST['incluyeCasco']) ? 1 : 0);
            }

            $this->gestor->actualizar($vehiculo);
            header("Location: index.php");
            exit;
        }

        require "views/editar.php";
    }

    public function eliminar() {
        $id = $_GET['id'];
        $this->gestor->eliminar($id);
        header("Location: index.php");
    }
}