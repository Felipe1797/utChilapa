<?php
	session_start();
	include("../conexion/conexion.php");
	class modelBanner {
		var $IdBeca;
		var $Nombre;
		var $Descripcion;
		var $RutaImg;
		var $RutaDoc;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelBanner() {
			$this->conexion=new Conexion();
		}

		function cinicial($vals) {
			$sql = "SELECT Id, Nombre, RutaImg, Activo, DATE_FORMAT(Creado,'%d/%m/%Y') AS Creado FROM BANNER $vals ORDER BY Creado DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th>Nombre</th>
						<th width='100px'>Imagen</th>
						<th width='100px'>Publicada</th>
						<th width='70px'>Activo</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdBeca = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$Creado = $row['Creado'];
				$Activo = $row['Activo'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td>
							<div style='width:100px;'>
								<img src='$RutaImg?".time()."' class='img-responsive tblImage' onclick='(verImg(\"$RutaImg?".time()."\"))' style='cursor: pointer;' />
							</div>
						</td>
						<td>$Creado</td>
						<td>";
						if ($Activo==1) {
							$salida.="<i class='fa fa-check'></i>";
						} else if ($Activo==0) {
							$salida.="<i class='fa fa-minus'></i>";
						}
						$salida.="</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdBeca\",\"$Nombre\",\"$RutaImg?".time()."\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdBeca\", \"$RutaImg\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdBeca, $RutaImg) {
			$sqlEliminar = "DELETE FROM BANNER WHERE Id='".$IdBeca."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaImg)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Banner');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>