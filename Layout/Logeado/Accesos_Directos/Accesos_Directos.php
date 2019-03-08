
<?php

	session_start();
	if (!isset($_SESSION["Id_Usuario"])) {
		header("Location: ../../Sin_Logear/Inicio/Inicio.html");
	}

	if (isset($Link)) {
	echo "<a href='$linkfacebooknuevo'><img style='width: 50px; height: 50px; margin-top: 15px; margin-left: 80px;' src='Facebook.png'></a>";
	}
	if (isset($Link)) {
	echo "<a href='$linktwitternuevo'><img style='width: 50px; height: 50px; margin-top: 15px; margin-left: 80px;' src='Twitter.png'></a>";
	}
	if (isset($Link)) {
	echo "<a href='$linkinstagramnuevo'><img style='width: 50px; height: 50px; margin-top: 15px; margin-left: 80px;' src='Instagram.png'></a>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Accesos Directos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
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
		margin-top: 50px;
		margin-left: 55px;
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

	.verde{
		background-color: green!important;
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

	.blanco{
		color: White;
	}

	.verdes{
		color: #29752C;
	}

	.rojo{
		color: #752929;
	}

	.azul{<a href='$linkinstagram'><img style='width: 50px; height: 50px; margin-top: 15px; margin-left: 20px;' src='Instagram.png'></a>
		color: #143C91;
	}

	.amarillo{
		color: #ADA812;
	}

	#Base_Accesos{
		background-image: url('BaseMadera.jpg');
		width: 1000px;
		height: 400px;
		border: 2px solid #523002;
		margin-left: 150px;
	}

	.BoxRedSocial{
		width: 250px;
		height: 300px;
		text-align: center;
	}

	.imagenred{
		margin-top: 50px;
	}

	.inputtransparente{
		background: rgba(0, 0, 0, 0);
		border: none;
		outline: none;
		margin-left: 3px;
		text-color: black;
	}

	.enlaceicono{
		width: 50px;
		height: 50px;
		margin-top: 12px; 
		margin-left: 80px;
	}

	.botonrecarga{
		background-color: #153842;
	}

</style>
<body>
    <div class="container-fluid justify-content-center" id="Fondo">
		
		<div id="AccesosDirectos" class="fixed-top">

			<?php
				
				//CREANDO CONEXIÓN
				$connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
				$connection->set_charset("uft8");

				//COMPROBANDO SI LA CONEXIÓN ESTÁ BIEN
				if ($connection->connect_errno) {
					printf("Connection failed: %s\n", $connection->connect_error);
					exit();
				}

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
            <a style="color: White" class="navbar-brand Navegacion" href="../Contraseñas/Contraseñas.php"><img class="IconoNav" src="Contraseñas.png">Contraseñas</a>
            <a style="color: White" class="navbar-brand Navegacion" href="Accesos_Directos.php"><img class="IconoNav" src="Accesos.png">Accesos Directos</a>

			<div id="Perfil" class="">

				<a id="Salir" href="http://localhost:8080/Multitareas/Layout/salir.php"><img src="IconoLogout.png" class="Icono"></a>
				
				<img src="BasePerfil.png" id="Base" style="width: 100px; height: 120px;">

			</div>

        </nav>

		<div id="Nav_Izq">

			<ul class="justify-content-left">
				<li style="color: #0bbcbc; font-size: 19px;">Navegación Lateral de Atlantis</li>
				<li><a href="../Tablero_Tareas/Tablero_Tareas.php">Tablero de Tareas</a></li>
				<li><a href="../Calendario/Calendario.php">Calendario</a></li>
				<li><a href="../Contraseñas/Contraseñas.php">Contraseñas</a></li>
				<li><a href="Accesos_Directos.php">Accesos Directos</a></li>
				<li><a href="http://localhost:8080/Multitareas/Layout/salir.php" class="">Salir</a></li>
				<li><a href="../Acuerdo_Legal/acuerdolegal.html" target="_blank">Acuerdo Legal de <span style="color: #787BED;">Atlantis</span></a></li>
			</ul>

			<div id="Leyenda">
			</div>

			<div id="Tablero" class="absolute">
				
				<div class="row">

					<div id="Base_Accesos" class="row">
					<?php if (!isset($_POST["fb"])) : ?>
						<form method="post" class="col-md-4">
							<div class="BoxRedSocial">
								<img src="Facebook.png" class="imagenred">
								<h5><b>Ingresa tu link de<br>Facebook:</b></h5>
								<input class="input" type="text" placeholder="Inserta aquí tu link..." name="fb" required>
								<input type="image" src="save.png" class="guardar" name="guardarfacebook">
								<input type="hidden" value="Facebook" name="tipo">
							</div>
						</form>
						<?php else:  ?>
						<?php
						$linknuevo = $_POST['fb'];
						$query = "UPDATE accesos_rapidos SET Link='$linknuevo' WHERE Nombre='Facebook'
							AND Id_Usuario='".$_SESSION['Id_Usuario']."'";
							
						        if ($result = $connection->query($query)) {
									echo "<button class='botonrecarga'><a href='Accesos_Directos.php'>Actualizar<br><img src='act.png'></a></button>";
								}
						?>
						<?php endif ?>
						<?php if (!isset($_POST["tw"])) : ?>
						<form method="post" class="col-md-4">
							<div class="BoxRedSocial">
								<img src="Twitter.png" class="imagenred">
								<h5 class="TituloRedSocial"><b>Ingresa tu link de<br>Twitter:</b></h5>
								<input class="input" type="text" placeholder="Inserta aquí tu link..." name="tw" required>
								<input type="image" src="save.png" class="guardar" name="guardartwitter">
								<input type="hidden" value="Twitter" name="tipo">
							</div>
						</form>
						<?php else:  ?>
						<?php
						$linknuevo = $_POST['tw'];
						$query = "UPDATE accesos_rapidos SET Link='$linknuevo' WHERE Nombre='Twitter' AND Id_Usuario='".$_SESSION['Id_Usuario']."'";
							
						        if ($result = $connection->query($query)) {
									echo "<button class='botonrecarga'><a href='Accesos_Directos.php'>Actualizar<br><img src='act.png'></a></button>";
								}
						?>
						<?php endif ?>
						<?php if (!isset($_POST["in"])) : ?>
						<form method="post" class="col-md-4">
							<div class="BoxRedSocial">
								<img src="Instagram.png" class="imagenred">
								<h5 class="TituloRedSocial"><b>Ingresa tu link de<br>Instagram:</b></h5>
								<input class="input" type="text" placeholder="Inserta aquí tu link..." name="in" required>
								<input type="image" src="save.png" class="guardar" name="guardarinstagram">
								<input type="hidden" value="Instagram" name="tipo">
							</div>
						</form>
						<?php else:  ?>
						<?php
						$linknuevo = $_POST['in'];
						$query = "UPDATE accesos_rapidos SET Link='$linknuevo' WHERE Nombre='Instagram' AND Id_Usuario='".$_SESSION['Id_Usuario']."'";
							
						        if ($result = $connection->query($query)) {
									echo "<button class='botonrecarga'><a href='Accesos_Directos.php'>Actualizar<br><img src='act.png'></a></button>";
								}
						?>
						<?php endif ?>
					</div>

				</div>

			</div>

		</div>

    </div>
	
</body>
</html>