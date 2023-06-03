<div class="row">
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title text-center"><strong>Editor de Portadas</strong></h3>
		</div>

		<div class="panel-body">
   
			<form class="form-horizontal" name="frmRegistro" id="frmRegistro" action="index.php" method="post" enctype="multipart/form-data" role="form">
				<input type="hidden" name="tipofunc"		value="guardar" />
				<input type="hidden" name="id"				value="<?echo $registro->id?>" />
				<input type="hidden" name="opcion"			value="<?echo $this->opcion?>" />			
				<input type="hidden" name="inicio"			value="<?echo $inicio?>" />
				<input type="hidden" name="buscar"			value="<?echo $buscar?>" />
				<input type="hidden" name="tipobuscar"		value="<?echo $tipobuscar?>" />
				<input type="hidden" name="orden"			value="<?echo $orden?>" />
				<input type="hidden" name="ordenacion"		value="<?echo $ordenacion?>" />
				<input type="hidden" name="tiporegistro"	value="<?echo $this->opcion?>" />			


				<div class="form-group">
					<label for="titulo" class="col-sm-3 control-label">Título:</label>
					<div class="col-sm-6"><input type="text" name="titulo" id="titulo" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->titulo))?>"></div>
				</div>

				<div class="form-group">
					<label for="imagen" class="col-sm-3 control-label">Imagen (1280x853):</label>
					<div class="col-sm-6"><div id="LugarImagen" class="lugarimagen" ><?echo imagen_Editar("#LugarImagen","../galeria/", "imagen", "Galeria", $registro->imagen,  $registro->id,  "imagen","")?></div></div>			
				</div>

				<div class="form-group">
					<label for="destacado" class="col-sm-3 control-label">Destacada:</label>
					<div class="col-sm-6"><div class="checkbox"><label><input type="checkbox" name="destacado" id="destacado" value="1" <?if($registro->destacado==1) echo "checked";?>  /></label></div></div>
				</div>

				<div class="form-group">
					<label for="activo" class="col-sm-3 control-label">Activo:</label>
					<div class="col-sm-6"><div class="checkbox"><label><input type="checkbox" name="activo" id="activo" value="1" <?if($registro->activo==1) echo "checked";?>  /></label></div></div>
				</div>
				
			
				<div class="form-group text-center">
					<?$rutaurl="index.php?opcion=".$this->opcion."&orden=".$orden."&ordenacion=".$ordenacion."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=".$inicio;?>

					<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-default" onclick="window.location.href='<?echo $rutaurl?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>&nbsp;
					<button type="submit" name="btnguardar" id="btnguardar" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar </button>
				</div>
			</form>

			<?if ($registro->id>0){?>
				<??>
			<?}?>
		</div>
	</div>
</div>

