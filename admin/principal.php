<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  <title>Correos autorizados</title>
  <link rel="stylesheet" href="_css/estilo_admin.css" />
</head>
<body>
    <div >
      <h1>Correos autorizados</h1>
      <br>
      <form action="insertar_correo.php" method="post">
         <p> 
          <input type="text" name="nombre" id="nombre" placeholder="* Nombre" required size="60">
        </p>
        <p> 
          <input type="text" name="apellidos" id="apellidos" placeholder="* Apellidos" required size="60">
        </p>
        <p> 
          <input type="email" name="email" id="email" placeholder="* email" required size="60">
        </p>
		    <br/>
		    <button type="submit">Insertar Correo</button>
      </form>
      <br>
	  <?php
      require_once "init_local.php";

      $sql = "SELECT * FROM Correos";
      $resultado = mysqli_query($conexion, $sql) or die(mysqli_error($conexion));
	  /* Muestra el contenido de la BD

			echo "<div>";
            echo "Id " . " - "."Nombre ". "Apellidos "." - Correo ". " - Fecha Alta "." - Medio "."<br>";
            echo "</div>";
      while($fila = mysqli_fetch_array($resultado)){

  		
            echo "<div class='linea'>";
            echo $fila['id'] . " - ".$fila['nombre'] . $fila['apellidos'].$fila['correo'].$fila['fechaalta'].$fila['medio'];
			      echo   "<br>";
			      echo "</div>";

      }
      */

      // Muestra el contenido de la BD
      echo "<div>";
      echo "<table class='default'>";
        echo "<tr>";
          echo "<th>Id</th> ";
          echo "<th>Nombre</th> ";
          echo "<th>Apellidos</th> ";
          echo "<th> Correo </th>";
          echo "<th> Fecha Alta </th>";
          echo "<th> Medio </th>";
        echo "</tr>";
        while($fila = mysqli_fetch_array($resultado)){
        echo "<tr>";
          echo "<td>".$fila['id']."</td>";
          echo "<td>".$fila['nombre']."</td>";
          echo "<td>".$fila['apellidos']."</td>";
          echo "<td>".$fila['correo']."</td>";
          echo "<td>".$fila['fechaalta']."</td>";
          echo "<td>".$fila['medio']."</td>";
        echo "</tr>"; 
        }     
      echo "</table>";
      echo "</div>";







     ?>
    </div>
  </body>

</html>
