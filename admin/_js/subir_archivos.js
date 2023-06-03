function iniciaSubidaarchivos(){

	//***********************************************************************************************
	//**************************  Edicion de archivos multiples  ************************************
	//***********************************************************************************************
	//Subir archivos por jquery-ajax
	//anadir libreria jquery.form.js

	//Subir multiples archivos
	if($("#frmArchivos").length){ 
		$(document).on("click", "#btnarchivoAnadir", function(){	
			

			var progressbox 	= $('#progressboxarchivo');
			var progressbar 	= $('#progressbararchivo');
			var statustxt 		= $('#statustxtarchivo');
			var submitbutton 	= $("#btnarchivoAnadir");
			var myform 			= $("#frmArchivos");
			var completed 		= '0%';
			var output 			= $("#tablaArchivos");

			$("#frmArchivos").ajaxForm({
				beforeSend: function() { 
					submitbutton.attr('disabled', ''); // disable upload button
					statustxt.empty();
					progressbox.show(); //show progressbar
					progressbar.width(completed); //initial value 0% of progressbar
					statustxt.html(completed); //set status text
					statustxt.css('color','#000'); //initial color of status text
				},
				uploadProgress: function(event, position, total, percentComplete) { 
					progressbar.width(percentComplete + '%') //update progressbar percent complete
					statustxt.html(percentComplete + '%'); //update status text
					if(percentComplete>50){
						statustxt.css('color','#fff'); //change status text to white after 50%
					}
				},
				complete: function(response) {
					//superior.append(response.responseText); //Incluir si se anade etiquetas
					output.append(response.responseText);	  //Quitar si se anade etiquetas
					myform.resetForm();  // reset form
					submitbutton.removeAttr('disabled'); //enable submit button
					progressbox.hide(); // hide progressbar

					$("a.gallery").colorbox( {rel:'gallery', transition:"fade", opacity:1 } );
				}
			});
		});
	}


	//**********************************************************************************************
	//**************************   Eliminar archivos multiples  ************************************
	//**********************************************************************************************
	$(document).on("click", ".eliminarArchivo", function(){
		var elemento_id = $(this).attr("id");
		//var superior = $(this).parent('div');
		
		var partesid=elemento_id.split("_");
		var id=partesid[1];
		var superior = $('#cajaarchivos-'+id);		

		$.post("./aj/aj_archivosMultiples.php", { 
				elemento_id: elemento_id,
				directorio: $('#directorioarchivos').val(),
				tipofuncion: "eliminar",
				modelo: $('#ModeloTablaArchivos').val()
			},
			function(datos){//alert(datos);
				superior.animate({'backgroundColor':'#B0C4DE'},330).animate({ opacity: 0.10 }, "slow");
				superior.slideUp('slow', function() {$('#cajaimagenes_'+id).remove();});
			}
		);
	
		return false; //Para que no se desplaze la pantalla
	});


	//**********************************************************************************************
	//*******************************   Modificar campos   *****************************************
	//**********************************************************************************************
	$(document).on("click", ".divtextoarchivo", function(){	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextoarchivo_'+data+'_'+id).hide();
		$('#divinputarchivo_'+data+'_'+id).show();
		$('#inputcampoarchivo_'+data+'_'+id).focus();

		return false;
	});
	$(document).on("focusout", "input[name='inputcampoimagen']", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtextoarchivo_'+data+'_'+id).show();
			$('#divinputarchivo_'+data+'_'+id).hide();

		return false;
	});
	$(document).on("keydown", "input[name='inputcampoarchivo']", function(e) {	
		if (e.keyCode == 13){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$.post("./aj/aj_archivosMultiples.php", { 
					id:			id,
					tipofuncion:"modificar",
					modelo:		$('#ModeloTablaArchivos').val(),
					camponombre:data,
					campo:		$('#inputcampoarchivo_'+data+'_'+id).val()
				},
				function(datos){
					$('#divtextoarchivo_'+data+'_'+id).html(datos);
					$('#divtextoarchivo_'+data+'_'+id).show();
					$('#divinputarchivo_'+data+'_'+id).hide();
				}
			);	
			return false; 
		}else{
			if((e.keyCode < 0) || (e.keyCode > 256)){ 
				e.preventDefault(); 
			}
		}
	});
	//**********************************************************************************************
	//**********************************************************************************************
	//**********************************************************************************************

	//**********************************************************************************************
	//********************** Para ordenar con drag and drop las imagenes ***************************
	//**********************************************************************************************
	//Helper function to keep table row from collapsing when being sorted
	var fixHelperModifiedarchivos = function(e, tr) {  
		var $originals = tr.children();        
		var $helper = tr.clone();      
		
		$helper.children().each(function(index){
			$(this).width($originals.eq(index).width())
		});         
		return $helper;    
	};     
	
	$('#tablaArchivos').sortable({
		helper: fixHelperModifiedarchivos,  
		stop: function(event,ui) {
			renumber_table_archivos('#tablaArchivos');
				
			var order = $(this).sortable("serialize");
			var modelo=$('#ModeloTablaArchivos').val();
			$.post("./aj/aj_archivosMultiples.php", order+"&tipofuncion=ordenar&modelo="+modelo,
				function(datos){//alert(datos);
				}
			);
		}
	}).disableSelection(); 
	
	//Renumerar registros de la tabla 
	function renumber_table_archivos(tableID) {     
		$(tableID + " .cajaarchivos").each(function() {         
			count = $(this).parent().children().index($(this)) + 1;         
			$(this).find('.claseordenarchivo').html(count); 
		}); 
	}
};



$(document).ready(iniciaSubidaarchivos);