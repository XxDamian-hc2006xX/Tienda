<?php
// Incluir el archivo de conexión a la base de datos
include("conectar.php");

// Verificar si se ha enviado el formulario de inicio de sesión
if (isset($_POST['iniciar'])) {
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contra = $_POST["password"];

    // Verificar si la conexión está establecida correctamente
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Consulta para obtener la contraseña almacenada
    $queryusuario = "SELECT * FROM usuarios WHERE correo='$correo' AND usuario='$usuario'";
    $result = mysqli_query($conexion, $queryusuario);

    // Verificar si se encontraron resultados
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $hash = $row['password'];

        // Verificar si la contraseña coincide usando password_verify()
        if (password_verify($contra, $hash)) {
            echo "Bienvenido: $usuario";
        } else {
            echo "Usuario o contraseña incorrecta";
        }
    } else {
        echo "Usuario o contraseña incorrecta";
    }
}
?>
