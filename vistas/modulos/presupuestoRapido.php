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
      
      Administrador de presupuestos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrador de presupuestos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-presupuestoRapido">       <!--Redireccion a la pagina para crear presupuesto-->

          <button class="btn btn-primary">
            
            Generar presupuesto rápido

          </button>

        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn2">
           
            <span>
              <i class="fa fa-calendar"></i> Rango de fecha
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:1px">#</th>
           <th>Código</th>
           <th>Cliente</th>
           <th>Vendedor</th>
           <th>Precio en lista</th>
           <th>Mod</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorPresupuestosRapidos::ctrRangoFechasPresupuestoRapido($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>#'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>$ '.number_format($value["neto"],2).'</td>

                  <td>'.number_format($value["presup_porcentaje"],2).'%</td>

                  <td>$ '.number_format($value["total"],2).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirPresupuestoRapido" codigoPresupuestoRapido="'.$value["codigo"].'">

                        <i class="fa fa-print"></i>

                      </button>

                    </div>  

                  </td>

                </tr>';
            }

        ?>
               
        </tbody>

       </table>

       <?php

      $eliminarPresupuestoRapido = new ControladorPresupuestosRapidos();
      $eliminarPresupuestoRapido -> ctrEliminarPresupuestoRapido();

      ?>
       

      </div>

    </div>

  </section>

</div>




<!--
 ;

                      if($_SESSION["perfil"] == "Administrador"){

                      echo '<button class="btn btn-danger btnEliminarPresupuestoRpaido" idPresupuestoRapido="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                    }

                    echo '

-->