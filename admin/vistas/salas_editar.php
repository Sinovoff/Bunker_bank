<div class="row">
	<div class="panel panel-primary">

		<div class="panel-heading">			
			<h4 class="panel-title text-center"><strong>Editor de salas</strong></h4>
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
					<label class="col-sm-2 control-label"></label>
					<div class="col-sm-8">
						<ul class="nav nav-tabs nav-justified" id="myTab">
							<li class="active"><a href="#pestanageneral" data-toggle="tab">General</a></li>
							<!-- <li><a href="#pestanaseo" data-toggle="tab">S.E.O.</a></li> -->
						</ul>

						<div class="tab-content">

							<div class="tab-pane active" id="pestanageneral">
								<div class="panel panel-primary">
									<div class="panel-body">

										<div class="form-group">
											<label for="nombre" class="col-sm-2 control-label">Nombre:</label>
											<div class="col-sm-10"><input type="text" name="nombre" id="nombre" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->nombre))?>"></div>
										</div>

										<?/*<div class="form-group">
											<label for="descripcion" class="col-sm-2 control-label">Descripción:</label>
											<div class="col-sm-10"><textarea name="descripcion" id="descripcion" rows="16" class="form-control input-sm tinymce"><?echo utf8_encode(stripslashes($registro->descripcion))?></textarea></div>
										</div>*/?>

										<div class="form-group">
											<label for="precio" class="col-sm-2 control-label">Precio:</label>
											<div class="col-sm-10"><input type="text" name="precio" id="precio" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->precio))?>"></div>
										</div>

										<div class="form-group">
											<label for="precio2" class="col-sm-2 control-label">Precio 2:</label>
											<div class="col-sm-10"><input type="text" name="precio2" id="precio2" class="form-control input-sm" value="<?echo utf8_encode(stripslashes($registro->precio2))?>"></div>
										</div>


										<?/*<div class="form-group">
											<label for="activo" class="col-sm-2 control-label">Activo:</label>
											<div class="col-sm-10"><div class="checkbox"><label><input type="checkbox" name="activo" id="activo" value="1" <?if($registro->activo==1) echo "checked";?>  /></label></div></div>
										</div>*/?>
									</div>
								</div>
							</div>
							
							<?//************ SEO  *****************
							//include("formularioseo_editar.php");
							//************************************?>

						</div>

					</div>
				</div>

			
				<div class="form-group text-center">
					<?$rutaurl="index.php?opcion=".$this->opcion."&orden=".$orden."&ordenacion=".$ordenacion."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=".$inicio;?>

					<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-default" onclick="window.location.href='<?echo $rutaurl?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>&nbsp;
					<button type="submit" name="btnguardar" id="btnguardar" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Guardar </button>
				</div>

			</form>

			<?if ($registro->id>0){?>
				<?include("salashoras_editar.php");?>
			<?}?>
		</div>
	</div>
</div>