<div class="tab-pane" id="pestanaseo">
	<div class="panel panel-primary">
		<div class="panel-body">

			<div class="form-group">
				<?if(strlen($registro->tituloseo)==0){
					$boderinput='style="border:2px solid #cf4e38"';
					$colorcaracteres="rojo";
				}else if(((strlen($registro->tituloseo)<30) || (strlen($registro->tituloseo)>65))){
					$boderinput='style="border:2px solid #ff8000"';
					$colorcaracteres="naranjaoscuro";
				}else if($registro->tituloseo==$registro->tituloseoh1){
					$boderinput='style="border:2px solid #ff8000"';
					$colorcaracteres="naranjaoscuro";
				}else{
					$boderinput="";
					$colorcaracteres="";
				}?>

				<label for="tituloseo" class="col-sm-3 control-label">* Título página<br><span class="mensajeordenar">(30-65 car.)</span>:</label>
				<div class="col-sm-9"><input type="text" name="tituloseo" id="tituloseo" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->tituloseo))?>" <?echo $boderinput?> >
				<?if(strlen($registro->tituloseo)>0){?>
					<span class="mensajeordenar <?echo $colorcaracteres?>">(<?echo strlen($registro->tituloseo)?> caracteres)</span>
				<?}
				if($registro->tituloseo==$registro->tituloseoh1){?>
					<span class="mensajeordenar <?echo $colorcaracteres?>"><br>El Título página es igual que el Título H1</span>
				<?}?>
				</div>
			</div>

			<div class="form-group">
				<?if(strlen($registro->tituloseoh1)==0){
					$boderinput='style="border:2px solid #cf4e38"';
					$colorcaracteres="rojo";
				}else if((strlen($registro->tituloseoh1)>70) && ($registro->tituloseoh1!="")){
					$boderinput='style="border:2px solid #ff8000"';
					$colorcaracteres="naranjaoscuro";
				}else if($registro->tituloseo==$registro->tituloseoh1){
					$boderinput='style="border:2px solid #ff8000"';
					$colorcaracteres="naranjaoscuro";
				}else{
					$boderinput="";
					$colorcaracteres="";
				}?>

				<label for="tituloseoh1" class="col-sm-3 control-label">* Título H1<br><span class="mensajeordenar">(menos de 70 car.)</span>:</label>
				<div class="col-sm-9"><input type="text" name="tituloseoh1" id="tituloseoh1" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->tituloseoh1))?>" <?echo $boderinput?> readonly>
				<?if(strlen($registro->tituloseoh1)>0){?>
					<span class="mensajeordenar <?echo $colorcaracteres?>">(<?echo strlen($registro->tituloseoh1)?> caracteres)</span>
				<?}
				if($registro->tituloseo==$registro->tituloseoh1){?>
					<span class="mensajeordenar <?echo $colorcaracteres?>"><br>El título H1 es igual que el Título página</span>
				<?}?>
				</div>
			</div>

			<div class="form-group">
				<label for="titulourl" class="col-sm-3 control-label">* Url:</label>
				<div class="col-sm-9"><input type="text" name="titulourl" id="titulourl" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->titulourl))?>"></div>
			</div>

			<div class="form-group">
				<?if(strlen($registro->descripcionseo)==0){
					$boderinput='style="border:2px solid #cf4e38"';
					$colorcaracteres="rojo";
				}else if(((strlen($registro->descripcionseo)<70) || (strlen($registro->descripcionseo)>156))){
					$boderinput='style="border:2px solid #ff8000"';
					$colorcaracteres="naranjaoscuro";
				}else{
					$boderinput="";
					$colorcaracteres="";
				}?>

				<label for="descripcionseo" class="col-sm-3 control-label">* Descripción<br><span class="mensajeordenar">(70-156 car.)</span>:</label>
				<div class="col-sm-9"><textarea name="descripcionseo" id="descripcionseo" rows="5" class="form-control input-sm" <?echo $boderinput?>><?echo utf8_encode(stripslashes($registro->descripcionseo))?></textarea>
				<?if(strlen($registro->descripcionseo)>0){?>
					<span class="mensajeordenar <?echo $colorcaracteres?>">(<?echo strlen($registro->descripcionseo)?> caracteres)</span>
				<?}?>
				</div>
			</div>

			<p class="text-center"><em>* Si se dejan en blanco estos campos, al pulsar guardar se toman por defecto los datos equivalentes de la ficha general, cortando los caracteres si se pasan del límite, revisar despues de guardar.<br>Los límites son recomendados, si se necesita exceder el límite se puede modificar el campo desde esta pantalla.</em></p>

		</div>
	</div>
</div>
<?//***********************************************?>
