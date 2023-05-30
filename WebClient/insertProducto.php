<?php


// URL del endpoint del servicio API/REST
$url = "http://192.168.0.109/WS/insertProducto.php";

// Datos a enviar en la solicitud POST
$data = array(
    'nombre' => $_POST['nombre'],
    'id_categoria' => $_POST['id_categoria'],
	'id_marca' => $_POST['id_marca'],
	'cantidad' => $_POST['cantidad'],
	'valor' => $_POST['valor'],
	'caducidad' => $_POST['caducidad'],
	'estado' => $_POST['estado']
);

// Configurar opciones de la solicitud HTTP
$options = array(
    'http' => array(
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);

// Crear contexto de la solicitud HTTP
$context = stream_context_create($options);

// Realizar la solicitud POST al servicio API/REST
$result = file_get_contents($url, false, $context);


// Verificar si la solicitud fue exitosa
if ($result !== false) {
	echo "<script>alert('Marca agregada exitosamente.');</script>";
} else {
	echo "<script>alert('Error al actualizar la marca.');</script>";
}

echo "<script>window.location.replace('producto.php');</script>";

?>