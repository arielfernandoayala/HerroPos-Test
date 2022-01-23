<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tabla de productos actualizada
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaActualizarProductos" width="100%">
         
        <thead>
         
         <tr>
           

           <th>Imagen</th>
           <th>Código</th>
           <th>Descripción</th>
           <th>Proveedor</th>
           <th>Categoría</th>
           <th>Stock</th>
           <th>Precio de venta</th>
           <th>Ult Mod</th>

           
         </tr> 

        </thead>      

       </table>

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilActualizarProd">

      </div>

    </div>

  </section>

</div>
