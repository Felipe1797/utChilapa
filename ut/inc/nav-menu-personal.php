<div class="page-sidebar">
	<ul class="x-navigation">
		<li class="xn-logo">
			<a href="../personal"><i>UT UARM</i></a>
			<a href="#" class="x-navigation-control"></a>
		</li>
		<li class="xn-profile">
			<a href="../personal" class="profile-mini">
				<br>
				<i style="font-size: 24px;"><strong>UT</strong></i>
			</a>
		</li>
		<?php
			$salida="";
			$ApartadoAdministrador = array($_SESSION['usuario_accesos'][0],$_SESSION['usuario_accesos'][1],$_SESSION['usuario_accesos'][2],$_SESSION['usuario_accesos'][3],$_SESSION['usuario_accesos'][4],$_SESSION['usuario_accesos'][5],$_SESSION['usuario_accesos'][6],$_SESSION['usuario_accesos'][7],$_SESSION['usuario_accesos'][8],$_SESSION['usuario_accesos'][9],$_SESSION['usuario_accesos'][10]);

			$ApartadoConsulta = $_SESSION['usuario_accesos'][10];

			if (in_array("1", $ApartadoAdministrador)) {
				$salida.="<li class='xn-title'>Administración</li>
				<li "; if ($pageActive=='personal') {$salida.='class=\'active\'';} $salida.=">
					<a href='../personal'><i class='glyphicon glyphicon-home'></i><span class='xn-text'>Inicio</span></a>
				</li>";
				if ($ApartadoAdministrador[10]=="1") {
					$salida.="<li "; if ($pageActive=='banner') {$salida.='class=\'active\'';} $salida.=">
							<a href='../banner'><i class='glyphicon glyphicon-th'></i><span class='xn-text'>Banner</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[0]=="1") {
					$salida.="<li "; if ($pageActive=='avisos') {$salida.='class=\'active\'';} $salida.=">
							<a href='../avisos'><i class='fa fa-bell-o'></i><span class='xn-text'>Avisos</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[1]=="1") {
					$salida.="<li "; if ($pageActive=='notas') {$salida.='class=\'active\'';} $salida.=">
							<a href='../notas'><i class='fa fa-book'></i><span class='xn-text'>Noticias</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[2]=="1") {
					$salida.="<li "; if ($pageActive=='calendarioescolar') {$salida.='class=\'active\'';} $salida.=">
							<a href='../calendarioescolar'><i class='fa fa-calendar'></i><span class='xn-text'>Calendario escolar</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[3]=="1") {
					$salida.="<li "; if ($pageActive=='becas') {$salida.='class=\'active\'';} $salida.=">
							<a href='../becas'><i class='fa fa-foursquare'></i><span class='xn-text'>Becas</span></a>
						</li>";
				}
			
				if ($ApartadoAdministrador[3]=="1") {
					$salida.="<li "; if ($pageActive=='becas') {$salida.='class=\'active\'';} $salida.=">
							<a href='../becas'><i class='fa fa-foursquare'></i><span class='xn-text'>Becas Internas</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[4]=="1") {
					$salida.="<li "; if ($pageActive=='requisitostitulacion') {$salida.='class=\'active\'';} $salida.=">
							<a href='../requisitostitulacion'><i class='fa fa-file-text-o'></i><span class='xn-text'>Requisitos para titulación</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[5]=="1") {
					$salida.="<li "; if ($pageActive=='estadia') {$salida.='class=\'active\'';} $salida.=">
							<a href='../estadia'><i class='fa fa-files-o'></i><span class='xn-text'>Documentos para estadia</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[6]=="1") {
					$salida.="<li "; if ($pageActive=='visitasindustriales') {$salida.= 'class=\'active\'';} $salida.=">
							<a href='../visitasindustriales'><i class='fa fa-plane'></i><span class='xn-text'>Visitas Industriales</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[7]=="1") {
					$salida.="<li "; if ($pageActive=='seguimientoaegresados') {$salida.='class=\'active\'';} $salida.=">
							<a href='../seguimientoaegresados'><i class='glyphicon glyphicon-transfer'></i><span class='xn-text'>Seguimiento a egresados</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[8]=="1") {
					$salida.="<li "; if ($pageActive=='movilidad') {$salida.='class=\'active\'';} $salida.=">
							<a href='../movilidad'><i class='glyphicon glyphicon-share-alt'></i><span class='xn-text'>Movilidad</span></a>
						</li>";
				}
				if ($ApartadoAdministrador[9]=="1") {
					$salida.="<li "; if ($pageActive=='directorio') {$salida.='class=\'active\'';} $salida.=">
							<a href='../directorio'><i class='fa fa-list-ol'></i><span class='xn-text'>Directorio</span></a>
						</li>";
				}
			}
			if ($ApartadoConsulta=='1') {
				$salida.="
					<li class='xn-title'>Servivios escolares</li>
						<li "; if ($pageActive=='consultatitulo') {$salida.='class=\'active\'';} $salida.=">
							<a href='../consultatitulo'><i class='glyphicon glyphicon-book'></i><span class='xn-text'>Títulos</span></a>
						</li>";
			}
			echo $salida;
		?>
			
	</ul>
</div>