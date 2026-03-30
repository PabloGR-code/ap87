<!DOCTYPE html>
<html>
<head>
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Crear nueva cuenta</h1>

    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>

        Contraseña:<br>
        <input type="password" name="password" required minlength="6"><br><br>

        <button type="submit">Registrarse</button>
    </form>

    <br>
    <p>¿Ya tienes una cuenta? <a href="index.php?accion=login">Inicia sesión aquí</a></p>
    <a href="index.php">Volver al inicio</a>
</body>
</html>