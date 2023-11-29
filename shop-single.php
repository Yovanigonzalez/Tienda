<!DOCTYPE html>
<html lang="en">

<head>
    <title>Producto</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="log/log.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/templatemo.css">
    <link rel="stylesheet" href="assets/css/custom.css">

    <!-- Load fonts style after rendering the layout styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/slick-theme.css">

    <style>
          .pink-button {
    background-color: #c2209f;
    color: white;
    border-color: #c2209f;
  }
    </style>
</head>

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
                    <a class="text-light" href="https://instagram.com/perfum.perfumeria?utm_source=qr&igshid=MzNlNGNkZWQ4Mg%3D%3D" target="_blank"  rel="sponsored"><img src="redes/i.png" alt="Instagram" width="25px"></a>
                    <a class="text-light" href="https://twitter.com/" target="_blank"  rel="sponsored"><img src="redes/q1.png" alt="Tik tok" width="25px"></a>
                    <a class="text-light" href="https://twitter.com/PERFUM_tk?t=4eqKjnTt1d99AI02NwOgiA&s=09" target="_blank"  rel="sponsored"><img src="redes/tw.png" alt="Twitter" width="25px"></a>
                </div>

            </div>
        </div>
    </nav>
    <!-- Close Top Nav -->


    <!-- Header -->
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

                <img src="log/log.png" width="100px">
               

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
    <div class="flex-fill">
        <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i> Inicio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-info-circle"></i> Acerca de
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="shop.php">
                    <i class="fas fa-shopping-cart"></i> Tienda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-envelope"></i> Contacto
                </a>
            </li>
        </ul>
    </div>
    <!-- Mueve el enlace "Iniciar Sesión" fuera del contenedor anterior para que quede a la izquierda -->
    <div class="navbar align-self-center d-flex">
        </div>
        <a class="nav-icon position-relative text-decoration-none" href="login.php">
            <i class="fa fa-fw fa-user text-dark mr-3"></i>Iniciar Sesion
        </a>
    </div>
</div>


                
    </nav>
    <!-- Close Header -->

    <!-- Modal -->
    <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="w-100 pt-1 mb-5 text-right">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="get" class="modal-content modal-body border-0 p-0">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
                    <button type="submit" class="input-group-text bg-success text-light">
                        <i class="fa fa-fw fa-search text-white"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!--Jalar los articulos-->

    <?php
        $servername = "localhost";
        $username = "perfumco_perfum";
        $password = "perfumeriaperfum";
        $dbname = "perfumco_perfum";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $sql = "SELECT * FROM productos WHERE id = $product_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<!-- Open Content -->
                <section class="bg-light">
                    <div class="container pb-5">
                        <div class="row">
                            <div class="col-lg-5 mt-5">
                                <div class="card mb-3">
                                    <img class="card-img img-fluid" src="imagenes/' . $row["imagen"] . '" alt="' . $row["producto"] . '">
                                </div>
                                <div class="row">
                                </div>
                            </div>
                            <div class="col-lg-7 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="h2">' . $row["producto"] . '</h1>
                                        <p class="h3 py-2">Precio: $' . $row["precio"] . '</p>
                                        <p class="h3 py-2">Descripcion: ' . $row["descripcion"] . '</p>
                                                                          
                                        <!-- Agregar al carrito -->
                                        <form action="login.php" method="post">
                                            <input type="hidden" name="product_id" value="' . $row["id"] . '">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-shopping-cart"></i> Agregar al carrito
                                            </button>
                                        </form>
                                        <!-- Fin Agregar al carrito -->
                                                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Close Content -->';
        } else {
            echo "Producto no encontrado";
        }
    } else {
        echo "Producto no especificado";
    }

    $conn->close();
?>


    <!--Fin de jalar de articulos-->
    
    <!-- Start Footer -->
    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                <h2 class="h2 text-light border-bottom pb-3 border-light">Perfumeria 'Perfum'</h2>
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
                        <li><a class="text-decoration-none" href="hombre.php">Perfume Hombre</a></li>
                        <li><a class="text-decoration-none" href="mujer.php">Perfume Mujer</a></li>
                        <li><a class="text-decoration-none" href="unisex.php">Perfume Unixes</a></li>
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
            <a class="text-light text-decoration-none" target="_blank" href="https://instagram.com/perfum.perfumeria?utm_source=qr&igshid=MzNlNGNkZWQ4Mg%3D%3D">
                <img src="redes/i.png" alt="Instagram" width="50px">
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/">
                <img src="redes/q1.png" alt="Tiktok" width="50px">
            </a>
        </li>
        <li class="list-inline-item border border-light rounded-circle text-center">
            <a class="text-light text-decoration-none" target="_blank" href="https://twitter.com/PERFUM_tk?t=4eqKjnTt1d99AI02NwOgiA&s=09">
                <img src="redes/tw.png" alt="Twitter" width="50px">
            </a>
        </li>
    </ul>
</div>

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

<div class="col-auto">
  <form method="post" action="index.php">
    <label class="sr-only" for="subscribeEmail">Email address</label>
    <div class="input-group mb-2">
      <input type="text" class="form-control bg-dark border-light text-white" id="subscribeEmail" name="email" placeholder="Email address">
      <div class="input-group-text pink-button">
        <button type="submit" class="btn btn-link" style="color: white; text-decoration: none;">Suscribirse</button>
      </div>
    </div>
  </form>
  
  <?php
  // Mostrar mensaje de éxito si existe
  if (isset($mensajeExito)) {
      echo '<p class="mensaje-exito">' . $mensajeExito . '</p>';
  }
  ?>
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