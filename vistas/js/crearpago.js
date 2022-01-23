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

$('.tablaChqsCrearPago').DataTable( {
    "ajax": "ajax/datatable-crearpago.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando cheques...",
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

$(".tablaChqsCrearPago tbody").on("click", "button.btnAgregarChequeCrearPago", function(){

	console.log("Ejecuta crearpagojs en botn agregar chq ");
	var id_chq = $(this).attr("id_chq");
	console.log("id_chq capturado es ", id_chq);


	//Desactivo la clase para que no le puedo volver a dar click y luego lo dejo en color gris para no poder darle click de nuevo
	$(this).removeClass("btn-primary btnAgregarChequeCrearPago");
	$(this).addClass("btn-default");

	var datos = new FormData();
    datos.append("id_chq", id_chq);

     $.ajax({

     	url:"ajax/chequera.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      		//console.log("Respuesta de id de producto seleccionado en ventas.js",respuesta);
      		//Almaceno variables:

      		console.log("Resputa crearpago js, ",respuesta);

      	    var banco = respuesta["banco_chq"];
          	var fechaVenc = respuesta["fecha_ven_chq"];

          	var importe = respuesta["importe"];


          	$(".itemsCrearPago").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Banco -->'+
	          
	          '<div class="col-xs-4" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarChqCrarPago" id_chq="'+id_chq+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nvoBancoChqCrearPago" id_chq="'+id_chq+'" name="agregarCheque" value="'+banco+'"  required readonly>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Fecha de vencimiento -->'+

	          '<div class="col-xs-4">'+
	            
	             '<input type="date"  class="form-control nvaFechaVenCrearPago" name="nvaFechaVenCrearPago"  value="'+fechaVenc+'" readonly >'+

	          '</div>' +

	          '<!-- Importe del chque -->'+

	          '<div class="col-xs-4 ingresoImporte" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nvoImporteChqCrearPago" impChq="'+importe+'" name="nvoImporteChqCrearPago" value="'+importe+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>') 

	        // SUMAR TOTAL DE IMPORTES

	        sumaImporteCheques()

	        // AGRUPAR CHEQUES EN FORMATO JSON
	        listarChequesCrearPago()

	        // PONER FORMATO 

	        $(".nvoImporteChqCrearPago").number(true, 2);


			localStorage.removeItem("quitarChqCrarPago");

      	}

     })

});

/*===================================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
====================================================*/
//jquery data tables nos recomienda usar draw.dt cada vez que queremos hacer alguna tarea cuando estemos navegando en la tabla
//Entronces ejecutamos una funcion que  

$(".tablaChqsCrearPago").on("draw.dt", function(){
	//console.log("Se debe ejecutar cada vez que tocamos algo en la tabla");
	//Verificamos si existe el item quitarChqCrarPago
	if(localStorage.getItem("quitarChqCrarPago") != null){
		//Convertimos la cadena de string en datos json 
		var listaIdCheques = JSON.parse(localStorage.getItem("quitarChqCrarPago"));
		//Recorremos el json como array para saber la longitud
		for(var i = 0; i < listaIdCheques.length; i++){
			//Asignamos las clases a cada una de las id que vienen guardadas
			$("button.recuperarBtnChq[id_chq='"+listaIdCheques[i]["id_chq"]+"']").removeClass('btn-default');
			$("button.recuperarBtnChq[id_chq='"+listaIdCheques[i]["id_chq"]+"']").addClass('btn-primary agregarProducto');

		}


	}


})


/*=================================================================
QUITAR CHEQUES Y RECUPERAR BOTÓN USANDO LOCALSTORAGE
====================================================================*/

//Creamos arreglo vacio para guardar los id de productos para que luego pueda trabajar la clase del botton agregar 
var idChequesCrearPago = [];

//Eliminamos de localStorage este item cada vez que actualizamos la pagina:
localStorage.removeItem("quitarChqCrarPago");

$(".formularioPago").on("click", "button.quitarChqCrarPago", function(){
	//Borramos boton, banco, fecha ven e importe, por eso usamos 4 parent().remove(); es decir borramos
	//toda la linea. parent() va borrando de etiqueta interna a externa
	$(this).parent().parent().parent().parent().remove();

	//Capturamos la id del producto a eliminar
	var id_chq = $(this).attr("id_chq");

	/*======================================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL CHEQUE A QUITAR
	======================================================*/

	//Verifico 
	if(localStorage.getItem("quitarChqCrarPago") == null){

		idChequesCrearPago = [];
	
	}else{
		//Cocatenamos en el arreglo lo que vienen en localstorage
		idChequesCrearPago.concat(localStorage.getItem("quitarChqCrarPago"))

	}
 
	//Le adicionamos la propiedad id_chq al arreglo 
	idChequesCrearPago.push({"id_chq":id_chq});
	//Almacenamos en el localstorage en quitarChqCrarPago el json dado por idChequesCrearPago
	localStorage.setItem("quitarChqCrarPago", JSON.stringify(idChequesCrearPago));

	//Activamos y desactivamos nuievamente el boton para agregar/quitar productos
	$("button.recuperarBtnChq[id_chq='"+id_chq+"']").removeClass('btn-default');
	$("button.recuperarBtnChq[id_chq='"+id_chq+"']").addClass('btn-primary agregarCheque');



    // SUMAR TOTAL DE IMPORTES

    sumaImporteCheques()

    // AGRUPAR CHEQUES EN FORMATO JSON
    listarChequesCrearPago()

    // PONER FORMATO 

    $(".nvoImporteChqCrearPago").number(true, 2);


	localStorage.removeItem("quitarChqCrarPago");

})


/*=============================================
AGREGANDO CHEQUES DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numChques = 0;

$(".btnAgregarItemsCrearPago").click(function(){

	numChques ++;

	var datos = new FormData();
	//Traemos todos los productos y los ponemos dentro de un select 
	datos.append("traerCheques", "ok");

	$.ajax({

		url:"ajax/chequera.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){
      			//console.log("Resputa ventas.js lind 285:",respuesta);
      	    
		$(".itemsCrearPago").append(

          	'<div class="row" style="padding:5px 15px">'+

			  '<!-- Banco -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarChqCrarPago" id_chq=""><i class="fa fa-times"></i></button></span>'+

	              '<select class="form-control nvoBancoChqCrearPago" id="cheque'+numChques+'" id_chq name="agregarCheque" value=""  required readonly>'+

	              	'<option>Seleccione el cheque</option>'+

	              '</select>'+  

	            '</div>'+

	          '</div>'+

	          '<!-- Fecha de vencimiento -->'+

	          '<div class="col-xs-3 ingresoFechaVenc">'+
	            
	             '<input type="date"  class="form-control nvaFechaVenCrearPago" name="nvaFechaVenCrearPago"   readonly required>'+

	          '</div>' +

	          '<!-- Importe del chque -->'+

	          '<div class="col-xs-3 ingresoImporte" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nvoImporteChqCrearPago" impChq="" name="nvoImporteChqCrearPago"  readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>'); 

			console.log(respuesta);


	        // AGREGAR LOS PRODUCTOS AL SELECT 

	         respuesta.forEach(funcionForEach);

	         function funcionForEach(item, index){


	         	$("#cheque"+numChques).append(

					'<option id_chq="'+item.id+'" value="'+item.nro_chq+'">'+item.banco_chq+'--$'+item.importe+'</option>'
	         	)	         

		         
	         }

	        // SUMAR TOTAL DE IMPORTES

	        sumaImporteCheques()

	        // AGRUPAR CHEQUES EN FORMATO JSON
	        listarChequesCrearPago()

	        // PONER FORMATO 

	        $(".nvoImporteChqCrearPago").number(true, 2);


      	},error: function(respuesta){

        console.log("Error en js  chequera.js, ",respuesta);
    	}

	})

})

/*=============================================
SELECCIONAR CHEQUE DESDE DISPOSTIVOS
=============================================*/

$(".formularioPago").on("change", "select.nvoBancoChqCrearPago", function(){

	var nroCheque = $(this).val();

	//console.log("El nro del chq del input es: ",nroCheque);

	var nvoBancoChqCrearPago = $(this).parent().parent().parent().children().children().children(".nvoBancoChqCrearPago");

	var nvaFechaVenCrearPago = $(this).parent().parent().parent().children(".ingresoFechaVenc").children(".nvaFechaVenCrearPago");

	var nvoImporteChqCrearPago = $(this).parent().parent().parent().children(".ingresoImporte").children().children(".nvoImporteChqCrearPago");

	console.log("nvoBancoChqCrearPago, nvaFechaVenCrearPago ,nvoImporteChqCrearPago ", nvoBancoChqCrearPago, nvaFechaVenCrearPago ,nvoImporteChqCrearPago);

	var datos = new FormData();
    datos.append("nroCheque", nroCheque);


	  $.ajax({

     	url:"ajax/chequera.ajax.php",
      	method: "POST",
      	data: datos,
      	cache: false,
      	contentType: false,
      	processData: false,
      	dataType:"json",
      	success:function(respuesta){

      		console.log("Respuesta al cambio del select",respuesta);

      	    $(nvoBancoChqCrearPago).attr("id_chq", respuesta["id"]);
      	    $(nvaFechaVenCrearPago).val(respuesta["fecha_ven_chq"]);
      	    $(nvoImporteChqCrearPago).val(respuesta["importe"]);


  	      // AGRUPAR PRODUCTOS EN FORMATO JSON

	        listarChequesCrearPago()

      	},error: function(respuesta){

        console.log("Error en js  chequera.js, ",respuesta);
    	}

      })
})



/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumaImporteCheques(){


	var importeItemCrearPago = $(".nvoImporteChqCrearPago");
	console.log("listaItemsCrearPago",listaItemsCrearPago)
	
	var arraySumarCheques = [];  

	for(var i = 0; i < importeItemCrearPago.length; i++){

		 arraySumarCheques.push(Number($(importeItemCrearPago[i]).val()));
		
		 
	}

	function sumaArrayChqs(total, numero){

		return total + numero;

	}

	var sumaTotalCheqes = arraySumarCheques.reduce(sumaArrayChqs);

	//console.log("sumaTotalPrecioPresupuestoRapido",sumaTotalPrecioPresupuestoRapido);

	//console.log("suma total de precio lin 536 presupuestoRapidoJS ",sumaTotalPrecioPresupuestoRapido );
	
	$("#nvoTotalCrearPago").val(sumaTotalCheqes);
	$("#totalPago").val(sumaTotalCheqes);
	$("#nvoTotalCrearPago").attr("totalCrearPago",sumaTotalCheqes);


}



/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#totalCrearPago").number(true, 2);

/*



/*=============================================
LISTAR TODOS LOS CHEQUES
=============================================*/

function listarChequesCrearPago(){

	var listaChequesSeleccionados = [];

	var bancoChequeSeleccionado = $(".nvoBancoChqCrearPago");

	var fechaVencChequeSeleccionado = $(".nvaFechaVenCrearPago");

	var importeChequeSeleccionado = $(".nvoImporteChqCrearPago");

	var totalSumaChqsSeleccionados = $("#totalPago").val();

	for(var i = 0; i < bancoChequeSeleccionado.length; i++){

		listaChequesSeleccionados.push({ "id" : $(bancoChequeSeleccionado[i]).attr("id_chq"), 
							  "chq_banco" : $(bancoChequeSeleccionado[i]).val(),
							  "chq_fechaVenc" : $(fechaVencChequeSeleccionado[i]).val(),
							  "chq_importe" : $(importeChequeSeleccionado[i]).val()})
	};


	$("#listaItemsCrearPago").val(JSON.stringify(listaChequesSeleccionados)); 

	//console.log("listaItemsCrearPago",listaItemsCrearPago);

}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarChequesCrearPago(){

	//Capturamos todos los id de productos que fueron elegidos en la venta
	var id_chqs = $(".quitarChqCrarPago");

	//Capturamos todos los botones de agregar que aparecen en la tabla
	var botonesTabla = $(".tablaVentas tbody button.agregarCheque");

	//Recorremos en un ciclo para obtener los diferentes id_chqs que fueron agregados a la venta
	for(var i = 0; i < id_chqs.length; i++){

		//Capturamos los Id de los productos agregados a la venta
		var boton = $(id_chqs[i]).attr("id_chq");
		
		//Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
		for(var j = 0; j < botonesTabla.length; j ++){

			if($(botonesTabla[j]).attr("id_chq") == boton){

				$(botonesTabla[j]).removeClass("btn-primary agregarCheque");
				$(botonesTabla[j]).addClass("btn-default");

			}
		}

	}
	
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$('.tablaVentas').on( 'draw.dt', function(){

	quitarChequesCrearPago();

})


/*=============================================
IMPRIMIR FACTURA
=============================================*/

/*

$(".tablas").on("click", ".btnImprimirPresupuestoRapido", function(){

	var codigoPresupuestoRapido = $(this).attr("codigoPresupuestoRapido");

	window.open("extensiones/tcpdf/examples/presupuesto-rapido.php?codigo="+codigoPresupuestoRapido, "_blank");

})

*/









