<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/cb7d52baf6.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway');

        $defaultSeconds: 3s;

        h1 {
            color: #834077;
            font-size: 24px;
            font-weight: 400;
            margin: 0;
        }


        . {
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
        }

        .bg-custom {
            background-color: #834077;
        }

        .textbox {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            font-size: 14px;
        }

        .btn-agregar,
        .btn-cancelar {
            background-color: #834077;
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            margin-right: 8px;
        }

        .btn-agregar:hover,
        .btn-cancelar:hover {
            background-color: #a15ca3;
        }

        .btn-agregar:focus,
        .btn-cancelar:focus {
            outline: none;
            box-shadow: none;
        }

        .btn-agregar:active,
        .btn-cancelar:active {
            background-color: #d295c3;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th,
        .table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <title>Barra de navegación</title>
</head>

<body>
    <?php
    include 'conexion.php';
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-custom">
        <a class="navbar-brand" href="inicio.php">LOGISTIC</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="categoria.php">Categoría</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="marca.php">Marca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php">Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="operadores.php">Operador</a>
                </li>
            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <div>
        <?php
        include 'conexion.php';

        // Verificar si el formulario ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Datos a enviar al WS (pueden ser obtenidos del formulario)
            $data = array(
                'nombre' => $_POST['nombre'],
                'estado' => $_POST['estado'],
                // Agrega aquí los demás parámetros necesarios
            );

            // Convertir los datos a formato JSON
            $json_data = json_encode($data);

            // URL del endpoint del WS
            $url = 'insertMarca.php';

            // Configurar la solicitud HTTP
            $options = array(
                'http' => array(
                    'header' => "Content-Type: application/json\r\n",
                    'method' => 'POST',
                    'content' => $json_data,
                ),
            );

            // Realizar la solicitud HTTP al WS
            $context = stream_context_create($options);
            $response = file_get_contents($url, false, $context);

            // Verificar si se recibió una respuesta válida del WS
            if ($response !== false) {
                // Decodificar la respuesta JSON
                $result = json_decode($response, true);

                // Verificar si existe la clave "mensaje" en la respuesta
                if (isset($result['mensaje'])) {
                    echo "Respuesta del WS: " . $result['mensaje'];
                } else {
                    echo "La respuesta del WS no contiene un mensaje válido.";
                }
            } else {
                // Manejar error de la solicitud HTTP
                echo "Error al realizar la solicitud HTTP al WS.";
            }
        }

        ?>
    </div>

    <br><br>
    <form method="POST" action="">
        <div class="par">&nbsp;&nbsp;
            <label>Marca</label>
            <input type="text" name="nombre" class="textbox" placeholder="Ingrese nombre de la marca" required><br><br>
            <label>Estado</label>
            <input type="text" name="estado" class="textbox" placeholder="Ingrese estado" required><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn-agregar">Agregar</button>

        </div>

    </form>
    
    <br>
    <br>
    <div>
        <center>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nombre de la marca</th>
                        <th>
                            <center>Acciones</center>
                        </th>
                    </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </center>
    </div>
    </div>
</body>

</html>