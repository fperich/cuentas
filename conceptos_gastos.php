<?php
	$donde=$_GET["donde"];
	
	if(empty($donde))
	{
		$donde="index";
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Conceptos de Gastos</title>
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
<table border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td colspan="3" class="cabecera">CONCEPTOS DE GASTOS</td>
  </tr>
  <tr>
    <td colspan="3"><form name="form1" method="post" action="guardar_concepto_gasto.php" onSubmit="return Validar()">
      <label for="txtConceptoGasto"></label>
      <input name="txtConceptoGasto" type="text" id="txtConceptoGasto" size="50">
      <input type="submit" name="button" id="button" value="Agregar Concepto de Gasto">
      <input type="button" name="button2" id="button2" value="Volver" onClick="location.href='<?=$donde?>.php'">
    </form></td>
  </tr>
  <tr>
    <td class="cabecera">Concepto de Gasto</td>
    <td nowrap class="cabecera">Visible</td>
    <td nowrap class="cabecera">Opciones</td>
  </tr>
  <?php
  include "includes/conectar.php";
  
  $sql="select * from conceptos_gastos order by concepto_gasto";
  $q=mysql_query($sql);
  
  while($cg=mysql_fetch_object($q))
  {
    ?>
    <tr>
      <td class="celda"><?=$cg->concepto_gasto?></td>
      <td align="center" class="celda"><input type="checkbox" name="visible" value="1" checked="checked"></td>
      <td align="center" nowrap class="celda"><a href="modificar_concepto_gasto.php?cod_cg=<?=$cg->cod_concepto_gasto?>">Modificar</a> - <a href="eliminar_concepto_gasto.php?cod_cg=<?=$cg->cod_concepto_gasto?>">Eliminar</a></td>
    </tr>
    <?php
  }
  ?>
</table>
</body>
</html>