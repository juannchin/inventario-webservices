<?php
    include 'includes/header.php';
?>
    <br><br>
    <div id="main">
        <form method="POST" action="http://192.168.0.109/WS/insertOperadores.php">
            <div class="par">
                &nbsp;&nbsp;<label>Usuario</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" id="usuario" name="usuario" class="textbox" placeholder="Ingrese su nombre"><br><br>
                &nbsp;&nbsp;<label>Contrase&ntilde;a</label>&nbsp;&nbsp;
                <input type="password" name="pass" id="pass" class="textbox" placeholder="Ingrese contraseña"><br><br>
                &nbsp;&nbsp;<label>Estado</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="estado" id="estado" class="textbox" placeholder="Ingrese estado"><br>
                <br>
                &nbsp;&nbsp;<button action="operadores.php" class="btn-agregar">Agregar</button>
            </div>
        </form>
        <br>
        <br>
        <br>
        <br>
        <?php
        $apiurl = 'http://192.168.0.109/WS/listarOperadores.php';
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
                            <td>Usuario</td>
                            <td>
                                Contrase&ntilde;a
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
                                    echo $marca['usuario'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $marca['pass'];
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $marca['estado'];
                                    ?>
                                </td>

                                <td>
                                    <button id="Editar" type="submit" class="btn-agregar"><a
                                            href="FormUpdateOperador.php">Editar</a></button>
                                    <button type="submit" class="btn-agregar"><a
                                            href="FormDeleteOperador.php">eliminar</a></button>
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