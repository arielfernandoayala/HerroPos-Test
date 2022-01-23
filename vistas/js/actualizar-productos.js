/*=============================================
CARGAR LA TABLA DINÁMICA DE PRODUCTOS
=============================================*/
/*
 $.ajax({

 	url: "ajax/datatable-productos.ajax.php",
 	success:function(respuesta){
		
 		console.log("respuesta", respuesta);

	},
  error:function(respuesta){
    console.log("respuesta", respuesta);
  }

})*/

var perfilActualizarProd = $("#perfilActualizarProd").val();

$('.tablaActualizarProductos').DataTable( {
    "ajax": "ajax/datatable-actualizar-productos.ajax.php?perfilActualizarProd="+perfilActualizarProd,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Actualizando lista de productos...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );



