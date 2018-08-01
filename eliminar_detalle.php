<?php
	include "includes/conectar.php";
	
	$cod_gasto=$_GET["cod_gasto"];
	$cod_pago=$_GET["cod_pago"];
	$ano=$_GET["ano"];
	$mes=$_GET["mes"];
	
	$sql="delete from pagos where cod_gasto=$cod_gasto and cod_pago=$cod_pago";
	mysql_query($sql);
	
	header("Location: gastos_detalle.php?ano=$ano&mes=$mes&cod_g=$cod_gasto");
?>