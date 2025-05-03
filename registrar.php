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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enlace al archivo CSS de Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Enlace al archivo de estilos personalizado -->
  <link rel="stylesheet" href="registrar2.css">
</head>
<body>
  <!-- Contenedor principal -->
  <div class="container">
    <h1>TIENDA "LOS AMIGOS"</h1>
    <!-- Alerta informativa -->
    <div class="alert alert-info">
      <b>Aún no tienes una cuenta. Te invitamos a que te registres.</b>
    </div>
    <!-- Formulario de registro -->
    <form action="registro_recibe.php" method="POST" onsubmit="return validateForm()">
      <h2 class="mb-4">Crear una cuenta</h2>
      <!-- Logo -->
      <div class="form-group text-center">
        <img src="logoin.jpeg" alt="Logo" width="130" class="logo">
      </div>
      <!-- Campo de entrada para el nombre completo -->
      <div class="form-group">
        <input type="text" class="form-control" name="nombreCompleto" placeholder="Nombre Completo" required>
      </div>
      <!-- Campo de entrada para la edad -->
      <div class="form-group">
        <input type="text" class="form-control" name="edad" placeholder="Edad" required>
      </div>
      <!-- Campo de entrada para el correo -->
      <div class="form-group">
        <input type="email" class="form-control" name="correo" placeholder="Correo" required>
      </div>
      <!-- Campo de entrada para el usuario -->
      <div class="form-group">
        <input type="text" class="form-control" name="usuario" placeholder="Usuario" required>
      </div>
      <!-- Campo de entrada para la contraseña -->
      <div class="form-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
      </div>
      <!-- Botón de enviar -->
      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" name="Registrar">Iniciar registro</button>
      </div>
      <!-- Enlace para salir -->
      <div class="text-center">
        <strong><a href="#" onclick="history.back()" class="text-secondary">Salir</a></strong>
      </div>
    </form>
  </div>
  <!-- Librería JavaScript de Bootstrap -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Script de validación del formulario -->
  <script>
    function validateForm() {
      var password = document.getElementById("password").value;
      if (password.length < 6) {
        alert("La contraseña debe tener al menos 6 caracteres.");
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
