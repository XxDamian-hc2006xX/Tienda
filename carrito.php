<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
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

        .producto label {
            flex-grow: 1;
            text-align: left;
        }

        .result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e7f3e7;
            border: 1px solid #a3d2a3;
            border-radius: 4px;
            text-align: left;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-container button.effectivo {
            background-color: #007bff;
            color: #fff;
        }

        .btn-container button.tarjeta {
            background-color: #007bff;
            color: #fff;
        }

        .back-button {
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #d32f2f;
        }

        .back-button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Carrito de Compras</h2>
        <?php
        session_start();

        // Conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "baseProyecto");

        // Manejar el formulario de selección de productos
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['cantidades']) && is_array($_POST['cantidades'])) {
                foreach ($_POST['cantidades'] as $id => $cantidad) {
                    $id = intval($id);
                    $cantidad = intval($cantidad);

                    if ($id > 0 && $cantidad > 0) {
                        if (!isset($_SESSION['carrito'][$id])) {
                            $_SESSION['carrito'][$id] = 0;
                        }
                        $_SESSION['carrito'][$id] += $cantidad;
                    }
                }
            }
        }

        // Mostrar el carrito
        if (isset($_SESSION["carrito"]) && is_array($_SESSION["carrito"]) && count($_SESSION["carrito"]) > 0) {
            echo '<form action="" method="post">';
            foreach ($_SESSION["carrito"] as $id => $cantidad) {
                $id = intval($id);
                $cantidad = intval($cantidad);

                if ($id > 0 && $cantidad > 0) {
                    // Obtener información del producto
                    $query = "SELECT nombre, imagen FROM productos WHERE id = $id";
                    $result = $conexion->query($query);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $nombre = $row['nombre'];
                        $imagen = $row['imagen'];

                        echo '<div class="producto">';
                        echo '<img src="imagenes_productos/' . $imagen . '" alt="' . $nombre . '">';
                        echo '<label>Producto: ' . $nombre . ' (ID: ' . $id . ') - Cantidad: ' . $cantidad . '</label>';
                        echo '</div>';
                    } else {
                        echo "<div class='result'>Producto con ID $id no encontrado en la base de datos.</div>";
                    }
                } else {
                    echo "<div class='result'>Cantidad inválida para el producto con ID $id.</div>";
                }
            }
            echo '<div class="btn-container">';
            echo '<button class="effectivo" type="submit" formaction="comprar.php">Efectivo</button>';
            echo '<button class="tarjeta" type="submit" formaction="tarjeta.html">Tarjeta</button>';
            echo '</div>'; // Cierre de .btn-container
            echo '</form>';
        } else {
            echo "<div class='result'>No hay productos en el carrito.</div>";
        }

        // Cerrar la conexión
        $conexion->close();
        ?>
        <div class="back-button-container">
            <button class="back-button" onclick="window.history.back();">Regresar</button>
        </div>
    </div>
</body>
</html>
