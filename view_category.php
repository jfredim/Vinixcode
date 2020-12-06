<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

<?php
//including the database connection file
include_once("connection.php");

//fetching data in descending order (lastest entry first)
$result = mysqli_query($mysqli, "SELECT * FROM category  ORDER BY id DESC");

$titulo = 'Ver Categorias';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="row parte-gestor-entradas">
    <div class="col-md-12">
        <h2>Gestion de Categorias</h2>
        <br>
        <br>
        <a href="adicionar_category.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Adicionar Nuevas Categorias</a>
        <br>
        <br>
    </div>
</div>
<div class="row parte-gestor-entradas">
    <div class="col-md-12">
<?php if (count($result) > 0) { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	while($entrada_actual = mysqli_fetch_array($result)) {		
        ?>
                        <tr>
                            <td><?php echo $entrada_actual['name']; ?></td>
                            <td>
                                <form method="post" action="edit_category.php">
                                    <input type="hidden" name="id" value="<?php echo $entrada_actual['id']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $entrada_actual['name']; ?>">
                                    <button type="submit" class="btn btn-lg btn-primary" name="editar_entrada">Editar</button>                                    
                                </form>

                            </td>
                            <td>
                                <form method="post" action="delete_category.php">
									<input type="hidden" name="id_borrar" value="<?php echo $entrada_actual['id']; ?>" >
                                    <button type="submit" class="btn btn-lg btn-primary" name="borrar_entrada" onClick="return confirm('Esta Seguro que desea Borrar esta Categoria?')">Borrar</button>                                    
                                </form>
                            </td>
                        </tr>

        <?php
    }
    ?>
                </tbody>
            </table>

<?php } else {
    ?>
            <h3 class="text-center">Todavia No has escrito ninguna entrada</h3>
            <br>
            <br>

<?php } ?>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>


