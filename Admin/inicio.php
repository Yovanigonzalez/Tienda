<?php
session_start();
// Resto del código de login.php

if (empty($_SERVER['HTTP_REFERER'])) {
    // El acceso se está realizando directamente desde la URL
    header('Location: error.php');
    exit();
}
?>

<?php include 'menu.php' ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Panel del administrador</title>
  
    <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

  <!-- Enlaces a los archivos CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <!-- Enlaces a los archivos JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <!-- Icono de la página -->
    <link rel="icon" href="../logo/log.png" type="image/jpeg">

</head>



    <!-- Contenido principal -->
    <div class="content-wrapper">
      <!-- Encabezado de la página -->
      <section class="content-header">
        <div class="container-fluid">
          <h1>Página de Inicio</h1>
        </div>
      </section>

      <!-- Contenido de la página -->
      <section class="content">
        <div class="container-fluid">
          <!-- Dashboard -->
          <div class="row">

          <?php
require('../config/conections.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para contar los usuarios con rol 'cliente'
$sql = "SELECT COUNT(*) AS total_clientes FROM usuarios WHERE rol = 'cliente'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalClientes = $row["total_clientes"];
} else {
    $totalClientes = 0;
}

$conn->close();
?>

<!-- Tarjeta informativa 1 -->
<div class="col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Usuarios</span>
            <span class="info-box-number"><?php echo $totalClientes; ?></span>
        </div>
    </div>
</div>


<?php
require('../config/conections.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener el número total de ventas de ambas tablas
$query = "SELECT COUNT(*) AS total_ventas FROM compras UNION ALL SELECT COUNT(*) FROM compra_grande";
$result = $conn->query($query);

$totalVentas = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalVentas += $row["total_ventas"];
    }
}

// Cerrar la conexión
$conn->close();
?>

<!-- Tarjeta informativa 2 -->
<div class="col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-success"><i class="fas fa-shopping-cart"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Ventas</span>
            <span class="info-box-number"><?php echo $totalVentas; ?></span>
        </div>
    </div>
</div>




            <?php
require('../config/conections.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para contar los correos en la tabla 'contactos'
$sql = "SELECT COUNT(*) AS total_correos FROM contactos";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalCorreos = $row["total_correos"];
} else {
    $totalCorreos = 0;
}

$conn->close();
?>

<!-- Tarjeta informativa 3 -->
<div class="col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-warning"><i class="fas fa-comments"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Comentarios</span>
            <span class="info-box-number"><?php echo $totalCorreos; ?></span>
        </div>
    </div>
</div>

<?php
require('../config/conections.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener el total de suscriptores
$query = "SELECT COUNT(*) AS total_suscriptores FROM suscriptores";
$result = $conn->query($query);

$total_suscriptores = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_suscriptores = $row["total_suscriptores"];
}

$conn->close();
?>

<!-- Tarjeta informativa 4 -->
<div class="col-md-3">
    <div class="info-box">
        <span class="info-box-icon bg-danger"><i class="fas fa-users"></i></span>
        <div class="info-box-content">
            <span class="info-box-text">Suscripciones</span>
            <span class="info-box-number"><?php echo $total_suscriptores; ?></span>
        </div>
    </div>
</div>
</div>
</div>
<br>
          <!-- Gráfico -->
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Gráfico de Ventas</h3>
                </div>
                <div class="card-body">
                  <canvas id="myChart" width="400" height="200"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- Script para inicializar el gráfico -->

  <?php
require('../config/conections.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los totales de ventas por mes de ambas tablas combinadas
$query = "SELECT MONTH(fecha) AS mes, SUM(total) AS total_ventas FROM compras GROUP BY mes
          UNION ALL
          SELECT MONTH(fecha) AS mes, SUM(total) AS total_ventas FROM compra_grande GROUP BY mes
          UNION ALL
          SELECT MONTH(fecha) AS mes, SUM(total) AS total_ventas FROM totales_eliminados GROUP BY mes";

$result = $conn->query($query);

$ventasPorMes = array_fill(1, 12, 0); // Inicializar el arreglo con valores 0

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $mes = (int)$row["mes"];
        $ventasPorMes[$mes] += (float)$row["total_ventas"];
    }
}

// Cerrar la conexión
$conn->close();

// Convertir el arreglo a un formato adecuado para JavaScript
$ventasJson = json_encode(array_values($ventasPorMes));
?>

<!-- Script para inicializar el gráfico -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('myChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
      datasets: [{
        label: 'Ventas',
        data: <?php echo $ventasJson; ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
</body>
</html>

