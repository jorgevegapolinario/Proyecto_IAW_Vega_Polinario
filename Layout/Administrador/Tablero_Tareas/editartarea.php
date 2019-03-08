<?php
session_start();
?>
<?php

    //CREANDO CONEXIÓN
    $connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
    $connection->set_charset("uft8");

    //COMPROBANDO LA CONEXIÓN
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

	
	$query = "UPDATE tarea SET Titulo='$_POST[editartitulotarea]',Descripcion='$_POST[editardescripciontarea]',
	Color='$_POST[editarcolortarea]',Fecha='$_POST[editarfechatarea]' WHERE Id_Usuario='$_SESSION[Id_Usuario]'
	AND Cod_Tarea='$_POST[codtarea]'";

    if ($result = $connection->query($query)) {

        header("Location: Tablero_Tareas.php");

    }

?>