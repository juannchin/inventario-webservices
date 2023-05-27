<?php
include 'conexion.php';
	
$pdo = new Conexion();
if($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		$sql = "CALL actualizar_categoria (:categoria_id,:nuevo_nombre,:nuevo_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':categoria_id', $_POST['id']);
		$stmt->bindValue(':nuevo_nombre', $_POST['nombre']);
		$stmt->bindValue(':nuevo_estado', $_POST['estado']);
		$stmt->execute();
		// Crear un arreglo con el mensaje de respuesta
		$response = array(
			"message" => "Registro actualizado"
		);
	
		// Convertir el arreglo a JSON
		$json_response = json_encode($response);
	
		// Establecer las cabeceras de la respuesta como JSON
		header('Content-Type: application/json');
	
		// Imprimir el JSON como respuesta
		echo $json_response;
		exit;
}
	
    ?>