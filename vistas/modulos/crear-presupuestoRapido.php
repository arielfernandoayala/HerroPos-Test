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
      
      Crear presupuesto rápido
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Presupuesto rápido</li>
    
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

          <form role="form" method="post" class="formularioVentaPresup1">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                    <!--Imprimo el nombre de la varaible de sesion con la que estoy iniciando en el sistema para guardar el id en base de datos en el imput oculto en la siguiente linea-->
                    <input type="text" class="form-control" id="nuevoVendedorPresup1" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedorPresup1" value="<?php echo $_SESSION["id"]; ?>">

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
                    //Solicitamos una respuesta para consultar la cantidad de presupuestosRapidos realizadas (id de venta)
                    $presupuestosRapidos = ControladorPresupuestosRapidos::ctrMostrarPresupuestosRapidos($item, $valor);

                    if(!$presupuestosRapidos){
                      //Si $presupuestosRapidos viene en falso es porque no hayh ninguna venta entonces arranco desde el 10001:
                      echo '<input type="text" class="form-control" id="nuevoFastPresup" name="nuevoFastPresup" value="10001" readonly>';
                  

                    }else{ //Caso contrario, llamo ta todas la presupuestosRapidos

                      foreach ($presupuestosRapidos as $key => $value) {
                        //Recorre todos los id de venta, esto no es muy EFICIENTE
                        
                      
                      } 
                      //Guardo en codigo el valor del código de la última venta realizada para poder incrementar el valor desde allí
                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevoFastPresup" name="nuevoFastPresup" value="'.$codigo.'" readonly>';
                  

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
                    <input type="text" class="form-control" id="seleccionarClientePresupuestoRapido" name="seleccionarClientePresupuestoRapido" >

                   <span class="input-group-btn">
                    
                    <button type="button" class="btn btn-info btn-flat"  id="buscarClientePresupRap" name="buscarClientePresupRap">BUSCAR</button>
                  
                   </span>

                  </div>

                </div> 

                <!--=====================================
                NOMBRE VISIBLE DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
                    
                    <input class="form-control" name="nombreClientePresup" id="nombreClientePresup" readonly="">

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>


                    
                    
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">

                

                </div>

                <input type="hidden" id="listaProductosPresupuestoRapido" name="listaProductosPresupuestoRapido">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProductoPresupRapido">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-12">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Origen de presup.</th>  
                          <th>Modificación</th>
                          <th>Total</th>     
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>

                            <td style="width: 30%">
                                    
                               <div class="input-group">
                            
                                <select class="form-control" id="nuevoCanalPresup" name="nuevoCanalPresup" required>
                                  <option value="0">--</option>
                                  <option value="1">Local</option>
                                  <option value="2">Web</option>
                                  <option value="3">Mercado Libre</option>
                                  <option value="4">Email</option> 
                                  <option value="5">Teléfono</option>
                                  <option value="6">WhatsApp</option>                       
                                </select>    

                              </div>

                              <input type="hidden" id="listaCanalPresup" name="listaCanalPresup" required>     

                          </td>
                          
                          <td style="width: 35%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg"  id="nuevaModPresup1" name="nuevaModPresup1" placeholder="0" step=".01" required>

                               <input type="hidden" name="nuevoPrecioModPresup1" id="nuevoPrecioModPresup1" required>

                               <input type="hidden" name="nuevoPrecioNetoPresup1" id="nuevoPrecioNetoPresup1" required>

                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 35%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalPresup1" name="nuevoTotalPresup1" totalPresupRapido="" placeholder="00000" readonly required>

                              <input type="hidden" name="totalPresup1" id="totalPresup1">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar presupuesto</button>

          </div>

        </form>

        <?php

          $guardarPresup1 = new ControladorPresupuestosRapidos();
          $guardarPresup1 -> ctrCrearPresupuestoRapido();
          
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
            
            <table class="table table-bordered table-striped dt-responsive tablaPresupuestoRapido">
              
               <thead>

                 <tr>
                  <th>Código</th>
                  <th>Imagen</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
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