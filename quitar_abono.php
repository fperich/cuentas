<?php
	include "includes/conectar.php";
	
	$cod_gasto=$_GET["cod_g"];
	$ano=$_GET["ano"];
	$mes=$_GET["mes"];
	$valor=$_POST["valor"];
	
	$sql="delete from pagos where cod_gasto=$cod_gasto";
	mysql_query($sql);
	header("Location: gastos.php?cod_g=$cod_gasto&ano=$ano&mes=$mes");
?>