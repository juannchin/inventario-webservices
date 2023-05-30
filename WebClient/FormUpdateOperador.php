
<?php
    include 'includes/header.php';

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        $apiurl = 'http://localhost:8080/inventario/listarOperadores.php';
        $jsonData = file_get_contents($apiurl);

        $marcas = json_decode($jsonData, true);

        foreach ($marcas as $marc) {
   
            if ($marc['id'] === $id) {
                $usuario = $marc['usuario'];
                $pass = $marc['pass'];
                $estado = $marc['estado'];
                break;
            }
        }  

    ?>

    <br><br>
    <div id="main">
    <form method="POST" action="FormUpdateOperador.php">
        <div class="par">&nbsp;&nbsp;
        
        <label for="nombre">ID</label>
            <input type="text" id="id" name="id" class="textbox" value="<?php echo $_GET['id'] ?>" 
                required><br><br>
    
        <label for="nombre">Usuario</label>
            <input type="text" id="usuario" name="usuario" class="textbox"  value="<?php echo $usuario ?>"
                required><br><br>
    
    <label for="nombre">Contrase&ntilde;a</label>
        <input type="password" id="pass" name="pass" class="textbox"  value="<?php echo $pass ?>"
            required><br><br>


            <label for="estado">Estado</label>
            <input type="text" id="estado" name="estado" class="textbox"   value="<?php echo $estado ?>" 
                required><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn-agregar">Actualizar</button>

        </div>
    </form> 
<?php
    }  

        if (isset($_POST['id'])) {

            // Datos de la marca y el nuevo estado
            $nuevoId = $_POST['id'];
            $nuevaUsuario = $_POST['usuario'];
            $nuevaPass = $_POST['pass'];
            $nuevoEstado = $_POST['estado'];

            // URL del endpoint del servicio API/REST
            $url = "http://localhost:8080/inventario/listarCategorias.php";

            // Datos a enviar en la solicitud PUT
            $data = array(
                'id' => $nuevoId,
                'usuario' => $nuevaUsuario,
                'pass' => $nuevaPass,
                'estado' => $nuevoEstado
            );

            // Configurar opciones de la solicitud HTTP
            $options = array(
                'http' => array(
                    'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );

            // Crear contexto de la solicitud HTTP
            $context = stream_context_create($options);

            // Realizar la solicitud PUT al servicio API/REST
            $result = file_get_contents($url, false, $context);

            // Verificar si la solicitud fue exitosa
            if ($result !== false) {
                echo "<script>alert('Marca actualizada exitosamente.');</script>";
            } else {
                echo "<script>alert('Error al actualizar el operador.');</script>";
            }
            echo "<script>window.location.replace('operadores.php');</script>";
    }
?>