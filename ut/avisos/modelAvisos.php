<?php
	session_start();
	include("../conexion/conexion.php");
	class modelAvisos {
		var $IdAvisos;
		var $CarreraNombreCompletoEgresado;
		var $Testimonio;
		var $Creado;
		var $IdUsuario;
		var $Activo;
		var $contador;

		function modelAvisos() {
			$this->conexion=new Conexion();
			$this->IdAvisos="";
			$this->CarreraNombreCompletoEgresado="";
			$this->Testimonio="";
			$this->Creado="";
			$this->IdUsuario="";
			$this->Activo="";
		}

		function getIdAvisos() { return $this->IdAvisos; }
		function getCarreraNombreCompletoEgresado() { return $this->CarreraNombreCompletoEgresado; }
		function getTestimonio() { return $this->Testimonio; }
		function getCreado() { return $this->Creado; }
		function getIdUsuario() { return $this->IdUsuario; }
		function getActivo(){ return $this->Activo; }

		function setIdAvisos($IdAvisos) { $this->IdAvisos=$IdAvisos; }
		function setCarreraNombreCompletoEgresado($CarreraNombreCompletoEgresado) { $this->CarreraNombreCompletoEgresado=$CarreraNombreCompletoEgresado; }
		function setTestimonio($Testimonio) { $this->Testimonio=$Testimonio; }
		function setCreado($Creado) { $this->Creado=$Creado; }
		function setIdUsuario($IdUsuario) {$this->IdUsuario=$IdUsuario; }
		function setActivo($Activo) { $this->Activo=$Activo; }

		function cinicial($vals) {
			$sql = "SELECT Id, RutaImg,Descripcion, Activo, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM AVISOS $vals ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1'  class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='40px'>#</th>
						<th>Avisos</th>
						<th>Activo</th>
						<th>Publicada</th>
						<th width='80px'></th>
					</tr>
				</thead>
				<tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdAvisos = $row['Id'];
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];
				$Activo = $row['Activo'];
				$Creado = $row['Creado'];
				$salida.="
					<tr>
						<td>$contador</td>
						<td align='center'><button onclick='show".$contador."();' class='btn btn-default btn-xs' ><i class='fa fa-eye'></i>Ver aviso</button>
							<div class='modal fade' role='modal' aria-labelledby='gridSystemModalLabel' id='info-m".$contador."'>
								<div class='modal-dialog' role='document'>
									<div class='modal-content'>
										<div class='modal-header' style='background: white; border-radius: 0px; border-bottom: 0px;'>
											<button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
											<h3 class='modal-title text-center' id='gridSystemModalLabel'>!Aviso!!!</h3>
										</div>
										<div class='modal-body'>
											<div class=''>";
												if ($RutaImg!="") {
													$salida.="
													<div class='form-group'>
														<label class='col-md-3 control-label'></label>
														<div class='col-md-6'>
															<img src='".$RutaImg."' class='img-responsive' alt='Ceneval' />
															<p style='color: white;'>_</p>
														</div>
													</div>";
												}
												$salida.="
												<div class='form-group'>
													<div class='col-md-12' style='text-align: left;'>
														".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion))."
													</div>
												</div>
												<div><p style='color: white;'>_</p></div>
											</div>
										</div>
										<div class='modal-footer' style='background: white; border-radius: 0px; border-top: 0px;'></div>
									</div>
								</div>
							</div>
							<script type='application/javascript'>
								function show".$contador." (){
									$(\"#info-m".$contador."\").modal();
								}
							</script>
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
								<button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdAvisos\",\"$RutaImg\",\"$Descripcion\",\"$Activo\");' data-toggle='tooltip' title='Editar'></button>
							</div>
							<div class='btn-group'>
								<button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdAvisos\",\"$RutaImg\");' data-toggle='tooltip' title='Eliminar'></button>
							</div>
						</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>";
			echo $salida;
		}

		function eliminar($IdAvisos, $RutaImg) {
			$sqlEliminar = "DELETE FROM AVISOS WHERE Id='".$IdAvisos."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlEliminar);

			if(@unlink($RutaImg)){}

			echo "Bien";
			$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Avisos');
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>