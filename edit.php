<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}
?>

    <?php
// including the database connection file
include_once("connection.php");

if(isset($_POST['update']) || isset($_POST['update_parcial']) )
{	
	$id = $_POST['id'];
	
	$name = $_POST['name'];
	$category = $_POST['category'];
	$status = $_POST['status'];
	$photourl = $_POST['photourl'];
	$tags = $_POST['tags'];


	include_once 'busca_nombres.php';

	
	// checking empty fields
	// checking empty fields
	if(empty($name) || empty($category) || empty($tags) || empty($status)) {
				
		if(empty($name)) {
			echo "<font color='red'>Nombre esta Vacio.</font><br/>";
		}		
		if(empty($category)) {
			echo "<font color='red'>Debe Seleccionar la Categoria </font><br/>";
		}
		if(empty($tags)) {
			echo "<font color='red'>Debe Seleccionar la Etiqueta </font><br/>";
		}
		if(empty($status)) {
			echo "<font color='red'>Debe Seleccionar el Estado</font><br/>";
		}
	} else {	

		$id_recibido=0;
		if ($_POST['update']=="update") {
			$proceso="editar";

		}else{
			$proceso="editar_parcial";
		} 
		include_once 'api.php';
		
		if ($id_recibido==0){
			echo "<font color='red'>Fallo Api Update</font><br/>";
		}else{

			// Ruta donde se guardarán las imágenes
			$directorio = 'archivos/';

			// Recibo los datos de la imagen
			$nombre = $_FILES['photourl']['name'];
			$tipo = $_FILES['photourl']['type'];
			$tamano = $_FILES['photourl']['size'];
			$nombre_tmp = $_FILES["photourl"]["tmp_name"];

			$ruta=$directorio.$nombre;

			// Muevo la imagen desde su ubicación
			// temporal al directorio definitivo
			move_uploaded_file($nombre_tmp,$ruta);	

			//updating the table
			$result = mysqli_query($mysqli, "UPDATE pets SET name='$name', category='$category', photourl='$photourl', tags='$tags' , status='$status' WHERE id=$id");
			
			//redirectig to the display page. In our case, it is view.php
			header("Location: view.php");
		}	
	}
}
?>
        <?php
//getting id from url
$id = $_POST['id'];

//selecting data associated with this particular id
$result = mysqli_query($mysqli, "SELECT * FROM pets WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['name'];
	$category = $res['category'];
	$photourl = $res['photourl'];
	$tags = $res['tags'];
	$status = $res['status'];
}

$titulo = 'Editar Mascota';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>formulario</title>
</head>
<body>


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


                    <form name="form1" method="post" action="edit.php">
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="name" value="<?php echo $name;?>">
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>Categoria</label>
                                <br>
                                <select name="category">
									<option value="0">Seleccione:</option>
										<?php
											$result = mysqli_query($mysqli, "SELECT * FROM category ");
											while($res1 = mysqli_fetch_array($result)) {?>
											 <option value="<?php echo $res1['id']; ?>" 
											 <?php if($category==$res1['id']) echo 'selected'; ?>>
											 <?php echo $res1['name']; ?></option>;
										 <?php }
										?>
								</select>

                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">

                                <label>Photourl</label>
								<input type="file" name="photourl" value="<?php echo $photourl;?>"  multiple  />                    


                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label>Etiqueta</label>
                                <br>
                                <select name="tags">
									<option value="0">Seleccione:</option>
										<?php
											$result2 = mysqli_query($mysqli, "SELECT * FROM tag ");
											while($res2 = mysqli_fetch_array($result2)) {?>
											 <option value="<?php echo $res2['id'];?>" 
											 <?php if($tags==$res2['id']) echo 'selected'; ?>>
											 <?php echo $res2['name']; ?></option>;
										 <?php }
										?>
								</select>
                            </div>
                        </div>

                        <div class="col-xs-2">
                            <label>Estado</label>
                            <br>
							<select name="status">
									<option value="0">Seleccione:</option>
										<?php
											$result3= mysqli_query($mysqli, "SELECT * FROM status ");
											while($res3 = mysqli_fetch_array($result3)) {?>
											 <option value="<?php echo $res3['id'];?>" 
											 <?php if($status==$res3['id']) echo 'selected'; ?>>
											 <?php echo $res3['name']; ?></option>;
										 <?php }
										?>
								</select>
                        </div>

                        <input type="hidden" name="id" value=<?php echo $_POST[ 'id'];?>>
                        <div class="col-xs-2">
							<button type="submit" class="btn btn-lg btn-primary" name="update" value="update">Actualizar Todo </button>
							<button type="submit" class="btn btn-lg btn-primary" name="update_parcial" value="update_parcial">Actualiza Nombre-Estado</button>
						</div>						
					</form>
                </div>

</body>
</html>    				
                <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>