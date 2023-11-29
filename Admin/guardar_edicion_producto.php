<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar si el formulario ha sido enviado
    if (isset($_POST['id_producto']) && isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['envase']) && isset($_POST['contenido']) && isset($_POST['categoria'])) {

        // Conexión a la base de datos (reemplaza los datos de conexión por los tuyos)
        $servername = "localhost";
        $username = "perfumco_perfum";
        $password = "perfumeriaperfum";
        $dbname = "perfumco_perfum";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Comprobar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Sanitizar las entradas del usuario (debes validar y sanitizar las entradas correctamente)
        $id_producto = $_POST['id_producto'];
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $envase = $_POST['envase'];
        $contenido = $_POST['contenido'];
        $categoria = $_POST['categoria'];

        // Actualizar el producto en la base de datos
        $sql = "UPDATE productos SET nombre = '$nombre', precio = '$precio', envase = '$envase', contenido = '$contenido', categoria = '$categoria' WHERE id = $id_producto";

        if ($conn->query($sql) === TRUE) {
            // Éxito al actualizar los datos del producto en la base de datos.

            // Procesar la imagen, si se ha proporcionado una nueva imagen.
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
                $targetDir = '../perfumes/';
                $targetFile = $targetDir . basename($_FILES["imagen"]["name"]);
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                // Permitir solo ciertos tipos de imágenes (puedes ajustar esta lista según tus necesidades).
                $allowedTypes = array("jpg", "jpeg", "png", "gif");

                if (in_array($imageFileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $targetFile)) {
                        // Actualizar la ruta de la imagen en la base de datos.
                        $sql = "UPDATE productos SET imagen = '$targetFile' WHERE id = $id_producto";
                        $conn->query($sql);
                        echo "Producto actualizado exitosamente con la nueva imagen.";
                    } else {
                        echo "Error al subir la nueva imagen.";
                    }
                } else {
                    echo "Formato de imagen no válido. Solo se permiten archivos JPG, JPEG, PNG y GIF.";
                }
            } else {
                echo "Producto actualizado exitosamente.";
            }
        } else {
            echo "Error al actualizar el producto: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Datos del formulario inválidos.";
    }
} else {
    echo "Solicitud inválida.";
}
?>
