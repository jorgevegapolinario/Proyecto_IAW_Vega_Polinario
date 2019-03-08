<?php
  session_start();
?>
<?php

	if (isset($_POST["registrarse"])) {

		
	  //CREAMOS LA CONEXIÓN.
	  $connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
	  $connection->set_charset("uft8");

	  //PROBAMOS QUE ESTÉ CORRECTA LA CONEXIÓN.
	  if ($connection->connect_errno) {
		  printf("Connection failed: %s\n", $connection->connect_error);
		  exit();
	  }

	  //CONSULTA PARA CREAR EL USUARIO EN LA BASE DE DATOS.
	  if ($_POST["pass"] == $_POST["confirmarpass"]){
	
		  $consulta = "INSERT INTO usuario (Genero, Nombre, Correo, Pass, Tipo, Telefono, Edad, Id_Usuario) 
		  VALUES ('".$_POST['genero']."','".$_POST['nombre']."','".$_POST['correo']."',md5('".$_POST['pass']."'),'Usuario','".$_POST['telefono']."','".$_POST['edad']."',NULL);";
		var_dump($_POST);
		echo "$consulta";
		  //PROBAMOS LA CONSULTA DE REGISTRO.
		  if ($result = $connection->query($consulta)) {

			$userid = $connection->insert_id;
			//Da error.
			  if ($result->false) {
				echo '<script language="javascript">alert("Lo sentimos, algo ha salido mal, registro inválido.");</script>';
			  } else {

				$consulta2 = "INSERT INTO accesos_rapidos (Nombre, Link, Id_Usuario, Id_Acceso) VALUES ('Facebook', 'https://facebook.com', $userid, NULL);";

				if ($result = $connection->query($consulta2)) {
					
					if ($result->false) {
						echo '<script language="javascript">alert("Lo sentimos, no hemos podido crear tu acceso a facebook.");</script>';
					}
		
				}
		
				$consulta3 = "INSERT INTO accesos_rapidos (Nombre, Link, Id_Usuario, Id_Acceso) VALUES ('Twitter', 'https://twitter.com', $userid, NULL);";
		
				if ($result = $connection->query($consulta3)) {
					
					if ($result->false) {
						echo '<script language="javascript">alert("Lo sentimos, no hemos podido crear tu acceso a twitter.");</script>';
					}
		
				}
		
				$consulta4 = "INSERT INTO accesos_rapidos (Nombre, Link, Id_Usuario, Id_Acceso) VALUES ('Instagram', 'https://instagram.com', $userid, NULL);";
		
				if ($result = $connection->query($consulta4)) {
					
					if ($result->false) {
						echo '<script language="javascript">alert("Lo sentimos, no hemos podido crear tu acceso a instagram.");</script>';
					}
		
				}

				//Registro válido.
				echo '<script language="javascript">alert("Registro Completado con éxito.");</script>';
				header("Location: ../../Sin_Logear/Login/Login.php");

			  }

		  }

	  	}

	}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<style>
	#Fondo{
	background-color: #73a4b7;
	}

	#Imagenes Img{
		margin: 30px 20px 0px 0px;
	}

	#footer{
		background-image: url('Footer.png'); 
		background-repeat: no-repeat;
		background-size: cover;
		height: 110px;
	}

	#Contenido{
		margin: 80px 0 0 100px;
		color: White;
	}

	.input{
		display: inline-block;
		background-color:rgba(0,0,0,0) !important;
		-webkit-box-sizing: content-box;
		-moz-box-sizing: content-box;
		box-sizing: content-box;
		padding: 10px 20px;
		border: 1px solid #696969;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		font: normal 16px/normal "Arial", Times, serif;
		color: Gray;
		-o-text-overflow: clip;
		text-overflow: clip;
		-webkit-box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
		box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
		-webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		-moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		-o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		margin-bottom: 20px;
		margin-left: 10px;
		text-shadow: 1px 1px 2px White;
	}

	#Box{
		background-image: url('Base.png');
		background-repeat: no-repeat;
		background-color:rgba(0,0,0,0) !important;
		width: 580px;
		height: 570px;
		margin-top: -54px;
	}

	#Enviar {
		font-family: Arial;
		color: #f2f2f2;
		font-size: 16px;
		padding: 8px;
		text-decoration: none;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0px 1px 3px #666666;
		-moz-box-shadow: 0px 1px 3px #666666;
		box-shadow: 0px 1px 3px #666666;
		text-shadow: 1px 1px 3px #5e5e5e;
		border: solid #262626 1px;
		background: -webkit-gradient(linear, 0 0, 0 100%, from(#1ca80f), to(#1a4d04));
		background: -moz-linear-gradient(top, #1ca80f, #1a4d04);
		margin-left: 215px;
	}

	#Enviar:hover {
		background: #1b5c15;
	}

	#Nombre{
		margin-top: 80px;
	}

	#Boton {
		font-family: Arial;
		color: #f2f2f2;
		font-size: 16px;
		padding: 8px;
		text-decoration: none;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0px 1px 3px #666666;
		-moz-box-shadow: 0px 1px 3px #666666;
		box-shadow: 0px 1px 3px #666666;
		text-shadow: 1px 1px 3px #5e5e5e;
		border: solid #262626 1px;
		background: -webkit-gradient(linear, 0 0, 0 100%, from(#e00000), to(#690005));
		background: -moz-linear-gradient(top, #e00000, #690005);
		margin-top: 10px;
	}

	#Boton:hover {
		background: #9c0505;
	}

	#Logo{
		margin: 40px 0px 0px 50px;
	}

	#redimensionado{
		width: 250px;
		height: 250px;
		padding: 20px;
		margin-right: 200px;
		margin-top: 100px;
	}

	.icono{
		width: 20px;
		height: 20px;
		margin-left: 10px;
	}

	.azul{
		color: #163578;
	}

	.margen{
		margin-left: 40px;
		font-size: 15px;
		color: #1B1E7B;
		margin-bottom: 5px;
	}

	#BotonRegistro {
		font-family: Arial;
		color: #e3e3e3;
		font-size: 16px;
		padding: 8px;
		text-decoration: none;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0px 1px 3px #666666;
		-moz-box-shadow: 0px 1px 3px #666666;
		box-shadow: 0px 1px 3px #666666;
		text-shadow: 1px 1px 3px #000000;
		border: solid #5c5c5c 1px;
		background: -webkit-gradient(linear, 0 0, 0 100%, from(#363636), to(#0a0a0a));
		background: -moz-linear-gradient(top, #363636, #0a0a0a);
		margin-top: 60px;
		margin-bottom: 100px;
		margin-left: 400px;
	}
	
	#BotonRegistro:hover {
		background: #073761;
	}

	.marg{
		margin-left: 10px;
		text-shadow: 1px 1px 2px White;
		color: Gray;
	}

	.enlaceicono{
		width: 50px;
		height: 50px;
		margin-top: 12px; 
		margin-left: 80px;
	}

</style>
<body id="Fondo">
    <div class="container-fluid justify-content-center">

        <a href="../Inicio/Inicio.html"><img id="Logo" src="Logo.png" alt="Atlantis" style="padding: 15px;"></a>

		<div class="row justify-content-center" id="Imagen">

			<img src="Imagen.png" class="img-left" id="redimensionado">

			<div id="Box">

				<form action="" method="post">

					<span class="azul"><img class="icono" src="IconoNombre.png"/> <b>Nombre</b></span>
					<input name="nombre" required type="text" id="Nombre" class="input" placeholder="Nombre aquí..."/><br>

					<span class="azul"><img class="icono" src="IconoCorreo.png"> <b>Correo electrónico</b></span>
					<input name="correo" required type="text" placeholder="Correo electrónico aquí..." class="input"><br>

					<span class="azul"><img class="icono" src="IconoCandado.png"> <b>Contraseña</b></span>
					<input name="pass" required type="password" id="Pass" class="input" placeholder="Contraseña aquí..."/><br>

					<span class="azul"><img class="icono" src="IconoCandado.png"> <b>Confirmar Contraseña</b></span>
					<input name="confirmarpass" required class="input" type="password" placeholder="Confirmar contraseña aquí..."><br>

					<span class="azul"><img class="icono" src="IconoTelefono.png"> <b>Teléfono</b></span>
					<input name="telefono" class="input" type="text" placeholder="Teléfono de contacto aquí..."><br>

					<span class="azul"><img class="icono" src="IconoGenero.png"> <b>Género</b></span>
					
					<label class="marg"><input type="radio" name="genero" value="Mujer">Mujer</label>
					<label class="marg"><input type="radio" name="genero" value="Hombre">Hombre</label>
					<label class="marg"><input type="radio" name="genero" value="Otro">Otro</label><br>

					<span class="azul"><img class="icono" src="IconoEdad.png"> <b>Edad</b></span>
					<input name="edad" class="input" type="number" placeholder="00"><br>

					<span class="margen">
						<input type="checkbox">Estoy de acuerdo con las condiciones de uso y términos legales.
					</span><br>

					<input name="registrarse" type="submit" value="Regístrate" id="BotonRegistro">

				</form>

			</div>

		</div>

		<div id="footer" class="footer justify-content-center fixed-bottom"></div>

    </div>
</body>
</html>