<div class="row">
	<?//******* Busqueda ****************?>
	<div class="col-md-7 mtop20">
		<form class="form-inline" name="frmBuscar" id="frmBuscar" action="index.php" method="post" role="form">
			<input type="hidden" id="opcion" name="opcion" value="<?echo $this->opcion?>" />

			<div class="form-group">
				<label for="buscar" class="control-label text-right"><strong>Buscar por:</strong></label>
			</div>

			<div class="form-group">
				<input type="text" name="buscar" id="buscar" class="form-control input-sm" value="<?echo $buscar?>">
			</div>

			<div class="checkbox">
				<label><input type="radio" name="buscartipo" id="buscartipo" value="0" <?if($buscartipo==0) echo "checked='checked'"?>/>&nbsp;Que contenga&nbsp;</label>
			</div>

			<div class="checkbox">
				<label><input type="radio"  name="buscartipo" id="buscartipo" value="1" <?if($buscartipo==1) echo "checked='checked'"?>/>&nbsp;Exacta&nbsp;&nbsp;</label>
			</div>

			<button type="submit" name="btnbuscar"  id="btnbuscar" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Buscar</button>	
		</form>
	</div>

	<?//******* Resultados ****************?>
	<div class="col-md-5 mtop20">
		<p style="margin-top:8px;"><strong><?echo $numeroRegistros?></strong> resultados</p>
	</div>
	
</div>

<?//******* Miga de pan ****************?>
<div class="row mtop10">
	<div class="col-md-12">
		<?if($seccione_id!=""){
			$textocategoria="";
			$textosubcategoria="";

			$opciones = array('conditions' => "id='".$seccione_id."'");
			$seccionebusqueda = Seccione::find($opciones);
			$urlvolver="index.php?opcion=secciones";

			if($categoria_id!=""){
				$textoseccion='<strong><a href="index.php?opcion=categorias&seccione_id='.$seccione_id.'">'.utf8_encode($seccionebusqueda->seccion).'</a></strong>';

				$opciones = array('conditions' => "id='".$categoria_id."'");
				$categoriabusqueda = Categoria::find($opciones);
				$urlvolver="index.php?opcion=categorias&seccione_id=".$seccione_id;

				if($subcategoria_id!=""){
					$textocategoria=' -> <strong><a href="index.php?opcion=subcategorias&seccione_id='.$seccione_id.'&categoria_id='.$categoria_id.'">'.utf8_encode($categoriabusqueda->categoria).'</a></strong>';

					$opciones = array('conditions' => "id='".$subcategoria_id."'");
					$subcategoriabusqueda = Subcategoria::find($opciones);
					$urlvolver="index.php?opcion=subcategorias&seccione_id=".$seccione_id."&categoria_id=".$categoria_id;
					
					$textosubcategoria=' -> <strong class="verde">'.utf8_encode($subcategoriabusqueda->subcategoria).'</strong>';
				}else{
					$textocategoria=' -> <strong class="verde">'.utf8_encode($categoriabusqueda->categoria).'</strong>';
				}
			}else{
				$textoseccion='<strong class="verde">'.utf8_encode($seccionebusqueda->seccion).'</strong>';
			}?>
			<p class="migaadmin">
				<?echo "Est&aacute;s en: ".$textoseccion." ".$textocategoria." ".$textosubcategoria;?>

				<?/*<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-warning" onclick="window.location.href='<?echo $urlvolver?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>*/?>

				<a href="<?echo $urlvolver?>" class="btn btn-warning" title="Volver"><span class="glyphicon glyphicon-chevron-left"></span> Volver</a>
			</p>
		
		<?}else if($noticiasseccione_id!=""){
			$textocategoria="";
			$textosubcategoria="";

			$opciones = array('conditions' => "id='".$noticiasseccione_id."'");
			$seccionebusqueda = Noticiasseccione::find($opciones);
			$urlvolver="index.php?opcion=noticiassecciones";

			if($noticiascategoria_id!=""){
				$textoseccion='<strong><a href="index.php?opcion=noticiascategorias&noticiasseccione_id='.$noticiasseccione_id.'">'.utf8_encode($seccionebusqueda->titulo).'</a></strong>';

				$opciones = array('conditions' => "id='".$noticiascategoria_id."'");
				$categoriabusqueda = Noticiascategoria::find($opciones);
				$urlvolver="index.php?opcion=noticiascategorias&noticiasseccione_id=".$noticiasseccione_id;

				
				$textocategoria=' -> <strong class="verde">'.utf8_encode($categoriabusqueda->titulo).'</strong>';
			}else{
				$textoseccion='<strong class="verde">'.utf8_encode($seccionebusqueda->titulo).'</strong>';
			}
			?>
			<p class="migaadmin">
				<?echo "Est&aacute;s en: ".$textoseccion." ".$textocategoria;?>

				<?/*<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-warning" onclick="window.location.href='<?echo $urlvolver?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>*/?>

				<a href="<?echo $urlvolver?>" class="btn btn-warning" title="Volver"><span class="glyphicon glyphicon-chevron-left"></span> Volver</a>
			</p>

		<?}else if($usuario_id!=""){
			$opciones = array('conditions' => "id='".$usuario_id."'");
			$usuariobusqueda = Usuario::find($opciones);?>
			<p class="migaadmin">
				<strong><?echo utf8_encode($usuariobusqueda->nombre)." - ".utf8_encode($usuariobusqueda->empresa)?></strong>

				<?/*<button type="button" name="btnVolver" id="btnVolver"  class="btn btn-warning" onclick="window.location.href='<?echo $urlvolver?>'"><span class="glyphicon glyphicon-chevron-left"></span> Volver</button>*/?>

				<a href="<?echo $urlvolver?>" class="btn btn-warning" title="Volver"><span class="glyphicon glyphicon-chevron-left"></span> Volver</a>
			</p>
		<?}?>
	</div>
