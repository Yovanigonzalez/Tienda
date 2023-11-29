<?php
session_start();
// Resto del código de login.php

if (empty($_SERVER['HTTP_REFERER'])) {
    // El acceso se está realizando directamente desde la URL
    header('Location: error.php');
    exit();
}
?>

<?php
// Establecer conexión con la base de datos
        $servername = "localhost";
        $username = "perfumco_perfum";
        $password = "perfumeriaperfum";
        $dbname = "perfumco_perfum";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Definir el número de registros por página
$registrosPorPagina = 8;

// Obtener la página actual de la URL, si no se especifica, establecer en 1
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

// Calcular el inicio del conjunto de resultados para la consulta SQL
$inicio = ($paginaActual - 1) * $registrosPorPagina;

// Realizar la consulta SQL con limitación y ordenamiento
$sql = "SELECT * FROM productos LIMIT $inicio, $registrosPorPagina";
$result = $conn->query($sql);

// Obtener el número total de registros en la tabla
$sqlTotalRegistros = "SELECT COUNT(*) as total FROM productos";
$resultTotal = $conn->query($sqlTotalRegistros);
$rowTotal = $resultTotal->fetch_assoc();
$totalRegistros = $rowTotal['total'];

// Manejar la eliminación de productos si se envía un formulario POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eliminar_producto'])) {
    $id_producto = $_POST['eliminar_producto'];

    // Realizar la consulta para eliminar el producto de la base de datos
    $sqlEliminar = "DELETE FROM productos WHERE id = $id_producto";
    if ($conn->query($sqlEliminar) === TRUE) {
        // Producto eliminado exitosamente, redirigir o actualizar la página
        header("Location: eliminar.php"); // Cambia 'nombre_de_tu_pagina.php' por el nombre de tu página
        exit();
    } else {
        echo "Error al eliminar el producto: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eliminar Productos</title>
    
      <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <!-- Icono de la página -->
    <link rel="icon" href="../logo/log.png" type="image/jpeg">

    <!-- Enlaces a los archivos JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
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
                        <div class="card-header">
                            <h3 class="card-title">Eliminar Productos</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Precio <i class="fas fa-dollar-sign"></i></th>
                                        <th>Esencia <i class="fas fa-box"></i></th>
                                        <th>Stock <i class="fas fa-box"></i></th>
                                        <th>Contenido <i class="fas fa-balance-scale"></i></th>
                                        <th>Categoría <i class="fas fa-tag"></i></th>
                                        <th>Acciones <i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id_producto = $row['id'];
                                            echo "<tr>";
                                            echo "<td>{$row['producto']}</td>";
                                            echo "<td>{$row['precio']}</td>";
                                            echo "<td>{$row['esencia']}</td>";
                                            echo "<td>{$row['stock']}</td>";
                                            echo "<td>{$row['contenido']}</td>";
                                            echo "<td>{$row['categoria']}</td>";
                                            echo "<td>
                                            <form method='post'>
                                            <input type='hidden' name='eliminar_producto' value='$id_producto'>
                                            <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de eliminar este producto?\")'>
                                                <i class='fas fa-trash'></i> Eliminar
                                            </button>
                                        </form>
                                            </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No hay productos en la base de datos.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <br>
                            <!-- Paginación -->
                            <div class="pagination justify-content-center">
                                <ul class="pagination">
                                    <?php
                                    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);
                                    for ($i = 1; $i <= $totalPaginas; $i++) {
                                        echo "<li class='page-item ";
                                        if ($i == $paginaActual) {
                                            echo "active";
                                        }
                                        echo "'><a class='page-link' href='?pagina=$i'>$i</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Cierre de la página -->
</body>
</html>
