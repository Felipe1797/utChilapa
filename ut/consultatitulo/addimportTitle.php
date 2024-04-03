<?php
	include('modelTitulo.php');
	$titulo = new modelTitulo;
	require_once('../conexion/conexionValidacion.php');

	if(isset($_FILES["DocImport"]["type"])) {
		if ($_FILES["DocImport"]["type"]!=null ) {

			$docImport = $_FILES["DocImport"]["name"];
			$docImport_tmp = $_FILES["DocImport"]["tmp_name"];
			$destino = $docImport;
			
			if (@move_uploaded_file($docImport_tmp, $destino)) {
				$delimiters = array('|', ';', '^', "\t");
				$delimiter = ',';

				$str = file_get_contents($destino);
				$str = str_replace($delimiters, $delimiter, $str);
				file_put_contents($destino, $str);

				if (($docImport = fopen("$destino","r")) !== FALSE) {
					while (($datos =fgetcsv($docImport,1000,',')) !== FALSE ) {
						$linea[]=array('Matricula'=>$datos[0],'Nombre'=>$datos[1],'Carrera'=>$datos[2],'Estado'=>$datos[3]);
					}
					fclose ($docImport);
				}
				
				$ingresado=0;
				$error=0;
				$duplicado=0;
				echo "<br>Operación realizada con éxito. Presione el botón 'Quitar' para limpiar o solo seleccione otro documento.<br><br>";
				echo "<table width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='100px'>Matricula</th>
						<th width='260px;'>Nombre Completo</th>
						<th>Carrera</th>
						<th width='135px;'>Estado</th>
						<th width='300px;'>Mensajes</th>
					</tr>
				</thead>
				<tbody>";
			    foreach($linea as $indice=>$value) {
					$Matricula=$value["Matricula"];
					$Nombre=$value["Nombre"];
					$Carrera=$value["Carrera"];
					$Estado=$value["Estado"];

					echo "<tr>
							<td>$Matricula</td>
							<td>$Nombre</td>
							<td>$Carrera</td>
							<td>$Estado</td>
						";
					$tildes = $conexion->query("SET NAMES 'utf8'");
					$sql=mysqli_query($conexion,"SELECT * FROM TITULOS WHERE Matricula='$Matricula'");
					$num=mysqli_num_rows($sql);
					if ($num==0) {
						if ($insert=mysqli_query($conexion,"INSERT INTO TITULOS(Matricula, Nombre, Carrera, Estado, Fecha, Activo) values('$Matricula','$Nombre','$Carrera','$Estado',NOW(),true)")) {
							echo $msj="<td><font color=green>Alumno: <b>$Matricula $Nombre</b>. Guardado.</font></td>";
							$ingresado+=1;
						} else {
							echo $msj="<td><font color=red>El Alumno: <b>$Matricula $Nombre</b>. No Guardado.</font></td>";
							$error+=1;
						}
					} else {
						$duplicado+=1;
						echo $duplicate="<td><font color=red>El Alumno: <b>$Matricula $Nombre</b>. Ya se encuentra registrado mejor actualice los datos.<br></font></td>";
					}
					echo "</tr>";
				}
				echo "</tbody></table>";
				/*echo "<font color=green>".number_format($ingresado,2)." Productos Almacenados con exito<br/>";
				echo "<font color=red>".number_format($duplicado,2)." Productos Duplicados<br/>";
				echo "<font color=red>".number_format($error,2)." Errores de almacenamiento<br/>";*/
				$titulo->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Títulos');
			} else {
				echo "Se ha producido un error al subir el fichero\n";
			}
			if (@unlink($destino)) {}
		}
	}

	if(isset($_FILES["DocUpdate"]["type"])) {
		if ($_FILES["DocUpdate"]["type"]!=null ) {

			$docUpdate = $_FILES["DocUpdate"]["name"];
			$docUpdate_tmp = $_FILES["DocUpdate"]["tmp_name"];
			$destino = $docUpdate;
			
			if (@move_uploaded_file($docUpdate_tmp, $destino)) {
				$delimiters = array('|', ';', '^', "\t");
				$delimiter = ',';

				$str = file_get_contents($destino);
				$str = str_replace($delimiters, $delimiter, $str);
				file_put_contents($destino, $str);
				
				if (($docUpdate = fopen("$destino","r")) !== FALSE) {
					while (($datos =fgetcsv($docUpdate,1000,',')) !== FALSE ) {
						$linea[]=array('Matricula'=>$datos[0],'Nombre'=>$datos[1],'Carrera'=>$datos[2],'Estado'=>$datos[3]);
					}
					fclose ($docUpdate);
				}
				
				$ingresado=0;
				$error=0;
				$duplicado=0;
				echo "<br>Operación realizada con éxito. Presione el botón 'Quitar' para limpiar o solo seleccione otro documento.<br><br>";
				echo "<table width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='100px'>Matricula</th>
						<th width='260px;'>Nombre Completo</th>
						<th>Carrera</th>
						<th width='135px;'>Estado</th>
						<th width='300px;'>Mensajes</th>
					</tr>
				</thead>
				<tbody>";
			    foreach($linea as $indice=>$value) {
					$Matricula=$value["Matricula"];
					$Nombre=$value["Nombre"];
					$Carrera=$value["Carrera"];
					$Estado=$value["Estado"];

					echo "<tr>
							<td>$Matricula</td>
							<td>$Nombre</td>
							<td>$Carrera</td>
							<td>$Estado</td>
						";
					$tildes = $conexion->query("SET NAMES 'utf8'");
					$sql=mysqli_query($conexion,"SELECT * FROM TITULOS WHERE Matricula='$Matricula'");
					$num=mysqli_num_rows($sql);
					if ($num!=0) {
						if ($insert=mysqli_query($conexion,"UPDATE TITULOS SET Nombre='".$Nombre."', Carrera='".$Carrera."', Estado='".$Estado."' , Fecha=NOW() WHERE Matricula='".$Matricula."'")) {
							echo $msj="<td><font color=green>El Alumno: <b>$Matricula $Nombre</b>. Se actualizo con éxito.</font></td>";
							$ingresado+=1;
						} else {
							echo $msj="<td><font color=red>El Alumno: <b>$Matricula $Nombre</b>. No se actualizo.</font></td>";
							$error+=1;
						}
					} else {
						$duplicado+=1;
						echo $duplicate="<td><font color=red>El Alumno: <b>$Matricula $Nombre</b>. No se encuentra registrado. Registrelo.<br></font></td>";
					}
					echo "</tr>";
				}
				echo "</tbody></table>";
				/*echo "<font color=green>".number_format($ingresado,2)." Productos Almacenados con exito<br/>";
				echo "<font color=red>".number_format($duplicado,2)." Productos Duplicados<br/>";
				echo "<font color=red>".number_format($error,2)." Errores de almacenamiento<br/>";*/
				$titulo->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Títulos');
			} else {
				echo "Se ha producido un error al subir el fichero\n";
			}
			if (@unlink($destino)) {}
		}
	}
?>