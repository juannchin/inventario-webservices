<?php
include 'includes/header.php';
?>
<br><br>
<div id="main">
    <div>
        <form action="insertProducto.php" method="POST">
            &nbsp;&nbsp;<label>Nombre</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="nombre" name="nombre" type="text" class="textbox"
                placeholder="Ingrese su nombre">&nbsp;&nbsp;&nbsp;&nbsp;
            <label>ID Categoria</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="id_categoria" name="id_categoria" type="text" class="textbox"
                placeholder="Ingrese Categoria"><br><br>
            &nbsp;&nbsp;<label>ID Marca</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="id_marca" name="id_marca" type="text" class="textbox"
                placeholder="Ingrese marca">&nbsp;&nbsp;&nbsp;&nbsp;
            <label>Cantidad</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="cantidad" name="cantidad" type="text" class="textbox" placeholder="Ingrese Cantidad"><br><br>
            &nbsp;&nbsp;<label>Valor</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="valor" name="valor" type="text" class="textbox"
                placeholder="Ingrese valor monetario">&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;<label>Caducidad</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="caducidad" name="caducidad" type="date" class="textbox"
                placeholder="Ingrese fecha caducidad">&nbsp;&nbsp;&nbsp;
            <label>Estado</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="estado" name="estado" type="text" class="textbox" placeholder="Ingrese estado"><br>
            <br>

            <br>&nbsp;&nbsp;<button class="btn-agregar">Agregar</button>

    </div>
    </form>
    <br>
    <br>
    <?php
    $apiurl = 'http://192.168.0.109/WS/listarProductos.php';
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
                            <td>
                                <button id="Editar" type="submit" class="btn-agregar"><a class="btn-agregar"
                                        href="FormUpdateProducto.php?id=<?php echo $producto['id']; ?>">Editar</a></button>
                                <button type="submit" class="btn-agregar"><a class="btn-agregar"
                                        href="deleteProducto.php?id=<?php echo $producto['id']; ?>">Desactivar</a></button>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
            </table>
        </center>
    </div>
</div>
</body>

</html>