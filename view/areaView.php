<?php
include('../templates/cabecera.php');
?>




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
                  <label class="control-label">Código</label>
                  <input type="text" class="form-control" id="inputCodigo" placeholder="Código" readonly>

                </div>
                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                <input type="text" class="form-control mb-2" id="nombre_area" name="nombre_area" placeholder="Ingrese área">
                <div id="alerta"></div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" data-coreui-dismiss="modal">Guardar</button>

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
                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#areaModal"><strong>Añadir</strong></button>
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
          <!-- tabla area -->
          <table class="table" id="tablaAreas">
            <thead>
              <tr>
                <th scope="col"><strong>#</strong></th>
                <th scope="col"><strong>Nombre</strong></th>
                <th scope="col"><strong></strong></th>
                <th scope="col"><strong></strong></th>
                <th scope="col"><strong></strong></th>

              </tr>
            <tbody>

            </tbody>
            </thead>
          </table>
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
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="../js/areaAjax.js"></script>

<?php
include '../templates/footer.php';
?>