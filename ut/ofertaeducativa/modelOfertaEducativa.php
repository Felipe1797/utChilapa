<?php
	session_start();
	include("../conexion/conexion.php");
	class modelOfertaEducativa {
		var $IdOferta;
		var $Tipo;
		var $Descripcion;
		var $IdCarrera;
		var $IdUsuario;
		var $contador;

		function modelOfertaEducativa() {
			$this->conexion=new Conexion();
			$this->IdOferta="";
			$this->Tipo="";
			$this->Descripcion="";
			$this->IdCarrera="";
			$this->IdUsuario="";

		}

		function getIdOferta() { return $this->IdOferta; }
		function getTipo() { return $this->Tipo; }
		function getDescripcion() { return $this->Descripcion; }
		function getIdCarrera() { return $this->IdCarrera; }
		function getIdUsuario() { return $this->IdUsuario; }


		function setIdOferta($IdOferta) { $this->IdOferta=$IdOferta; }
		function setTipo($Tipo) { $this->Tipo=$Tipo; }
		function setDescripcion($Descripcion) { $this->Descripcion=$Descripcion; }
		function setIdCarrera($IdCarrera) { $this->IdCarrera=$IdCarrera; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }


		function cinicial($vals) {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA $vals";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='280px;'>Tipo</th>
						<th>Descripcion</th>
						<th width='140px'>IdCarrera</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$IdCarrera = $row['IdCarrera'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Tipo))."</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion))."</td>
						
						<td>$IdCarrera</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdOferta\",\"$Tipo\",\"$Descripcion\",\"$IdCarrera\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdOferta\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function agregar($Tipo, $Descripcion, $IdCarrera) {
			$Tipo = str_replace("'", "&apoxyz", $Tipo);
			$Tipo = str_replace('"', "&quoxyz", $Tipo);
			$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
			$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
			$IdCarrera = str_replace("'", "&apoxyz", $IdCarrera);
			$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
			$sqlAgregar = "INSERT INTO OFERTA_EDUCATIVA(IdOferta, Tipo, Descripcion, IdUsuario, IdCarrera) VALUES (0,'".$Tipo."', '".$Descripcion."', '".$_SESSION['usuario_id']."', '".$IdCarrera."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Oferta Educativa');
		}

		function modificar($IdOferta, $Tipo, $Descripcion, $IdCarrera) {
			$Tipo = str_replace("'", "&apoxyz", $Tipo);
			$Tipo = str_replace('"', "&quoxyz", $Tipo);
			$Descripcion = str_replace("'", "&apoxyz", $Descripcion);
			$Descripcion = str_replace('"', "&quoxyz", $Descripcion);
			$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
			$IdCarrera = str_replace('"', "&quoxyz", $IdCarrera);
			$sqlModificar = "UPDATE OFERTA_EDUCATIVA SET Tipo='".$Tipo."', Descripcion='".$Descripcion."', IdCarrera='".$IdCarrera."' WHERE IdOferta='".$IdOferta."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Oferta Educativa');
		}

		function eliminar($IdOferta) {
			$sqlEliminar = "DELETE FROM OFERTA_EDUCATIVA WHERE IdOferta='".$IdOferta."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Oferta Educativa');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>