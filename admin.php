<!DOCTYPE html>
<html lang="es">
<head>
    <!-- Metadatos -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <!-- Enlace a estilos personalizados -->
    <link rel="stylesheet" href="#">
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilos personalizados */
        body {
            background-color: rgb(148, 196, 211); /* Fondo azul */
            color: white;
            padding-top: 70px; /* Para compensar la barra de navegación fija */
        }
        .navbar {
            background-color: #2980b9; /* Barra de navegación azul oscuro */
        }
        .footer {
            background-color: rgb(150, 196, 242); /* Pie de página azul oscuro */
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        p {
            text-align: center;
            padding: 30px 0;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">TIENDA "LOS AMIGOS"</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <!-- Enlaces de navegación -->
                <li class="nav-item">
                    <a class="nav-link" href="Manual2.pdf" target="_blank">Manual de compra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Manual.pdf" target="_blank">Manual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ver.php">Ver tabla</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="actualizar.php">Modificar datos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="borrar.php">Borrar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="surtir.php">Surtir</a>
                </li>
                <li class="nav-item">
                    <a href="#" onclick="history.back()" class="btn btn-outline-light">Regresar</a>
                </li>

            </ul>
        </div>
    </nav>

    <!-- Mensaje de bienvenida -->
    <p>HOLA ADMINISTRADOR</p>

    <!-- Pie de página -->
    <footer class="footer">
        <div class="container">
            <p>Derechos reservados &copy; 2024</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
