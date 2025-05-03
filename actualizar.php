<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar ID</title>
    <link rel="stylesheet" href="actualizar.css">
    <style>
        body {
            background-color: rgb(148, 196, 211);
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Ingresar ID</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="_id">ID:</label>
            <input type="text" name="_id" id="_id" required>
        </div>
        <input type="submit" value="Enviar" class="submit-button">
        <a href="#" onclick="history.back()">Regresar</a>
        
        <?php
         // Conexión a la base de datos
         $conexion = new mysqli("localhost", "root", "", "baseProyecto");
         if ($conexion->connect_error) {
             die("Error de conexión: " . $conexion->connect_error);
         }
         $conexion->set_charset("utf8");
 
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
             $id = $_POST['_id'];
 
             // Verificar si el ID existe en la base de datos
             $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE _id = ?");
             $stmt->bind_param("i", $id);
             $stmt->execute();
             $resultado = $stmt->get_result();
 
             if ($resultado->num_rows > 0) {
                 // Si el ID existe, redirigir al formulario de actualización
                 header("Location: uno.php?id=$id");
                 exit();
             } else {
                 // Mostrar mensaje de ID no encontrado dentro del formulario
                 echo '<p style="color: red;">ID no encontrado.</p>';
             }
             $stmt->close();
         }
 
         // Cerrar la conexión
         $conexion->close();
         ?>
    </form>
</div>
</body>
</html>
