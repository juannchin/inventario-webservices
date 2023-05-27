<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$base = "bdarreglada2";

$conexion = mysqli_connect($servidor, $usuario, $clave, $base);
// Obtener las credenciales ingresadas en el formulario
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];

// Consulta para verificar las credenciales en la base de datos
$sql = "SELECT * FROM operadores WHERE usuario = '$usuario' AND pass = '$pass'";
$resultado = $conexion->query($sql);

// Verificar si se encontró un registro coincidente
if ($resultado->num_rows > 0) {
    header('Location: inicio.php');
} else {
    // Credenciales inválidas, redireccionar al formulario de inicio de sesión
    header('Location: index.html');
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>