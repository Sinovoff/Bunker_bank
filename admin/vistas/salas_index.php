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
				<th class="<?if ($orden=="nombre") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=nombre"					title="Nombre">Nombre</a></th>
				<th class="col-md-2 <?if ($orden=="nombre") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=nombre"					title="Precio">Precio</a></th>
				<th class="col-md-2 <?if ($orden=="precio2") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=precio2"					title="Precio 2">Precio_2</a></th>
				<?/*<th class="col-md-1 <?if ($orden=="activo") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=activo"					title="Activo">Activo</a></th>*/?>

				<th class="col-md-1">Editar</th>
				<th class="col-md-1">Borrar</th>
			</tr>
		</thead>

		<tbody>
			<?foreach($arrayRegistros as $registro){
				$rutaurl="index.php?opcion=".$this->opcion."&tiporegistro=".$this->opcion."&id=".$registro->id."&buscar=".$buscar."&buscartipo=". $buscartipo."&ordenacion=".$ordenacion."&orden=".$orden."&inicio=".$inicio;
				//******************************************************?>

				<tr>
					<td><?echo utf8_encode(stripslashes($registro->nombre))?></td>
					<td><?echo number_format($registro->precio, 2, ',', '')?></td>
					<td><?echo number_format($registro->precio2, 2, ',', '')?></td>
					<?/*<td class="text-center"><a href="#" class="cambiarcampo" id="activo_<?echo $registro->id?>"><?echo campo_Activo($registro->activo) ?></a></td>*/?>
					
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
