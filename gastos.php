<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Ingresar Gastos</title>
<link href="jquery-ui-1.8.20.completo/css/redmond/jquery-ui-1.8.20.custom.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="jquery-ui-1.8.20.completo/js/jquery-ui-1.8.20.custom.min.js"></script>
<script>
$(function() {
	$("#datepicker").datepicker({"dateFormat":"dd/mm/yy"});		
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
	
	if(form1.conceptos_gastos.selectedIndex==0)
	{
		alert("Seleccione un concepto de gasto");
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
<link href="css/css.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="form1" method="post" action="guardar_gasto.php" onSubmit="return Verificar()">
  <table border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td colspan="6" class="cabecera">GASTOS</td>
    </tr>
    <tr>
      <td colspan="6">&nbsp;</td>
    </tr>
    <tr>
      <td class="cabecera">Fecha</td>
      <td class="cabecera">Concepto</td>
      <td class="cabecera">Valor</td>
      <td align="center" class="cabecera">Valor  Mensual</td>
      <td align="center" class="cabecera">Pagado</td>
      <td align="center" class="cabecera"><input type="button" name="button2" id="button2" value="Volver" onClick="location.href='index.php'"></td>
    </tr>
    <tr>
      <td class="celda"><input type="text" name="datepicker" id="datepicker" size="12"></td>
      <td class="celda"><select name="conceptos_gastos" id="conceptos_gastos">
      	<option value="">Seleccionar...</option>
          <?php
		include "includes/conectar.php";
		$sql="select * from conceptos_gastos order by concepto_gasto";
		$q=mysql_query($sql);
		while($cg=mysql_fetch_object($q))
		{
		?>
          <option value="<?=$cg->cod_concepto_gasto?>">
            <?=$cg->concepto_gasto?>
          </option>
          <?
		}
		?>
        </select>
        <input type="button" name="button3" id="button3" value="Nuevo Concepto" onClick="location.href='conceptos_gastos.php?donde=gastos'"></td>
      <td class="celda"><input type="text" name="valor" id="valor"></td>
      <td align="center" class="celda"><input type="checkbox" name="chkMensual" id="chkMensual"></td>
      <td align="center" class="celda"><input type="checkbox" name="chkPagado" id="chkPagado">
      <label for="chkPagado"></label></td>
      <td align="center" class="celda"><input type="submit" name="button" id="button" value="Agregar"></td>
    </tr>
  </table>
</form>
<form name="form2" method="post" action="">
  <table border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td><select name="mes" id="mes" onChange="form2.submit()">
        <?php
		$mes=!empty($_POST["mes"])? $_POST["mes"] : $_GET["mes"];
  $mesactual=date("m");
  if($mes=="")
  {
	  $mes=date("m");
  }
  
  $meses=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  
  for($a=1;$a<13;$a++)
  {
  ?>
        <option value="<?=$a?>" <?php if($mes==$a){echo " selected";}?>>
          <?=$meses[$a]?>
          </option>
        <?php
  }
  ?>
        </select>
        <select name="ano" id="ano" onChange="form2.submit()">
          <?php
		$ano=!empty($_POST["ano"]) ? $_POST["ano"]: $_GET["ano"];
  $anoactual=date("Y");
  if($ano=="")
  {
	  $ano=date("Y");
  }
  
  for($a=$anoactual-5;$a<$anoactual+5;$a++)
  {
  ?>
          <option value="<?=$a?>" <?php if($ano==$a){echo " selected";}?>>
            <?=$a?>
          </option>
          <?php
  }
  ?>
      </select></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td class="cabecera">Concepto</td>
      <td align="right" class="cabecera">Valor</td>
      <td align="center" class="cabecera">Pagado</td>
      <td align="center" class="cabecera">Abonado</td>
      <td align="center" class="cabecera">&nbsp;</td>
      <td align="center" class="cabecera">Opciones</td>
    </tr>
    <?php
	$sql="select * from gastos where ano=$ano and mes=$mes";
	$q=mysql_query($sql);
	while($g=mysql_fetch_object($q))
	{
		$sql="select * from conceptos_gastos where cod_concepto_gasto=".$g->cod_concepto_gasto;
		$q2=mysql_query($sql);
		$cg=mysql_fetch_object($q2);
		$concepto_gasto=$cg->concepto_gasto;
		
		$abonado=0;
		
		$sql="select * from pagos where cod_gasto=".$g->cod_gasto;
		$q2=mysql_query($sql);
		while($p=mysql_fetch_object($q2))
		{
			$abonado+=$p->valor_pago;
		}
		
		$pagado=$g->pagado;
		
	?>
    <tr>
      <td class="celda"><a href="gastos_detalle.php?cod_g=<?=$g->cod_gasto?>"><?=$concepto_gasto?></a></td>
      <td align="right" class="celda"><?="$ ".number_format($g->valor,0)?></td>
      <td align="center" class="celda"><?=($g->pagado==1)?"SI":"NO"?></td>
      <td align="center" nowrap class="celda"><? if($pagado==0){echo $abonado;}else{echo "0";}?></td>
      <td align="center" nowrap class="celda"><?php if($pagado==0){?><a href="abonar.php?cod_g=<?=$g->cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>&pago=1">Abonar</a> - <a href="quitar_abono.php?cod_g=<?=$g->cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>&pago=1">Quitar Abono</a><?php }?> - <?php if($pagado==0){?><a href="pagar.php?cod_g=<?=$g->cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>&pago=1">Pagar</a><?php } else { ?>  - <a href="pagar.php?cod_g=<?=$g->cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>&pago=0">Quitar Pago</a><?php } ?></td>
      <td align="center" nowrap class="celda"><a href="eliminar_gasto.php?cod_g=<?=$g->cod_gasto?>&ano=<?=$ano?>&mes=<?=$mes?>">Eliminar</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>