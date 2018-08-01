<?php
	$ano=$_GET["ano"];
	$mes=$_GET["mes"];
	$cod_gasto=$_GET["cod_g"];
	$pago=$_GET["pago"];
	
	include "includes/conectar.php";
	
	$sql="update gastos set pagado=$pago where cod_gasto=$cod_gasto";
	mysql_query($sql);

header("Location: gastos.php?ano=$ano&mes=$mes");
?>