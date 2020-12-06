<?php
$titulo = 'Busca por Estado';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

include("connection.php");


?>

    <div class="row parte-gestor-entradas">
        <div class="col-md-12">
            <h2>Gestion de Mascotas</h2>
            <br>
            <br>
            <a href="view.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Ver Mascotas</a>
            <br>
            <br>
        </div>
    </div>

    <div class="row parte-gestor-entradas">
        <div class="panel-body">


            <form name="form1" method="post" action="view.php">
                <div class="col-xs-2">
                    <label>Estado</label>
                    <br>

                    <select name="status">
                        <option value="0">Seleccione:</option>
                            <?php
                                $result2 = mysqli_query($mysqli, "SELECT * FROM status ");
                                while($res2 = mysqli_fetch_array($result2)) {?>
                                 <option value="<?php echo $res2['id']; ?>"><?php echo $res2['name']; ?></option>;
                             <?php }
                            ?>
                    </select>

                </div>
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-primary btn-lg bg-dark" name="Submit" value="Search">Buscar </button>
                </div>
            </form>
        </div>
        <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>