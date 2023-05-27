<?php
	include'conexion.php';
	
	$pdo = new Conexion();

   
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "CALL actualizar_producto(?, ?, ?, ?, ?, ?, ?, ?);";
		$stmt = $pdo ->prepare($sql);
		$stmt->bindParam(1,$_POST['producto_id'], PDO::PARAM_STR);
		$stmt->bindParam(2,$_POST['nombre'], PDO::PARAM_STR); 
		$stmt->bindParam(3,$_POST['id_categoria'], PDO::PARAM_STR);
		$stmt->bindParam(4,$_POST['id_marca'], PDO::PARAM_STR);
		$stmt->bindParam(5,$_POST['cantidad'], PDO::PARAM_STR);
		$stmt->bindParam(6,$_POST['valor'], PDO::PARAM_STR);
		$stmt->bindParam(7,$_POST['caducidad'], PDO::PARAM_STR);
		$stmt->bindParam(8,$_POST['estado'], PDO::PARAM_STR);
		$stmt->execute();
		
    	$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("http://localhost/Webservices/updateProducto.php");
			echo json_encode($idPost);
			exit;
		}

	}


?>