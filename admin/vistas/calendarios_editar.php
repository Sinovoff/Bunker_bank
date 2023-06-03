<div class="row">
	<div class="panel panel-primary">

		<div class="panel-heading">			
			<h4 class="panel-title text-center"><strong>Editor de calendario de festivos</strong></h4>
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
						</ul>

						<div class="tab-content">

							<div class="form-group">		
								<label for="fechareserva" class="col-sm-3 control-label">Fecha:</label>
								<div class="col-sm-9" >			       
									<?if($registro->fecha!=""){
										$fecha = $registro->fecha->format('Y-m-d');
										$hora  = $registro->fecha->format('H:i');
									}else{
										$fecha = "0000-00-00";
										$hora  = "00:00";
									}
									if($fecha=="0000-00-00")	$fechacalendario=date("d-m-Y");
									else						$fechacalendario=$registro->fecha->format('d-m-Y');?>
									<div name="fecha" id="dp" class="input-append date col-sm-3"  data-date="<?echo $fechacalendario?>" data-date-format="dd-mm-yyyy"  style="padding-left:0">
										<div class="input-group">
											<input type="text" name="fecha" id="fecha" class="form-control input-sm text-center" size="16" value="<?echo seleccionar_fecha($fecha)?>" >
											<span class="input-group-addon"><span class="add-on" style="cursor: pointer;"><span class="glyphicon glyphicon-calendar"></span></span></span>
										</div>
									</div>	
								</div>
							</div>
							
						</div>

					</div>
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