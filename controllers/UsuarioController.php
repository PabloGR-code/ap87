<?php

class UsuarioController {

    private $gestor;

    public function __construct($gestor) {
        $this->gestor = $gestor;
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];

            // Hasheamos contraseña
            $passwordHash = password_hash($passwordPlana, PASSWORD_DEFAULT);

            // Creamos objeto Usuario
            $nuevoUsuario = new Usuario($email, $passwordHash);

            // Guardamos en BD
            $this->gestor->registrarUsuario($nuevoUsuario);

            header("Location: index.php?accion=login");
            exit;
        }

        include "views/registro.php";
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $passwordPlana = $_POST['password'];

            // Buscar usuario
            $usuario = $this->gestor->buscarUsuarioPorEmail($email);

            // Validar contraseña
            if ($usuario && password_verify($passwordPlana, $usuario->getPassword())) {

                $_SESSION['usuarioId'] = $usuario->getId(); // 👈 IMPORTANTE (cambiado)
                $_SESSION['usuarioEmail'] = $usuario->getEmail();

                header("Location: index.php");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
            }
        }

        include "views/login.php";
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();

        header("Location: index.php?accion=login");
        exit;
    }
}