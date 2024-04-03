<?php 

session_start();

if( isset($_SESSION['id']) && isset($_SESSION['nombre']) || isset($_COOKIE['nombre'])){
	if(isset($_COOKIE['nombre'])){

		$_SESSION['id'] = $_COOKIE['id'];
        $_SESSION['nombre'] = $_COOKIE['nombre'];

	}
    header("Location: /admin/");
}
?>
<?php 
$titulo = "Iniciar sesión";
$pagina = "login";
require $_SERVER["DOCUMENT_ROOT"].'/inc/header.inc'; 
?>
<header class="login" style="background-image: url(/img/slider-0-1.jpg);">
	<div class="colo">
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-lg-4 col-center border">
						<div class="alerta-login">
							<div class='alert alert-danger alert-dismissible fade in' role='alert'>
			                    <i class="icon-notification icon-login-er"></i>&nbsp;&nbsp;
			                    <strong class='info-error text-justify'></strong>
			                </div>
						</div>
						<form id="login-ut">
							<h3 class="text-center">Iniciar sesión</h3>
							<hr />
					      <div class="form-group has-feedback">
					        <input type="text" id="email" name="email" class="form-control" placeholder="Email">
					        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					      </div>
					      <div class="form-group has-feedback">
					        <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
					        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
					      </div>
					      <div class="row">
					        <div class="col-md-7">
					          <div class="checkbox icheck">
					            <label>
					              <input type="checkbox" name="recordar"> Mantener la sesión iniciada
					            </label>
					          </div>
					        </div>
					        <div class="col-md-5">
					          <button type="button" id="btn-login" class="btn btn-primary btn-block btn-flat">Iniciar sesión</button>
					        </div>
					      </div>
					      <div class="cargador-login">
					      <hr />
							<h4>Cargando...</h4>
	                       <div class="progress progress-striped active">
	                          <div class="progress-bar" role="progressbar"
	                               aria-valuenow="00" aria-valuemin="0" aria-valuemax="00"
	                               style="width: 100%">
	                          </div>
	                        </div> 
		                   </div>
					    </form>
					</div>
				</div>
			</div>
		</section>
	</div>
</header>
<script type="text/javascript" src="/js/jquery-2.2.4.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/login.js"></script>
</body>
</html>