<?php
	session_start();
	include("../conexion/conexion.php");
	class modelVisitasIndustriales {
		var $IdCalendarioEscolar;
		var $Nombre;
		var $Descripcion;
		var $RutaImg;
		var $RutaNota;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelVisitasIndustriales () {
			$this->conexion=new Conexion();
			$this->IdCalendarioEscolar="";
			$this->Nombre="";
			$this->RutaImg="";
			$this->Activo="";
			$this->Creado="";
			$this->IdUsuario="";
		}

		function getIdCalendarioEscolar() { return $this->IdUsuario; }
		function getNombre() { return $this->Nombre; }
		function getRutaImg() { return $this->RutaImg; }
		function getActivo(){ return $this->Activo; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }

		function setIdCalendarioEscolar($IdCalendarioEscolar) { $this->IdCalendarioEscolar=$IdCalendarioEscolar; }
		function setNombre($Nombre) { $this->Nombre=$Nombre; }
		function setRutaImg($RutaImg) { $this->RutaImg=$RutaImg; }
		function setActivo($Activo) { $this->Activo=$Activo; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }

		function cinicial($vals) {
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, Activo, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM VISITASINDUSTRIALES $vals ORDER BY Creado DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th>Nombre</th>
						<th>Descripción</th>
						<th width='100px'>Imagen</th>
						<th width='70px'>Activo</th>
						<th width='140px'>Publicado</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdCalendarioEscolar = $row['Id'];
				$Nombre = $row['Nombre'];
				$Descripcion = $row['Descripcion'];
				$RutaImg = $row['RutaImg'];
				$Activo = $row['Activo'];
				$Creado = $row['Creado'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td align='justify'><div class='descripcion'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion))."</div></td>
						<td align='center'>
							<div class=''>
								<img src='$RutaImg?".time()."' class='img-responsive tblImage' onclick='(verImg(\"$RutaImg?".time()."\"))' style='cursor: pointer;' />
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
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdCalendarioEscolar\",\"$Nombre\",\"$Descripcion\",\"$RutaImg?".time()."\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdCalendarioEscolar\", \"$RutaImg\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdNota, $RutaImg) {
			$sqlEliminar = "DELETE FROM VISITASINDUSTRIALES WHERE Id='".$IdNota."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaImg)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Visitas industriales');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>