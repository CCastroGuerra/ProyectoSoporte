<?php
include('../templates/cabecera.php');
?>


<!-- Modal -->
<div class="modal fade" id="productosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formProducto">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="visually-hidden">
                                        <label class="control-label">Código</label>
                                        <input type="text" class="form-control" id="inputCodigo" placeholder="Código" readonly>
                                    </div>
                                    <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                                    <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese Nombre">
                                    <label for="exampleInputEmail1" class="mb-2">Cantidad:</label>
                                    <input type="text" class="form-control mb-2" id="nombreArea" name="nombreArea" placeholder="Ingrese cantidad">
                                    <label for="exampleInputEmail1" class="mb-2">Almacen:</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Seleccione el Almacén</option>
                                        <option value="1">Almacén 1</option>
                                        <option value="2">Almacén 2</option>
                                        <option value="3">Almacén 3</option>
                                    </select>

                                    <div id="alerta"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Cerrar</button>
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
                                <th scope="col"><strong>#</strong></th>
                                <th scope="col"><strong>Nombre</strong></th>
                                <th scope="col"><strong>Cantidad</strong></th>
                                <th scope="col"><strong>Almacen</strong></th>
                            </tr>
                        </thead>
                        <tbody id="tbProductos">
                            <tr>
                                <td>##</td>
                                <td>Producto ##</td>
                                <td>##.##</td>
                                <td>Almacen ##</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Paginador Inicio -->
                    <div class="row">
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