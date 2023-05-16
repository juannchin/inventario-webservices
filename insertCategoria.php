<?php
	include'conexion.php';
	
	$pdo = new Conexion();

   
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$sql = "CALL insertar_categoria(:nombre)";
		$stmt = $pdo ->prepare($sql);
		$stmt -> bindValue(':nombre', $_POST['nombre']);
		$stmt->execute();
    	$idPost = $pdo->lastInsertId(); 
		if($idPost)
		{
			header("http://localhost:8080/PROGRAV/CrudProyecto/insertCategoria.php");
			echo json_encode('Datos ingresados');
			exit;
		}

	}


?>