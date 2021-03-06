<?php

if($_SESSION["perfil"] == "Bodega"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

  <div class="content-wrapper">
    
    <section class="content-header">
      
      <h1>
        <i class="fa fa-share-square-o"></i> Nueva venta
        
      </h1>
      
      <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
        

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

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

 <!--=====================================
                ENTRADA DEL CÓDIGO
     ======================================--> 

            <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarVentas($item, $valor);

                    if(!$ventas){

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="1" readonly>';
                  

                    }else{

                      foreach ($ventas as $key => $value) {
                        
                        
                      
                      }

                      $codigo = $value["codigo"] + 1;



                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }

                    ?>
                    
</div>
</div>


 <!--=====================================
                ENTRADA DEL VENDEDOR
  ======================================-->

<div class="form-group">
    
  <div class="input-group">
      
      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

      <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

       <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

 </div>

</div>


 
  <!--=====================================
                ENTRADA DEL CLIENTE
  ======================================--> 

<div class="form-group">
    
    <div class="input-group">
      
      <span class="input-group-addon"><i class="fa fa-user-plus"></i></span> 
 

  <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

      <option value="">Seleccionar cliente</option>

    <?php

    $item = null;
    $valor = null;

    $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

    foreach ($categorias as $key => $value) {

    echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

      }

  ?>
      
</select>


      <span class="input-group-addon"><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>

    </div>
  </div>


  <!--=====================================
      ENTRADA PARA AGREGAR PRODUCTO
  ======================================--> 


 <div class="form-group row nuevoProducto">
   
</div>

 <input type="hidden" id="listaProductos" name="listaProductos">

  <!--=====================================
       BOTÓN PARA AGREGAR PRODUCTO
  ======================================-->

 <!-- se utiliza para dispositivos moviles-->

<button type="button" class="btn btn-success btn-xs hidden-lg btnAgregarProducto">Agregar producto</button>

<hr>


<div class="row">

    <!--=====================================
        ENTRADA IMPUESTOS Y TOTAL
    ======================================-->
  
<div class="col-xs-8 pull-right">
  
<table class="table">
  
<thead>
  
<tr>
  
<th>Impuesto</th>
<th>Total</th>

</tr>

</thead>

<tbody>
  
<tr>
  
  <!-- impuesto -->
  <td style="width: 50%">
    

<div class="input-group">
  

<input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" 
placeholder="00" required>


  <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

  <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" required>

<span class="input-group-addon"><i>%</i></span>

</div>


  </td>

<!-- total -->
  <td style="width: 50%">
    

<div class="input-group">
  
<span class="input-group-addon"><i>Q</i></span>

<input type="text" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" total="" 
placeholder="00000" readonly required>

  <input type="hidden" name="totalVenta" id="totalVenta">

      </div>

    </td>

  </tr>

</tbody>


</table>

</div>


</div>

<hr>

   <!--=====================================
                ENTRADA MÉTODO DE PAGO
  ======================================-->

 <div class="form-group row">
  
<div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione tipo de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                   <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

<div class="box-footer">
  
<button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Guardar venta</button>

    </div>
   
   </form>

        <?php

          $guardarVenta = new ControladorVentas();
          $guardarVenta -> ctrCrearVenta();
          
        ?>

 
  </div>

</div>    


  <!--=====================================
      LA TABLA DE PRODUCTOS
  ======================================-->

 <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
   
<div class="box box-success">

  <div class="box-header with-border"></div>
    
    <div class="box-body">
      
   <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">
     
<thead>
         
          <tr>
           
           <th style="width:15px">#</th>
           <th>Imagen</th>
          <th>Descripción</th>
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
Modal agregar cliente
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        Cabeza modal
        ======================================-->

        <div class="modal-header" style="background:#2d862d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        Cuerpo modal
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- entrada para el Nombre -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-pencil-square-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Nombre" required>

              </div>

            </div>

            <!-- Entrada para el Telefono -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-whatsapp"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Telefono" data-inputmask="'mask':'(999) 9999-9999'" data-mask required>

              </div>

            </div>

            <!-- Entrada para la Direccion -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Direccion" required>

              </div>

            </div>

      
          </div>

        </div>

        <!--=====================================
        Pie nodal
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-success">Guardar cliente</button>

        </div>

      </form>

       <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>