<?php
include('../templates/cabecera.php');
?>


<!-- Modal Roles -->
<div class="modal fade" id="rolesModal" tabindex="-1" aria-labelledby="rolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Roles</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRoles">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="mb-2">DNI:</label>
                                <div id="nombreEmpleado"></div>
                                <input type="text" class="form-control mb-2" id="inputDni" name="inputDni" placeholder="Ingrese DNI">
                                <label for="exampleInputEmail1" class="mb-2">Rol:</label>
                                <select class="form-select" aria-label="Roles">
                                    <option selected>Seleccione el rol</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Técnico</option>
                                    <option value="3">Secretaria</option>
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
<!-- /*Fin del modal roles*/ -->

<!--Contenido-->
<div class="col-md-12 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Asignación de Roles </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#rolesModal"><strong>Añadir</strong></button>
                            </div>
                        </div>
                    </h3>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar Rol" aria-label="txtRol" aria-describedby="button-addon2" name="txtBuscarRoles" id="txtBuscarRoles">
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>#</strong></th>
                                    <th scope="col"><strong>Nombre</strong></th>
                                    <th scope="col"><strong>Apellidos</strong></th>
                                    <th scope="col"><strong>Rol</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbRoles">
                                <tr>
                                <td>01</td>
                                <td>Nombre 1</td>
                                <td>Apellidos 1</td>
                                <td>Rol 1</td>
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
<!--/Contenido-->

<script src="../js/areaAjax.js"></script>
<?php
include '../templates/footer.php';
?>