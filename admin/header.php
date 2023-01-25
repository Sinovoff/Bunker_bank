<?require_once('init.php');
require_once('funciones.php');
require_once('funciones_imagenes.php');
require_once('f_paginacion.php');

if (!empty($_GET['opcion']))	$opcion=$_GET['opcion'];
else							$opcion=$_POST['opcion'];

if (!empty($_GET['tipofunc']))	$tipofunc=$_GET['tipofunc'];
else							$tipofunc=$_POST['tipofunc'];

if (!empty($_GET['tipopro']))	$tipopro=$_GET['tipopro'];
else							$tipopro=$_POST['tipopro'];
?>

<!DOCTYPE html>
<html lang="es-es">

<head>
	<title>The Bunker Escape Room - Zona de administración</title>

	<meta charset="utf-8">
	<meta http-equiv="Expires" content="0">
	<meta http-equiv="Last-Modified" content="0">
	<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
	<meta http-equiv="Pragma" content="no-cache">

	<?include("cargarjscss.php")?>
</head>

<body>
<div class="container">
  
	<?//***  Menu nav   ********?>
	<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">&nbsp;Zona Admin&nbsp;</a>
		</div>

		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">

				<?if (($opcion=="reservas") ||($opcion=="")) $claseactivo='active'; else $claseactivo='';?>
				<li class="<? echo $claseactivo?>"><a href="index.php?opcion=reservas"><img src="images/calendario.png" /> Reservas</a></li>

				<?if ($opcion=="eventos") $claseactivo='active'; else $claseactivo='';?>
				<li class="<? echo $claseactivo?>"><a href="index.php?opcion=eventos"><img src="images/textos.png" /> Sala Eventos</a></li>

				<?if ($opcion=="salas") $claseactivo='active'; else $claseactivo='';?>
				<li class="<? echo $claseactivo?>"><a href="index.php?opcion=salas"><img src="images/casa.png" /> Salas</a></li>

				<?if ($opcion=="cupones") $claseactivo='active'; else $claseactivo='';?>
				<li class="<? echo $claseactivo?>"><a href="index.php?opcion=cupones"><img src="images/entrada.png" /> Cupones</a></li>

				<?if ($opcion=="galerias") $claseactivo='active'; else $claseactivo='';?>
				<li class="<? echo $claseactivo?>"><a href="index.php?opcion=galerias"><img src="images/foto.png" /> Galería</a></li>

				<?if ($opcion=="calendarios") $claseactivo='active'; else $claseactivo='';?>
				<li class="<? echo $claseactivo?>"><a href="index.php?opcion=calendarios"><img src="images/calendario.png" /> Calendario</a></li>
				
			</ul>
		</div>
	</nav>

	<?//***  Cuerpo   ********?>