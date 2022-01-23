$(".tablas").on("click", ".btnImpCtaCte", function(){

	var idClienteCC = $(this).attr("idClienteCC");
	//console.log("El atributo es", idClienteCC);

	window.open("extensiones/tcpdf/examples/pdfcccliente.php?idClienteCC="+idClienteCC, "_blank");

})