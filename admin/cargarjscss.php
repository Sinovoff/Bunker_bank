<link type="text/css" rel="stylesheet" href="_css/bootstrap_3.1.0.css" >
<link type="text/css" rel="stylesheet" href="_css/estilo_admin.css" >


<script type="text/javascript" src="_js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="_js/jquery.form-4.0.1.min.js"></script>
<script type="text/javascript" src="_js/jquery-ui-1.12.1.min.js"></script>
<script type="text/javascript" src="_js/bootstrap.min.js"></script>

<link   type="text/css" rel="stylesheet" href="_css/datepicker.css">
<script type="text/javascript" src="_js/bootstrap-datepicker.js"></script>
<link   type="text/css" rel="stylesheet" href="_css/colorbox.css" />
<script type="text/javascript" src="_js/jquery.colorbox.js"></script>
<script type="text/javascript" src="_js/tinymce/tinymce.min.js"></script>

<link   type="text/css" rel="stylesheet" href="_js/color-picker/css/colorPicker.css" >
<script type="text/javascript" src="_js/color-picker/js/colorPicker.js"></script>
	
<script type="text/javascript" src="_js/sitio.js"></script>
<script type="text/javascript" src="_js/subir_imagenes.js"></script>
<script type="text/javascript" src="_js/subir_archivos.js"></script>

<?switch($opcion){

	case "usuarios":?>
		<script type="text/javascript" src="_js/usuariosdirecciones.js"></script>
		<script type="text/javascript" src="_js/validaciones.js"></script>
		<?break;
	
	case "reservas":case "eventos":?>
		<script type="text/javascript" src="_js/validaciones.js"></script>
		<?break;

	case "noticias":?>
		<script type="text/javascript" src="_js/gruposmultiples.js"></script>
		<?break;
	
	case "productos":?>
		<script type="text/javascript" src="_js/categoriasmultiples.js"></script>
		<script type="text/javascript" src="_js/productosetiquetas.js"></script>
		<?break;

	case "salas":?>
		<script type="text/javascript" src="_js/salashoras.js"></script>
		<?break;

	case "":case "#":?> 
		<?break;

}?>