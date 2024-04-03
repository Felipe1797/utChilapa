<?php
	session_start();
	include("../conexion/conexion.php");
	class modelo {
		var $IdCarrera;
		var $Nombre;
		var $IdUsuario;
		var $contador;

		function modelo() {
			$this->conexion=new Conexion();
			$this->IdCarrera="";
			$this->Nombre="";
			$this->IdUsuario="";
			
		}

		function getIdCarrera() { return $this->IdCarrera; }
		function getNombre() { return $this->Nombre; }
		function getIdUsuario() { return $this->IdUsuario; }
		

		function setIdCarrera($IdCarrera) { $this->IdCarrera=$IdCarrera; }
		function setNombre($Nombre) { $this->Nombre=$Nombre; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }


		function cinicial($vals) {
			$sql = "SELECT Id, Nombre FROM CARRERAS $vals";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='280px;'>Nombre</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdCarrera = $row['Id'];
				$Nombre = $row['Nombre'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdCarrera\",\"$Nombre\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdCarrera\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function agregar($Nombre) {
			$Nombre = str_replace("'", "&apoxyz", $Nombre);
			$Nombre = str_replace('"', "&quoxyz", $Nombre);
			$sqlAgregar = "INSERT INTO CARRERAS(Id, Nombre, IdUsuario) VALUES (0,'".$Nombre."', '".$_SESSION['usuario_id']."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Carreras');
		}

		function modificar($IdCarrera, $Nombre) {
			$Nombre = str_replace("'", "&apoxyz", $Nombre);
			$Nombre = str_replace('"', "&quoxyz", $Nombre);
			$sqlModificar = "UPDATE CARRERAS SET Nombre='".$Nombre."' WHERE Id='".$IdCarrera."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Carreras');
		}

		function eliminar($IdCarrera) {
			$sqlEliminar = "DELETE FROM CARRERAS WHERE Id='".$IdCarrera."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Carreras');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>