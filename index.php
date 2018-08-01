<?
  include "includes/conectar.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Cuentas Mensuales</title>
<link href="css/css.css" rel="stylesheet" type="text/css">

</head>

<body>
<form name="form1" method="post" action="">
  <table width="100%" border="0" cellpadding="1" cellspacing="1">
    <tr>
      <td valign="middle" bgcolor="#CCCCCC">AÑO</td>
      <td valign="middle" bgcolor="#CCCCCC"><select name="ano" id="ano" onChange="form1.submit()">
        <?php
      	$ano = $_POST["ano"];
        $anoactual = date("Y");

        if($ano == "") {
      	  $ano = date("Y");
        }

        
        // $sql = "select * from gastos order by ano asc";
        $sql = "SELECT sql_cache ano FROM gastos ORDER BY ano ASC LIMIT 1";
        $minimo = mysql_fetch_object(mysql_query($sql))->ano;
        
        for($a = $minimo; $a < $anoactual + 11; $a++)
        {
        ?>
              <option value="<?= $a ?>" <?php if($ano == $a){echo " selected";}?>>
                <?= $a ?>
                </option>
              <?php
        }
        ?>
      </select></td>
      <td valign="middle" bgcolor="#CCCCCC"><input type="button" name="button" id="button" value="Conceptos de Gastos" onClick="location.href='conceptos_gastos.php?donde=index'">
        <input type="button" name="button2" id="button2" value="Gastos" onClick="location.href='gastos.php'"></td>
      <td valign="middle" bgcolor="#CCCCCC"><table border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td align="center" nowrap="nowrap" class="nopagado">ESTO NO SE HA PAGADO</td>
          <td align="center" nowrap="nowrap" class="pagado">ESTO YA SE PAGÓ</td>
          <td align="center" nowrap="nowrap" class="abonado">SE HA ABONADO, PERO ESTO FALTA POR PAGAR</td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<table width="100%" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td valign="bottom" class="cabecera">Gasto</td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=1&ano=<?= $ano ?>">Enero</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=2&ano=<?= $ano ?>">Febrero</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=3&ano=<?= $ano ?>">Marzo</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=4&ano=<?= $ano ?>">Abril</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=5&ano=<?= $ano ?>">Mayo</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=6&ano=<?= $ano ?>">Junio</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=7&ano=<?= $ano ?>">Julio</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=8&ano=<?= $ano ?>">Agosto</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=9&ano=<?= $ano ?>">Septiembre</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=10&ano=<?= $ano ?>">Octubre</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=11&ano=<?= $ano ?>">Noviembre</a></td>
    <td align="right" valign="bottom" class="cabecera"><a href="gastos.php?mes=12&ano=<?= $ano ?>">Diciembre</a></td>
    <td align="right" valign="bottom" class="cabecera"> TOTAL ANUAL</td>
  </tr>
  <?php
  
  $sql = "select sql_cache * from conceptos_gastos order by concepto_gasto";
  $q = mysql_query($sql);
  
  while($cg = mysql_fetch_object($q))
  {
	  ?>
    <tr>
    <td class="celda"><?= $cg->concepto_gasto ?></td>
      <?
	  for($a = 1; $a < 13; $a++)
	  {
		  $sql="select sql_cache * from gastos where cod_concepto_gasto=".$cg->cod_concepto_gasto." and ano=$ano and mes=$a order by cod_concepto_gasto";
		  $q2=mysql_query($sql);
		  if(mysql_num_rows($q2)>0)
		  {
			  while($g=mysql_fetch_object($q2))
			  {
					  $abono=0;
				  if($g->pagado==1)
				  {
					  $pagado="pagado";
					  
					  if($g->mes==1){	$sumapagado1+=$g->valor;}
						if($g->mes==2){	$sumapagado2+=$g->valor;}
						if($g->mes==3){	$sumapagado3+=$g->valor;}
						if($g->mes==4){	$sumapagado4+=$g->valor;}
						if($g->mes==5){	$sumapagado5+=$g->valor;}
						if($g->mes==6){	$sumapagado6+=$g->valor;}
						if($g->mes==7){	$sumapagado7+=$g->valor;}
						if($g->mes==8){	$sumapagado8+=$g->valor;}
						if($g->mes==9){	$sumapagado9+=$g->valor;}
						if($g->mes==10){$sumapagado10+=$g->valor;}
						if($g->mes==11){$sumapagado11+=$g->valor;}
						if($g->mes==12){$sumapagado12+=$g->valor;}
				  }
				  else
				  {
					  $pagado="nopagado";
					  
					  $cod_gasto=$g->cod_gasto;
					  
				  
					  $sql="select sql_cache * from pagos where cod_gasto=$cod_gasto";
					  $q2=mysql_query($sql);
					  while($p=mysql_fetch_object($q2))
					  {
						  $abono+=$p->valor_pago;
					  }
				  }
				  
				  if($abono>0)
				  {
					  $pagado="abonado";
				  }
				  
				  $sumacuenta+=$g->valor;
				  
					if($g->mes==1){	$suma1+=$g->valor-$abono;}
					if($g->mes==2){	$suma2+=$g->valor-$abono;}
					if($g->mes==3){	$suma3+=$g->valor-$abono;}
					if($g->mes==4){	$suma4+=$g->valor-$abono;}
					if($g->mes==5){	$suma5+=$g->valor-$abono;}
					if($g->mes==6){	$suma6+=$g->valor-$abono;}
					if($g->mes==7){	$suma7+=$g->valor-$abono;}
					if($g->mes==8){	$suma8+=$g->valor-$abono;}
					if($g->mes==9){	$suma9+=$g->valor-$abono;}
					if($g->mes==10){$suma10+=$g->valor-$abono;}
					if($g->mes==11){$suma11+=$g->valor-$abono;}
					if($g->mes==12){$suma12+=$g->valor-$abono;}
					
					if($g->mes==1){	$sumames1+=$g->valor;}
					if($g->mes==2){	$sumames2+=$g->valor;}
					if($g->mes==3){	$sumames3+=$g->valor;}
					if($g->mes==4){	$sumames4+=$g->valor;}
					if($g->mes==5){	$sumames5+=$g->valor;}
					if($g->mes==6){	$sumames6+=$g->valor;}
					if($g->mes==7){	$sumames7+=$g->valor;}
					if($g->mes==8){	$sumames8+=$g->valor;}
					if($g->mes==9){	$sumames9+=$g->valor;}
					if($g->mes==10){$sumames10+=$g->valor;}
					if($g->mes==11){$sumames11+=$g->valor;}
					if($g->mes==12){$sumames12+=$g->valor;}
					
					$valor=$g->valor-$abono;
			  ?>
				<td align="right" class="<?=$pagado?>"><a href="gastos.php?mes=<?=$g->mes?>&ano=<?=$ano?>"><? if($g->mes==$a){echo "$ ".number_format($valor);}?></a></td>
				<?
			  }
		  }
		  else
		  {
			  ?>
              <td class="celda">&nbsp;</td>
              <?
		  }
	  }
	?>
    <td align="right" class="cabecera"><? if(!empty($sumacuenta)){echo "$ ".number_format($sumacuenta,0);}?></td>
  </tr>
  <?php
  	$sumacuenta="";
  }
  
  $deudatotal = $suma1 + $suma2 + $suma3 + $suma4 + $suma5 + $suma6 + $suma7 + $suma8 + $suma9 + $suma10 + $suma11 + $suma12;
  ?>
  <tr class="totales">
    <td>TOTAL MENSUAL</td>
    <td align="right"><? if(!empty($suma1)){ echo "$ " . number_format($sumames1); }?></td>
    <td align="right"><? if(!empty($suma2)){ echo "$ " . number_format($sumames2); }?></td>
    <td align="right"><? if(!empty($suma3)){ echo "$ " . number_format($sumames3); }?></td>
    <td align="right"><? if(!empty($suma4)){ echo "$ " . number_format($sumames4); }?></td>
    <td align="right"><? if(!empty($suma5)){ echo "$ " . number_format($sumames5); }?></td>
    <td align="right"><? if(!empty($suma6)){ echo "$ " . number_format($sumames6); }?></td>
    <td align="right"><? if(!empty($suma7)){ echo "$ " . number_format($sumames7); }?></td>
    <td align="right"><? if(!empty($suma8)){ echo "$ " . number_format($sumames8); }?></td>
    <td align="right"><? if(!empty($suma9)){ echo "$ " . number_format($sumames9); }?></td>
    <td align="right"><? if(!empty($suma10)){ echo "$ " . number_format($sumames10); }?></td>
    <td align="right"><? if(!empty($suma11)){ echo "$ " . number_format($sumames11); }?></td>
    <td align="right"><? if(!empty($suma12)){ echo "$ " . number_format($sumames12); }?></td>
    <td align="right"><?="$ ".number_format($deudatotal)?></td>
  </tr>
  <tr class="totales">
  <td>FALTA PAGAR</td>
    <td align="right"><? if($suma1>0){echo "$ ".number_format($suma1-$sumapagado1);}?></td>
    <td align="right"><? if($suma2>0){echo "$ ".number_format($suma2-$sumapagado2);}?></td>
    <td align="right"><? if($suma3>0){echo "$ ".number_format($suma3-$sumapagado3);}?></td>
    <td align="right"><? if($suma4>0){echo "$ ".number_format($suma4-$sumapagado4);}?></td>
    <td align="right"><? if($suma5>0){echo "$ ".number_format($suma5-$sumapagado5);}?></td>
    <td align="right"><? if($suma6>0){echo "$ ".number_format($suma6-$sumapagado6);}?></td>
    <td align="right"><? if($suma7>0){echo "$ ".number_format($suma7-$sumapagado7);}?></td>
    <td align="right"><? if($suma8>0){echo "$ ".number_format($suma8-$sumapagado8);}?></td>
    <td align="right"><? if($suma9>0){echo "$ ".number_format($suma9-$sumapagado9);}?></td>
    <td align="right"><? if($suma10>0){echo "$ ".number_format($suma10-$sumapagado10);}?></td>
    <td align="right"><? if($suma11>0){echo "$ ".number_format($suma11-$sumapagado11);}?></td>
    <td align="right"><? if($suma12>0){echo "$ ".number_format($suma12-$sumapagado12);}?></td>
    <td align="right">&nbsp;</td>
  </tr>
</table>
</body>
</html>