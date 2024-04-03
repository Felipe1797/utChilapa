<?php
	session_start();
	include("../conexion/conexion.php");
	class modelSeguimientoEgresados {
		var $IdSeguimiento;
		var $CarreraNombreCompletoEgresado;
		var $Testimonio;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelSeguimientoEgresados() {
			$this->conexion=new Conexion();
			$this->IdSeguimiento="";
			$this->CarreraNombreCompletoEgresado="";
			$this->Testimonio="";
			$this->Creado="";
			$this->IdUsuario="";
			$this->Activo="";
		}

		function getIdSeguimiento() { return $this->IdSeguimiento; }
		function getCarreraNombreCompletoEgresado() { return $this->CarreraNombreCompletoEgresado; }
		function getTestimonio() { return $this->Testimonio; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }
		function getActivo(){ return $this->Activo; }

		function setIdSeguimiento($IdSeguimiento) { $this->IdSeguimiento=$IdSeguimiento; }
		function setCarreraNombreCompletoEgresado($CarreraNombreCompletoEgresado) { $this->CarreraNombreCompletoEgresado=$CarreraNombreCompletoEgresado; }
		function setTestimonio($Testimonio) { $this->Testimonio=$Testimonio; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }
		function setActivo($Activo) { $this->Activo=$Activo; }

		function cinicial($vals) {
			$sql = "SELECT Id, CarreraNombreCompletoEgresado, Testimonio, Activo, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM TESTIMONIOEGRESADOS $vals ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='280px;'>Carrera Nombre Completo Egresado</th>
						<th>Testimonio</th>
						<th width='70px'>Activo</th>
						<th width='140px'>Publicada</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdSeguimiento = $row['Id'];
				$CarreraNombreCompletoEgresado = $row['CarreraNombreCompletoEgresado'];
				$Testimonio = $row['Testimonio'];
				$Activo = $row['Activo'];
				$Creado = $row['Creado'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $CarreraNombreCompletoEgresado))."</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Testimonio))."</td>
						<td>";
						if ($Activo==1) {
							$salida.="<i class='fa fa-check'></i>";
						} else if ($Activo==0) {
							$salida.="<i class='fa fa-minus'></i>";
						}
						$salida.="</td>
						<td>$Creado</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdSeguimiento\",\"$CarreraNombreCompletoEgresado\",\"$Testimonio\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdSeguimiento\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function agregar($CarreraNombreCompletoEgresado, $Testimonio) {
			$CarreraNombreCompletoEgresado = str_replace("'", "&apoxyz", $CarreraNombreCompletoEgresado);
			$CarreraNombreCompletoEgresado = str_replace('"', "&quoxyz", $CarreraNombreCompletoEgresado);
			$Testimonio = str_replace("'", "&apoxyz", $Testimonio);
			$Testimonio = str_replace('"', "&quoxyz", $Testimonio);
			$sqlAgregar = "INSERT INTO TESTIMONIOEGRESADOS(Id, CarreraNombreCompletoEgresado, Testimonio, Activo, Creado, IdUsuario) VALUES (0,'".$CarreraNombreCompletoEgresado."', '".$Testimonio."', true,NOW(), '".$_SESSION['usuario_id']."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Seguimiento a egresados');
		}

		function modificar($IdSeguimiento, $CarreraNombreCompletoEgresado, $Testimonio, $Activo) {
			$CarreraNombreCompletoEgresado = str_replace("'", "&apoxyz", $CarreraNombreCompletoEgresado);
			$CarreraNombreCompletoEgresado = str_replace('"', "&quoxyz", $CarreraNombreCompletoEgresado);
			$Testimonio = str_replace("'", "&apoxyz", $Testimonio);
			$Testimonio = str_replace('"', "&quoxyz", $Testimonio);
			$sqlModificar = "UPDATE TESTIMONIOEGRESADOS SET CarreraNombreCompletoEgresado='".$CarreraNombreCompletoEgresado."', Testimonio='".$Testimonio."', Activo=".$Activo." WHERE Id='".$IdSeguimiento."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Seguimiento a egresados');
		}

		function eliminar($IdSeguimiento) {
			$sqlEliminar = "DELETE FROM TESTIMONIOEGRESADOS WHERE Id='".$IdSeguimiento."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Seguimiento a egresados');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>