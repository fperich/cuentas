<?php
	include "includes/conectar.php";
	
	$cod_gasto=$_GET["cod_g"];
	$ano=$_GET["ano"];
	$mes=$_GET["mes"];
	
	$sql="delete from gastos where cod_gasto=$cod_gasto";
	mysql_query($sql);
	
	header("Location: gastos.php?ano=$ano&mes=$mes");
?>