<!DOCTYPE html>
<html>
<head>
  <title>Proyecto</title>
  <style>
    /* Estilo para el cuerpo */
    body {
        background-color: rgb(148, 196, 211);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    /* Estilo para la barra de navegación */
    nav {
        width: 100%;
        background-color: rgba(20, 70, 105, 0.8); /* Azul oscuro semi-transparente */
        position: fixed; /* Fijar la barra en la parte superior */
        top: 0;
        left: 0;
        z-index: 1000; /* Asegura que esté por encima del contenido */
        padding: 10px 20px;
        display: flex;
        justify-content: flex-end; /* Alineación a la derecha */
    }

    nav a {
        color: #fff;
        text-decoration: none;
        padding: 10px 20px;
        margin: 0 10px 0 0; /* Margen derecho ajustado */
        border-radius: 5px;
        background-color: rgba(255, 255, 255, 0.2); /* Blanco semi-transparente */
        transition: background-color 0.3s ease;
    }

    nav a:hover {
        background-color: rgba(255, 255, 255, 0.4); /* Blanco semi-transparente al pasar el ratón */
    }

    /* Estilo para el título principal */
    h1 {
        font-size: 2.5rem;
        color: #333;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        margin-top: 60px; /* Espacio para la barra de navegación fija */
    }

    /* Estilo para el texto en negrita */
    b {
        font-size: 1.2rem;
        color: #333;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 10px 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>
<body>
  <nav>
    <a href="#">Inicio</a>
    <a href="selecproducto.php">Productos</a>
    <a href="#">Contacto</a>
    <a href="index.php" onclick="history.back()">Volver</a>
  </nav>

  <h1>TIENDA "LOS AMIGOS"</h1>
  <b>Bienvenido a nuestra tienda.</b>
</body>
</html>
