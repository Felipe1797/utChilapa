<?php

  // INICIA LA SESIÓN PARA ALMACENAR LOS VALORES DE RESULTADOS
  session_start();

  /*
   * CONDICIÓN QUE DETECTA SI EL BOTÓN ENVIAR form-btn-grps SE HA PRESIONADO
   */
  if (isset($_POST['form-btn-grps'])) {
      // ENTRADA DE DATOS Y PASO DE VARIABLES POST
      $v_numero_impactos  = $_POST['ni'];
      $v_publico_objetivo = $_POST['po'];
      // FORMULA: GRPS    = [(NÚMERO DE IMPACTOS*100)/PÚBLICO OBJETIVO]
      $v_resultado_grps   = (($v_numero_impactos*100)/$v_publico_objetivo);
      // ALMACENAR EL RESULTADO
      $_SESSION['resultado_grps'] = number_format($v_resultado_grps,2);
      // RETORNA A LA PAGINA ORIGEN
      header('Location: Grps.php');
  }

/*
 * CONDICIÓN QUE DETECTA SI EL BOTÓN ENVIAR form-btn-cpi SE HA PRESIONADO
 */
if (isset($_POST['form-btn-cpi'])) {
    // ENTRADA DE DATOS Y PASO DE VARIABLES POST
    $v_tarifa          = $_POST['tarifa'];
    $v_numero_impactos = $_POST['nti'];
    // FORMULA: COSTO POR IMPACTO = (TARIFA/NÚMERO TOTAL DE IMPACTOS)
    $v_resultado_costo_impacto = ($v_tarifa/$v_numero_impactos);
    // ALMACENAR EL RESULTADO
    $_SESSION['resultado_costo_impacto'] = number_format($v_resultado_costo_impacto,2);
    // RETORNA A LA PAGINA ORIGEN
    header('Location: Grps.php');
}

/*
 * CONDICIÓN QUE DETECTA SI EL BOTÓN ENVIAR form-btn-cpm SE HA PRESIONADO
 */
if (isset($_POST['form-btn-cpm'])) {
    // ENTRADA DE DATOS Y PASO DE VARIABLES POST
    $v_tarifa_costo  = $_POST['tarifac']; //costo tarifa
    $v_audiencia     = $_POST['audiencia']; //audiencia
    // FORMULA: CPM  = TARIFA (COSTO)*1000/AUDIENCIA (PERSONAS ALCANZADAS)
    $v_resultado_cpm = (($v_tarifa_costo*1000)/$v_audiencia);
    // ALMACENAR EL RESULTADO
    $_SESSION['resultado_cpm'] = number_format($v_resultado_cpm,2);
    // RETORNA A LA PAGINA ORIGEN
    header('Location: Grps.php');
}







?>
