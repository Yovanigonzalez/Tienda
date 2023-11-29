<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "perfumco_perfum";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario
    $titulo = $_POST["titulo"];
    $subtitulo = $_POST["subtitulo"];
    $ponderacion = $_POST["ponderacion"];
    $descripcion = $_POST["descripcion"];

    // Procesar la imagen
    $nombreArchivo = $_FILES["imagen"]["name"];
    $rutaArchivo = "../banner/" . $nombreArchivo;

    move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaArchivo);

    // Preparar la consulta SQL con la tabla 'baner'
    $consulta = "INSERT INTO baner (titulo, subtitulo, ponderacion, descripcion, imagen) 
                 VALUES ('$titulo', '$subtitulo', '$ponderacion', '$descripcion', '$rutaArchivo')";

    // Ejecutar la consulta
    if ($conexion->query($consulta) === TRUE) {
        session_start();
        $_SESSION['mensaje_exito'] = "Los datos se han guardado correctamente.";
    } else {
        $_SESSION['mensaje_error'] = "Error al guardar los datos: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();

    // Redirigir a banner.php
    header("Location: banner.php");
    exit();
}
?>

