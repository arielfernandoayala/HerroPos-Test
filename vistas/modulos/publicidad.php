<?php

if($_SESSION["perfil"] == "Especial" || $_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Resumen de publicidades activas y finalizadas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Publicidades</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPublicidad">
          
          Agregar publicidad

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           
           <th>Fecha de incio</th>
           <th>Fecha de fin</th>
           <th>Medio utilzado</th>
           <th>Resumen de camapaña</th>
           <th>Costo $</th>
           <th>Resultados</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $publicidad = ControladorPublicidades::ctrMostrarPublicidades($item, $valor);

       foreach ($publicidad as $key => $value){
         
          echo ' <tr>
                  
                  <td>'.$value["fecha_inicio"].'</td>
                  <td>'.$value["fecha_fin"].'</td>';
                  echo '<td>'.$value["medio"].'</td>
                        <td>'.$value["resumen"].'</td>
                        <td>'.$value["costo"].'</td>';

                  echo '<td>'.$value["resultados"].'</td>
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarPublicidad" idPublicidad="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPublicidad"><i class="fa fa-pencil"></i></button>

                    </div>  

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
MODAL AGREGAR publicidad
======================================-->

<div id="modalAgregarPublicidad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post"> <!--enctype="multipart/form-data"-->

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar publicidad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA FEHCA INICIO-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Fecha inicio: </span> 

                <input type="date" class="form-control input-lg" name="nuevoPublicidadFechaInicio" id="nuevoPublicidadFechaInicio"  required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FEHCA DE FIN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Fecha fin</span> 

                <input type="date" class="form-control input-lg" name="nuevoFechaFin"   >

              </div>

            </div>

            <!-- ENTRADA PARA EL MEDIO |compeltar el select|-->

            <div class="form-group">
              
              <div class="input-group">
                
                 <span class="input-group-addon">Medio</span> 
              
                  <select class="form-control" id="nuevoMedioPublicidad" name="nuevoMedioPublicidad" required>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Google">Google</option>
                    <option value="Local">Local</option>
                    <option value="Radio">Radio</option>
                    <option value="TV">Tlevisón</option>
                    <option value="Pantalla">Pantallas publicitarias</option>
                    <option value="Youtube">Youtube</option>

               
                  </select>    

                </div>

              </div>

              <div class="cajaMedioPublicidad"></div>

              <input type="hidden" id="listaMedioPublicidad" name="listaMedioPublicidad">


            <!-- ENTRADA PARA EL RESUMEN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Resumen</span> 

                <input type="textarea" class="form-control input-lg" name="nuevoResumen"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL COSTO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Costo:</span> 

                <input type="number" class="form-control input-lg" name="nuevoCostoPublicidad"  required>

              </div>

            </div>

            <!-- ENTRADA PARA TIPO DE publicidad -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Resultados:</span> 

                <input type="textarea" class="form-control input-lg" name="nuevoResultadosPublicidad"  >

              </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO >

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFotoBanco" name="nuevaFotobanco">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div -->

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar publicidad</button>

        </div>

        <?php

          $crearpublicidad = new ControladorPublicidades();
          $crearpublicidad -> ctrCrearPublicidad();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR publicidad
======================================-->

<div id="modalEditarPublicidad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post"> 

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar publicidad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA FEHCA INICIO-->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Fecha inicio: </span> 

                <input type="date" class="form-control input-lg" name="editarFechaInicio" id="editarFechaInicio" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA FEHCA DE FIN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Fecha fin</span> 

                <input type="date" class="form-control input-lg" name="editarFechaFin" id="editarFechaFin"  >

              </div>

            </div>

            <!-- ENTRADA PARA EL MEDIO |compeltar el select|-->

            <div class="form-group">
              
              <div class="input-group">
                
                 <span class="input-group-addon">Medio</span> 
              
                  <select class="form-control" id="editarMedioPublicidad" name="editarMedioPublicidad" required>
                    <option value="Facebook">Facebook</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Google">Google</option>
                    <option value="Local">Local</option>
                    <option value="Radio">Radio</option>
                    <option value="TV">Tlevisón</option>
                    <option value="Pantalla">Pantallas publicitarias</option>
                    <option value="Youtube">Youtube</option>

               
                  </select>    

                </div>

              </div>

              <div class="cajaMedioPublicidad"></div>

              <input type="hidden" id="idEditarPublicidad" name="idEditarPublicidad">

            <!-- ENTRADA PARA EL RESUMEN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Resumen</span> 

                <input type="textarea" class="form-control input-lg" name="editarResumen" id="editarResumen"  required>

              </div>

            </div>

            <!-- ENTRADA PARA EL COSTO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Costo:</span> 

                <input type="number" class="form-control input-lg" name="editarCostoPublicidad" id="editarCostoPublicidad" required>

              </div>

            </div>

            <!-- ENTRADA PARA TIPO DE publicidad -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon">Resultados:</span> 

                <input type="textarea" class="form-control input-lg" name="editarResultadosPublicidad" id="editarResultadosPublicidad" >

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar publicidad</button>

        </div>

        <?php

          $editarPublicidad = new ControladorPublicidades();
          $editarPublicidad -> ctrEditarPublicidad();

        ?>

      </form>

    </div>

  </div>

</div>
