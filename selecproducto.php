<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Productos</title>
    <style>
        /* Estilo general para la página */
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
        .producto {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .producto img {
            width: 80px;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .producto-info {
            flex-grow: 1;
            text-align: left;
        }
        .producto-info label {
            display: block;
        }
        input[type="number"] {
            width: 80px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
            text-align: center;
        }
        input[type="submit"], .back-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        .back-button {
            background-color: #6c757d;
            text-decoration: none;
            display: inline-block;
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
        <h2>Seleccionar Productos</h2>
        <form method="post" action="carrito.php">
            <?php
            // Conexión a la base de datos
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'baseProyecto';
            $conn = new mysqli($host, $user, $password, $database);
            if ($conn->connect_error) {
                die("Error de conexión: " . $conn->connect_error);
            }
            // Consulta para obtener la lista de productos de la base de datos
            $query = "SELECT id, nombre, imagen, precio, cantidad FROM productos";
            $result = $conn->query($query);
            if ($result && $result->num_rows > 0) {
                // Bucle para mostrar cada producto
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="producto">';
                    echo '<img src="imagenes_productos/' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                    echo '<div class="producto-info">';
                    echo '<label for="cantidad_' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nombre']) . ':</label>';
                    echo '<p>Precio: ' . htmlspecialchars($row['precio']) . ' | Disponible: ' . htmlspecialchars($row['cantidad']) . '</p>';
                    echo '<input type="number" name="cantidades[' . htmlspecialchars($row['id']) . ']" id="cantidad_' . htmlspecialchars($row['id']) . '" placeholder="0">';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No se encontraron productos.</p>";
            }
            $result->free_result();
            $conn->close();
            ?>
            <input type="submit" value="Agregar al Carrito">
        </form>
        <br>
        <a href="index.php" class="back-button">Volver</a>
    </div>
</body>
</html>
