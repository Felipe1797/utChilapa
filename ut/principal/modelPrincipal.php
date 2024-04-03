<?php
	
	include($_SERVER["DOCUMENT_ROOT"].'/ut/conexion/conexion.php');

	if (isset($_POST['opcion'])) {
		$modelPrincipal = new modelPrincipal;
		switch($_POST['opcion']) {
			case 'consultatitulo':
				$modelPrincipal->consultatitulo($_POST['Nombre'],$_POST['Nivel']);
				break;
			case 'consultavisitas':
				$modelPrincipal->consultavisitas($_POST['pageNewNum']);
				break;
			case 'consultamovilidadestudiantil':
				$modelPrincipal->consultamovilidadestudiantil($_POST['pageNewNum']);
				break;
			case 'consultamovilidaddocentes':
				$modelPrincipal->consultamovilidaddocentes($_POST['pageNewNum']);
				break;
			case 'consultacarreras':
				$modelPrincipal->consultacarreras();
				break;
		}
	}

	if (isset($_GET['op'])) {
		$modelPrincipal = new modelPrincipal;
		switch($_GET['op']) {
			case 'consultanoticias':
				$modelPrincipal->consultamovilidaddocentes($_GET['pageNewNum']);
				break;
		}
	}

	class modelPrincipal {

		function modelPrincipal() {
			$this->conexion=new Conexion();
		}

		function wordlimit($string, $length, $ellipsis) {
			$words = explode(' ', $string);
			if (count($words) > $length) {
				return implode(' ', array_slice($words, 0, $length)) ." ". $ellipsis;
			} else {
				return $string;
			}
		}
		
        
        function consultaLaIdDeCarreras() {
			$sql = "SELECT Id, Nombre, IdUsuario FROM CARRERAS";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "
			<div class='form-group'>
				<label class='col-md-3 control-label'>* IdCarrera:</label>
					<div class='col-md-8'> 
						<select class='form-control' name='IdCarreraAdd' id='tfIdCarreraAdd'>
						  <option value=''>Seleccione una opción</option>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Id = $row['Id'];
				$salida.="<option value='".$Id."'>$Id</option>";
			}
			$salida.=" </select>
					   <span class='form-control-feedback'><i class='fa fa-caret-down'></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				    </div>
			 </div>";
			echo $salida;
		}
        
    	function consultaQuienesSomos() {
			$sql = "SELECT Tipo, Descripcion FROM NUESTRA_UNIVERSIDAD WHERE Tipo='¿QUIENES SOMOS?'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-12 wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms' style='text-align: justify;'>
				<div class='border'>";

			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				
				<h3 class='borde-left'>$Tipo</h3>
				<p>$Descripcion</p>";
			}
			$salida.="</div></div>";
			echo $salida;
		}
        
        function consultaNuestraUniversidad() {
			$sql = "SELECT * FROM `NUESTRA_UNIVERSIDAD` WHERE `Tipo` NOT LIKE '¿QUIENES SOMOS?'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='col-md-6 wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='500ms' style='text-align: justify;'>
                    <div class='border'>
				        <h3 class='borde-left'>$Tipo</h3>
				        <p>$Descripcion</p>
				    </div>
				</div>";
			}
			$salida.="";
			echo $salida;
		}


        # OFERTA EDUCATIVA
        
        function consultaOfertaEducativaTIC() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Misión <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				        Formar técnicos superiores universitarios de alto nivel humano y académico, que cumplan y den respuestas inmediatas a las necesidades de su entorno productivo y social, prestando servicios que propicien la innovación y transferencia tecnológica en nuestra región, impulsando la vinculación del sector productivo y de servicio con el sistema educativo estatal y nacional en un marco de excelencia.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-tic' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}
        
        
        
    	function consultaOfertaEducativaCONTA() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Misión <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	El Programa Educativo de Técnico Superior Universitario en Contaduría, es formador de profesionales en las áreas contables, fiscales y financieras, que el sector social y productivo demanda, a través del cumplimiento del plan de estudios basado en competencias profesionales orientado a la optimización de recursos del ente económico.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-conta' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}


    	function consultaOfertaEducativaDN() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Misión <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	Formar Técnicos Superiores Universitarios de alto nivel humano y académico, que sean capaces de desarrollar proyectos productivos, sociales y privados, mediante las investigaciones y estrategias mercadológicas, que contribuyan al desarrollo regional, satisfaciendo las necesidades generadas por los cambios del mercado local, nacional e internacional.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-dn' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}


    	function consultaOfertaEducativaTI() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Perfil <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	El Ingeniero en Tecnologías de la Información cuenta con las competencias profesionales necesarias para su desempeño en el campo laboral, en el ámbito, local, regional y nacional.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-ti' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}


    	function consultaOfertaEducativaIFF() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='5'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Competencias Profesionales <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	Las competencias profesionales son las destrezas y actitudes que le permiten desarrollar actividades en su área profesional, adaptarse a nuevas situaciones, así como transferir, si es necesario, sus conocimientos, habilidades y actitudes a áreas profesionales próximas. Las competencias profesionales que integran el perfil profesional del Ingeniero Financiero y Fiscal se clasifican en dos categorías: Competencias Genéricas: Son las que permiten al egresado aprender a lo largo de su vida y son comunes a todos los perfiles profesionales; y están integradas por la capacidad de análisis y síntesis, habilidades para la investigación básica, las capacidades individuales y las destrezas sociales. Asimismo, se incluyen las competencias que caracterizan a los egresados del modelo educativo de las Universidades Tecnológicas, es decir, las habilidades gerenciales y las habilidades para comunicarse en un segundo idioma. Competencias Específicas: Son la base de la especialización y constituyen el sustento teórico-metodológico que caracteriza a la disciplina, y permiten responder a necesidades específicas de cada sector productivo y/o región.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-iff' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}


    	function consultaOfertaEducativaDIE() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='6'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Perfil <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	El Ingeniero en desarrollo e innovación empresarial cuenta con las competencias profesionales necesarias para su desempeño en el campo laboral, en el ámbito, local, regional y nacional.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-die' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}



    	function consultaOfertaEducativaTICdespresurizado() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Misión <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				        Formar técnicos superiores universitarios de alto nivel humano y académico, que cumplan y den respuestas inmediatas a las necesidades de su entorno productivo y social, prestando servicios que propicien la innovación y transferencia tecnológica en nuestra región, impulsando la vinculación del sector productivo y de servicio con el sistema educativo estatal y nacional en un marco de excelencia.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-tic-despresurizado' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}


    	function consultaOfertaEducativaTIdespresurizado() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Perfil <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	El Ingeniero en Tecnologías de la Información cuenta con las competencias profesionales necesarias para su desempeño en el campo laboral, en el ámbito, local, regional y nacional.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-ti-despresurizado' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}



    	function consultaOfertaEducativaLicINM() {
			$sql = "SELECT IdOferta, Tipo, Descripcion, IdCarrera FROM OFERTA_EDUCATIVA WHERE IdCarrera='11'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
				<div class='panel panel-ut'>
				   <div class='panel-heading' role='tab' id='headinguno'>
				    <a role='button' data-toggle='collapse' data-parent='#accordion' href='#collapseuno' aria-expanded='true' aria-controls='collapseuno'>
				      	<h4 class='panel-title'>
				          Perfil <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				   </div>
				    <div id='collapseuno' class='panel-collapse collapse in' role='tabpanel' aria-labelledby='headinguno'>
				      <div class='panel-body' style='text-align: justify;'>
				      	El Licenciado en Innovación de Negocios y Mercadotecnia en competencias profesionales necesarias para su desempeño en el campo laboral en las áreas de Finanzas, Mercadotecnia, Publicidad, Desarrollo de Productos, Innovación Comercial, Planeación y Evaluación de Proyectos, Capital Humano, Relaciones Públicas.
				      </div>
				    </div>
				</div>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$IdOferta = $row['IdOferta'];
				$Tipo = $row['Tipo'];
				$Descripcion = $row['Descripcion'];
				$salida.="
				<div class='panel panel-ut'>
					<div class='panel-heading' role='tab' id='headinguno'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapse$IdOferta' aria-expanded='false' aria-controls='collapse$IdOferta'>
				      	<h4 class='panel-title'>
				          $Tipo <i class='glyphicon glyphicon-plus pull-right'></i>
				      	</h4>
				      </a>
				    </div>
				    <div id='collapse$IdOferta' class='panel-collapse collapse' role='tabpanel' aria-labelledby='heading$IdOferta'>
				      <div class='panel-body' style='text-align: justify;'>$Descripcion</div>
				    </div>
				</div>";
			}
			$salida.="
			<div class='panel panel-ut'>
				    <div class='panel-heading' role='tab' id='headingcinco'>
				      <a class='collapsed' role='button' data-toggle='collapse' data-parent='#accordion' href='#collapsecinco' aria-expanded='false' aria-controls='collapsecinco'>
				      	<h4 class='panel-title'>
				          Plan de estudios <i class='glyphicon glyphicon-plus pull-right'></i>
				        </h4>
				      </a>
				    </div>
				    <div id='collapsecinco' class='panel-collapse collapse' role='tabpanel' aria-labelledby='headingcinco'>
				      <div class='panel-body'>
				      <a href='/oferta-educativa/plan-innovacion' data-tooltipp='tooltip' data-placement='top' title='Ver plan de estudios'><i class='glyphicon glyphicon-list-alt'></i> Ver plan de estudios</a>
				      </div>
				    </div>
				</div>
			</div>";
			echo $salida;
		}





        
        
        
        
        #PLAN TIC TSU
        
        function consultaAsignaturasTSUticCuatri1() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='1' AND IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasTSUticCuatri2() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='2' AND IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticCuatri3() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='3' AND IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticCuatri4() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='4' AND IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticCuatri5() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='5' AND IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticCuatri6() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='6' AND IdCarrera='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        
        #PLAN TIC TSU DESPRESURISAZADO
        
        function consultaAsignaturasTSUticDespresurizadoCuatri1() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='34' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasTSUticDespresurizadoCuatri2() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='35' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticDespresurizadoCuatri3() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='36' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticDespresurizadoCuatri4() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='37' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticDespresurizadoCuatri5() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='38' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticDespresurizadoCuatri6() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='39' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticDespresurizadoCuatri7() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='40' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasTSUticDespresurizadoCuatri8() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='41' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUticDespresurizadoCuatri9() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='42' AND IdCarrera='9'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

        
        
        
        #PLAN TSU CONTA
        
        function consultaAsignaturasTSUcontaCuatri1() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='7' AND IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-conta'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasTSUcontaCuatri2() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='8' AND IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-conta'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUcontaCuatri3() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='9' AND IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-conta'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUcontaCuatri4() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='10' AND IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-conta'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUcontaCuatri5() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='11' AND IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-conta'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUcontaCuatri6() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='12' AND IdCarrera='2'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-conta'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

        
        
        
        #PLAN TSU DN
        
        function consultaAsignaturasTSUdesarrollodenegociosCuatri1() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='13' AND IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-dn'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasTSUdesarrollodenegociosCuatri2() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='14' AND IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-dn'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUdesarrollodenegociosCuatri3() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='15' AND IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-dn'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUdesarrollodenegociosCuatri4() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='16' AND IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-dn'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUdesarrollodenegociosCuatri5() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='17' AND IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-dn'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasTSUdesarrollodenegociosCuatri6() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='18' AND IdCarrera='3'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-dn'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

        
        
        
        
        #PLAN ING TI
        
        function consultaAsignaturasINGtiCuatri7() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='19' AND IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInLeft' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasINGtiCuatri8() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='20' AND IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiCuatri9() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='21' AND IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiCuatri10() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='22' AND IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiCuatri11() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='23' AND IdCarrera='4'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        
        #PLAN ING TI DESPRESURIZADO
        
        function consultaAsignaturasINGtiDespresurizadoCuatri1() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='43' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasINGtiDespresurizadoCuatri2() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='44' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri3() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='TSU' AND IdCuatrimestre='45' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri4() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='46' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInLeft' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri5() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='47' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInLeft' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri6() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='48' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInLeft' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri7() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='49' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasINGtiDespresurizadoCuatri8() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='50' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri9() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='51' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInLeft' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri10() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='52' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri11() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='53' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGtiDespresurizadoCuatri12() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='54' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasINGtiDespresurizadoCuatri13() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='55' AND IdCarrera='10'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-tic wow fadeInRight' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
	
        
        
        #PLAN ING IFF
        
        function consultaAsignaturasINGiffCuatri7() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='24' AND IdCarrera='5'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-fif wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasINGiffCuatri8() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='25' AND IdCarrera='5'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-fif wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGiffCuatri9() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='26' AND IdCarrera='5'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-fif wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGiffCuatri10() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='27' AND IdCarrera='5'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content tsu-tic wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGiffCuatri11() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='28' AND IdCarrera='5'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-fif wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        
        #ING PLAN DIE
        
		function consultaAsignaturasINGdieCuatri7() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='29' AND IdCarrera='6'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasINGdieCuatri8() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='30' AND IdCarrera='6'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGdieCuatri9() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='31' AND IdCarrera='6'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGdieCuatri10() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='32' AND IdCarrera='6'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasINGdieCuatri11() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='ING' AND IdCuatrimestre='33' AND IdCarrera='6'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        
        #ING PLAN LIC EN MERCADOTECNIA
        
        function consultaAsignaturasLICenMercadotecniaCuatri7() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='LIC' AND IdCuatrimestre='56' AND IdCarrera='11'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}
        
        function consultaAsignaturasLICenMercadotecniaCuatri8() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='LIC' AND IdCuatrimestre='57' AND IdCarrera='11'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasLICenMercadotecniaCuatri9() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='LIC' AND IdCuatrimestre='58' AND IdCarrera='11'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasLICenMercadotecniaCuatri10() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='LIC' AND IdCuatrimestre='59' AND IdCarrera='11'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

		function consultaAsignaturasLICenMercadotecniaCuatri11() {
			$sql = "SELECT Nombre, RutaDoc, Tipo, IdCuatrimestre, IdCarrera FROM ASIGNATURAS WHERE Tipo='LIC' AND IdCuatrimestre='60' AND IdCarrera='11'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='cd-timeline-content ing-dn wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='300ms'>
			                <ul class='lista-des' >";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'> $Nombre</a></li>";
			}
			$salida.="</ul></div>";
			echo $salida;
		}

        
        
        
        
        

        function consultareglamentos() {
			$sql = "SELECT Nombre, RutaDoc, Activo FROM REGLAMENTOS WHERE Activo='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='tabla-regla'>
				<h3>REGLAMENTOS ACADÉMICOS</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<li><a href='".$RutaDoc."' target='_blank'><font color='black'>$Nombre</a></li>";
			}
			$salida.="</div>";
			echo $salida;
		}


		function consultabannerramdon() {
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' ORDER BY Id";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
		
		
		function consultabannerramdonConta() {
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' and Nombre='contaduria'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
			function consultabannerramdonDesarrolloDeNegocios() {
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' and Nombre='Desarrollo de Negocios'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
		
			function consultabannerramdonTIC(){
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' and Nombre='TIC'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
		
			function consultabannerramdonDIE(){
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' and Nombre='Desarrollo e Innovación Empresarial'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
		
		
			function consultabannerramdonIFF(){
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' and Nombre='Financiero y Fiscal'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
		function consultabannerramdonITI(){
			$sql = "SELECT Id, Nombre, RutaImg, Activo FROM BANNER WHERE Activo='1' and Nombre='ITI'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$arrayRamdon = array();
			$rowcount = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				array_push($arrayRamdon, '<header class="parallax-ut2" data-stellar-background-ratio="0.5" style="background-image: url('.$RutaImg.'"><div class="colo"></div></header>');
			}

			$rowcount = rand(0,($rowcount-1));

			echo $arrayRamdon[$rowcount];
		}
		
		

		function consultabanner() {
			$sql = "SELECT Id, RutaImg, DATE_FORMAT(Creado,'%d/%m/%Y') AS Creado, Activo FROM BANNER WHERE Activo='1' ORDER BY Id";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$salida.='
					<li><img src="'.($RutaImg).'" alt=""/>';
						if (!empty($Nombre)) {
							$salida.='
								<div class="conte-slider hidden-sm hidden-xs">
									<div class="text-slider hidden-sm hidden-xs">
										<div class="textto">
											<br>
											<p>'.str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre)).'</p>
										</div>
									</div>
								</div>';
						}
					$salida.='</li>';
			}
			echo $salida;
		}

		function consultaindex() {
			$sql = "SELECT Id,Nombre, Descripcion, RutaImg, RutaNota, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado, Activo FROM NOTAS WHERE Activo='1' ORDER BY Id DESC LIMIT 0,5";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$Descripcion = $row['Descripcion'];
				$RutaImg = $row['RutaImg'];
				$RutaNota = $row['RutaNota'];
				$salida.="
					<div class='row single-article' style='padding-top: 0 15px 5px; margin-bottom: 20px;'>
						<div class='col-xs-12 col-sm-12 col-md-12'>
							<a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre'>
								<img src='".$RutaImg."' alt='".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."' title='".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."' style='float: left; margin-right: 20px; margin-bottom: 0; width:390px; max-height:205px; object-fit: cover;'>
							</a>
							<a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre'>
								<h3 class='entry-title'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</h3>
							</a>
							<div class='entry-content'>
								<p style='text-align: justify;'>";
									$salida.=$this->wordlimit(str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion)),50,"...");
								$salida.="</p>
							</div>
						</div>
	                </div>";
			}
			echo $salida;
		}

		function consultanoticias($pagina) {
			$salida = "";
			$present = '';
			if (isset($_GET['b'])) {
				$present = $_GET['b'];
			}
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, Activo FROM NOTAS WHERE Activo='1' AND (CONCAT(Nombre,' ',Descripcion) LIKE '%$present%') ORDER BY Id DESC";

			if(!empty($_GET["pagina"])) {
				$pagina = $_GET['pagina'];
			}

			$perPage = 15;
			$page = 1;
			if(!empty($pagina)) {
				$page = $pagina;
			}

			$start = ($page-1)*$perPage;
			if($start < 0) $start = 0;

			if ($present!="") $perPage = 15;
			
			$query =  $sql . " LIMIT " . $start . "," . $perPage;

			if(empty($_POST["rowcount"])) {
				$this->conexion->conexion->set_charset('utf8');
				$this->resultados = $this->conexion->getConexion()->query($sql);
				$rowcount = mysqli_num_rows($this->resultados);
				$_POST["rowcount"] = $rowcount;
			}
			$pages  = ceil($_POST["rowcount"]/$perPage);

			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($query);

			if(!empty($this->resultados)){
				$salida.= '
				<div style="margin-left: 15px; margin-right: 15px;">
					<h2 class="widget-title"><span>Noticias</span></h2>
				</div>
				<form action="/noticias.php" method="get">
					<div class="imagencontainer">
						<div class="grid-nav-top col-xs-12 col-sm-12 col-md-12">
							<div class="nav-search">
								<input class="search" type="text" placeholder="" value="';
									if (isset($_GET['b'])) { $salida.=$_GET['b']; }
								$salida.='" name="b">
							</div>
						</div>
						<input type="hidden" class="pagenum" value="'.$page.'"/><input type="hidden" class="total-page" value="'.$pages.'"/>';
			}

			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];
				$salida.="
					<div class='imagenview'>
						<div class='AdaptiveMedia'>
							<div class='AdaptiveMedia-photoContainer'>
								<a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</a>
							</div>
						</div>
						<div class='name'>
							<strong><h4>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</h4></strong>
						</div>
						<div class='description'>";
							$salida.=$this->wordlimit(str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion)),20,"");
						$salida.="<br><br><a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre'>Continuar leyendo.</a></div>
					</div>";
			}
			$salida.="</div>";
			echo $salida;
			
			if ($present=='') {
				echo "<div class='colxs-12 col-sm-12 col-md-12' style='text-align: center;'>
					<ul class='pagination pagination-sm'>";
				$url = "/noticias.php";

				if ($pages > 1) {
					if ($page != 1)
						echo '<li><a href="'.$url.'?pagina='.($page-1).'">« Anterior</a></li>';
					for ($i=1;$i<=$pages;$i++) {
						if ($page == $i)
							echo "<li class='active'><a>$page</a></li>";
						else
							echo '<li><a href="'.$url.'?pagina='.$i.'">'.$i.'</a></li>';
					}
					if ($page != $pages)
							echo '<li><a href="'.$url.'?pagina='.($page+1).'">Siguiente »</a></li>';
				}
				echo "</ul></div>";
			}
			echo "</form>";
		}

		function consultanoticia() {
			$salida1='';
			$salida2='';

			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, RutaNota, Activo, DATE_FORMAT(Creado,'%d/%m/%Y') AS Creado FROM NOTAS WHERE Activo='1' AND (Nombre LIKE '%".$_GET['noticia']."%' OR Id='".$_GET['id']."') ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);

			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];
				$RutaNota = $row['RutaNota'];
				$Creado = $row['Creado'];

				$salida1.="
					<div style='text-align: center;'>
						<img src='".$RutaImg."' class='img-responsive' style='margin: 20px auto 0; max-height: 445px;'/>
					</div>
						";
				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));
				$Descripcion = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion));
				$salida1.= "
				<div class='article-content'>
					<h1 class='entry-title'>$Nombre</h1>
					<p style='text-align: justify;'>$Descripcion</p>";
					if ($RutaNota!="") {
						$salida1.="<p>Para más información puede acceder a este enlace:&nbsp; <a href='$RutaNota' target='_blank'><i class='glyphicon glyphicon-share-alt'></i> Ir al sitio</a></p>";
					}
				$salida1.="
					<p style='text-align:right;'>$Creado</p>
				</div>";
			}

			$sql = "SELECT Id, Nombre FROM NOTAS WHERE Activo='1' AND Id < ".$_GET['id']." ORDER BY Id DESC LIMIT 1";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$noticias = array();
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];

				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));

				$salida1.="<div class='pull-left'><a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre'>
						<h4 class='entry-title'><--".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))." |</h4>
					</a></div>";
			}

			$sql = "SELECT Id, Nombre FROM NOTAS WHERE Activo='1' AND Id > ".$_GET['id']." ORDER BY Id ASC LIMIT 1";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$noticias = array();
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];

				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));

				$salida1.="<div class='pull-right' style='text-align: right;'><a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre'>
						<h4 class='entry-title'>| ".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."--></h4>
					</a></div>";
			}

			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, RutaNota, Activo FROM NOTAS WHERE Activo='1' ORDER BY Id DESC LIMIT 0,7";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			
			while($row = $this->resultados->fetch_array()) {
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];

				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));

				$salida2.="
				<div class='row single-article'>
					<div class='col-xs-12 col-sm-12 col-md-12' style='margin-top: 10px; padding: 0!important;'>
						<a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre' title='$Nombre'>
							<img src='".$RutaImg."' style='margin-right: 10px; padding: 0!important; max-height: 70px; width: 122px; object-fit: cover; float:left;'/>
						</a>
						<a href='/noticias.php?op=noticia&id=$Id&noticia=$Nombre' title='$Nombre'>
							<h3 style='font-size: 14px; margin-bottom:10px; padding:0; margin-top: 0px; margin-right:10px;'>".$this->wordlimit("$Nombre",11,"...")."</h3>
						</a>
					</div>
				</div>
				";
			}

			$salida ='
			<div class="container">
				<div class="row">
					<div class="col-sm-9 col-md-9">
						'.$salida1.'<br><br><br><br>
					</div>
					<div class="col-sm-3 col-md-3">
						<h3 class="widget-title"><span>Recientes</span></h3>
						'.$salida2.'
						<a class="leermas" href="/noticias/" target="_blank"><h4>[Leer más noticias]</h4></a>	
					</div>
				</div>
			</div>
				';

			echo $salida;
		}

		function consultapromociones() {
			$salida1='';
			$salida2='';
			$salida3='';

			$sql = "SELECT Id, Tipo, Nombre, URL, RutaImg, Activo AS Creado FROM PROMOCIONES WHERE Activo='1' AND Tipo='Video' ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);

			while($row = $this->resultados->fetch_array()) {
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$URL = $row['URL'];

				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));
				$URL = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $URL));

				$salida1.='
					<div class="col-md-12">
						<h3 class="widget-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"><span>'.$Nombre.'</span></h3>
						<div class="containervideos wow fadeInDown col-xs-6 col-sm-12 col-md-12" data-wow-duration="1000ms" data-wow-delay="300ms" style="padding: 0px; float: none;">
						'.str_replace('width="560"', 'width="100%"', str_replace('height="315"', '', $URL)).'
						<div class="containervideos2" onclick=\'abrirMD("'.str_replace('"', '\"', str_replace('width="560"', 'width="100%"', $URL)).'")\'></div>
						</div>
					</div>';
			}

			$sql = "SELECT Id, Tipo, Nombre, URL, RutaImg, Activo AS Creado FROM PROMOCIONES WHERE Activo='1' AND Tipo='Banner' ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$contador=0;
			$sBanner1='';
			$sBanner2='';
			$row_cntBanner = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$URL = $row['URL'];
				$RutaImg = $row['RutaImg'];

				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));
				$URL = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $URL));

				if ($contador==1) {
					$sBanner1.='<a ';
					if (!empty($URL)) {
						$sBanner1.='href="'.$URL.'" target="_blank"';
					}

					$sBanner1.='><img src="'.$RutaImg.'" alt="'.str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre)).'" title="'.str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre)).'" class="img-responsive col-xs-12 col-sm-12 col-md-12" style="padding: 0px; margin: 10px 0;"></a>';
				} else if ($contador==2) {
					$sBanner2.='<a ';
					if (!empty($URL)) {
						$sBanner2.='href="'.$URL.'" target="_blank"';
					}

					$sBanner2.='><img src="'.$RutaImg.'" alt="'.str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre)).'" title="'.str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre)).'" class="img-responsive col-xs-12 col-sm-12 col-md-12" style="padding: 0px; margin: 10px 0;"></a>';
					$contador = 0;
				}
			}

			if ($row_cntBanner>0) {
				$salida2.='
				<div class="col-md-12">
					<h3 class="widget-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"><span>Paginas de interés</span></h3>
					<div class="wow fadeInDown col-xs-12 col-sm-12 col-md-12" data-wow-duration="1000ms" data-wow-delay="300ms" style="padding: 0px;">
						<div class="row">
							<div class="col-xs-6 col-sm-12 col-md-12">'.$sBanner1.'</div>
							<div class="col-xs-6 col-sm-12 col-md-12">'.$sBanner2.'</div>
						</div>
					</div>
				</div>';
			}

			$sql = "SELECT Id, Tipo, Nombre, URL, RutaImg, Activo AS Creado FROM PROMOCIONES WHERE Activo='1' AND Tipo='Enlace' ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$sEnlace='';
			$row_cntEnlace = mysqli_num_rows($this->resultados);
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Id = $row['Id'];
				$Nombre = $row['Nombre'];
				$URL = $row['URL'];
				$RutaImg = $row['RutaImg'];

				$Nombre = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre));
				$URL = str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $URL));

				$sEnlace.='<div class="single-article"><a ';
				if (!empty($URL)) {
					$sEnlace.='href="'.$URL.'" target="_blank"';
				}

				$sEnlace.=' class="enlaces"><p>'.str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre)).'</p></a></div>';
			}

			if ($row_cntEnlace>0) {
				$salida3.='
				<div class="col-md-12">
					<h3 class="widget-title wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms"><span>Enlaces de interés</span></h3>
					<div class="wow fadeInDown col-xs-12 col-sm-12 col-md-12" data-wow-duration="1000ms" data-wow-delay="300ms" style="padding: 0px;">
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">'.$sEnlace.'</div>
						</div>
					</div>
				</div>';
			}

			$salida = $salida1.$salida2.$salida3;

			echo $salida;
		}

		function consultaavisos() {
			$sql = "SELECT Id, RutaImg,Descripcion, Activo, DATE_FORMAT(Creado,'%d/%m/%Y %H:%i:%s') AS Creado FROM AVISOS  WHERE Activo='1' ORDER BY Id DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];
				$Activo = $row['Activo'];
				$salida.="
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
												<div class='col-md-6 col-center'>
													<img src='".$RutaImg."' class='img-responsive' alt='Ceneval' />
													<p style='color: white;'>_</p>
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
						$(document).ready(function(){
							$(\"#info-m".$contador."\").modal('show');
						});
					</script>";
			}
			echo $salida;
		}

		function consultacalendario() {
			$sql = "SELECT Nombre, RutaDoc, Activo FROM CALENDARIOS WHERE Activo='1' LIMIT 0,1";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
					<div class='col-lg-12'>
						<h1 class='text-center wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>$Nombre</h1>
					</div>
					<br/>
					<div class='col-md-10 border col-center wow fadeInUp'>
						<embed src='".$RutaDoc."' style='width: 100%; height: 100%; min-height: 780px;'></embed>
					</div>";
			}
			echo $salida;
		}

		function consultabecas() {
			$sql = "SELECT Nombre, Descripcion, RutaImg, RutaDoc, Activo FROM BECAS WHERE Activo='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$Descripcion = $row['Descripcion'];
				$RutaImg = $row['RutaImg'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
					<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12 becas wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
						<div class='border'>
							<div class='col-center'>
								<img src='".$RutaImg."' class='img-responsive' style='max-height:400px;' alt='$Nombre'>
							</div>
							<h3 class='text-center'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."</h3>
		                    <p class='text-justify'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Descripcion));
							if ($RutaDoc!="") {
								$salida.="<br><br><a href='".$RutaDoc."' target='_blank' style='color:rgb(65, 78, 106);'><i class='glyphicon glyphicon-share-alt'></i> Ver bases.</a>";
							}
							$salida.="</p>
						</div>
					</div>";
			}
			echo $salida;
		}

		function consultatitulacion1() {
			$sql = "SELECT NombreFormato, Nivel, RutaDoc, Activo FROM REQUSITOSTITULOS WHERE Activo='1' AND Nivel='General'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['NombreFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
					<div class='col-md-12 border col-center wow fadeInUp'>
						<embed src='".$RutaDoc."' style='width: 100%; height: 100%; min-height: 500px;'></embed>
					</div>";
			}
			echo $salida;
		}

		function consultatitulacion2() {
			$sql = "SELECT NombreFormato, Nivel, RutaDoc, Activo FROM REQUSITOSTITULOS WHERE Activo='1' AND (Nivel='TSU' OR Nivel='ING')";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			if (mysqli_num_rows($this->resultados) > 0 ){
			    $salida.="<h3 class='wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='550ms'>Descargar formatos de autorización</h3>
                <hr />
                <div class='col-md-12'>
            <div class='panel panel-ut wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='650ms'>
                <div class='panel-heading'>
                  <h4 class='panel-title'>Descargar formatos</h4>
                </div>
                <div class='panel-body'>";
    			while($row = $this->resultados->fetch_array()) {
    				$contador++;
    				$Nombre = $row['NombreFormato'];
    				$RutaDoc = $row['RutaDoc'];
    				$salida.="<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
    			}
    			$salida.="</div>
              </div>
              </div>";
		    }
			echo $salida;
		}

		function consultaestadiatsucalendario() {
			$sql = "SELECT Nivel, TipoFormato, Nombre, RutaDoc, Activo FROM FORMATOSESTADIAS WHERE Activo='1' AND Nivel='TSU' AND TipoFormato='Calendario'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-4'>
						<h3>Calendario</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$TipoFormato = $row['TipoFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
					<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
			}
			$salida.="</div>";
			echo $salida;
		}

		function consultaestadiatsuformatos() {
			$sql = "SELECT Nivel, TipoFormato, Nombre, RutaDoc, Activo FROM FORMATOSESTADIAS WHERE Activo='1' AND Nivel='TSU' AND TipoFormato='Formatos'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-4'>
				<h3>Formatos</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$TipoFormato = $row['TipoFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
			}
			$salida.="</div>";
			echo $salida;
		}

		function consultaestadiatsuencuestas() {
			$sql = "SELECT Nivel, TipoFormato, Nombre, RutaDoc, Activo FROM FORMATOSESTADIAS WHERE Activo='1' AND Nivel='TSU' AND TipoFormato='Encuestas'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-4'>
				<h3>Encuestas</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$TipoFormato = $row['TipoFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
			}
			$salida.="</div>";
			echo $salida;
		}

		function consultaestadiaingcalendario() {
			$sql = "SELECT Nivel, TipoFormato, Nombre, RutaDoc, Activo FROM FORMATOSESTADIAS WHERE Activo='1' AND Nivel='ING' AND TipoFormato='Calendario'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-4'>
						<h3>Calendario</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$TipoFormato = $row['TipoFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
					<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
			}
			$salida.="</div>";
			echo $salida;
		}

		function consultaestadiaingformatos() {
			$sql = "SELECT Nivel, TipoFormato, Nombre, RutaDoc, Activo FROM FORMATOSESTADIAS WHERE Activo='1' AND Nivel='ING' AND TipoFormato='Formatos'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-4'>
				<h3>Formatos</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$TipoFormato = $row['TipoFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
			}
			$salida.="</div>";
			echo $salida;
		}

		function consultaestadiaingencuestas() {
			$sql = "SELECT Nivel, TipoFormato, Nombre, RutaDoc, Activo FROM FORMATOSESTADIAS WHERE Activo='1' AND Nivel='ING' AND TipoFormato='Encuestas'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<div class='col-md-4'>
				<h3>Encuestas</h3>";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$TipoFormato = $row['TipoFormato'];
				$RutaDoc = $row['RutaDoc'];
				$salida.="
				<p><i class='ut-icon icon-file-pdf'></i><a href='".$RutaDoc."' target='_blank'> $Nombre</a></p>";
			}
			$salida.="</div>";
			echo $salida;
		}

		function consultavisitas($pageNewNum) {
			$salida = "";
			$salida1 = "";
			$salida2 = "";
			$salida3 = "";
			$contador=0;
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, Activo FROM VISITASINDUSTRIALES WHERE Activo='1' ORDER BY Id DESC";

			$perPage = 9;
			$page = 1;
			if(!empty($pageNewNum)) {
				$page = $pageNewNum;
			}

			$start = ($page-1)*$perPage;
			if($start < 0) $start = 0;

			$query =  $sql . " LIMIT " . $start . "," . $perPage; 

			if(empty($_POST["rowcount"])) {
				$this->conexion->conexion->set_charset('utf8');
				$this->resultados = $this->conexion->getConexion()->query($sql);
				$rowcount = mysqli_num_rows($this->resultados);
				$_POST["rowcount"] = $rowcount;
			}
			$pages  = ceil($_POST["rowcount"]/$perPage);

			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($query);

			if(!empty($this->resultados)){
				$salida.= '<input type="hidden" class="pagenum" value="'.$page.'"/><input type="hidden" class="total-page" value="'.$pages.'"/>';
			}

			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];

				if ($contador==1) {
					$salida1.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>
						";
				} else if ($contador==2) {
					$salida2.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>";
				} else if ($contador==3) {
					$salida3.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>";
					$contador=0;
				}
			}
			$salida.="$salida1 $salida2 $salida3";
			echo $salida;
		}

		function consultamovilidadestudiantil($pageNewNum) {
			$salida = "";
			$salida1 = "";
			$salida2 = "";
			$salida3 = "";
			$contador=0;
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, RutaDoc, Activo FROM MOVILIDADES WHERE Activo='1' AND RutaDoc='Estudiantil' ORDER BY Id DESC";

			$perPage = 9;
			$page = 1;
			if(!empty($pageNewNum)) {
				$page = $pageNewNum;
			}

			$start = ($page-1)*$perPage;
			if($start < 0) $start = 0;

			$query =  $sql . " LIMIT " . $start . "," . $perPage; 

			if(empty($_POST["rowcount"])) {
				$this->conexion->conexion->set_charset('utf8');
				$this->resultados = $this->conexion->getConexion()->query($sql);
				$rowcount = mysqli_num_rows($this->resultados);
				$_POST["rowcount"] = $rowcount;
			}
			$pages  = ceil($_POST["rowcount"]/$perPage);

			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($query);

			if(!empty($this->resultados)){
				$salida.= '<input type="hidden" class="pagenum" value="'.$page.'"/><input type="hidden" class="total-page" value="'.$pages.'"/>';
			}

			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];

				if ($contador==1) {
					$salida1.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>
						";
				} else if ($contador==2) {
					$salida2.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>";
				} else if ($contador==3) {
					$salida3.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>";
					$contador=0;
				}
			}
			$salida.="$salida1 $salida2 $salida3";
			echo $salida;
		}

		function consultamovilidaddocentes($pageNewNum) {
			$salida = "";
			$salida1 = "";
			$salida2 = "";
			$salida3 = "";
			$contador=0;
			$sql = "SELECT Id, Nombre, Descripcion, RutaImg, RutaDoc, Activo FROM MOVILIDADES WHERE Activo='1' AND RutaDoc='Docentes' ORDER BY Id DESC";

			$perPage = 9;
			$page = 1;
			if(!empty($pageNewNum)) {
				$page = $pageNewNum;
			}

			$start = ($page-1)*$perPage;
			if($start < 0) $start = 0;

			$query =  $sql . " LIMIT " . $start . "," . $perPage; 

			if(empty($_POST["rowcount"])) {
				$this->conexion->conexion->set_charset('utf8');
				$this->resultados = $this->conexion->getConexion()->query($sql);
				$rowcount = mysqli_num_rows($this->resultados);
				$_POST["rowcount"] = $rowcount;
			}
			$pages  = ceil($_POST["rowcount"]/$perPage);

			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($query);

			if(!empty($this->resultados)){
				$salida.= '<input type="hidden" class="pagenum" value="'.$page.'"/><input type="hidden" class="total-page" value="'.$pages.'"/>';
			}

			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['Nombre'];
				$RutaImg = $row['RutaImg'];
				$Descripcion = $row['Descripcion'];

				if ($contador==1) {
					$salida1.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>
						";
				} else if ($contador==2) {
					$salida2.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>";
				} else if ($contador==3) {
					$salida3.="
						<div class='imagenview' style='cursor: pointer;' onclick='galeria(\"".$RutaImg."\",\"$Nombre\",\"$Descripcion\")'>
							<div class='AdaptiveMedia'>
								<div class='AdaptiveMedia-photoContainer'>
									<img src='".$RutaImg."' style='object-fit: cover; height: 230px; width:100%;' alt='$Nombre'/>
								</div>
							</div>
							<div class='name'>
								<strong><h4>$Nombre</h4></strong>
							</div>
							<div class='description'>
								$Descripcion
							</div>
						</div>";
					$contador=0;
				}
			}
			$salida.="$salida1 $salida2 $salida3";
			echo $salida;
		}

		function consultaegresados() {
			$sql = "SELECT CarreraNombreCompletoEgresado, Testimonio, Activo FROM TESTIMONIOEGRESADOS WHERE Activo='1'";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['CarreraNombreCompletoEgresado'];
				$Testimonio = $row['Testimonio'];
				$salida.="
					<li style='text-align: justify;'>".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Nombre))."<br />
					".str_replace("&apoxyz", "'", str_replace("&quoxyz", '"', $Testimonio))."</li>";
			}
			echo $salida;
		}

		function consultarector() {
			$sql = "SELECT DIRECTORIOS.Id AS DIRECTORIOSId, DIRECTORIOS.NombreCompleto AS DIRECTORIOSNombreCompleto, DIRECTORIOS.EMail AS DIRECTORIOSEMail, DIRECTORIOS.IdCargoDirectorios AS DIRECTORIOSIdCargoDirectorios, DIRECTORIOS.IdUsuario AS DIRECTORIOSIdUsuario, DIRECTORIOS.Activo AS DIRECTORIOSActivo, DIRECTORIOS.TelExt AS DIRECTORIOSTelExt, DIRECTORIOS.Creado AS DIRECTORIOSCreado, CARGODIRECTORIOS.Id AS CARGODIRECTORIOSId, CARGODIRECTORIOS.Nombre AS CARGODIRECTORIOSNombre, CARGODIRECTORIOS.Nivel AS CARGODIRECTORIOSNivel FROM CARGODIRECTORIOS INNER JOIN DIRECTORIOS ON CARGODIRECTORIOS.Id = DIRECTORIOS.IdCargoDirectorios WHERE DIRECTORIOS.Activo='1' AND CARGODIRECTORIOS.Nivel='1' ORDER BY CARGODIRECTORIOSNivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['DIRECTORIOSNombreCompleto'];
				$Cargo = $row['CARGODIRECTORIOSNombre'];
				$EMail = $row['DIRECTORIOSEMail'];
				$TelExt = $row['DIRECTORIOSTelExt'];
				$salida.="
					<div class='col-md-6 col-center text-center wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='350ms'>
	                    <div class='conte-direc'>
	                        <h2>$Nombre</h2>
	                        <hr />
	                        <p>$Cargo</p>
	                        <hr />
	                        e-mail: $EMail";
	                         if ($TelExt!="") {
								$salida.="<br>
									Extensión Telefónica: $TelExt";
							}
	                    $salida.="
	                    </div>
	                </div>
	                <br>";
			}
			echo $salida;
		}

		function consultadirector() {
			$sql = "SELECT DIRECTORIOS.Id AS DIRECTORIOSId, DIRECTORIOS.NombreCompleto AS DIRECTORIOSNombreCompleto, DIRECTORIOS.EMail AS DIRECTORIOSEMail, DIRECTORIOS.IdCargoDirectorios AS DIRECTORIOSIdCargoDirectorios, DIRECTORIOS.IdUsuario AS DIRECTORIOSIdUsuario, DIRECTORIOS.Activo AS DIRECTORIOSActivo, DIRECTORIOS.TelExt AS DIRECTORIOSTelExt, DIRECTORIOS.Creado AS DIRECTORIOSCreado, CARGODIRECTORIOS.Id AS CARGODIRECTORIOSId, CARGODIRECTORIOS.Nombre AS CARGODIRECTORIOSNombre, CARGODIRECTORIOS.Nivel AS CARGODIRECTORIOSNivel FROM CARGODIRECTORIOS INNER JOIN DIRECTORIOS ON CARGODIRECTORIOS.Id = DIRECTORIOS.IdCargoDirectorios WHERE DIRECTORIOS.Activo='1' AND CARGODIRECTORIOS.Nivel='2' ORDER BY CARGODIRECTORIOSNivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=0;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['DIRECTORIOSNombreCompleto'];
				$Cargo = $row['CARGODIRECTORIOSNombre'];
				$EMail = $row['DIRECTORIOSEMail'];
				$TelExt = $row['DIRECTORIOSTelExt'];
				$salida.="
					<div class='col-md-6 col-center text-center wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='350ms'>
	                    <div class='conte-direc'>
	                        <h2>$Nombre</h2>
	                        <hr />
	                        <p>$Cargo</p>
	                        <hr />
	                        e-mail: $EMail";
	                         if ($TelExt!="") {
								$salida.="<br>
									Extensión Telefónica: $TelExt";
							}
	                    $salida.="
	                    </div>
	                </div>";
			}
			echo $salida;
		}

		function consultadirectivos() {
			$sql = "SELECT DIRECTORIOS.Id AS DIRECTORIOSId, DIRECTORIOS.NombreCompleto AS DIRECTORIOSNombreCompleto, DIRECTORIOS.EMail AS DIRECTORIOSEMail, DIRECTORIOS.IdCargoDirectorios AS DIRECTORIOSIdCargoDirectorios, DIRECTORIOS.IdUsuario AS DIRECTORIOSIdUsuario, DIRECTORIOS.Activo AS DIRECTORIOSActivo, DIRECTORIOS.TelExt AS DIRECTORIOSTelExt, DIRECTORIOS.Creado AS DIRECTORIOSCreado, CARGODIRECTORIOS.Id AS CARGODIRECTORIOSId, CARGODIRECTORIOS.Nombre AS CARGODIRECTORIOSNombre, CARGODIRECTORIOS.Nivel AS CARGODIRECTORIOSNivel FROM CARGODIRECTORIOS INNER JOIN DIRECTORIOS ON CARGODIRECTORIOS.Id = DIRECTORIOS.IdCargoDirectorios WHERE DIRECTORIOS.Activo='1' AND CARGODIRECTORIOS.Nivel>'2' ORDER BY CARGODIRECTORIOSNivel";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "";
			$contador=3;
			while($row = $this->resultados->fetch_array()) {
				$contador++;
				$Nombre = $row['DIRECTORIOSNombreCompleto'];
				$Cargo = $row['CARGODIRECTORIOSNombre'];
				$EMail = $row['DIRECTORIOSEMail'];
				$TelExt = $row['DIRECTORIOSTelExt'];
				$salida.="
					<div class='col-md-4 text-center wow fadeInDown' data-wow-duration='1000ms' data-wow-delay='".$contador."50ms'>
	                    <div class='conte-direc'>
	                        <h3>$Nombre</h3>
	                        <hr />
	                        <p>$Cargo</p>
	                        <hr />
	                        e-mail: $EMail
	                        ";
	                         if ($TelExt!="") {
								$salida.="<br>
									Extensión Telefónica: $TelExt";
							}
	                    $salida.="</div>
	                </div>";
			}
			echo $salida;
		}

		function consultacarreras() {
			$sql = "SELECT * FROM CARRERAS";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "<select name='Nivel' class='form-control'>
				<option value=''>Seleccione una opción...</option>";
			while($row = $this->resultados->fetch_array()) {
				$salida .="<option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
			}
			$salida.="</select>";
			echo $salida;
		}

		function consultatitulo($Nombre, $Nivel) {
			$sql = "SELECT Matricula, Nombre, Carrera, Estado, Observaciones, DATE_FORMAT(Fecha,'%d/%m/%Y %H:%i:%s') AS Fecha FROM TITULOS WHERE (Nombre LIKE '%$Nombre%' OR Matricula LIKE '%$Nombre%') AND Carrera LIKE '%$Nivel%' ORDER BY Matricula DESC";
			$this->conexion->conexion->set_charset('utf8');
			$this->resultados = $this->conexion->getConexion()->query($sql);
			$salida = "
			<div class='wow fadeInUp' data-wow-duration='1000ms' data-wow-delay='300ms'>
			<table id='tbl1' width='100%' class='table table-striped table-bordered table-hover table-condensed'>
				<thead>
					<tr>
						<th width='100px'>Matricula</th>
						<th width='300px;'>Nombre Completo</th>
						<th>Carrera</th>
						<th width='160px;'>Estado</th>
						<th width='240px'>Observaciones</th>
					</tr>
				</thead>
				<tbody>";
			while($row = $this->resultados->fetch_array()) {
				$Matricula = $row['Matricula'];
				$Nombre = $row['Nombre'];
				$Carrera = $row['Carrera'];
				$Estado = $row['Estado'];
				$Observaciones = $row['Observaciones'];
				$salida.="
					<tr>
						<td>$Matricula</td>
						<td>$Nombre</td>
						<td>$Carrera</td>
						<td>$Estado</td>
						<td align='justify'>$Observaciones</td>
					</tr>";
			}
			$salida.="</tbody>
			</table>
			</div>
			<script type='application/javascript'>
				$(document).ready(function(){
					$('#tbl1').DataTable({
						'language': {
							'sProcessing':'Procesando...',
							'sLengthMenu':'Mostrar _MENU_ registros',
							'sZeroRecords':'No se encontraron resultados',
							'sEmptyTable':'Ningún dato disponible en esta tabla',
							'sInfo':'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
							'sInfoEmpty':'Mostrando registros del 0 al 0 de un total de 0 registros',
							'sInfoFiltered':'(filtrado de un total de _MAX_ registros)',
							'sInfoPostFix':'',
							'sSearch':'Buscar:',
							'sUrl':'',
							'sInfoThousands':',',
							'sLoadingRecords':'Cargando...',
							'oPaginate': {
								'sFirst':'Primero',
								'sLast':'Último',
								'sNext':'Siguiente',
								'sPrevious':'Anterior'
							},
							'oAria': {
								'sSortAscending':': Activar para ordenar la columna de manera ascendente',
								'sSortDescending':': Activar para ordenar la columna de manera descendente'
							}
						},
			  			'aLengthMenu': [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'Todos']]
					});
				});
			</script>";
			echo $salida;
		}
	}
?>