<?php
// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el correo electrónico del formulario
    $email = $_POST["email"];

    // Valida que el correo no esté vacío antes de guardar
    if (!empty($email)) {
        // Conecta a la base de datos (cambiar según tus credenciales)
        $servername = "localhost";
        $username = "perfumco_perfum";
        $password = "perfumeriaperfum";
        $dbname = "perfumco_perfum";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica la conexión
        if ($conn->connect_error) {
            die("La conexión falló: " . $conn->connect_error);
        }

        // Inserta el correo en la base de datos
        $sql = "INSERT INTO suscriptores (email) VALUES ('$email')";

        if ($conn->query($sql) === TRUE) {
            $mensajeExito = "¡Gracias por suscribirte!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    } else {
        $mensajeExito = "Por favor, ingresa un correo electrónico válido.";
    }
}
?>