<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

//including the database connection file
include_once("connection.php");


$titulo = 'Adicionar';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';


if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
	$category = $_POST['category'];

	$photourl = $_POST['photourl'];
	$tags = $_POST['tags'];

	$status = $_POST['status'];


	
	include_once 'busca_nombres.php';

	$loginId = $_SESSION['id'];
		
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
		
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Regresar</a>";
	} else { 
		// if all the fields are filled (not empty) 

		$id_recibido=0;
		$id=0;
		$proceso="crear";
		include_once 'api.php';
		
		if ($id_recibido==0){
			echo "<font color='red'>Fallo Api Create</font><br/>";
			echo "<br/><a href='javascript:self.history.back();'>Regresar</a>";
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


			//insert data to database	

			$result = mysqli_query($mysqli, "INSERT INTO
		    pets(id,name,category, photourl,tags,status,login_id) VALUES('$id_recibido', '$name','$category','$ruta','$tags','$status', '$loginId')");


		//display success message
			
		?>

		
		<div class="row parte-gestor-entradas">
			<h4 style="color: green;">Mascota Agregada Correctamente!!!!</h4>
		<div class="col-md-12">
			<h2>Gestion de Mascotas</h2>
			<br>
			<br>
			<a href="view.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Ver Mascotas</a>
			<br>
			<br>
		</div>
	</div>
	
	<?php }
	}
}
include_once 'plantillas/documento-cierre.inc.php';
?>