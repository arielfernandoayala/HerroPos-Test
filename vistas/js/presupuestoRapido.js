/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/
/*
$.ajax({

 	url: "ajax/datatable-presupuestoRapido.ajax.php",
 	success:function(respuesta){
		
 		console.log("respuesta en presupuesto Rpaido", respuesta);

	}

 }); 
 */

$('.tablaPresupuestoRapido').DataTable( {
    "ajax": "ajax/datatable-presupuestoRapido.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
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

/*=============================================================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA UNA VEZ QUE LA TABLA ESTE CARGADA
================================================================================*/

$(".tablaPresupuestoRapido tbody").on("click", "button.productoAgregarPresupuestoRapido", function(){

	console.log("ejecuta al hacer click en PRESUPUESTO RAPIDO");

	//Capturamos el id del productos que deseamosagregar
	var idProducto = $(this).attr("idProducto");
	//console.log("idProducto",idProducto);

	//Desactivo la clase para que no le puedo volver a dar click y luego lo dejo en color gris para no poder darle click de nuevo
	$(this).removeClass("btn-primary productoAgregarPresupuestoRapido");
	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("idProducto", idProducto);

    //busca todos los productos con id idProductos, en este caso es uno solo
     $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		//console.log("Respuesta de id de producto seleccionado en ventas.js",respuesta);
      		//Almaceno variables:
      	    var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
          	var precio = respuesta["precio_lista"];

          	/*================================================
          	EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
          	=====================================================*/

          	if(stock == 0){

      			swal({
			      title: "No hay stock disponible",
			      type: "error",
			      confirmButtonText: "¡Cerrar!"
			    });

			    $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");

			    //return; Si descomento esta linea no va a permitir agregar el producto sin stock 

          	}//Ahora agregamos los productos a la venta:

          	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarPorductoPresupuestoRapido" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProductoPresupuestoRapido" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'"  required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" step="0.01" class="form-control nuevaCantidadProductoPresupuestoRapido" name="nuevaCantidadProductoPresupuestoRapido" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nvoPrecioProductoPresupuestoRapido" precioReal="'+precio+'" name="nvoPrecioProductoPresupuestoRapido" value="'+precio+'"  required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE PRECIOS

	        sumarTotalPreciosPresup1()

	        // AGREGAR IMPUESTO

	        agregarModPresup1()

	        // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductosPresupuestoRapido()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nvoPrecioProductoPresupuestoRapido").number(true, 2);


			localStorage.removeItem("quitarPorductoPresupuestoRapido");

      	}

     })

});

/*===================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
====================================================*/
//jquery data tables nos recomienda usar draw.dt cada vez que queremos hacer alguna tarea cuando estemos navegando en la tabla
//Entronces ejecutamos una funcion que  

