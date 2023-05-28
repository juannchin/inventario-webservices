
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/cb7d52baf6.js" crossorigin="anonymous"></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway');

        /*$defaultSeconds: 3s;*/

        #main  {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width:900px;
        }

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

        .table td tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <title>Barra de navegación</title>
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
                    <a class="nav-link" href="marca.php">Marca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categoria.php">Categoría</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="producto.php">Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="operadores.php">Operador</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"> | </a>
                </li>

                <?php
                    include 'sesion.php';
                ?>
                </li>

            </ul>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

