<?php
require('../config/conections.php');
session_start();

?>

<html>
            <!--Logo-->
            <link rel="shortcut icon" type="image/x-icon" href="../log/log.png">

</html>

<header id="navbar">
    <nav>
        <img src="../assets/client/icons/perfum.png" width="150">
        <div class="nav-links">
            <a href="tienda.php">Tienda</a>
            <a href="carrito.php">Carrito</a>
            <a href=""> <?php
            if (isset($_SESSION['nombre_usuario'])) {
                echo '<div class="nav-icon position-relative text-dark"><i class="fa fa-user-circle"></i> Bienvenido, ' . $_SESSION['nombre_usuario'] . '</div>';
                echo '<a class="nav-icon position-relative text-decoration-none" href="logout.php">';
                echo '<i class="fa fa-fw fa-sign-out-alt text-dark"></i> Cerrar Sesión</a>';
            } else {
                echo '<a class="nav-icon position-relative text-decoration-none" href="login.php">';
                echo '<i class="fa fa-fw fa-user text-dark"></i> Iniciar Sesión</a>';
            }
            ?></a>
        </div>
        <div class="burger-menu">
            <div class="burger-menu-icon">&#9776;</div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var burgerMenuIcon = document.querySelector('.burger-menu-icon');
        var navLinks = document.querySelector('.nav-links');

        burgerMenuIcon.addEventListener('click', function () {
            navLinks.style.display = (navLinks.style.display === 'flex' || navLinks.style.display === '') ? 'none' : 'flex';
        });
    });
</script>

<style>
        /* Estilos por defecto*/

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .nav-links {
            display: flex;
        }

        .nav-links a {
            margin-right: 20px;
            text-decoration: none;
        }

        .profile-details {
            cursor: pointer;
        }

        /* Hamburger menu styles */

        .burger-menu {
            display: none;
            font-size: 20px;
            cursor: pointer;
        }

        .burger-menu:hover {
            color: #555; /* Color del menu */
        }

        .burger-menu-icon {
            display: none;
        }

                /* Estilos responsivos */

        @media only screen and (max-width: 600px) {
            .nav-links {
                display: none;
                flex-direction: column;
                background-color: #333; /* Color al mover el menu */
                position: absolute;
                top: 40px; /* Ajuste de que tanto de separado colocams */
                left: 0;
                width: 100%;
                padding: 10px;
            }

            .nav-links a {
                color: #fff; /* color del texto */
                margin-bottom: 10px; 
            }

            .burger-menu {
                display: block;
            }

            .burger-menu-icon {
                display: block;
                font-size: 24px;
                line-height: 1.5;
            }
        }

        /* Estilos responsivos */

        @media only screen and (max-width: 600px) {
            nav {
                flex-direction: column;
                align-items: stretch;
            }

            .nav-links {
                margin-top: 10px;
                flex-direction: column;
            }

            .nav-links a {
                margin: 0;
            }
        }
    </style>