$(".tablaPresupuestoRapido").on("draw.dt", function(){
	//console.log("Se debe ejecutar cada vez que tocamos algo en la tabla");
	//Verificamos si existe el item quitarPorductoPresupuestoRapidos
	if(localStorage.getItem("quitarPorductoPresupuestoRapido") != null){
		//Convertimos la cadena de string en datos json 
		var listaIdProductos = JSON.parse(localStorage.getItem("quitarPorductoPresupuestoRapido"));
		//Recorremos el json como array para saber la longitud
		for(var i = 0; i < listaIdProductos.length; i++){
			//Asignamos las clases a cada una de las id que vienen guardadas
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
			$("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})


/*=================================================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN USANDO LOCALSTORAGE
====================================================================*/

//Creamos arreglo vacio para guardar los id de productos para que luego pueda trabajar la clase del botton agregar 
var idquitarPorductoPresupuestoRapido = [];

//Eliminamos de localStorage este item cada vez que actualizamos la pagina:
localStorage.removeItem("quitarPorductoPresupuestoRapido");

$(".formularioVentaPresup1").on("click", "button.quitarPorductoPresupuestoRapido", function(){
	//Borramos boton, descrip´cion, cantidad y precio, por eso usamos 4 parent().remove(); es decir borramos
	//toda la linea. parent() va borrando de etiqueta interna a externa
	$(this).parent().parent().parent().parent().remove();

	//Capturamos la id del producto a eliminar
	var idProducto = $(this).attr("idProducto");

	/*======================================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	======================================================*/

	//Verifico 
	if(localStorage.getItem("quitarPorductoPresupuestoRapido") == null){

		idquitarPorductoPresupuestoRapido = [];
	
	}else{
		//Cocatenamos en el arreglo lo que vienen en localstorage
		idquitarPorductoPresupuestoRapido.concat(localStorage.getItem("quitarPorductoPresupuestoRapido"))

	}
 
	//Le adicionamos la propuedad idPoducto al arreglo 
	idquitarPorductoPresupuestoRapido.push({"idProducto":idProducto});
	//Almacenamos en el localstorage en quitarPorductoPresupuestoRapidos el json dado por odquitarPorductoPresupuestoRapido
	localStorage.setItem("quitarPorductoPresupuestoRapido", JSON.stringify(idquitarPorductoPresupuestoRapido));

	//Activamos y desactivamos nuievamente el boton para agregar/quitar productos
	$("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
	$("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');

	if($(".nuevoProducto").children().length == 0){

		$("#nuevoImpuestoVenta").val(0);
		$("#nuevoTotalPresup1").val(0);
		$("#totalPresup1").val(0);
		$("#nuevoTotalPresup1").attr("totalPresupRapido",0);

	}else{

		// SUMAR TOTAL DE PRECIOS

    	sumarTotalPreciosPresup1()

    	// AGREGAR IMPUESTO
	        
        agregarModPresup1()

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductosPresupuestoRapido()

	}

})

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProductoPresupRapido").click(function(){

	numProducto ++;

	var datos = new FormData();
	//Traemos todos los productos y los ponemos dentro de un select 
	datos.append("traerProductos", "ok");

	$.ajax({

		url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      			//console.log("Resputa ventas.js lind 285:",respuesta);
      	    
      	    	$(".nuevoProducto").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarPorductoPresupuestoRapido" idProducto><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nuevaDescripcionProductoPresupuestoRapido" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProductoPresupuestoRapido" required>'+

	              '<option>Seleccione el producto</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3 ingresoCantidad">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProductoPresupuestoRapido" name="nuevaCantidadProductoPresupuestoRapido"  value="0" stock nuevoStock required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nvoPrecioProductoPresupuestoRapido" precioReal="" name="nvoPrecioProductoPresupuestoRapido" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>');


	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){


	         	$("#producto"+numProducto).append(

					'<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
	         	)	         

		         
	         }

        	 // SUMAR TOTAL DE PRECIOS

    		sumarTotalPreciosPresup1()

    		// AGREGAR IMPUESTO
	        
	        agregarModPresup1()

	        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

	        $(".nvoPrecioProductoPresupuestoRapido").number(true, 2);


      	}

	})

})

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioVentaPresup1").on("change", "select.nuevaDescripcionProductoPresupuestoRapido", function(){

	var nombreProducto = $(this).val();

	var nuevaDescripcionProductoPresupuestoRapido = $(this).parent().parent().parent().children().children().children(".nuevaDescripcionProductoPresupuestoRapido");

	var nvoPrecioProductoPresupuestoRapido = $(this).parent().parent().parent().children(".ingresoPrecio").children().children(".nvoPrecioProductoPresupuestoRapido");

	var nuevaCantidadProductoPresupuestoRapido = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevaCantidadProductoPresupuestoRapido");

	var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);


	  $.ajax({

     	url:"ajax/productos.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      	    
      	    $(nuevaDescripcionProductoPresupuestoRapido).attr("idProducto", respuesta["id"]);
      	    $(nuevaCantidadProductoPresupuestoRapido).attr("stock", respuesta["stock"]);
      	    $(nuevaCantidadProductoPresupuestoRapido).attr("nuevoStock", Number(respuesta["stock"])-1);
      	    $(nvoPrecioProductoPresupuestoRapido).val(respuesta["precio_venta"]);
      	    $(nvoPrecioProductoPresupuestoRapido).attr("precioReal", respuesta["precio_venta"]);

  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarProductosPresupuestoRapido()

      	}

      })
})

