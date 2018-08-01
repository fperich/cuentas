<?php
	include "includes/conectar.php";
	
	$cod_concepto_gasto=$_GET["cod_cg"];
	
	$sql="select * from conceptos_gastos where cod_concepto_gasto=$cod_concepto_gasto";
	$q=mysql_query($sql);
	$cg=mysql_fetch_object($q);
	$concepto_gasto=$cg->concepto_gasto;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Documento sin título</title>
<link href="css/css.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
function Validar()
{
	if(form1.txtConceptoGasto.value=="")
	{
		alert("Ingrese el concepto de gasto");
		form1.txtConceptoGasto.focus();
		return false;
	}
	
	return true;
}
</script>
</head>

<body onLoad="form1.txtConceptoGasto.focus()">
<table width="60%" border="0" cellspacing="1" cellpadding="5">
  <tr>
    <td colspan="2" class="cabecera">CONCEPTOS DE GASTOS</td>
  </tr>
  <tr>
    <td colspan="2"><form name="form1" method="post" action="guardar_concepto_gasto.php?opcion=modificar" onSubmit="return Validar()">
      <label for="txtConceptoGasto"></label>
      <input name="txtConceptoGasto" type="text" id="txtConceptoGasto" value="<?=$concepto_gasto?>" size="50">
      <input type="submit" name="button" id="button" value="Guardar Concepto de Gasto">
      <input type="button" name="button2" id="button2" value="Volver" onClick="location.href='conceptos_gastos.php'">
      <input name="cod_cg" type="hidden" id="cod_cg" value="<?=$cod_concepto_gasto?>">
    </form></td>
  </tr>  
</table>
</body>
</html>