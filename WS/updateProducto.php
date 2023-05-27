<?php
include 'conexion.php';
	
$pdo = new Conexion();
if($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		$sql = "CALL actualizar_producto (:producto_id,:nuevo_nombre,:nueva_categoria_id,:nueva_marca_id,:nueva_cantidad,:nuevo_valor,:nueva_caducidad,:nuevo_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':producto_id', $_POST['id']);
		$stmt->bindValue(':nuevo_nombre', $_POST['nombre']);
		$stmt->bindValue(':nueva_categoria_id', $_POST['id_categoria']);
		$stmt->bindValue(':nueva_marca_id', $_POST['id_marca']);
		$stmt->bindValue(':nueva_cantidad', $_POST['cantidad']);
		$stmt->bindValue(':nuevo_valor', $_POST['valor']);
		$stmt->bindValue(':nueva_caducidad', $_POST['caducidad']);
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