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

var perfilOculto = $("#perfilOculto").val();

$('.tablaProductos').DataTable( {
    "ajax": "ajax/datatable-productos.ajax.php?perfilOculto="+perfilOculto,
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Cargando lista de productos...",
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




/*

/*=============================================
CAPTURANDO LA CATEGORIA PARA ASIGNAR CÓDIGO
=============================================
$("#nuevaCategoria").change(function(){

	var idCategoria = $(this).val();

	var datos = new FormData();
  	datos.append("idCategoria", idCategoria);

  	$.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

      	if(!respuesta){

      		var nuevoCodigo = idCategoria+"01";
      		$("#nuevoCodigo").val(nuevoCodigo);

      	}else{

      		var nuevoCodigo = Number(respuesta["codigo"]) + 1;
          	$("#nuevoCodigo").val(nuevoCodigo);

      	}
                
      }

  	})

})

*/

/*=============================================
AGREGANDO PRECIO DE VENTA
=============================================*/
$("#nuevoPrecioCompra, #editarPrecioCompra, #nuevoIva, #editarIva, #nuevoCoeficiente, #editarCoeficiente, #editarRentabilidad, .nuevoPorcentaje, #nuevoIncrementador").change(function(){

	if($(".porcentaje").prop("checked")){

		var valorPorcentaje = $(".nuevoPorcentaje").val(); //porcentaje ingresado en el formulario NUEVO
    //console.log("valorPorcentaje,", valorPorcentaje);

    var valorEditarPorcentaje = Number($("#editarRentabilidad").val()); //porcentaje al EDITAR
    //console.log("valorEditarPorcentaje,", valorEditarPorcentaje);
    /*----------------------------------------------------------------------------------------*/

    var valorPrecioCompra = Number($("#nuevoPrecioCompra").val()); //precio de compra NUEVO
    //console.log("valorPrecioCompra,", valorPrecioCompra);

    var valorEditarPrecioCompra = Number($("#editarPrecioCompra").val()); //precio de compra EDITAR
    //console.log("valorPrecioCompra,", valorPrecioCompra);
    /*----------------------------------------------------------------------------------------*/

    var valorCoeficiente = Number($("#nuevoCoeficiente").val()); // valor coeficiente NUEVO

    var valorEditarCoeficiente = Number($("#editarCoeficiente").val()); // valor coeficiente EDITAR
    /*----------------------------------------------------------------------------------------*/


    var valorIva = Number($("#nuevoIva").val()); // valor de IVA NUEVO

    var valorEditarIva = Number($("#editarIva").val()); //  valor de editar IVA
    /*----------------------------------------------------------------------------------------*/

    var valIncrementador = Number($("#nuevoIncrementador").val()); // valor de INCREMENTADOR NUEVO

    /*----------------------------------------------------------------------------------------*/


    
   
      var nuevoSub1 = Number(valorPrecioCompra + (valorPrecioCompra*valorCoeficiente)/100);
      //console.log("SUB1,", nuevoSub1);
      var nuevoSub2 = Number(nuevoSub1 + (nuevoSub1*valorIva)/100);
      //console.log("SUB2,", nuevoSub2);
      var nuevoSub3 = Number((nuevoSub2)*valorPorcentaje/100)+nuevoSub2;
      //console.log("SUB3,", nuevoSub3);
      var nuevoSub4 = Number((nuevoSub3)*valIncrementador/100)+nuevoSub3;
      //console.log("SUB3,", nuevoSub4);



      var editarSub1 = Number(valorEditarPrecioCompra + (valorEditarPrecioCompra*valorEditarCoeficiente)/100);
      //console.log("EDIT su1  1,", editarSub1);
      var editarSub2 = Number(editarSub1 + (editarSub1*valorEditarIva)/100);
      //console.log("EDIT sub2 2,", editarSub2);
      var editarSub3 = Number(editarSub2 + (editarSub2*valorEditarPorcentaje)/100);
      //console.log("EDIT sub3 3,", editarSub3);
    

		$("#nuevoPrecioVenta").val(nuevoSub3.toFixed(2));
		$("#nuevoPrecioVenta").prop("readonly",true);

    $("#nuevoPrecioList").val(nuevoSub4.toFixed(2));


    

		$("#editarPrecioVenta").val(editarSub3.toFixed(2));
		$("#editarPrecioVenta").prop("readonly",true);
    

	}

})

/*=============================================
CAMBIO DE PORCENTAJE
=============================================*/
/*
$(".nuevoPorcentaje").change(function(){

	if($(".porcentaje").prop("checked")){

    var valorPorcentaje = $(".nuevoPorcentaje").val(); //porcentaje ingresado en el formulario
    console.log("valorEDITARPorcentaje,", valorPorcentaje);

    var valorPrecioCompra = $("#nuevoPrecioCompra").val(); //precio de compra
    console.log("valorEDITARPrecioCompra,", valorPrecioCompra);

    var valorEditarPorcentaje = $("#editarRentabilidad").val(); 


    var valorEditarPrecioCompra = $("#editarPrecioCompra").val();
    
   
      var nuevoSub1 = Number(($("#nuevoCoeficiente").val()*valorPrecioCompra));
      //console.log("SUB1,", nuevoSub1);
      var nuevoSub2 = Number((nuevoSub1* Number($("#nuevoIva").val()))/100) + nuevoSub1;
     // console.log("SUB2,", nuevoSub2);
      var nuevoSub3 = Number((nuevoSub2)*valorPorcentaje/100)+nuevoSub2;
     // console.log("SUB3,", nuevoSub3);



      var editarSub1 = Number(($("#editarCoeficiente").val()*valorEditarPrecioCompra));
      //console.log("EDIT 1,", editarSub1);
      var editarSub2 = Number((editarSub1* Number($("#editarIva").val()))/100) + editarSub1;
      //console.log("EDIT 2,", editarSub2);
      var editarSub3 = Number((editarSub2)*valorEditarPorcentaje/100)+editarSub2;
     // console.log("EDIT 2,", editarSub3);
    

    $("#nuevoPrecioVenta").val(nuevoSub3.toFixed(2));
    $("#nuevoPrecioVenta").prop("readonly",true);

    

    $("#editarPrecioVenta").val(editarSub3.toFixed(2));
    $("#editarPrecioVenta").prop("readonly",true);
    

	}

})*/

$(".porcentaje").on("ifUnchecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",false);
	$("#editarPrecioVenta").prop("readonly",false);

})

