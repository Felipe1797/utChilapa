<?php
	session_start();
	include("../conexion/conexion.php");
	class model{
		var $IdCuatrimestre;
		var $Cuatrimestre;
		var $IdCarrera;
		var $IdUsuario;
		var $contador;

		function model() {
			$this->conexion=new Conexion();
			$this->IdCuatrimestre="";
			$this->Cuatrimestre="";
			$this->IdCarrera="";
			$this->IdUsuario="";

		}

		function getIdCuatrimestre() { return $this->IdCuatrimestre; }
		function getCuatrimestre() { return $this->Cuatrimestre; }
		function getIdCarrera() { return $this->IdCarrera; }
		function getIdUsuario() { return $this->IdUsuario; }


		function setIdCuatrimestre($IdCuatrimestre) { $this->IdCuatrimestre=$IdCuatrimestre; }
		function setCuatrimestre($Cuatrimestre) { $this->Cuatrimestre=$Cuatrimestre; }
		function setIdCarrera($IdCarrera) { $this->IdCarrera=$IdCarrera; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }


		function cinicial($vals) {
			$sql = "SELECT IdCuatrimestre, Cuatrimestre, IdCarrera FROM CUATRIMESTRES $vals";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='280px;'>Cuatrimestres</th>
						<th width='140px'>IdCarrera</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdCuatrimestre = $row['IdCuatrimestre'];
				$Cuatrimestre = $row['Cuatrimestre'];
				$IdCarrera = $row['IdCarrera'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Cuatrimestre))."</td>
					
						
						<td>$IdCarrera</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdCuatrimestre\",\"$Cuatrimestre\",\"$IdCarrera\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdCuatrimestre\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function agregar($Cuatrimestre, $IdCarrera) {
			$Cuatrimestre = str_replace("'", "&apoxyz", $Cuatrimestre);
			$Cuatrimestre = str_replace('"', "&quoxyz", $Cuatrimestre);
			$IdCarrera = str_replace("'", "&apoxyz", $IdCarrera);
			$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
			$sqlAgregar = "INSERT INTO CUATRIMESTRES(IdCuatrimestre, Cuatrimestre, IdCarrera, IdUsuario) VALUES (0,'".$Cuatrimestre."', '".$IdCarrera."', '".$_SESSION['usuario_id']."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Cuatrimestres');
		}

		function modificar($IdCuatrimestre, $Cuatrimestre, $IdCarrera) {
			$Cuatrimestre = str_replace("'", "&apoxyz", $Cuatrimestre);
			$Cuatrimestre = str_replace('"', "&quoxyz", $Cuatrimestre);
			$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
			$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
			$sqlModificar = "UPDATE CUATRIMESTRES SET Cuatrimestre='".$Cuatrimestre."', IdCarrera='".$IdCarrera."' WHERE IdCuatrimestre='".$IdCuatrimestre."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Cuatrimestres');
		}

		function eliminar($IdCuatrimestre) {
			$sqlEliminar = "DELETE FROM CUATRIMESTRES WHERE IdCuatrimestre='".$IdCuatrimestre."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Cuatrimestres');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>