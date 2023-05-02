<?php
include('../templates/cabecera.php');
?>


<!-- Modal Servicio -->
<div class="modal fade" id="servicioModal" tabindex="-1" aria-labelledby="servicioModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Servicio</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formServicio">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <div class="visually-hidden">
                  <label class="control-label">Código</label>
                  <input type="text" class="form-control" id="inputCodigo" placeholder="Código">
                </div>
                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombreServicio" name="nombreServicio" placeholder="Ingrese Servicio">
                <div id="alerta"></div>
              </div>
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
<!-- /*Fin del modal servicio*/ -->

<!--Contenido-->
<div class="col-md-12 col-lg-12 ">
  <div class="row ">
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title mb-4">
            <div class="row">
              <div class="col-lg-10 col-sm-6">Lista Servicios </div>
              <div class="col-lg-2 col-sm-4 text-end">
                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#servicioModal"><strong>Añadir</strong></button>
              </div>
            </div>
          </h3>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar Servicio" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarServicio" id="txtBuscarServicio">
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
                <th scope="col"><strong>Opciones</strong></th>
              </tr>
            </thead>
            <tbody id="tbServicio">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!--/Contenido-->

<script src="../js/areaAjax.js"></script>
<?php
include '../templates/footer.php';
?>