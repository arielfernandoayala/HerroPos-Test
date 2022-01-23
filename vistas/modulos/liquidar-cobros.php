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
      
      Liquidador de cobros por ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Liquidador</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>

           <th>ID Rec.</th>
           <th>Codigo Vta</th>
           <th>Nombre Cliente</th>
           <th>Med de pago</th>
           <th>Identificación de pago</th>
           <th>Entidad</th>
           <th>Cuotas</th>
           <th>Importe incial</th>
           <th>Total venta</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $cobroPendiente = ControladorCobrosPendientes::ctrMostrarCobrosPendientes();

          //var_dump($cobroPendiente);

          foreach ($cobroPendiente as $key => $value) {
           
            echo ' <tr>

                    <td>'.$value["id"].'</td>

                    <td>'.$value["codigo"].'</td>

                    <td class="text-uppercase">'.$value["nombre"].'</td>

                    <td>'.$value["medio_de_pago"].'</td>

                    <td>'.$value["identificacion_pago"].'</td>

                    <td>'.$value["entidad"].'</td>

                    <td>'.$value["cant_cuotas"].'</td>

                    <td>'.$value["importe"].'</td>

                    <td>'.$value["total"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnLiquidarRec" title="Registrar cobro" idRecALiquidar="'.$value["id"].'" data-toggle="modal" data-target="#modalRegistraCobro"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){/*

                          echo '<button class="btn btn-danger btnEliminarCategoria" idRecALiquidar="'.$value["id"].'"><i class="fa fa-times"></i></button>';*/

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
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalRegistraCobro" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Registrar cobro</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL IMPORTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">IMPORTE: </span> 

                <input type="number" class="form-control input-lg" name="nuevoLiqRec" id="nuevoLiqRec" step="0.01"  placeholder="Ingresar total percibido" required>

                <input type="hidden" name="idRecALiquidar" id="idRecALiquidar" required >

              </div>

            </div>

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">FECHA: </span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaPagoRec" id="nuevoFechaPagoRec"  required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar </button>

        </div>

        <?php 

          $liquidarRecibo = new ControladorCobrosPendientes();
          $liquidarRecibo -> ctrRegistrarCobro();
          

        ?>

      </form>

    </div>

  </div>

</div>




