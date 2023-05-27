<?php
	include'conexion.php';
	
	$pdo = new Conexion();

   
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "CALL insertar_categoria(:nombre,:estado)";
		$stmt = $pdo ->prepare($sql);
		$stmt -> bindValue(':nombre', $_POST['nombre']);
		$stmt -> bindValue(':estado', $_POST['estado']);
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


?>