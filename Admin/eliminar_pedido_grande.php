<?php
// Conexión a la base de datos (similar al código original)
        $servername = "localhost";
        $username = "perfumco_perfum";
        $password = "perfumeriaperfum";
        $dbname = "perfumco_perfum";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID del pedido grande a eliminar
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Consulta SQL para obtener el total del pedido grande antes de eliminarlo
  $getTotalQuery = "SELECT total FROM compra_grande WHERE id = $id";
  $totalResult = $conn->query($getTotalQuery);
  $total = $totalResult->fetch_assoc()['total'];

  // Insertar el total en la tabla "totales_eliminados"
  $insertTotalQuery = "INSERT INTO totales_eliminados (total, fecha) VALUES ($total, NOW())";
  $conn->query($insertTotalQuery);

  // Consulta SQL para eliminar el pedido grande
  $deleteQuery = "DELETE FROM compra_grande WHERE id = $id";

  if ($conn->query($deleteQuery) === TRUE) {
    // Redirigir de vuelta a la página de pedidos
    header("Location: pedidos.php");
    exit();
  } else {
    echo "Error al eliminar el pedido grande: " . $conn->error;
  }
}

$conn->close();
?>
