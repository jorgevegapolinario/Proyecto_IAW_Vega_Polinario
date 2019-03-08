<?php
  session_start();
?>
<?php
  if (isset($_POST["nombre"])) {

    //CREANDO CONEXIÓN
    $connection = new mysqli("localhost", "root", "Admin2015", "Atlantis");
    $connection->set_charset("uft8");

    //PROBAMOS QUE ESTÉ CORRECTA LA CONEXIÓN.
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    //HACEMOS LA CONSULTA.
    //Pass cifrada con md5.
    $consulta="SELECT * FROM usuario WHERE
    Nombre='".$_POST["nombre"]."' and Pass=md5('".$_POST["pass"]."');";

    //PROBAMOS LA CONSULTA.
    if ($result = $connection->query($consulta)) {

        //No retorna líneas.
        if ($result->num_rows===0) {
          echo '<script language="javascript">alert("Login Inválido.");</script>';
        } else {
          //Login válido.
          $obj=$result->fetch_object();
          $_SESSION["Nombre"]=$_POST["nombre"];
          $_SESSION["language"]="es";
          $_SESSION["Id_Usuario"]=$obj->Id_Usuario;
          $_SESSION["Tipo"]=$obj->Tipo;

          if ($_SESSION["Tipo"]=="Administrador") {
            header("Location: ../../Administrador/Tablero_Tareas/Tablero_Tareas.php");
          } else{
            header("Location: ../../Logeado/Tablero_Tareas/Tablero_Tareas.php");
          }
        }

    } else {
      echo "Usuario no encontrado.";
    };
  };
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<style>
	#Fondo{
	background-image: url('Fondo.jpeg'); 
	background-repeat: no-repeat;
	background-size: cover; /* Arreglo temporal */
	}

	#Imagenes Img{
		margin: 30px 20px 0px 0px;
	}

	p{
		font-size: 15px;
		text-align: center;
		margin: 20px 40px 0px 0px;
	}

	#footer{
		background-image: url('Footer.png'); 
		background-repeat: no-repeat;
		height: 220px;
        background-size: cover;
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
		border: 1px solid #b7b7b7;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		font: normal 16px/normal "Arial", Times, serif;
		color: #ffffff;
		-o-text-overflow: clip;
		text-overflow: clip;
		-webkit-box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
		box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
		text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
		-webkit-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		-moz-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		-o-transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		transition: all 200ms cubic-bezier(0.42, 0, 0.58, 1);
		margin-bottom: 20px;
		margin-left: 100px;
	}

	#Box{
		background-image: url('Box.png');
		background-repeat: no-repeat;
		background-color:rgba(0,0,0,0) !important;
		width: 380px;
		height: 380px;
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

	input::-webkit-input-placeholder {
		color: White;
	}

</style>
<body>
    <div class="container-fluid justify-content-center" id="Fondo">

        <nav class="navbar" style="background-image: url('Header.png'); background-repeat: repeat; relative;">
           <a style="color: White" class="navbar-brand" href="../Inicio/Inicio.html"><img src="Logo.png" alt="Atlantis" style="padding: 15px;"></a>
            <a style="color: White" class="navbar-brand" href="../Inicio/Inicio.html">INICIO</a>
            <a style="color: White" class="navbar-brand" href="../Servicios/Servicios.html">SERVICIOS</a>
            <a style="color: White" class="navbar-brand" href="../Contactanos/Contactanos.html">CONTÁCTANOS</a>
            <a style="color: White" class="navbar-brand" href="Login.php">ENTRAR</a>
        </nav>

		<div class="row justify-content-left" id="Contenido">

			<p> <img src="Titulo.png" class="img-center"><br>
				<b>Atlantis es una aplicación que nació con el propósito de facilitarnos<br>
				la vida mediante la organización simple, eficiente e intuitiva.<br><br>
				Nos olvidamos de engorrosos diseños en los cuales nos perdemos<br>
				durante demasiado tiempo, dando paso a un layout fluido, agradable<br>
				y poco pesado a la vista, sin olvidar la facilidad con la que se puede<br>
				usar <span style="color:#58659C"><a href="../Inicio/Inicio.html">Atlantis</a></span>.<br>
				Esperamos que disfrutes.<br><br>¿Aún no te has registrado? ¿¡A qué esperas!?<br></b>
				<a href="../Registro/Registro.php"><input type="button" id="Boton" value="Regístrate"></a>
			</p>

			<div id="Box">

				<form action="" method="post">
					<input name="nombre" id="Nombre" class="input" placeholder="Nombre aquí..."required /><br>
					<input name="pass" type="password" id="Pass" class="input" placeholder="Contraseña aquí..." required/><br>
					<input type="submit" value="Enviar ahora" id="Enviar">
				</form>

			</div>

		</div>

		<div id="footer" class="footer justify-content-center"></div>

    </div>
</body>
</html>