<?php
class Producto
{
	function get(){
		$sql = "SELECT * FROM producto";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getById($id){
		$sql = "SELECT * FROM producto WHERE id=$id";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarVenta($total){
		$sql = "INSERT INTO venta (fecha,total) values (NOW(),$total)";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function getUltimaVenta()
	{
		$sql = "SELECT LAST_INSERT_ID() as ultimo";
		global $cnx;
		return $cnx->query($sql);
	}
	
	function guardarDetalleVenta($idventa,$producto,$cantidad,$precio,$subtotal){
		$sql = "INSERT INTO venta_detalle (idventa,producto,cantidad,precio,subtotal) values ($idventa,'$producto',$cantidad,$precio,$subtotal)";
		global $cnx;
		return $cnx->query($sql);
	}

}