/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioVentaPresup1").on("change", "input.nuevaCantidadProductoPresupuestoRapido", function(){

	var precio = $(this).parent().parent().children(".ingresoPrecio").children().children(".nvoPrecioProductoPresupuestoRapido");

	var precioFinal = $(this).val() * precio.attr("precioReal");

	//console.log(precioFinal);
	//console.log(precio.attr("precioReal"));
	
	precio.val(precioFinal);

	var nuevoStock = Number($(this).attr("stock")) - $(this).val();

	$(this).attr("nuevoStock", nuevoStock);

	if(Number($(this).val()) > Number($(this).attr("stock"))){

		/*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

		//$(this).val(0);

		$(this).attr("nuevoStock", $(this).attr("stock"));

		var precioFinal = $(this).val() * precio.attr("precioReal");

		precio.val(precioFinal);

		sumarTotalPreciosPresup1();

		swal({
	      title: "La cantidad supera el Stock",
	      text: "¡Sólo hay "+$(this).attr("stock")+" unidades!",
	      type: "error",
	      confirmButtonText: "¡Cerrar!"
	    });

	    //return; SI DESCOMENTO EL RETURN NO VOY A PERMITIR AGREGAR PRODUCTOS AL PRESUPUESTO + LINEA 442

	}

	// SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosPresup1()

	// AGREGAR IMPUESTO
	        
    agregarModPresup1()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosPresupuestoRapido()

})



/*=============================================
MODIFICAR EL PRECIO DEL PRODUCTO DE FORMA MANUAL
=============================================*/

$(".formularioVentaPresup1").on("change", "input.nvoPrecioProductoPresupuestoRapido", function(){



	var precio = $(this).val();

	var precioFinal = $(this).val();


	// SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosPresup1()

	// AGREGAR MODIFICACION
	        
    agregarModPresup1()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosPresupuestoRapido()

})

/*=============================================
AGREGAR MODIFIACION A PRECIO FIANL
=============================================*/

$(".formularioVentaPresup1").on("change", "input.nuevoPrecioModPresup1", function(){

	console.log("se dispara el change de nuevoPrecioModPresup1");

	var precio = $(this).val();

	var precioFinal = $(this).val();




	// AGREGAR MODIFICACION
	        
    agregarModPresup1()

    // SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosPresup1()

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosPresupuestoRapido()

})



/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosPresup1(){


	var precioItemPresup1 = $(".nvoPrecioProductoPresupuestoRapido");
	//console.log("listaItemsCrearPago",precioItemPresup1.length);
	
	var arraySumaPrecioPresusp1 = [];  

	for(var i = 0; i < precioItemPresup1.length; i++){

		 arraySumaPrecioPresusp1.push(Number($(precioItemPresup1[i]).val()));
		
		 
	}

	function sumaArrayPrecios(total, numero){

		return total + numero;

	}

	var sumaTotalPrecioPresupuestoRapido = arraySumaPrecioPresusp1.reduce(sumaArrayPrecios);

	console.log("sumaTotalPrecioPresupuestoRapido",sumaTotalPrecioPresupuestoRapido);

	//console.log("suma total de precio lin 536 presupuestoRapidoJS ",sumaTotalPrecioPresupuestoRapido );
	
	$("#nuevoTotalPresup1").val(sumaTotalPrecioPresupuestoRapido);
	$("#totalPresup1").val(sumaTotalPrecioPresupuestoRapido);
	$("#nuevoTotalPresup1").attr("totalPresupRapido",sumaTotalPrecioPresupuestoRapido);


}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarModPresup1(){

	var impuesto = $("#nuevaModPresup1").val();
	var precioTotal = $("#nuevoTotalPresup1").attr("totalPresupRapido");

	//console.log("se dispara agregarModPresup1");

	//Number() me castea lo que est a adentro (en este caso string) a numero
	var precioConModificacion = Number(precioTotal * impuesto/100);

	var totalPrecioConModifiacion = Number(precioConModificacion) + Number(precioTotal);

	//console.log(impuesto);
	
	$("#nuevoTotalPresup1").val(totalPrecioConModifiacion);

	$("#totalPresup1").val(totalPrecioConModifiacion);

	$("#nuevoPrecioModPresup1").val(precioConModificacion);

	$("#nuevoPrecioNetoPresup1").val(precioTotal);

}

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevaModPresup1").change(function(){
	console.log("cambia el impuesto");
	agregarModPresup1();

});


/*
$(".formularioVentaPresup1").on("change", "input#nuevaModPresup1", function(){

	console.log("dispara la nueva funcion");
	// SUMAR TOTAL DE PRECIOS

	sumarTotalPreciosPresup1()

	// AGREGAR IMPUESTO
		
	agregarModPresup1()

	// AGRUPAR PRODUCTOS EN FORMATO JSON

	listarProductosPresupuestoRapido()


})*/

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalPresup1").number(true, 2);

