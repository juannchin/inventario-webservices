<?php
include 'conexion.php';
	
$pdo = new Conexion();
if($_SERVER['REQUEST_METHOD'] == 'GET')
	{		
		$sql = "CALL actualizar_producto (:producto_id,:nuevo_nombre,:nueva_categoria_id,:nueva_marca_id,:nueva_cantidad,:nuevo_valor,:nueva_caducidad,:nuevo_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':producto_id', $_GET['id']);
		$stmt->bindValue(':nuevo_nombre', $_GET['nombre']);
		$stmt->bindValue(':nueva_categoria_id', $_GET['id_categoria']);
		$stmt->bindValue(':nueva_marca_id', $_GET['id_marca']);
		$stmt->bindValue(':nueva_cantidad', $_GET['cantidad']);
		$stmt->bindValue(':nuevo_valor', $_GET['valor']);
		$stmt->bindValue(':nueva_caducidad', $_GET['caducidad']);
		$stmt->bindValue(':nuevo_estado', $_GET['estado']);
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