<?php

    include 'includes/header.php';

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $apiurl = 'http://192.168.0.109/WS/listarCategorias.php';
        $jsonData = file_get_contents($apiurl);

        $marcas = json_decode($jsonData, true);

        foreach ($marcas as $marc) {

            if ($marc['id'] === $id) {
                $marca = $marc['nombre'];
                $estado = $marc['estado'];
                break;
            }
        }



        // URL del endpoint del servicio API/REST
        $url = "http://192.168.0.109/WS/deleteCategoria.php";

        // Datos a enviar en la solicitud PUT
        $data = array(
            'categoria_id' => $id,
            'nuevo_estado' => 0
        );

        // Configurar opciones de la solicitud HTTP
        $options = array(
            'http' => array(
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );

        // Crear contexto de la solicitud HTTP
        $context = stream_context_create($options);

        // Realizar la solicitud PUT al servicio API/REST
        $result = file_get_contents($url, false, $context);

        // Verificar si la solicitud fue exitosa
        if ($result !== false) {
            echo "<script>alert('Categoria desactivada exitosamente.');</script>";
        } else {
            echo "<script>alert('Error al desactivar la categoria.');</script>";
        }
        echo "<script>window.location.replace('categoria.php');</script>";
    }
?>