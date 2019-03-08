<?php
session_start();
?>
<?php

    //CREANDO CONEXIÓN
    $connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
    $connection->set_charset("utf-8");

    //COMPROBANDO LA CONEXIÓN
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

	$query = "DELETE FROM passwords WHERE Id_Usuario=$_GET[iduser] AND Id_Passwords=$_GET[idpassword]";

    if ($result = $connection->query($query)) {

        header("Location: Contraseñas.php");

    }

?>