<?php
	session_start();
	include("../conexion/conexion.php");
	class modelNotas {
		var $IdNota;
		var $Nombre;
		var $Descripcion;
		var $RutaImg;
		var $RutaNota;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelNotas() {
			$this->conexion=new Conexion();
		}

		function cinicial($vals) {
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, RutaNota, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado, Activo FROM NOTAS $vals ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='145px'>Nombre</th>
						<th>Descripción</th>
						<th width='100px'>Imagen</th>
						<th>Nota</th>
						<th width='100px'>Publicada</th>
						<th width='70px'>Activo</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdNota = $row['Id'];
				$Nombre = $row['Nombre'];
				$Descripcion = $row['Descripcion'];
				$RutaImg = $row['RutaImg'];
				$RutaNota = $row['RutaNota'];
				$Creado = $row['Creado'];
				$Activo = $row['Activo'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td align='justify'><div style='max-height: 100px; overflow-y: scroll;'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion))."</div></td>
						<td>
							<div style='width:100px;'>
								<img src='$RutaImg?".time()."' class='img-responsive tblImage' onclick='(verImg(\"$RutaImg?".time()."\"))' style='cursor: pointer;' />
							</div>
						</td>
						<td>";
						if ($RutaNota!="") {
							$salida.="<a href='$RutaNota' class='btn btn-default btn-xs' target='_blanck'><i class='glyphicon glyphicon-share-alt'></i>Ir al sitio</a>";
						}
						$salida.="</td>
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
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdNota\",\"$Nombre\",\"$Descripcion\",\"$RutaImg?".time()."\",\"$RutaNota\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdNota\", \"$RutaImg\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdNota, $RutaImg) {
			$sqlEliminar = "DELETE FROM NOTAS WHERE Id='".$IdNota."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaImg)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Noticias');
		}

		function cinicialpromo($vals) {
			$sql = "SELECT Id, Tipo,Nombre, URL, RutaImg, Activo, DATE_FORMAT(Creado,'%d/%m/%Y') AS Creado FROM PROMOCIONES $vals ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl2' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th width='70px'>Tipo</th>
						<th>Nombre</th>
						<th width='50px'>URL</th>
						<th width='100px'>Imagen</th>
						<th width='70px'>Activo</th>
						<th width='100px'>Creado</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Id = $row['Id'];
				$Tipo = $row['Tipo'];
				$Nombre = $row['Nombre'];
				$URL = $row['URL'];
				$RutaImg = $row['RutaImg'];
				$Activo = $row['Activo'];
				$Creado = $row['Creado'];

				$salida.="
					<tr>
						<td>$contador</td>
						<td>$Tipo</td>
						<td align='justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</td>
						<td align='center'><a href='".str_replace('<iframe width="560" height="315" src="', '', str_replace('" frameborder="0" allowfullscreen></iframe>', '', str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $URL))))."' class='btn btn-default btn-xs' target='_blanck'><i class='glyphicon glyphicon-share-alt'></i>Ir al sitio</a></td>
						<td>";
							if (!empty($RutaImg)) {
								$salida.="<div style='width:100px;'>
									<img src='$RutaImg?".time()."' class='img-responsive tblImage' onclick='(verImg(\"$RutaImg?".time()."\"))' style='cursor: pointer;' />
								</div>";
							}
						$salida.="</td>
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
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editarpromo(\"$Id\",\"$Tipo\",\"$Nombre\",\"$URL\",\"$RutaImg?".time()."\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminarpromo(\"$Id\", \"$RutaImg\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminarpromo($Id, $RutaImg) {
			$sqlEliminar = "DELETE FROM PROMOCIONES WHERE Id='".$Id."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaImg)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Promociones');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>