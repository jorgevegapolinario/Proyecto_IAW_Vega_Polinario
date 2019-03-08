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

	
	$query = "UPDATE usuario SET Genero='$_GET[editargenero]',Nombre='$_GET[editarnombre]',
	Correo='$_GET[editarcorreo]',".md5(Pass='$_GET[editarpass]').",Tipo='$_GET[editartipo]',
	Telefono='$_GET[editartelefono]',Edad='$_GET[editaredad]' WHERE Id_Usuario='$_GET[idusuario]'";

    if ($result = $connection->query($query)) {

        header("Location: ../Administrador/Panel_Control/Usuarios/usuariosadmin.php");

    }

?>