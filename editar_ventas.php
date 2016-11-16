<?php 
session_start();
$_SESSION['detalle'] = array();
require_once 'Config/conexion.php';
require_once 'Model/Producto.php';
require("conexion.php");
$objProducto = new Producto();
$resultado_producto = $objProducto->get();

$id = $_GET["id"];
$sql = "select * from venta_detalle where idventa='$id'";								
$db_conn = conecta();
$consulta = mysql_query ($sql, $db_conn) or die ("Fallo en la consulta");								
?>


<html lang="en">
  <head>
    <title>Carrito de Compras</title>

    <!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">    
    <link href="css/simple-sidebar.css" rel="stylesheet">    	
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<link href="img/logo.ico" type="image/x-icon" rel="shortcut icon" />
	
    <link href="libs/css/bootstrap.css" rel="stylesheet">
    <script src="libs/js/jquery.js"></script>
    <script src="libs/js/jquery-1.8.3.min.js"></script>
    <script src="libs/js/bootstrap.min.js"></script>
   	
    <script type="text/javascript" src="libs/ajax.js"></script>
	
	 <!-- Alertity -->
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="libs/js/alertify/themes/alertify.bootstrap.css" id="toggleCSS" />
    <script src="libs/js/alertify/lib/alertify.min.js"></script>
	<script>
	function validar(e) {
		tecla = (document.all)?e.keyCode:e.which;
		if (tecla==8) return true;
		patron = /\d/;
		te = String.fromCharCode(tecla);
		return patron.test(te); 
	} 
</script>
  </head>

  
 

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="index.php">
                        VENTAS
                    </a>
                </li>
                <li>
                    <a href="ventas.php">Registro de Ventas</a>
                </li>
                <li>
                    <a href="listado_ventas.php">Listado de Ventas</a>
                </li>
                <li>
                    <a href="reporte.php">Reportes</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
				   <div class="col-lg-1"></div>
				   <div class="col-lg-10">
						<div class="page-header">
			<h1>Editar Venta</h1>
			<div>
			<table class="table table-striped table-bordered" cellspacing="0" >
                   <thead>
                     <tr>                        						
                        <th>Descripci&oacute;n</th>					            
					    <th>Precio</th>
						<th>Cantidad</th>
					    <th>Subtotal</th>						
                     </tr>
                    </thead>
                    <tbody>
                    <?php while( $fila = mysql_fetch_array ($consulta) ){ ?>
                        <tr style="background-color">                           							
                            <td><?php echo $fila["producto"] ?></td>                            
							<td><?php echo $fila["precio"] ?></td>
							<td><?php echo $fila["cantidad"] ?></td>                            																					
							<td><?php echo $fila["subtotal"] ?></td>                            																					
						</tr>
							
                    <?php } ?>                    
                    </tbody>
                </table>
		</div>
		</div>
 		<div class="row">
			<div class="col-md-4">	
				<div>Producto: <input id="txt_producto" name="txt_producto" type="text" class="col-md-2 form-control" placeholder="Ingresar Producto.." autocomplete="off" />
				</div>
			</div>
			<div class="col-md-2">
				<div>Precio:
				  <input id="txt_precio" name="txt_precio" type="number" class="col-md-2 form-control" placeholder="Precio" autocomplete="off" step="any"  />
				</div>
			</div>
			<div class="col-md-2">
				<div>Cantidad:
				  <input id="txt_cantidad" name="txt_cantidad" type="number" class="col-md-2 form-control" placeholder="Cantidad" autocomplete="off" onkeypress="return validar(event)" />
				</div>
			</div>
			<div class="col-md-1">
				<div style="margin-top: 19px;">
				<button type="button" class="btn btn-success btn-agregar-producto">Agregar</button>
				</div>
			</div>			
		</div>
		
		<br>
		<input type="hidden" id="idventa" name="idventa" value=<?php echo $id;?>>
		<div class="panel panel-info">
			 <div class="panel-heading">
		        <h3 class="panel-title">Listado de Productos</h3>
		      </div>
			<div class="panel-body detalle-producto">
				<?php if(count($_SESSION['detalle'])>0){?>
					<table class="table">
					    <thead>
					        <tr>
					            <th>Descripci&oacute;n</th>					            
					            <th>Precio</th>
								<th>Cantidad</th>
					            <th>Subtotal</th>
					            <th></th>
					        </tr>
					    </thead>
					    <tbody>
					    	<?php 
					    	foreach($_SESSION['detalle'] as $k => $detalle){ 
					    	?>
					        <tr>
					        	<td><?php echo $detalle['producto'];?></td>
					            <td><?php echo $detalle['precio'];?></td>
								<td><?php echo $detalle['cantidad'];?></td>					            
					            <td><?php echo $detalle['subtotal'];?></td>
					            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>">Eliminar</button></td>
					        </tr>
					        <?php }?>
					    </tbody>
					</table>
				<?php }else{?>
				<div class="panel-body"> No hay productos agregados</div>
				<?php }?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 text-right">
				<button type="button" class="btn btn-sm btn-info editar-carrito">Guardar</button>
			</div>
		</div>
					</div>
					<div class="col-lg-1"></div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper --> 

</body>

 
</html>
