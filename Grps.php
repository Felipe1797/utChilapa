<?php
  // INICIA LA SESIÓN PARA ALMACENAR LOS VALORES DE RESULTADOS
  session_start();
 ?>


</!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Productos</title>
    <script src="jsqp/jquery-1.7.1.min.js"></script>
    <script src="jsqp/Productos.js"></script>
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
<head>
    <title></title>
</head>
<body>

<div class="container">
  <!-- /STAR ROW -->
  <div class="row">
    <!-- COL-MD-6 -->
    <div class="col-md-12">

      <!-- TITULO DE LA PAGINA -->
      <div class="page-header">
        <h3>MÉTRICAS</h3>
      </div>

      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <!-- FORMULARIO GRPS -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 class="panel-title">GRPS</h4>
              </div>
              <div class="panel-body">
                <form action="Operaciones.php" method="post">
                  <div class="form-group">
                    <p>NÚMERO DE IMPACTOS</p>
                    <input type="text" name="ni" class="form-control" placeholder="NÚMERO">
                  </div>
                  <div class="form-group">
                    <p>PÚBLICO OBJETIVO</p>
                    <input type="text" name="po" class="form-control"  placeholder="NÚMERO">
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-default">Cancelar</button>
                    <button type="submit" name="form-btn-grps" class="btn btn-success">Calcular</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /FORMULARIO GRPS -->
          </div>
          <div class="col-md-6">
            <!-- FORMULARIO COSTO POR IMPACTO -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 class="panel-title">COSTO POR IMPACTO</h4>
              </div>
              <div class="panel-body">
                <form action="Operaciones.php" method="post">
                  <div class="form-group">
                    <p>TARIFA</p>
                    <input type="text" name="tarifa" class="form-control" placeholder="NÚMERO">
                  </div>
                  <div class="form-group">
                    <p>NÚMERO TOTAL DE IMPACTOS</p>
                    <input type="text" name="nti" class="form-control"  placeholder="NÚMERO">
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-default">Cancelar</button>
                    <button type="submit" name="form-btn-cpi" class="btn btn-success">Calcular</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /FORMULARIO COSTO POR IMPACTO -->
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <!-- FORMULARIO COSTO POR IMPACTO -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h4 class="panel-title">CPM</h4>
              </div>
              <div class="panel-body">
                <form action="Operaciones.php" method="post">
                  <div class="form-group">
                    <p>TARIFA COSTO</p>
                    <input type="text" name="tarifac" class="form-control" placeholder="NÚMERO">
                  </div>
                  <div class="form-group">
                    <p>AUDIENCIA</p>
                    <input type="text" name="audiencia" class="form-control"  placeholder="NÚMERO">
                  </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-default">Cancelar</button>
                    <button type="submit" name="form-btn-cpm" class="btn btn-success">Calcular</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /FORMULARIO COSTO POR IMPACTO -->
          </div>
        </div>

      </div>

      <div class="col-md-6">
        <!-- TABLA DE RESULTADOS -->
        <h3>Tabla de Resultados</h3>
        <div class="table table-hover">
          <table class="table">
            <thead>
              <tr>
                <th><span class="glyphicon glyphicon-list-alt"></span> Formulario</th>
                <th><span class="glyphicon glyphicon-tasks"></span> Resultado</th>
                <th class="text-center"><span class="glyphicon glyphicon-cog"></span> Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                // MUESTRA EL RESULTADO DE GRPS
                if(isset($_SESSION['resultado_grps'])){
                  echo "
                    <tr>
                      <td>GRPS</td>
                      <td>".$_SESSION['resultado_grps']."</td>
                      <td class='text-center'>
                        <button type='button' class='btn btn-danger btn-xs'>Borrar</button>
                      </td>
                    </tr>
                  ";
                }

                // MUESTRA EL RESULTADO DE COSTO POR IMPACTO
                if(isset($_SESSION['resultado_costo_impacto'])){
                  echo "
                    <tr>
                      <td>COSTO POR IMPACTO</td>
                      <td>".$_SESSION['resultado_costo_impacto']."</td>
                      <td class='text-center'>
                        <button type='button' class='btn btn-danger btn-xs'>Borrar</button>
                      </td>
                    </tr>
                  ";
                }

                // MUESTRA EL RESULTADO DE GRPS
                if(isset($_SESSION['resultado_cpm'])){
                  echo "
                    <tr>
                      <td>CPM</td>
                      <td>".$_SESSION['resultado_cpm']."</td>
                      <td class='text-center'>
                        <button type='button' class='btn btn-danger btn-xs'>Borrar</button>
                      </td>
                    </tr>
                  ";
                }

                ?>
            </tbody>
          </table>
        </div><!-- /TABLA DE RESULTADOS -->
      </div>

    </div><!-- /COL-MD-6 -->
  </div> <!-- /FIN ROW -->

</body>
</html>
