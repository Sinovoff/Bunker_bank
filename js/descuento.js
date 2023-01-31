function iniciaDescuento(){

	if($(".buscarcupon").length){ 
		$(".buscarcupon").on('click', function () {
			$.post("./aj_descuento.php", { 
					tipofuncion: "buscarcupon",
					referencia: $("#cupondescuento").val(),
					preciosala:$("#reservaprecio1").val()
				},
				function(aDatos){//alert(aDatos);
					var arrayDatos = JSON.parse(aDatos);

					$(".preciototal").html(arrayDatos.totalcarro);
					$("#TOTAL").val(arrayDatos.TOTAL);
					
									
					$('#mensajedescuento').html(arrayDatos.cuponmensaje);
					$('#lineadetextodescuento').html(arrayDatos.textodescuento);					
				}
			);
		
			return false;
		});
	}
			
}

$(document).ready(iniciaDescuento);
