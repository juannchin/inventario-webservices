<?php
	include'conexion.php';
	
	$pdo = new Conexion();


    if($_SERVER['REQUEST_METHOD'] == 'POST')
	{		
		$sql = "CALL sp_eliminar_operador(:operador_id ,:nuevo_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':operador_id', $_POST['operador_id']);
		$stmt->bindValue(':nuevo_estado', $_POST['nuevo_estado']);
		$stmt->execute();

	// Crear un arreglo con el mensaje de respuesta
    $response = array(
        "message" => "Registro eliminado"
    );
	
    // Convertir el arreglo a JSON
    $json_response = json_encode($response);

    // Establecer las cabeceras de la respuesta como JSON
    header('Content-Type: application/json');

    // Imprimir el JSON como respuesta
    echo $json_response;
    header("location:operadores.php");
    exit;
		
	}