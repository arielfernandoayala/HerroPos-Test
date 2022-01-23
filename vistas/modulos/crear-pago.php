
<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear pago
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Pagos</li>
    
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

          <form role="form" method="post" class="formularioPago">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                ENTRADA DEL CÓDIGO DE LA COMPRA
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    

                    <?php
                    /*
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
                  

                    }*/

                    ?>
                    
                    
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA INPUT DE PROVEEDOR
                ======================================--> 

                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-child"></i></span> 
                    <!--Imprimo el nombre de la varaible de sesion con la que estoy iniciando en el sistema para guardar el id en base de datos en el imput oculto en la siguiente linea-->
                    <input type="text" class="form-control" id="seleecionarProveedorPago" name="seleecionarProveedorPago" >

                   <span class="input-group-btn">
                    
                    <button type="button" class="btn btn-info btn-flat"  id="buscarProvedorPago" name="buscarProvedorPago">BUSCAR</button>
                  
                   </span>

                  </div>

                </div>

                <!--=====================================
                RAZON SOCIAL VISIBLE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon">Proveedor</span>
                    
                    <input class="form-control" name="razonSocPagoProv" id="razonSocPagoProv" readonly>
                  
                  </div>
                
                </div> 

                <!--=====================================
                DATOS DEL COBRADOR
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon">Cobrador</span>
                    
                    <input class="form-control" name="nombreCobrador" id="nombreCobrador" readonly="">

                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCobrador" data-dismiss="modal">Agregar cobrador</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR ITEMS
                ======================================--> 

                <div class="form-group row itemsCrearPago">

                

                </div>

                <input type="hidden" id="listaItemsCrearPago" name="listaItemsCrearPago">

                <!--=====================================
                BOTÓN PARA AGREGAR ITEMS EN DISPOSITIVOS MOBILES
                ======================================-->

                <button type="button" disabled="true" class="btn btn-default hidden-lg btnAgregarItemsCrearPago">Agregar items</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-12">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Origen de transf</th>  
                          <th>Importe transf.</th>
                          <th>Efectivo</th>     
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>

                            <td style="width: 30%">
                                    
                               <div class="input-group">
                            
                                <select class="form-control" id="origTransfPago" name="origTransfPago" required>
                                  <option value="1GC">Galicia</option>
                                  <option value="2STFC">Sta-Fe Clau</option>
                                  <option value="3STJ">Sta-Fe Jose</option>
                                  <option value="4MPC">MercadoPago Clau</option>
                                  <option value="5MPA">MercadoPago Ariel</option>                  
                                </select>    

                              </div>

                              <input type="hidden" id="listarOrigPago" name="listarOrigPago">     

                          </td>
                          
                          <td style="width: 35%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control input-lg"  id="transferidoCrearPago" name="transferidoCrearPago" placeholder="$$$" >
                        
                            </div>

                          </td>

                           <td style="width: 35%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="number" class="form-control input-lg" id="efectivoCrearPago" name="efectivoCrearPago"  placeholder="$$$"  >
                              
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                <!--=====================================
                ENTRADA PARA PAR ALOS CHQUES
                ======================================--> 



                    <div class="row">

                  
                 		 <div class="col-xs-12">

		                 	<div class="input-group" style="padding-left: 20px">
		                   
		                      <span class="input-group-addon"><H5>TOTAL:</H5></span>

		                      <input type="text" class="form-control input-lg" style="width: 85%"  id="nvoTotalCrearPago" name="nvoTotalCrearPago" totalCrearPago="" placeholder="00000"  required>

		                      <input type="hidden" name="totalPago" id="totalPago">       
		                
		                    </div>

		                 </div>

		            </div>

                </div>

                <hr>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar pago</button>

          </div>

        </form>

        <?php

          //$guardarPago = new ControladorPresupuestosRapidos();
         // $guardarPago -> ctrCrearPresupuestoRapido();
          
        ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE CEHQUES
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaChqsCrearPago">
              
               <thead>

                 <tr>
                  <th>Fecha Vec.</th>
                  <th>Banco</th>
                  <th>Importe</th>
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
