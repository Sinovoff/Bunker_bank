<div class="row">
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title text-center"><strong>Editor de Reservas</strong></h3>
		</div>

		<div class="panel-body">
   
			<form class="form-horizontal" name="frmRegistro" id="frmRegistro" action="index.php" method="post" enctype="multipart/form-data" role="form">

				<input type="hidden" id="tipofunc"		name="tipofunc"		value="guardar" >
				<input type="hidden" id="id"			name="id"			value="<?echo $registro->id?>" >
				<input type="hidden" id="opcion"		name="opcion"		value="<?echo $this->opcion?>" >			
				<input type="hidden" id="inicio"		name="inicio"		value="<?echo $inicio?>" >
				<input type="hidden" id="buscar"		name="buscar"		value="<?echo $buscar?>" >
				<input type="hidden" id="tipobuscar"	name="tipobuscar"	value="<?echo $tipobuscar?>" >
				<input type="hidden" id="orden"			name="orden"		value="<?echo $orden?>" >
				<input type="hidden" id="ordenacion"	name="ordenacion"	value="<?echo $ordenacion?>" >
				
				<input type="hidden" id="tiporegistro"	name="tiporegistro" value="<?echo $this->opcion?>" >

				<div class="form-group">
					<label for="idencriptado" class="col-sm-3 control-label">Referencia:</label>
					<div class="col-sm-6"><?echo utf8_encode(stripslashes($registro->idencriptado))?></div>
				</div>

				<div class="form-group">		
					<label for="fechareserva" class="col-sm-3 control-label">Fecha reserva:</label>
					<div class="col-sm-9" >			       
						<?if($registro->fechareserva!=""){
							$fecha = $registro->fechareserva->format('Y-m-d');
							$hora  = $registro->fechareserva->format('H:i');
						}else{
							$fecha = "0000-00-00";
							$hora  = "00:00";
						}
						if($fecha=="0000-00-00")	$fechacalendario=date("d-m-Y");
						else						$fechacalendario=$registro->fechareserva->format('d-m-Y');?>
						<div name="fechareserva" id="dp" class="input-append date col-sm-3"  data-date="<?echo $fechacalendario?>" data-date-format="dd-mm-yyyy"  style="padding-left:0">
							<div class="input-group">
								<input type="text" name="fechareserva" id="fechareserva" class="form-control input-sm text-center" size="16" value="<?echo seleccionar_fecha($fecha)?>" >
								<span class="input-group-addon"><span class="add-on" style="cursor: pointer;"><span class="glyphicon glyphicon-calendar"></span></span></span>
							</div>
						</div>	
						<?echo seleccionar_horanombre($hora,"1","0", "horareserva", "minutoreserva")?>		
					</div>
				</div>

				

				<div class="form-group">
					<label for="sala_id" class="col-sm-3 control-label">Sala:</label>
					<div class="col-sm-6">
						<select name="sala_id" id="sala_id" class="form-control input-sm provincia">
							<option value="" selected="selected">-Seleccione-</option>
							<?foreach($aSalas as $sala){	
								$selected ="";
								if($sala->id==$registro->sala_id){ $selected = "selected='selected'";}?>
								<option value="<?echo $sala->id?>" <?echo $selected?> ><?echo utf8_encode(stripslashes($sala->nombre))?></option>
							<?}?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="total" class="col-sm-3 control-label">Precio:</label>
					<div class="col-sm-6"><input type="text" name="total" id="total" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->total))?>"></div>
				</div>

				<div class="form-group">
					<label for="cupondescuento" class="col-sm-3 control-label">Cupón descuento</label>
					<div class="col-sm-6"><input type="text" name="cupondescuento" id="cupondescuento" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->cupondescuento))?>"></div>
				</div>

				<div class="form-group">
					<label for="pagado" class="col-sm-3 control-label">Pagado</label>
					<div class="col-sm-6"><div class="checkbox"><label><input type="checkbox" name="pagado" id="pagado" value="1" <?if($registro->pagado==1) echo "checked";?>  /></label></div></div>
				</div>

				<hr>

				<div class="form-group">
					<label for="nombre" class="col-sm-3 control-label">Nombre:</label>
					<div class="col-sm-6"><input type="text" name="nombre" id="nombre" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->nombre))?>"></div>
				</div>

				<div class="form-group">
					<label for="empresa" class="col-sm-3 control-label">Empresa:</label>
					<div class="col-sm-6"><input type="text" name="empresa" id="empresa" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->empresa))?>"></div>
				</div>

				<div class="form-group">
					<label for="direccion" class="col-sm-3 control-label">Dirección:</label>
					<div class="col-sm-6"><input type="text" name="direccion" id="direccion" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->direccion))?>"></div>
				</div>

				<div class="form-group">
					<label for="cp" class="col-sm-3 control-label">C.P.:</label>
					<div class="col-sm-6"><input type="text" name="cp" id="cp" class="form-control input-sm"  value="<?echo utf8_encode(stripslashes($registro->cp))?>"></div>
				</div>

				<div class="form-group">
					<label for="paise_id" class="col-sm-3 control-label text-right">País</label>
					<div class="col-sm-6">
						<select name="paise_id" id="paise_id" class="form-control paise_id obligatorio">
							<?foreach($aPaises as $pais){	
								$selected ="";
								if($pais->id == $registro->paise_id){ $selected = "selected='selected'";}?>
								<option value="<?echo $pais->id?>" <?echo $selected?>><?echo utf8_encode(stripslashes($pais->pais))?></option>
							<?}?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="provincia" class="col-sm-3 control-label text-right">Provincia</label>
					<div class="col-sm-6">
						<select name="provincia" id="provincia" class="form-control input-sm provincia">
							<option value="" selected="selected">-Seleccione-</option>
							<?foreach($aProvincias as $provincia){	
								$selected ="";
								if($provincia->provincia == $registro->provincia){ $selected = "selected='selected'";}?>
								<option value="<?echo utf8_encode(stripslashes($provincia->provincia))?>"  <? echo $selected?>><?echo utf8_encode(stripslashes($provincia->provincia))?></option>
							<?}?>
						</select>
						<input type="text" name="provinciatexto" id="provinciatexto" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->provincia))?>">
					</div>
				</div>
				<div class="form-group">
					<label for="poblacion" class="col-sm-3 control-label text-right">Población</label>
					<div class="col-sm-6">
						<select name="poblacion" id="poblacion" class="form-control input-sm">
							<option value="" selected="selected">-Seleccione-</option>
							<?if($aPoblaciones>0){
								foreach($aPoblaciones as $poblacion){
									$selected ="";
									if($poblacion->poblacion == $registro->poblacion){ $selected = "selected='selected'";}?>
									<option value="<?echo utf8_encode(stripslashes($poblacion->poblacion))?>"  <? echo $selected?>><? echo utf8_encode(stripslashes($poblacion->poblacion))?></option>
								<?}
							}?>
						</select>
						<input type="text" name="poblaciontexto" id="poblaciontexto"  class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->poblacion))?>"/>
					</div>
				</div>	

				<div class="form-group">
					<label for="telefono" class="col-sm-3 control-label">Teléfono:</label>
					<div class="col-sm-6"><input type="text" name="telefono" id="telefono" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->telefono))?>"></div>
				</div>

				<div class="form-group">
					<label for="email" class="col-sm-3 control-label">Email:</label>
					<div class="col-sm-6"><input type="text" name="email" id="email" class="form-control input-sm" value="<?echo $registro->email?>"></div>
				</div>

				<div class="form-group">
					<label for="observaciones" class="col-sm-3 control-label">Observaciones:</label>
					<div class="col-sm-6"><textarea name="observaciones" id="observaciones" rows="5" class="form-control input-sm"><?echo utf8_encode(stripslashes($registro->observaciones))?></textarea></div>
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