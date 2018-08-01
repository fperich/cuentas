<?php
	include "includes/conectar.php";
	
	$nuevo_concepto_gasto=$_POST["txtConceptoGasto"];
	$opcion=$_GET["opcion"];
	
	if($opcion=="")
	{	
		$sql="insert into conceptos_gastos (concepto_gasto) values ('$nuevo_concepto_gasto')";
	}
	elseif($opcion=="modificar")
	{
		$cod_concepto_gasto=$_POST["cod_cg"];
		$sql="update conceptos_gastos set concepto_gasto='$nuevo_concepto_gasto' where cod_concepto_gasto=$cod_concepto_gasto";
	}
	mysql_query($sql);
	
	header("Location: conceptos_gastos.php");
?>