<?php
	session_start();
	include("../conexion/conexion.php");
	class modelDirectorio {
		var $IdSeguimiento;
		var $CarreraNombreCompletoEgresado;
		var $Testimonio;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelDirectorio() {
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
			$sql = "SELECT DIRECTORIOS.Id AS DIRECTORIOSId, DIRECTORIOS.NombreCompleto AS DIRECTORIOSNombreCompleto, DIRECTORIOS.EMail AS DIRECTORIOSEMail, DIRECTORIOS.IdCargoDirectorios AS DIRECTORIOSIdCargoDirectorios, DIRECTORIOS.IdUsuario AS DIRECTORIOSIdUsuario, DIRECTORIOS.Activo AS DIRECTORIOSActivo, DIRECTORIOS.TelExt AS DIRECTORIOSTelExt, DIRECTORIOS.Creado AS DIRECTORIOSCreado, CARGODIRECTORIOS.Id AS CARGODIRECTORIOSId, CARGODIRECTORIOS.Nombre AS CARGODIRECTORIOSNombre, CARGODIRECTORIOS.Nivel AS CARGODIRECTORIOSNivel FROM CARGODIRECTORIOS INNER JOIN DIRECTORIOS ON CARGODIRECTORIOS.Id = DIRECTORIOS.IdCargoDirectorios $vals ORDER BY CARGODIRECTORIOSNivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='260px;'>Nombre Completo</th>
						<th>Cargo</th>
						<th width='100px;'>Email</th>
						<th width='75px'>Ext. Tel.</th>
						<th width='70px'>Activo</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdDirectivo = $row['DIRECTORIOSId'];
				$Nombre = $row['DIRECTORIOSNombreCompleto'];
				$IdCargo = $row['DIRECTORIOSIdCargoDirectorios'];
				$Cargo = $row['CARGODIRECTORIOSNombre'];
				$EMail = $row['DIRECTORIOSEMail'];
				$Activo = $row['DIRECTORIOSActivo'];
				$TelExt = $row['DIRECTORIOSTelExt'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>$Nombre</td>
						<td>$Cargo</td>
						<td>$EMail</td>
						<td>$TelExt</td>
						<td>";
						if ($Activo==1) {
							$salida.="<i class='fa fa-check'></i>";
						} else if ($Activo==0) {
							$salida.="<i class='fa fa-minus'></i>";
						}
						$salida.="</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdDirectivo\",\"$Nombre\",\"$IdCargo\",\"$EMail\",\"$Activo\",\"$TelExt\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdDirectivo\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function ccargo() {
			$sql = "SELECT * FROM CARGODIRECTORIOS ORDER BY Nivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<select name='CargoAdd' id='cmbCargoAdd' class='form-control'>
				<option value=''>Seleccione un cargo</option>";
			while($row = $this->resultados->fetch_array()) {
				$salida .="<option value='".$row['Id']."'>".$row['Nombre']."</option>";
			}
			$salida.="</select>
				<span class='form-control-feedback'><i class='fa fa-caret-down'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				<span class='help-block' style='text-align: justify;'>Nota: Si no se encuentran elemenetos en la lista, debe agregar cargos en la pestaña de cargo.</span>
			";
			echo $salida;
		}

		function ccargo2() {
			$sql = "SELECT * FROM CARGODIRECTORIOS ORDER BY Nivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<select name='CargoEdit' id='cmbCargoEdit' class='form-control'>";
			while($row = $this->resultados->fetch_array()) {
				$salida .="<option value='".$row['Id']."'>".$row['Nombre']."</option>";
			}
			$salida.="</select>
				<span class='form-control-feedback'><i class='fa fa-caret-down'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
			";
			echo $salida;
		}

		function cinicial2($vals) {
			$sql = "SELECT Id, Nombre, Nivel FROM CARGODIRECTORIOS $vals ORDER BY Nivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl2' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='auto'>Nombre Cargo</th>
						<th width='100px'>Nivel</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdCargo = $row['Id'];
				$Nombre = $row['Nombre'];
				$Nivel = $row['Nivel'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>$Nombre</td>
						<td>$Nivel</td>
						<td align='center'>
							<div class='btn-group'>
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar2(\"$IdCargo\",\"$Nombre\",\"$Nivel\");' data-toggle='tooltip' title='Editar'></button>
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

		function agregar2($Nombre, $Nivel) {
			$sqlAgregar = "INSERT INTO CARGODIRECTORIOS(Id, Nombre, Nivel) VALUES (0,'".$Nombre."', '".$Nivel."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
		}

		function agregar($Nombre, $IdCargo, $Email, $TelExt) {
			$sqlAgregar = "INSERT INTO DIRECTORIOS(Id, NombreCompleto, IdCargoDirectorios, EMail, Activo, Creado, IdUsuario, TelExt) VALUES (0,'".$Nombre."', '".$IdCargo."', '".$Email."', true, NOW(), '".$_SESSION['usuario_id']."','".$TelExt."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);
			
			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Directorio');
		}

		function modificar($IdDirectivo, $Nombre, $IdCargo, $Email, $Activo, $TelExt) {
			$sqlModificar = "UPDATE DIRECTORIOS SET NombreCompleto='".$Nombre."', IdCargoDirectorios='".$IdCargo."', EMail='".$Email."', Activo=".$Activo.", TelExt='".$TelExt."' WHERE Id='".$IdDirectivo."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Directorio');
		}

		function modificar2($IdCargo, $Nombre, $Nivel) {
			$sqlModificar = "UPDATE CARGODIRECTORIOS SET Nombre='".$Nombre."', Nivel='".$Nivel."' WHERE Id='".$IdCargo."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
		}


		function eliminar($IdDirectivo) {
			$sqlEliminar = "DELETE FROM DIRECTORIOS WHERE Id='".$IdDirectivo."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Directorio');
		}

		function eliminar2($IdCargo) {
			$sqlEliminar = "DELETE FROM CARGODIRECTORIOS WHERE Id='".$IdCargo."'";
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