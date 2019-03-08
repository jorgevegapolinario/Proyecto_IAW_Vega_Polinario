<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tareas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="tareasadmin.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div id="cabecera" class="row">
        <div id="logo"><img src="Logo.png" alt="Logo" class="navbar-brand"></div>
        <a class="navbar-brand Navegacion" href="../Usuarios/usuariosadmin.php"><div><img src="Usuarios.png" class="iconito"><b>Usuarios</b></div></a>
        <a class="navbar-brand Navegacion" href="tareasadmin.php"><div><img src="Tareas.png" class="iconito"><b>Tareas</b></div></a>
        <a class="navbar-brand Navegacion" href="../Pass/passadmin.php"><div><img src="Contraseñas.png" class="iconito"><b>Contraseñas</b></div></a>
        <a class="navbar-brand Navegacion" href="../Accesos/accesosadmin.php"><div><img src="Accesos.png" class="iconito"><b>Accesos Directos</b></div></a>
        <hr id="lineahorizontal">
    </div>
    <div id="buqueda" class="row">
        <form method="POST">
            <div id="buscar" class="row">
                <input name="buscar" type="text" class="input" placeholder="Buscar Tareas..." required>
                <input name="submitbuscar" type="image" src="iconolupa.png" id="iconolupa">
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
			
						$obj = $result->fetch_object();
									
							$Nombre = $obj->Nombre;
							$Id = $obj->Id_Usuario;
							$_SESSION["idusernecesario"] = $Id;
						
					}

					$query2 = "SELECT * FROM tarea WHERE Id_Usuario='$Id'";

					if ($result = $connection->query($query2)) {

						if ($result->num_rows !== 0) {
							echo "<table class='table'>";
									echo "<thead class='thead-dark'>";
									echo "<tr>";
										echo "<th scope='col'>Código</th>";
										echo "<th scope='col'>Título</th>";
										echo "<th scope='col'>Color</th>";
										echo "<th scope='col'>Fecha</th>";
										echo "<th scope='col'>Dueño</th>";
										echo "<th scope='col'>Descripción</th>";
										echo "<th scope='col'>#</th>";
									echo "</tr>";
									echo "</thead>";

						while($obj = $result->fetch_object()) {
								
							$Titulo = $obj->Titulo;
							$Descripcion = $obj->Descripcion;
							$Color = $obj->Color;
							$Cod_Tarea = $obj->Cod_Tarea;
							$Fecha = $obj->Fecha;

								echo "<tbody>";
								echo "<tr>";
									echo "<th scope='row'>$Cod_Tarea</th>";
									echo "<td>$Titulo</td>";
									echo "<td>$Color</td>";
									echo "<td>$Fecha</td>";
									echo "<td>$nombrebusqueda</td>";
									echo "<td>".substr($Descripcion, 0, 5)."...</td>";
									echo "<td><image src='Editar.png' class='edit edittarea' data-id='$Cod_Tarea'><a href='borrartarea.php?iduser=$Id&codtarea=$Cod_Tarea'><image src='Borrar.png' class='edit' /></a></td>";
								echo "</tr>";
								echo "</tbody>";
						}

						echo "</table>";

						}elseif ($obj->Nombre !== $nombrebusqueda){ 
							echo "<span style='color:#7c0606; margin-left:35%;'>El usuario no existe.</span>";
						}else{
							echo "<span style='color:#7c0606; margin-left:35%;'>El usuario no tiene tareas en este momento.</span>";
						}
					};

			  };

			?>
			<?php

				if (isset($_POST["titulotarea"])) {



					$query = "UPDATE tarea SET Titulo='$_POST[titulotarea]',Color='$_POST[colortarea]',
					Fecha='$_POST[fechatarea]',Descripcion='$_POST[descripciontarea]' WHERE Id_Usuario='$_SESSION[idusernecesario]' AND Cod_Tarea='$_POST[idtarea]'";
					
					if ($result = $connection->query($query)) {
						
						$_SESSION["idusernecesario"] = "";
						header("Location:tareasadmin.php");

					}
				}

			?>
	</div>
	<div id="Modales">

							<div class="modal fade" id="Modal_Editar_Tarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Editar Tarea</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="tareasadmin.php" method="post" id="formedit">
											<div class="modal-body">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Título de la Tarea:</label>
													<input type="text" class="form-control inputmodal" id="recipient-name" name="titulotarea" required>
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Color:</label>
													<input type="text" class="form-control inputmodal" name="colortarea" required>
												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Fecha:</label>
													<input type="date" class="form-control inputmodal" name="fechatarea">
												</div>

		  										<div class="form-group">
													<label for="recipient-name" class="col-form-label">Descripción:</label>
													<input type="text" class="form-control inputmodal" name="descripciontarea">
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar">Cancelar</button>
												<button type="submit" class="btn btn-primary" id="guardar">Editar</button>
											</div>
										</form>
									</div>
								</div>
							</div>

	</div>
</body>
<script>
	// EDITAR USUARIO

	$(".edittarea").click(function(){

		event.preventDefault();
		var idtarea=$(this).attr("data-id");
		console.log(idtarea);
		$("#formedit #codtarea").remove();
		$("#formedit").append("<input type='hidden' id='codtarea' value='"+idtarea+"' name='idtarea' />");
		$('#Modal_Editar_Tarea').modal("show");

	});

</script>
</html>