<?php
//conexion a la base de datos
 $nombreservidor="localhost";
   $nombreusuario="root";
   $password="";
   $nombasedatos="proyecto";

   $id=(isset($_GET['id'])) ? $_GET['id'] : 0;;
   $nombre=$_POST['nombre_articulo'];
   $estado=$_POST['Estado_del_producto'];
   $descuento=$_POST['descuento'];
   $precio=$_POST['precio'];
   $descripcion=$_POST['descripcion'];
   $color=$_POST['color'];
   $dimensiones=$_POST['dimensiones'];
   $material=$_POST['material'];
   $dirarchivo=$_POST['categoria'];
   $vis=$_POST['visible'];

   mysqli_select_db($conexionBD,$nombasedatos);
        $bus="SELECT * FROM catalogo WHERE ID_ProductoC=$id ";
        $resultado = mysqli_query($conexionBD,$bus);
        while($result= mysqli_fetch_array($resultado))
        {$nombre=$result[1];
        $estado=$result[2];
        $precio=$result[3];
        $descrip=$result[4];
        $color=$result[5];
        $dimen=$result[6];
        $material=$result[7];
        $dir_ima=$result[8];
        $catalogo=$result[9];
        $vis=$result[10];
        $oferta=$result[11];
        $num_piezas=$result[12];
}

$respaldo="UPDATE catalogo SET NombreProductoC"
   $conexionBD= new mysqli($nombreservidor, $nombreusuario, $password, $nombasedatos);

   if (!$conexionBD)
   {
        die("Error de conexion!!".mysqli_connect_error());
   }
   else
{mysqli_select_db($conexionBD,"catalogo");
//comprobamos si ha ocurrido un error.
if ($_FILES["imagen"]["error"] > 0){
	echo "ha ocurrido un error";}
  else {
	//ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
	//y que el tamano del archivo no exceda los 100kb
	$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	$limite_kb = 1000;

	if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
		//esta es la ruta donde copiaremos la imagen
		//recuerden que deben crear un directorio con este mismo nombre
		//en el mismo lugar donde se encuentra el archivo subir.php
		$ruta = "../catalogo/imagenes/".$dirarchivo."/" . $_FILES['imagen']['name'];
		//comprobamos si este archivo existe para no volverlo a copiar.
		//pero si quieren pueden obviar esto si no es necesario.
		//o pueden darle otro nombre para que no sobreescriba el actual.
		if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
      $consulta="INSERT INTO catalogo(ID_ProductoC,NombreProductoC,EstadoProductoC,PrecioC,DescripcionC,ColorC,DimensionesC,MaterialC,Dir_imagen,Dir_archivo,visibilidad)
      VALUE('$id','$nombre','$estado','$precio','$descripcion','$color','$dimensiones','$material','$ruta','$dirarchivo','$vis')";

			if (mysqli_query($conexionBD, $consulta)) {
				echo "La informacion ha sido guardada exitosamente";
				$resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
				if ($resultado){
					$nombre = $_FILES['imagen']['name'];

					echo 'el archivo ha sido movido exitosamente, vuelva a intentarlo';
				} else {
          $consulta="DELETE FROM catalogo WHERE ID_ProductoC = $id";
          mysqli_query($conexionBD, $consulta);
					echo "ocurrio un error al mover el archivo, vuelva a intentarlo";
				}
			}
			else {
				echo 'error al registrar datos'.$consulta.mysqli_error($conexionBD);
        $consulta="DELETE FROM catalogo WHERE ID_ProductoC = $id";
        mysqli_query($conexionBD, $consulta);
			}
		} //final del if file_exists
		else {
			echo $_FILES['imagen']['name'] . ', este archivo existe, vuelva a intentarlo';
      $consulta="DELETE FROM catalogo WHERE ID_ProductoC = $id";
      mysqli_query($conexionBD, $consulta);
		}
	}//fin del if in_array
	else {
		echo 'archivo no permitido, es tipo de archivo prohibido o excede el tamano de '.$limite_kb.' Kilobytes, vuelva a intentarlo';
    $consulta="DELETE FROM catalogo WHERE ID_ProductoC = $id";
    mysqli_query($conexionBD, $consulta);
	}
}//fin para else $_FILES>0
}
?>
