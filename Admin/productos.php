<?php
session_start();
// Resto del código de login.php

if (empty($_SERVER['HTTP_REFERER'])) {
    // El acceso se está realizando directamente desde la URL
    header('Location: error.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Lista de Productos</title>
  
  
  <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">
  <!-- Enlaces a los archivos CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <link rel="icon" href="../logo/log.png" type="image/jpeg">

  <!-- Enlaces a los archivos JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
  <style>
      .categoria-title {
    text-align: center;
    margin-top: 20px; /* Ajusta este valor según sea necesario para el espaciado superior */
  }
    .producto-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: flex-start;
    }
    .producto-box {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 15px;
      margin: 10px;
      max-width: 250px;
    }
    .producto-img {
      max-width: 200px;
      max-height: 200px;
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

  </aside>

<div class="content-wrapper">
    <!-- Contenido principal -->
    <br>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <?php
                        // Conexión a la base de datos 'perfum'
                        $conexion = mysqli_connect("localhost", "perfumco_perfum", "perfumeriaperfum", "perfumco_perfum");


                        // Comprobar conexión
                        if (mysqli_connect_errno()) {
                            echo "Error en la conexión a MySQL: " . mysqli_connect_error();
                        }

                        // Obtener categorías únicas
                        $query_categorias = "SELECT DISTINCT categoria FROM productos";
                        $result_categorias = mysqli_query($conexion, $query_categorias);

                        while ($row_categoria = mysqli_fetch_assoc($result_categorias)) {
                          echo '<h2 class="categoria-title">Productos para ' . $row_categoria['categoria'] . '</h2>';
                          echo '<div class="producto-container">';

                            $categoria = $row_categoria['categoria'];
                            $query_productos = "SELECT * FROM productos WHERE categoria = '$categoria'";
                            $result_productos = mysqli_query($conexion, $query_productos);

                            // Paginación
                            $productos_por_pagina = 4; // Cambia este valor según tu preferencia
                            $total_productos = mysqli_num_rows($result_productos);
                            $total_paginas = ceil($total_productos / $productos_por_pagina);

                            if (isset($_GET['pagina'])) {
                                $pagina_actual = $_GET['pagina'];
                            } else {
                                $pagina_actual = 1;
                            }

                            $inicio = ($pagina_actual - 1) * $productos_por_pagina;
                            $query_productos_paginacion = "SELECT * FROM productos WHERE categoria = '$categoria' LIMIT $inicio, $productos_por_pagina";
                            $result_productos_paginacion = mysqli_query($conexion, $query_productos_paginacion);

                            while ($row_producto = mysqli_fetch_assoc($result_productos_paginacion)) {
                              echo '<div class="producto-box">';
                              echo "<p>Producto: " . $row_producto['producto'] . "</p>";
                              echo '<img src="' . $row_producto['imagen'] . '" style="width: 200px; height: 200px;" alt="Imagen del producto">';
                              echo "<p>Precio: $" . $row_producto['precio'] . "</p>";
                              echo "<p>Esencia: " . $row_producto['esencia'] . "</p>";
                              echo "</div>";
                          }
                          

                            echo '</div>';

                            echo '<nav aria-label="Paginación" class="mt-4">';
                            echo '<ul class="pagination justify-content-center">'; // Añadimos la clase justify-content-center
                            for ($i = 1; $i <= $total_paginas; $i++) {
                                echo '<li class="page-item';
                                if ($i == $pagina_actual) {
                                    echo ' active';
                                }
                                echo '"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                            }
                            echo '</ul>';
                            echo '</nav>';
                          }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($conexion);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
    </div>
</body>
</html>
