$(function(){
	var ENV_WEBROOT = "../";
	
	$(".btn-agregar-producto").off("click");
	$(".btn-agregar-producto").on("click", function(e) {
		var cantidad = $("#txt_cantidad").val();
		var producto = $("#txt_producto").val();
		var precio = $("#txt_precio").val();		
		if(producto!=''){
			if(cantidad!=''){
				$.ajax({
					url: 'Controller/ProductoController.php?page=1',
					type: 'post',
					data: {'producto':producto, 'cantidad':cantidad,'precio':precio},
					dataType: 'json',
					success: function(data) {
						if(data.success==true){
							$("#txt_cantidad").val('');
							$("#txt_producto").val('');
							$("#txt_precio").val('');														
							alertify.success(data.msj);
							$(".detalle-producto").load('detalle.php');
						}else{
							alertify.error(data.msj);
						}
					},
					error: function(jqXHR, textStatus, error) {
						alertify.error(error);
					}
				});				
			}else{
				alertify.error('Ingrese una cantidad');
			}
		}else{
			alertify.error('Seleccione un producto');
		}
	});
	
	$(".eliminar-producto").off("click");
	$(".eliminar-producto").on("click", function(e) {
		var id = $(this).attr("id");
		$.ajax({
			url: 'Controller/ProductoController.php?page=2',
			type: 'post',
			data: {'id':id},
			dataType: 'json'
		}).done(function(data){
			if(data.success==true){
				alertify.success(data.msj);
				$(".detalle-producto").load('detalle.php');
			}else{
				alertify.error(data.msj);
			}
		})
	});
	
	$(".guardar-carrito").off("click");
	$(".guardar-carrito").on("click", function(e) {
		var total = $("#txt_total").val();
		$.ajax({
			url: 'Controller/ProductoController.php?page=3',
			type: 'post',
			data: {'total':total},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					$("#txt_cantidad").val('');					
					$("#txt_producto").val('');
					$("#txt_precio").val('');															
					alertify.success(data.msj);
					$(".detalle-producto").load('detalle.php');
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});				
	});
	
	$(".editar-carrito").off("click");
	$(".editar-carrito").on("click", function(e) {
		var idventa = $("#idventa").val();
		$.ajax({
			url: 'Controller/ProductoController.php?page=4',
			type: 'post',
			data: {'idventa':idventa},
			dataType: 'json',
			success: function(data) {
				if(data.success==true){
					$("#txt_cantidad").val('');					
					$("#txt_producto").val('');
					$("#txt_precio").val('');																				
					alertify.success(data.msj);
					$(".detalle-producto").load('detalle.php');
				}else{
					alertify.error(data.msj);
				}
			},
			error: function(jqXHR, textStatus, error) {
				alertify.error(error);
			}
		});				
	});
	
});