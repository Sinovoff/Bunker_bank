<?//*********Paginacion(cantidaddepaginas,tamañopagina,consultatotal,inicio,parametros)***********
function Paginacion($NumPag, $TAM_PAG, $totalregistros, $inicio, $RefPag){ 
	$TOTAL = $totalregistros;
	
	$NPAGINASF=$TOTAL/$TAM_PAG;
	$NPAGINAS=strtok($NPAGINASF,".");
	if($NPAGINASF > $NPAGINAS)	$NPAGINAS++;

	if($inicio>0)
		$anterior=$inicio-$TAM_PAG;
	else
		$anterior=0;

	if($inicio<$TOTAL-$TAM_PAG) 
		$siguiente=$inicio+$TAM_PAG;
	else 
		$siguiente=$inicio;

	$final=($NPAGINAS-1)*$TAM_PAG;
	$NPAG_ACTUAL=($inicio/$TAM_PAG)+1;	

	if($final>=$TAM_PAG){
		//echo "<ul>";
			if (($NPAG_ACTUAL=="0")||($NPAG_ACTUAL=="1")){
				echo "<li class='active'><a href='".$RefPag."0' title='Inicio'>1</a></li>";
			}else {
				echo "<li><a href='".$RefPag.$anterior."' title='Anterior'>< Anterior</a></li>";	
				echo "<li><a href='".$RefPag."0' title='Inicio'>1</a></li>";
			}
			

			$MOSTRAR_PAGINAS=$NumPag; //Numero de paginas a mostrar
			$MITAD_PAGINAS=(int)($MOSTRAR_PAGINAS/2);
			if ($NPAGINAS > 1){ 
				$valor=$NPAG_ACTUAL-$MITAD_PAGINAS;
				$valorpagina=($valor - 1) * $TAM_PAG;
				$contador=$bol=$valinicio=$valorpag2=0;
				for ($i=$NPAG_ACTUAL-$MITAD_PAGINAS;$i<=$NPAGINAS-1;$i++){ 
					
					if ($MOSTRAR_PAGINAS==1){//Para poner el otro tipo de paginacion
						echo "P&aacute;g. ".$valor." de ".$NPAGINAS;
					}else{
					   if (($NPAG_ACTUAL>=$NPAGINAS-$MITAD_PAGINAS) && ($bol==0)){//Para que el indice no supere el maximo
						   $i=$NPAGINAS-$MOSTRAR_PAGINAS+1;
						   $valor=$NPAGINAS-$MOSTRAR_PAGINAS+1;
						   $valorpagina=($valor - 1) * $TAM_PAG;
						   $bol=1;
					   }
					   if (($i<=0)){ //Para que el indice no baje de 1
						   $i=1;
						   $valor=1;
						   $valorpagina=($valor - 1) * $TAM_PAG;
					   }

					  if (($valor=="2")){
						$valorpag2=1;
					  }
					  if (($valor>="3")&& ($valinicio=="0")&& ($valorpag2=="0")){
						echo "<li><a href='#'>...</a></li>";
						$valinicio="1";
					  }

					  if ($i==$NPAGINAS){
							$valor=$valor;
					 } else if (($valor=="1")){
					 		$valor=$i+1;
					 		$valorpagina=($valor - 1) * $TAM_PAG; 
					  }else{
						   if ($valor == $NPAG_ACTUAL) {// muestro el índice de la página actual		
							  echo "<li class='active'><a href='".$RefPag.$valorpagina."' title=\"P&aacute;gina ".$valor."\">".$valor."</a></li>";
							  $valor=$i+1;
							  $valorpagina=($valor - 1) * $TAM_PAG; 
						   }else{  //s
							  echo "<li><a  href='".$RefPag.$valorpagina."' title=\"P&aacute;gina ".$valor."\">" . $valor . "</a></li> "; 
							  $valor=$i+1;
							  $valorpagina=($valor - 1) * $TAM_PAG;
						   }
					  } 
				   }
				  
				   $contador++;
				   if($contador==$MOSTRAR_PAGINAS) break;
				} 
			}
 
			if ($valor!=$NPAGINAS) echo "<li><a href='#'>...</a></li>";
			
			if ($NPAG_ACTUAL==$NPAGINAS){
				echo "<li class='active'><a href='".$RefPag.$final."' title='Final'>".$NPAGINAS."</a></li>";
			}else {
				echo "<li><a href='".$RefPag.$final."' title='Final'>".$NPAGINAS."</a></li>";
    			echo "<li><a href='".$RefPag.$siguiente."' title='Siguiente'>Siguiente ></a></li>";		
			}
		//echo "</ul>";
	}
}
//*******************************************************************************************************************
?>
