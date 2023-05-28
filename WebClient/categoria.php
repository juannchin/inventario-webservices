<?php
    include 'includes/header.php';
?>
    <br><br>
    <div id="main">
        <form action="http://192.168.0.109/WS/insertCategoria.php" method="POST">
            <div class="par">&nbsp;&nbsp;
                <label for="nombre">Categoria</label>
                <input type="text" id="nombre" name="nombre" class="textbox" placeholder="Ingrese nombre de la marca"
                    required><br><br>&nbsp;&nbsp;
                <label for="estado">Estado</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" id="estado" name="estado" class="textbox" placeholder="Ingrese estado"
                    required><br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn-agregar">Agregar</button>
            </div>
        </form>
        <br>
        <br>
        <?php
        $apiurl = 'http://192.168.0.109/WS/listarCategorias.php';
        $jsonData = file_get_contents($apiurl);

        $marcas = json_decode($jsonData, true);
        ?>
        <div>
            <center>
                <table class="table">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>
                                Nombre de la categoria
                            </td>
                            <td>
                                Estado
                            </td>
                            <td>
                                Acciones
                            </td>
                        </tr>
                        <?php
                        foreach ($marcas as $marca):
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    echo $marca['id'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $marca['nombre'];
                                    ?>
                                </td>
                                
                                <td>
                                    <?php
                                    echo $marca['estado'];
                                    ?>
                                </td>
                                <td>
                                    <button id="Editar" type="submit" class="btn-agregar">
                                        <a href="FormUpdateCategoria.php">Editar</a>
                                    </button>
                                    <button type="submit" class="btn-agregar">
                                        <a href="FormDeleteCategoria.php">eliminar</a>
                                    </button>
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