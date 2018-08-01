<?php
$cod_gasto=$_GET["cod_g"];

include "includes/conectar.php";

$sql="select * from gastos where cod_gasto=$cod_gasto";
$q=mysql_query($sql);
$g=mysql_fetch_object($q);

$ano=$g->ano;
$mes=$g->mes<10 ? "0".$g->mes : $g->mes;
$pagado=$g->pagado==1 ? "SI" : "NO";
$valor=$g->valor;
$cod_concepto_gasto=$g->cod_concepto_gasto;

$sql="select * from conceptos_gastos where cod_concepto_gasto=$cod_concepto_gasto";
$q=mysql_query($sql);
$cg=mysql_fetch_object($q);

$concepto_gasto=$cg->concepto_gasto;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ingresar Gastos</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<link href="../jquery/jquery-ui-1.8.20.completo/css/redmond/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../jquery/jquery-ui-1.8.20.completo/js/jquery-ui-1.8.20.custom.min.js"></script>
<script>
$(function() {
	$("#datepicker").datepicker({"dateFormat":"yy/mm/dd"});		
	$("#datepicker2").datepicker({"dateFormat":"yy/mm/dd"});		
});
</script>
<script type="text/javascript">
function Verificar()
{
	if(form1.datepicker.value=="")
	{
		alert("Seleccione una fecha");
		form1.datepicker.focus();
		return false;
	}
	
	if(form1.valor_boleta.selectedIndex==0)
	{
		alert("Ingrese el valor de la boleta");
		form1.valor_boleta.focus();
		return false;
	}
		
	return true;
}
</script>
</head>
<body>
<table border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="5" class="cabecera">DETALLE DE GASTOS</td>
  </tr>
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="cabecera">Mes/Año</td>
    <td class="cabecera">Concepto</td>
    <td class="cabecera">Valor</td>
    <td align="center" class="cabecera">Pagado</td>
    <td align="center" class="cabecera"><input type="button" name="button2" id="button2" value="Volver" onClick="history.back()"></td>
  </tr>
  <tr>
    <td align="center" class="celda"><?="$mes-$ano"?></td>
    <td class="celda"><?=$concepto_gasto?></td>
    <td class="celda"><?=$valor?></td>
    <td align="center" class="celda"><?=$pagado?></td>
    <td align="center" class="celda">&nbsp;</td>
  </tr>
</table>
<br>

<table border="0" cellspacing="1" cellpadding="3">
  <tr><td class="cabecera" colspan="2">ABONOS</td></tr>
  <tr>
    <td align="center" class="cabecera">Fecha</td>
    <td align="center" class="cabecera">Valor Abono</td>
  </tr>
  <?php
  $sumapagos = 0;

$sql="select * from pagos where cod_gasto=$cod_gasto order by cod_pago";
$q=mysql_query($sql);
while($gd=mysql_fetch_object($q))
{
?>
  <tr>
    <td align="center" class="celda"><?=$gd->cod_pago?></td>
    <td align="right" class="celda"><?=$gd->valor_pago?></td>
  </tr>
  <?php

  $sumapagos += $gd->valor_pago;
}
?>
<tr>
  <td class="cabecera">TOTAL</td>
  <td align="right" class="cabecera"><?=$sumapagos?></td>
</tr>
</table>
<!--
<br>
<form name="form1" method="post" action="" onSubmit="return Verificar()">
  <table border="0" cellspacing="1" cellpadding="3">
    <tr><td colspan="6" class="cabecera">DETALLE DE GASTOS</td></tr>
    <tr>
      <td align="center" class="cabecera">Fecha</td>
      <td align="right" class="cabecera">Valor Boleta</td>
      <td align="center" class="cabecera">Cantidad Cuotas</td>
      <td align="right" class="cabecera">Valor Cuota</td>
      <td align="center" class="cabecera">Fecha Primera Cuota</td>
      <td align="center" class="cabecera">&nbsp;</td>
    </tr>
    <tr>
      <td align="center"><span class="celda">
        <input type="text" name="datepicker" id="datepicker" size="12">
      </span></td>
      <td align="right"><label for="valor_boleta"></label>
      <input name="valor_boleta" type="text" id="valor_boleta" size="20"></td>
      <td align="center"><label for="cantidad_cuotas"></label>
      <input name="cantidad_cuotas" type="text" id="cantidad_cuotas" size="5"></td>
      <td align="right"><label for="valor_cuota"></label>
      <input name="valor_cuota" type="text" id="valor_cuota" size="20"></td>
      <td align="center"><span class="celda">
        <input type="text" name="datepicker2" id="datepicker2" size="12">
      </span></td>
      <td align="center"><input type="submit" name="button" id="button" value="Guardar"></td>
    </tr>
    <?php
	$sql="select * from gastos_detalle where cod_gasto=$cod_gasto";
	$q=mysql_query($sql);
	while($gd=mysql_fetch_object($q))
	{
	?>
    <tr>
      <td align="center" class="celda"><?=$gd->fecha?></td>
      <td align="right" class="celda"><?=$gd->valor?></td>
      <td align="center" class="celda"><?=$gd->valor?></td>
      <td align="right" class="celda"><?=$gd->valor?></td>
      <td align="center" class="celda"><?=$gd->valor?></td>
      <td align="center" class="celda">&nbsp;</td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
-->

</body>
</html>