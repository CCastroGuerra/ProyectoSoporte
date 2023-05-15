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
                                <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                    <label class="control-label">Código</label>
                                    <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                </div>
                                <label for="exampleInputEmail1" class="mb-2">Equipo:</label>
                                <div id="Equipo"></div>
                                <input type="text" class="form-control mb-2" id="codigoEquipo" name="codigoEquipo" placeholder="Ingrese código">
                                <label for="exampleInputEmail1" class="mb-2">Área:</label>
                                <select class="form-select" aria-label="selArea" id="selArea" name="selArea">
                                    <option selected>Seleccione el Área</option>
                                    <option value="1">Área 1</option>
                                    <option value="2">Área 2</option>
                                    <option value="3">Área 3</option>
                                </select>
                                <label for="exampleInputEmail1" class="mb-2">Motivo:</label>
                                <select class="form-select" aria-label="Motivo" id="selMotivo" name="selMotivo">
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
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-coreui-dismiss="modal">Guardar</button>

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
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista Bajas </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#bajasModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button></div>
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
                                        <select name="tbBajas-length" aria-controls="tbBajas" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarBajas" placeholder="Buscar..." size="14" maxlength="14">
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
                                    <th scope="col"><strong>Equipo</strong></th>
                                    <th scope="col"><strong>Area</strong></th>
                                    <th scope="col"><strong>Motivo</strong></th>
                                    <th scope="col"><strong>Fecha</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbBajas">
                                <tr>
                                    <td>01</td>
                                    <td>Equipo 01</td>
                                    <td>Area 01</td>
                                    <td>Motivo</td>
                                    <td>Fecha</td>
                                    <td>[] [] []</td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                    <!-- Paginador Inicio -->
                    <div class="row paginador">
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

<script src="../js/bajasAjax.js"></script>
<?php
include '../templates/footer.php';
?>