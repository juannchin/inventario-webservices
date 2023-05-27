<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</head>

<body>
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
    <br><br>
    <div>
        <form method="POST">
            <div class="par">
                &nbsp;&nbsp;<label>Usuario</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" class="textbox" placeholder="Ingrese su nombre"><br><br>
                &nbsp;&nbsp;<label>Contrase&ntilde;a</label>&nbsp;&nbsp;
                <input type="password" class="textbox" placeholder="Ingrese contraseña"><br>
                <br>
                &nbsp;&nbsp;<button class="btn-agregar">Agregar</button>
                <button class="btn-cancelar">Cancelar</button>

            </div>
        </form>
        <br>
        <br>
        <div>
            <table class="table" border="1">
                <thead>
                    <tr>
                        <th>Usuario</th>
                        <th>Contraseña</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include('conexion.php');
                    $sql = $conexion->query("select * from operadores");
                    while ($datos = $sql->fetch_object()) { ?>
                        <tr>
                            <td>
                                <?= $datos->usuario ?>
                            </td>
                            <td>
                                <?= $datos->pass ?>
                            </td>
                            <td>
                                <center>
                                    <a href="" class="btnEditar">Editar</a>
                                    <a href="" class="btnEliminar">Eliminar</a>
                                </center>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</body>

</html>