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
            <form>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="mb-2">Acción:</label>
                        <select class="form-select" aria-label="Default select example">
                            <option value="1" selected>Entrada</option>
                            <option value="2">Salida</option>
                        </select>
                        <label for="exampleInputEmail1" class="mb-2">Producto:</label>
                        <input type="text" class="form-control mb-2" id="nombreproducto" name="nombreProducto" placeholder="Ingrese Producto">
                        <label for="exampleInputEmail1" class="mb-2">Cantidad:</label>
                        <input type="number" class="form-control mb-2" id="cantidad" name="cantidad" placeholder="0.00">
                        <div id="alerta"></div>
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
<!-- /modal inventario -->

<!-- contenido -->
<div class="col-lg-12 ">
    <div class="col-xs-1-12">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title mb-auto">
                    <div class="row">
                        <div class="col-lg-10 col-sm-6">Inventario </div>
                        <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#inventarioModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button></div>
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
                                <div class="col-lg-10 col-sm-4">
                                    <div class="table-length my-1 text-start">
                                        <label>Mostrar
                                            <select name="tbInventario-length" aria-controls="tbInventario">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                            Entradas</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-4 text-end">
                                    <div class="mb-2">
                                        <input type="search" class="form-control" id="inputbuscarInventario" placeholder="Buscar..." size="14" maxlength="14">
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
                                    <th scope="col"><strong>Producto</strong></th>
                                    <th scope="col"><strong>Cantidad</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbInventario">
                                <td>01</td>
                                <td>Producto 1</td>
                                <td>##</td>
                            </tbody>
                        </table>
                        <!-- /tabla inventario -->
                    </div>
                    <div class="tab-pane fade" id="nav-entradas" role="tabpanel" aria-labelledby="nav-entradas-tab" tabindex="0">
                        <!--tabla entradas -->
                        <!-- encabezado--->
                        <div class="container text-center">
                            <div class="row mb-auto">
                                <div class="col-lg-10 col-sm-4">
                                    <div class="table-length my-1 text-start">
                                        <label>Mostrar
                                            <select name="tbEntradas-length" aria-controls="tbEntradas" id="numRegistros">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                            Entradas</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-4 text-end">
                                    <div class="mb-2">
                                        <input type="search" class="form-control" id="inputbuscarEntradas" placeholder="Buscar..." size="14" maxlength="14">
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
                        <!-- /tabla entradas -->
                    </div>
                    <div class="tab-pane fade" id="nav-salidas" role="tabpanel" aria-labelledby="nav-salidas-tab" tabindex="0">
                        <!--tabla salidas -->
                        <!-- encabezado--->
                        <div class="container text-center">
                            <div class="row mb-auto">
                                <div class="col-lg-10 col-sm-4">
                                    <div class="table-length my-1 text-start">
                                        <label>Mostrar
                                            <select name="tbSalidas-length" aria-controls="tbSalidas">
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                            </select>
                                            Entradas</label>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-4 text-end">
                                    <div class="mb-2">
                                        <input type="search" class="form-control" id="inputbuscarSalidas" placeholder="Buscar..." size="14" maxlength="14">
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