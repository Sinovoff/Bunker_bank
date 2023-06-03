<?php

  // Obtengo los datos cargados en el formulario de login.
   
  // Datos para conectar a la base de datos.
 // $DBHost="localhost";
  $DBName="bunkervalladolid_es";
  $DBHost="localhost";
	//$DBName="Nueva_reservas";
  $DBUser= $_POST['usuario'];
  //$DBPass="";
  $DBPass= $_POST['password'];
//	$DBUser="root";
//	$DBPass="";

  $conexion = mysqli_connect($DBHost,$DBUser,$DBPass,$DBName) ;
   // or die("Error de conexión");
   if (!$conexion) {
    header("Location: correos.php"); 
   }

  // Validar la conexión de base de datos.
  if ($conexion ->connect_error) {    
    echo 'El email o password es incorrecto, <a href="correos.html">vuelva a intenarlo</a>.<br/>';
    //die("Connection failed: " . $conexion ->connect_error);
  }
  header("Location: principal.php"); 
  exit;
?>