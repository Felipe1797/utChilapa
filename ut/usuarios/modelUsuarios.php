<?php
	session_start();
	include("../conexion/conexion.php");
	class modelUsuarios {
		var $IdUsuario;
		var $Nombres;
		var $Apellidos;
		var $NombreUsuario;
		var $EMail;
		var $Contrasena;
		var $Activo;
		var $Cargo;
		var $Creado;
		var $contador;

		function modelUsuarios() {
			$this->conexion=new Conexion();
		}

		function cinicial($vals) {
			$sql = "SELECT USUARIOS.Id AS USUARIOSId, USUARIOS.Nombres AS Nombres, USUARIOS.Apellidos AS Apellidos, USUARIOS.NombreUsuario AS NombreUsuario, USUARIOS.EMail AS EMail, USUARIOS.Contrasena AS Contrasena, USUARIOS.Activo AS Activo, USUARIOS.Cargo AS Cargo, USUARIOS.Creado AS Creado, ACCESOS.Id AS ACCESOSId, ACCESOS.Banner AS Banner, ACCESOS.Avisos AS Avisos, ACCESOS.Notas AS Notas, ACCESOS.Calendarios AS Calendarios, ACCESOS.Becas AS Becas, ACCESOS.Requisitos AS Requisitos, ACCESOS.Documentos AS Documentos, ACCESOS.Visitas AS Visitas, ACCESOS.Seguimientos AS Seguimientos, ACCESOS.Movilidades AS Movilidades, ACCESOS.Directorios AS Directorios, ACCESOS.Titulos AS Titulos FROM ACCESOS INNER JOIN USUARIOS ON ACCESOS.Id = USUARIOS.Id $vals ORDER BY USUARIOS.Id";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
                <thead>
                    <tr>
                    	<th>#</th>
                        <th>Nombre Completo</th>
                        <th>Nombre de usuario</th>
                        <th>Email</th>
                        <th>Activo</th>
                        <th>Cargo</th>
                        <th width='104px'></th>
                    </tr>
                </thead>
                <tbody>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdUsuario = $row['USUARIOSId'];
				$Nombres = $row['Nombres'];
				$Apellidos = $row['Apellidos'];
				$NombreUsuario = $row['NombreUsuario'];
				$EMail = $row['EMail'];
				$Activo = $row['Activo'];
				$Cargo = $row['Cargo'];
				$Banner = $row['Banner'];
				$Avisos = $row['Avisos'];
				$Notas = $row['Notas'];
				$Calendarios = $row['Calendarios'];
				$Becas = $row['Becas'];
				$Requisitos = $row['Requisitos'];
				$Documentos = $row['Documentos'];
				$Visitas = $row['Visitas'];
				$Seguimientos = $row['Seguimientos'];
				$Movilidades = $row['Movilidades'];
				$Directorios = $row['Directorios'];
				$Titulos = $row['Titulos'];
				$salida.="
					<tr>
						<td>$contador</td>
	                    <td>$Nombres $Apellidos</td>
	                    <td>$NombreUsuario</td>
	                    <td>$EMail</td>
	                    <td>";
	                    if ($Activo==1) {
	                    	$salida.="<i class='fa fa-check'></i>";
	                    } else if ($Activo==0) {
	                    	$salida.="<i class='fa fa-minus'></i>";
	                    }
	                    $salida.="</td>
	                    <td>$Cargo</td>
	                    <td align='center'>
	                    	<div class='btn-group'>
                            	<button type='button' class='btn btn-info btn-xs fa fa-check' onclick='editarAcceso(\"$IdUsuario\",\"$Avisos\",\"$Notas\",\"$Calendarios\",\"$Becas\",\"$Requisitos\",\"$Documentos\",\"$Visitas\",\"$Seguimientos\",\"$Movilidades\",\"$Directorios\",\"$Titulos\",\"$Banner\");' data-toggle='tooltip' title='Editar accesos'"; if ($Cargo!="Personal") { $salida.="disabled"; } $salida.="></button>
                            </div>
	                    	<div class='btn-group'>
                                <button type='button' class='btn btn-warning btn-xs fa fa-edit' onclick='editar(\"$IdUsuario\",\"$Nombres\",\"$Apellidos\",\"$NombreUsuario\",\"$EMail\",\"$Activo\",\"$Cargo\");' data-toggle='tooltip' title='Editar'></button>
                            </div>
                            <div class='btn-group'>
                                <button type='button' class='btn btn-danger btn-xs glyphicon glyphicon-remove' onclick='eliminar(\"$IdUsuario\");' data-toggle='tooltip' title='Eliminar'></button>
                            </div>
                        </td>
	                </tr>";
			}
			$salida.="</tbody>
            </table>";
			echo $salida;
		}

		function agregar($IdUsuario, $Nombres , $Apellidos, $NombreUsuario, $EMail, $Contrasena, $Activo, $Cargo) {
			$sqlAgregar = "INSERT INTO USUARIOS(Id, Nombres, Apellidos, NombreUsuario, EMail, Contrasena, Activo, Cargo, Creado) VALUES (0,'".$Nombres."', '".$Apellidos."', '".$NombreUsuario."', '".$EMail."', '".sha1($Contrasena)."', ".$Activo.", '".$Cargo."',NOW())";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);

			$consulta="SELECT * FROM  USUARIOS ORDER BY Id DESC LIMIT 0,1";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($consulta);
			$row = $this->resultados->fetch_array();
			$Id = $row['Id'];

			if ($Cargo=='Super Usuario') {
				$sqlAgregar = "INSERT INTO ACCESOS(Id, Avisos, Notas, Calendarios, Becas, Requisitos, Documentos, Visitas, Seguimientos, Movilidades, Directorios, Titulos, Banner) VALUES ('$Id', true, true, true, true, true, true, true, true, true, true, true, true)";
			} else if ($Cargo=='Administrador') {
				$sqlAgregar = "INSERT INTO ACCESOS(Id, Avisos, Notas, Calendarios, Becas, Requisitos, Documentos, Visitas, Seguimientos, Movilidades, Directorios, Titulos ,Banner) VALUES ('$Id', true, true, true, true, true, true, true, true, true, true, false, true)";
			} else if ($Cargo=='Servicios Escolares') {
				$sqlAgregar = "INSERT INTO ACCESOS(Id, Avisos, Notas, Calendarios, Becas, Requisitos, Documentos, Visitas, Seguimientos, Movilidades, Directorios, Titulos, Banner) VALUES ('$Id', false, false, false, false, false, false, false, false, false, false, true, false)";
			} else if ($Cargo=='Personal') {
				$sqlAgregar = "INSERT INTO ACCESOS(Id, Avisos, Notas, Calendarios, Becas, Requisitos, Documentos, Visitas, Seguimientos, Movilidades, Directorios, Titulos, Banner) VALUES ('$Id', false, false, false, false, false, false, false, false, false, false, false, false)";
			}

			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlAgregar);

			echo "Bien";
			$this->bitacora('Registros',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Usuarios');
		}

		function modificar($IdUsuario, $Nombres , $Apellidos, $NombreUsuario, $EMail, $Contrasena, $Activo, $Cargo) {
			if ($IdUsuario==$_SESSION['usuario_id']) {
				$Activo=$_SESSION['usuario_activo'];
				$Cargo=$_SESSION['usuario_cargo'];
			}

			$sqlModificar = "";

			if (!empty($Contrasena)) {
				$sqlModificar = "UPDATE USUARIOS SET Nombres='".$Nombres."', Apellidos='".$Apellidos."', NombreUsuario='".$NombreUsuario."', EMail='".$EMail."', Contrasena='".sha1($Contrasena)."', Activo=".$Activo.", Cargo='".$Cargo."' WHERE Id='".$IdUsuario."'";
			} else {
				$sqlModificar = "UPDATE USUARIOS SET Nombres='".$Nombres."', Apellidos='".$Apellidos."', NombreUsuario='".$NombreUsuario."', EMail='".$EMail."', Activo=".$Activo.", Cargo='".$Cargo."' WHERE Id='".$IdUsuario."'";
			}
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			
			echo "Bien";
			$this->bitacora('Modificación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Usuarios');
		}

		function modificarAcceso($Id, $Avisos, $Notas, $Calendarios, $Becas, $Requisitos, $Documentos, $Visitas, $Seguimientos, $Movilidades, $Directorios, $Titulos, $Banner) {
			$sqlModificar = "UPDATE ACCESOS SET Avisos=$Avisos, Notas=$Notas, Calendarios=$Calendarios, Becas=$Becas, Requisitos=$Requisitos, Documentos=$Documentos, Visitas=$Visitas, Seguimientos=$Seguimientos, Movilidades=$Movilidades, Directorios=$Directorios, Titulos=$Titulos, Banner=$Banner WHERE Id='$Id'";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);

			$sql = "SELECT * FROM ACCESOS WHERE Id='".$_SESSION['usuario_id']."'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$row = $this->resultados->fetch_array();

			$_SESSION['accesos'] = array($row['Avisos'], $row['Notas'], $row['Calendarios'], $row['Becas'], $row['Requisitos'], $row['Documentos'], $row['Visitas'], $row['Seguimientos'], $row['Movilidades'], $row['Directorios'], $row['Titulos']);

			echo "Bien";
		}

		function validarEliminar($IdUsuario) {
			if ($IdUsuario!=$_SESSION['usuario_id']) { echo "Bien"; } else if ($IdUsuario==$_SESSION['usuario_id']) { echo "Error"; }
		}

		function eliminar($IdUsuario) {
			if ($IdUsuario!=$_SESSION['usuario_id']) {
				$sqlEliminar = "DELETE FROM USUARIOS WHERE Id='".$IdUsuario."'";
				$this->conexion->conexion->set_charset('utf8');
				$this->conexion->getConexion()->query($sqlEliminar);

				echo "Bien";
				$this->bitacora('Eliminación',$_SESSION['usuario_nombres']." ".$_SESSION['usuario_apellidos'],$_SESSION['usuario_cargo'],'Usuarios');
			} else if ($IdUsuario==$_SESSION['usuario_id']) {
				echo "Error";
			}
		}

		function bitacora($Operacion, $Usuario, $Cargo, $Tabla) {
			$sqlModificar = "INSERT INTO OPERACIONES(Id, Operacion, Usuario, Cargo, Realizado, Tabla) VALUES (0,'".$Operacion."','".$Usuario."','".$Cargo."',NOW(),'".$Tabla."')";
			$this->conexion->conexion->set_charset('utf8');
			$this->conexion->getConexion()->query($sqlModificar);
			return $sqlModificar;
		}
	}
?>