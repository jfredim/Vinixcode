<?php session_start(); ?>

<?php
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

//including the database connection file
include_once("connection.php");

$titulo = 'Adicionar Etiquetas';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';


if(isset($_POST['Submit'])) {	
	$name = $_POST['name'];
		
	// checking empty fields
	if(empty($name)) {
			echo "<font color='red'>Nombre de la Etiqueta Esta vacio.</font><br/>";
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 

		$result = mysqli_query($mysqli, "SELECT * FROM tag WHERE name='$name' ");

		if ($result->num_rows > 0) { 
			echo "<h4 style='color: red;'>Etiqueta Ya Existe en el sistema, por favor verifique</h4>";
			echo "<br/>";
            echo "<br/><a href='javascript:self.history.back();'>Regresar</a>";
        } else{
            // if all the fields are filled (not empty) 
            //insert data to database	
            $result = mysqli_query($mysqli, "INSERT INTO
            tag(name) VALUES('$name')");
        
        //display success message
        


		?>

		
		<div class="row parte-gestor-entradas">
			<h4 style="color: green;">Etiqueta Agregada Correctamente!!!!</h4>
		<div class="col-md-12">
			<h2>Gestion de Etiquetas</h2>
			<br>
			<br>
			<a href="view_tags.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Ver Etiquetas</a>
			<br>
			<br>
		</div>
	</div>
	
	<?php }}
}
include_once 'plantillas/documento-cierre.inc.php';
?>