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
$status="";
$nombre_estados="";
$id_buscar="";
if ($_POST['status']){
    $status=$_POST['status'];
	$nombre_estados="";
	$result2 = mysqli_query($mysqli, "SELECT * FROM status WHERE id=$status");
	while($res2 = mysqli_fetch_array($result2)){
		$nombre_estados = $res2['name'];
	}	

}

if ($_POST['id']){
    $id_buscar.=$_POST['id'];
}


if ($nombre_estados || $id_buscar ){
    if ($nombre_estados){
        $proceso="busca_estado";
    }
    if ($id_buscar){
        $proceso="busca_id";
    }
    include_once 'api.php';
}

$sql="SELECT * FROM pets WHERE login_id=".$_SESSION['id']." ";
if ( $status){
    $sql.=" and status in(".$status.") ";
}
if ($id_buscar){
    $sql.=" and id = (".$id_buscar.") ";
}



$result = mysqli_query($mysqli, $sql." ORDER BY id ASC");


$titulo = 'Ver';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="row parte-gestor-entradas">
    <div class="col-md-12">
        <h2>Gestion de Mascotas</h2>
        <br>
        <br>
        <a href="adicionar.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Adicionar Nuevas Mascotas</a>
        <br>
        <br>
        <a href="busca_estados.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Buscar por Estado</a>
        <br>
        <br>
        <a href="busca_id.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Buscar por id</a>
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
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Categoria</th>
                        <th>Etiqueta</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
	<?php
	while($entrada_actual = mysqli_fetch_array($result)) {		
        ?>
                        <tr>
                            <td><?php echo $entrada_actual['id']; ?></td>
                            <td><?php echo $entrada_actual['name']; ?></td>
                                <?php $category=$entrada_actual['category'];
                                     $result_cat = mysqli_query($mysqli, "SELECT * FROM category WHERE id=$category");
                                    while($res_cat = mysqli_fetch_array($result_cat)){
	                                    $name_cat = $res_cat['name'];
                                }?>
                            <td><?php echo $name_cat; ?></td>
                            <?php $tags=$entrada_actual['tags'];
                                     $result_tag = mysqli_query($mysqli, "SELECT * FROM tag WHERE id=$tags");
                                    while($res_tag = mysqli_fetch_array($result_tag)){
	                                    $name_tag = $res_tag['name'];
                                }?>

                            <td><?php echo $name_tag; ?></td>

                            <?php $status=$entrada_actual['status'];
                                     $result_sta = mysqli_query($mysqli, "SELECT * FROM status WHERE id=$status");
                                    while($res_sta = mysqli_fetch_array($result_sta)){
	                                    $name_sta = $res_sta['name'];
                                }?>

                            <td><?php echo $name_sta; ?></td>

                            <td>
                                <form method="post" action="edit.php">
                                    <input type="hidden" name="id" value="<?php echo $entrada_actual['id']; ?>">
                                    <input type="hidden" name="name" value="<?php echo $entrada_actual['name']; ?>">
                                    <input type="hidden" name="category" value="<?php echo $entrada_actual['ctaegory']; ?>">
                                    <input type="hidden" name="tags" value="<?php echo $entrada_actual['tags']; ?>">
                                    <input type="hidden" name="status" value="<?php echo $entrada_actual['status']; ?>">
                                    <button type="submit"  class="btn btn-lg btn-primary" name="editar_entrada">Editar</button>                                    
                                </form>

                            </td>
                            <td>
                                <form method="post" action="delete.php">
									<input type="hidden" name="id_borrar" value="<?php echo $entrada_actual['id']; ?>" >
                                    <button type="submit"  class="btn btn-lg btn-primary" name="borrar_entrada" onClick="return confirm('Esta Seguro que desea Borrar esta Mascota?')">Borrar</button>                                    
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


