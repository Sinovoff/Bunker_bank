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
	
	var eventDates = {};
    eventDates[ new Date( '2018/02/24' )] = new Date( '2018/02/24' );

	var aFechas=[];
	$.post("aj_horarios.php", { 
			tipo:"fechacolor",
			sala_id:"1"
		},
		function(aDatos){//alert(aDatos);
			var arrayDatos = JSON.parse(aDatos);

			var fechasreservas=arrayDatos.fechasreservas;
			
			fechas=fechasreservas.split(",");
			for(var i =0;i<fechas.length;i++){
				aFechas.push(fechas[i]);
			}  

			$(".calendario1").datepicker("refresh");
			
		}
	);	



	/*var datesArray=[];
            $.ajax({
                url : '/aptcare/getscheduledate.action',
                data : "resourecid="+$(this).val(),
                method : "POST",
                async : false,
                success : function(data) {  
                    strarr=$.trim(data).split(",");
                    for(var i =0;i<strarr.length;i++){
                        datesArray.push(strarr[i]);
                    }                       
                }
            })

            console.log("dates array: "+datesArray);

             $('.datepicker').datepicker({
                    dateFormat: "dd/mm/yy",        
                    changeMonth: true,
                    changeYear: true,
                    beforeShowDay: function(date) {
                            var theday = date.getDate() +'/'+ (date.getMonth()+1)+ '/' +date.getFullYear();
                            console.log("to highlight array: "+datesArray);
                            return [true,$.inArray(theday, datesArray) >=0?"Highlighted":''];
                    }
            }); 
 */

	$(".calendario2").datepicker();

	//Elegir fecha en el calendario sala 1
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
		beforeShowDay: function( date ) {
			var theday = date.getFullYear()+'-'+ ('0' + (date.getMonth()+1)).slice(-2)+'-'+('0' + date.getDate()).slice(-2);

			//alert(theday);
			console.log(theday+" "+$.inArray(theday, aFechas));
			//alert(theday+" "+$.inArray(theday, aFechas));
			if($.inArray(theday, aFechas)=='0'){
				return [true,'rojo'];
			}else{
				return [true,'verde'];
			}
			//return [true, $.inArray(theday, aFechas) >=0?"rojo":''];

			/*alert($.inArray("2018-02-21", aFechas));
			if($.inArray(date, aFechas)){
				return [true,'rojo'];
			}*/

			//return [true, 'verde'];
			//alert(date);
			//var eventDates = {};
			//eventDates[ new Date( date )] = new Date( date );

			//alert(eventDates[0]);

			/*$.post("aj_horarios.php", { 
					tipo:"fechacolor",
					sala_id:"1",
					fecha:date
				},
				function(aDatos){//alert(aDatos);
					var arrayDatos = JSON.parse(aDatos);

					if(arrayDatos.cantidadreservas=="3") {
						return [true, 'rojo'];
					}else if(arrayDatos.cantidadreservas=="1") {
						return [true, 'naranja'];
					}else if(arrayDatos.cantidadreservas=="0") {
						return [true, 'verde'];
					}else {
						 return [true, '', ''];
					}

				}
			);	*/

          /* var highlight = eventDates[date];
           if( highlight ) {
				return [true, 'verde', 'titulo opcional'];
           }else {
                 return [true, '', ''];
           }*/
        }
	});
	

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
	
	/*if($('#datosreserva').length){ 
		$('#datosreserva').hide("normal");
	}*/
}

// ------------------------------------------------------------------------------
$(document).ready(iniciaBunker);
