function iniciaSubidaimagenes(){

	//***********************************************************************************************
	//**************************  Edicion de Imagenes multiples  ************************************
	//***********************************************************************************************
	//Subir imagenes por jquery-ajax
	//anadir libreria jquery.form.js

	//Subir multiples imagenes
	if($("#frmImagenes").length){ 
		$(document).on("click", "#btnimagenAnadir", function(){	
			

			var progressbox 	= $('#progressbox');
			var progressbar 	= $('#progressbar');
			var statustxt 		= $('#statustxt');
			var submitbutton 	= $("#btnimagenAnadir");
			var myform 			= $("#frmImagenes");
			var completed 		= '0%';
			var output 			= $("#tablaImagenes");
			//var output 		= $("#tablaImagenes tbody"); //Incluir si se anade etiquetas
			//var superior		= output.parents("tbody");   //Incluir si se anade etiquetas

			$("#frmImagenes").ajaxForm({
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
	//**************************   Eliminar imagenes multiples  ************************************
	//**********************************************************************************************
	$(document).on("click", ".eliminarImagen", function(){
		var elemento_id = $(this).attr("id");
		//var superior = $(this).parent('div');
		
		var partesid=elemento_id.split("_");
		var id=partesid[1];
		var superior = $('#cajaimagenes-'+id);		

		$.post("./aj/aj_imagenesMultiples.php", { 
				elemento_id: elemento_id,
				directorio: $('#directorioimagenes').val(),
				tipofuncion: "eliminar",
				modelo: $('#ModeloTablaImagenes').val()
			},
			function(datos){
				superior.animate({'backgroundColor':'#B0C4DE'},330).animate({ opacity: 0.10 }, "slow");
				superior.slideUp('slow', function() {$('#cajaimagenes_'+id).remove();});
			}
		);
	
		return false; //Para que no se desplaze la pantalla
	});


	//**********************************************************************************************
	//*******************************   Modificar campos   *****************************************
	//**********************************************************************************************
	$(document).on("click", ".divtextoimagen", function(){	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextoimagen_'+data+'_'+id).hide();
		$('#divinputimagen_'+data+'_'+id).show();
		$('#inputcampoimagen_'+data+'_'+id).focus();

		return false;
	});
	$(document).on("focusout", "input[name='inputcampoimagen']", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtextoimagen_'+data+'_'+id).show();
			$('#divinputimagen_'+data+'_'+id).hide();

		return false;
	});	
	$(document).on("keydown", "input[name='inputcampoimagen']", function(e) {	
		if (e.keyCode == 13){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$.post("./aj/aj_imagenesMultiples.php", { 
					id:			id,
					tipofuncion:"modificar",
					modelo:		$('#ModeloTablaImagenes').val(),
					camponombre:data,
					campo:		$('#inputcampoimagen_'+data+'_'+id).val()
				},
				function(datos){
					$('#divtextoimagen_'+data+'_'+id).html(datos);
					$('#divtextoimagen_'+data+'_'+id).show();
					$('#divinputimagen_'+data+'_'+id).hide();
				}
			);	
			return false; 
		}else{
			if((e.keyCode < 0) || (e.keyCode > 256)){ 
				e.preventDefault(); 
			}
		}
	});

	//****** Para los select *********
	$(document).on("click", ".divtextoimagenselect", function(){
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextoimagenselect_'+data+'_'+id).hide();
		$('#divinputimagenselect_'+data+'_'+id).show();
		$('#inputcampoimagenselect_'+data+'_'+id).focus();

		return false;
	});
	$(document).on("focusout", ".inputcampoimagenselect", function(e) {	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextoimagenselect_'+data+'_'+id).show();
		$('#divinputimagenselect_'+data+'_'+id).hide();

		return false;
	});
	$(document).on("change", ".inputcampoimagenselect", function(e) {	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		if(data=="coloreid")	camponombre="colore_id";
		else					camponombre=data;

		$.post("./aj/aj_imagenesMultiples.php", { 
				id:			id,
				tipofuncion:"modificar",
				modelo:		$('#ModeloTablaImagenes').val(),
				camponombre:camponombre,
				campo:		$('#inputcampoimagenselect_'+data+'_'+id).val()
			},
			function(datos){
				$('#divtextoimagenselect_'+data+'_'+id).html(datos);
				$('#divtextoimagenselect_'+data+'_'+id).show();
				$('#divinputimagenselect_'+data+'_'+id).hide();
			}
		);	

		return false;
	});
	//**********************************************************************************************
	//**********************************************************************************************
	//**********************************************************************************************


	//Cambio del estado del campo agotado de si a no
	if($(".cambiarcampoagotado").length){ 
		$(document).on("click", ".cambiarcampoagotado", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var campo=partesid[0];
			var id=partesid[1];

			$.post("./aj/aj_cambiarCampo.php", { 
					id: id,
					campo:campo,
					modelo:$('#ModeloTablaImagenes').val()
				},
				function(datos){
					if(datos=="1")	$('#'+elemento_id).html("<img src=\"images/activo.gif\"  alt=\"imagen\" />");
					else 			$('#'+elemento_id).html("<img src=\"images/activono.gif\" alt=\"imagen\" />");					
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}
	//**********************************************************************************************
	//**********************************************************************************************
	//**********************************************************************************************

	//**********************************************************************************************
	//********************** Para ordenar con drag and drop las imagenes ***************************
	//**********************************************************************************************
	//Helper function to keep table row from collapsing when being sorted
	var fixHelperModifiedimagenes = function(e, tr) {  
		var $originals = tr.children();        
		var $helper = tr.clone();      
		
		$helper.children().each(function(index){
			$(this).width($originals.eq(index).width())
		});         
		return $helper;    
	};     
	
	$('#tablaImagenes').sortable({
		helper: fixHelperModifiedimagenes,  
		stop: function(event,ui) {
			renumber_table_imagenes('#tablaImagenes');
				
			var order = $(this).sortable("serialize");
			var modelo=$('#ModeloTablaImagenes').val();
			$.post("./aj/aj_imagenesMultiples.php", order+"&tipofuncion=ordenar&modelo="+modelo,
				function(datos){//alert(datos);
				}
			);
		}
	}).disableSelection(); 
	
	//Renumerar registros de la tabla 
	function renumber_table_imagenes(tableID) {     
		$(tableID + " .cajaimagenes").each(function() {         
			count = $(this).parent().children().index($(this)) + 1;         
			$(this).find('.claseordenimagenes').html("<strong>"+count+"</strong>"); 
		}); 
	}

};



$(document).ready(iniciaSubidaimagenes);