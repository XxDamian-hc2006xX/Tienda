<?php
  // Incluir el archivo de conexión a la base de datos
  include("conectar.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metadatos -->
    <meta charset="UTF-8">
    <title>Proyecto</title>
    <!-- Enlace al archivo CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Enlace al archivo de estilos personalizado -->
    <link rel="stylesheet" href="registrar.css">
</head>
<body>
    <!-- Contenedor principal -->
    <div class="container">
        <div class="card">
            <!-- Encabezado de la tarjeta -->
            <div class="card-header text-center">
                <h2>Inicia sesión</h2>
            </div>
            <!-- Cuerpo de la tarjeta -->
            <div class="card-body">
                <!-- Formulario de inicio de sesión -->
                <form action="iniciarsesion.php" method="POST">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <img src="logoin.jpeg" width="130" class="img-fluid logo">
                    </div>
                    <!-- Campo de entrada para el correo -->
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="text" id="correo" name="correo" class="form-control" required>
                    </div>
                    <!-- Campo de entrada para el usuario -->
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" class="form-control" required>
                    </div>
                    <!-- Campo de entrada para la contraseña -->
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <!-- Botón de enviar -->
                    <div class="text-center">
                        <button type="submit" name="iniciar" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                    <br>
                    <!-- Enlace para registrarse -->
                    <div class="text-center">
                        <a href="registrar.php" class="btn btn-secondary">Regístrate</a>
                    </div>
                </form>
            </div>
            <!-- Pie de la tarjeta -->
            <div class="card-footer text-center">
                <a href="#" onclick="history.back()" class="btn btn-link">Salir</a>
            </div>
        </div>
    </div>
    <!-- Librerías JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
