<?php
// Verificar si se proporcionó un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Conexión a la base de datos
                                        $servername = "localhost";
                                        $username = "perfumco_perfum";
                                        $password = "perfumeriaperfum";
                                        $dbname = "perfumco_perfum";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para eliminar el suscriptor
    $sql = "DELETE FROM suscriptores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: suscriptores.php?success=1");
        exit();
    } else {
        echo "Error al eliminar el suscriptor: " . $conn->error;
    }
    

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de suscriptor no válido.";
}
?>
