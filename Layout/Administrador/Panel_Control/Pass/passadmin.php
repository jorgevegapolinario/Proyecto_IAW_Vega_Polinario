<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Contraseñas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="passadmin.css">
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
        <a class="navbar-brand Navegacion" href="passadmin.php"><div><img src="Contraseñas.png" class="iconito"><b>Contraseñas</b></div></a>
        <a class="navbar-brand Navegacion" href="../Accesos/accesosadmin.php"><div><img src="Accesos.png" class="iconito"><b>Accesos Directos</b></div></a>
        <hr id="lineahorizontal">
    </div>
    <div id="busqueda" class="row">
        <form>
            <div id="buscar" class="row">
                <input type="text" class="input" placeholder="Buscar Contraseñas...">
                <input type="image" src="iconolupa.png" id="iconolupa">
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
			  if (isset($_POST["buscar"]) && isset($_POST["buscar2"])) {

				$nombrebusqueda = $_POST["buscar"];

				$query = "SELECT * FROM usuario WHERE Nombre=$nombrebusqueda";

				if ($result = $connection->query($query)) {
		
					while($obj = $result->fetch_object()) {
								
						$Nombre = $obj->Nombre;
						$Id = $obj->Id_Usuario;

					}
				};

				$query2 = "SELECT * FROM passwords WHERE Id_Usuario=$Id";

				if ($result = $connection->query2($query2)) {
					
					echo "<div class='row titulos'><h5 id='titulouser'>USUARIO:</h5><span id='nombreuser'><b>$Nombre</b></span></div>";
					echo "<table class='table'>";
						echo "<thead class='thead-dark'>";
							echo "<tr>";
								echo "<th scope='col'>Código</th>";
								echo "<th scope='col'>Título</th>";
								echo "<th scope='col'>Color</th>";
								echo "<th scope='col'></th>";
								echo "<th scope='col'></th>";
								echo "<th scope='col'></th>";
								echo "<th scope='col'>#</th>";
							echo "</tr>";
						echo "</thead>";

						while($obj = $result->fetch_object()) {
								
							$Titulo = $obj->Titulo;
							$Color = $obj->Color;
							$Id_Passwords = $obj->Id_Passwords;


							  echo "<thead class='table-primary'>";
								echo "<tr>";
								  echo "<th scope='row'>$Id_Passwords</th>";
								  echo "<th>$Titulo</th>";
								  echo "<th>$Color</th>";
								  echo "<th></th>";
								  echo "<th></th>";
								  echo "<th></th>";
								  echo "<th><input type='image' src='Editar.png' class='edit'><input type='image' src='Borrar.png' class='edit'></th>";
								echo "</tr>";
							  echo "</thead>";
							  echo "<thead class='thead-light'>";
								echo "<tr>";
								  echo "<th>Código</th>";
								  echo "<th>Nombre</th>";
								  echo "<th>Contraseña</th>";
								  echo "<th></th>";
								  echo "<th></th>";
								  echo "<th></th>";
								  echo "<th>#</th>";
								echo "</tr>";
							  echo "</thead>";
							  echo "<tbody>";

							$query3 = "SELECT * FROM pass WHERE Id_Usuario=$Id AND Id_Passwords=$Id_Passwords";

							if ($result = $connection->query3($query3)) {

								while($obj = $result->fetch_object()) {

									$NombrePass = $obj->Nombre;
									$Pass = $obj->Pass;
									$Id_Pass = $obj->Id_Pass;

									echo "<tr>";
									  echo "<th scope='row'><i>$Id_Pass</i></th>";
									  echo "<td>$NombrePass</td>";
									  echo "<td>$Pass<td>";
									  echo "<td></td>";
									  echo "<td></td>";
									  echo "<td></td>";
									  echo "<th><input type='image' src='Editar.png' class='edit'><input type='image' src='Borrar.png' class='edit'></th>";
									echo "</tr>";

								}
							}
						}
					
							  echo "</tbody>";
					echo "</table>";
				};
			  };
			?>
	</div>
	<div id="footer" class="footer justify-content-center fixed-bottom"></div>
</body>
</html>