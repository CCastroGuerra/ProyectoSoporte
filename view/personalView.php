<?php
include('../templates/cabecera.php');
?>
<!--Modal añadirEmpleado-->
<div class="modal fade" id="añadirEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-coreui-backdrop="static" data-coreui-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Personal</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEmpleados">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                    <label for="inputCodigo" class="control-label">Código</label>
                                    <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="apellidos" class="mb-2">Apellidos:</label>
                                    <input type="text" class="form-control form-control-sm mb-2" id="apellidos" name="apellidos" placeholder="Ingrese los apellidos">
                                    <small class="alerta" id="alerta1"></small>
                                </div>
                                <div class="form-group">
                                    <label for="nombre" class="mb-2">Nombre:</label>
                                    <input type="text" class="form-control  form-control-sm mb-2" id="nombre" name="nombre" placeholder="Ingrese el nombre">
                                    <small class="alerta" id="alerta2"></small>
                                </div>
                                <div class="form-group">
                                    <label for="dniusuario" class="mb-2">DNI:</label>
                                    <input type="number" class="form-control  form-control-sm mb-2" id="dniusuario" name="dniusuario" placeholder="Ingrese el DNI">
                                    <small class="alerta" id="alerta3"></small>
                                </div>
                                <div class="form-group">
                                    <label for="telefono" class="mb-2">Telefono:</label>
                                    <input type="text" class="form-control  form-control-sm mb-2" id="telefono" name="telefono" placeholder="Ingrese la telefono">
                                    <small class="alerta" id="alerta4"></small>
                                </div>
                                <div class="form-group">
                                    <label for="correo" class="mb-2">Correo:</label>
                                    <input type="text" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Direccion invalida" class="form-control  form-control-sm mb-2" id="correo" name="correo" placeholder="nickname@example.com">
                                    <small class="alerta" id="alerta5"></small>
                                </div>
                                <div class="form-group">
                                    <label for="selCargo" class="mb-2">Cargo:</label>
                                    <select class="form-select form-select-sm" aria-label="Default select example" id="selCargo" name="selCargo">
                                        <option value="0" selected>Seleccione el cargo </option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Practicante</option>
                                        <option value="3">Secretaria</option>
                                        <option value="4">Técnico</option>
                                    </select>
                                    <small class="alerta" id="alerta6"></small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin añadirempleado-->

<!-- Tabla -->
<div class="col-md-12 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista del Personal </div>
                            <div class="col-lg-2 col-sm-5 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirEmpleado" onclick="limpiarFormulario()">
                                    <strong>Añadir</strong>
                                </button>
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
                                        <select name="tbPersonal-length" aria-controls="tbPersonal" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarPersonal" placeholder="Buscar..." size="14" maxlength="14">
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

                                    <th scope="col"><strong>Apellidos</strong></th>
                                    <th scope="col"><strong>Nombre</strong></th>
                                    <th scope="col"><strong>DNI</strong></th>
                                    <th scope="col"><strong>Telefono</strong></th>
                                    <th scope="col"><strong>Correo</strong></th>
                                    <th scope="col"><strong>Cargo</strong></th>
                                    <th scope='col'><strong>Acciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbPersonal">
                                <tr>
                                    <td scope="col">Viera Burneo</td>
                                    <td scope="col">Cristian</td>
                                    <td scope="col">73376279</td>
                                    <td scope="col">977256520</td>
                                    <td scope="col">nexcris95@gmail.com</td>
                                    <td scope="col">Practicante</td>
                                    <td scope="col">[][][]</td>
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
                            <label for="txtPagVista">&nbsp;de&nbsp;</label>
                            <input type="text" id="txtPagTotal" class="cuadrosPaginas" readonly>
                            <label for="txtPagTotal">&nbsp;paginas.&nbsp;</label>
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
</div>


<script src='../js/personalAjax.js'></script>

<?php
include '../templates/footer.php';
?>