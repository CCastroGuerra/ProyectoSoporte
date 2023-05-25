<?php
include('../templates/cabecera.php');
?>


<!--Modal añadir componente-->
<div class="modal fade" id="añadirComponente" tabindex="-1" aria-labelledby="añadirComponente" aria-hidden="true">
    <div class="modal-dialog" modal-sm>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="añadirComponente">Añadir Componente</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAcomponente">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                    <label class="control-label">Código</label>
                                    <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                </div>

                                <label for="exampleInputEmail1" class="mb-2">Tipo de Componente:</label>
                                <select class="form-select" aria-label="Default select example" id="selTipo" name="selTipo">
                                    <option selected>Seleccione el tipo</option>
                                    <option value="1">CPU</option>
                                    <option value="2">Disco Duro</option>
                                    <option value="3">Memoria RAM</option>
                                </select>

                                <label for="exampleInputEmail1" class="mb-2">Clase de Componente </label>
                                <select class="form-select" aria-label="Default select example" id="selClase" name="selClase">
                                    <option selected>Seleccione la clase</option>
                                    <option value="1">Clase 1</option>
                                    <option value="2">Clase 2</option>
                                    <option value="3">Clase 3</option>
                                </select>

                                <label for="exampleInputEmail1" class="mb-2">Marca </label>
                                <select class="form-select" aria-label="Default select example" id="selMarca" name="selMarca">
                                    <option selected>Seleccione la marca</option>
                                    <option value="1">Marca 1</option>
                                    <option value="2">Marca 2</option>
                                    <option value="3">Marca 3</option>
                                </select>

                                <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                <select class="form-select" aria-label="Default select example" id="selModelo" name="selModelo">
                                    <option selected>Seleccione el modelo</option>
                                    <option value="1">Modelo 1</option>
                                    <option value="2">Modelo 2</option>
                                    <option value="3">Modelo 3</option>
                                </select>
                                <label for="exampleInputEmail1" class="mb-2"># Serie:</label>
                                <input type="text" class="form-control mb-2" id="serie" name="serie" placeholder="Ingrese serie">

                                <label for="exampleInputEmail1" class="mb-2">Capacidad:</label>
                                <input type="text" class="form-control mb-2" id="capacidad" name="capacidad" placeholder="Ingrese capacidad">

                                <label for="exampleInputEmail1" class="mb-2">Estado: </label>
                                <select class="form-select" aria-label="Default select example" id="selEstado" name="selEstado">
                                    <option selected>Seleccione estado</option>
                                    <option value="1">Bueno</option>
                                    <option value="2">Regular</option>
                                    <option value="3">Malo</option>
                                </select>
                                <label for="exampleInputEmail1" class="mb-2">Fecha:</label>
                                <input type="date" class="form-control mb-2" id="codigo" name="codigo" placeholder="Ingrese codigo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-toggle="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-coreui-dismiss="modal">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin del modal  -->

<!-- Tabla -->
<div class="col-md-12 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista de componentes </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirComponente"><strong>Añadir</strong></button></div>
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
                                        <select name="tbEquipos-length" aria-controls="tbEquipos" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarComponentes" placeholder="Buscar..." size="14" maxlength="14">
                                </div>
                                </>
                            </div>
                        </div>
                    </div>
                    <!-- /encabezado--->

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tableModal">
                            <thead>
                                <tr>
                                    
                                    <th scope="col"><strong>Tipo</strong></th>
                                    <th scope="col"><strong>Clase</strong></th>
                                    <th scope="col"><strong>Marca</strong></th>
                                    <th scope="col"><strong>Modelo</strong></th>
                                    <th scope="col"><strong># Serie</strong></th>
                                    <th scope="col"><strong>Capacidad</strong></th>
                                    <th scope="col"><strong>Estado</strong></th>
                                    <th scope="col"><strong>Fecha</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbEquipos">
                                <tr>
                                    <td>01</td>
                                    <td>tipo 1</td>
                                    <td>clase 1</td>
                                    <td>marca 1</td>
                                    <td>modelo 1</td>
                                    <td>##########</td>
                                    <td>16 tb</td>
                                    <td>nuevo</td>
                                    <td>02/05/2023</td>
                                    <td>[ ] [ ] [ ]</td>
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

<script src='../js/componentesAjax.js'></script>

<?php
include '../templates/footer.php';
?>