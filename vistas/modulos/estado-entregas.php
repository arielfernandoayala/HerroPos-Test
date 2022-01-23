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
      
      Estado de entregas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crear-venta">       <!--Redireccion a la pagina para crear venta-->

          <button class="btn btn-primary">
            
            Agregar venta

          </button>

        </a>

         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
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
           
           <th style="width:10px">#</th>
           <th>Código venta</th>
           <th>Cliente</th>
           <th>Tel Cliente</th>
           <th>Vendedor</th>
           <th>Estado</th>
           <th>Detalle ubicacion</th>
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

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  echo '<td>'.$respuestaCliente["telefono"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>';

                  $itemEstadoEntrega = "id";
                  $valorEstadoEntrega = $value["estado_entrega"];
                  $estado_entrega = ControladorEstadosEntrega::ctrMostrarEstadosEntrega($itemEstadoEntrega, $valorEstadoEntrega);

                  echo '<td>'.$estado_entrega["estado_entrega"].'</td>';

                  echo '<td>'.$value["detalle_lugar_entrega"].'</td>

                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirRemito" title="Imprimir remito" idVentaAsociada="'.$value["id"].'">
                        <i class="fa fa-print"></i>
                      </button>
                      <button class="btn btn-success btnVerEnMapa" title="Abrir mapa" ubicacionEntrega="'.$value["lugar_entrega"].'" >
                        <i class="fa fa-map-marker"></i>
                      </button>
                      <button class="btn btn-primary btnActualizarEstado" title="Actualizar datos"  idVentaAsociada="'.$value["id"].'" data-toggle="modal" data-target="#modalActualizarEstadoEntrega" >
                        <i class="fa fa-refresh"></i>
                      </button>'


                      ;


                      if($_SESSION["perfil"] == "Administrador"){


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
MODAL ACTUALIZAR ESTADO ENTREGA
======================================-->

<div id="modalActualizarEstadoEntrega" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Actualizar el estado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 


                <select  class="form-control input-lg" name="inputActEstEntrega" id="inputActEstEntrega" required>
                        <option value="1">Retiró cliente</option>
                        <option value="2">Pendiente </option>
                        <!--AGREGAR LOS VALORES EN LA TABLA Y SETEAR EL ID CORRESPONDIENTE ANTES DE AÑADIR ITEMS-->                
                </select>

                 <input type="hidden"  name="idVtaAsoc" id="idVtaAsoc" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      <?php

          $estadoEntrega = new ControladorEstadosEntrega();
          $estadoEntrega -> ctrActualizarEstadoEntrega();

        ?> 

      </form>

    </div>

  </div>

</div>
