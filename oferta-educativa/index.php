<?php
$titulo = "Oferta Educativa";
$pagina = "ofertaEdu";
require ($_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'); ?>
<?php require($_SERVER["DOCUMENT_ROOT"].'/inc/menu.inc'); ?>

<?php
    $principal->consultabannerramdon();
?>

<section class="oferta-educativa">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center ">
				<h1>Oferta Educativa</h1>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="container">
		<div class="row ">
			<div class="col-md-12">
				<h2>Tecnologías de la Información Área: Desarrollo de Software Multiplataforma</h2>
				<hr />
			</div>
			<br />
			<br /><br />
			<div class="col-md-4">
				<img src="/img/tic.jpg" class="img-responsive" alt="Tecnologías" />
			</div>
			<div class="col-md-8">
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				  <div class="panel panel-ut">
				    <div class="panel-heading" role="tab" id="headinguno">
				    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseuno" aria-expanded="true" aria-controls="collapseuno">
				      	<h4 class="panel-title">
				          Misión <i class="glyphicon glyphicon-plus pull-right"></i>
				      	</h4>
				      </a>
				    </div>
				    <div id="collapseuno" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headinguno">
				      <div class="panel-body">
				        Formar técnicos superiores universitarios de alto nivel humano y académico, que cumplan y den respuestas inmediatas a las necesidades de su entorno productivo y social, prestando servicios que propicien la innovación y transferencia tecnológica en nuestra región, impulsando la vinculación del sector productivo y de servicio con el sistema educativo estatal y nacional en un marco de excelencia.
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-ut">
				    <div class="panel-heading" role="tab" id="headingdos">
				      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsedos" aria-expanded="false" aria-controls="collapsedos">
				      	<h4 class="panel-title">
				          Visión <i class="glyphicon glyphicon-plus pull-right"></i>
				      	</h4>
				      </a>
				    </div>
				    <div id="collapsedos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingdos">
				      <div class="panel-body">
				        Formar técnicos superiores universitarios de alto nivel humano y académico, que cumplan y den respuestas inmediatas a las necesidades de su entorno productivo y social, prestando servicios que propicien la innovación y transferencia tecnológica en nuestra región, impulsando la vinculación del sector productivo y de servicio con el sistema educativo estatal y nacional en un marco de excelencia.
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-ut">
				    <div class="panel-heading" role="tab" id="headingtres">
				      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetres" aria-expanded="false" aria-controls="collapsetres">
				      	<h4 class="panel-title">
				          Perfil de Ingreso <i class="glyphicon glyphicon-plus pull-right"></i>
				        </h4>
				      </a>
				    </div>
				    <div id="collapsetres" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingtres">
				      <div class="panel-body">
				        Alcanzar la excelencia como institución educativa de nivel superior, impulsadora de la modernización, la innovación y el desarrollo tecnológico para contribuir al crecimiento de las economías regionales, estatales, nacionales e internacionales, apartándole a sus estructuras productiva, personal con las habilidades técnicas que requieren. También ofrecer a sus egresados la oportunidad de incorporarse a un empleo acorde a su profesión.
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-ut">
				    <div class="panel-heading" role="tab" id="headingfor">
				      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefor" aria-expanded="false" aria-controls="collapsefor">
				      	<h4 class="panel-title">
				          Perfil del Egresado <i class="glyphicon glyphicon-plus pull-right"></i>
				        </h4>
				      </a>
				    </div>
				    <div id="collapsefor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfor">
				      <div class="panel-body">
				        El Técnico Superior Universitario en Tecnologías de la Información área Desarrollo de Software Multimedia, podrá desempeñarse como:
				        <ul>
				        	<li>Analista de Sistemas</li>
				        	<li>Programador de Sistemas</li>
				        	<li>Administrador de Bases de Datos</li>
				        	<li>Técnico en Soporte de Sistemas Informáticos</li>
				        	<li>Gestor de TI</li>
				        	<li>Diseñador de Sitios Web</li>
				        	<li>Ingeniero de Pruebas</li>
				        </ul>
				      </div>
				    </div>
				  </div>
				  <div class="panel panel-ut">
				    <div class="panel-heading" role="tab" id="headingcinco">
				      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsecinco" aria-expanded="false" aria-controls="collapsecinco">
				      	<h4 class="panel-title">
				          Plan de estudios <i class="glyphicon glyphicon-plus pull-right"></i>
				        </h4>
				      </a>
				    </div>
				    <div id="collapsecinco" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingcinco">
				      <div class="panel-body">
				      <a href="/oferta-educativa/plan-tsu-tic" data-tooltipp="tooltip" data-placement="top" title="Ver plan de estudios"><i class="glyphicon glyphicon-list-alt"></i> Ver plan de estudios</a>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"].'/inc/footer.inc'); ?>
