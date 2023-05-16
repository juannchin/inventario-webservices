<?php
	include'conexion.php';
	
	$pdo = new Conexion();

   
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "CALL insertar_producto(:nombre, :id_categoria, :id_marca, :cantidad, :valor, :caducidad)";
		$stmt = $pdo ->prepare($sql);
		$stmt -> bindValue(':nombre', $_POST['nombre']);
		$stmt -> bindValue(':id_categoria', $_POST['id_categoria']);
		$stmt -> bindValue(':id_marca', $_POST['id_marca']);
		$stmt -> bindValue(':cantidad', $_POST['cantidad']);
		$stmt -> bindValue(':valor', $_POST['valor']);
		$stmt -> bindValue(':caducidad', $_POST['caducidad']);
		$stmt->execute();
    	$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("http://localhost:8080/WS/insertProducto.php");
			echo json_encode($idPost);
			exit;
		}

	}


?>