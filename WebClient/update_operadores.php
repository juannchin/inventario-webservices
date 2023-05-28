<?php
include 'conexion.php';
	
$pdo = new Conexion();
if($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		$sql = "CALL actualizar_operador (:p_id,:p_usuario,:p_pass,:p_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':p_id', $_POST['id']);
		$stmt->bindValue(':p_usuario', $_POST['usuario']);
		$stmt->bindValue(':p_pass', $_POST['pass']);
		$stmt->bindValue(':p_estado', $_POST['estado']);
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