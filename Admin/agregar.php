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
require('../config/conections.php');

include 'menu.php';

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Variable para almacenar el mensaje de éxito
$mensajeExitoso = "";

// Procesar el formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $precio = $_POST['precio'];
    $contenido = $_POST['contenido'];
    $categoria = $_POST['categoria'];
    $descripcion = $_POST['descripcion'];
    $ponderacion = $_POST['ponderacion'];

    // Manejar la carga de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $tempFile = $_FILES['imagen']['tmp_name'];
        $targetDir = '../perfumes/';
        $targetFile = $targetDir . basename($_FILES['imagen']['name']);

        // Mover la imagen cargada al directorio de destino
        if (move_uploaded_file($tempFile, $targetFile)) {
            // La imagen se ha cargado correctamente
        } else {
            $mensajeExitoso = "Error al cargar la imagen.";
        }
    } else {
        $mensajeExitoso = "Error al cargar la imagen.";
    }

    // Preparar la consulta SQL para insertar los datos en la base de datos
    $sql = "INSERT INTO productos (titulo, subtitulo, precio, contenido, categoria, descripcion, ponderacion, imagen) 
            VALUES ('$titulo', '$subtitulo', $precio, '$contenido', '$categoria', '$descripcion', $ponderacion, '$targetFile')";

    // Ejecutar la consulta y verificar si se realizó correctamente
    if ($conn->query($sql) === TRUE) {
        $mensajeExitoso = "Producto agregado exitosamente.";
    } else {
        $mensajeExitoso = "Error al agregar el producto: " . $conn->error;
    }
}
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Agregar productos</title>
  
    <!--Logo-->
  <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

  <!-- Enlaces a los archivos CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
  <!-- Icono de la página -->
  <link rel="icon" href="../logo/log.png" type="image/jpeg">

  <!-- Enlaces a los archivos JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>

    <!-- Estilos personalizados -->
    <style>
    .formulario-box {
      background-color: #ffffff;
      border: 1px solid #d2d6de;
      padding: 20px;
      border-radius: 5px;
    }
    .mensaje-exito {
      background-color: #dff0d8;
      color: #3c763d;
      border: 1px solid #d6e9c6;
      border-radius: 4px;
      padding: 10px;
      margin-bottom: 10px;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">



        <style>
    .nav-icon {
        margin-right: 20px; /* Puedes ajustar el valor según tus preferencias */
    }
</style>

        
      </ul>
    </nav>


<!-- Contenido principal -->
<div class="content-wrapper">
    <br>
    <!-- Formulario de registro de producto -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <!-- Agregar la clase "formulario-box" para aplicar el estilo de cuadro blanco -->
                <div class="box box-primary formulario-box">
                    <div class="box-body">
                        <h1 align="center">Agregar Productos</h1>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($mensajeExitoso)) {
                            echo '<div class="mensaje-exito">' . $mensajeExitoso . '</div>';
                        }
                        ?>
                        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                            
                        <div class="form-group">
                            <label for="titulo">Título:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="Inspirado en:" required>
                        </div>


                            <div class="form-group">
                                <label for="subtitulo">Subtítulo:</label>
                                <input type="text" class="form-control" id="subtitulo" name="subtitulo" required>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input type="number" class="form-control" id="precio" name="precio" required>
                            </div>

                            <div class="form-group">
                                <label for="contenido">Contenido:</label>
                                <input type="text" class="form-control" id="contenido" name="contenido">
                            </div>

                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                            </div>

                            <div class="form-group">
                                <label for="categoria">Categoría:</label>
                                <select class="form-control" id="categoria" name="categoria" required>
                                    <option value="">Seleccionar categoría</option>
                                    <option value="Mujer"><i class="fas fa-female"></i> Mujer</option>
                                    <option value="Hombre"><i class="fas fa-male"></i> Hombre</option>
                                    <option value="Unisex">Unisex</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="ponderacion">Ponderación:</label>
                                <div>
                                    <input type="radio" name="ponderacion" value="1" required> 1
                                    <input type="radio" name="ponderacion" value="2"> 2
                                    <input type="radio" name="ponderacion" value="3"> 3
                                    <input type="radio" name="ponderacion" value="4"> 4
                                    <input type="radio" name="ponderacion" value="5"> 5
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Agregar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br>
</div>


    </body>
</html>
