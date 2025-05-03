<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Imagen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(148, 196, 211);
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        input[type="text"], input[type="file"], input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 5px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e7f3e7;
            border: 1px solid #a3d2a3;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Subir Imagen</h2>
        <form action="subir_imagen.php" method="post" enctype="multipart/form-data">
            <input type="text" name="nombre" placeholder="Nombre del producto" required>
            <input type="file" name="imagen" required>
            <input type="submit" name="submit" value="Subir">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
            $nombre = $_POST['nombre'];
            $imagen = $_FILES['imagen'];
            $nombreImagen = basename($imagen['name']);
            $directorioDestino = "imagenes_productos/";
            $rutaImagen = $directorioDestino . $nombreImagen;
            // Mover el archivo subido al directorio de destino
            if (move_uploaded_file($imagen['tmp_name'], $rutaImagen)) {
                // Conexión a la base de datos
                $host = 'localhost';
                $user = 'root';
                $password = '';
                $database = 'baseProyecto';
                $conn = new mysqli($host, $user, $password, $database);
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }
                // Insertar la información de la imagen en la base de datos
                $query = "INSERT INTO productos (nombre, imagen) VALUES ('$nombre', '$nombreImagen')";
                if ($conn->query($query) === TRUE) {
                    echo '<div class="result">Imagen subida y ruta guardada en la base de datos exitosamente.</div>';
                } else {
                    echo '<div class="result">Error: ' . $conn->error . '</div>';
                }
                $conn->close();
            } else {
                echo '<div class="result">Error al subir la imagen.</div>';
            }
        }
        ?>
    </div>
</body>
</html>
