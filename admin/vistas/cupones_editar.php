<div class="row">
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title text-center"><strong>Editor de Cupones</strong></h3>
		</div>

		<div class="panel-body">
   
			<form class="form-horizontal" name="frmRegistro" id="frmRegistro" action="index.php" method="post" enctype="multipart/form-data" role="form">

				<input type="hidden" id="tipofunc"		name="tipofunc"		value="guardar" />
				<input type="hidden" id="id"			name="id"			value="<?echo $registro->id?>" />
				<input type="hidden" id="opcion"		name="opcion"		value="<?echo $this->opcion?>" />			
				<input type="hidden" id="inicio"		name="inicio"		value="<?echo $inicio?>" />
				<input type="hidden" id="buscar"		name="buscar"		value="<?echo $buscar?>" />
				<input type="hidden" id="tipobuscar"	name="tipobuscar"	value="<?echo $tipobuscar?>" />
				<input type="hidden" id="orden"			name="orden"		value="<?echo $orden?>" />
				<input type="hidden" id="ordenacion"	name="ordenacion"	value="<?echo $ordenacion?>" />
				
				<input type="hidden" id="tiporegistro"	name="tiporegistro" value="<?echo $this->opcion?>" />			


				<div class="form-group">
					<label for="referencia" class="col-sm-3 control-label">Referencia:</label>
					<div class="col-sm-6"><input type="text" name="referencia" id="referencia" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->referencia))?>"></div>
				</div>

				<div class="form-group">
					<label for="descripcion" class="col-sm-3 control-label">Descripción:</label>
					<div class="col-sm-6"><input type="text" name="descripcion" id="descripcion" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->descripcion))?>"></div>
				</div>

				<div class="form-group">
					<label for="tipouso" class="col-sm-3 control-label">Tipo uso:</label>
					<div class="col-md-6 col-sm-6">
						<select name="tipouso" id="tipouso" class="form-control input-sm">
							<option value="0" <?if($registro->tipouso=="0"){ echo "selected='selected'";}?>>Un solo uso</option>
							<option value="1" <?if($registro->tipouso=="1"){ echo "selected='selected'";}?>>Múltiples usos</option>
						</select>
					</div>
				</div>				

				<div class="form-group">
					<label for="descuentotipo" class="col-sm-3 control-label">Precio cupón:</label>
					<?/*<div class="col-sm-3"><label for="descuentotipoporcentaje"><input type="radio" name="descuentotipo" id="descuentotipoporcentaje" value="0" <?if($registro->descuentotipo==0){echo 'checked="checked"';}?>  /> % Descuento</label><input type="text" name="descuentoporcentaje" id="descuentoporcentaje" class="form-control input-sm" value="<?echo stripslashes($registro->descuentoporcentaje)?>"></div>*/?>
					<div class="col-sm-3"><label for="descuentotipoimporte"><input type="radio" name="descuentotipo" id="descuentotipoimporte" value="1" checked="checked" <?//if($registro->descuentotipo==1){echo 'checked="checked"';}?> /> Importe</label><input type="text" name="descuentoimporte" id="descuentoimporte" class="form-control input-sm" value="<?echo stripslashes($registro->descuentoimporte)?>"></div>
				</div>

				<div class="form-group">		
					<label for="periododesde" class="col-sm-3 control-label">Periodo descuento:</label>

					<div class="col-sm-9" style="padding-left:0">
						<div class="col-sm-12"><label for="periododescuentocualquiera"><input type="radio" name="periododescuento" id="periododescuentocualquiera" value="0" <?if($registro->periododescuento==0){echo 'checked="checked"';}?> /> Cualquiera</label></div>
						<div class="col-sm-12"><label for="periododescuentointervalo"><input type="radio" name="periododescuento" id="periododescuentointervalo" value="1" <?if($registro->periododescuento==1){echo 'checked="checked"';}?> /> Intervalo</label></div>

						<div class="col-sm-9" >
							<?if($registro->periododesde!=""){
								$fecha = $registro->periododesde->format('Y-m-d');
								$hora  = $registro->periododesde->format('H:i');
							}else{
								$fecha = "0000-00-00";
								$hora  = "00:00";
							}
							if($fecha=="0000-00-00")	$fechacalendario=date("d-m-Y");
							else						$fechacalendario=$registro->periododesde->format('d-m-Y');?>
							<div name="periododesde" id="dp" class="input-append date col-sm-3"  data-date="<?echo $fechacalendario?>" data-date-format="dd-mm-yyyy"  style="padding-left:0">
								<div class="input-group">
									<input type="text" name="periododesde" id="periododesde" class="form-control input-sm text-center" size="16" value="<?echo seleccionar_fecha($fecha)?>" >
									<span class="input-group-addon"><span class="add-on" style="cursor: pointer;"><span class="glyphicon glyphicon-calendar"></span></span></span>
								</div>
							</div>	
							<?echo seleccionar_horanombre($hora,"1","0", "horaperiododesde", "minutosperiododesde")?>		
						</div>

						<div class="col-sm-9" >
							<?if($registro->periodohasta!=""){
								$fecha = $registro->periodohasta->format('Y-m-d');
								$hora  = $registro->periodohasta->format('H:i');
							}else{
								$fecha = "0000-00-00";
								$hora  = "00:00";
							}
							if($fecha=="0000-00-00")	$fechacalendario=date("d-m-Y");
							else						$fechacalendario=$registro->periodohasta->format('d-m-Y');?>
							<div name="periodohasta" id="dp1" class="input-append date col-sm-3"  data-date="<?echo $fechacalendario?>" data-date-format="dd-mm-yyyy"  style="padding-left:0">
								<div class="input-group">
									<input type="text" name="periodohasta" id="periodohasta" class="form-control input-sm text-center" size="16" value="<?echo seleccionar_fecha($fecha)?>" >
									<span class="input-group-addon"><span class="add-on" style="cursor: pointer;"><span class="glyphicon glyphicon-calendar"></span></span></span>
								</div>
							</div>	
							<?echo seleccionar_horanombre($hora,"1","0", "horaperiodohasta", "minutosperiodohasta")?>		
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="usado" class="col-sm-3 control-label">Usado (solo para un solo uso)</label>
					<div class="col-sm-6"><div class="checkbox"><label><input type="checkbox" name="usado" id="usado" value="1" <?if($registro->usado==1) echo "checked";?>  /></label></div></div>
				</div>

				<div class="form-group">
					<label for="activo" class="col-sm-3 control-label">Activo</label>
					<div class="col-sm-6"><div class="checkbox"><label><input type="checkbox" name="activo" id="activo" value="1" <?if($registro->activo==1) echo "checked";?>  /></label></div></div>
				</div>

				<div class="form-group text-center">
					<?$rutaurl="index.php?opcion=".$this->opcion."&orden=".$orden."&ordenacion=".$ordenacion."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=".$inicio;?>

					<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-default" onclick="window.location.href='<?echo $rutaurl?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>&nbsp;
					<button type="submit" name="btnguardar" id="btnguardar" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar </button>
				</div>

			</form>
		</div>
	</div>
</div>