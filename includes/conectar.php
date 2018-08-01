<?php
	function Conectar()	{
		if (!($mysql=mysql_connect("localhost","user","pass")))	{
			die("ERROR EN CONEXIÓN, verifica usuario y contraseña de base de datos");
			exit;
		}

		if (!mysql_select_db("cuentas", $mysql)) {
			die("ERROR AL ABRIR BASE DE DATOS, verifica el nombre de la base de datos");
			exit;
		}
		return $mysql;
	}
	
	$mysql = @Conectar();
?>