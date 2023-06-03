/* -------------------------------------------------------------------------------------------
------------------------ FUNCIONES DE VALIDACION DE CAMPOS -----------------------------------
------------------------------------------------------------------------------------------- */ 
function iniciaValidaciones(){

	if($('#paise_id').length){
		ocultarinputprovincias("");
	}

	if($('#profesional_paise_id').length){
		ocultarinputprovincias("profesional");
	}
		
	$(".paise_id").on('change', function () {	
		var elemento=$(this).attr("id");
		var partesid=elemento.split("_");
		if ((partesid[0]=="comprador")||(partesid[0]=="destinatario")||(partesid[0]=="profesional")){
			parte=partesid[0]+"_";
		}else{
			parte="";
		}
		if ($("#"+parte+"paise_id").val()=="69"){			
			$("#"+parte+"provincia").attr('name',parte+'provinciatexto');
			$("#"+parte+"provincia").attr('id',parte+'provinciatexto');

			$("#"+parte+"poblacion").attr('name',parte+'poblaciontexto');
			$("#"+parte+"poblacion").attr('id',parte+'poblaciontexto');

			$("#"+parte+"provinciaselect").attr('name',parte+'provincia');
			$("#"+parte+"provinciaselect").attr('id',parte+'provincia');

			$("#"+parte+"poblacionselect").attr('name',parte+'poblacion');
			$("#"+parte+"poblacionselect").attr('id',parte+'poblacion');
		
			$("#"+parte+"provincia").show();
			$("#"+parte+"provinciatexto").hide();

			$("#"+parte+"poblacion").show();
			$("#"+parte+"poblaciontexto").hide();

			//$("#"+parte+"cp").removeClass("obligatorio");
			//$("#"+parte+"cp").addClass("ob_cp_provincia");

			$("#"+parte+"provinciatexto").removeClass("obligatorio");
			$("#"+parte+"provincia").addClass("obligatorio");

			$("#"+parte+"poblaciontexto").removeClass("obligatorio");
			$("#"+parte+"poblacion").addClass("obligatorio");

		}else{
			if ($("#"+parte+"provinciaselect").length== 0) {
				$("#"+parte+"provincia").attr('name',parte+'provinciaselect');
				$("#"+parte+"provincia").attr('id',parte+'provinciaselect');				
				
				$("#"+parte+"provinciatexto").attr('name',parte+'provincia');
				$("#"+parte+"provinciatexto").attr('id',parte+'provincia');

				$("#"+parte+"provinciaselect").removeClass("obligatorio");
				$("#"+parte+"provincia").addClass("obligatorio");

				$("#"+parte+"poblacion").attr('name',parte+'poblacionselect');
				$("#"+parte+"poblacion").attr('id',parte+'poblacionselect');				
				
				$("#"+parte+"poblaciontexto").attr('name',parte+'poblacion');
				$("#"+parte+"poblaciontexto").attr('id',parte+'poblacion');

				$("#"+parte+"poblacionselect").removeClass("obligatorio");
				$("#"+parte+"poblacion").addClass("obligatorio");
			}
			$("#"+parte+"provincia").show();
			$("#"+parte+"provinciaselect").hide();
			$("#"+parte+"poblacion").show();
			$("#"+parte+"poblacionselect").hide();
			//$("#"+parte+"cp").removeClass("ob_cp_provincia");
			//$("#"+parte+"cp").addClass("obligatorio");
		}
	});

	//**Provincia-poblacion
	$('.provincia').on('change', function () {
		var elemento=$(this).attr("id");
		var partesid=elemento.split("_");
		if ((partesid[0]=="comprador")||(partesid[0]=="destinatario")||(partesid[0]=="profesional")){
			parte=partesid[0]+"_";
		}else{
			parte="";
		}

		$.post("aj/aj_cambiarProvincia.php", { 
				provincia:$("#"+parte+"provincia").val()
			},
			function(datos){
				$("#"+parte+"poblacion").html(datos);				
			}
		);
	});
    	
}

function ocultarinputprovincias(parte){
	if ((parte=="comprador")||(parte=="destinatario")||(parte=="profesional")){
		parte=parte+"_";
	}else{
		parte="";
	}

	if ($("#"+parte+"paise_id").val()=="69"){
		$("#"+parte+"provincia").show();
		$("#"+parte+"provinciatexto").hide();

		$("#"+parte+"poblacion").show();
		$("#"+parte+"poblaciontexto").hide();
	}else{			
		$("#"+parte+"provincia").attr('name',parte+'provinciaselect');
		$("#"+parte+"provincia").attr('id',parte+'provinciaselect');
				
		$("#"+parte+"provinciatexto").attr('name',parte+'provincia');
		$("#"+parte+"provinciatexto").attr('id',parte+'provincia');

		$("#"+parte+"provinciaselect").removeClass("obligatorio");
		$("#"+parte+"provincia").addClass("obligatorio");

		$("#"+parte+"provincia").show();
		$("#"+parte+"provinciaselect").hide();

		$("#"+parte+"poblacion").attr('name',parte+'poblacionselect');
		$("#"+parte+"poblacion").attr('id',parte+'poblacionselect');
				
		$("#"+parte+"poblaciontexto").attr('name',parte+'poblacion');
		$("#"+parte+"poblaciontexto").attr('id',parte+'poblacion');

		$("#"+parte+"poblacionselect").removeClass("obligatorio");
		$("#"+parte+"poblacion").addClass("obligatorio");

		$("#"+parte+"poblacion").show();
		$("#"+parte+"poblacionselect").hide();

		//$("#"+parte+"cp").removeClass("ob_cp_provincia");
		//$("#"+parte+"cp").addClass("obligatorio");
	}
}

/* -------------------------------------------------------------------------------------------
------------------------ LOAD ----------------------------------------------------------------
------------------------------------------------------------------------------------------- */
$(document).ready(iniciaValidaciones);