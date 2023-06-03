<?php
	// Conexon
	//require_once "init_local.php";
	require_once "init_local.php";	
	//Ordena los datos
	$fechaalta = date("Y-m-d");
	$nombre		= $_POST['nombre'];	
	$apellidos	= $_POST['apellidos'];
	$email		= $_POST['email'];
	// Conecta a la BD 
	$conexion = mysqli_connect($DBHost,$DBUser,$DBPass) or die("Error de conexión");
	//Seleccionamos la Base de Datos
	mysqli_select_db($conexion,$DBName);
	// Crea la sentencia SQL
   	$sql="INSERT INTO Correos (nombre, apellidos, correo, fechaalta, medio)
		VALUES ('$nombre', '$apellidos', '$email', '$fechaalta','Papel');"
	; 
	// Y la ejecuta
	mysqli_query($conexion,$sql);

	// Vuelve a la pagina principal
	header("Location: principal.php"); 
?>
