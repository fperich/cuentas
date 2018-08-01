<?php
$cod_gasto=$_GET["cod_g"];
$ano=$_GET["ano"];
$mes=$_GET["mes"];

include "includes/conectar.php";

$sql="select * from gastos where cod_gasto=$cod_gasto and ano=$ano and mes=$mes";
$q=mysql_query($sql);
$g=mysql_fetch_object($q);

$cod_concepto_gasto=$g->cod_concepto_gasto;
$valor_total=$g->valor;

$sql="select * from conceptos_gastos where cod_concepto_gasto=$cod_concepto_gasto";
$q=mysql_query($sql);
$cg=mysql_fetch_object($q);

$concepto_gasto=$cg->concepto_gasto;

$abonado=0;
		
$sql="select * from pagos where cod_gasto=".$cod_gasto;
$q2=mysql_query($sql);
while($p=mysql_fetch_object($q2))
{
	$abonado+=$p->valor_pago;
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ingresar Gastos</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<link href="jquery-ui-1.8.20.completo/css/redmond/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.20.completo/js/jquery-ui-1.8.20.custom.min.js"></script>

<script type="text/javascript">
function Verificar()
{
	if(form1.datepicker.value=="")
	{
		alert("Seleccione una fecha");
		form1.datepicker.focus();
		return false;
	}
	
	if(form1.conceptos_gastos.selectedIndex==0)
	{
		alert("Seleccione unun concepto de gasto");
		form1.conceptos_gastos.focus();
		return false;
	}
	
	if(form1.valor.value=="")
	{
		alert("Ingrese el valor");
		form1.valor.focus();
		return false;
	}
	
	return true;
}
</script>
</head>
<body>
<form name="form1" method="post" action="guardar_abono.php?cod_gasto=<?=$cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>" onSubmit="return Verificar()">
  <table border="0" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="6" class="cabecera">ABONAR</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td nowrap class="cabecera">Año-Mes</td>
      <td class="cabecera">Concepto</td>
      <td class="cabecera">Valor Total</td>
      <td class="cabecera">Abonado</td>
      <td class="cabecera">Valor Abono / Pago</td>
      <td align="center" class="cabecera"><input type="button" name="button2" id="button2" value="Volver" onClick="location.href='gastos.php?cod_gasto=<?=$cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>'"></td>
    </tr>
    <tr>
      <td class="celda"><?="$ano-$mes"?></td>
      <td class="celda"><?=$concepto_gasto?></td>
      <td class="celda"><?=$valor_total?></td>
      <td class="celda"><?=$abonado?></td>
      <td class="celda"><input type="text" name="valor" id="valor"></td>
      <td align="center" class="celda"><input type="submit" name="button" id="button" value="Agregar"></td>
    </tr>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>