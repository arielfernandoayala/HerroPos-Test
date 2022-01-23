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
      
      Cuenta Corriente de Cliente
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">CC Cliente</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <!--a href="crear-venta">       

          <button class="btn btn-primary">
            
            Agregar venta

          </button>

        </a-->

         <!--button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button-->

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Fecha</th>
           <th>Doc Cliente</th>
           <th>Razon Soc</th>
           <th>Detalle</th>
           <th>Debe/Compras</th>
           <th>Haber/Pagos</th>
           <th>Saldo</th>

         </tr> 

        </thead>

        <tbody>


        <?php

          $item = null;
          $valor = null;

          $movs = ControladorCCCliente::ctrMostrarCCCliente($item, $valor);

          foreach ($movs as $key => $value) {
           
            echo ' <tr>

                    <td class="text-uppercase">'.$value["ccc_fecha_mov"].'</td>

                    <td class="text-uppercase">#'.$value["ccc_doc_cliente"].'</td>

                    <td class="text-uppercase">'.$value["ccc_razonsoc"].'</td>

                    <td class="text-uppercase">'.$value["ccc_detalle"].'</td>

                    <td class="text-uppercase">'.$value["ccc_debe"].'</td>

                    <td class="text-uppercase">'.$value["ccc_haber"].'</td>

                    <td class="text-uppercase">'.$value["ccc_saldo"].'</td>

                  </tr>';
          }

        ?>

          

        
        </tbody>

       </table>


       

      </div>

    </div>

  </section>

</div>




