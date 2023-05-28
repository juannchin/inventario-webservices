<!DOCTYPE html>
<html>
<head>
    <title>Consumir Web Service desde un formulario</title>
</head>
<body>
    <?php
    include 'sesion.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $estado = $_POST['estado'];

        // Crear el arreglo de datos a enviar al WS
        $data = array(
            'nombre' => $nombre,
            'estado' => $estado
        );

        // Convertir los datos a formato JSON
        $json_data = json_encode($data);

        // URL del endpoint del WS
        $url = 'http://localhost:8080/Proyecto%20ProgV3/Proyecto%20ProgV/insertMarca.php';

        // Configurar la solicitud HTTP
        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => $json_data,
            ),
        );

        // Realizar la solicitud HTTP al WS
        $context  = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        // Verificar si se recibió una respuesta
        if ($response !== false) {
            // Decodificar la respuesta JSON
            $result = json_decode($response, true);

            // Mostrar la respuesta del WS
            if (isset($result['mensaje'])) {
                echo "Respuesta del WS: " . $result['mensaje'];
            } else {
                echo "La respuesta del WS no contiene un mensaje válido.";
            }
        } else {
            // Manejar error de la solicitud HTTP
            echo "Error al realizar la solicitud HTTP al WS.";
        }
    }
    ?>

    <!-- Formulario HTML -->
    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="estado" placeholder="Email" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>
</body>
</html>
