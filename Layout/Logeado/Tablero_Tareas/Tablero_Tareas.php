<?php
session_start();
if (!isset($_SESSION["Id_Usuario"])) {
	header("Location: ../../Sin_Logear/Inicio/Inicio.html");
}
  //CREANDO CONEXIÓN
  $connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
  $connection->set_charset("uft8");

  //COMPROBANDO LA CONEXIÓN
  if ($connection->connect_errno) {
	  printf("Connection failed: %s\n", $connection->connect_error);
	  exit();
  }
  $Id_Usuario = $_SESSION['Id_Usuario'];
  if (isset($_POST["titulotarea"])) {
	$titulotarea = $_POST["titulotarea"];
	$colortarea = $_POST["colortarea"];
	$fechatarea = $_POST["fechatarea"];
	$descripciontarea = $_POST["descripciontarea"];
	$Id_Usuario = $_SESSION['Id_Usuario'];

	$query = "INSERT INTO tarea (Titulo, Descripcion, Color, Fecha, Id_Usuario, Cod_Tarea)
	VALUES ('$titulotarea','$descripciontarea','$colortarea','$fechatarea','$Id_Usuario',NULL)";

	if ($result = $connection->query($query)) {

		header("Location: Tablero_Tareas.php");
	};
  };

  if (isset($_POST["editartitulotarea"])) {
	$titulotareaeditado = $_POST["editartitulotarea"];
	$colortareaeditado = $_POST["editarcolortarea"];
	$fechatareaeditado = $_POST["editarfechatarea"];
	$descripciontareaeditado = $_POST["editardescripciontarea"];
	$Id_Usuario = $_SESSION['Id_Usuario'];

	$query = "UPDATE INTO tarea (Titulo, Descripcion, Color, Fecha, Id_Usuario, Cod_Tarea)
	VALUES ('$titulotarea','$descripciontarea','$colortarea','$fechatarea','$Id_Usuario',NULL)";

	if ($result = $connection->query($query)) {

		header("Location: Tablero_Tareas.php");
	};
  };
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tablero de Tareas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<style>

	#Fondo{
	background-image: url('BaseNav.png'); 
	background-repeat: no-repeat;
	background-size: cover; /* Arreglo temporal */
	height: 1350px;
	}

	.Navegacion{
		margin-top: 120px;
	}

	.IconoNav{
		width: 25px;
		height: 25px;
		margin-right: 5px;
	}

	#Nav_Izq{
		margin-top: 150px;
		width: 250px;
	}

	#Nav_Izq li{
		margin-bottom: 24px;
		list-style: none;
		text-align: center;
		margin-left: -50px;
	}

	#Nav_Izq a{
		color: White;
		font-size: 19px;
	}

	#Perfil{
		padding: 0px;
		margin-top: -80px;
	}

	#AccesosDirectos{
		width: 475px;
		height: 75px;
		background-image: url('BaseAccesos.png');
		background-repeat: no-repeat;
		margin-left: 400px;
		margin-top: -7px;
	}

	#FlechaCerrar{
		margin: 55px 458px;
	}

	#Leyenda{
		width: 180px;
		height: 250px;
		margin-left: 35px;;
		margin-top: 250px;
	}

	.checkbox{
		margin-left: 20px;
	}

	.btn{
		margin-left: 10px;
		margin-top: -10px;
		padding: 0px;
	}

	#TextoNLeyenda{
		font-size: 12px;
		margin-left: 3px;
	}

	#Tablero{
		width:1017px;
		height:1104px;
		background-color: White;
		margin-left: 310px;
		margin-top: -950px;
	}

	.Tarea{
		width: 340px;
		height: 240px;
		background-image: url('BaseTarea.png');
		background-repeat: no-repeat;
		margin-left: 20px;
	}

	.iconostarea{
		margin-top: 25px;
		margin-left: 80px;
		width:40px;
		height:30px;
	}

	.TituloTarea{
		margin-left: 20px;
		margin-top: 30px;
		width: 180px;
		height: 30px;
	}

	.azul{
		color: #292B75;
	}

	.verde{
		color: #29752C;
	}

	.rojo{
		color: #752929;
	}

	.amarillo{
		color: #ADA812;
	}

	.BotonNuevaTarea{
		width:75px;
		height:75px;
		margin-top: 90px;
		margin-left: 150px;
	}

	.BaseTextoTarea{
		margin-left: 25px;
		margin-top: -50px;
		width: 280px;
		height: 150px;
	}

	.DivTarea{
		width: 260px;
		height: 30px;
		padding: 5px;
	}

	.inputtransparente{
		background: rgba(0, 0, 0, 0);
		border: none;
		outline: none;
		margin-left: 3px;
	}

	.inputmodal{
		display: inline-block;
		background-color:rgba(0,0,0,0) !important;
		border: 1px solid #b7b7b7;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		font: normal 16px/normal "Arial", Times, serif;
		color: Grey;
		-o-text-overflow: clip;
		text-overflow: clip;
		-webkit-box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
		box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
		text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
		-webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		-moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		-o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
	}

	#crear {
	  font-family: Arial;
	  color: #ffffff;
	  font-size: 15px;
	  padding: 3px;
	  text-decoration: none;
	  -webkit-border-radius: 5px;
	  -moz-border-radius: 5px;
	  border-radius: 5px;
	  -webkit-box-shadow: 0px 1px 3px #666666;
	  -moz-box-shadow: 0px 1px 3px #666666;
	  box-shadow: 0px 1px 3px #666666;
	  text-shadow: 1px 1px 3px #666666;
	  border: solid #003457 1px;
	  background: -webkit-gradient(linear, 0 0, 0 100%, from(#156ca6), to(#0c1869));
	  background: -moz-linear-gradient(top, #156ca6, #0c1869);
	}

	#crear:hover {
	  background: #084da1;
	}

	#cancelar {
	  font-family: Arial;
	  color: #ffffff;
	  font-size: 15px;
	  padding: 3px;
	  text-decoration: none;
	  -webkit-border-radius: 5px;
	  -moz-border-radius: 5px;
	  border-radius: 5px;
	  -webkit-box-shadow: 0px 1px 3px #666666;
	  -moz-box-shadow: 0px 1px 3px #666666;
	  box-shadow: 0px 1px 3px #666666;
	  text-shadow: 1px 1px 3px #666666;
	  border: solid #000000 1px;
	  background: -webkit-gradient(linear, 0 0, 0 100%, from(#9c9c9c), to(#1c1d24));
	  background: -moz-linear-gradient(top, #9c9c9c, #1c1d24);
	}

	#cancelar:hover {
	  background: #2e2e2e;
	}

	.titulofecha{
		padding-top: 10px;
	}

	.enlaceicono{
		width: 50px;
		height: 50px;
		margin-top: 12px; 
		margin-left: 80px;
	}

</style>
<body>
    <div class="container-fluid justify-content-center" id="Fondo">
		
		<div id="AccesosDirectos" class="fixed-top">
			
		<?php
				
				//Seleccionando todos los accesos rápidos.
				/* Consultas de selección que devuelven un conjunto de resultados */

				$query="SELECT * FROM accesos_rapidos WHERE Id_Usuario='$_SESSION[Id_Usuario]'
				ORDER BY 'Nombre'";
				
				      if ($result = $connection->query($query)) {

				        while($obj = $result->fetch_object()) {
							
							if ($obj->Nombre == 'Facebook'):
								$linkfb = $obj->Link;
							elseif ($obj->Nombre == 'Twitter'): 
								$linktw = $obj->Link;
							else:
								$linkin = $obj->Link;
							endif;
						}}

			?>
			
			
		
			<a href="<?php echo $linkfb ?>"><img class="enlaceicono" src="Facebook.png"></a>
			<a href="<?php echo $linktw ?>"><img class="enlaceicono" src="Twitter.png"></a>
			<a href="<?php echo $linkin ?>"><img class="enlaceicono" src="Instagram.png"></a>

		</div>

		<nav class="navbar">
            
			<a style="color: White" class="navbar-brand" href="Tablero_Tareas.php"><img src="Logo.png" alt="Atlantis" style="padding: 15px;"></a>
            <a style="color: White" class="navbar-brand Navegacion" href="Tablero_Tareas.php"><img class="IconoNav" src="Tareas.png">Tareas</a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Calendario/Calendario.php"><img class="IconoNav" src="Calendario.png">Calendario</a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Contraseñas/Contraseñas.php"><img class="IconoNav" src="Contraseñas.png">Contraseñas</a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Accesos_Directos/Accesos_Directos.php"><img class="IconoNav" src="Accesos.png">Accesos Directos</a>

			<div id="Perfil" class="">

				<a id="Salir" href="http://localhost:8080/Multitareas/Layout/salir.php"><img src="IconoLogout.png" class="Icono"></a>
				
				<img src="BasePerfil.png" id="Base" style="width: 100px; height: 120px;">

			</div>

        </nav>

		<div id="Nav_Izq">

			<ul class="justify-content-left">
				<li style="color: #0bbcbc; font-size: 19px;">Navegación Lateral de Atlantis</li>
				<li><a href="Tablero_Tareas.php">Tablero de Tareas</a></li>
				<li><a href="../Calendario/Calendario.php">Calendario</a></li>
				<li><a href="../Contraseñas/Contraseñas.php">Contraseñas</a></li>
				<li><a href="../Accesos_Directos/Accesos_Directos.php">Accesos Directos</a></li>
				<li><a href="http://localhost:8080/Multitareas/Layout/salir.php" class="">Salir</a></li>
				<li><a href="../Acuerdo_Legal/acuerdolegal.html" target="_blank">Acuerdo Legal de <span style="color: #787BED;">Atlantis</span></a></li>
			</ul>

			<div id="Leyenda">
			</div>

			<div id="Tablero" class="absolute">
				
				<div id="Tablerorow" class="row">

					<?php
						
						//MAKING A SELECT QUERY
						/* Consultas de selección que devuelven un conjunto de resultados */
						$query="SELECT * FROM tarea WHERE Id_Usuario=$Id_Usuario";
						if ($result = $connection->query($query)) {

							while($obj = $result->fetch_object()) {
								
								echo "<div class='Tarea row'><div class='TituloTarea'><h5 class='".
								$obj->Color."'>".$obj->Titulo."</h5></div><div class='iconostarea'><a class='Editar'
								data-id='$obj->Cod_Tarea'><img src='Editar.png' class='Icono'></img></a><a class='Borrar' href='borrartarea.php?cod=$obj->Cod_Tarea'>
								<img src='Borrar.png' class='Icono'></img></a></div><div class='BaseTextoTarea'>
								<h6 class='titulofecha'>Fecha: ".$obj->Fecha."</h6><p>".$obj->Descripcion."</p></div></div>";

							}
						}
					?>

					<div class="DivBotonTarea">
						
						<button type="image" class="btn BotonNuevaTarea"><img src="BotonNuevaTarea.png"></button>

					</div>

					<div id="Modales">

							<div class="modal fade" id="Modal_Nueva_Tarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Configurar Nueva Tarea</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="" method="post">
										<div class="modal-body">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Título de tarea:</label>
												<input type="text" class="form-control inputmodal" id="recipient-name" name="titulotarea" required>
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Color de título:</label>
												<select class="selectpicker inputmodal" id="SelectColores" name="colortarea" required>
													<option class="rojo">rojo</option>
													<option class="verde">verde</option>
													<option class="azul">azul</option>
													<option class="amarillo">amarillo</option>
												</select>
											</div>

											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Fecha:</label>
												<input type="date" class="inputmodal" name="fechatarea">
											</div>

											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Descripción de la tarea:</label>
												<textarea maxlength="175" cols="55" rows="8" class="inputmodal" name="descripciontarea" required></textarea>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar">Cancelar</button>
											<button type="submit" class="btn btn-primary" id="crear">Crear</button>
										</div>
										</form>
										
									</div>
								</div>
							</div>


							<div class="modal fade" id="Modal_Editar_Tarea" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								
								
								
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Editar Tarea</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formedit" action="editartarea.php" method="post">
										<div class="modal-body">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Título de tarea:</label>
												<input value="" type="text" class="form-control inputmodal" id="recipient-name" name="editartitulotarea" required>
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Color de título:</label>
												<select class="selectpicker inputmodal" id="SelectColores" name="editarcolortarea" required>
													<option class="rojo">rojo</option>
													<option class="verde">verde</option>
													<option class="azul">azul</option>
													<option class="amarillo">amarillo</option>
												</select>
											</div>

											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Fecha:</label>
												<input type="date" class="inputmodal" name="editarfechatarea">
											</div>

											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Descripción de la tarea:</label>
												<textarea maxlength="175" cols="55" rows="8" class="inputmodal" name="editardescripciontarea" required></textarea>
											</div>

										
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelar">Cancelar</button>
											<a href="#"><button type="submit" class="btn btn-primary" id="crear">Editar</button></a>
										</div>
										</form>
										
									</div>
								</div>
							</div>

					</div>

				</div>

			</div>

		</div>

	</div>

</body>
<script>

	
	/* CÓDIGO LOGOUT.
				session_destroy();
				header("Location ../Sin_Logear/Inicio/Inicio.html"); 
	*/

	/* EDITAR */
	$(".Editar").click(function(event){

		event.preventDefault();
		var id=$(this).attr("data-id");
		console.log(id);
		$("#formedit #codtarea").remove();
		$("#formedit").append("<input type='hidden' id='codtarea' value='"+id+"' name='codtarea' />");
		$('#Modal_Editar_Tarea').modal("show");

	});

	/* BOTON NUEVA TAREA*/
	$(".BotonNuevaTarea").click(function(){

		$('#Modal_Nueva_Tarea').modal("show");

	});

</script>
</html>