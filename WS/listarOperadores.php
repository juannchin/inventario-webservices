<?php
    include 'conexion.php';

    $pdo = new Conexion();

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        $sql = $pdo->prepare("CALL listar_operadores");
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        header("HTTP/1.1 200 hay datos");
        echo json_encode($sql->fetchAll());
        exit;


    }
?>