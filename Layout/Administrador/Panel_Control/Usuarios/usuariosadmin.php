<?php
session_start();
if (!isset($_SESSION["Id_Usuario"]) && ($_SESSION["Tipo"] != "Administrador")) {

	header("Location: ../../Sin_Logear/Inicio/Inicio.html");

}

ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Usuarios</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="usuariosadmin.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div id="cabecera" class="row">
        <div id="logo"><img src="Logo.png" alt="Logo" class="navbar-brand"></div>
        <a class="navbar-brand Navegacion" href="usuariosadmin.php"><div><img src="Usuarios.png" class="iconito"><b>Usuarios</b></div></a>
        <a class="navbar-brand Navegacion" href="../Tareas/tareasadmin.php"><div><img src="Tareas.png" class="iconito"><b>Tareas</b></div></a>
        <a class="navbar-brand Navegacion" href="../Pass/passadmin.php"><div><img src="Pass.png" class="iconito"><b>Contraseñas</b></div></a>
        <a class="navbar-brand Navegacion" href="../Accesos/accesosadmin.php"><div><img src="Accesos.png" class="iconito"><b>Accesos Directos</b></div></a>
        <hr id="lineahorizontal">
    </div>
    <div id="buqueda" class="row">
        <form action="" method="post">
            <div id="buscar" class="row">
                <input name="buscar" type="text" class="input" placeholder="Buscar Usuarios..." required>
                <input name="buscar2" type="image" src="iconolupa.png" id="iconolupa">
            </div>
        </form>
    </div>
	<div id="cuerpo">
		<?php
		  //CREANDO CONEXIÓN
		  $connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
		  $connection->set_charset("uft8");

		  //COMPROBANDO LA CONEXIÓN
		  if ($connection->connect_errno) {
			  printf("Connection failed: %s\n", $connection->connect_error);
			  exit();
		  }
		  if (isset($_POST["buscar"])) {

			$nombrebusqueda = $_POST["buscar"];

			$query = "SELECT * FROM usuario WHERE Nombre='$nombrebusqueda'";

			if ($result = $connection->query($query)) {
				
				while($obj = $result->fetch_object()) {
								
					$Genero = $obj->Genero;
					$Nombre = $obj->Nombre;
					$Correo = $obj->Correo;
					$Pass = $obj->Pass;
					$Tipo = $obj->Tipo;
					$Telefono = $obj->Telefono;
					$Edad = $obj->Edad;
					$Id = $obj->Id_Usuario;

					echo "<ul id='lista'>";

					echo "<li><span class='azul'><b>Nombre:</b></span> $Nombre</li>";
					echo "<li><span class='azul'><b>Género:</b></span> $Genero</li>";
					echo "<li><span class='azul'><b>Correo:</b></span> $Correo</li>";
					echo "<li><span class='azul'><b>Tipo:</b></span> $Tipo</li>";
					echo "<li><span class='azul'><b>Teléfono:</b></span> $Telefono</li>";
					echo "<li><span class='azul'><b>Edad:</b></span> $Edad años</li>";
					echo "<li><span class='azul'><b>Id_Usuario:</b></span> $Id</li>";

					echo "<a class='button float-left' style='margin-right:5px;' href='borrarusuario.php?iduser=$Id' id='borrarboton'>Borrar</a>";
					echo "<a class='button' style='' href='#' id='editarboton' data-id='$Id'>Editar</a>";

					echo "</ul>";
			
				}

			}else{
				echo "No ha sido posible encontrar el usuario indicado.";
			};
		  };
		?>
	</div>
	<div id="Modales">

							<div class="modal fade" id="Modal_Editar_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Editar Usuario</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="usuariosadmin.php" method="post" id="formedit">
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nombre Usuario:</label>
													<input type="text" class="form-control inputmodal" id="recipient-name" name="nombreusuario" required>
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Género:</label>
													<input type="text" class="form-control inputmodal" name="generousuario" required>
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Correo Electrónico:</label>
													<input type="text" class="form-control inputmodal" name="correousuario">
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Tipo de Usuario:</label>
													<input type="text" class="form-control inputmodal" name="tipousuario">
												</div>

		  										<div class="form-group">
													<label for="recipient-name" class="col-form-label">Contraseña:</label>
													<input type="password" class="form-control inputmodal" name="passusuario">
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Teléfono:</label>
													<input type="text" class="form-control inputmodal" name="telefonousuario">
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Edad:</label>
													<input type="text" class="form-control inputmodal" name="edadusuario">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar">Cancelar</button>
												<button type="submit" class="btn btn-primary" id="editarusuario">Editar</button>
											</div>
										</form>
									</div>
								</div>
							</div>

	</div>
	<?php

	if (isset($_POST["nombreusuario"])) {

		$query = "UPDATE usuario SET Genero='$_POST[generousuario]',Nombre='$_POST[nombreusuario]',
		Correo='$_POST[correousuario]',Pass=md5('$_POST[passusuario]'),Tipo='$_POST[tipousuario]',
		Telefono='$_POST[telefonousuario]',Edad='$_POST[edadusuario]' WHERE Id_Usuario='$_POST[coduser]'";

		if ($result = $connection->query($query)) {
			
			header("Location:usuariosadmin.php");

		}
	}

	ob_end_flush();
?>
</body>
<script>
	// EDITAR USUARIO

	$("#editarboton").click(function(){

		event.preventDefault();
		var id=$(this).attr("data-id");
		console.log(id);
		$("#formedit #coduser").remove();
		$("#formedit").append("<input type='hidden' id='coduser' value='"+id+"' name='coduser' />");
		$('#Modal_Editar_User').modal("show");

	});

</script>
</html>