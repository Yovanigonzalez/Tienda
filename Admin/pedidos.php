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
    <title>Pedidos</title>
    
      <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <!-- Enlaces a los archivos CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
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
        <br>
        <!-- Contenido principal -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                  <h3 class="card-title">Pedidos</h3>
                </div>
                <div class="card-body">
                  <h4>Pedidos Chicos</h4>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Esencia</th>
                        <th>Contenido</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th> <!-- Nuevo encabezado para el botón de eliminar -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Conexión a la base de datos (reemplaza los datos de conexión por los tuyos)
        $servername = "localhost";
        $username = "perfumco_perfum";
        $password = "perfumeriaperfum";
        $dbname = "perfumco_perfum";

                      // Crear conexión
                      $conn = new mysqli($servername, $username, $password, $dbname);

                      // Comprobar la conexión
                      if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                      }

                      // Paginación
                      $page = isset($_GET['page']) ? $_GET['page'] : 1;
                      $itemsPerPage = 5;
                      $offset = ($page - 1) * $itemsPerPage;

                      // Consulta SQL para obtener los pedidos chicos de la tabla 'compras' con paginación
                      $query1 = "SELECT nombre, telefono, direccion, esencia, contenido, total, fecha, id FROM compras LIMIT $offset, $itemsPerPage";
                      $result1 = $conn->query($query1);

                      // Mostrar los resultados de la tabla 'compras'
// Mostrar los resultados de la tabla 'compras'
while ($row = $result1->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['telefono'] . "</td>";
    echo "<td>" . $row['direccion'] . "</td>";
    echo "<td>" . $row['esencia'] . "</td>";
    echo "<td>" . $row['contenido'] . "</td>";
    echo "<td>" . $row['total'] . "</td>";
    echo "<td>" . $row['fecha'] . "</td>";
    echo "<td>"; // Inicio de la celda de botones
    echo "<a href='eliminar_pedido.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
    echo "</td>"; // Fin de la celda de botones                  
    echo "</tr>";
}

                      ?>
                    </tbody>
                  </table>

                  <?php
                    // Calcular el número total de páginas para la paginación
                    $queryCount1 = "SELECT COUNT(*) AS total FROM compras";
                    $resultCount1 = $conn->query($queryCount1);
                    $rowCount1 = $resultCount1->fetch_assoc()['total'];
                    $totalPages1 = ceil($rowCount1 / $itemsPerPage);
                  ?>

                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <?php for ($i = 1; $i <= $totalPages1; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </nav>
<br>
                  <h4>Pedidos Grandes</h4>
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Pedido</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th> <!-- Nuevo encabezado para el botón de eliminar -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Consulta SQL para obtener los pedidos grandes de la tabla 'compra_grande' con paginación
                      $query2 = "SELECT nombre, telefono, direccion, detalles, total, fecha, id FROM compra_grande LIMIT $offset, $itemsPerPage";
                      $result2 = $conn->query($query2);

                      // Mostrar los resultados de la tabla 'compra_grande'
                      while ($row = $result2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        echo "<td>" . $row['direccion'] . "</td>";
                        echo "<td>" . $row['detalles'] . "</td>";
                        echo "<td>" . $row['total'] . "</td>";
                        echo "<td>" . $row['fecha'] . "</td>";
                        echo "<td>";
                        echo "<a href='eliminar_pedido_grande.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Eliminar</a>";
                        echo "</td>"; // Celda del botón de eliminar
                        echo "</tr>";                  
                      }
                      ?>
                    </tbody>
                  </table>

                  <?php
                    // Calcular el número total de páginas para la paginación
                    $queryCount2 = "SELECT COUNT(*) AS total FROM compra_grande";
                    $resultCount2 = $conn->query($queryCount2);
                    $rowCount2 = $resultCount2->fetch_assoc()['total'];
                    $totalPages2 = ceil($rowCount2 / $itemsPerPage);
                  ?>

                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <?php for ($i = 1; $i <= $totalPages2; $i++) : ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                          <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                      <?php endfor; ?>
                    </ul>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>
</html>




  
  </div>
</body>
</html>