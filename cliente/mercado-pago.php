<?php
$access_token = 'APP_USR-4155906435262215-112319-4c3b26fc90f1532e6a62e8fc1b90b8f4-1388197124'; // Reemplaza con tu token de acceso de MercadoPago

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['product_id']) && isset($_POST['total'])) {
        $product_id = $_POST['product_id'];
        $total = floatval($_POST['total']);

        // Prepara los datos para crear la preferencia
        $data = array(
            "items" => array(
                array(
                    'title' => 'Perfumeria Perfum',
                    "quantity" => 1,
                    "currency_id" => "MXN",
                    "unit_price" => $total
                )
            )
        );

        // Realiza la solicitud a la API de MercadoPago
        $ch = curl_init("https://api.mercadopago.com/checkout/preferences");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $access_token));
        $response = curl_exec($ch);

        if ($response === false) {
            echo "Error en la solicitud cURL: " . curl_error($ch);
        } else {
            $response_data = json_decode($response, true);
            if (isset($response_data["init_point"])) {
                // Redirige al usuario a la página de pago de MercadoPago
                header("Location: " . $response_data["init_point"]);
                exit;
            } else {
                echo "Error al crear el enlace de pago de MercadoPago.";
            }
        }

        curl_close($ch);
    } else {
        echo "Datos de compra no válidos.";
    }
} else {
    echo "Acceso no válido.";
}
?>
