<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "baseProyecto");

// Verificar si hay error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");

// Obtener los nombres de las columnas de la tabla productos
$query = "SHOW COLUMNS FROM productos";
$result = $conexion->query($query);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row['Field'];
    }
}

// Procesar los datos enviados desde el formulario
$totalProductos = 0;
$updates = [];
foreach ($productos as $producto) {
    $cantidad = isset($_POST[$producto]) ? (int)$_POST[$producto] : 0;
    $totalProductos += $cantidad;
    if ($cantidad > 0) {
        $updates[] = "$producto = $producto + $cantidad";
    }
}

if (!empty($updates)) {
    $updateQuery = "UPDATE productos SET " . implode(", ", $updates);
    if ($conexion->query($updateQuery) === TRUE) {
        echo "<p>Productos surtidos correctamente.</p>";
    } else {
        echo "<p>Error al surtir los productos: " . $conexion->error . "</p>";
    }
}

echo "<p>Total de productos surtidos: $totalProductos</p>";

$conexion->close();
?>
