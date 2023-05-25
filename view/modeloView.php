<?php
include('../templates/cabecera.php');
?>


<!-- Modal -->
<div class="modal fade" id="añadirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Modelo</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formModelo">
        <div class="modal-body">
          <div class="card">
            <div class="card-body">
              <div class="form-group">
                <div class="visually-hidden" id="divcodigo" name="divcodigo">
                  <label for="exampleInputEmail1" class="mb-2">Código:</label>
                  <input type="text" class="form-control mb-2" id="codigoModelo" name="codigoModelo" readonly>
                </div>

                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombreModelo" name="nombreModelo" placeholder="Ingrese modelo">
                <label for="exampleInputEmail1" class="mb-2">Marca:</label>
                <select class="form-select form-select-sm" aria-label="Default select example" id="selMarca" name="selMarca">
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
          <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" data-coreui-dismiss="modal">Guardar</button>

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
                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button>
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
              <div class="col-lg-8 col-sm-4">
                <div class="table-length mb-auto my-1 text-start">
                  <label>Mostrar
                    <select name="tbModelo-length" aria-controls="tbModelo" id="numRegistros">
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="15">15</option>
                    </select>
                    Entradas</label>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 text-end">
                <div class="mb-auto">
                  <input type="search" class="form-control" id="inputbuscarModelo" placeholder="Buscar..." size="14" maxlength="14">
                </div>
                </>
              </div>
            </div>
          </div>
          <!-- /encabezado--->
          <div class="table-responsive">
            <table class="table table-hover align-middle text-center">
              <thead>
                <tr>
                  <th scope="col"><strong>Modelo</strong></th>
                  <th scope="col"><strong>Marca</strong></th>
                  <th scope="col"><strong>Opciones</strong></th>
                </tr>
              </thead>
              <tbody id="tbModelo">
                <tr>
                  <td>01</td>
                  <td>Modelo 01</td>
                  <td>Marca A</td>
                  <td>[] [] []</td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- Paginador Inicio -->
          <div class="row paginador">
            <div class="texto-registros" id="txtcontador" name="txtcontador"></div>
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
<!--contenido-->

<script src="../js/modeloAjax.js"></script>
<?php
include '../templates/footer.php';
?>