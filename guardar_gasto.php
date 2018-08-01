<?php
	include "includes/conectar.php";
	$fecha=$_POST["datepicker"];
	
	$ano=substr($fecha,6,4);
	$mes=substr($fecha,3,2);
	
		
	$valor=$_POST["valor"];
	$cod_concepto_gasto=$_POST["conceptos_gastos"];
	$pagado=$_POST["chkPagado"]=="on" ? 1 : 0;
	$mensual=$_POST["chkMensual"]=="on" ? 1 : 0;
	
	if($opcion=="")
	{	
		if($mensual==0)
		{
			$sql="insert into gastos (ano,mes,cod_concepto_gasto,valor,pagado) values ($ano,$mes,$cod_concepto_gasto,$valor,$pagado)";
			mysql_query($sql);
		}
		else
		{
			for($a=$mes;$a<13;$a++)
			{
				$mes=$a;
				$sql="insert into gastos (ano,mes,cod_concepto_gasto,valor,pagado) values ($ano,$mes,$cod_concepto_gasto,$valor,$pagado)";
				mysql_query($sql);
			}
		}
	}
	
	header("Location: gastos.php?ano=$ano&mes=$mes");
?>