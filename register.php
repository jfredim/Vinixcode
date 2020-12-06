<?php
$titulo = 'Registrar Usuario';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

    <?php
include("connection.php");

if(isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$user = $_POST['username'];
	$pass = $_POST['password'];

	if($user == "" || $pass == "" || $name == "" || $email == "") {
		echo "Todos los campos deben Ingresarse. Existe algun campo Vacio!!!.";
		echo "<br/>";
		echo "<a href='register.php'>Registrar</a>";
	} else {

		$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' ");

		if ($result->num_rows > 0) { 
			echo "<h4 style='color: red;'>Usuario Ya Existe en el sistema, por favor verifique</h4>";
			echo "<br/>";
			echo "<a href='register.php' class='btn btn-lg btn-primary' role='button' id='boton_nueva_entrada'>Registrar</a>";
	
		}else{
			mysqli_query($mysqli, "INSERT INTO login(name, email, username, password) VALUES('$name', '$email', '$user', md5('$pass'))")
			or die("Could not execute the insert query.");
			
		echo "<h4 style='color: green;'>Usuario Agregado Correctamente!!!!</h4>";

		echo "<br/>";
		echo "<a href='login.php' class='btn btn-lg btn-primary' role='button' id='boton_nueva_entrada'>Login</a>";

		}



	}
} else {
?>

        <div class="row parte-gestor-entradas">

            <div class="col-md-12">
                <h2>Gestion de Usuarios</h2>
            </div>
        </div>



        <div class="row parte-gestor-entradas">
            <div class="panel-body">


                <form name="form1" method="post" action="register.php">
                    <div class="col-xs-2">
                        <div class="form-group">
                            <label>Nombre Completo</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="mail" name="email" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="form-group">
                            <label>Usuario</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-2">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-5">
                        <div class="form-group">
                            <button type="submit"  class="btn btn-primary btn-lg" name="submit" value="submit">Crear Usuario</button>
                        </div>
                    </div>
                </form>
            </div>

            <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>

                <?php
}
?>