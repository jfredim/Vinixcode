<?php

?>

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">  
        <div class="navbar-header">   
            <button class="navbar-toggle collapse" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false">
                <span class="sr-only">Este Boton Despliega la barra de navegacion </span>     
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Tienda Vinixcode </a>
        </div>

        <div id="navbar" class="navbar-collapse collapse" >
            <?php if ($_SESSION['name']){?>
                      <ul class="nav navbar-nav">     
                            <a href="#">
                                <span class="glyphicon glyphicon-user" aria-hidden="true"> </span>      
                                <?php echo ' ' . $_SESSION['name']; ?>
                            </a> 
                       </ul>
                       <ul class="nav navbar-nav navbar-right">     
                            <a href="logout.php">
                            <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>Cerrar Sesion         
                            </a>
                       </ul>     
            <?php }?>
            <ul class="nav navbar-nav navbar-right">     
                <a href="index.php">Home</a> <br />
            </ul>       
            
        </div>
    </div>  
</nav>