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
                  <input type="text" class="form-control" id="inputCodigo" placeholder="Ingrese el Código">
                </div>
                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombreServicio" name="nombreServicio" placeholder="Ingrese el nombre del Servicio">
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
          <h3 class="card-title mb-auto">
            <div class="row">
              <div class="col-lg-10 col-sm-6">Lista Servicios </div>
              <div class="col-lg-2 col-sm-4 text-end">
                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#servicioModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button>
              </div>
            </div>
          </h3>

        </div>
      </div>
    </div>
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <!-- encabezado--->
          <div class="container text-center">
            <div class="row mb-auto">
              <div class="col-lg-10 col-sm-4">
                <div class="table-length my-1 text-start">
                  <label>Mostrar
                    <select name="tbServicio-length" aria-controls="tbServicio" id="numRegistros">
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="15">15</option>
                    </select>
                    Entradas</label>
                </div>
              </div>
              <div class="col-lg-2 col-sm-4 text-end">
                <div class="mb-2">
                  <input type="search" class="form-control" id="inputbuscarArea" placeholder="Buscar..." size="14" maxlength="14">
                </div>
                </>
              </div>
            </div>
          </div>
          <!-- /encabezado--->
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
          <!-- Paginador Inicio -->
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <button id="btnPrimero" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
              <button id="btnAnterior" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
              <input type="text" id="txtPagVista" class="cuadrosPaginas" readonly>
              <label>&nbsp;de&nbsp;</label>
              <input type="text" id="txtPagTotal" class="cuadrosPaginas" readonly>
              <label>&nbsp;paginas.&nbsp;</label>
              <button id="btnSiguiente" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
              <button id="btnUltimo" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
            </div>
          </div>
          <!-- Paginador Final -->
        </div>
      </div>
    </div>
  </div>
</div>
<!--/Contenido-->

<script src="../js/serviciosAjax.js"></script>
<?php
include '../templates/footer.php';
?>