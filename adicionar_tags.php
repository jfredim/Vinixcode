<?php
$titulo = 'Adicionar Etiquetas';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

    <div class="row parte-gestor-entradas">
        <div class="col-md-12">
            <h2>Gestion de Etiquetas</h2>
            <br>
            <br>
            <a href="view_tags.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Ver Etiquetas</a>
            <br>
            <br>
        </div>
    </div>

    <div class="row parte-gestor-entradas">
        <div class="panel-body">


            <form name="form1" method="post" action="add_tags.php">
                <div class="col-md-6">
                    <label>Nombre</label>
                    <input type="text" name="name">
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-primary btn-lg bg-dark" name="Submit" value="Add">Adicionar </button>
                </div>
            </form>
        </div>
        <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>