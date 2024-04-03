<?php
	session_start();
	include("../conexion/conexion.php");
	class modelAsignatura {
		var $IdAsignatura;
		var $Nombre;
		var $Descripcion;
		var $RutaImg;
		var $RutaNota;
		var $Creado;
		var $IdUsuario;
		var $IdCuatrimestre;
		var $IdCarrera;
		var $contador;

		function modelAsignatura () {
			$this->conexion=new Conexion();
			$this->IdAsignatura="";
			$this->Nombre="";
			$this->RutaDoc="";
			$this->IdCuatrimestre="";
			$this->IdCarrera="";
			$this->Creado="";
			$this->IdUsuario="";
		}

		function getIdAsignatura() { return $this->IdAsignatura; }
		function getNombre() { return $this->Nombre; }
		function getRutaDoc() { return $this->RutaDoc; }
		function getIdCuatrimestre(){ return $this->IdCuatrimestre; }
		function getIdCarrera(){ return $this->IdCarrera; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }

		function setIdAsignatura($IdAsignatura) { $this->IdAsignatura=$IdAsignatura; }
		function setNombre($Nombre) { $this->Nombre=$Nombre; }
		function setRutaDoc($RutaDoc) { $this->RutaDoc=$RutaDoc; }
		function setIdCuatrimestre($IdCuatrimestre) { $this->IdCuatrimestre=$IdCuatrimestre; }
		function setIdCarrera($IdCarrera) { $this->IdCarrera=$IdCarrera; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }

		function cinicial($vals) {
			$sql = "SELECT Id, Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM ASIGNATURAS $vals ORDER BY Id";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th>Nombre</th>
						<th width='100px'>Tipo</th>
						<th width='100px'>Documento</th>
						<th width='70px'>IdCuatrimestre</th>
						<th width='70px'>IdCarrera</th>
						<th width='140px'>Publicado</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdAsignatura = $row['Id'];
				$Nombre = $row['Nombre'];
				$Nivel = $row['Tipo'];
				$RutaDoc = $row['RutaDoc'];
				$IdCuatrimestre = $row['IdCuatrimestre'];
				$IdCarrera = $row['IdCarrera'];
				$Creado = $row['Creado'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td>$Nivel</td>
						<td align='center'>
							<div style='width:100px;'>
								<div class='btn-group'>
									<button type='button' class='btn btn-default btn-xs' onclick='verImg(\"$RutaDoc?".time()."\");'><i class='fa fa-eye'></i>Ver Documento</button>
								</div>
							</div>
						</td>
						<td>$IdCuatrimestre</td>
						<td>$IdCarrera</td>
						<td>$Creado</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdAsignatura\",\"$Nombre\",\"$Nivel\",\"$RutaDoc?".time()."\",\"$IdCuatrimestre\",\"$IdCarrera\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdAsignatura\", \"$RutaDoc\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdNota, $RutaDoc) {
			$sqlEliminar = "DELETE FROM ASIGNATURAS WHERE Id='".$IdNota."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaDoc)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Asignaturas');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>