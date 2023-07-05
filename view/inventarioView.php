<?php
include('../templates/cabecera.php');
?>
<!-- modal inventario -->
<div class="modal fade" id="inventarioModal" tabindex="-1" aria-labelledby="inventarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar inventario</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formInventario">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2">Acción:</label>
                        <select class="form-select" aria-label="Default select example" id="selAccion" name="selAccion">
                            <option value="0" selected>Seleccione una accion</option>
                            <option value="1">Entrada</option>
                            <option value="2">Salida</option>
                        </select>
                        <div class="error-message" id="errorAccion"></div>

                        <label for="exampleInputEmail1" class="mb-2">Producto:</label>
                        <!-- <input type="text" class="form-control is-invalid" class="form-control mb-2" id="nombreproducto" name="nombreProducto" placeholder="Ingrese Producto"> -->
                        <input type="text" class="form-control mb-2" id="nombreproducto" name="nombreProducto" placeholder="Ingrese Producto">
                        <div class="error-message" id="errorProducto"></div>

                        <label for="exampleInputEmail1" class="mb-2">Cantidad:</label>
                        <input type="number" class="form-control mb-2" id="cantidad" name="cantidad" placeholder="0.00">
                        <div id="errorCantidad" class="error-message"></div>
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
<!-- /modal inventario -->

<!-- Estilos css boton -->
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


