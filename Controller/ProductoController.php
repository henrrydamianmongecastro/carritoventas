<?php
session_start();
if(isset($_GET["page"])){
	$page=$_GET["page"];
}else{
	$page=0;
}

require_once '../Config/conexion.php';
require_once '../Model/Producto.php';

switch($page){

	case 1:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Producto Agregado';
		$json['success'] = true;
	
		if (isset($_POST['producto']) && $_POST['producto']!='' && isset($_POST['cantidad']) && $_POST['cantidad']!=''&& isset($_POST['precio']) && $_POST['precio']!='') {
			try {
				$cantidad = $_POST['cantidad'];
				$producto = $_POST['producto'];
				$precio = $_POST['precio'];
				$subtotal = $cantidad * $precio;				
				
				if(count($_SESSION['detalle'])>0){
					$ultimo = end($_SESSION['detalle']);
					$count = $ultimo['id']+1;
				}else{
					$count = count($_SESSION['detalle'])+1;
				}
				$_SESSION['detalle'][$count] = array('id'=>$count, 'producto'=>$producto, 'precio'=>$precio,'cantidad'=>$cantidad,'subtotal'=>$subtotal);

				$json['success'] = true;

				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'Ingrese un producto y/o ingrese cantidad';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;

	case 2:
		$json = array();
		$json['msj'] = 'Producto Eliminado';
		$json['success'] = true;
	
		if (isset($_POST['id'])) {
			try {
				unset($_SESSION['detalle'][$_POST['id']]);
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}
		break;
		
	case 3:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Guardado correctamente';
		$json['success'] = true;
	
		if (count($_SESSION['detalle'])>0) {
			try {
				$total = $_POST['total'];				
				$objProducto->guardarVenta($total);
				$registro_ultima_venta = $objProducto->getUltimaVenta();
				$result_ultima_venta = $registro_ultima_venta->fetchObject();
				$idventa = $result_ultima_venta->ultimo;
				foreach($_SESSION['detalle'] as $detalle):					
					$producto = $detalle['producto'];
					$cantidad = $detalle['cantidad'];
					$precio = $detalle['precio'];
					$subtotal = $detalle['subtotal'];
					$objProducto->guardarDetalleVenta($idventa,$producto, $cantidad, $precio, $subtotal);
				endforeach;
				
				$_SESSION['detalle'] = array();
						
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'No hay productos agregados';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;
		
	case 4:
		$objProducto = new Producto();
		$json = array();
		$json['msj'] = 'Guardado correctamente';
		$json['success'] = true;
	
		if (count($_SESSION['detalle'])>0) {
			try {
				$idventa = $_POST['idventa'];												
				foreach($_SESSION['detalle'] as $detalle):					
					$producto = $detalle['producto'];
					$cantidad = $detalle['cantidad'];
					$precio = $detalle['precio'];
					$subtotal = $detalle['subtotal'];
					$objProducto->guardarDetalleVenta($idventa,$producto, $cantidad, $precio, $subtotal);
				endforeach;
				
				$_SESSION['detalle'] = array();
						
				$json['success'] = true;
	
				echo json_encode($json);
	
			} catch (PDOException $e) {
				$json['msj'] = $e->getMessage();
				$json['success'] = false;
				echo json_encode($json);
			}
		}else{
			$json['msj'] = 'No hay productos agregados';
			$json['success'] = false;
			echo json_encode($json);
		}
		break;	

}
?>