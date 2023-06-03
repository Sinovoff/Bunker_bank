function iniciaHoras(){
	
	//****************************************************************************
	//****************************   Anadir  *************************************
	//****************************************************************************
	if($("#btnhoraAnadir").length){ 
		$(document).on("click", "#btnhoraAnadir", function(){
			$.post("./aj/aj_salasHoras.php", { 
					tipofuncion:	"anadir",
					modelo:			$('#ModeloTablaHoras').val(),
					registro_id:	$('#sala_id').val(),
					campo1:			$('#horacampo1').val(),
					campo2:			$('#horacampo2').val(),
				},
				function(aDatos){//alert(aDatos);
					var arrayDatos = JSON.parse(aDatos);

					$('#tablaHoras').append(arrayDatos.texto);
					$('#horacampo1').val("");
					$('#horacampo2').val("");
					$('#horacampo1').focus();
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

	
	//****************************************************************************
	//************************   Modificar campos   ******************************
	//****************************************************************************
	$(document).on("click", ".divtextohora", function(){	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextohora_'+data+'_'+id).hide();
		$('#divinputhora_'+data+'_'+id).show();
		$('#inputcampohora_'+data+'_'+id).focus();

		return false;
	});
	
	$(document).on("focusout", "input[name='inputcampohora']", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtextohora_'+data+'_'+id).show();
			$('#divinputhora_'+data+'_'+id).hide();

		return false;
	});
	
	$(document).on("keydown", "input[name='inputcampohora']", function(e) {	
		if (e.keyCode == 13){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$.post("./aj/aj_salasHoras.php", { 
					id:			id,
					tipofuncion:"modificar",
					modelo:		$('#ModeloTablaHoras').val(),
					camponombre:data,
					campo:		$('#inputcampohora_'+data+'_'+id).val()
				},
				function(datos){
					$('#divtextohora_'+data+'_'+id).html(datos);
					$('#divtextohora_'+data+'_'+id).show();
					$('#divinputhora_'+data+'_'+id).hide();
				}
			);	
			return false; 
		}else{
			if((e.keyCode < 0) || (e.keyCode > 256)){ 
				e.preventDefault(); 
			}
		}
	});

	//Para los select
	$(document).on("click", ".divtextohoraselect", function(){
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextohoraselect_'+data+'_'+id).hide();
		$('#divinputhoraselect_'+data+'_'+id).show();
		$('#inputcampohoraselect_'+data+'_'+id).focus();

		return false;
	});
	$(document).on("focusout", ".inputcampohoraselect", function(e) {	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextohoraselect_'+data+'_'+id).show();
		$('#divinputhoraselect_'+data+'_'+id).hide();

		return false;
	});
	$(document).on("change", ".inputcampohoraselect", function(e) {
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		if(data=="horaid")		camponombre="hora_id";
		else						camponombre=data;

		$.post("./aj/aj_salasHoras.php", { 
				id:			id,
				tipofuncion:"modificar",
				modelo:		$('#ModeloTablaHoras').val(),
				camponombre:camponombre,
				campo:		$('#inputcampohoraselect_'+data+'_'+id).val()
			},
			function(datos){
				$('#divtextohoraselect_'+data+'_'+id).html(datos);
				$('#divtextohoraselect_'+data+'_'+id).show();
				$('#divinputhoraselect_'+data+'_'+id).hide();
			}
		);	

		return false;
	});


	//****************************************************************************
	//**************************   Eliminar  *************************************
	//****************************************************************************
	$(document).on("click", ".eliminarHora", function(){
		var elemento_id = $(this).attr("id");
		var superior = $(this).parents("tr");
		
		$.post("./aj/aj_salasHoras.php", { 
				tipofuncion:"eliminar",
				elemento_id: elemento_id,
				modelo: $('#ModeloTablaHoras').val()
			},
			function(datos){//alert(datos);
				superior.animate({'backgroundColor':'#B0C4DE'},330).animate({ opacity: 0.10 }, "slow");
				superior.slideUp('slow', function() {$(this).parents("tr").remove();});
			}
		);
	
		return false; //Para que no se desplaze la pantalla
	});

	//****************************************************************************
	//********************  Cambiar campos booleanos  ****************************
	//****************************************************************************
	if($(".cambiarcampohora").length){ 
		$(document).on("click", ".cambiarcampohora", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var campo=partesid[0];
			var id=partesid[1];

			$.post("./aj/aj_cambiarCampo.php", { 
					id: id,
					campo:campo,
					modelo:$('#ModeloTablaHoras').val()
				},
				function(datos){
					if(datos=="1")	$('#'+elemento_id).html("<img src=\"images/activo.gif\"  alt=\"imagen\" />");
					else 			$('#'+elemento_id).html("<img src=\"images/activono.gif\" alt=\"imagen\" />");
				
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}
	

};




$(document).ready(iniciaHoras);