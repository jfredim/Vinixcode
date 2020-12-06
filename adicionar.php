<?php
$titulo = 'Adicionar';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

include("connection.php");


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


            <form name="form1" method="post" action="add.php" enctype="multipart/form-data">
                <div class="col-xs-2">
                    <label>Nombre</label>
                    <input type="text" name="name" require>
                </div>
                <div class="col-xs-2">
                    <label>Categoria</label>
                    <br>
                    <select name="category">
                        <option value="0">Seleccione:</option>
                            <?php
                                $result = mysqli_query($mysqli, "SELECT * FROM category ");
                                while($res = mysqli_fetch_array($result)) {?>
                                 <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>;
                             <?php }
                            ?>
                    </select>
                </div>
                <div class="col-xs-2">
                    <label>Url Foto</label>
         <!--           <input type="text" name="photourl"> -->

                    <input type="file" name="photourl" multiple />                    
                </div>
                <div class="col-xs-2">
                    <label>Etiqueta</label>
                    <br>
                    <select name="tags">
                        <option value="0">Seleccione:</option>
                            <?php
                                $result1 = mysqli_query($mysqli, "SELECT * FROM tag ");
                                while($res1 = mysqli_fetch_array($result1)) {?>
                                 <option value="<?php echo $res1['id']; ?>"><?php echo $res1['name']; ?></option>;
                             <?php }
                            ?>
                    </select>
                </div>
                <div class="col-xs-2">
                    <label>Estado</label>
                    <br>
                    <select name="status">
                        <option value="0">Seleccione:</option>
                            <?php
                                $result2 = mysqli_query($mysqli, "SELECT * FROM status ");
                                while($res2 = mysqli_fetch_array($result2)) {?>
                                 <option value="<?php echo $res2['id']; ?>"><?php echo $res2['name']; ?></option>;
                             <?php }
                            ?>
                    </select>
                </div>
                <div class="col-xs-2">
                    <button type="submit" class="btn btn-primary btn-lg bg-dark" name="Submit" value="Add">Adicionar </button>
                </div>
            </form>
        </div>

</body>
</html>        
        <div <?php include_once 'plantillas/documento-cierre.inc.php'; ?>

