<?php
	session_start();
	include("../conexion/conexion.php");
	class modelSuperUsuarios {

		function modelSuperUsuarios() {
			$this->conexion=new Conexion();
		}

		function cinicial($vals) {
			$sql = "SELECT Id, Operacion, Usuario, Cargo, DATE_FORMAT(Realizado,'%d/%m/%Y %H:%i:%s') AS Realizado, Tabla FROM OPERACIONES $vals ORDER BY Realizado DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
                <thead>
                    <tr>
                    	<th>#</th>
                        <th>Operación</th>
                        <th>Usuario</th>
                        <th>Cargo</th>
                        <th>Realizado</th>
                        <th>Tabla</th>
                        <th width='135xp'><label><input type='checkbox' name='select_all' value='1' id='tbl1-select-all'> Seleccionar todo</label></th>
                    </tr>
                </thead>
                <tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOperacion = $row['Id'];
				$Operacion = $row['Operacion'];
				$Usuario = $row['Usuario'];
				$Cargo = $row['Cargo'];
				$Realizado = $row['Realizado'];
				$Tabla = $row['Tabla'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td>$Operacion</td>
	                    <td>$Usuario</td>
	                    <td>$Cargo</td>
	                    <td>$Realizado</td>
	                    <td>$Tabla</td>
	                    <td align='center'>$IdOperacion</td>
	                </tr>";
			}
			$salida.="</tbody>
            </table>";
			echo $salida;
		}

		function eliminar($vals) {
			$vals = explode(",", $vals);
			for ($i=0; $i < count($vals); $i++) { 
				$sqlEliminar = "DELETE FROM OPERACIONES WHERE Id='".$vals[$i]."'";
				$this->conexion->conexion->set_charset('utf8');
				$this->conexion->getConexion()->query($sqlEliminar);
			}

			echo "Bien";
		}
	}
?>