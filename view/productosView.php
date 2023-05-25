<?php
include('../templates/cabecera.php');
?>
<!-- modal presentacion -->
<div class="modal" tabindex="-1" id="presentacionModal" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Presentación</h5>
                <button type="button" class="btn-close" data-coreui-target="#productosModal" data-coreui-toggle="modal" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="formPresentacion">
                    <div class="form-group">
                        <div class="visually-hidden" id="divcodigo" name="divcodigo">
                            <label class="control-label">ID</label>
                            <input type="text" class="form-control" id="inputIDpres" name="inputIDpress" placeholder="ID" readonly>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Busca la  Presentación" aria-label="BuscaPrestentacion" id="BuscarPre" name="BuscarPre" aria-describedby="button-addon2" size="10" maxlength="10">
                                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="visually-hidden" scope="col"><strong>#</strong></th>
                                    <th scope="col"><strong>Nombre</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbPres">
                                <tr>
                                    <td>#</td>
                                    <td>Producto ##</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Paginador Inicio -->
                        <div class="row paginador">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <button id="btnPrimeroPre" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
                                <button id="btnAnteriorPre" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
                                <input type="text" id="txtPagVistaPre" class="cuadrosPaginas" readonly>
                                <label>&nbsp;de&nbsp;</label>
                                <input type="text" id="txtPagTotalPre" class="cuadrosPaginas" readonly>
                                <label>&nbsp;paginas.&nbsp;</label>
                                <button id="btnSiguientePre" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
                                <button id="btnUltimoPre" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
                            </div>
                        </div>
                        <!-- Paginador Final -->
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btncerrar" data-coreui-target="#productosModal" data-coreui-toggle="modal" id="btncerrar">Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!-- /modal presentacion -->







<!-- Modal -->
<div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Guardar Producto</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formProducto">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                        <label class="control-label">ID</label>
                                        <input type="text" class="form-control" id="inputID" name="inputID" placeholder="ID" readonly>
                                    </div>
                                    <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                                    <input type="text" class="form-control mb-2" id="nombreProducto" name="nombreProducto" placeholder="Ingrese Nombre">
                                    <label for="exampleInputEmail1" class="mb-2">Tipo de Producto:</label>
                                    <select class="form-select form-select-sm" aria-label="Default select example" id="selTipoProducto" name="selTipoProducto">
                                        <option selected>Seleccione el tipo</option>
                                        <option value="1">Equipo</option>
                                        <option value="2">Componente</option>
                                        <option value="3">Herramienta</option>
                                        <option value="4">Insumo</option>
                                    </select>
                                    <label for="exampleInputEmail1" class="mb-2">Presentación:</label>
                                    <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#presentacionModal"></button>
                                    <select class="form-select form-select-sm" aria-label="Default select example" id="selUnidad" name="selUnidad">
                                        
                                    </select>
                                    <label for="exampleInputEmail1" class="mb-2">Cantidad:</label>
                                    <input type="text" class="form-control mb-2" id="ctdProducto" name="ctdProducto" placeholder="Ingrese cantidad">
                                    <label for="exampleInputEmail1" class="mb-2">Almacen:</label>
                                    <select class="form-select" aria-label="Default select example" id="selAlmacen" name="selAlmacen">
                                        <option selected>Seleccione el Almacén</option>
                                        <option value="1">Almacén 1</option>
                                        <option value="2">Almacén 2</option>
                                        <option value="3">Almacén 3</option>
                                    </select>
                                    <label for="exampleInputEmail1" class="mb-2">Detalles:</label>
                                    <textarea class="form-control" rows="9" name='detalleProducto' id='detalleProducto'></textarea>

                                    <div id="alerta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-coreui-dismiss="modal" id="btnGuardar">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- /*Fin del modal */ -->

<div class="col-md-8 col-lg-12">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista Productos </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#productosModal" onclick="limpiarFormulario()"><strong>Añadir</strong></button></div>
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
                                        <select name="tbProductos-length" aria-controls="tbProductos" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarProducto" placeholder="Buscar..." size="14" maxlength="14">
                                </div>
                                </>
                            </div>
                        </div>
                    </div>
                    <!-- /encabezado--->

                    <table class="table">
                        <thead>
                            <tr>                                
                            <tr>
                                <th class="visually-hidden" scope="col"><strong>#</strong></th>
                                <th scope="col"><strong>Codigo</strong></th>
                                <th scope="col"><strong>Nombre</strong></th>
                                <th scope="col"><strong>Tipo</strong></th>
                                <th scope="col"><strong>Unidad</strong></th>
                                <th scope="col"><strong>Cantidad</strong></th>
                                <th scope="col"><strong>Almacen</strong></th>
                                <th scope="col"><strong>Acciones</strong></th>
                            </tr>
                        </thead>
                        <tbody id="tbProductos">
                            
                        </tbody>
                    </table>
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
<script src="../js/productosAjax.js"></script>
<?php
include '../templates/footer.php';

?>