/*



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosPresupuestoRapido(){

	var listaProductosPresupuestoRapido = [];

	var descripcionPresupuestoRapido = $(".nuevaDescripcionProductoPresupuestoRapido");

	var cantidadPresupuestoRapido = $(".nuevaCantidadProductoPresupuestoRapido");

	var precioPresupuestoRapido = $(".nvoPrecioProductoPresupuestoRapido");

	var totalSumaPresupuesto = $("#totalPresup1").val();

	for(var i = 0; i < descripcionPresupuestoRapido.length; i++){

		listaProductosPresupuestoRapido.push({ "id" : $(descripcionPresupuestoRapido[i]).attr("idProducto"), 
							  "descripcion" : $(descripcionPresupuestoRapido[i]).val(),
							  "cantidad" : $(cantidadPresupuestoRapido[i]).val(),
							  "stock" : $(cantidadPresupuestoRapido[i]).attr("nuevoStock"),
							  "precio" : $(precioPresupuestoRapido[i]).attr("precioReal"),
							  "precio_contado" : $(precioPresupuestoRapido[i]).attr("precioReal") - ($(precioPresupuestoRapido[i]).attr("precioReal")*15)/100,
							  "total" : $(precioPresupuestoRapido[i]).val()})

	};


	$("#listaProductosPresupuestoRapido").val(JSON.stringify(listaProductosPresupuestoRapido)); 

	console.log("listaProductosPresupuestoRapido",listaProductosPresupuestoRapido);

}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProductoPresupuestoRapido(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var idProductos = $(".quitarPorductoPresupuestoRapido");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

	//Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
	for(var i = 0; i < idProductos.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(idProductos[i]).attr("idProducto");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("idProducto") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarProducto");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarAgregarProductoPresupuestoRapido();

})


/*=============================================
BORRAR PRESUPUESTO
=============================================*/
$(".tablas").on("click", ".btnEliminarVenta", function(){

  var idVenta = $(this).attr("idVenta");

  swal({
        title: '¿Está seguro de borrar la venta?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar venta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idVenta="+idVenta;
        }

  })

})

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirPresupuestoRapido", function(){

	var codigoPresupuestoRapido = $(this).attr("codigoPresupuestoRapido");

	window.open("extensiones/tcpdf/examples/presupuesto-rapido.php?codigo="+codigoPresupuestoRapido, "_blank");

})

/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn2').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn2 span").html();
   
   	localStorage.setItem("capturarRango", capturarRango);

   	window.location = "index.php?ruta=presupuestoRapido&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

	localStorage.removeItem("capturarRango");
	localStorage.clear();
	window.location = "presupuestoRapido";
})


/*=============================================
GUARDAR ORIGEN DE PRESUPUESTO
=============================================*/

$("#nuevoCanalPresup").change(function(){


     $("#listaCanalPresup").val($("#nuevoCanalPresup").val());


})
/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

		var d = new Date();
		
		var dia = d.getDate();
		var mes = d.getMonth()+1;
		var año = d.getFullYear();

		if(mes < 10){

			var fechaInicial = año+"-0"+mes+"-"+dia;
			var fechaFinal = año+"-0"+mes+"-"+dia;

		}else if(dia < 10){

			var fechaInicial = año+"-"+mes+"-0"+dia;
			var fechaFinal = año+"-"+mes+"-0"+dia;

		}else if(mes < 10 && dia < 10){

			var fechaInicial = año+"-0"+mes+"-0"+dia;
			var fechaFinal = año+"-0"+mes+"-0"+dia;

		}else{

			var fechaInicial = año+"-"+mes+"-"+dia;
	    	var fechaFinal = año+"-"+mes+"-"+dia;

		}	

    	localStorage.setItem("capturarRango", "Hoy");

    	window.location = "index.php?ruta=presupuestoRapido&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

	}

})




$("#buscarClientePresupRap").on("click", function(){


  var seleccionarClientePresupuestoRapido = $("#seleccionarClientePresupuestoRapido").val();

  //console.log("Entra a presupuestoRapido.js y el valor caputrado es  ", seleccionarClientePresupuestoRapido);

  var datos = new FormData();

  datos.append("seleccionarClientePresupuestoRapido" ,seleccionarClientePresupuestoRapido);

  console.log("datos contiene  ", datos);

  $.ajax({
    url: "ajax/buscarCliente-presupRapido.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){
        //actProd1Ubicacion
        if(respuesta["nombre"] !=  null ){
        	$('#nombreClientePresup').val(respuesta["nombre"]);
        }
        else{
        	$('#nombreClientePresup').val("Cliente no encontrado");
        }
        
       // console.log("Ejecuto el succes: ",respuesta["nombre"]);


    },
    error: function(respuesta){
    	
       // console.log("Error en presupuestoRapido.js, ",respuesta);

    }

  })
    //console.log("sale a actprdo1.js")


})



