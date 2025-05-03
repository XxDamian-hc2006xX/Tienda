<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Borrar Datos</title>
    <link rel="stylesheet" href="actualizar.css">
    <style>
        body {
            background-color: rgb(148, 196, 211);
        }
    </style>
</head>
<body>
<div class="container">
    <?php
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "baseProyecto");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $conexion->set_charset("utf8");

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];

        // Obtener los datos actuales del registro
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE _id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Si el ID existe, mostrar el formulario de confirmación
            $datos = $resultado->fetch_assoc();
            ?>
            <h2>¿Estás seguro que deseas borrar estos datos?</h2>
            <form method="POST" action="">
                <input type="hidden" name="_id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" value="<?php echo $datos['correo']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" value="<?php echo $datos['usuario']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nombreCompleto">Nombre Completo:</label>
                    <input type="text" name="nombreCompleto" id="nombreCompleto" value="<?php echo $datos['nombreCompleto']; ?>" readonly>
                </div>
                <input type="submit" name="borrar" value="Borrar">
                <a href="#" onclick="history.back()">Cancelar</a>
            </form>
            <?php
        } else {
            echo "<p>ID no encontrado.</p>";
        }
        $stmt->close();
    } elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrar'])) {
        // Proceso de eliminación de los datos
        $id = $_POST['_id'];

        // Preparar la sentencia SQL para prevenir inyecciones SQL
        $stmt = $conexion->prepare("DELETE FROM usuarios WHERE _id = ?");
        $stmt->bind_param("i", $id);

        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            echo "<p>Datos borrados correctamente.</p>";
            echo '<div class="btn-group btn-group-lg btn-block mt-3" role="group" aria-label="Regresar">';
            echo '<a href="#" onclick="history.back()" class="btn btn-danger">Regresar</a>';
            echo '</div>';
        } else {
            echo "<p>Error al borrar datos: " . $stmt->error . "</p>";
        }

        // Cerrar la sentencia
        $stmt->close();
    }

    // Cerrar la conexión
    $conexion->close();
    ?>
</div>
</body>
</html>
