<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
    $servername = "localhost";
    $username = "perfumco_perfum";
    $password = "perfumeriaperfum";
    $dbname = "perfumco_perfum";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el valor del formulario
$emailPhone = $_POST["email_phone"];

// Consultar si el correo o número de teléfono existe en la base de datos
$query = "SELECT * FROM usuarios WHERE email = '$emailPhone' OR phone = '$emailPhone'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    
    // Generar una nueva contraseña temporal (puedes personalizar esto)
    $newPassword = substr(md5(time()), 0, 8);
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la base de datos
    $updateQuery = "UPDATE usuarios SET password = '$hashedPassword' WHERE id = " . $row["id"];
    if ($conn->query($updateQuery)) {
        $mensaje = "Tu nueva contraseña ha sido enviada a tu correo electrónico o número de teléfono.";
    } else {
        $errorMensaje = "Error al actualizar la contraseña: " . $conn->error;
    }
} else {
    $errorMensaje = "No se encontró un usuario con el correo electrónico o número de teléfono proporcionado.";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Perfumeria 'Perfum'</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="assets/img/apple-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="log/log.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
</head>
<!-- Agrega este código justo antes de </body> -->
<div class="whatsapp-float">
  <a href="https://api.whatsapp.com/send?phone=2223016946&text=Hola,%20estoy%20interesado%20en%20obtener%20más%20información%20sobre%20los%20perfumes%20de%20'Perfum'.%20¿Pueden%20ayudarme?" target="_blank">
    <img src="ico/w2.png" alt="WhatsApp" />
  </a>
</div>
<style>
  .whatsapp-float {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000;
  }

  .whatsapp-float img {
    width: 40px; /* Ajusta el tamaño del icono según tus preferencias */
    height: 40px;
    border-radius: 0%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  }

  .img{
    max-width: 100%;  
    height: auto;
  }

  .h2-pink {
    text-align: center;
    color: pink;
    border-bottom: 2px solid lightgray;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }

  .pink-button {
    background-color: #c2209f;
    color: white;
    border-color: #c2209f;
  }
</style>


<body>


    <!-- Start Top Nav -->
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <i class="fa fa-envelope mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:perfumatriztk@gmail.com">perfumatriztk@gmail.com</a>
                    <i class="fa fa-phone mx-2"></i>
                    <a class="navbar-sm-brand text-light text-decoration-none" href="tel:2223016946">2223016946</a>
                </div>

                <div>
                    <a class="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><img src="redes/f.png" alt="Facebook" width="25px"></a>
                    <a class="text-light" href="https://www.instagram.com/" target="_blank"  rel="sponsored"><img src="redes/i.png" alt="Facebook" width="25px"></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"  rel="sponsored"><img src="redes/t.png" alt="Facebook" width="25px"></a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

                <img src="log/log.png" width="100px">
               

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">Acerca de</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shop.php">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.php">Contacto</a>
                        </li>
                    </ul>
                </div>
                
                <div class="navbar align-self-center d-flex">
                    <div class="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inputMobileSearch" placeholder="Search ...">
                            <div class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </div>
                        </div>
                    </div>
                    <a class="nav-icon position-relative text-decoration-none" href="login.php">
                        <i class="fa fa-fw fa-user text-dark mr-3"></i>
                    </a>
                </div>
            </div>

        </div>
    </nav>
    <!-- Close Header -->

    <!--Formulario-->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header h2-pink">
                        Recuperar Contraseña
                    </div>
                    <div class="card-body">
                        <?php
                        if (!empty($mensaje)) {
                            echo '<div class="alert alert-success">' . $mensaje . '</div>';
                        } elseif (!empty($errorMensaje)) {
                            echo '<div class="alert alert-danger">' . $errorMensaje . '</div>';
                        }
                        ?>
                        <form action="forgot_password.php" method="POST">
                            <div class="mb-3">
                                <label for="email_phone" class="form-label">
                                    <i class="fas fa-envelope"></i> Correo electrónico o Número de teléfono
                                </label>
                                <input type="text" class="form-control" id="email_phone" name="email_phone" required>
                            </div>
                            <button type="submit" class="btn pink-button">
                                <i class="fas fa-key"></i> Recuperar Contraseña
                            </button>
                        </form>
                        <p class="mt-3 text-center"><a href="index.php">Volver al inicio</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br>

    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Perfumeria 'Perfu'</h2>
                    <ul class="list-unstyled text-light footer-link-list">

                    <li>
            <i class="fas fa-map-marker-alt fa-fw"></i>
            <a href="https://goo.gl/maps/2c83WdKy1ifrNW268" target="_blank">
                C. 3 Sur número 503, Centro, 75480 Tecamachalco, Pue.
            </a>
        </li>                        
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:2223016946">2223016946</a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:perfumatriztk@gmail.com">perfumatriztk@gmail.com</a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Productos</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="shop.php">Perfume Hombe</a></li>
                        <li><a class="text-decoration-none" href="shop.php">Perfume Mujer</a></li>
                        <li><a class="text-decoration-none" href="shop.php">Perfume Unixes</a></li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Información adicional</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="index.php">Inicio</a></li>
                        <li><a class="text-decoration-none" href="about.php">Sobre nosotros</a></li>
                        <li><a class="text-decoration-none" href="shop.php">Tienda</a></li>
                        <li><a class="text-decoration-none" href="contact.php">Contacto</a></li>
                    </ul>
                </div>

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                
                <div class="col-auto me-auto">
    <ul class="list-inline text-left footer-icons">
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="http://facebook.com/">
                <img src="redes/f.png" alt="Facebook" width="50px">
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/">
                <img src="redes/i.png" alt="Instagram" width="50px">
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/">
                <img src="redes/t.png" alt="Twitter" width="50px">
            </a>
        </li>
    </ul>
</div>


                <div class="col-auto">
  <label class="sr-only" for="subscribeEmail">Email address</label>
  <div class="input-group mb-2">
    <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
    <div class="input-group-text pink-button">Subscribete</div>
  </div>
</div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2017 - 2023 Perfum 
                            | Diseñado por <a>Yovani Gonzalez Rodríguez</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>


    </footer>
    <!-- End Footer -->

    <!-- Start Script -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/templatemo.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>