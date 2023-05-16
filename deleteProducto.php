<?php
	include'conexion.php';
	
	$pdo = new Conexion();


    if($_SERVER['REQUEST_METHOD'] == 'PUT')
	{		
		$sql = "CALL sp_eliminar_producto(:producto_id,:nuevo_estado)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':producto_id', $_GET['producto_id']);
		$stmt->bindValue(':nuevo_estado', $_GET['nuevo_estado']);
		$stmt->execute();
		header("http://localhost:8080/WS/deleteProducto.php");
		exit;
	}
 

?>