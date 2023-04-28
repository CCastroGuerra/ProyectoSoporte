<?php
include('../templates/cabecera.php');
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
            <div class="input-group">
              <input type="text" aria-label="First name" class="form-control" readonly>
              <input type="text" style="width: 80%;" aria-label="Last name" class="form-control" placeholder="Nombre Área" id="nombreEditarArea" name="nombreEditarArea">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>

      </div>
      </form>
    </div>
  </div>
</div>
<!-- /*Fin del modal */ -->
<div class="col-md-4 col-lg-5 ">
  <form id="frmArea">
   <div class="card">
        <div class="card-header">
              <h3 class="card-title">Productos</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese cantidad">
                <label for="exampleInputEmail1" class="mb-2">Cantidad:</label>
                <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese cantidad">
                <label for="exampleInputEmail1" class="mb-2">Almacen:</label>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Seleccionar</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>

                <div id="alerta"></div>
              </div>
            </div>
            <div class="card-footer text-muted">
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
   </div>
  </form>

<div class="col-md-8 col-lg-7 ">
  <div class="row ">
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title mb-4">Lista Productos</h3>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar producto" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
          </div>

        </div>
      </div>
    </div>
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col"><strong>#</strong></th>
                <th scope="col"><strong>Nombre</strong></th>
                <th scope="col"><strong>Cantidad</strong></th>
                <th scope="col"><strong>Almacen</strong></th>
              </tr>
            </thead>
            <tbody id="tbProductos">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../js/productosAjax.js"></script>
<?php
include '../templates/footer.php';
?>
