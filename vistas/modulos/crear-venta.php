<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <!--Imprimo el nombre de la varaible de sesion con la que estoy iniciando en el sistema para guardar el id en base de datos en el imput oculto en la siguiente linea-->
                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;
                    //Solicitamos una respuesta para consultar la cantidad de ventas realizadas (id de venta)
                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){
                      //Si $ventas viene en falso es porque no hayh ninguna venta entonces arranco desde el 10001:
                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                  

                    }else{ //Caso contrario, llamo ta todas la ventas

                      foreach ($ventas as $key => $value) {

                        //echo "<script type='text/javascript'>
                           //      console.log('".$value["id"]."');
                            //  </script>";

                        
                        //Recorre todos los id de venta, esto no es muy EFICIENTE
                        
                      
                      } 
                      //Guardo en codigo el valor del código de la última venta realizada para poder incrementar el valor desde allí
                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA INPUT DE CLIENTE
                ======================================--> 

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-child"></i></span> 
                    <!--Imprimo el nombre de la varaible de sesion con la que estoy iniciando en el sistema para guardar el id en base de datos en el imput oculto en la siguiente linea-->
                    <input type="number" class="form-control" id="seleccionarClienteVenta" name="seleccionarClienteVenta" placeholder="CUIT/CUIL/DNI" required>

                    <input type="hidden" class="form-control" id="seleccionarCliente" name="seleccionarCliente" required >

                   <span class="input-group-btn">
                    
                    <button type="button" class="btn btn-info btn-flat"  id="buscarClienteVenta" name="buscarClienteVenta">BUSCAR</button>
                  
                   </span>

                  </div>

                </div> 

                <!--=====================================
                NOMBRE VISIBLE DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                    <!--No dejo el sig campo como readonly porque me guarda el id pero no el nombre/razon social y me rompe en la cuenta corriente porque no impacta correctamente-->
                    
                    <input class="form-control" name="nombreClienteVenta" id="nombreClienteVenta" placeholder="Tocar en BUSCAR o AGREGAR CLIENTE"  required>

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
        
                  
                  </div>
                
                </div>

                <!--div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>


                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                    <?php

                      $item = null;
                      $valor = null;

                      $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($clientes as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div-->

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-12 ">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Canal de venta</th>  
                          <th>Modificación</th>
                          <th>Total</th>     
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 30%">
                                    
                               <div class="input-group">
                            
                                <select class="form-control" id="nuevoCanalVenta" name="nuevoCanalVenta" required>
                                  <option value="0">--</option>
                                  <option value="1">Local</option>
                                  <option value="2">Web</option>
                                  <option value="3">Mercado Libre</option>                  
                                </select>    

                              </div>

                              <!--div class="cajasMetodoPago"></div-->

                              <input type="hidden" id="listaCanalVenta" name="listaCanalVenta">     

                          </td>

                          <td style="width: 35%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 35%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-4" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="-">Método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>
                        <option value="CC">Cuenta Corriente</option>                    
                      </select>    

                    </div>

                  </div>

                  <div class="col-xs-6">

                    <input type="hidden" id="coords" name="coords" style="width: 500px;" placeholder="Latitud y longitud" readonly />

                    <input type="text" id="detalleLugEntrega" name="detalleLugEntrega" placeholder="Detallar en lugar de entrega" style="width: 100%;" />
                    
                  </div>

                  <div class="col-xs-2">

                    <button type="button" class="btn btn-info btn-flat"  id="abrirMapa" name="abrirMapa" data-toggle="modal" data-target="#modalMapa" data-dismiss="modal" >MAPA</button>
                      
                    <!--span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span-->
                  </div>  


                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>P. Lista</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>


<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Apellido y Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" >

              </div>

            </div>

            <!-- ENTRADA PARA LA CALLE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCalle" placeholder="Ingresar calle" >

              </div>

            </div>

            <!-- ENTRADA PARA EL NUMERO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoNumAltura" placeholder="Ingresar altura" >

              </div>

            </div>

            <!-- ENTRADA PARA EL PISO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoPiso" placeholder="N° piso de edificio" >

              </div>

            </div>

            <!-- ENTRADA PARA EL DPTO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-right"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDpto" placeholder="Depertamento" >

              </div>

            </div>

            <!-- ENTRADA PARA EL CP -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-pin"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoCP" placeholder="Codigo Postal" >

              </div>

            </div>

            <!-- ENTRADA PARA LA LOCALIDAD -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-angle-right"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoLocalidad" placeholder="Localidad" >

              </div>

            </div>

            <!-- ENTRADA PARA LA PROVINCIA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-angle-double-right"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoProvincia" placeholder="Provincia " >

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN 
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div-->

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-birthday-cake"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="día/mes/año"  >

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL ABRIR MAPA
======================================-->

<div id="modalMapa" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Selecciones ubicacion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="content-wrapper">



          <section class="content">

            <div id="map" style="width: 100%; height: 600px;"></div>
            
          </section>

          <script type="text/javascript">
             
              var marker;          //variable del marcador
              var coords = {};    //coordenadas obtenidas con la geolocalización
               
              //Funcion principal
              initMap = function () 
              {


               
                  //usamos la API para geolocalizar el usuario
                      navigator.geolocation.getCurrentPosition(
                        function (position){
                          coords =  {
                            lng: position.coords.longitude,
                            lat: position.coords.latitude
                          };
                          setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa         
                         
                        },function(error){console.log(error);});
                  
              }
               
               
               
              function setMapa (coords)
              {   
                    //Se crea una nueva instancia del objeto mapa
                    var div = document.getElementById("map");
                    var map = new google.maps.Map(div,
                    {
                      zoom: 13,
                      center:new google.maps.LatLng(coords.lat,coords.lng),
               
                    });
               
                    //Creamos el marcador en el mapa con sus propiedades
                    //para nuestro obetivo tenemos que poner el atributo draggable en true
                    //position pondremos las mismas coordenas que obtuvimos en la geolocalización
                    marker = new google.maps.Marker({
                      map: map,
                      draggable: true,
                      animation: google.maps.Animation.DROP,
                      position: new google.maps.LatLng(coords.lat,coords.lng),
               
                    });

                    
                    //agregamos un evento al marcador junto con la funcion callback al igual que el evento dragend que indica 
                    //cuando el usuario a soltado el marcador
                    marker.addListener('click', toggleBounce);
                    
                    marker.addListener( 'dragend', function (event)
                    {

                      //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
                      document.getElementById("coords").value = this.getPosition().lat()+","+ this.getPosition().lng();
                    });

              }
               
              //callback al hacer clic en el marcador lo que hace es quitar y poner la animacion BOUNCE
              function toggleBounce() {
                if (marker.getAnimation() !== null) {
                  marker.setAnimation(null);
                } else {
                  marker.setAnimation(google.maps.Animation.BOUNCE);
                }
              }

              window.onload=initMap;

          </script>

        </div>

  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

    </div>

  </div>

</div>


