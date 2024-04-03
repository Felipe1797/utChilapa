<?php
	session_start();
	include("../conexion/conexion.php");
	class modelUniversidad {
		var $IdUni;
		var $Tipo;
		var $Descripcion;
		var $Creado;
		var $IdUsuario;
		var $contador;

		function modelUniversidad() {
			$this->conexion=new Conexion();
			$this->IdUni="";
			$this->Tipo="";
			$this->Descripcion="";
			$this->Creado="";
			$this->IdUsuario="";

		}

		function getIdUni() { return $this->IdUni; }
		function getTipo() { return $this->Tipo; }
		function getDescripcion() { return $this->Descripcion; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }


		function setIdUni($IdUni) { $this->IdUni=$IdUni; }
		function setTipo($Tipo) { $this->Tipo=$Tipo; }
		function setDescripcion($Descripcion) { $this->Descripcion=$Descripcion; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }


		function cinicial($vals) {
			$sql = "SELECT Id, Tipo, Descripcion, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM NUESTRA_UNIVERSIDAD $vals ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='280px;'>Tipo</th>
						<th>Descripcion</th>
						<th width='140px'>Publicada</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdUni = $row['Id'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$Creado = $row['Creado'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Tipo))."</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion))."</td>
						
						<td>$Creado</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdUni\",\"$Tipo\",\"$Descripcion\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdUni\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function agregar($Tipo, $Descripcion) {
			$Tipo = str_replace("'", "&apoxyz", $Tipo);
			$Tipo = str_replace('"', "&quoxyz", $Tipo);
			$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
			$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
			$sqlAgregar = "INSERT INTO NUESTRA_UNIVERSIDAD(Id, Tipo, Descripcion, Creado, IdUsuario) VALUES (0,'".$Tipo."', '".$Descripcion."', NOW(), '".$_SESSION['usuario_id']."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Nuestra Universidad');
		}

		function modificar($IdUni, $Tipo, $Descripcion) {
			$Tipo = str_replace("'", "&apoxyz", $Tipo);
			$Tipo = str_replace('"', "&quoxyz", $Tipo);
			$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
			$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
			$sqlModificar = "UPDATE NUESTRA_UNIVERSIDAD SET Tipo='".$Tipo."', Descripcion='".$Descripcion."' WHERE Id='".$IdUni."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Nuestra Universidad');
		}

		function eliminar($IdUni) {
			$sqlEliminar = "DELETE FROM NUESTRA_UNIVERSIDAD WHERE Id='".$IdUni."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Nuestra Universidad');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>