//************** NOTICIAS- GRUPO ************************
function iniciaGruposmultiples(){	

	if($("#btnAnadirnoticiagrupo").length){ 
		$(document).on("click", "#btnAnadirnoticiagrupo", function(){		
			$.post("./aj/aj_gruposMultiples.php", { 
					tipofuncion:"anadir",
					noticia_id:	$('#noticia_id').val(),
					grupo_id:	$('#grupo_id').val()
				},
				function(datos){
					$('#tablaNoticiasgrupos').append(datos);
				}
			);
		
			return false; //Para que no se desplaze la pantalla
		});
	}

	if($(".eliminarNoticiagrupo").length){ 
		$(document).on("click", ".eliminarNoticiagrupo", function(){
			var elemento_id = $(this).attr("id");
			var superior = $(this).parents("tr");
			
			$.post("./aj/aj_gruposMultiples.php", { 
					tipofuncion:"eliminar",
					elemento_id: elemento_id
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

$(document).ready(iniciaGruposmultiples);