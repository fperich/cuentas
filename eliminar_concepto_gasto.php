<?php
	include "includes/conectar.php";
	
	$cod_concepto_gasto=$_GET["cod_cg"];
	
	$sql="delete from conceptos_gastos where cod_concepto_gasto=$cod_concepto_gasto";
	mysql_query($sql);
	
	header("Location: conceptos_gastos.php");
?>