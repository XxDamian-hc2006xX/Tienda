<?php
include("conectar.php");

if(isset($_POST["iniciar"])){
    $correo = $_POST["correo"];
    $usuario = $_POST["usuario"];
    $contra = $_POST["password"];

    // Consulta SQL para verificar las credenciales
    $sql = $conexion->prepare("SELECT password FROM usuarios WHERE correo = ?");
    $sql->bind_param("s", $correo);
    $sql->execute();
    $result = $sql->get_result();
    
    if($result->num_rows > 0){
        $datos = $result->fetch_object();
        
        // Verificar la contraseña
        if (password_verify($contra, $datos->password)) {
            // Verificar los primeros 3 caracteres del usuario
            $prefix = substr($usuario, 0, 3);
            if ($prefix === '500') {
                header("Location: admin.php");
            } else {
                header("Location: saludo.php");
            }
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrecta'); window.location='sesion.php';</script>";
            exit();
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrecta'); window.location='sesion.php';</script>";
        exit();
    }
}
?>
