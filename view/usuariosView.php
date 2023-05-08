<?php
include('../templates/cabecera.php');
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1" class="mb-2">Nombre Usuario:</label>
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
              <h3 class="card-title">Usuarios</h3>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1" class="mb-2">Nombre Usuario:</label>
                <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese Usuario">
                <label for="exampleInputEmail1" class="mb-2">Contraseña:</label>
                <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese Contraseña">
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
          <h3 class="card-title mb-4">Lista Área</h3>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Buscar Área" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
          </div>

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
                                        <select name="tbUsuarios-length" aria-controls="tbUsuarios" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <div class="mb-2">
                                    <input type="search" class="form-control" id="inputbuscarTrabajo" placeholder="Buscar..." size="14" maxlength="14">
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
            <tbody id="tbArea">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../js/usuariosAjax.js"></script>
<?php
include '../templates/footer.php';
?>