</div>

<div class="row mtop10">
	<?//******* Añadir ****************?>
	<div class="col-md-7">
		<?if(($seccione_id!="")&&($categoria_id!="")&&($subcategoria_id!="")){
			$rutaanadir="index.php?opcion=".$this->opcion."&tipofunc=nuevo&seccione_id=".$seccione_id."&categoria_id=".$categoria_id."&subcategoria_id=".$subcategoria_id;
		}else if(($seccione_id!="")&&($categoria_id!="")){
			$rutaanadir="index.php?opcion=".$this->opcion."&tipofunc=nuevo&seccione_id=".$seccione_id."&categoria_id=".$categoria_id;
		}else if($seccione_id!=""){
			$rutaanadir="index.php?opcion=".$this->opcion."&tipofunc=nuevo&seccione_id=".$seccione_id;
		}else{
			$rutaanadir="index.php?opcion=".$this->opcion."&tipofunc=nuevo";
		}

		
		if(($this->opcion!="pedidos")){?>
			<p style=";color:blue;"><button type="button" name="btnAnadir" id="btnAnadir" style="color:#0088cc;" class="btn btn-default btn-lg blue" onclick="window.location.href='<?echo $rutaanadir?>'"><span class="glyphicon glyphicon-plus"></span> Añadir</button></p>
		<?}?>
	
	</div>

	<?//******* Paginacion ****************?>
	<div class="col-md-5">
		<div class="text-right">
			<ul class="pagination">	
				<?$rutaURL="index.php?opcion=".$this->opcion."&usuario_id=".$usuario_id."&ordenacion=".$ordenacion."&orden=".$orden."&buscar=".$buscar."&buscartipo=".$buscartipo."&inicio=";
				Paginacion($numero_paginas, $tamano_pagina, $numeroRegistros, $inicio, $rutaURL);?>		
			</ul>
		</div>
	</div>	
</div>
