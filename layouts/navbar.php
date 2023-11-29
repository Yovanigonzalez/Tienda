<header id="navbar">
    <nav>
        <img src="assets/client/icons/perfum.png" width="150">
        <div class="nav-links">
            <a href="index.php">Inicio</a>
            <a href="store.php">Tienda</a>
            <a href="contact.php">Contacto</a>
            <a href="about.php">Acerca de</a>
            <div class="profile-details">
                <a href="forms.php"><img src="ico/usuario.png" alt="Imagen de perfil" width="20" height="20"></a>
            </div>
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
