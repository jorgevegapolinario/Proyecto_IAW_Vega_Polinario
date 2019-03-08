<?php
session_start();
if (!isset($_SESSION["Id_Usuario"]) && ($_SESSION["Tipo"] != "Administrador")) {

	header("Location: ../../Sin_Logear/Inicio/Inicio.html");

}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Calendario</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="jquery-ui.min.js"></script>
	<link rel="stylesheet" href="calendario.css" media="screen">
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

	.Calendario{
		width: 774px;
		margin-left: 300px;
	}

	.table-style .MarcadorVerde {background: #0D872B; color: #ffffff;}
	.table-style .MarcadorAmarillo {background: #B5D71D; color: #ffffff;}
	.table-style .MarcadorRojo {background: #970C0C; color: #ffffff;}
	.table-style th:nth-of-type(7),td:nth-of-type(7) {color: #4871D1;}
	.table-style th:nth-of-type(1),td:nth-of-type(1) {color: #A32020;}
	.table-style tr:first-child th{background-color:#F6F6F6; text-align:center; font-size: 15px;}

	.IconoColor{
		width:50px;
		height: 50px;
	}

	.color{
		padding: 10px;
	}

	#Referencias_Calendario{
		margin: 100px 50px;
	}

	.Descripcion{
		padding: 9px;
		color: #4E525D;
		margin-top: 10px;
		width:500px;
	}

	.Fecha{
		padding: 9px;
		color: #4E525D;
		margin-top: 10px;
	}

	#titulocalendario {
		text-align: left; 
		font-family: Arial; 
		font-size: 30px; 
		color: #143C91; 
		text-shadow: 0px 0px 9px #508AD3;
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
					
					//CREANDO CONEXIÓN
					$connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
					$connection->set_charset("uft8");

					//COMPROBANDO LA CONEXIÓN
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
            <a style="color: White" class="navbar-brand Navegacion" href="Calendario.php"><img class="IconoNav" src="Calendario.png">Calendario</a>
            <a style="color: White" class="navbar-brand Navegacion" href="../Contraseñas/Contraseñas.php"><img class="IconoNav" src="Contraseñas.png">Contraseñas</a>
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
				<li><a href="Calendario.php">Calendario</a></li>
				<li><a href="../Contraseñas/Contraseñas.php">Contraseñas</a></li>
				<li><a href="../Accesos_Directos/Accesos_Directos.php">Accesos Directos</a></li>
				<li><a href="http://localhost:8080/Multitareas/Layout/salir.php" class="">Salir</a></li>
				<li><a href="../Acuerdo_Legal/acuerdolegal.html" target="_blank">Acuerdo Legal de <span style="color: #787BED;">Atlantis</span></a></li>
			</ul>

			<div id="Leyenda">

			</div>

			<div id="Tablero" class="absolute">
				
				<div class="row">

					<div class="row" id="Calendario">

						<div class=" col-md-4 col-sm-12 well pull-right-lg Calendario" style="border:0px solid">
							<h3 style="padding:10px; margin-bottom:2px; text-align:center;" id="titulocalendario">
							  CALENDARIO
							</h3>

							<div id="calendariobox">
							
								<script>
									$('#calendariobox').datepicker({
										inline: true,
										firstDay: 1,
										showOtherMonths: true,
										dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sáb'],
										monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"]
									});
								</script>
							
							</div>

						</div>

					</div>

				</div>

				<div class="row" id="Referencias_Calendario">
					
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

					$query="SELECT * FROM tarea WHERE Id_Usuario=$Id_Usuario";

						if ($result = $connection->query($query)) {

							while($obj = $result->fetch_object()) {
								
								".$obj->Descripcion.";

								echo "<div class='row col-md-12'><img class='IconoFecha' src='IconoFecha.png' style='width:60px;height:60px;'/><label 
								class='Fecha'>".$obj->Fecha."</label><img class='IconoFecha' src='Flecha.png' style='width:60px;height:60px;margin-left:20px;margin-top:2px;'/>
								<label class='Descripcion'><b><i>".$obj->Descripcion."</i></b></label></div>";

							}
						}
				?>

				</div>

			</div>

		</div>

    </div>
</body>
</html>