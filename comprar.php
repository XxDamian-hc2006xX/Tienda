<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Compra</title>
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
            text-align: left;
            position: relative;
        }

        h3 {
            color: #333;
            border-bottom: 2px solid #4caf50;
            padding-bottom: 10px;
        }

        .ticket-item {
            border-bottom: 1px dashed #ddd;
            padding: 10px 0;
        }

        .ticket-item:last-child {
            border-bottom: none;
        }

        .total {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #4caf50;
            font-weight: bold;
        }

        .back-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="back-button" onclick="window.location.href='saludo.php';">Seguir Comprando</button>
        <?php
        session_start();

        // Establecer la conexión a la base de datos
        $conexion = new mysqli("localhost", "root", "", "baseProyecto");

        // Verificar si hay error en la conexión
        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $conexion->set_charset("utf8");

        // Confirmar la compra y actualizar la base de datos
        if (isset($_SESSION["carrito"]) && !empty($_SESSION["carrito"])) {
            echo '<h3>Ticket de Compra</h3>';
            $totalCompra = 0;
            foreach ($_SESSION["carrito"] as $id => $cantidad) {
                if ($cantidad > 0) {
                    // Obtener datos del producto
                    $query = "SELECT nombre, precio, cantidad FROM productos WHERE id = $id";
                    $result = $conexion->query($query);
                    $producto = $result->fetch_assoc();

                    if ($producto["cantidad"] >= $cantidad) {
                        $nuevo_stock = $producto["cantidad"] - $cantidad;
                        // Actualizar la cantidad en la base de datos
                        $update_query = "UPDATE productos SET cantidad = $nuevo_stock WHERE id = $id";
                        $conexion->query($update_query);

                        // Calcular el total del producto
                        $totalProducto = $producto["precio"] * $cantidad;
                        $totalCompra += $totalProducto;

                        // Mostrar el ticket
                        echo '<div class="ticket-item">';
                        echo 'Producto: ' . $producto["nombre"] . ' - Cantidad: ' . $cantidad . ' - Precio Unitario: $' . number_format($producto["precio"], 2) . ' - Total: $' . number_format($totalProducto, 2);
                        echo '</div>';
                    } else {
                        echo '<div class="ticket-item">';
                        echo 'Stock insuficiente para el producto: ' . $producto["nombre"];
                        echo '</div>';
                    }
                }
            }
            // Mostrar el total de la compra
            echo '<div class="total">Total de la Compra: $' . number_format($totalCompra, 2) . '</div>';
        } else {
            echo "<div class='ticket-item'>No hay productos en el carrito.</div>";
        }

        // Limpiar el carrito
        unset($_SESSION["carrito"]);

        $conexion->close();
        ?>
    </div>
</body>
</html>
