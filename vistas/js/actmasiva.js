/*=============================================
JS ACTUALIZAR PRODUCTOS DE FORMA MASIVA
=============================================*/
$("#btnActMasiva").on("click", function(){

  console.log("actmasiva clic");

  var idProovActMasiva = $("#actMasivaProveedor").val();
  var idCatActMasiva = $("#actMasivaCategoria").val();
  var idSubCatActMasiva = $("#actMasivaSubC").val();
  var nroListaActMasiva = $("#actMasivaLista").val();
  var coefActMasiva = $("#actMasivaCoef").val();
  var ivaActMasiva = $("#actMasivaIva").val();
  var retActMasiva = $("#actMasivaRent").val();
  var incPLActMasiva = $("#actMasivaPLista").val();





  console.log("JS ACTMASIVA ", idProovActMasiva, idCatActMasiva, idSubCatActMasiva, nroListaActMasiva, coefActMasiva, ivaActMasiva, retActMasiva, incPLActMasiva);

   alert("asd")

  //var datos = new FormData();

  //datos.append("inputActProd1" ,inputActProd1);

  //console.log("datos contiene  ", datos);

  /*

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

    },
    error: function(respuesta){

        console.log("Error en js  actprod1, ",respuesta);

    }

  })
  //**/
})

/*

$("#btnActLista").on("click", function(){



  $.ajax({
    url: "ajax/actmasiva.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success: function(respuesta){

        alert("Precio de lista actualizado"); 

     },
     error: function(respuesta){
         console.log("repuesta por error: ", respuesta);
         //console.log(respuesta["razon_social"]); 
      }

  })
})*/