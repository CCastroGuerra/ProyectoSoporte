<?php
include('../templates/cabecera.php');
?>


<!--Modal añadir componente-->
<div class="modal fade" id="añadirComponente" tabindex="-1" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-labelledby="añadirComponente" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog" modal-sm>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="añadirComponentetitle">Añadir Componente</h5>
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

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2">Tipo de Componente:</label>
                                    <select class="form-select" aria-label="Default select example" id="selTipo" name="selTipo">
                                        <option selected>Seleccione el tipo</option>
                                        <option value="1">CPU</option>
                                        <option value="2">Disco Duro</option>
                                        <option value="3">Memoria RAM</option>
                                    </select>
                                    <small class="alerta" id="alerta1"></small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2">Clase de Componente </label>
                                    <select class="form-select" aria-label="Default select example" id="selClase" name="selClase">
                                        <option selected>Seleccione la clase</option>
                                        <option value="1">Clase 1</option>
                                        <option value="2">Clase 2</option>
                                        <option value="3">Clase 3</option>
                                    </select>
                                    <small class="alerta" id="alerta2"></small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2">Marca </label>
                                    <select class="form-select" aria-label="Default select example" id="selMarca" name="selMarca">
                                        <option selected>Seleccione la marca</option>
                                        <option value="1">Marca 1</option>
                                        <option value="2">Marca 2</option>
                                        <option value="3">Marca 3</option>
                                    </select>
                                    <small class="alerta" id="alerta3"></small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                    <select class="form-select" aria-label="Default select example" id="selModelo" name="selModelo">
                                        <option selected>Seleccione el modelo</option>
                                        <option value="1">Modelo 1</option>
                                        <option value="2">Modelo 2</option>
                                        <option value="3">Modelo 3</option>
                                    </select>
                                    <small class="alerta" id="alerta4"></small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2"># Serie:</label>
                                    <input type="text" class="form-control mb-2" id="serie" name="serie" placeholder="Ingrese serie" maxlength="40">
                                    <small class="alerta" id="alerta5"></small>
                                </div>

                                <div class="form-group">
                                    <label for="inMargesi" class="mb-2">Margesi:</label>
                                    <input type="text" class="form-control mb-2" id="inMargesi" name="inMargesi" placeholder="Ingrese Margesi" maxlength="40">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2">Capacidad:</label>
                                    <input type="text" class="form-control mb-2" id="capacidad" name="capacidad" placeholder="Ingrese capacidad" value="0">
                                    <small class="alerta" id="alerta6"></small>
                                </div>

                                <div class="form-group">
                                    <label for="selAlim" class="mb-2">Alimentación:</label>
                                    <select class="form-select" aria-label="Default select example" id="selAlim" name="selAlim">
                                        <option value="0" selected>Seleccione la alimentación</option>
                                        <option value="1">Cable directo</option>
                                        <option value="2">Transformador</option>
                                    </select>
                                    <small class="alerta" id="alerta8"></small>
                                </div>

                                <div class="form-group">
                                    <label for="conector" class="mb-2">Conector:</label>
                                    <input type="text" class="form-control mb-2" id="conector" name="conector" placeholder="VGA/HDMI/DiplayPort/DVI">
                                    <small class="alerta" id="alerta9"></small>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1" class="mb-2">Estado: </label>
                                    <select class="form-select" aria-label="Default select example" id="selEstado" name="selEstado">
                                        <option selected>Seleccione estado</option>
                                        <option value="1">Bueno</option>
                                        <option value="2">Regular</option>
                                        <option value="3">Malo</option>
                                    </select>
                                    <small class="alerta" id="alerta7"></small>
                                </div>

                            </div>
                        </div>
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
<!-- Fin del modal  -->

<!-- Tabla -->
<div class="body flex-grow-1 px-0">
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

                    <div class="table-responsive ">
                        <table class="table table-hover align-middle" id="tableModal">
                            <thead>
                                <tr>

                                    <th scope="col"><strong>Tipo</strong></th>
                                    <th scope="col"><strong>Clase</strong></th>
                                    <th scope="col"><strong>Marca</strong></th>
                                    <th scope="col"><strong>Modelo</strong></th>
                                    <th scope="col"><strong># Serie</strong></th>
                                    <th scope="col"><strong>Capacidad</strong></th>
                                    <th scope="col"><strong>Conector</strong></th>
                                    <th scope="col"><strong>Estado</strong></th>
                                    <th scope="col"><strong>Disponible</strong></th>
                                    <th scope="col"><strong>Fecha</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbComponentes">
                                <tr>
                                    <td><p class="placeholder-glow"><span class="placeholder w-100"></span></p></td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder w-100"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder w-100"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder w-100"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder col-10"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder col-5"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder col-4"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder col-2"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder col-3"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder col-8"></span></p>
                                    </td>
                                    <td>
                                        <p class="placeholder-glow"><span class="placeholder w-100"></span></p>
                                    </td>
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
<script src="../js/sesionAjax.js"></script>

<?php
include '../templates/footer.php';
?>