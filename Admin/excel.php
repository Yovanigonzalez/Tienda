<?php
session_start();
// Resto del código de login.php

if (empty($_SERVER['HTTP_REFERER'])) {
    // El acceso se está realizando directamente desde la URL
    header('Location: error.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
    // Establecer las credenciales de la base de datos
    $servername = "localhost";
    $username = "perfumco_perfum";
    $password = "perfumeriaperfum";
    $dbname = "perfumco_perfum";

    // Crear la conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Establecer el conjunto de caracteres a UTF-8
    $conn->set_charset("utf8");

    // Realizar la consulta SQL para obtener los datos específicos
    $sql = "SELECT producto, precio, esencia, categoria, contenido, stock, descripcion FROM productos"; // Nombre de la tabla
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Crear un archivo CSV
        $filename = "exportacion.csv";
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('Producto', 'Precio', 'Esencia', 'Categoria', 'Contenido', 'Stock', 'Descripcion'));

        while ($row = $result->fetch_assoc()) {
            $row_utf8 = array_map('utf8_encode', $row);
            fputcsv($output, $row_utf8);
        }

        fclose($output);
    } else {
        echo "No se encontraron resultados.";
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
    exit; // Terminar la ejecución del script después de exportar los datos
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Informe inventario</title>
    <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <!-- Enlaces a los archivos CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="icon" href="../logo/log.png" type="image/jpeg">

    <!-- Enlaces a los archivos JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <style>
        /* Estilos para el botón de exportación */
        .export-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        .export-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Barra de navegación superior -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Barra de navegación a la izquierda -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <!-- Botones de la barra de navegación a la derecha -->
        <ul class="navbar-nav ml-auto">
            <style>
                .nav-icon {
                    margin-right: 20px; /* Puedes ajustar el valor según tus preferencias */
                }
            </style>

            <?php
            if (isset($_SESSION['nombre_usuario'])) {
                echo '<div class="nav-icon position-relative text-dark"><i class="fa fa-user-circle"></i> Hola! Bienvenido, ' . $_SESSION['nombre_usuario'] . '</div>';
                echo '<a class="nav-icon position-relative text-decoration-none" href="logout.php">';
                echo '<i class="fa fa-fw fa-sign-out-alt text-dark"></i> Cerrar Sesión</a>';
            } else {
                echo '<a class="nav-icon position-relative text-decoration-none" href="login.php">';
                echo '<i class="fa fa-fw fa-user text-dark"></i> Iniciar Sesión</a>';
            }
            ?>

        </ul>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Logo -->
        <a href="inicio.php" class="brand-link">
            <span class="brand-text font-weight-light">Panel del Administrador</span>
            <div class="text-center mb-4">
                <img src="../log/log.png" class="img-fluid rounded-circle" alt="Login Image" width="70px">
            </div>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Menú -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="inicio.php" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>

                    <!-- Elemento de menú Productos con submenús  Productos-->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-box"></i>
                            <p>Productos <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="agregar.php" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p>Agregar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="eliminar.php" class="nav-link">
                                    <i class="fas fa-trash nav-icon"></i>
                                    <p>Eliminar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="editar.php" class="nav-link">
                                    <i class="fas fa-edit nav-icon"></i>
                                    <p>Editar</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="productos.php" class="nav-link">
                                    <i class="fas fa-list nav-icon"></i>
                                    <p>Productos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="buscar.php" class="nav-link">
                                    <i class="fas fa-search nav-icon"></i>
                                    <p>Buscar</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Elemento de menú Informes con submenús Descargar -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Generar informe <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="excel.php" class="nav-link">
                                    <i class="fas fa-file-excel nav-icon"></i>
                                    <p>Descargar en Excel</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Elemento de menú Ventas con submenús -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Ventas <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="pedidos.php" class="nav-link">
                                    <i class="fas fa-shopping-cart nav-icon"></i>
                                    <p>Pedidos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Elemento de menú Ventas con submenús -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>Extras <i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="suscriptores.php" class="nav-link">
                                    <i class="fas fa-envelope-open-text nav-icon"></i>
                                    <p>Suscriptores</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="comentarios.php" class="nav-link">
                                    <i class="far fa-comments nav-icon"></i>
                                    <p>Comentarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="nav-icon fas fa-door-closed"></i>
                            <p>Cerrar sesión</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Contenido principal -->
    <div class="content-wrapper">
        <br>
        <!-- Contenido de la página -->
        <div class="content">
            <!-- Formulario y botón para exportar a CSV -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button class="export-button" type="submit" name="export">Exportar Inventario</button>
            </form>
        </div>
    </div>

    <!-- Pie de página -->
    <!-- ... (código del pie de página) ... -->
</div>
</body>
</html>

