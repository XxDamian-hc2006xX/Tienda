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
            margin-bottom: 20px;
        }
        .producto img {
            width: 80px;
            margin-right: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .producto-info {
            flex-grow: 1;
        }
        .producto-info label {
            display: block;
        }
        input[type="number"], input[type="text"] {
            width: 80px;
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
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
        <h2>Seleccionar Productos</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
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
            $query = "SELECT nombre, imagen, precio FROM productos";
            $result = $conn->query($query);
            if ($result && $result->num_rows > 0) {
                // Bucle para mostrar cada producto
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="producto">';
                    echo '<img src="imagenes_productos/' . htmlspecialchars($row['imagen']) . '" alt="' . htmlspecialchars($row['nombre']) . '">';
                    echo '<div class="producto-info">';
                    echo '<label for="cantidad_' . htmlspecialchars($row['nombre']) . '">' . htmlspecialchars($row['nombre']) . ':</label>';
                    echo '<input type="number" name="cantidades[]" id="cantidad_' . htmlspecialchars($row['nombre']) . '" placeholder="0">';
                    echo '<span> unidades</span>';
                    echo '<label for="precio_' . htmlspecialchars($row['nombre']) . '">Precio por unidad:</label>';
                    echo '<input type="text" name="precios[]" id="precio_' . htmlspecialchars($row['nombre']) . '" placeholder="' . htmlspecialchars($row['precio']) . '">';
                    echo '<input type="hidden" name="productos[]" value="' . htmlspecialchars($row['nombre']) . '">';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No se encontraron productos.</p>";
            }
            $result->free_result();
            ?>
            <input type="submit" name="submit" value="Continuar">
        </form>
        <?php
        // Procesamiento del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $productos = $_POST['productos'];
            $cantidades = $_POST['cantidades'];
            $precios = $_POST['precios'];
            $totalProductos = count($productos);
            $productosSurtidos = array();
            
            // Bucle para procesar cada producto seleccionado
            for ($i = 0; $i < $totalProductos; $i++) {
                $producto = $productos[$i];
                $cantidad = $cantidades[$i];
                $precio = $precios[$i];
                
                if (!empty($cantidad) || !empty($precio)) {
                    // Obtener cantidad y precio actual del producto
                    $queryCantidadActual = "SELECT cantidad, precio FROM productos WHERE nombre = '$producto'";
                    $resultCantidadActual = $conn->query($queryCantidadActual);
                    $rowCantidadActual = $resultCantidadActual->fetch_assoc();
                    
                    // Actualizar cantidad y precio si se proporcionaron
                    $cantidad = !empty($cantidad) ? $cantidad : 0;
                    $precio = !empty($precio) ? $precio : $rowCantidadActual['precio'];
                    $updateQuery = "UPDATE productos SET cantidad = cantidad + $cantidad, precio = $precio WHERE nombre = '$producto'";
                    $conn->query($updateQuery);
                    
                    // Agregar producto a la lista de productos surtidos
                    if ($cantidad > 0) {
                        $productosSurtidos[] = "$producto (Cantidad: $cantidad)";
                    }
                }
            }
            
            // Mostrar resultado del surtido de productos
            if (!empty($productosSurtidos)) {
                echo '<div class="result">';
                echo "Productos surtidos: " . implode(', ', $productosSurtidos) . "<br>";
                echo '</div>';
            } else {
                echo '<div class="result">';
                echo "No se seleccionaron productos o la cantidad ingresada es cero.";
                echo '</div>';
            }
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
