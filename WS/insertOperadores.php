<?php
include 'conexion.php';

$pdo = new Conexion();
//Insertar registro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = " CALL InsertarOperador(:p_usuario, :p_pass, :p_estado)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':p_usuario', $_POST['usuario']);
    $stmt->bindValue(':p_pass', $_POST['pass']);
    $stmt->bindValue(':p_estado', $_POST['estado']);
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