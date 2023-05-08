<?php
include('../templates/cabecera.php');
?>


<!-- Modal -->
<div class="modal fade" id="añadirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Modelo</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formArea">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <div class="visually-hidden">
                  <label for="exampleInputEmail1" class="mb-2">Código:</label>
                  <input type="text" class="form-control mb-2" id="codigoModelo" name="codigoModelo" readonly>
                </div>

                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese modelo">
                <label for="exampleInputEmail1" class="mb-2">Marca:</label>
                <select class="form-select form-select-sm" aria-label="Default select example">
                  <option selected>Selecciona la marca</option>
                  <option value="1">LG</option>
                  <option value="2">ADATA</option>
                  <option value="3">Sasmsung</option>
                </select>
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
<!-- /*Fin del modal */ -->


<!--contenido-->
<div class="col-md-12 col-lg-12 ">
  <div class="row ">
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title mb-auto">
            <div class="row">
              <div class="col-lg-10 col-sm-6">Lista de Modelos </div>
              <div class="col-lg-2 col-sm-4 text-end">
                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirModal"><strong>Añadir</strong></button>
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
                    <select name="tablaAreas_length" aria-controls="tablaAreas">
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
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col"><strong>#</strong></th>
                  <th scope="col"><strong>Nombre</strong></th>
                  <th scope="col"><strong>Modelo</strong></th>
                  <th scope="col"><strong>Opciones</strong></th>
                </tr>
              </thead>
              <tbody id="tbArea">
                <tr>
                  <td>01</td>
                  <td>Nombre 01</td>
                  <td>Modelo A</td>
                  <td>[] [] []</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--contenido-->

<script src="../js/modeloAjax.js"></script>
<?php
include '../templates/footer.php';
?>