<?php
require('config/conections.php');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $sql = "SELECT * FROM productos WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $product_details = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/client/css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="assets/client/js/app.js"></script>
    <title>Detalles del producto</title>

    <style>
        /* Estilo para la ventana emergente */
        .modal-c {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            z-index: 1000;
            text-align: center; /* Alineación del contenido al centro */
            border-radius: 10px;
        }

        /* Estilo para el botón */
        .modal-button {
            background-color: #e62788; /* Color de fondo verde */
            color: white; /* Color del texto blanco */
            padding: 10px 20px; /* Relleno interno del botón */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            cursor: pointer; /* Cursor de apuntador */
            font-size: 16px; /* Tamaño del texto */
        }

        /* Estilo para cambiar el color del botón al pasar el ratón sobre él */
        .modal-button:hover {
            background-color: #e62788; /* Color de fondo más oscuro en el hover */
        }
    </style>

</head>

<body>
    <?php include('layouts/navbar.php'); ?>

    <main class="details-product-container">
        <div class="details">
            <h2>Detalles del producto</h2>
            <div class="product-details">
                <div class="image-product-container">
                    <img src="imagenes/<?php echo $product_details['imagen']; ?>" alt="">
                </div>
                <div class="info-details-product">
                    <h2><?php echo $product_details['titulo']; ?></h2>
                    <p><?php echo $product_details['subtitulo']; ?></p>
                    <div class="raiting-info">
                        <?php
                        // Muestra el rating basado en la ponderación
                        for ($i = 1; $i <= $product_details["ponderacion"]; $i++) {
                            echo '<img src="assets/client/icons/floaticon/star.png" alt="star">';
                        }
                        ?>
                    </div>
                    <h2>$<?php echo $product_details['precio']; ?></h2>
                    <h2>Contenido del producto</h2>
                    <h2><?php echo $product_details['contenido']; ?></h2>
                    <h2>Cantidad</h2>

                    <div class="values-product">
                        <button onclick="minValue()">-</button>
                        <input type="number" id="value-product" value="1" min="1">
                        <button onclick="maxValue()">+</button>
                    </div>

                    <form method="post" action="">
                        <button type="button" class="open-modal-btn"><i class="bi bi-cart-fill"></i>Comprar</button>
                    </form>
                </div>
            </div>
            <div class="description-product-details">
                <h2>Descripción </h2>
                <p><?php echo $product_details['descripcion']; ?></p>
            </div>

    <div class="modal-c" id="myModal">
        <!-- Contenido de la ventana emergente -->
        <script src="https://cdn.lordicon.com/lordicon-1.4.0.js"></script>
        <lord-icon
            src="https://cdn.lordicon.com/evyuuwna.json"
            trigger="loop"
            delay="2000"
            colors="primary:#e62788"
            style="width:250px;height:250px">
        </lord-icon>
        <p align="center">Para comprar, primero debes registrarte.</p> <br>
        <button class="modal-button" onclick="window.location.href='forms.php'">Ir a Registro</button>
    </div>

        </div>

    </main>
    <?php include('layouts/footer.php')?>
</body>
<script src="assets/client/js/values-config.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var openModalBtn = document.querySelector('.open-modal-btn');
        var modal = document.querySelector('.modal-c');

        openModalBtn.addEventListener('click', function () {
            modal.style.display = 'block';
        });

        // Cierra la ventana emergente al hacer clic fuera de ella
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
</script>

</html>
