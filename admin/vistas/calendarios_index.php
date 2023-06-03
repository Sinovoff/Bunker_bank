<?include("busqueda_index.php");?>

<div class="table-responsive">
	<input type="hidden" id="ModeloTabla"	name="ModeloTabla"	value="<?echo $this->Modelo?>">

	<table id="example" class="table table-bordered table-striped">

		<?$rutaorden="index.php?opcion=".$this->opcion."&ordenacion=".$tipoorden."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=".$inicio;
		if ($orden!="") {
			if ($tipoorden=="")				$claseflecha='sortedASC';
			else if($tipoorden=="DESC")		$claseflecha='sortedDESC';
		}?>
		<thead>
			<tr>
				<th class="<?if ($orden=="fecha") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=fecha"					title="Fecha">Fecha Festiva</a></th>

				<th class="col-md-1">Editar</th>
				<th class="col-md-1">Borrar</th>
			</tr>
		</thead>

		<tbody>
			<?foreach($arrayRegistros as $registro){
				$rutaurl="index.php?opcion=".$this->opcion."&tiporegistro=".$this->opcion."&id=".$registro->id."&buscar=".$buscar."&buscartipo=". $buscartipo."&ordenacion=".$ordenacion."&orden=".$orden."&inicio=".$inicio;
				//******************************************************?>

				<tr>
					<td class="text-center"><?echo utf8_encode(stripslashes($registro->fecha->format("d-m-Y")))?></td>
					
					<td class="text-center"><a href="<?echo $rutaurl?>&tipofunc=editar" title="Editar"><img src="images/editar.gif" width="16" height="16" alt="Editar" /></a></td>
					<td class="text-center"><a href="<?echo $rutaurl?>&tipofunc=eliminar" class="eliminaSub" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" onclick="return confirmareliminar('¿Estás seguro que deseas eliminar el registro?')" /></a></td>
				</tr>
			<?}?>   
		</tbody>

	</table>
</div>

<div class="text-center">
	<ul class="pagination">
		<?$rutaURL="index.php?opcion=".$this->opcion."&ordenacion=".$ordenacion."&orden=".$orden."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=";
		Paginacion($numero_paginas, $tamano_pagina, $numeroRegistros, $inicio, $rutaURL);?>
	</ul>
</div>
