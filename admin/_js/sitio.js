var repeticion;

function iniciaAdmin(){
	//**** Datepicker ***************
	$(function(){
		$('#dp').datepicker({format: 'dd-mm-yyyy',weekStart:1});	
		$('#dp1').datepicker({format: 'dd-mm-yyyy',weekStart:1});	
	});

	//**** Color box ***************
	jQuery(document).ready(function () {
		$("a.gallery").colorbox( {rel:'gallery', transition:"fade", opacity:1 } );
	});

	//******** tinymce ************************
	tinymce.init({
		selector: "textarea.tinymce",
		content_css : "_css/editor-tiny_mce.css",
		language : "es",
		//width : 554,
		//force_p_newlines : false,
		//forced_root_block : 'p',
		menubar : false,
		toolbar: "undo redo | bold italic underline strikethrough | forecolor | alignleft aligncenter alignright alignjustify | bullist numlist  | link | paste | code",
		plugins : 'link image paste textcolor code',
		rel_list: [
			{title: 'Ninguno', value: ''},
			{title: 'No Follow', value: 'nofollow'}
		],
		convert_urls: false,
		paste_as_text: true,//Para pegar como texto plano
		branding: false,		//Quita la etiqueta de "Powered by TinyMCE"
		//image_list: "/listado_imagenes.php?opcion=<?echo $opcion?>&id=<?echo $_GET['id']?>"
	});
	//**************************************************


	//Para los tab
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});

	//Cambio del estado del campo de si a no
	if($(".cambiarcampo").length){ 
		$(document).on("click", ".cambiarcampo", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var campo=partesid[0];
			var id=partesid[1];

			$.post("./aj/aj_cambiarCampo.php", { 
					id: id,
					campo:campo,
					modelo:$('#ModeloTabla').val()
				},
				function(datos){
					if(campo=="emailok"){
						if(datos=="1")	$('#'+elemento_id).html("<img src=\"images/emailok.png\"  alt=\"imagen\" />");
						else 			$('#'+elemento_id).html("<img src=\"images/activono.gif\" alt=\"imagen\" />");
					}else{
						if(datos=="1")	$('#'+elemento_id).html("<img src=\"images/activo.gif\"  alt=\"imagen\" />");
						else 			$('#'+elemento_id).html("<img src=\"images/activono.gif\" alt=\"imagen\" />");
					}
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}


	//Cambio el estado del pedido
	if($(".cambiarestado").length){ 
		$(document).on("click", ".cambiarestado", function(){
			var resultado=confirm("Se cambiará el estado y se enviará un email al usuario indicando que ya ha salido el pedido o bien que su pedido esta listo en la tienda seleccionada. ¿Desea cambiar el estado?");

			if(resultado==true){
				var elemento_id = $(this).attr("id");
				var partesid=elemento_id.split("_");
				var campo=partesid[0];
				var id=partesid[1];

				$.post("./aj/aj_cambiarEstado.php", { 
						id: id,
						campo:campo,
						enviaremail:"si",
						modelo:$('#ModeloTabla').val()
					},
					function(datos){
						if(datos=="1")	$('#'+elemento_id).html('<strong><span class="azul">Pendiente</span></strong>');
						if(datos=="2")	$('#'+elemento_id).html('<strong><span class="verde">Enviado</span></strong>');
					}
				);
			}

			return false; //Para que no se desplaze la pantalla
		});
	}

	//********** Generar contrasena ***********************
	if($("#generarcontrasena").length){
		var rand = function (str) {
			return str[Math.floor (Math.random () * str.length)];
		};

		var get = function (source, len, a) {
			for (var i = 0; i < len; i++)
				a.push (rand (source));
			return a;
		};

		var alpha  = function (len, a) {
			return get ("Aa1BbCcDd2EeFfGg3HhJj4KkLMm5NnoPp6QqRrSs7TtUuVv8WwXxYy9Zz", len, a);
		};
		var symbol = function (len, a) {
			return get ("-:;_$!&@", len, a);
		};

		$('#generarcontrasena').on('click', function(event) {
			event.preventDefault ();
			var length=7;

			// Alpha{ceil((length-1)/2))} Symbol Alpha{floor((length-1)/(2))}
			var l = Math.floor (length/2), r = Math.ceil (length/2);
			var password = alpha (l, symbol (1, alpha (r, []))).join('');


			$('#password').val(password);
			//$('#passwordrepe').val(password);
		});
	}
	//*****************************************************

	//********************** Para ordenar con drag and drop ***************************
	//Helper function to keep table row from collapsing when being sorted
	var fixHelperModified = function(e, tr) {  
		var $originals = tr.children();        
		var $helper = tr.clone();         
		$helper.children().each(function(index){           
			$(this).width($originals.eq(index).width())
		});         
		return $helper;    
	};     
	
	//Make diagnosis table sortable     
	$("#tablaorden tbody").sortable({

		helper: fixHelperModified,        
		stop: function(event,ui) {
			renumber_table('#tablaorden');
				
			/*var order = $(this).sortable("serialize");
			$.post("./aj/aj_ordentabla.php", order, 
				function(datos){alert(datos);
				}
			);*/
			
			var seccione_id;
			var categoria_id;
			var subcategoria_id;
			var hospitalesseccione_id;
			var hospitalescategoria_id;

			if ($('#seccioneindex_id').val()==undefined)		seccione_id="";
			else												seccione_id=$('#seccioneindex_id').val();
			if ($('#categoriaindex_id').val()==undefined)		categoria_id="";
			else												categoria_id=$('#categoriaindex_id').val();
			if ($('#subcategoriaindex_id').val()==undefined)	subcategoria_id="";
			else												subcategoria_id=$('#subcategoriaindex_id').val();

			if ($('#hospitalesseccioneindex_id').val()==undefined)		hospitalesseccione_id="";
			else														hospitalesseccione_id=$('#hospitalesseccioneindex_id').val();
			if ($('#hospitalescategoriaindex_id').val()==undefined)		hospitalescategoria_id="";
			else														hospitalescategoria_id=$('#hospitalescategoriaindex_id').val();
			if ($('#hospitalessubcategoriaindex_id').val()==undefined)	hospitalessubcategoria_id="";
			else														hospitalessubcategoria_id=$('#hospitalessubcategoriaindex_id').val();


			var order = $(this).sortable("serialize");
			var modelo=$('#ModeloTabla').val();
			$.post("./aj/aj_ordentabla.php", order+"&modelo="+modelo+"&seccione_id="+seccione_id+"&categoria_id="+categoria_id+"&subcategoria_id="+subcategoria_id+"&hospitalesseccione_id="+hospitalesseccione_id+"&hospitalescategoria_id="+hospitalescategoria_id+"&hospitalessubcategoria_id="+hospitalessubcategoria_id,
				function(datos){//alert(datos);
				}
			);
		}
	}).disableSelection();   
	
	//Se usa el eliminar del controlador - Delete button in table rows
	/*$('table').on('click','.eliminarorden',function() {         
		tableID = '#' + $(this).closest('table').attr('id');
		
		r = confirm('¿Estás seguro que deseas eliminar el registro?');         
		if(r) {             
			$(this).closest('tr').remove();             
			renumber_table(tableID); 
		}    
	});*/

	//Renumerar registros de la tabla 
	function renumber_table(tableID) {     
		$(tableID + " tr").each(function() {         
			count = $(this).parent().children().index($(this)) + 1;         
			$(this).find('.claseorden').html(count); 
		}); 
	}
	//***************************************************************************************
};

function valorEtiqueta(id){
	$('#galeriasimagene_id').val(id);
}
function valorEtiquetaVideo(id){
	$('#video_id').val(id);
}
function valorRegistro(id){
	$('#idRegistro').val(id);
	$('#idRegistroprueba').val(id);
	$('#enviandoBoletines').html("");
	$('#barra').attr('style',0);
	$('#resultadodelenvio').html("");
	$('#enviandoBoletinesprueba').html("");
	$('#barraprueba').attr('style',0);
}


//****Eliminar imagen
function eliminarImagen(elemento, directorio, campo, modelo, id, nombrefile){
		$(elemento).css('display', 'none');
		$(elemento).parent().css('background-image', 'url(images/ajax-loader.gif)');
		$(elemento).parent().css('background-repeat', 'no-repeat');
		$(elemento).parent().css('background-position', '50% 50%');
		
		
		$.ajax({
			type: "GET",
			url:   "./aj/aj_eliminarImagen.php",
			data:  "directorio="+directorio+"&campo="+campo+"&modelo="+modelo+"&id="+id+"&nombrefile="+nombrefile,
			method: "get",
			async:false,
			success: function( datos ){
				//Quitar imagen de transicion
				$(elemento).css('display', '');
				$(elemento).parent().css('background-image', 'none');
				//Cargar resultado
				$(elemento).html( datos );				
			}
		});
		
}		


function confirmareliminar(mensaje) { 
	return confirm(mensaje); 
} 

function confirmarcopiar(mensaje) { 
	return confirm(mensaje); 
} 

function confirmarenvioemailacceso(mensaje, usuario_id) { 
	if(confirm(mensaje)){
		$.post("./aj/aj_enviarEmailAcceso.php", { 
				usuario_id: usuario_id
			},
			function(datos){
				alert(datos);
				$('#activo_'+usuario_id).html("<img src=\"images/activo.gif\"  alt=\"imagen\" />");
			}
		);
	}
	return false; 
} 

$(document).ready(iniciaAdmin);