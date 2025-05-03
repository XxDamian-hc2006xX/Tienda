<?php
include("conectar.php");

if(isset($_POST["Registrar"])) {
    $nombre = $_POST["nombreCompleto"];
    $edad = $_POST["edad"];
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contra = $_POST["password"];

    // Verifica si hay campos vacíos
    if(empty($nombre) || empty($edad) || empty($correo) || empty($usuario) || empty($contra)) {
        echo 'Los campos están vacíos';
    } elseif (strlen($contra) < 6) {
        echo 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        // Encripta la contraseña
        $hashed_password = password_hash($contra, PASSWORD_BCRYPT);

        // Preparar la consulta SQL
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombreCompleto, edad, correo, usuario, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $nombre, $edad, $correo, $usuario, $hashed_password);

        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <title>Registro Exitoso</title>
                <link rel="stylesheet" href="actualizar.css">
                <style>
                    body {
                        background-color: rgb(148, 196, 211);
                    }
                </style>
            </head>
            <body>
            <div class="container">
                <h2>Usuario registrado correctamente</h2>
                <div class="btn-group btn-group-lg btn-block mt-3" role="group" aria-label="Regresar">
                    <a href="#" onclick="history.back()" class="btn btn-danger">Regresar</a>
                </div>
            </div>
            </body>
            </html>
            <?php
            exit();
        } else {
            echo "<script>alert('Error al registrar')</script>";
        }

        // Cerrar la sentencia
        $stmt->close();
    }
} else {
    echo 'Formulario no enviado';
}
?>
