<?include("busqueda_index.php");?>

<p class="mensajeordenar">* Arrastre y suelte para ordenar</p>

<div class="table-responsive">
	<input type="hidden" id="ModeloTabla"	name="ModeloTabla"	value="<?echo $this->Modelo?>" />

	<input type="hidden" id="seccioneindex_id"	name="seccioneindex_id"	value="<?echo $seccione_id?>" />

	<table id="tablaorden" class="table table-bordered table-striped">
		<?$rutaorden="index.php?opcion=".$this->opcion."&ordenacion=".$tipoorden."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=".$inicio;
		if ($orden!="") {
			if ($tipoorden=="")				$claseflecha='sortedASC';
			else if($tipoorden=="DESC")		$claseflecha='sortedDESC';
		}?>
		<thead>
			<tr>
				<th class="<?if ($orden=="titulo") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=titulo"					title="Título">Título</a></th>
				<th class="col-md-2 <?if ($orden=="imagen") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=imagen"					title="Imagen">Imagen</a></th>
				<th class="col-md-1 <?if ($orden=="destacado") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=destacado"				title="Destacada">Destacada</a></th>
				<th class="col-md-2 <?if ($orden=="orden") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=orden"					title="Orden">Orden</a></th>	
				<th class="col-md-1 <?if ($orden=="activo") echo $claseflecha?>">
					<a href="<?echo $rutaorden?>&orden=activo"					title="Activo">Activo</a></th>

				<th class="col-md-1">Editar</th>
				<th class="col-md-1">Borrar</th>
			</tr>
		</thead>

		<tbody>
			<?foreach($arrayRegistros as $registro){
				$rutaurl="index.php?opcion=".$this->opcion."&tiporegistro=".$this->opcion."&id=".$registro->id."&buscar=".$buscar."&buscartipo=". $buscartipo."&ordenacion=".$ordenacion."&orden=".$orden."&inicio=".$inicio;?>

				<tr id="registro-<?echo $registro->id?>">
					<td><?echo utf8_encode(stripslashes($registro->titulo))?></td>
					<td class="text-center"><?if ($registro->imagen!=""){?><a href="../galeria/<?echo $registro->imagen?>" title="<?echo stripslashes($registro->titulo)?>" class="gallery"><img src="../galeria/<?echo $registro->imagen?>" style="height:24px" ></a><?}?></td>
					
					<td class="text-center"><a href="#" class="cambiarcampo" id="destacado_<?echo $registro->id?>"><?echo campo_Activo($registro->destacado) ?></a></td>
					<td class="claseorden text-center"><?echo $registro->orden?></td>
					
					<td class="text-center"><a href="#" class="cambiarcampo" id="activo_<?echo $registro->id?>"><?echo campo_Activo($registro->activo) ?></a></td>
					
					
					<td class="text-center"><a href="<?echo $rutaurl?>&tipofunc=editar" title="Editar"><img src="images/editar.gif" width="16" height="16" alt="Editar" /></a></td>
					<td class="text-center"><a href="<?echo $rutaurl?>&tipofunc=eliminar" title="Eliminar"><img src="images/eliminar.gif" width="16" height="16" alt="Eliminar" onclick="return confirmareliminar('¿Estás seguro que deseas eliminar el registro?')" /></a></td>
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