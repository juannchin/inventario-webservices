<?php 
class conexion extends PDO{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "db_inventario";

    public function __construct()
    {

        try{
            parent::__construct('mysql:host=' . $this->host . ';dbname=' . $this->database . ';charset=utf8', $this->user, $this->password, array(PDO::ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION));

        }catch(PDOException $m){

            echo 'Error: '. $m ->getMessage();
            exit;

        }

    }



}

?>