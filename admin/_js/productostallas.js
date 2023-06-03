function iniciaTallas(){
	
	//****************************************************************************
	//****************************   Anadir  *************************************
	//****************************************************************************
	if($("#btntallaAnadir").length){ 
		$(document).on("click", "#btntallaAnadir", function(){
			
			$.post("./aj/aj_productosTallas.php", { 
					tipofuncion:	"anadir",
					modelo:			$('#ModeloTablaTallas').val(),
					registro_id:	$('#producto_id').val(),
					campo1:			$('#tallacampo1').val(),
					campo2:			$('#tallacampo2').val(),
					campo3:			$('#tallacampo3').val()
				},
				function(aDatos){//alert(aDatos);
					var arrayDatos = JSON.parse(aDatos);

					$('#tablaTallas').append(arrayDatos.texto);
					$('#tallacampo1').val("0");
					$('#tallacampo2').val("");
					$('#tallacampo3').val("");

					//Para el stock
					$('#stockcampo1').html(arrayDatos.seleccolorstock);
					$('#stockcampo2').html(arrayDatos.selectallastock);
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

	
	//****************************************************************************
	//************************   Modificar campos   ******************************
	//****************************************************************************
	$(document).on("click", ".divtextotalla", function(){
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextotalla_'+data+'_'+id).hide();
		$('#divinputtalla_'+data+'_'+id).show();
		$('#inputcampotalla_'+data+'_'+id).focus();

		return false;
	});
	
	$(document).on("focusout", "input[name='inputcampotalla']", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtextotalla_'+data+'_'+id).show();
			$('#divinputtalla_'+data+'_'+id).hide();

		return false;
	});
	
	$(document).on("keydown", "input[name='inputcampotalla']", function(e) {	
		if (e.keyCode == 13){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$.post("./aj/aj_productosTallas.php", { 
					id:			id,
					tipofuncion:"modificar",
					modelo:		$('#ModeloTablaTallas').val(),
					camponombre:data,
					campo:		$('#inputcampotalla_'+data+'_'+id).val()
				},
				function(datos){
					$('#divtextotalla_'+data+'_'+id).html(datos);
					$('#divtextotalla_'+data+'_'+id).show();
					$('#divinputtalla_'+data+'_'+id).hide();
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
	$(document).on("click", ".divtextotallaselect", function(){
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextotallaselect_'+data+'_'+id).hide();
		$('#divinputtallaselect_'+data+'_'+id).show();
		$('#inputcampotallaselect_'+data+'_'+id).focus();

		return false;
	});
	$(document).on("focusout", ".inputcampotallaselect", function(e) {	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtextotallaselect_'+data+'_'+id).show();
		$('#divinputtallaselect_'+data+'_'+id).hide();

		return false;
	});
	$(document).on("change", ".inputcampotallaselect", function(e) {	
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		if(data=="tallaid")	camponombre="talla_id";
		else				camponombre=data;

		$.post("./aj/aj_productosTallas.php", { 
				id:			id,
				tipofuncion:"modificar",
				modelo:		$('#ModeloTablaTallas').val(),
				camponombre:camponombre,
				campo:		$('#inputcampotallaselect_'+data+'_'+id).val()
			},
			function(datos){
				$('#divtextotallaselect_'+data+'_'+id).html(datos);
				$('#divtextotallaselect_'+data+'_'+id).show();
				$('#divinputtallaselect_'+data+'_'+id).hide();
			}
		);	

		return false;
	});


	//****************************************************************************
	//**************************   Eliminar  *************************************
	//****************************************************************************
	if($(".eliminarTalla").length){ 
		$(document).on("click", ".eliminarTalla", function(){
			var elemento_id = $(this).attr("id");
			var superior = $(this).parents("tr");
			
			$.post("./aj/aj_productosTallas.php", { 
					tipofuncion:"eliminar",
					elemento_id: elemento_id,
					modelo: $('#ModeloTablaTallas').val()
				},
				function(datos){
					superior.animate({'backgroundColor':'#B0C4DE'},330).animate({ opacity: 0.10 }, "slow");
					superior.slideUp('slow', function() {$(this).parents("tr").remove();});
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

};




$(document).ready(iniciaTallas);