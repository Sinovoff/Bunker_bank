<?require_once ("init.php");

$tipofuncion=$_POST['tipofuncion'];

switch($tipofuncion){	

	case 'buscarcupon':
		$referenciacupon=$_POST['referencia'];

		//************************************************************************************************
		//***********************************  CUPONES DESCUENTO  ****************************************
		//************************************************************************************************
		$opciones= array('conditions'=>"activo='1' AND referencia='".$referenciacupon."'");	
		$cupone = Cupone::find($opciones);

		if(count($cupone)>0){
			if(($cupone->tipouso=="1") || (($cupone->tipouso=="0")&&($cupone->usado=="0"))){
				$cuponmensaje='<span class="verde"><strong>Cup&oacute;n correcto</strong></span>';
				$descuento=$cupone->descuentoporcentaje;

				$preciototal=$_POST['preciosala'];

				$tieneperiododescuento=0;			

				$fechaactual=date("Y-m-d H:i:s");
				
				if($cupone->periododescuento=="0"){
					$tieneperiododescuento=1;

					$cuponmensaje='<span class="verdecupon"><strong>Cup&oacute;n correcto</strong></span>';
				}else{
					if(($fechaactual>=$cupone->periododesde->format("Y-m-d H:i:s"))&&($fechaactual<=$cupone->periodohasta->format("Y-m-d H:i:s"))){
						$tieneperiododescuento=1;

						$cuponmensaje='<span class="verdecupon"><strong>Cup&oacute;n correcto</strong></span>';
					}else{
						$tieneperiododescuento=0;

						$cuponmensaje='<span class="rojocupon"><strong>Cup&oacute;n caducado</strong></span>';
					}
				}
					

				if($tieneperiododescuento==1){
					$descuento="1";

					if($cupone->descuentotipo=="0"){
						$totaldescuento=($preciototal*$cupone->descuentoporcentaje)/100;

						//$textodescuento.='<p>Descuento cup&oacute;n ('.$cupone->descuentoporcentaje.'%): <strong>-'.number_format($totaldescuento, 2, ",", ".").' &euro;</strong></p>';
					}else{
						$totaldescuento=$cupone->descuentoimporte;

						//$textodescuento.='<p>Descuento cup&oacute;n: <strong>-'.number_format($totaldescuento, 2, ",", ".").' &euro;</strong></p>';
					}
				}else{
					$descuento="";
				}

				//$totalcarro=$preciototal-$totaldescuento;
				$totalcarro=$totaldescuento;
				
			
			}else{//** Cupon usado para los cupones de un solo uso  **
				$cuponmensaje='<span class="rojocupon"><strong>El cup&oacute;n ya ha sido usado</strong></span>';
				$descuento="";
				$textodescuento='';
				$calcularpreciototal=1;

				$totalcarro=$_POST['preciosala'];
			}


		}else{//** Cupon erroneo  **
			$cuponmensaje='<span class="rojocupon"><strong>Error - Cup&oacute;n erroneo</strong></span>';
			$descuento="";
			$textodescuento='';
			$calcularpreciototal=1;

			$totalcarro=$_POST['preciosala'];

		}
		
		$TOTAL=number_format($totalcarro, 2, '.', '');

		$totalcarro="TOTAL: <strong>".number_format($totalcarro, 2, ",", ".")."&euro;</strong>";
		

		$aDatos=array(	'totalcarro' =>					$totalcarro,
						'referenciacupon' =>			$referenciacupon,
						'cuponmensaje' =>				$cuponmensaje,
						'descuento' =>					$descuento,
						'textodescuento'=>				$textodescuento,
						'TOTAL'=>						$TOTAL
					);

		echo json_encode($aDatos);

		break;
}
?>