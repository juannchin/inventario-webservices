<?php
$url = "http://192.168.0.109/WS/listarOperadores.php";


// Datos de autenticación
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];



// Realizar la solicitud al webservice
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

//echo "respuesta: ".$response;

// Verificar si hubo algún error en la solicitud CURL
if (curl_errno($ch)) {
    echo 'Error al conectar con el webservice: ' . curl_error($ch);
    // Manejar el error de acuerdo a tus necesidades
    exit;
}

// Decodificar la respuesta JSON
$data = json_decode($response);

print_r($data);

// Validar el usuario y contraseña
$encontrado = false;
foreach ($data as $usuarioBD) {
    if ($usuarioBD->usuario === $usuario && $usuarioBD->pass === $contrasena) {
        $encontrado = true;
        break;
    }
}

// Mostrar el resultado de la validación
if ($encontrado) {
    echo '¡Usuario autenticado correctamente!';

    // Iniciar la sesión
    session_start();

    // Crear una variable de sesión
    $_SESSION['usuario'] = $usuario;

    echo "<script>alert('Usuario Autenticado ".$usuario."');</script>";
    echo "<script>window.location.replace('prueba.php');</script>";
    // Realizar acciones adicionales o redirigir al usuario a otra página

} else {
    echo "<script>alert('Usuario NO Autenticado');</script>";
    echo "<script>window.location.replace('index.html');</script>";
    // Manejar la autenticación fallida de acuerdo a tus necesidades
}


?>