<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

    <?php
// including the database connection file
include_once("connection.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name = $_POST['name'];
	
	// checking empty fields
	if(empty($name)) {
			echo "<font color='red'>Nombre de la Categotia esta Vacio.</font><br/>";
	} else {	
		//updating the table
		$result = mysqli_query($mysqli, "UPDATE category SET name='$name' WHERE id=$id");
		
		//redirectig to the display page. In our case, it is view.php
		header("Location: view_category.php");
	}
}
?>
        <?php
//getting id from url
$id = $_POST['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM category WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
}

$titulo = 'Editar Categorias';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

            <div class="row parte-gestor-entradas">
                <div class="col-md-12">
                    <h2>Gestion de Categorias</h2>
                    <br>
                    <br>
                    <a href="view_tags.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Ver Categorias</a>
                    <br>
                    <br>
                </div>
            </div>

            <div class="row parte-gestor-entradas">
                <div class="panel-body">


                    <form name="form1" method="post" action="edit_category.php">

                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="name" value="<?php echo $name;?>">
                        </div>
                        <div class="col-xs-6">
                            <button type="submit" class="btn btn-primary btn-lg bg-dark" name="update" value="update">Actualizar </button>
                        </div>
                        <input type="hidden" name="id" value=<?php echo $_POST[ 'id'];?>>
                </div>
                </form>
            </div>
            <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>