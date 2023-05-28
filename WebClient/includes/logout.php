<?php
session_start();

// Finalmente, destruir la sesión.
session_destroy();

// Redirigir a otra página después de cerrar la sesión
header('Location: ../index.html');
exit();

?>