<?php
include 'conexion.php';
	
$pdo = new Conexion();
if($_SERVER['REQUEST_METHOD'] == 'GET')
	{		
		$sql = "CALL actualizar_operador (:p_id,:p_usuario,:p_pass,:p_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':p_id', $_GET['id']);
		$stmt->bindValue(':p_usuario', $_GET['usuario']);
		$stmt->bindValue(':p_pass', $_GET['pass']);
		$stmt->bindValue(':p_estado', $_GET['estado']);
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