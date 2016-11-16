<?php
	function conecta()
	{
		$conexion = @mysql_connect ("localhost", "root", "")
			or die ("No se puede conectar con el servidor");	
		mysql_select_db ("dbcarrito")
			or die ("No se puede seleccionar la base de datos");
		return $conexion;
	}
?>