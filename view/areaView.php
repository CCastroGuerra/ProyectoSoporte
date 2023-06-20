<?php
include('../templates/cabecera.php');
?>

<!-- ---------------- -->
<!-- Modal Area -->
<div class="modal fade" id="areaModal" tabindex="-1" aria-labelledby="areaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal">Guardar Área</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formArea">
        <div class="modal-body">

          <div class="card">
            <div class="card-body">
              <div class="form-group">

                <div class="visually-hidden">
                  <label for="inputCodigo" class="control-label">Código</label>
                  <input type="text" class="form-control" id="inputCodigo" placeholder="Código" readonly>

                </div>
                <label for="nombre_area" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombre_area" name="nombre_area" placeholder="Ingrese área">
                <div id="alerta"></div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>

        </div>
      </form>
    </div>
  </div>
</div>
<!-- /*Fin del modal area*/ -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!--Contenido-->
<div class="col-md-12 col-lg-12 ">
  <div class="row ">
    <div class="col-xs-1-12">
      <div class="card">
        <div class="card-body">
          <h3 class="card-title mb-auto">
            <div class="row">
              <div class="col-lg-10 col-sm-6">Lista de Áreas </div>
              <div class="col-lg-2 col-sm-4 text-end">
                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#areaModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button>
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
              <div class="col-lg-8 col-sm-8">
                <div class="table-length mb-auto my-1 text-start">
                  <label>Mostrar
                    <select name="tbArea-length" aria-controls="tbArea" id="numRegistros">
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="15">15</option>
                    </select>
                    Entrada</label>
                </div>
              </div>
              <div class="col-lg-4 col-sm-4 text-end">
                <div class="mb-auto">
                  <input type="search" class="form-control" id="inputbuscarArea" placeholder="Buscar..." size="14" maxlength="14">
                </div>
                </>
              </div>
            </div>
          </div>
          <!-- /encabezado--->

          <!-- tabla area -->
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th scope="col"><strong>Nombre</strong></th>
                <th scope="col"><strong>Opciones</strong></th>
              </tr>
            </thead>
            <tbody id="tbArea">

            </tbody>
          </table>
          <!-- Paginador Inicio -->
          <div class="row paginador">
            <div class="texto-registros" id="txtcontador" name="txtcontador"></div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <button id="btnPrimero" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
              <button id="btnAnterior" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
              <input type="text" id="txtPagVista" class="cuadrosPaginas" readonly>
              <label for="txtPagVista">&nbsp;de&nbsp;</label>
              <input type="text" id="txtPagTotal" class="cuadrosPaginas" readonly>
              <label for="txtPagTotal">&nbsp;paginas.&nbsp;</label>
              <button id="btnSiguiente" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
              <button id="btnUltimo" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
            </div>
          </div>
          <!-- Paginador Final -->
          <!-- /tabla area -->
        </div>
      </div>
    </div>
  </div>
</div>

<!--/Contenido-->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../js/areaAjax.js"></script>

<?php
include '../templates/footer.php';
?>