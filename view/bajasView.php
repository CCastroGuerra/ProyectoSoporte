<?php
include('../templates/cabecera.php');
?>


<!-- Modal bajas -->
<div class="modal fade" id="bajasModal" tabindex="-1" data-coreui-backdrop="static" data-coreui-keyboard="false"  aria-labelledby="rolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Bajas</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formBajas">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div id="divcodigo" name="divcodigo">
                                    <label class="control-label">Código</label>
                                    <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                </div>
                                <label for="exampleInputEmail1" class="mb-2">Equipo:</label>
                                <input type="text" class="form-control mb-2" id="codigoEquipo" name="codigoEquipo" placeholder="Ingrese #serie">
                                <p id="Equipo" style="color:red"></p>
                                <label for="exampleInputEmail1" class="mb-2">Tipo:</label>
                                <select class="form-select" aria-label="selArea" id="selArea" name="selArea">
                                    <option selected value="0">Seleccione el Tipo</option>
                                    <option value="1">Temporal</option>
                                    <option value="2">Permanente</option>
                                </select>
                                <p id="combo" style="color:red"></p>
                                <label for="exampleInputEmail1" class="mb-2">Motivo:</label>
                                <textarea class="form-control" id="motivo" name="motivo" rows="3"></textarea>
                                <p id="txtMotivo" style="color:red"></p>



                                <div id="alerta"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
                    <button id="btnGuardar" type="submit" class="btn btn-primary">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- /*Fin del modal bajas*/ -->


<!-- Estilos css -->
<style>
    .pdf-button {
        display: inline-block;
        /* align-items: center;
        justify-content: center; */
        padding: 10px 20px;
        background-color: #d72121;
        color: #fff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
    }
</style>
<!-- fin de estilos -->


<!--Contenido-->
<div class="col-md-12 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-9 col-sm-8">Lista Bajas </div>

                            <!--  -->
                            <div class="text-end col-lg-3 col-sm-4 row">
                                <!-- Boton para generar pdf -->
                                <div class="text-center col-lg-6 col-sm-5">
                                    <a href="reportesBajas.php" class="pdf-button" target="_blank">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <!-- Boton Añadir -->
                                <div class="text-end col-lg-6 col-sm-7">
                                    <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#bajasModal"><strong>Añadir</strong></button>
                                </div>
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
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>

                                    <th scope="col"><strong>Equipo</strong></th>
                                    <th scope="col"><strong>Area</strong></th>
                                    <th scope="col"><strong>Motivo</strong></th>
                                    <th scope="col"><strong>Fecha</strong></th>
                                    <th scope="col"><strong>Descripción</strong></th>
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
<!--/Contenido-->

<script src="../js/bajasAjax.js"></script>
<script src="../js/sesionAjax.js"></script>
<?php
include '../templates/footer.php';
?>