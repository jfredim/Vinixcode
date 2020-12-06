<?php session_start(); 
$titulo = 'Login';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<?php
include("connection.php");

if(isset($_POST['submit'])) {
	$user = mysqli_real_escape_string($mysqli, $_POST['username']);
	$pass = mysqli_real_escape_string($mysqli, $_POST['password']);

	if($user == "" || $pass == "") {
		echo "Either username or password field is empty.";
		echo "<br/>";
		echo "<a href='login.php'>Go back</a>";
	} else {
		$result = mysqli_query($mysqli, "SELECT * FROM login WHERE username='$user' AND password=md5('$pass')")
					or die("Could not execute the select query.");
		
		$row = mysqli_fetch_assoc($result);
		
		if(is_array($row) && !empty($row)) {
			$validuser = $row['username'];
			$_SESSION['valid'] = $validuser;
			$_SESSION['name'] = $row['name'];
			$_SESSION['id'] = $row['id'];
		} else {

            echo "<h4 style='color: green;'>Usuario y/o Contraseña Incorrectos!!!!</h4>";
            echo "<br/>";
            echo "<a href='login.php' class='btn btn-lg btn-primary' role='button' id='boton_nueva_entrada'>Regresar</a>";
                
		}

		if(isset($_SESSION['valid'])) {
			header('Location: index.php');			
		}
	}
} else {
?>

    <div class="panel panel-default">
        <div class="panel panel-heading text-center">
            <h4>Iniciar Sesion</h4>
        </div>
        <div class="panel-body">
            <form role="form1" method="post" action="">
                <h2>Introduce Tus Datos </h2>
                <br>
                <div class="col-xs-6">
                    <label for="username">Usuario </label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" <?php if (isset($_POST[ 'username']) && !empty($_POST[ 'username']) ){ echo 'value="'.$_POST[ 'username']. '"'; } ?> required autofocus>
                </div>
                <div class="col-xs-6">
                    <label for="password">Contraseña </label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                    <br>
                </div>
                <div class="col-xs-3">

                    <button type="submit" name="submit" class="btn btn-lg btn-primary btn-block"> 
                            Ingresar
                        </button>
                </div>
            </form>
            <br>
            <br>
        </div>
    </div>




    <?php
}
?>
        <?php
include_once 'plantillas/documento-cierre.inc.php';
?>