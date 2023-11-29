    <html>
        <!--Logo-->
        <link rel="shortcut icon" type="image/x-icon" href="log/log.png">

    </html>

    <?php session_start(); ?>

<?php
require('config/conections.php');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmar_password = $_POST["confirmar_password"];
    $rol = isset($_POST["admin"]) && $_POST["admin"] == "on" ? 'admin' : 'cliente';

    // Check if the email already exists in the database
    $check_email_sql = "SELECT id FROM usuarios WHERE email = '$email'";
    $result = $conn->query($check_email_sql);

    if ($result->num_rows > 0) {
        $_SESSION['mensaje'] = "El correo electrónico ya está registrado. Por favor, utiliza otro correo.";
    } elseif ($password != $confirmar_password) {
        $_SESSION['mensaje'] = "Las contraseñas no coinciden.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES ('$nombre', '$email', '$hashed_password', '$rol')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "Usuario registrado con éxito. <br> Ahora ya puedes iniciar sesión.<br>";
            $_SESSION['mensaje'] = $mensaje;
        } else {
            $_SESSION['mensaje'] = "Error al registrar el usuario: " . $conn->error;
        }
    }
}

$conn->close();
?>

<?php
require('config/conections.php');

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Verificar las credenciales en la base de datos
    $check_credentials_sql = "SELECT id, nombre, email, password, rol FROM usuarios WHERE email = '$email'";
    $result = $conn->query($check_credentials_sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            // Credenciales correctas, redirigir según el rol y guardar el nombre en sesión
            $_SESSION['nombre_usuario'] = $row["nombre"];

            if ($row["rol"] == 'cliente') {
                header("Location: cliente/tienda.php");
                exit();
            } elseif ($row["rol"] == 'admin') {
                header("Location: Admin/inicio.php");
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "Contraseña incorrecta.";
        }
    } else {
        $_SESSION['mensaje'] = "El correo electrónico no está registrado.";
    }

    $conn->close();
}
?>


<?php
if (isset($_SESSION['mensaje'])) {
    $mensaje = $_SESSION['mensaje'];

    echo "<style>
            .mi-modal {
                display: block;
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                border-radius: 10px;
                padding: 20px;
                background: #fff;
                border: 1px solid #ccc;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
                z-index: 1000;
            }
            .centrar-modal {
                text-align: center;
            }
            .centrar-icono {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }
          </style>";

    echo "<div class='mi-modal centrar-modal'>$mensaje<div class='centrar-icono'>";

    if (strpos($mensaje, "éxito") !== false) {
        // Display success Lordicon
        echo "<script src='https://cdn.lordicon.com/lordicon-1.2.0.js'></script>
                <lord-icon
                    src='https://cdn.lordicon.com/oqdmuxru.json'
                    trigger='loop'
                    delay='2000'
                    colors='primary:#e62788'
                    style='width:250px;height:250px'>
                </lord-icon>";
    } else {
        // Display error Lordicon
        echo "<script src='https://cdn.lordicon.com/lordicon-1.2.0.js'></script>
                <lord-icon
                    src='https://cdn.lordicon.com/ygvjgdmk.json'
                    trigger='hover'
                    colors='primary:#e62788'
                    style='width:250px;height:250px'>
                </lord-icon>";
    }

    echo "</div><button onclick='cerrarModal()'>Cerrar</button></div>";

    unset($_SESSION['mensaje']);
}
?>



<script src="https://cdn.lordicon.com/lordicon-1.2.0.js"></script>

<script>
    function cerrarModal() {
        var modal = document.querySelector('.mi-modal');
        modal.style.display = 'none';
    }
</script>


<!DOCTYPE html>
<html lang="es">

<br>
<br>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/client/css/styles.css">
    <link rel="stylesheet" href="assets/client/css/styles-forms.css">
    <script src="assets/client/js/app.js"></script>


    <title>Perfum | Inicia sesión o regístrate</title>
</head>

<body>
    <?php include('layouts/navbar.php')?>
    <!--<main class="main-forms-container">--> <!--Lo que deaba el footer-->
        <section>
            <div class="container" id="container">
                <div class="form-container sign-up-container">
                <form action="forms.php" method="post">
                        <h1>Regístrate</h1>
                        <p>Regístrate para poder realizar compras en Perfum | y desbloquear funciones</p>

                        <label>
                            <input type="text" name="nombre" placeholder="Nombre" pattern="[A-Za-z\s]+" title="Solo se permiten letras y espacios" oninput="eliminarNumerosNombre()" required />
                        </label>

                        <script>
                        function eliminarNumerosNombre() {
                            var nombreInput = document.querySelector('input[name="nombre"]');
                            nombreInput.value = nombreInput.value.replace(/[0-9]/g, '');
                        }
                        </script>

                        
                        <label>
                            <input type="email" name="email" placeholder="Correo electrónico" required />
                        </label>
                        <label>
                            <input type="email" name="confirmar_email" placeholder="Confirmar correo electrónico" required />
                        </label>
                        <label>
                            <input type="password" name="password" placeholder="Contraseña" required />
                        </label>
                        <label>
                            <input type="password" name="confirmar_password" placeholder="Confirmar contraseña" required />
                        </label>
                        <button style="margin-top: 9px" name="register">Registrarse</button> <!-- Añadido el atributo name -->
                    </form>
                </div>

                <div class="form-container sign-in-container">
                    <form action="forms.php" method="post"> <!-- Cambiado el atributo action y method -->
                        <h1>¡Bienvenido a nuestra perfumería!</h1>
                        <span> Nos complace tenerte aquí para descubrir una experiencia de fragancias única.</span>

                        <label>
                            <input type="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Introduce una dirección de correo electrónico válida" required />
                        </label>


                        <label>
                            <input type="password" name="password" placeholder="Password" required />
                        </label>
                        
                        <a href="#">¿Olvidó su contraseña, restablézcala?</a>
                        <button name="login">Iniciar sesión</button> <!-- Añadido el atributo name -->
                    </form>
                </div>

                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            <h1>¿Ya tienes una cuenta? Inicia sesión</h1>
                            <p>En nuestra tienda, encontrarás una amplia gama de perfumes, colonias y productos
                                relacionados con el cuidado personal que te harán sentir y oler increíble. </p>
                            <button class="ghost mt-5" id="signIn">Iniciar sesión</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            <h1>Aún no tienes una cuenta, regístrate ahora</h1>
                            <p>¡Gracias por elegirnos para formar parte de tu mundo perfumado! Estamos emocionados de
                                que te unas a nuestra comunidad.</p>
                            <button class="ghost" id="signUp">Regístrate</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


</body>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', function () {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', function () {
            container.classList.remove('right-panel-active');
        });
    });
</script>

</html>
