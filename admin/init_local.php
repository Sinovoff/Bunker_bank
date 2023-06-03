<?php

	$DBHost="localhost";
	$DBName="bunkervalladolid_es";
	$DBUser="bunkervalladolid";
	$DBPass="Escapebunker17";
/*
	$DBHost="localhost";
	$DBName="Nueva_reservas";
	$DBUser="bunkerescape";
	$DBPass="Escapebunker23";
	$DBHost="localhost";
	$DBName="bunkervalladolid_es";
	$DBUser="root";
	$DBPass="";

*/

	$conexion = mysqli_connect($DBHost,$DBUser,$DBPass,$DBName) or die("Error de conexión");

	//Seleccionamos la Base de Datos
	//mysqli_select_db($conexion);
?>