<?php
// Establecer conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "baseProyecto");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conexion->set_charset("utf8");

/**
 * Función para obtener todos los productos de la base de datos
 * @return array Lista de productos
 */
function obtenerProductos() {
    global $conexion;
    $productos = [];
    $resultado = $conexion->query("SELECT * FROM productos");
    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
    }
    return $productos;
}

/**
 * Función para obtener un producto por su ID
 * @param int $id ID del producto
 * @return array Datos del producto
 */
function obtenerProductoPorId($id) {
    global $conexion;
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}

/**
 * Función para actualizar la cantidad de un producto
 * @param int $id ID del producto
 * @param int $cantidad Cantidad a reducir del inventario
 */
function actualizarCantidadProducto($id, $cantidad) {
    global $conexion;
    $stmt = $conexion->prepare("UPDATE productos SET cantidad = cantidad - ? WHERE id = ?");
    $stmt->bind_param("ii", $cantidad, $id);
    $stmt->execute();
}

/**
 * Función para agregar un producto al carrito
 * @param int $id ID del producto
 * @param int $cantidad Cantidad del producto a agregar
 * @return bool Verdadero si se agrega correctamente, falso en caso contrario
 */
function agregarProductoCarrito($id, $cantidad) {
    $producto = obtenerProductoPorId($id);
    if ($producto && $producto['cantidad'] >= $cantidad) {
        $_SESSION['carrito'][] = [
            'id' => $producto['id'],
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'imagen' => $producto['imagen'],
            'cantidad' => $cantidad,
        ];
        actualizarCantidadProducto($id, $cantidad);
        return true;
    }
    return false;
}

/**
 * Función para procesar la compra
 * @return bool Verdadero si la compra se procesa correctamente, falso en caso contrario
 */
function procesarCompra() {
    global $conexion;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            actualizarCantidadProducto($producto['id'], $producto['cantidad']);
        }
        unset($_SESSION['carrito']);
        return true;
    }
    return false;
}
?>
