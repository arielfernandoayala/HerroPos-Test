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
      
      Gnerar PDF para imprirmir
    
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
           
         
           <th>Fecha</th>
           <th>Condición</th>
           <th>Doc Cliente</th>
           <th>Identificador</th>
           <th>Entidad</th>
           <th>Importe</th>
           <th>Banco</th>
           <th>Chq nro</th>
           <th>Cuit emisor</th>
           <th>Fecha venc</th>
           <th>Imprimir</th>

         </tr> 

        </thead>

        <tbody>

        <?php

            $item = null;
            $valor = null;
          

          $recibosDeCliente = ControladorImpRecibos::ctrMostrarRecibos($item, $valor);

          foreach ($recibosDeCliente as $key => $value) {
            

            echo '<tr>

                    

                    <td>'.$value["fecha"].'</td>

                    <td>'.$value["medio_de_pago"].'</td>

                    <td>'.$value["doc_cliente"].'</td>

                    <td>'.$value["identificacion_pago"].'</td>

                    <td>'.$value["entidad"].'</td>

                    <td>$ '.$value["importe"].'</td>

                    <td>'.$value["banco"].'</td>             

                    <td>'.$value["nro_chq"].'</td>

                    <td>'.$value["cuit_emisor"].'</td>

                    <td>'.$value["fecha_chq"].'</td>

                    <td>

                      <div class="btn-group">';

                      if($_SESSION["perfil"] == "Administrador"){

                       echo '<button class="btn btn-info btnImpReciboPdf" title="Generar PDF" imprRecivoId="'.$value["id"].'"><i class="fa fa-print "></i></button>';
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
