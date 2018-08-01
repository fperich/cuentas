<?php
	include "includes/conectar.php";
	
	$cod_gasto=$_GET["cod_gasto"];
	$ano=$_GET["ano"];
	$mes=$_GET["mes"];
	$valor=$_POST["valor"];
	
	$sql="select * from pagos where cod_gasto=$cod_gasto order by cod_pago desc";
	$q=mysql_query($sql);
	$cp=mysql_fetch_object($q);
	$cod_pago=$cp->cod_pago+1;

	$sql="insert into pagos (cod_gasto,cod_pago,valor_pago) values ($cod_gasto,$cod_pago,$valor)";
	mysql_query($sql);
	header("Location: abonar.php?cod_g=$cod_gasto&ano=$ano&mes=$mes");
?>