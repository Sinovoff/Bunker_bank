function iniciaEtiquetas(){
	
	//****************************************************************************
	//****************************   Anadir  *************************************
	//****************************************************************************
	if($("#btnetiquetaAnadir").length){ 
		$(document).on("click", "#btnetiquetaAnadir", function(){
			
			$.post("./aj/aj_productosEtiquetas.php", { 
					tipofuncion:	"anadir",
					modelo:			$('#ModeloTablaEtiquetas').val(),
					registro_id:	$('#producto_id').val(),
					campo1:			$('#etiquetacampo1').val()
				},
				function(datos){
					$('#tablaEtiquetas').append(datos);
					$('#etiquetacampo1').val("");
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

	
	//****************************************************************************
	//************************   Modificar campos   ******************************
	//****************************************************************************
	$(document).on("click", ".divtextoetiqueta", function(){	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextoetiqueta_'+data+'_'+id).hide();
		$('#divinputetiqueta_'+data+'_'+id).show();
		$('#inputcampoetiqueta_'+data+'_'+id).focus();

		return false;
	});
	
	$(document).on("focusout", "input[name='inputcampoetiqueta']", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtextoetiqueta_'+data+'_'+id).show();
			$('#divinputetiqueta_'+data+'_'+id).hide();

		return false;
	});
	
	$(document).on("keydown", "input[name='inputcampoetiqueta']", function(e) {	
		if (e.keyCode == 13){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$.post("./aj/aj_productosEtiquetas.php", { 
					id:			id,
					tipofuncion:"modificar",
					modelo:		$('#ModeloTablaEtiquetas').val(),
					camponombre:data,
					campo:		$('#inputcampoetiqueta_'+data+'_'+id).val()
				},
				function(datos){
					$('#divtextoetiqueta_'+data+'_'+id).html(datos);
					$('#divtextoetiqueta_'+data+'_'+id).show();
					$('#divinputetiqueta_'+data+'_'+id).hide();
				}
			);	
			return false; 
		}else{
			if((e.keyCode < 0) || (e.keyCode > 256)){ 
				e.preventDefault(); 
			}
		}
	});


	//****************************************************************************
	//**************************   Eliminar  *************************************
	//****************************************************************************
	$(document).on("click", ".eliminarEtiqueta", function(){
		var elemento_id = $(this).attr("id");
		var superior = $(this).parents("tr");
		
		$.post("./aj/aj_productosEtiquetas.php", { 
				tipofuncion:"eliminar",
				elemento_id: elemento_id,
				modelo: $('#ModeloTablaEtiquetas').val()
			},
			function(datos){
				superior.animate({'backgroundColor':'#B0C4DE'},330).animate({ opacity: 0.10 }, "slow");
				superior.slideUp('slow', function() {$(this).parents("tr").remove();});
			}
		);
	
		return false; //Para que no se desplaze la pantalla
	});
	

};




$(document).ready(iniciaEtiquetas);