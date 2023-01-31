<?require_once ("init.php");

$tipo=$_POST['tipo'];

switch($tipo){
	case 'fecha':
		$fechareserva=date("Y-m-d",strtotime($_POST['fecha'])) ;

		$diasemananumero=date("w",strtotime($_POST['fecha'])) ;

		if($diasemananumero==0)			$diasemana="D";
		else if($diasemananumero==1)	$diasemana="L";
		else if($diasemananumero==2)	$diasemana="M";
		else if($diasemananumero==3)	$diasemana="X";
		else if($diasemananumero==4)	$diasemana="J";
		else if($diasemananumero==5)	$diasemana="V";
		else if($diasemananumero==6)	$diasemana="S";

		$opciones=array('conditions'=>"fecha='".$fechareserva."'");
		$calendario = Calendario::find("all",$opciones);
		if(count($calendario)>0)	$diasemana="F";

		$opciones=array('conditions'=>"sala_id='".$_POST['sala_id']."'",  'order' =>"hora");
		$aSalashoras = Salashora::find("all",$opciones);
		if(count($aSalashoras)>0){
			foreach($aSalashoras as $salahora){
				$aDiassemana=explode("-",$salahora->diasemana);
				if (in_array($diasemana, $aDiassemana)){
					$opciones=array('conditions'=>"pagado='1' AND sala_id='".$_POST['sala_id']."' AND fechareserva='".$fechareserva." ".$salahora->hora.":00'");
					$reserva = Reserva::find($opciones);
					if(count($reserva)>0){
						$registrohora.='<li><span><strong>'.$salahora->hora.'</strong> <em>Ocupado</em></span></li> ';
					}else{
						$registrohora.='<li><a href="#" class="reservahora" data="'.$_POST['sala_id']."_".$_POST['fecha']."_".$salahora->hora.'"><strong>'.$salahora->hora.'</strong> <em>Libre</em></a></li>';                            
					}
				}
			}
		}
		$aDatos=array(	'registrohora' => $registrohora);

		echo json_encode($aDatos);

		break;
	
	case 'hora':
		$fechareserva=date("Y-m-d",strtotime($_POST['fecha'])) ;

		$diasemananumero=date("w",strtotime($_POST['fecha'])) ;

		if($diasemananumero==0)			$diasemana="D";
		else if($diasemananumero==1)	$diasemana="L";
		else if($diasemananumero==2)	$diasemana="M";
		else if($diasemananumero==3)	$diasemana="X";
		else if($diasemananumero==4)	$diasemana="J";
		else if($diasemananumero==5)	$diasemana="V";
		else if($diasemananumero==6)	$diasemana="S";

		$opciones=array('conditions'=>"fecha='".$fechareserva."'");
		$calendario = Calendario::find("all",$opciones);
		if(count($calendario)>0)	$diasemana="F";

		$opciones=array('conditions'=>"id='".$_POST['sala_id']."'");
		$sala= Sala::find($opciones);

		if(($diasemana=="L") || ($diasemana=="M") || ($diasemana=="X") || ($diasemana=="J") ){
			$precio=$sala->precio;
		}else{
			$precio=$sala->precio2;
		}

		$registroreserva='<h3>DATOS DE LA RESERVA</h3>'; 

		$registroreserva.='<p>Sala: <strong>Sala '.$_POST['sala_id'].'</strong></p>'; 

		$registroreserva.='<p>Día: <strong>'.$_POST['fecha'].'</strong></p>'; 

		$registroreserva.='<p>Hora: <strong>'.$_POST['hora'].'</strong></p>'; 

		$registroreserva.='<p>Precio: <strong>'.$precio.'€</strong></p>'; 

		$aDatos=array(	'datosreserva' => $registroreserva,
						'reservasala1'=>$_POST['sala_id'],
						'reservafecha1'=>$_POST['fecha'],
						'reservahora1'=>$_POST['hora'],
						'reservaprecio1'=>$precio
						);

		echo json_encode($aDatos);

		break;
	
	
	case 'fechacolor':
		$fechareserva=date("Y-m-d",strtotime($_POST['fecha'])) ;

		$consulta = "SELECT *, COUNT(id) as totalreservas FROM reservas ".
					"WHERE  sala_id='".$_POST['sala_id']."' AND fechareserva>='".date("Y-m-d H:i:s")."' AND pagado='1'".
					"GROUP BY DAY(fechareserva)";
		$aReservas = Evento::find_by_sql($consulta);

		//$opciones=array('conditions'=>"pagado='1' AND sala_id='1' AND fechareserva>='".date("Y-m-d H:i:s")."'");
		//$aReservas = Reserva::find("all",$opciones);

		//$fechasreserva="";
		$aFechasreservarojo=array();
		$aFechasreservanaranja=array();
		if(count($aReservas)>0){
			foreach($aReservas as $reserva){
				$diasemananumero=date("w",strtotime($reserva->fechareserva->format("Y-m-d"))) ;

				if($diasemananumero==0)			$diasemana="D";
				else if($diasemananumero==1)	$diasemana="L";
				else if($diasemananumero==2)	$diasemana="M";
				else if($diasemananumero==3)	$diasemana="X";
				else if($diasemananumero==4)	$diasemana="J";
				else if($diasemananumero==5)	$diasemana="V";
				else if($diasemananumero==6)	$diasemana="S";

				$opciones=array('conditions'=>"fecha='".$fechareserva."'");
				$calendario = Calendario::find("all",$opciones);
				if(count($calendario)>0)	$diasemana="F";

				$opciones=array('conditions'=>"sala_id='".$_POST['sala_id']."' AND diasemana LIKE '%".$diasemana."%'",  'order' =>"hora");
				$aSalashoras = Salashora::find("all",$opciones);
				
				if($reserva->totalreservas==count($aSalashoras)){
					$color="rojo";
					$aFechasreservarojo[]=$reserva->fechareserva->format("d-m-Y");
				}else if(($reserva->totalreservas>0) && ($reserva->totalreservas<count($aSalashoras))){
					$color="naranja";
					$aFechasreservanaranja[]=$reserva->fechareserva->format("d-m-Y");
				}else{
					$color="verde";
				}
			}
			
			$fechasreservasrojo=implode(",",$aFechasreservarojo);
			$fechasreservasnaranja=implode(",",$aFechasreservanaranja);
		}
	

		$aDatos=array(	'fechasreservasrojo'=>$fechasreservasrojo,
						'fechasreservasnaranja'=>$fechasreservasnaranja
					);

		echo json_encode($aDatos);

		break;

	case 'fechacoloreventos':
		$opciones=array('conditions'=>"fechareserva>='".date("Y-m-d H:i:s")."'");
		$aEventos= Evento::find("all",$opciones);

		$aFechaseventos="";
		if(count($aEventos)>0){
			foreach($aEventos as $evento){
				$aFechaseventos[]=$evento->fechareserva->format("d-m-Y");
			}
		}
		$fechaseventos=implode(",",$aFechaseventos);

		$aDatos=array(	'fechaseventos'=>$fechaseventos
						);

		echo json_encode($aDatos);

		break;
}
?>