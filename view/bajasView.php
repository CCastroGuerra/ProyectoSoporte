<?php
include('../templates/cabecera.php');
?>


<!-- Modal bajas -->
<div class="modal fade" id="bajasModal" tabindex="-1" aria-labelledby="rolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Roles</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBajas">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="mb-2">Equipo:</label>
                                <div id="Equipo"></div>
                                <input type="text" class="form-control mb-2" id="codigoEquipo" name="codigoEquipo" placeholder="Ingrese código">
                                <label for="exampleInputEmail1" class="mb-2">Área:</label>
                                <select class="form-select" aria-label="Roles">
                                    <option selected>Seleccione el Área</option>
                                    <option value="1">Área 1</option>
                                    <option value="2">Área 2</option>
                                    <option value="3">Área 3</option>
                                </select>
                                <label for="exampleInputEmail1" class="mb-2">Motivo:</label>
                                <select class="form-select" aria-label="Roles">
                                    <option selected>Seleccione el Motivo</option>
                                    <option value="1">Motivo 1</option>
                                    <option value="2">Motivo 2</option>
                                    <option value="3">Motivo 3</option>
                                    <option value="4">Otros</option>
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
<!-- /*Fin del modal bajas*/ -->

<!--Contenido-->
<div class="col-md-12 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista Bajas </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#bajasModal"><strong>Añadir</strong></button></div>
                        </div></h3>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar Área" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarRoles" id="txtBuscarRoles">
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
                                <th scope="col"><strong>Equipo</strong></th>
                                <th scope="col"><strong>Area</strong></th>
                                <th scope="col"><strong>Motivo</strong></th>
                                <th scope="col"><strong>Fecha</strong></th>
                                <th scope="col"><strong>Opciones</strong></th>
                            </tr>
                        </thead>
                        <tbody id="tbRoles">

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