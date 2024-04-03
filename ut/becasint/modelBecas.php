<?php
	session_start();
	include("../conexion/conexionint.php");
	class modelBecas {
		var $IdBeca;
		var $Nombre;
		var $Descripcion;
		var $RutaImg;
		var $RutaDoc;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelBecas() {
			$this->conexion=new Conexion();
			$this->IdBeca="";
			$this->Nombre="";
			$this->Descripcion="";
			$this->RutaImg="";
			$this->RutaDoc="";
			$this->Creado="";
			$this->IdUsuario="";
			$this->Activo="";
		}

		function getIdBeca() { return $this->IdBeca; }
		function getNombre() { return $this->Nombre; }
		function getDescripcion() { return $this->Descripcion; }
		function getRutaImg() { return $this->RutaImg; }
		function getRutaDoc() { return $this->RutaDoc; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }
		function getActivo(){ return $this->Activo; }

		function setIdBeca($IdBeca) { $this->IdBeca=$IdBeca; }
		function setNombre($Nombre) { $this->Nombre=$Nombre; }
		function setDescripcion($Descripcion) { $this->Descripcion=$Descripcion; }
		function setRutaImg($RutaImg) { $this->RutaImg=$RutaImg; }
		function setRutaDoc($RutaDoc) { $this->RutaDoc=$RutaDoc; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }
		function setActivo($Activo) { $this->Activo=$Activo; }

		function cinicial($vals) {
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, RutaDoc, Activo, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM BECAS $vals ORDER BY Creado DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='150px'>Nombre</th>
						<th>Descripción</th>
						<th width='100px'>Imagen</th>
						<th width='10px'>Documento</th>
						<th width='140px'>Publicada</th>
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
				$Descripcion = $row['Descripcion'];
				$RutaImg = $row['RutaImg'];
				$RutaDoc = $row['RutaDoc'];
				$Creado = $row['Creado'];
				$Activo = $row['Activo'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion))."</td>
						<td>
							<div style='width:100px;'>
								<img src='$RutaImg?".time()."' class='img-responsive' onclick='(verImg(\"$RutaImg?".time()."\"))' style='cursor: pointer;' />
							</div>
						</td>
						<td align='center'>
							<div style='width:107px;'>
								<div class='btn-group'>
									<button type='button' class='btn btn-default btn-xs' onclick='verImg(\"$RutaDoc?".time()."\");'><i class='fa fa-eye'></i>Ver Convocatoria</button>
								</div>
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
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdBeca\",\"$Nombre\",\"$Descripcion\",\"$RutaImg?".time()."\",\"$RutaDoc?".time()."\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdBeca\", \"$RutaImg\", \"$RutaDoc\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdBeca, $RutaImg, $RutaDoc) {
			$sqlEliminar = "DELETE FROM BECAS WHERE Id='".$IdBeca."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaImg)){}
			if(@unlink($RutaDoc)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Becas');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>