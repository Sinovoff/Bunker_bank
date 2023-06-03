function iniciaUsuariosdirecciones(){	
	//*****************  Usuariosdirecciones  *******************************
	if($("#diveditardireccion").length){ 
		$("#diveditardireccion").hide('normal');
	}

	if($("#anadirusuariodireccion").length){ 
		$(document).on("click", "#anadirusuariodireccion", function(){	
			if($("#anadirusuariodireccion").attr("data")=="anadir"){
				$("#anadirusuariodireccion").html("Ocultar");
				$("#anadirusuariodireccion").attr("data","ocultar");
				$("#diveditardireccion").show('normal');
			}else{
				$("#anadirusuariodireccion").html('<span class="glyphicon glyphicon-plus"></span> A&ntilde;adir</span>');
				$("#anadirusuariodireccion").attr("data","anadir");
				$("#diveditardireccion").hide('normal');
			}
		});
	}

	if($("#btnusuariodireccionAnadir").length){ 
		$(document).on("click", "#btnusuariodireccionAnadir", function(){	
			$.post("./aj/aj_usuariosDirecciones.php", { 
					tipofuncion:	"anadir",
					modelo:			$('#ModeloTablaUsuario').val(),
					registro_id:	$('#usuario_id').val(),
					direccionalias:	$('#direccionalias').val(),
					nombre:			$('#nombredireccion').val(),
					empresa:		$('#empresa').val(),
					nif:			$('#nif').val(),
					direccion:		$('#direccion').val(),
					cp:				$('#cp').val(),
					poblacion:		$('#poblacion').val(),
					provincia:		$('#provincia').val(),
					paise_id:		$('#paiseid').val(),
					telefono1:		$('#telefono1').val(),
					telefono2:		$('#telefono2').val(),
				},
				function(datos){//alert(datos);
					$('#tablaUsuariosdirecciones').append(datos);

					$("#anadirusuariodireccion").html('<span class="glyphicon glyphicon-plus"></span> A&ntilde;adir</span>');
					$("#anadirusuariodireccion").attr("data","anadir");
					$("#diveditardireccion").hide('normal');
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

	if($(".eliminarUsuariodireccion").length){
		$(document).on("click", ".eliminarUsuariodireccion", function(){	
			var elemento_id = $(this).attr("id");
			var superior = $(this).parents("tr");
			
			$.post("./aj/aj_usuariosDirecciones.php", { 
					tipofuncion:"eliminar",
					elemento_id: elemento_id,
					modelo: $('#ModeloTablaUsuario').val()
				},
				function(datos){
					superior.animate({'backgroundColor':'#B0C4DE'},330).animate({ opacity: 0.10 }, "slow");
					superior.slideUp('slow', function() {$(this).parents("tr").remove();});
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

	
	$(".divtexto").on('click', function () {
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		$('#divtexto_'+data+'_'+id).hide();
		$('#divinput_'+data+'_'+id).show();
		$('#inputcampo_'+data+'_'+id).focus();

		return false;
	});
	$("input[name='inputcampo']").on('focusout', function () {
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtexto_'+data+'_'+id).show();
			$('#divinput_'+data+'_'+id).hide();

		return false;
	});
	$("input[name='inputcampo']").on('keydown', function (e) {	
		if (e.keyCode == 13){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$.post("./aj/aj_usuariosDirecciones.php", { 
					id:			id,
					tipofuncion:"modificar",
					modelo:		$('#ModeloTablaUsuario').val(),
					camponombre:data,
					campo:		$('#inputcampo_'+data+'_'+id).val()
				},
				function(datos){
					$('#divtexto_'+data+'_'+id).html(datos);
					$('#divtexto_'+data+'_'+id).show();
					$('#divinput_'+data+'_'+id).hide();
				}
			);	
			return false; 
		}else{
			if((e.keyCode < 0) || (e.keyCode > 256)){ 
				e.preventDefault(); 
			}
		}
	});
	$(".inputcamposelect").on('focusout', function () {
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var id=partesid[2];
			var data=$(this).attr("data");

			$('#divtexto_'+data+'_'+id).show();
			$('#divinput_'+data+'_'+id).hide();

		return false;
	});
	$(".inputcamposelect").on('change', function () {
		var elemento_id = $(this).attr("id");
		var partesid=elemento_id.split("_");
		var id=partesid[2];
		var data=$(this).attr("data");

		if(data=="provincia")	camponombre="provincia";
		else					camponombre=data;

		$.post("./aj/aj_usuariosDirecciones.php", { 
				id:			id,
				tipofuncion:"modificar",
				modelo:		$('#ModeloTablaUsuario').val(),
				camponombre:camponombre,
				campo:		$('#inputcampo_'+data+'_'+id).val()
			},
			function(datos){//alert(datos);
				$('#divtexto_'+data+'_'+id).html(datos);
				$('#divtexto_'+data+'_'+id).show();
				$('#divinput_'+data+'_'+id).hide();
			}
		);	

		return false;
	});

	//Cambio del estado del campo predeterminado de si a no
	if($(".cambiarcampopredeterminado").length){ 
		$(document).on("click", ".cambiarcampopredeterminado", function(){
			var elemento_id = $(this).attr("id");
			var partesid=elemento_id.split("_");
			var campo=partesid[0];
			var id=partesid[1];

			$.post("./aj/aj_cambiarCampo.php", { 
					id: id,
					campo:campo,
					modelo:$('#ModeloTablaUsuario').val()
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

$(document).ready(iniciaUsuariosdirecciones);