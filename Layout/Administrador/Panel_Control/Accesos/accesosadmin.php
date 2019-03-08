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

		  if (isset($_POST["buscar"])) {

			$nombrebusqueda = $_POST["buscar"];
			
			$query = "SELECT * FROM usuario WHERE Nombre=$nombrebusqueda";

			if ($result = $connection->query($query)) {
				echo $_POST["buscar"];
				while($obj = $result->fetch_object()) {
								
					$Nombre = $obj->Nombre;
					$Id = $obj->Id_Usuario;
					$_SESSION["idusernecesario"] = $Id;

				}
			}

				$queryfacebook = "SELECT * FROM accesos_rapidos WHERE Id_Usuario=$_SESSION[idusernecesario] AND Nombre='Facebook'";
				
			if ($result = $connection->query($queryfacebook)) {

				while($obj = $result->fetch_object()) {
								
					$LinkFacebook = $obj->Link;

					if($LinkFacebook == NULL){
						$LinkFacebook = "No definido.";
					}

				}
			}

			$querytwitter = "SELECT * FROM accesos_rapidos WHERE Id_Usuario=$_SESSION[idusernecesario] AND Nombre='Twitter'";
			
			if ($result = $connection->query($querytwitter)) {
		
				while($obj = $result->fetch_object()) {
								
					$LinkTwitter = $obj->Link;

					if($LinkTwitter == NULL){
						$LinkTwitter = "No definido.";
					}

				}
			}

			$queryinstagram = "SELECT * FROM accesos_rapidos WHERE Id_Usuario=$_SESSION[idusernecesario] AND Nombre='Instagram'";

			if ($result = $connection->query($queryinstagram)) {
		
				while($obj = $result->fetch_object()) {
				
						$LinkInstagram = $obj->Link;

						if($LinkInstagram == NULL){
							$LinkInstagram = "No definido.";
						}

				}
			}


		}else{

			$LinkFacebook = "No seleccionado.";
			$LinkInstagram = "No seleccionado.";
			$LinkTwitter = "No seleccionado.";
			$nombrebusqueda = "Usuario no seleccionado.";

		}

		?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Accesos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="accesosadmin.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    <div id="cabecera" class="row">
        <div id="logo"><img src="Logo.png" alt="Logo" class="navbar-brand"></div>
        <a class="navbar-brand Navegacion" href="../Usuarios/usuariosadmin.php"><div><img src="Usuarios.png" class="iconito"><b>Usuarios</b></div></a>
        <a class="navbar-brand Navegacion" href="../Tareas/tareasadmin.php"><div><img src="Tareas.png" class="iconito"><b>Tareas</b></div></a>
        <a class="navbar-brand Navegacion" href="../Pass/passadmin.php"><div><img src="Contraseñas.png" class="iconito"><b>Contraseñas</b></div></a>
        <a class="navbar-brand Navegacion" href="accesosadmin.php"><div><img src="Accesos.png" class="iconito"><b>Accesos Directos</b></div></a>
        <hr id="lineahorizontal">
    </div>
    <div id="busqueda" class="row">
        <form action="accesosadmin.php" method="post">
            <div id="buscar" class="row">
                <input name="buscar" type="text" class="input" placeholder="Buscar Accesos Directos..." required>
                <input name="buscar2" type="image" src="iconolupa.png" id="iconolupa">
            </div>
        </form>
    </div>
	<div id="cuerpo">
		<div class="row titulos"><h5 id="titulouser">USUARIO:</h5><span id="nombreuser"><b><?php echo $nombrebusqueda; ?></b></span></div>
		<div id="Base_Accesos" class="row">
			<div class="BoxRedSocial col-md-4">
				<img src="Facebook.png" class="imagenred">
				<h5><b>Link de Facebook:</b></h5>
				<input class="input2" type="text" value="<?php echo $LinkFacebook; ?>">
				<input type="image" src="Editar.png"><input type="image" src="Borrar.png" class="borraracceso">
			</div>

			<div class="BoxRedSocial col-md-4">
				<img src="Twitter.png" class="imagenred">
				<h5 class="TituloRedSocial"><b>Link de Twitter:</b></h5>
				<input class="input2" type="text" value="<?php echo $LinkTwitter; ?>">
				<input type="image" src="Editar.png"><input type="image" src="Borrar.png" class="borraracceso">
			</div>
						
			<div class="BoxRedSocial col-md-4">
				<img src="Instagram.png" class="imagenred">
				<h5 class="TituloRedSocial"><b>Link de Instagram:</b></h5>
				<input class="input2" type="text" value="<?php echo $LinkInstagram; ?>">
				<input type="image" src="Editar.png"><input type="image" src="Borrar.png" class="borraracceso">
			</div>
		</div>
	</div>
</body>
</html>