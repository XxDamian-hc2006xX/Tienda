<?php
// Establecer la conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "baseProyecto");

// Verificar si hay error en la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>
