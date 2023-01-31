function iniciaBunker(){

	$.datepicker.setDefaults({
		dateFormat: 'dd-mm-yy',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
		dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
		minDate: 0,
		firstDay: 1
	});
	
	//Elegir fecha en el calendario sala 1
	if($(".calendario1").length){ 
		var aFechassala1rojo=[];
		var aFechassala1naranja=[];
		$.post("aj_horarios.php", { 
				tipo:"fechacolor",
				sala_id:"1"
			},
			function(aDatos){//alert(aDatos);
				var arrayDatos = JSON.parse(aDatos);

				var fechasreservasrojo=arrayDatos.fechasreservasrojo;
				var fechas=fechasreservasrojo.split(",");
				for(var i =0;i<fechas.length;i++){
					aFechassala1rojo.push(fechas[i]);
				}

				var fechasreservasnaranja=arrayDatos.fechasreservasnaranja;
				var fechas=fechasreservasnaranja.split(",");
				for(var i =0;i<fechas.length;i++){
					aFechassala1naranja.push(fechas[i]);
				}

				$(".calendario1").datepicker("refresh");
				
			}
		);

		$('.calendario1').datepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function (date) {//alert(date);
				$('#horassala').html("Horarios Sala 1 <br>"+date);
				$.post("aj_horarios.php", { 
						tipo:"fecha",
						sala_id:"1",
						fecha:date
					},
					function(aDatos){//alert(aDatos);
						var arrayDatos = JSON.parse(aDatos);

						$(".fechaslibres").html(arrayDatos.registrohora);
						$("#datosreserva").html('');

						$("#botonreserva").html('<p><strong>Seleccione fecha y hora pera realizar la reserva</strong></p>');
					}
				);	
			},
			beforeShowDay: function(date) {
				var theday = ('0' + date.getDate()).slice(-2)+'-'+ ('0' + (date.getMonth()+1)).slice(-2)+'-'+date.getFullYear();

				if(aFechassala1rojo.indexOf(theday) != -1){
					return [true,'rojo'];
				}else if(aFechassala1naranja.indexOf(theday) != -1){
					return [true,'naranja'];
				}else{
					return [true,'verde'];
				}
			}
		});
	}

	//Elegir fecha en el calendario sala 2
	if($(".calendario2").length){ 
		var aFechassala2rojo=[];
		var aFechassala2naranja=[];
		$.post("aj_horarios.php", { 
				tipo:"fechacolor",
				sala_id:"2"
			},
			function(aDatos){//alert(aDatos);
				var arrayDatos = JSON.parse(aDatos);

				var fechasreservasrojo=arrayDatos.fechasreservasrojo;
				var fechas=fechasreservasrojo.split(",");
				for(var i =0;i<fechas.length;i++){
					aFechassala2rojo.push(fechas[i]);
				}

				var fechasreservasnaranja=arrayDatos.fechasreservasnaranja;
				var fechas=fechasreservasnaranja.split(",");
				for(var i =0;i<fechas.length;i++){
					aFechassala2naranja.push(fechas[i]);
				}

				$(".calendario2").datepicker("refresh");
				
			}
		);

		$('.calendario2').datepicker({
			dateFormat: 'dd-mm-yy',
			onSelect: function (date) {//alert(date);
				$('#horassala').html("Horarios Sala 2 <br>"+date);
				$.post("aj_horarios.php", { 
						tipo:"fecha",
						sala_id:"2",
						fecha:date
					},
					function(aDatos){//alert(aDatos);
						var arrayDatos = JSON.parse(aDatos);

						$(".fechaslibres").html(arrayDatos.registrohora);
						$("#datosreserva").html('');

						$("#botonreserva").html('<p><strong>Seleccione fecha y hora pera realizar la reserva</strong></p>');
					}
				);	
			},
			beforeShowDay: function(date) {
					var theday = ('0' + date.getDate()).slice(-2)+'-'+ ('0' + (date.getMonth()+1)).slice(-2)+'-'+date.getFullYear();

					if(aFechassala2rojo.indexOf(theday) != -1){
						return [true,'rojo'];
					}else if(aFechassala2naranja.indexOf(theday) != -1){
						return [true,'naranja'];
					}else{
						return [true,'verde'];
					}
				}
		});
	}

	//Calendario de eventos
	if($(".calendarioeventos").length){
		var aFechaseventos=[];

		$.post("aj_horarios.php", { 
				tipo:"fechacoloreventos"
			},
			function(aDatos){//alert(aDatos);
				var arrayDatos = JSON.parse(aDatos);

				var fechaseventos=arrayDatos.fechaseventos;
				
				var fechas=fechaseventos.split(",");
				for(var i =0;i<fechas.length;i++){
					aFechaseventos.push(fechas[i]);
				}
				$(".calendarioeventos").datepicker("refresh");
				
			}
		);

		$('.calendarioeventos').datepicker({
			dateFormat: 'dd-mm-yy',
			beforeShowDay: function(date) {
				var theday = ('0' + date.getDate()).slice(-2)+'-'+ ('0' + (date.getMonth()+1)).slice(-2)+'-'+date.getFullYear();
				//if($.inArray(theday, aFechaseventos)=='0'){
				if(aFechaseventos.indexOf(theday) != -1){
					return [true,'rojo'];
				}else{
					return [true,'verde'];
				}
				
			}
		});
	}


	//*** Elegir hora  ********
	$(document).on("click", ".reservahora", function(){
		var elementos=$(this).attr("data");
		var datoselementos=elementos.split("_");

		var sala_id=datoselementos[0];
		var fecha=datoselementos[1];
		var hora=datoselementos[2];

		$.post("./aj_horarios.php", { 
				tipo: "hora",
				sala_id:sala_id,
				fecha:fecha,
				hora:hora
			},
			function(aDatos){//alert(aDatos);
				var arrayDatos = JSON.parse(aDatos);

				$("#datosreserva").html(arrayDatos.datosreserva);
				$("#reservasala1").val(arrayDatos.reservasala1);
				$("#reservafecha1").val(arrayDatos.reservafecha1);
				$("#reservahora1").val(arrayDatos.reservahora1);
				$("#reservaprecio1").val(arrayDatos.reservaprecio1);

				$("#botonreserva").html('<button type="submit" class="button button-big">RESERVAR</button>');
			}
		);

		return false;
	});
	
}

// ------------------------------------------------------------------------------
$(document).ready(iniciaBunker);
