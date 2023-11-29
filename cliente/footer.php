<footer>
    <div class="footer-head">
        <img src="../assets/client/icons/perfum.png" alt="">
        <div class="social-links">
            <a href="https://fb.com/templatemo"><i class="bi bi-facebook"></i></a>
            <a href="https://instagram.com/perfum.perfumeria?utm_source=qr&igshid=MzNlNGNkZWQ4Mg%3D%3D"><i class="bi bi-instagram"></i></a>
            <a href="https://twitter.com/PERFUM_tk?t=4eqKjnTt1d99AI02NwOgiA&s=09"><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-tiktok"></i></a>

            
            <style>
                .footer-sections h3,
                .footer-sections a {
                    color: black;
                }

                                /* Estilos generales */
                .footer-head {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-between;
                    align-items: center;
                }

                .social-links {
                    margin-top: 10px;
                    display: flex;
                    gap: 10px;
                }

                .footer-sections {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: space-around;
                    padding: 20px;
                }

                .sections {
                    margin: 0 20px;
                    flex: 1 1 300px; /* Ajusta el ancho máximo de las secciones */
                }

                .sections h3 {
                    font-size: 1.2rem;
                    margin-bottom: 10px;
                }

                .sections-links {
                    display: flex;
                    align-items: center;
                    margin-bottom: 8px;
                }


                .sections-links i {
                    margin-right: 8px;
                }

                /* Sección de planes de pie de página */
                .footer-plans {
                    text-align: center;
                    padding: 20px;
                }

                .plans-buttons {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }

                /* Estilos del modal */
                .modal-content {
                    max-width: 80%;
                    transition: all .2s;
                }

                /* Estilos de la sección de planes de pie de página */

                .footer-plans {
                    text-align: justify;
                    padding: 20px;
                }

                .plans-buttons {
                    display: flex;
                    flex-direction: column;
                    gap: 10px;
                }

                /* Estilo para el campo de correo electrónico */
                #subscribeEmail {
                    padding: 8px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    width: 50%;
                    box-sizing: border-box;
                }

                /* Estilo para el botón de suscripción */
                /* Estilo para el botón de suscripción con el color actualizado */
                .plans-buttons button {
                    padding: 10px;
                    background-color: #e62788; /* Nuevo color de fondo del botón */
                    color: #fff; /* Color del texto del botón */
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                }


                /* Estilos responsivos */
                @media only screen and (max-width: 768px) {
                    .footer-head {
                        flex-direction: column;
                        align-items: flex-start;
                    }


                    .plans-buttons {
                        flex-direction: column;
                    }
                }

                /* Estilos del modal */
            .modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }

            .modal-content {
                background-color: #fefefe;
                margin: 15% auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                max-width: 400px;
                border-radius: 10px;

            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .modal-content {
                text-align: center; /* Alinea el contenido al centro */
            }

            </style>


        </div>
    </div>

    <div class="footer-sections">
        <div class="sections">
            <h3>Contacto</h3>
            <div class="sections-links">
                <i class="bi bi-geo-alt-fill"></i>
                <a href="https://goo.gl/maps/2c83WdKy1ifrNW268">C. 3 Sur número 503, Centro, 75480 Tecamachalco,
                    Pue.</a>
            </div>
            <div class="sections-links">
                <i class="bi bi-telephone-fill"></i>
                <a href="tel:2223016946">2223016946</a>
            </div>
            <div class="sections-links">
                <i class="bi bi-envelope-fill"></i>
                <a href="malito:perfumatriztk@gmail.com">perfumatriztk@gmail.com</a>
            </div>
        </div>

        <div class="sections">
            <h3>Productos</h3>
            <a href="">Perfumes Hombres</a>
            <a href="">Perfumes mujeres</a>
            <a href="">Perfumes Unixes</a>
        </div>
        <div class="sections">
            <h3>Accesos rapidos</h3>
            <a href="index.php">Inicio</a>
            <a href="store.php">Tienda</a>
            <a href="contact.php">Contacto</a>
            <a href="about.php">Acerca de</a>
        </div>
    </div>

    <?php

require('../config/conections.php');

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el correo electrónico del formulario
    $email = $_POST["email"];

    // Valida que el correo no esté vacío antes de guardar
    if (!empty($email)) {

        // Verifica si el correo ya existe en la base de datos
        $checkEmailQuery = "SELECT * FROM suscriptores WHERE email = '$email'";
        $result = $conn->query($checkEmailQuery);

        if ($result->num_rows > 0) {
            // El correo ya está registrado
            $mensajeExito = "Ya hay un registro con el mismo correo.";
        } else {
            // Inserta el correo en la base de datos
            $insertQuery = "INSERT INTO suscriptores (email) VALUES ('$email')";

            if ($conn->query($insertQuery) === TRUE) {
                $mensajeExito = "¡Gracias por suscribirte!";
            } else {
                $mensajeExito = "Error al intentar suscribirse.";
            }
        }

        // Cierra la conexión a la base de datos
        $conn->close();
    } else {
        $mensajeExito = "Por favor, ingresa un correo electrónico válido.";
    }
}
?>


    <div class="footer-plans">
        <p>Para recibir informacion sobre nuestros productos , suscribase a nuestro servicio</p>
        <form action="#" method="POST" class="plans-buttons">
            <input placeholder="Correo electronico" type="email" id="subscribeEmail" name="email">
            <button type="submit">Suscribirse</button>
        </form>
    </div>
    

    <div class="modal" id="messageModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>

        <lord-icon
            src="https://cdn.lordicon.com/xtzvywzp.json"
            trigger="loop"
            delay="1000"
            colors="primary:#e62788"
            style="width:200px;height:200px">
        </lord-icon>
        <p align="center" id="modalMessage"></p>

    </div>
</div>

<script>
    // Función para mostrar el modal con un mensaje
    function showModal(message) {
        // Actualiza el contenido del modal
        document.getElementById('modalMessage').innerHTML = message;
        // Muestra el modal
        document.getElementById('messageModal').style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        document.getElementById('messageModal').style.display = 'none';
    }

    // Muestra el modal de éxito o error según el mensaje
    <?php if (isset($mensajeExito)): ?>
        showModal("<?php echo $mensajeExito; ?>");
    <?php endif; ?>
</script>

</footer>