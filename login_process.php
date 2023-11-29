<?php
session_start(); // Iniciar la sesión

include('config/conections.php');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$emailPhone = $_POST['email_phone'];
$password = $_POST['password'];

// Sanitize input values to prevent SQL injection
$emailPhone = mysqli_real_escape_string($conn, $emailPhone);
$password = mysqli_real_escape_string($conn, $password);

// Query to verify credentials
$query = "SELECT * FROM usuarios WHERE email='$emailPhone' OR phone='$emailPhone'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Successful login
        $_SESSION['nombre'] = $row['nombre']; // Store name in a session variable

        // Redirect based on role
        if ($row['rol'] == 'cliente') {
            $_SESSION['nombre_usuario'] = $row['nombre']; // Store name in session
            header("Location: cliente/shop.php");
        } elseif ($row['rol'] == 'admin') {
            $_SESSION['nombre_usuario'] = $row['nombre']; // Store name in session
            header("Location: Admin/inicio.php");
        } elseif ($row['rol'] == 'empleado') {
            $_SESSION['nombre_usuario'] = $row['nombre']; // Store name in session
            header("Location: job/inicio.php");
        }
        // Add more role conditions as needed

        exit(); // Exit script
    } else {
        $_SESSION['login_error'] = "Contraseña incorrecta";
        header("Location: login.php"); // Redirect with error message
        exit(); // Exit script
    }
} else {
    $_SESSION['login_error'] = "Usuario no encontrado";
    header("Location: login.php"); // Redirect with error message
    exit(); // Exit script
}

$conn->close(); // Close database connection
?>

