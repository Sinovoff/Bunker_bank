<?php
	// Parametros de conexion 
	$DBHost="localhost";
	$DBName="bunkervalladolid_es";
	$DBUser="bunkervalladolid";
	$DBPass="Escapebunker17";
	// ordena los datos
	//$fecha	= $_POST['reservafecha1'];
	//Transformar el formato Año/Mes/Día
	//$fechaalta = date("Y-m-d", strtotime($fecha));
	$fechaalta = date("Y-m-d");
	$nombre		= $_POST['nombre'];	
	$apellidos	= $_POST['apellidos'];
	$email		= $_POST['email'];
	// Conecta a la BD 
	$conexion = mysqli_connect($DBHost,$DBUser,$DBPass) or die("Error de conexión");
	//Seleccionamos la Base de Datos
	mysqli_select_db($conexion,$DBName);
	// Crea la sentencia SQL
   	$sql="INSERT INTO Correos (nombre, apellidos, correo, fechaalta)
		VALUES ('$nombre', '$apellidos', '$email', '$fechaalta');"
	; 
	// Y la ejecuta
	mysqli_query($conexion,$sql);
?>
