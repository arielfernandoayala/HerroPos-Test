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
      
      Generar recibo por pago
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Recibo por cobranza</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>DNI/CUIT</th>
           <th>Email</th>
           <th>Teléfono</th>
           <th>Dirección</th>
           <th>Fecha nacimiento</th> 
           <th>Total compras</th>
           <th>Última compra</th>
           <th>Saldo</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($clientes as $key => $value) {
            
            $ultCompra = date("d-m-Y", strtotime($value["ultima_compra"]));
            $fechaNac = date("d-m-Y", strtotime($value["fecha_nacimiento"]));

            echo '<tr>

                    <td>'.$value["id"].'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["documento"].'</td>

                    <td>'.$value["email"].'</td>

                    <td>'.$value["telefono"].'</td>

                    <td>'.$value["direccion"].'</td>

                    <td>'.$fechaNac.'</td>             

                    <td>'.$value["compras"].'</td>

                    <td>'.$ultCompra.'</td>

                    <td style="color:#DE0B05">$ '.$value["clientes_saldo"].'</td>

                    <td>

                      <div class="btn-group">';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-success btnCrearCobranzaClientev1" title="Generar recibo" data-toggle="modal" data-target="#modalAgregarCobro" docCobranzav1="'.$value["documento"].'" idCobranzav1="'.$value["id"].'"><i class="fa fa-dollar"></i></button>';
                          echo '<button class="btn btn-info btnVerRecibosv1" title="Ver recibos"data-toggle="modal" id="btnVerRecibos" data-target="#modalVerRecibos" docRecibov1="'.$value["documento"].'"><i class="fa fa-navicon "></i></button>';
                          echo '<button class="btn btn-warning btnImpCtaCte" title="Descargar cuenta corriente" id="btnCtaCte"  idClienteCC="'.$value["id"].'"><i class="fa fa-download"></i></button>';
                          

                      }

                      echo '</div>  

                    </td>

                  </tr>';
          
            }

        ?>
   
        </tbody>

       </table>

      </div>

    </div>

  </section>



</div>

<!--=====================================
MODAL AGREGAR RECIBO POR COBRO
======================================-->

<div id="modalAgregarCobro" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Recibo de pago</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



            <!-- ENTRADA PARA EL ID CLIENTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i> -Id Cliente:</span> 
                
                <input type="text"  class="form-control input-lg" name="docCobranzav1" id="docCobranzav1" readonly>

                <input type="hidden"  class="form-control input-lg" name="idCobranzav1" id="idCobranzav1" readonly>

              </div>

            </div>

            <!-- SELECT PARA LA VENTA ASOCIADO AL PAGO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i> -Venta asociada:</span> 
                
                  <select class="form-control" id="vtaRecibov1" name="vtaRecibov1" >



                  </select>

              </div>

            </div>

            <!-- ENTRADA PARA ALGUN COMENTARIO -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i> -Comentarios:</span> 
                
                <input type="text"  class="form-control input-lg" name="comentarioRecibov1" id="comentarioRecibov1" >

              </div>

            </div>

             <!-- ENTRADA PARA EL IMPORTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                <input type="number" step="0.01" class="form-control input-lg" name="nuevoImporteRecibov1" id="nuevoImporteRecibov1" placeholder="Ingresar importe" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SALDO RESTANTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-dollar"></i></span> 

                <input type="number" style="color: red" step="0.01" class="form-control input-lg" name="inpSaldoRestante" id="inpSaldoRestante" placeholder="Ingresar saldo restante" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL MEDIO DE PAGO -->
                  <div class="col-xs-12 ">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Forma de pago</th>  
                          <th>Fecha de recibo</th>
   
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                                    
                            <div class="form-group row">
                              
                              <div style="width: 100%" style="padding-right:0px">
                                
                                 <div class="input-group">
                              
                                  <select class="form-control" id="nuevoMetodoPagoRecibov1" name="nuevoMetodoPagoRecibov1" required>
                                    <option value="-">Seleccione método de pago</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="TC">Tarjeta Crédito</option>
                                    <option value="TD">Tarjeta Débito</option>
                                    <option value="TB1">Transferencia Bco Galicia CC</option>
                                    <option value="TB2">Transferencia Bco Galicia CA</option>
                                    <option value="MP1">Mercado Pago - Clau</option>
                                    <option value="TP1">Todo Pago - Clau</option>
                                    <option value="CH">Cheque</option>
                                    <option value="CA">Crédito Argentino</option>
                                    <option value="CD">Crédito Directo</option> 
                                    <option value="TN">Tarjeta Naranja</option>                  
                                  </select>    

                                </div>

                              </div>

                              <div class="cajasMetodoPagoRecibov1"></div>

                              <input type="hidden" id="listaMetodoPagoRecibov1" name="listaMetodoPagoRecibov1">

                            </div>

                              

                            <input type="hidden" id="listaCanalVentaRecibov1" name="listaCanalVentaRecibov1">     

                          </td>

                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="date" name="fechaRecibov1" id="fechaRecibov1" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>
  
          </div>

        </div>

        <!--==========================================
        PIE DEL MODAL || INCLUYE LA FECHA DEL RECIBO
        ============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar e imprimir</button>

        </div>

      </form>

      <?php

        $crearReciboClientev1 = new ControladorCobroClientes();
        $crearReciboClientev1 -> ctrCrearRecibov1();

      ?>
    

    </div>

  </div>

</div>

