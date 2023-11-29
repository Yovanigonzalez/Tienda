<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/client/css/styles.css">
    <script src="assets/client/js/app.js"></script>
    <script src="assets/client/js/carousel-config.js"></script>
    <script src="https://unpkg.com/gsap@3.9.0/dist/gsap.min.js"></script>
    <script src="https://unpkg.com/scrolltrigger@1.0.9/dist/ScrollTrigger.min.js"></script>
    <script src="assets/client/js/gsap.js"></script>
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="log/log.png">

    <title>Perfum | Perfumes de Tecamachalco</title>
</head>
<?php include('layouts/navbar.php')?>
<?php include('layouts/loader.php')?>

<body>
    <main class="container-main" id="trigger">
        <section>
            <div class="content-main-section" id="pin">
                <section>
                    <h2>Envuelve tus sentidos en fragancias únicas</h2>
                    <p>
                        Descubre un mundo de aromas y elegancia en nuestra perfumería. Nuestra selección de fragancias
                        excepcionales te invita a experimentar la belleza y la sofisticación en cada gota.</p>
                    <a href="store.php">Explorar</a>
                </section>

                <div class="background-container">
                    <img src="assets/client/images/background/backgroundMain.png" alt="backgroudnMain">
                </div>
            </div>
        </section>

        <div class="products-main-container" id="pin">
            <div class="head-products-main-container">
                <h2>Productos</h2>
            </div>

            <div class="carousel-container">
                <div class="carousel" id="myCarousel">
                    <div class="carousel-inner" id="box">

                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "perfumco_perfum";

                    // Crear conexión
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM baner";
                    $result = $conn->query($sql);

                    // Verificar si la consulta fue exitosa
                    if ($result === false) {
                        die("Error en la consulta: " . $conn->error);
                    }

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $imagenURL = 'banner/' . $row["imagen"];
                    
                            echo '<div class="carousel-item text-center">'; // Agrega la clase text-center aquí
                            echo '<img src="' . $imagenURL . '" alt="Product">';
                            echo '<div class="carousel-item-info text-center">'; // Agrega la clase text-center aquí
                            echo '<h2>' . $row["titulo"] . '</h2>';
                            echo '<h3>' . $row["subtitulo"] . '</h3>';
                            echo '<div class="raiting-images">';
                            for ($i = 1; $i <= $row["ponderacion"]; $i++) {
                                echo '<img src="assets/client/icons/floaticon/star.png" width="30" height="30">';
                            }
                            echo '</div>';
                            echo '<p>' . $row["descripcion"] . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo "0 resultados";
                    }
                    
                    $conn->close();
                    ?>
                    

                    </div>
                    <div class="carousel-points" id="points-container"></div>
                </div>
            </div>

            <div class="payments-info-container" id="pin">
                <div class="payments-info-items">
                    <div class="info-payments">
                        <h2>Todas tus compras son seguras</h2>
                        <p>En nuestra perfumería, te ofrecemos una experiencia única donde la belleza se encuentra con
                            la conveniencia. Descubre las fragancias más exquisitas y los productos de cuidado personal
                            que amas, mientras disfrutas de la comodidad y seguridad de pagar con Mercado Pago. Tu aroma
                            perfecto y tu tranquilidad, todo en un solo lugar.</p>
                    </div>
                    <img src="assets/client/icons/Mercado-Pago-Logo.png" alt="">
                </div>

                <h2>Mercado pago admite pagos mediante</h2>
                <div class="methods-payments">
                    <img src="assets/client/icons/visa-logo.png" alt="">
                    <img src="assets/client/icons/mastercard-icon.png" alt="">
                    <img src="assets/client/icons/oxxo-icon.png" alt="">
                    <img src="assets/client/icons/mercado-credito-icon.jpg" alt="">
                </div>
            </div>
        </div>
    </main>
    <?php include('layouts/footer.php')?>
</body>
</html>
