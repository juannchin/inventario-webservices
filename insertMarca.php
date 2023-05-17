<?php
	include'conexion.php';
	
	$pdo = new Conexion();

   
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$sql = "CALL insertar_marca(:nombre, :estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':nombre', $_POST['nombre']);
		$stmt->bindValue(':estado', $_POST['estado']);
		$stmt->execute();
		$idPost = $pdo->lastInsertId(); 
		if ($idPost) {
			$response = array('message' => 'Datos almacenados');
			$jsonResponse = json_encode($response);
			header('Content-Type: application/json');
			echo $jsonResponse;
			exit;
		}
	}

	


?>