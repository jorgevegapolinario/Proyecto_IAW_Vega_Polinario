<?php
session_start();
if (!isset($_SESSION["Id_Usuario"]) && ($_SESSION["Tipo"] != "Administrador")) {

	header("Location: ../../Sin_Logear/Inicio/Inicio.html");

}
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

	  $Id_Usuario = $_SESSION['Id_Usuario'];
  
	if (isset($_POST["titulopass"])) {

												$titulo = $_POST["titulopass"];
												$color = $_POST["color"];
												$nombrepass1 = $_POST["nombrepass1"];
												$nombrepass2 = $_POST["nombrepass2"];
												$nombrepass3 = $_POST["nombrepass3"];
												$pass1 = $_POST["pass1"];
												$pass2 = $_POST["pass2"];
												$pass3 = $_POST["pass3"];											
												

												$querypasswords = "INSERT INTO passwords (Titulo, Id_Usuario, Color, Id_Passwords)
												VALUES ('$titulo','$Id_Usuario','$color',NULL)";

												if ($result = $connection->query($querypasswords)) {

													$Id_Passwords = $connection->insert_id;

													if (isset($nombrepass1) && !empty($pass1)) {

														$querypass1 = "INSERT INTO pass (Nombre, Pass, Id_Usuario, Id_Passwords, Id_Pass) 
														VALUES ('$nombrepass1',md5('$pass1'),'$Id_Usuario','$Id_Passwords',NULL)";

														if ($result = $connection->query($querypass1)) {
														}
													}

													if (!empty($nombrepass2) && !empty($pass2)) {
														
														$querypass2 = "INSERT INTO pass (Nombre, Pass, Id_Usuario, Id_Passwords, Id_Pass)
														VALUES ('$nombrepass2',md5('$pass2'),'$Id_Usuario','$Id_Passwords',NULL)";

														if ($result = $connection->query($querypass2)) {
														}	

													}

													if (!empty($nombrepass3) && !empty($pass3)) {
														
														$querypass3 = "INSERT INTO pass (Nombre, Pass, Id_Usuario, Id_Passwords, Id_Pass)
														VALUES ('$nombrepass3',md5('$pass3'),'$Id_Usuario','$Id_Passwords',NULL)";

														if ($result = $connection->query($querypass3)) {
														}

													}

													/* header("Location: /Contraseñas.php");*/

												}
												
												
	};


	if (isset($_POST["editartitulopassword"])) {

		$titulopasswordeditado = $_POST["editartitulopassword"];
		$colorpasswordeditado = $_POST["editarcolorpassword"];
		$Id_Usuario = $_SESSION['Id_Usuario'];
		$Id_Passwords = $_POST['idpassword'];

		$query = "UPDATE passwords SET Titulo='$titulopasswordeditado',Color='$colorpasswordeditado'
		WHERE Id_Passwords='$Id_Passwords'";

		if ($result = $connection->query($query)) {


			$editnombpass1 = $_POST['editarnombrepass1'];
			$editpass1 = $_POST['editarpass1'];
			$editnombpass2 = $_POST['editarnombrepass2'];
			$editpass2 = $_POST['editarpass2'];
			$editnombpass3 = $_POST['editarnombrepass3'];
			$editpass3 = $_POST['editarpass3'];

			echo "$editnombpass1<br>";
			echo "$editpass1<br>";
			echo "$editnombpass2<br>";
			echo "$editpass2<br>";
			echo "$editnombpass3<br>";
			echo "$editpass3<br>";


													if (isset($editnombpass1) && isset($editpass1)) {
														
														$query = "DELETE FROM pass WHERE Id_Passwords='$Id_Passwords'";

														if ($result = $connection->query($query)) {
															
															$querypass1 = "INSERT INTO pass (Nombre, Pass, Id_Usuario, Id_Passwords, Id_Pass) 
															VALUES ('$editnombpass1',md5('$editpass1'),'$Id_Usuario','$Id_Passwords',NULL)";

															if ($result = $connection->query($querypass1)) {
															}

															$querypass2 = "INSERT INTO pass (Nombre, Pass, Id_Usuario, Id_Passwords, Id_Pass) 
															VALUES ('$editnombpass2',md5('$editpass2'),'$Id_Usuario','$Id_Passwords',NULL)";

															if ($result = $connection->query($querypass2)) {
															}

															$querypass3 = "INSERT INTO pass (Nombre, Pass, Id_Usuario, Id_Passwords, Id_Pass) 
															VALUES ('$editnombpass3',md5('$editpass3'),'$Id_Usuario','$Id_Passwords',NULL)";
															
															if ($result = $connection->query($querypass3)) {
															}

														}


													}

													

		};
	};


