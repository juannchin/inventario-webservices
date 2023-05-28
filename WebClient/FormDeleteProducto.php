<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <form action="http://localhost:8080/Proyecto%20ProgV/Proyecto%20ProgV/deleteProducto.php" method="POST">
            &nbsp;&nbsp;<label>Id Producto</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="producto_id" name="producto_id" type="text" class="textbox"
                placeholder="Ingrese id">&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Estado</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="nuevo_estado" name="nuevo_estado" type="text" class="textbox"
                placeholder="Ingrese nuevo estado"><br>
            <br>

            <br>&nbsp;&nbsp;<button class="btn-agregar">Eliminar</button>

    </div>
    </form>
    <br>
    <br>
    <?php
    $apiurl = 'http://localhost:8080/Proyecto%20ProgV/Proyecto%20ProgV/listarProductos.php';
    $jsonData = file_get_contents($apiurl);

    $productos = json_decode($jsonData, true);
    ?>
    <div>
        <center>
            <table class="table">
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Producto</td>
                        <td>
                            Categoria
                        </td>
                        <td>
                            Marca
                        </td>
                        <td>
                            Cantidad
                        </td>
                        <td>
                            Valor
                        </td>
                        <td>
                            caducidad
                        </td>

                    </tr>
                    <?php
                    foreach ($productos as $producto):
                        ?>
                        <tr>
                            <td>
                                <?php
                                echo $producto['id'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $producto['nombre'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $producto['categoria'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $producto['marca'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $producto['cantidad'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $producto['valor'];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $producto['caducidad'];
                                ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
            </table>
        </center>
    </div>
</body>

</html>