<?php
	session_start();
	include("../conexion/conexion.php");
	class modelEstadia {
		var $IdEstadia;
		var $Nombre;
		var $Descripcion;
		var $RutaImg;
		var $RutaNota;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelEstadia () {
			$this->conexion=new Conexion();
			$this->IdEstadia="";
			$this->Nombre="";
			$this->RutaDoc="";
			$this->Activo="";
			$this->Creado="";
			$this->IdUsuario="";
		}

		function getIdEstadia() { return $this->IdEstadia; }
		function getNombre() { return $this->Nombre; }
		function getRutaDoc() { return $this->RutaDoc; }
		function getActivo(){ return $this->Activo; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }

		function setIdEstadia($IdEstadia) { $this->IdEstadia=$IdEstadia; }
		function setNombre($Nombre) { $this->Nombre=$Nombre; }
		function setRutaDoc($RutaDoc) { $this->RutaDoc=$RutaDoc; }
		function setActivo($Activo) { $this->Activo=$Activo; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }

		function cinicial($vals) {
			$sql = "SELECT Id, Nivel, TipoFormato, Nombre, RutaDoc, Activo, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM FORMATOSESTADIAS $vals ORDER BY Nivel DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='100px'>Nivel</th>
						<th>Tipo de formato</th>
						<th>Nombre del formato</th>
						<th width='100px'>Documento</th>
						<th width='70px'>Activo</th>
						<th width='140px'>Publicado</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdEstadia = $row['Id'];
				$Nivel = $row['Nivel'];
				$TipoFormato = $row['TipoFormato'];
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$Activo = $row['Activo'];
				$Creado = $row['Creado'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>$Nivel</td>
						<td>$TipoFormato</td>
						<td>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td align='center'>
							<div style='width:100px;'>
								<div class='btn-group'>
									<button type='button' class='btn btn-default btn-xs' onclick='verImg(\"$RutaDoc?".time()."\");'><i class='fa fa-eye'></i>Ver Documento</button>
								</div>
							</div>
						</td>
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
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdEstadia\",\"$Nivel\",\"$TipoFormato\",\"$Nombre\",\"$RutaDoc?".time()."\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdEstadia\", \"$RutaDoc\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdNota, $RutaDoc) {
			$sqlEliminar = "DELETE FROM FORMATOSESTADIAS WHERE Id='".$IdNota."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaDoc)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Requisitos para estadia');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>