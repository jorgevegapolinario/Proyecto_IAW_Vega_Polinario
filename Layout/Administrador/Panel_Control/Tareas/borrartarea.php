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

	$query = "DELETE FROM tarea WHERE Id_Usuario=$_GET[iduser] AND Cod_Tarea =$_GET[codtarea]";

    if ($result = $connection->query($query)) {

        header("Location: tareasadmin.php");

    }

?>