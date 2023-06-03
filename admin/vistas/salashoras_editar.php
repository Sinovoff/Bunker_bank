<div class="panel panel-info">

	<div class="panel-heading">
		<h3 class="panel-title text-center"><strong>Horario</strong></h3>
	</div>

	<div class="panel-body">
		<form class="form-horizontal" name="frmTipos" id="frmTipos" action="index.php" method="post" enctype="multipart/form-data" role="form">
			<input type="hidden" name="tipofunc"	value="guardar" />
			<input type="hidden" name="id"			value="<?echo $registro->id?>" />
			<input type="hidden" name="opcion"		value="<?echo $this->opcion?>" />			
			<input type="hidden" name="inicio"		value="<?echo $inicio?>" />
			<input type="hidden" name="buscar"		value="<?echo $buscar?>" />
			<input type="hidden" name="buscartipo"	value="<?echo $buscartipo?>" />
			<input type="hidden" name="orden"		value="<?echo $orden?>" />
			<input type="hidden" name="ordenacion"	value="<?echo $ordenacion?>" />
			<input type="hidden" name="tipopro"		value="<?echo $tipopro?>" />
			
			<input type="hidden" name="sala_id"	id="sala_id"	value="<?echo $registro->id?>" />
			<input type="hidden" name="ModeloTabla" id="ModeloTablaHoras" value="Salashora" />

			<div class="row">
				<div class="col-md-offset-3 col-md-6 col-md-offset-3">
					<div class="table-responsive">
						<table  class="table table-condensed table-bordered table-striped">
							<thead>
								<tr>
									<th class="col-md-5" >Hora</th>
									<th class="col-md-5" >Día Semana<br>(L-M-X-J-V-S-D-F)</th>
									<th class="col-md-2"></th>
								</tr>
							</thead>

							<tbody>
								<tr>
									<td class="text-center"><input type="text" name="horacampo1" id="horacampo1" class="form-control input-sm" style="text-align:left"></td>

									<td class="text-center"><input type="text" name="horacampo2" id="horacampo2" class="form-control input-sm" style="text-align:left"></td>
																		
									<td class="text-center"><button type="submit" name="btnhoraAnadir" id="btnhoraAnadir" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> A&ntilde;adir</button></td>
								</tr> 
							</tbody>

						</table>
					</div>
				</div>
			</div>

			
			<div class="row">
				<div class="col-md-offset-3 col-md-6 col-md-offset-3">
					<div class="table-responsive">
						<table id="tablaHoras" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th class="col-md-5">Hora</th>
									<th class="col-md-5">Día semana</th>

									<th class="col-md-2">Borrar</th>
								</tr>
							</thead>

							<tbody>
								<?foreach($aSalashoras as $salahora){?>
									<tr>

										<td class="text-center">
											<?if($salahora->hora==""){	
												$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
											}else	
												$botonanadir=$salahora->hora?>
											
											<div id="divtextohora_hora_<?echo $salahora->id?>" class="divtextohora" data="hora"><?echo $botonanadir?></div>
											<div id="divinputhora_hora_<?echo $salahora->id?>" style="display:none"><input type="text" name="inputcampohora" id="inputcampohora_hora_<?echo $salahora->id?>" class="form-control input-sm" value="<?echo stripslashes($salahora->hora)?>" data="hora"/></div>
										</td>

										<td class="text-center">
											<?if($salahora->diasemana==""){	
												$botonanadir='<a href="#" class="btn btn-warning">A&ntilde;adir</a>';
											}else	
												$botonanadir=$salahora->diasemana?>
											
											<div id="divtextohora_diasemana_<?echo $salahora->id?>" class="divtextohora" data="diasemana"><?echo $botonanadir?></div>
											<div id="divinputhora_diasemana_<?echo $salahora->id?>" style="display:none"><input type="text" name="inputcampohora" id="inputcampohora_diasemana_<?echo $salahora->id?>" class="form-control input-sm" value="<?echo stripslashes($salahora->diasemana)?>" data="diasemana"/></div>
										</td>
										
										<td class="text-center"><a href="#" id="eliminarHora_<?echo $salahora->id?>" class="eliminarHora" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar"></a></td>

									</tr>
								<?}?> 
							</tbody>

						</table>
					</div>

					<div class="form-group text-center">
						<?$rutaurl="index.php?opcion=".$this->opcion."&seccione_id=".$seccione_id."&categoria_id=".$categoria_id."&subcategoria_id=".$subcategoria_id."&orden=".$orden."&ordenacion=".$ordenacion."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=".$inicio;?>

						<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-default" onclick="window.location.href='<?echo $rutaurl?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>