<!-- contenido -->
<div class="col-lg-12 ">
    <div class="col-xs-1-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-auto">
                    <div class="row">
                        <div class="col-lg-10 col-sm-8">Inventario</div>
                        <div class="col-lg-2 col-sm-4 text-end row">
                            <!-- Boton para generar pdf -->
                            <div class="text-center col-lg-6 col-sm-6">
                                <a href="reporteInventario.php" class="pdf-button" target="_blank">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </a>
                            </div>
                            <!--  -->
                            <div class="text-center col-lg-6 col-sm-6">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#inventarioModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button>
                            </div>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class=" card-title mb-4" style="color:00000">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-inventario-tab" data-coreui-toggle="tab" data-coreui-target="#nav-inventario" type="button" role="tab" aria-controls="nav-inventario" aria-selected="true">Resumen</button>
                            <button class="nav-link" id="nav-entradas-tab" data-coreui-toggle="tab" data-coreui-target="#nav-entradas" type="button" role="tab" aria-controls="nav-entradas" aria-selected="false">Entradas</button>
                            <button class="nav-link" id="nav-salidas-tab" data-coreui-toggle="tab" data-coreui-target="#nav-salidas" type="button" role="tab" aria-controls="nav-salidas" aria-selected="false">Salidas</button>
                        </div>
                    </nav>
                </h5>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-inventario" role="tabpanel" aria-labelledby="nav-inventario-tab" tabindex="0">
                        <!--tabla inventario -->
                        <!-- encabezado--->
                        <div class="container text-center">
                            <div class="row mb-auto">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="table-length mb-auto my-1 text-start">
                                        <label>Mostrar
                                            <select name="tbInventario-length" aria-controls="tbInventario" id="numRegistrosResumen">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                            Entradas</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 text-end">
                                    <div class="mb-auto">
                                        <input type="search" class="form-control" id="inputbuscarInventario" placeholder="Buscar..." size="14" maxlength="14">
                                    </div>
                                    </>
                                </div>
                            </div>
                        </div>
                        <!-- /encabezado--->
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>

                                    <th scope="col"><strong>Producto</strong></th>
                                    <th scope="col"><strong>Cantidad</strong></th>
                                    <th scope="col"><strong>Descripción</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbInventario">
                                <td>01</td>
                                <td>Producto 1</td>
                                <td>##</td>
                            </tbody>
                        </table>
                        <!-- Paginador Inicio -->
                        <div class="row paginador">
                            <div class="texto-registros" id="txtcontador" name="txtcontador"></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <button id="btnPrimeroRe" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
                                <button id="btnAnteriorRe" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
                                <input type="text" id="txtPagVista" class="cuadrosPaginas" readonly>
                                <label>&nbsp;de&nbsp;</label>
                                <input type="text" id="txtPagTotal" class="cuadrosPaginas" readonly>
                                <label>&nbsp;paginas.&nbsp;</label>
                                <button id="btnSiguienteRe" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
                                <button id="btnUltimoRe" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
                            </div>
                        </div>
                        <!-- Paginador Final -->
                        <!-- /tabla inventario -->
                    </div>
                    <div class="tab-pane fade" id="nav-entradas" role="tabpanel" aria-labelledby="nav-entradas-tab" tabindex="0">
                        <!--tabla entradas -->
                        <!-- encabezado--->
                        <div class="container text-center">
                            <div class="row mb-auto">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="table-length mb-auto my-1 text-start">
                                        <label>Mostrar
                                            <select name="tbEntradas-length" aria-controls="tbEntradas" id="numRegistrosEntradas">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                            Entradas</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 text-end">
                                    <div class="mb-auto">
                                        <input type="search" class="form-control" id="inputbuscarEntradas" placeholder="Buscar..." size="14" maxlength="14">
                                    </div>
                                    </>
                                </div>
                            </div>
                        </div>
                        <!-- /encabezado--->

                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>

                                    <th scope="col"><strong>Producto</strong></th>
                                    <th scope="col"><strong>Cantidad</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbEntradas">
                                <td>01</td>
                                <td>Producto 1</td>
                                <td>###</td>
                            </tbody>
                        </table>
                        <!-- Paginador Inicio -->
                        <div class="row paginador">
                            <div class="texto-registros" id="txtcontador" name="txtcontador"></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <button id="btnPrimeroEn" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
                                <button id="btnAnteriorEn" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
                                <input type="text" id="txtPagVistaEn" class="cuadrosPaginas" readonly>
                                <label>&nbsp;de&nbsp;</label>
                                <input type="text" id="txtPagTotalEn" class="cuadrosPaginas" readonly>
                                <label>&nbsp;paginas.&nbsp;</label>
                                <button id="btnSiguienteEn" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
                                <button id="btnUltimoEn" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
                            </div>
                        </div>
                        <!-- Paginador Final -->
                        <!-- /tabla entradas -->
                    </div>
                    <div class="tab-pane fade" id="nav-salidas" role="tabpanel" aria-labelledby="nav-salidas-tab" tabindex="0">
                        <!--tabla salidas -->
                        <!-- encabezado--->
                        <div class="container text-center">
                            <div class="row mb-auto">
                                <div class="col-lg-8 col-sm-8">
                                    <div class="table-length mb-auto my-1 text-start">
                                        <label>Mostrar
                                            <select name="tbSalidas-length" aria-controls="tbSalidas" id="numRegistrosSalidas">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                            Entradas</label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-4 text-end">
                                    <div class="mb-auto">
                                        <input type="search" class="form-control" id="inputbuscarSalidas" placeholder="Buscar..." size="14" maxlength="14">
                                    </div>
                                    </>
                                </div>
                            </div>
                        </div>
                        <!-- /encabezado--->
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>

                                    <th scope="col"><strong>Producto</strong></th>
                                    <th scope="col"><strong>Cantidad</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbSalidas">
                                <td>01</td>
                                <td>Producto 1</td>
                                <td>####</td>
                            </tbody>
                        </table>
                        <!-- Paginador Inicio -->
                        <div class="row paginador">
                            <div class="texto-registros" id="txtcontador" name="txtcontador"></div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <button id="btnPrimeroSa" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
                                <button id="btnAnteriorSa" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
                                <input type="text" id="txtPagVistaSa" class="cuadrosPaginas" readonly>
                                <label>&nbsp;de&nbsp;</label>
                                <input type="text" id="txtPagTotalSa" class="cuadrosPaginas" readonly>
                                <label>&nbsp;paginas.&nbsp;</label>
                                <button id="btnSiguienteSa" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
                                <button id="btnUltimoSa" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
                            </div>
                        </div>
                        <!-- Paginador Final -->
                        <!-- /tabla salidas -->
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- /fin contenido -->

<script src="../js/inventarioAjax.js"></script>
<?php
include '../templates/footer.php';
?>