<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/client/css/styles.css">
    <script src="assets/client/js/app.js"></script>
    <!--Logo-->
    <link rel="shortcut icon" type="image/x-icon" href="log/log.png">

    <title>Contacto</title>
</head>

<body>
    <?php include('layouts/navbar.php')?>
    <?php include('layouts/loaders/contact-loader.php')?>
    <div class="overlay-background"></div>
    <div class="form-contact">
        
    </div>
    <main class="contact-main-container">
        <div class="info-contact">
            <img src="assets/client/icons/perfum.png" alt="Perfum Logo">
            <h2>Donde el aroma se convierte en un hermoso contacto contigo.</h2>
        </div>
        <img src="assets/client/svg/wave-contact.svg">
    </main>

    <section class="welcome-contact-container">
        <div class="welcome-info">
            <h2>¡Bienvenido a Perfum!</h2>
            <p>En Perfum, estamos dedicados a brindarte una experiencia única y envolvente en el mundo de las
                fragancias. Nuestro equipo apasionado está aquí para ayudarte a descubrir la fragancia perfecta que
                refleje tu estilo y personalidad.
                <br>
                Si tienes alguna pregunta, comentario o simplemente quieres compartir tus pensamientos sobre nuestros
                productos y servicios, no dudes en ponerte en contacto con nosotros. Estamos aquí para escucharte y
                asegurarnos de que tengas una experiencia excepcional con nosotros.
            </p>
        </div>
        <img src="assets/client/icons/perfum-logo.png" alt="">
    </section>
    <img src="assets/client/svg/wave-bottom-contact.svg" alt="">
    <section class="form-contact-container">
        <div class="info-form-contact">
            <h2>Puedes comunicarte con nosotros de varias formas</h2>
            <ul>
                <li>Formulario de Contacto: Completa nuestro formulario en línea y nos pondremos en contacto contigo en
                    el menor tiempo posible.</li>
                <li>Número de Teléfono: Si prefieres hablar directamente con uno de nuestros expertos en fragancias, no
                    dudes en llamarnos al <b><a href="tel:2223016946">2223016946</a>.</b></li>
                <li>Correo Electrónico: Envíanos un correo electrónico a <b><a
                            href="malito:perfumatriztk@gmail.com">perfumatriztk@gmail.com</a></b> y te responderemos en
                    breve.</li>
                <li>Redes Sociales: Síguenos en nuestras redes sociales para estar al tanto de las últimas novedades,
                    consejos sobre fragancias y promociones especiales.</li>
            </ul>
            <p>Estamos emocionados de ser parte de tu búsqueda de fragancias excepcionales. En Perfum, la excelencia en
                aromas se encuentra a solo un mensaje de distancia. ¡Esperamos con ansias escucharte!</p>
        </div>
        <div class="form-section-contact">
            <img src="assets/client/icons/floaticon/customer-service.png" alt="">
            <button>Abrir formulario</button>
        </div>
    </section>

    <section class="location-contact-container">
        <div class="location-info">
            <h2>Localizanos</h2>
            <img src="assets/client/icons/google-maps-logo.png" alt="">
            <p>Utilizamos tecnologia de Google para poder brindarte el mejor servicio. Con esta tecnologia te ayudamos a
                localizarnos facilmente.</p>
        </div>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d235.94351628347997!2d-97.7305565569622!3d18.882810305476845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c563d79327d9e7%3A0x1ee0221057940bd6!2sPerfumer%C3%ADa%20Perfum!5e0!3m2!1ses-419!2smx!4v1699422629735!5m2!1ses-419!2smx"
            width="600" height="450" style="border:1;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>

    </section>

    <?php include('layouts/footer.php')?>
</body>

</html>