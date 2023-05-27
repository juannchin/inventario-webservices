<?php
include 'conexion.php';

$pdo = new conexion();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$sql = "CALL insertar_marca(:nombre, :estado)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindValue(':nombre', $_POST['nombre']);
	$stmt->bindValue(':estado', $_POST['estado']);
	$stmt->execute();
	$idPost = $pdo->lastInsertId();
	// Crear un arreglo con el mensaje de respuesta
	$response = array(
		"message" => "Registro almacenado"
	);

	// Convertir el arreglo a JSON
	$json_response = json_encode($response);

	// Establecer las cabeceras de la respuesta como JSON
	header('Content-Type: application/json');

	// Imprimir el JSON como respuesta
	echo $json_response;
	exit;
}

$nombre = $_POST['nombre'];

// Verificar si se proporcionó un nombre
if (!empty($nombre)) {
	// Procesar los datos y generar una respuesta exitosa
	$mensaje = "¡Hola, " . $nombre . "! Bienvenido al Web Service.";
	$response = array('mensaje' => $mensaje);
} else {
	// Generar una respuesta de error si no se proporcionó un nombre
	$mensaje = "No se proporcionó un nombre válido.";
	$response = array('error' => $mensaje);
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

$estado = $_POST['estado'];

// Verificar si se proporcionó un nombre
if (!empty($estado)) {
	// Procesar los datos y generar una respuesta exitosa
	$mensaje = "¡Hola, " . $nombre . "! Bienvenido al Web Service.";
	$response = array('mensaje' => $mensaje);
} else {
	// Generar una respuesta de error si no se proporcionó un nombre
	$mensaje = "No se proporcionó un nombre válido.";
	$response = array('error' => $mensaje);
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>