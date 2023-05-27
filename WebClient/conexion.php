<?php 
class conexion extends PDO{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "bdarreglada2";

    public function __construct()
    {

        try{
            parent::__construct('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION));

        }catch(PDOException $e){

            echo 'Error al conectar: '. $e ->getMessage();
            exit;

        }

    }
}
?>