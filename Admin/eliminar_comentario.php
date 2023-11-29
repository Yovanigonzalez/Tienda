<?php
// Verificar si se recibió un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $commentId = $_GET['id'];

    // Conexión a la base de datos
                                        $servername = "localhost";
                                        $username = "perfumco_perfum";
                                        $password = "perfumeriaperfum";
                                        $dbname = "perfumco_perfum";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Consulta SQL para eliminar el comentario
    $sql = "DELETE FROM contactos WHERE id = $commentId";

    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de comentarios con un mensaje de éxito
        header("Location: comentarios.php?success=1");
        exit();
    } else {
        echo "Error al eliminar el comentario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo "ID de comentario no válido.";
}
?>
