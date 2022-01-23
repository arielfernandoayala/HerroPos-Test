/*=============================================
EDITAR ACTPROD1 (EL QUE ESTA DISEÑADO PARA TOAMAR Y ACTUALIOZR STOCK DESDE EL CEL)
=============================================*/
$("#codActProd1").on("click", function(){


  var inputActProd1 = $("#inputActProd1").val();

  //console.log("Entra a actprdo1.js y el valor caputrado es  ", inputActProd1);

  var datos = new FormData();

  datos.append("inputActProd1" ,inputActProd1);

  //console.log("datos contiene  ", datos);

  $.ajax({
    url: "ajax/act.prod1.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){

        //console.log("respuesta:",respuesta);
        //actProd1Ubicacion
        $("#actProd1Stock").val(respuesta["stock"]);
        $("#actProd1Descripcion").val(respuesta["descripcion"]);
        $("#actProd1Ubicacion").val(respuesta["id_ubicacion"]);

        var idUbicaciones = respuesta["id_ubicacion"];

        var datos2 = new FormData();

        datos2.append("idUbicaciones" ,idUbicaciones);

        $.ajax({
        url: "ajax/ubicaciones.ajax.php",
        method: "POST",
        data: datos2,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success: function(respuesta2){

          console.log(respuesta2);

          $('#descUbicacion').val(respuesta2["ubicaciones"]);

          }
        })




        $("#idActProd1").val(inputActProd1); //guardo el valor buscado en el input hidden para guardar el id del producto y dsp saber que item modificar en el update
        $("#actPContado").val(respuesta["precio_venta"]);
        $("#actPLista").val(respuesta["precio_lista"]);
        var ctas3 = (respuesta["precio_lista"]/3);
        var ctas6 = (respuesta["precio_lista"]/6);
        var ctas12 = (respuesta["precio_lista"]/12);
        var ctas12 = (respuesta["precio_lista"]/18);

        $("#act3Ctas").val(ctas3.toFixed(2));
        $("#act6Ctas").val(ctas6.toFixed(2));
        $("#act12Ctas").val(ctas12.toFixed(2));


    },
    error: function(respuesta){

        console.log("Error en js  actprod1, ",respuesta);

    }

  })
    //console.log("sale a actprdo1.js")


})

/*=============================================
EDITAR UBICACION
=============================================*/
$("#actProd1Ubicacion").on("change", function(){

  $('#descUbicacion').empty();

  //console.log("Ejecuta js actprdo1 lin 52");


  var actProd1Ubicacion = $("#actProd1Ubicacion").val();



  var datos = new FormData();

  datos.append("actProd1Ubicacion" ,actProd1Ubicacion);

  //console.log("datos contiene  ", datos);

  $.ajax({
    url: "ajax/act.prod1.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){

      //console.log(respuesta);

       if(respuesta!=false){

        $('#descUbicacion').val(respuesta["ubicaciones"]);

       }else{

        $('#descUbicacion').val("No hay ubicación para ese ID");

       }

       //{0: "1", 1: "Entrepiso", 2: "2019-11-28 09:40:28", id: "1", ubicaciones: "Entrepiso", fecha: "2019-11-28 09:40:28"}
      
    },
    error: function(respuesta){

        console.log("Error en js  actprod1, ",respuesta);

    }

  })
    //console.log("sale a actprdo1.js")


})