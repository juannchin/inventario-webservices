<?php

// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario'])) {
    // El usuario está logueado
    echo 'Bienvenido: '. $_SESSION['usuario']." ";
    echo "<a href='logout.php'>Cerrar sesion</a>";
    //<input type='button' onclick='location.href='logout.php' value='Cerrar Sesion' />";
    // Puedes mostrar contenido exclusivo para usuarios logueados o redirigir a una página protegida
} else {
    // El usuario no está logueado
    echo "<script>window.location.replace('index.html');</script>";
    echo "Erro de autenticacion";
    // Puedes mostrar un formulario de inicio de sesión o redirigir a la página de inicio de sesión
}

?>