$(".porcentaje").on("ifChecked",function(){

	$("#nuevoPrecioVenta").prop("readonly",true);
	$("#editarPrecioVenta").prop("readonly",true);

})

/*=============================================
SUBIENDO LA FOTO DEL PRODUCTO
=============================================*/

$(".nuevaImagen").change(function(){

	var imagen = this.files[0];
	
	/*=============================================
  	VALIDAMOS EL FORMATO DE LA IMAGEN SEA JPG O PNG
  	=============================================*/

  	if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen debe estar en formato JPG o PNG!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else if(imagen["size"] > 2000000){

  		$(".nuevaImagen").val("");

  		 swal({
		      title: "Error al subir la imagen",
		      text: "¡La imagen no debe pesar más de 2MB!",
		      type: "error",
		      confirmButtonText: "¡Cerrar!"
		    });

  	}else{

  		var datosImagen = new FileReader;
  		datosImagen.readAsDataURL(imagen);

  		$(datosImagen).on("load", function(event){

  			var rutaImagen = event.target.result;

  			$(".previsualizar").attr("src", rutaImagen);

  		})

  	}
})

/*=============================================================================
EDITAR PRODUCTO Y LLAMAR AJAX PARA LLENAR LOS CAMPOS CON LOS DATOS ACTUALES 
===============================================================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	
	var datos = new FormData();
    datos.append("idProducto", idProducto);

     $.ajax({

      url:"ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
          
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categorias.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                  
                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["categoria"]);

                  $("#editarProveedor").val(respuesta["id"]);
                  $("#editarProveedor").html(respuesta["razon_social"]);

                  $("#editarUbicacion").val(respuesta["id"]);
                  $("#editarUbicacion").html(respuesta["ubicaciones"]);

              }

          })

           $("#editarIva").val(respuesta["iva"]);

           $("#editarStockMin").val(respuesta["stock_min"]);

           $("#editarStockMax").val(respuesta["stock_max"]);

           $("#editarCoeficiente").val(respuesta["coeficiente"]);

           $("#editarNumeroLista").val(respuesta["nro_lista"]);

           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           $("#editarStock").val(respuesta["stock"]);

           $("#editarDolar").val(respuesta["usd"]);

           $(".nuevoPorcentaje").val(respuesta["rentabilidad"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

           	$("#imagenActual").val(respuesta["imagen"]);

           	$(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

	var idProducto = $(this).attr("idProducto");
	var codigo = $(this).attr("codigo");
	var imagen = $(this).attr("imagen");
	
	swal({

		title: '¿Está seguro de borrar el producto?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;

        }


	})

})
	