?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contraseñas</title>
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

	.Pass{
		width: 290px;
		height: 240px;
		background-image: url('Base	.png');
		background-repeat: no-repeat;
		margin-left: 50px;
	}

	.iconospass{
		margin-top: 15px;
		width:40px;
		height:30px;
	}

	#Borrar{
		margin-left: 6px;
	}

	.TituloPass{
		margin-left: 20px;
		margin-top: 20px;
		width: 225px;
		height: 30px;
	}

	.blanco{
		color: White;
	}

	.verde{
		color: #29752C;
	}

	.rojo{
		color: #752929;
	}

	.azul{
		color: #143C91;
	}

	.amarillo{
		color: #ADA812;
	}

	.BotonNuevaPass{
		width:75px;
		height:75px;
		margin-top: 90px;
		margin-left: 160px;
	}

	.boxpass{
		width: 265px;
		height: 160px;
		margin-left: 15px;
		margin-top: -50px;
	}

	.box{
		width: 265px;
		height: 40px;
		margin-top: 7px;
		background-image: url('BaseBoxPass.png');
	}

	.botonnuevobox{
		margin-left: 45%;
		margin-top: -5px;
	}

	.Nombre{
		font-size: 15px;
		padding: 7px;
		width: 115px;
		margin-left: 2px;
	}

	.PassGuardada{
		color: Grey;
		width: 115px;
	}

	.inputtransparente{
		background: rgba(0, 0, 0, 0);
		border: none;
		outline: none;
		width: 100px;
		margin-left: 3px;
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

	#guardar {
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

	#guardar:hover {
	  background: #084da1;
	}


	.cancelar {
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

	.cancelar:hover {
	  background: #2e2e2e;
	}

	.IconoNuevoBox{
		margin-top: 10px;
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
            
			<a style="color: White" class="navbar-brand" href="../Tablero_Tareas/Tablero_Tareas.php"><img src="Logo.png" alt="Atlantis" style="padding: 15px;"></a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Tablero_Tareas/Tablero_Tareas.php"><img class="IconoNav" src="Tareas.png">Tareas</a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Calendario/Calendario.php"><img class="IconoNav" src="Calendario.png">Calendario</a>
            <a style="color: White" class="navbar-brand Navegacion" href="Contraseñas.php"><img class="IconoNav" src="Contraseñas.png">Contraseñas</a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Accesos_Directos/Accesos_Directos.php"><img class="IconoNav" src="Accesos.png">Accesos Directos</a>

			<div id="Perfil" class="">

				<a id="Salir" href="http://localhost:8080/Multitareas/Layout/salir.php"><img src="IconoLogout.png" class="Icono"></a>
				<a id="PanelDeControl" href="../Panel_Control/Usuarios/usuariosadmin.php"><img src="Panel_Control.png" class="Icono"></a>
				
				<img src="BasePerfil.png" id="Base" style="width: 100px; height: 120px;">

			</div>

        </nav>

		<div id="Nav_Izq">

			<ul class="justify-content-left">
				<li style="color: #0bbcbc; font-size: 19px;">Navegación Lateral de Atlantis</li>
				<li><a href="../Tablero_Tareas/Tablero_Tareas.php">Tablero de Tareas</a></li>
				<li><a href="../Calendario/Calendario.php">Calendario</a></li>
				<li><a href="Contraseñas.php">Contraseñas</a></li>
				<li><a href="../Accesos_Directos/Accesos_Directos.php">Accesos Directos</a></li>
				<li><a href="http://localhost:8080/Multitareas/Layout/salir.php" class="">Salir</a></li>
				<li><a href="../Acuerdo_Legal/acuerdolegal.html" target="_blank">Acuerdo Legal de <span style="color: #787BED;">Atlantis</span></a></li>
			</ul>

			<div id="Leyenda">
		
			</div>

			<div id="Tablero" class="absolute">
				
				<div class="row">

					<?php
		
						//CREANDO CONEXIÓN
						$connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
						$connection->set_charset("utf-8");

						//COMPROBANDO SI LA CONEXIÓN ESTÁ BIEN
						if ($connection->connect_errno) {
							printf("Connection failed: %s\n", $connection->connect_error);
							exit();
						}

						$Id_Usuario = $_SESSION['Id_Usuario'];
						
						//Seleccionando todas las tareas.
						/* Consultas de selección que devuelven un conjunto de resultados */
						$query="SELECT * from passwords WHERE Id_Usuario=$Id_Usuario";

						if ($result = $connection->query($query)) {

							while($obj = $result->fetch_object()) {
												
								$color = $obj->Color;

								$Id_Passwords= $obj->Id_Passwords;
								echo "<div class='Pass row'>";

										echo "<div class='TituloPass'>";
											echo "<h5 class='$obj->Color'>$obj->Titulo</h5>";
										echo "</div>";

										echo "<div class='iconospass'>";
											echo "<a class='Editarpass' data-id='$obj->Id_Passwords'><img src='Editar.png' class='Icono'></a>";
											echo "<a id='Borrar' href='borrarpassword.php?iduser=$Id_Usuario&idpassword=$Id_Passwords'><img src='Borrar.png' class='Icono'></a>";
										echo "</div>";

										echo "<div class='boxpass'>";

											$query="SELECT * from pass WHERE Id_Passwords=$Id_Passwords";

											if ($result2 = $connection->query($query)) {
												
												while($obj1 = $result2->fetch_object()) {

													$pass = substr($obj1->Pass,0,15	);

												echo "<div class='box'>";
													echo "<label class='Nombre $color'>$obj1->Nombre:</label>";
													echo "<label class='PassGuardada'>$pass</label>";
													echo "<input type='hidden' id='idpass' value='".$obj1->Id_Pass."' name='idpass' />";
												echo "</div>";

												}
											}

										echo "</div>";

								echo "</div>";

							}	

							


						};
					?>

					<div class="BotonPass row">
						
						<button type="image" class="btn BotonNuevaPass"><img src="BotonNuevaPass.png"></button>

					</div>

					<div id="Modales">

							<div class="modal fade" id="Modal_Nueva_Pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Configurar Nueva Contraseña</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form action="Contraseñas.php" method="post">
										<div class="modal-body">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Título de contraseña:</label>
												<input type="text" class="form-control inputmodal" id="recipient-name" name="titulopass" required>
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Color de título:</label>
												<select classId_Pass="selectpicker inputmodal" class="SelectColores" name="color" required>
													<option class="rojo">rojo</option>
													<option class="verde">verde</option>
													<option class="azul">azul</option>
													<option class="amarillo">amarillo</option>
												</select>
											</div>
											<div class="form-group">
												<h5 for="recipient-name" class="col-form-label">Contraseñas:</h5>
												<hr>
												<img src="icononombre.png" style="padding:3px"><label>Nombre:</label><input type="text" class="inputtransparente" name="nombrepass1">
												<img src="Contraseñas.png" style="padding:3px"><label>Contraseña:</label><input type="password" class="inputtransparente" name="pass1">
												<hr>
												<img src="icononombre.png" style="padding:3px"><label>Nombre:</label><input type="text" class="inputtransparente" name="nombrepass2">
												<img src="Contraseñas.png" style="padding:3px"><label>Contraseña:</label><input type="password" class="inputtransparente" name="pass2">
												<hr>
												<img src="icononombre.png" style="padding:3px"><label>Nombre:</label><input type="text" class="inputtransparente" name="nombrepass3">
												<img src="Contraseñas.png" style="padding:3px"><label>Contraseña:</label><input type="password" class="inputtransparente" name="pass3">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary cancelar" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" id="crear">Crear</button>
										</div>
										</form>
										
									</div>
								</div>
							</div>


							<div class="modal fade" id="Modal_Editar_Pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Editar Contraseña</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form id="formedit" action="Contraseñas.php" method="post">
										<div class="modal-body">
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Título de contraseña:</label>
												<input type="text" class="form-control inputmodal" name="editartitulopassword" required>
											</div>
											<div class="form-group">
												<label for="message-text" class="col-form-label">Color de título:</label>
												<select class="selectpicker inputmodal" class="SelectColores" name="editarcolorpassword" required>
													<option class="rojo">rojo</option>
													<option class="verde">verde</option>
													<option class="azul">azul</option>
													<option class="amarillo">amarillo</option>
												</select>
											</div>
											<div class="form-group">
												<h5 for="recipient-name" class="col-form-label">Contraseñas:</h5>
												<hr>
												<img src="icononombre.png" style="padding:3px"><label>Nombre:</label><input type="text" class="inputtransparente" name="editarnombrepass1" required>
												<img src="Contraseñas.png" style="padding:3px"><label>Contraseña:</label><input type="password" class="inputtransparente" name="editarpass1" required>
												<?php

													/*if (isset($_POST["editarnombrepass1"]) && isset($_POST["editarpass1"])) {

														$query = "SELECT Id_Pass FROM pass WHERE Id_Usuario = '$Id_Ususario' AND Id_Passwords = '$Id_Passwords'";

														if ($result = $connection->query($query)) {
															
															$passprimera1 = $result->fetch_object();
															$passsegunda2 = $result->fetch_object();
															$passtercera3 = $result->fetch_object();

														} 
													}*/
													

												?>
												<hr>
												<img src="icononombre.png" style="padding:3px"><label>Nombre:</label><input type="text" class="inputtransparente" name="editarnombrepass2" required>
												<img src="Contraseñas.png" style="padding:3px"><label>Contraseña:</label><input type="password" class="inputtransparente" name="editarpass2" required>
												<?php

													/* if (isset($_POST["editarnombrepass2"]) && isset($_POST["editarpass2"])) {

														$query = "SELECT Id_Pass FROM pass WHERE Id_Usuario = '$Id_Ususario' AND Id_Passwords = '$Id_Passwords'";
														
														if ($result = $connection->query($query)) {

															$passprimera1 = $result->fetch_object();
															$passsegunda2 = $result->fetch_object();
															$passtercera3 = $result->fetch_object();

														} 
													}*/
													

												?>
												<hr>
												<img src="icononombre.png" style="padding:3px"><label>Nombre:</label><input type="text" class="inputtransparente" name="editarnombrepass3" required>
												<img src="Contraseñas.png" style="padding:3px"><label>Contraseña:</label><input type="password" class="inputtransparente" name="editarpass3" required>
												<?php

													/*if (isset($_POST["editarnombrepass3"]) && isset($_POST["editarpass3"])) {

														$query = "SELECT Id_Pass FROM pass WHERE Id_Usuario = '$Id_Ususario' AND Id_Passwords = '$Id_Passwords'";
														
														if ($result = $connection->query($query)) {

															$passprimera1 = $result->fetch_object();
															$passsegunda2 = $result->fetch_object();
															$passtercera3 = $result->fetch_object();

														} 
													}*/
													

												?>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary cancelar" data-dismiss="modal">Cancelar</button>
											<button type="submit" class="btn btn-primary" id="guardar">Guardar</button>
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

	/* BOTON NUEVAS CONTRASEÑAS */

	$(".BotonNuevaPass").click(function(){

		/* Se tiene que abrir antes el modal para definir el título y el color. */

		/* Meter insert de nueva Tarea en DB */

		$("#Modal_Nueva_Pass").modal("show");
		
	});

	/* EDITAR */

	$(".Editarpass").click(function(event){

		event.preventDefault();
		var id=$(this).attr("data-id");
		console.log(id);
		$("#formedit #idpassword").remove();
		$("#formedit").append("<input type='hidden' id='idpassword' value='"+id+"' name='idpassword' />");
		$("#Modal_Editar_Pass").modal("show");

	});

</script>
</html>