<?php

// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (isset($_SESSION['usuario'])) {
    // El usuario está logueado
    echo '<li class="nav-item"><span class="nav-link">Bienvenido: '. $_SESSION['usuario'].'</span> </li>';
    echo '<li class="nav-item"><a class="nav-link" href="includes/logout.php">Cerrar sesion</a></li>';
    // Puedes mostrar contenido exclusivo para usuarios logueados o redirigir a una página protegida
} else {
    // El usuario no está logueado
    echo "<script>window.location.replace('index.html');</script>";
    echo "Erro de autenticacion";
    // Puedes mostrar un formulario de inicio de sesión o redirigir a la página de inicio de sesión
}

?>