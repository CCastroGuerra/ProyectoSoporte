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
                    <button type="submit" class="btn btn-primary">Guardar</button>

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
                    <h3 class="card-title mb-4">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista Productos </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#productosModal"><strong>Añadir</strong></button></div>
                        </div>
                    </h3>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar producto" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
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
                                <th scope="col"><strong>Nombre</strong></th>
                                <th scope="col"><strong>Cantidad</strong></th>
                                <th scope="col"><strong>Almacen</strong></th>
                            </tr>
                        </thead>
                        <tbody id="tbProductos">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="../js/productosAjax.js"></script>
<?php
include '../templates/footer.php';

?>