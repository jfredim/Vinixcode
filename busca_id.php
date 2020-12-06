<?php
$titulo = 'Busca por Id';

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
                <div class="col-xs-4">
                    <label>Id</label>
                    <br>
                    <input type="number" id="id" name="id"  style="width : 250px">
                </div>
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-primary btn-lg bg-dark" name="Submit" value="Search">Buscar </button>
                </div>
            </form>
        </div>
        <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>