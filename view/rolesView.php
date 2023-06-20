<?php
include('../templates/cabecera.php');
?>


<!-- Modal Roles -->
<div class="modal fade" id="rolesModal" tabindex="-1" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-labelledby="rolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Rol</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formRoles" name="formRoles">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                    <label for="inputCodigo" class="control-label">Código</label>
                                    <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                </div>
                                <label for="inputRol" class="mb-2">Rol:</label>
                                <input type="text" class="form-control mb-2" id="inputRol" name="inputRol" placeholder="Ingrese el Rol" required>
                                <div id="alerta"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="btnguardar">Guardar</button>

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
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Roles </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#rolesModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button>
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
                                        <select name="tbRoles-length" aria-controls="tbRoles" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarRoles" placeholder="Buscar..." size="14" maxlength="14">
                                </div>
                                </>
                            </div>
                        </div>
                    </div>
                    <!-- /encabezado--->
                    <div class="table-responsive">
                        <table class="table table-hover table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Nombre</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbRoles">
                                <tr>
                                    <td>01</td>
                                    <td>Rol 1</td>
                                    <td>[] [] []</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row paginador">
                        <div class="texto-registros" id="txtcontador" name="txtcontador"></div>
                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <button id="btnPrimero" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
                            <button id="btnAnterior" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
                            <input type="text" id="txtPagVista" class="cuadrosPaginas" readonly>
                            <label>&nbsp;de&nbsp;</label>
                            <input type="text" id="txtPagTotal" class="cuadrosPaginas" readonly>
                            <label>&nbsp;paginas.&nbsp;</label>
                            <button id="btnSiguiente" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
                            <button id="btnUltimo" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
                        </div> -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--/Contenido-->

<script src="../js/rolesAjax.js"></script>
<?php
include '../templates/footer.php';
?>