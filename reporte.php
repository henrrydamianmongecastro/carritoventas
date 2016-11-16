<?php
	require("conexion.php");
	$sql = "Select fecha, sum(total) as suma
			from venta
			Group by fecha
			";								
	$db_conn = conecta();
	$consulta = mysql_query ($sql, $db_conn) or die ("Fallo en la consulta");								
	
	$sql2="SELECT SUM(total)as total FROM venta";
	$db_conn2 = conecta();
	$consulta3 = mysql_query ($sql2, $db_conn2) or die ("Fallo en la consulta");
	$fila2 = mysql_fetch_array ($consulta3);
?>
<html lang="en">
<head>	
	<meta charset="utf-8">
    <title>Carrito de Compras</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">    
    <link href="css/simple-sidebar.css" rel="stylesheet">    	
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<link href="img/logo.ico" type="image/x-icon" rel="shortcut icon" />
	
	
	<link href="libs/css/bootstrap.css" rel="stylesheet">
	<link href="libs/css/jquery.dataTables.css" rel="stylesheet">
	
    <script src="libs/js/jquery.js"></script>
    <script src="libs/js/jquery-1.8.3.min.js"></script>
	
    <script src="libs/js/bootstrap.min.js"></script>
   	<script src="libs/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="libs/ajax.js"></script>
	
	 <!-- Alertity -->
	
    <link rel="stylesheet" href="libs/js/alertify/themes/alertify.core.css" />
	<link rel="stylesheet" href="libs/js/alertify/themes/alertify.bootstrap.css" id="toggleCSS" />
    <script src="libs/js/alertify/lib/alertify.min.js"></script>
	     	  
	
	<script>         
            $(document).ready(function() {
            $('#listar').DataTable();
            } );
						
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
                    <a href="#">Reportes</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
					<div class="row">
					<br>
					
					<div class="col-lg-12">
						<h2 align="center">VENTAS POR DIA</h2>
						
						<table id="listar"class="table table-striped table-bordered" cellspacing="0" >
                   <thead>
                     <tr>                        						                        
						<th>Fecha</th>
						<th>Total</th>												
						
                     </tr>
                    </thead>
                    <tbody>
                    <?php while( $fila = mysql_fetch_array ($consulta) ){ ?>
                        <tr style="background-color">                           							                            
							<td><?php echo $fila["fecha"] ?></td>
							<td><?php echo $fila["suma"] ?></td>                            																					
						</tr>
							
                    <?php } ?>                    
                    </tbody>
                </table>
					<h2 align="right">Importe de Venta: S/.<?php echo $fila2["total"] ?></h2>
					</div>					
				</div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper --> 

</body>
</html>


