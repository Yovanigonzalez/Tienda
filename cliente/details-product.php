<?php
require('../config/conections.php');

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
    <link rel="stylesheet" href="../assets/client/css/styles.css">
    <link rel="stylesheet" href="../assets/client/css/stylesd.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="../assets/client/js/app.js"></script>
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

    <title>Detalles del producto</title>

</head>

<body>
    <?php include('navbar.php'); ?>

    <main class="details-product-container">
        <div class="details">
            <h2>Detalles del producto</h2>
            <div class="product-details">
                <div class="image-product-container">
                    <img src="../imagenes/<?php echo $product_details['imagen']; ?>" alt="">
                </div>
                <div class="info-details-product">
                    <h2><?php echo $product_details['titulo']; ?></h2>
                    <p><?php echo $product_details['subtitulo']; ?></p>
                    <div class="raiting-info">
                        <?php
                        // Muestra el rating basado en la ponderación
                        for ($i = 1; $i <= $product_details["ponderacion"]; $i++) {
                            echo '<img src="../assets/client/icons/floaticon/star.png" alt="star">';
                        }
                        ?>
                    </div>
                    <h2>$<?php echo $product_details['precio']; ?></h2>
                    <!--<h2>Contenido del producto</h2> me  quito espacio-->
                    <h2><?php echo $product_details['contenido']; ?></h2>
                    <h2>Cantidad</h2>

                    <div class="values-product">
                    <button onclick="minValue()">-</button>
                    <input type="number" id="value-product" value="0" min="0" oninput="updateCantidadAVender()">
                    <button onclick="maxValue()">+</button>
                    </div>
                    <br>
                    <h4>Subtotal: <span id="subtotal">0.00</span></h4>

                    <h4 id="shipping">Envío: $250.00</h4>

                    <h4 id="total">Total: $0.00</h4>

                        <form method="post" action="">
                        <button type="button" class="open-modal-btn" onclick="mostrarModal()"><i class="bi bi-cart-fill"></i>Comprar</button>
                        </form>
                    </div>
                </div>



            <div class="description-product-details">
                <h2>Descripción </h2>
                <p><?php echo $product_details['descripcion']; ?></p>
            </div>




            <div class="modal-c" id="myModal">
            <!-- Botón de cierre -->
            <span class="close-button" onclick="closeModal()">x</span>
            <br>
            <!-- Contenido de la ventana emergente -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">



            <!-- Tu formulario HTML -->
            <form method="post" action="mercado-pago.php" onsubmit="return validarFormulario()">
                <label for="nombre">Nombre <i class="bi bi-person"></i>:</label>
                <input type="text" id="nombre" name="nombre" oninput="eliminarNumeros()" required>

                <label for="telefono">Número de teléfono <i class="bi bi-phone"></i>:</label>
                <input type="tel" id="telefono" name="telefono" pattern="[0-9]{10}" title="El número de teléfono debe tener 10 dígitos" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>

                <label for="lugar">Dirección <i class="bi bi-house"></i>:</label>
                <input type="text" id="lugar" name="lugar" required>

                <h4>Producto: <?php echo htmlspecialchars($product_details['subtitulo']); ?></h4>
                <br>
                <h4>Cantidad a vender: <span id="cantidadModal" name="cantidadModal">0</span></h4>
                <br>
                    <h4 id="total">Total: <span id="formattedTotal" name="formattedTotal">$0.00</span></h4>
                <!-- Puedes agregar más campos según sea necesario -->
                <br>
                <button type="sumbit" class="modal-button">Realizar compra</button>
            </form>


    
        </div>

            </main>
        </body>
        <script src="../assets/client/js/values-config.js"></script>


        <script>
        document.addEventListener("DOMContentLoaded", function () {
            var realizarCompraBtn = document.getElementById('realizarCompraBtn');

            realizarCompraBtn.addEventListener('click', function () {
            // Obtener el total
            var total = document.getElementById('formattedTotal').textContent;

            // Redirigir a mercado-pago.php con el total como parámetro
            window.location.href = 'mercado-pago.php?total=' + encodeURIComponent(total);
            });
        });
        </script>


        <script>

        function prepararPago() {
            // Obtener la cantidad seleccionada y actualizar el campo oculto
            var cantidadSeleccionada = document.getElementById('value-product').value;
            document.getElementById('cantidadModalInput').value = cantidadSeleccionada;

            // Obtener el total y actualizar el campo oculto
            var total = document.getElementById('formattedTotal').textContent;
            document.getElementById('totalInput').value = total;

            // Enviar el formulario
            document.querySelector('form').submit();
        }


        function mostrarModal() {
            // Obtén la cantidad seleccionada
            var cantidadSeleccionada = document.getElementById('value-product').value;

            // Actualiza el contenido del modal con la cantidad seleccionada
            document.getElementById('cantidadModal').textContent = cantidadSeleccionada;

            // Muestra el modal
            document.getElementById('myModal').style.display = 'block';
        }
        </script>

        <script>
            function eliminarNumeros() {
            var nombreInput = document.getElementById('nombre');
            nombreInput.value = nombreInput.value.replace(/[0-9]/g, '');
        }

        function validarTelefono() {
            var telefonoInput = document.getElementById('telefono');
            var telefonoValue = telefonoInput.value.replace(/[^0-9]/g, '').slice(0, 10);
            telefonoInput.value = telefonoValue;
            
            // Agrega una clase de error si la longitud no es 10
            if (telefonoValue.length !== 10) {
                telefonoInput.classList.add('error');
            } else {
                telefonoInput.classList.remove('error');
            }
        }

        function validarFormulario() {
            var telefonoInput = document.getElementById('telefono');
            var telefonoValue = telefonoInput.value.replace(/[^0-9]/g, '').slice(0, 10);
            
            // Verifica si la longitud es 10, de lo contrario, muestra una alerta y detiene el formulario
            if (telefonoValue.length !== 10) {
                alert('El número de teléfono debe tener 10 dígitos.');
                return false; // Detiene el envío del formulario
            }
            
            return true; // Permite el envío del formulario
        }
        </script>

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

            function minValue() {
            var currentValue = parseInt(document.getElementById('value-product').value);
            if (currentValue > 1) {
                document.getElementById('value-product').value = currentValue - 1;
                updateSubtotal();
            }
        }

            function maxValue() {
                var currentValue = parseInt(document.getElementById('value-product').value);
                document.getElementById('value-product').value = currentValue + 1;
                updateSubtotal();
            }

            function updateCantidadAVender() {
                updateSubtotal();
            }

            function updateSubtotal() {
            var cantidadAVender = parseInt(document.getElementById('value-product').value);
            var precioUnitario = <?php echo $product_details['precio']; ?>;
            var subtotal = cantidadAVender * precioUnitario;

            // Formatear el subtotal con separadores de miles y dos decimales en pesos mexicanos
            var formattedSubtotal = subtotal.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });

            document.getElementById('subtotal').textContent = formattedSubtotal;

            // Actualizar envío en función del subtotal
            var shippingElement = document.getElementById('shipping');
            var costoEnvio = 250.00;
            if (subtotal > 1500) {
                shippingElement.textContent = 'Envío: Envío Gratis';
                costoEnvio = 0.00; // Si el envío es gratis, establecer el costo en 0.00
            } else {
                shippingElement.textContent = 'Envío: $250.00';
            }

            // Actualizar el total en función del subtotal y envío
            var totalElement = document.getElementById('total');
            var total = subtotal + costoEnvio;
            var formattedTotal = total.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });

            // Mostrar 'Total: ' antes del valor total
            totalElement.textContent = 'Total: ' + formattedTotal;

            // Actualizar también el span dentro del formulario
            var formattedTotalElement = document.getElementById('formattedTotal');
            formattedTotalElement.textContent = formattedTotal;
        }



        </script>

        <script>
            // Función para cerrar el modal
            function closeModal() {
                document.getElementById('myModal').style.display = 'none';
            }
        </script>

        </html>
