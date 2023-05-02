<?php
include('../templates/cabecera.php');
?>


<!-- Modal -->
<div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="marcaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Marcas</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="frmMarca">
        <div class="modal-body">

          <div class="visually-hidden">
            <label for="exampleInputEmail1" class="mb-2">Código:</label>
            <input type="text" class="form-control mb-2" id="codigoMarca" name="codigoMarca" readonly>
          </div>

          <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
          <input type="text" class="form-control mb-2" id="nombreMarca" name="nombreMarca" placeholder="Ingrese Marca">
          <label for="exampleInputPassword1" class="mb-2">Categoría:</label>
          <select class="form-select form-select-sm" id="" name="" aria-label="Default select example">
            <option selected>Selecciona la categoría</option>
            <option value="1">Monitores</option>
            <option value="2">Componentes</option>
            <option value="3">Suministros e impresoras</option>
            <option value="4">Equipos</option>
          </select>
          <div id="alerta"></div>
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



<!--contenido-->
<div class="col-md-12 col-lg-12 ">
  <div class="row ">
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title mb-4">Lista Marca <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#marcaModal"><strong>Añadir</strong></button></h3>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar Marca" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
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
                <th scope="col"><strong>Categoría</strong></th>
                <th scope="col"><strong>Opciones</strong></th>
              </tr>
            </thead>
            <tbody id="tbMarca">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/contenido-->
<script src="../js/marcaAjax.js"></script>
<?php
include '../templates/footer.php';
?>