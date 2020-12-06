<?php session_start(); 

$titulo="Pagina de Inicio";
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="panel panel-default">
    <div class="panel panel-heading text-center">
        <h4>Bienvenido a Mi pagina Web</h4>
    </div>
    <div class="panel-body">




				<?php
					if(isset($_SESSION['valid'])) {			
						include("connection.php");					
						$result = mysqli_query($mysqli, "SELECT * FROM login");
					?>
								
						<br/>
						<a href="view.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada">Ver y Adicionar Mascotas</a>
						<br/><br/>
						<a href="view_category.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada_catagory">Ver y Adicionar Categorias</a>
						<br/><br/>
						<a href="view_tags.php" class="btn btn-lg btn-primary" role="button" id="boton_nueva_entrada_tags">Ver y Adicionar Etiquetas</a>
						<br/><br/>
					<?php	
					} else {

						echo "<h4 style='color: green;'>Usted debe de estar Logueado para ingresar a la pagina</h4>";
						echo "<br/>";
						echo "<a href='login.php' class='btn btn-lg btn-primary' role='button' id='boton_nueva_entrada'>Login</a> 
						<a href='register.php' class='btn btn-lg btn-primary' role='button' id='boton_nueva_entrada'>Registrar</a>";				
					}
				?>									
                
		</div>
	<div id="footer">
		Creada Por John Fredy Gaviria</a>
	</div>


<?php
include_once 'plantillas/documento-cierre.inc.php';
?>

