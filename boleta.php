<?php
	require("conexion.php");
	require("dompdf/dompdf_config.inc.php");
	$idventa = $_GET['id'];
	$sql = "select vd.producto as producto, vd.cantidad as cantidad , vd.precio as precio, vd.subtotal as subtotal 
			from venta as v 
			inner join venta_detalle as vd
			on v.id = vd.idventa
			where vd.idventa='$idventa'";	
	$conexion = conecta();							
								
	$consulta = mysql_query($sql, $conexion) or die(mysql_error());
	
	$rs = mysql_query("select * from venta where id ='$idventa'");
			if ($row = mysql_fetch_row($rs)) 
				{
					$fecha = trim($row[1]);
				}
	$rs = mysql_query("select * from venta where id ='$idventa'");
			if ($row = mysql_fetch_row($rs)) 
				{
					$monto = trim($row[2]);
				}		

$html =
'<html>	
	<body>
		<h2 align =center style="color: #039;">BOLETA DE COMPRA</h2>
		<h3 align=right> Fecha de Compra: '.$fecha.'</h3>
		<table width="100%" border="1" cellspacing="0" cellpadding="1" >
		<tr  align = center  style="  font-weight: bold; background: #b9c9fe; color: #039;">
			<td>Producto</td>
			<td>Cantidad</td>
			<td>Precio</td>
			<td>Subtotal</td>			
		</tr>';
		while ($row_R_2 = mysql_fetch_array($consulta))
			{
		$html .= '	
			<tr style="padding: 8px;     background: #e8edff;     border-bottom: 1px solid #fff;
				color: #669;    border-top: 1px solid transparent;">
				<td>'.$row_R_2["producto"].'</td>
				<td>'.$row_R_2["cantidad"].'</td>
				<td>'.$row_R_2["precio"].'</td>
				<td>'.$row_R_2["subtotal"].'</td>				
			</tr>';
			};
$html .= '
	</table>
	<h3 align=right> Monto a pagar: '.$monto.'</h3>	
		<footer>  		  
		  <p align=right>Gracias por tu preferencia..!</p>
		</footer>
	</body>
</html>';

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("Boleta.pdf", array('Attachment'=>'0'));
?>


							
