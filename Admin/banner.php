<?php
session_start();
?>

<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Editar | Banner</title>

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
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <div class="content-wrapper">
        <br>
        <!-- Contenido principal -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Editar Productos</h3>
                            </div>
                            <div class="card-body">
                            <?php // Comprobar si hay un mensaje de éxito
                                if (isset($_SESSION['mensaje_exito'])) {
                                    echo '<div style="color: green;">' . $_SESSION['mensaje_exito'] . '</div>';
                                    // Limpiar la variable de sesión para que el mensaje no se muestre nuevamente
                                    unset($_SESSION['mensaje_exito']);
                                }

                                // Comprobar si hay un mensaje de error
                                if (isset($_SESSION['mensaje_error'])) {
                                    echo '<div style="color: red;">' . $_SESSION['mensaje_error'] . '</div>';
                                    // Limpiar la variable de sesión para que el mensaje no se muestre nuevamente
                                    unset($_SESSION['mensaje_error']);
                                }
                                ?>
                                <!-- Formulario de edición -->
                                <form action="procesar_formulario.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="imagen">Seleccionar imagen:</label>
                                        <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="titulo">Título:</label>
                                        <input type="text" name="titulo" id="titulo" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitulo">Subtítulo:</label>
                                        <input type="text" name="subtitulo" id="subtitulo" class="form-control" required>
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

                                    <div class="form-group">
                                        <label for="descripcion">Descripción:</label>
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </form>
                                <!-- Fin del formulario -->
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
