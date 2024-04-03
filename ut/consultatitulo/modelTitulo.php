<?php
	session_start();
	include("../conexion/conexion.php");
	class modelTitulo {

		function modelTitulo() {
			$this->conexion=new Conexion();
		}

		function cinicial($vals) {
			$sql = "SELECT Matricula, Nombre, Carrera, Estado, Observaciones, DATE_FORMAT(Fecha,'%d/%m/%Y %H:%i:%s') AS Fecha, Activo FROM TITULOS ORDER BY Fecha DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='100px'>Matricula</th>
						<th width='200px;'>Nombre Completo</th>
						<th>Carrera</th>
						<th width='135px;'>Estado</th>
						<th>Observaciones</th>
						<th width='140px'>Fecha</th>
						<th width='70px'>Activo</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			while($row = $this->resultados->fetch_array()) {
				$Matricula = $row['Matricula'];
				$Nombre = $row['Nombre'];
				$Carrera = $row['Carrera'];
				$Estado = $row['Estado'];
				$Observaciones = $row['Observaciones'];
				$Fecha = $row['Fecha'];
				$Activo = $row['Activo'];
				$salida.="
					<tr>
						<td>$Matricula</td>
						<td>$Nombre</td>
						<td>$Carrera</td>
						<td>$Estado</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Observaciones))."</td>
						<td>$Fecha</td>
						<td>";
						if ($Activo==1) {
							$salida.="<i class='fa fa-check'></i>";
						} else if ($Activo==0) {
							$salida.="<i class='fa fa-minus'></i>";
						}
						$salida.="</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$Matricula\",\"$Nombre\",\"$Carrera\",\"$Estado\",\"$Observaciones\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$Matricula\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function ccargo() {
			$sql = "SELECT * FROM CARRERAS";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<select name='CargoAdd' id='cmbCargoAdd' class='form-control'>
				<option value=''>Seleccione una carrera</option>";
			while($row = $this->resultados->fetch_array()) {
				$salida .="<option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
			}
			$salida.="</select>
				<span class='form-control-feedback'><i class='fa fa-caret-down'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span class='help-block' style='text-align: justify;'>Nota: Si no se encuentran elemenetos en la lista, debe agregar carreras en la pestaña de carreras.</span>
			";
			echo $salida;
		}

		function ccargo2() {
			$sql = "SELECT * FROM CARRERAS";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<select name='CargoEdit' id='cmbCargoEdit' class='form-control'>";
			while($row = $this->resultados->fetch_array()) {
				$salida .="<option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
			}
			$salida.="</select>
				<span class='form-control-feedback'><i class='fa fa-caret-down'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			";
			echo $salida;
		}

		function cinicial2($vals) {
			$sql = "SELECT Id, Nombre FROM CARRERAS $vals";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl2' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='auto'>Carrera</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdCargo = $row['Id'];
				$Nombre = $row['Nombre'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>$Nombre</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar2(\"$IdCargo\",\"$Nombre\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar2(\"$IdCargo\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function agregar2($Nombre) {
			$sqlAgregar = "INSERT INTO CARRERAS(Id, Nombre) VALUES (0,'".$Nombre."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Carreras');
		}

		function agregar($Matricula, $Nombre, $Carrera, $Estado, $Observaciones) {
			$Observaciones = str_replace("'", "&apoxyz", $Observaciones);
			$Observaciones = str_replace('"', "&quoxyz", $Observaciones);
			$sqlAgregar = "INSERT INTO TITULOS(Matricula, Nombre, Carrera, Estado, Observaciones,Fecha, Activo) VALUES ('".$Matricula."','".$Nombre."', '".$Carrera."', '".$Estado."','".$Observaciones."', NOW(), true)";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Títulos');
		}

		function modificar($Matricula, $Nombre, $Carrera, $Estado, $Observaciones, $Activo) {
			$Observaciones = str_replace("'", "&apoxyz", $Observaciones);
			$Observaciones = str_replace('"', "&quoxyz", $Observaciones);
			$sqlModificar = "UPDATE TITULOS SET Nombre='".$Nombre."', Carrera='".$Carrera."', Estado='".$Estado."', Observaciones='".$Observaciones."', Fecha=NOW(), Activo=".$Activo." WHERE Matricula='".$Matricula."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Títulos');
		}

		function modificar2($IdCargo, $Nombre) {
			$sqlModificar = "UPDATE CARRERAS SET Nombre='".$Nombre."' WHERE Id='".$IdCargo."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Carreras');
		}


		function eliminar($Matricula) {
			$sqlEliminar = "DELETE FROM TITULOS WHERE Matricula='".$Matricula."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Títulos');
		}

		function eliminar2($IdCargo) {
			$sqlEliminar = "DELETE FROM CARRERAS WHERE Id='".$IdCargo."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>