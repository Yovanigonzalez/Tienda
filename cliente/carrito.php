<?php require('../config/conections.php');?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/client/css/styles.css">
    <script src="../assets/client/js/app.js"></script>
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <title>Perfum | Carrito</title>
    <style>
        .store-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;  
        }

        .store {
            flex: 1;
        }

        .store-head {
            /* Estilos para la cabecera de la tienda */
        }

        .products-store {
            /* Estilos para la sección de productos */
            display: flex;
            flex-wrap: wrap; /* Permite que los productos se envuelvan automáticamente en filas */
        }

        .items-store {
            display: flex;
            flex-wrap: wrap;
        }

        .product-item {
            flex: 0 0 30%;
            margin: 0 15px 15px 0;
        }

        @media screen and (max-width: 768px) {
            /* Media query for screens smaller than or equal to 768px width */
            .items-store {
                flex-direction: column;
            }

            .product-item {
                flex: 0 0 100%;
            }
        }

        
    </style>
</head>

<body>
    <?php include('navbar.php')?>
    <?php include('../layouts/loaders/shop-loader.php')?>
    <main class="store-container">
        <div class="store">
            <div class="store-head">
                <h2>Carrito</h2>
            </div>
            <div class="items-store">

                <div class="products-store">

                <?php   
                $sql = "SELECT * FROM productos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<article class="product-item">
                            <img src="../imagenes/' . $row["imagen"] . '" alt="">
                            <h2>' . $row["titulo"] . '</h2>
                            <p>' . $row["subtitulo"] . '</p>
                            <p>Contenido: ' . $row["contenido"] . '</p>
                            <p>Categoría: ' . $row["categoria"] . '</p>
                            <br>
                            <p>';
                        
                        // Display star rating based on ponderation
                        for ($i = 1; $i <= $row["ponderacion"]; $i++) {
                            echo '<img src="../assets/client/icons/floaticon/star.png" width="30" height="30">';
                        }

                        echo '</p>
                            <div class="raiting-product-item">
                            </div>
                            <div class="info-product-item">
                                <h2>$' . $row["precio"] . '</h2><br>
                                <a href="details-product.php?id=' . $row["id"] . '" style="color: #ffffff;">Comprar</a>
                            </div>
                        </article>';
                    }
                } else {
                    echo '
                        <div class="alert-empty-products">
                            <img src="assets/client/icons/floaticon/empty-cart.png" alt="">
                            <h3>Sin existencias</h3>
                        </div>';
                }
                ?>


                </div>
            </div>
        </div>
    </main>

    <?php include('footer.php');?>
</body>

</html>