<?php
    include 'includes/header.php';
?>
    <br><br>
    <div id="main">
    <form method="POST" action="insertMarca.php">
        <div class="par">&nbsp;&nbsp;
            <label for="nombre">Marca</label>
            <input type="text" id="nombre" name="nombre" class="textbox" placeholder="Ingrese nombre de la marca"
                required><br><br>
            <label for="estado">Estado</label>
            <input type="text" id="estado" name="estado" class="textbox" placeholder="Ingrese estado" required><br><br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="btn-agregar">Agregar</button>

        </div>

    </form>

    <br>
    <br>
    <?php
    $apiurl = 'http://192.168.0.109/WS/listarMarcas.php';
    $jsonData = file_get_contents($apiurl);

    $marcas = json_decode($jsonData, true);
    ?>
    <div>
        <center>
            <table class="table">
                <thead>
                    <tr>
                        <td>
                            Id
                        </td>
                        <td>Nombre de la marca</td>
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
                                <button id="Editar" type="submit" class="btn-agregar"><a  class="btn-agregar"
                                        href="FormUpdateMarca.php?id=<?php echo $marca['id']; ?>">Editar</a></button>
                                <button type="submit" class="btn-agregar"><a  class="btn-agregar"
                                        href="deleteMarca.php?id=<?php echo $marca['id']; ?>">Desactivar</a></button>
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