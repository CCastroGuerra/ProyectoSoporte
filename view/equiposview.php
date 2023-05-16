<?php
include('../templates/cabecera.php');
?>
<!-- Modal  añadir equipo-->
<div class="modal fade" id="añadirEquipo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Equipo</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formAEquipo">
                <div class="modal-body">

                    <div class="row">
                        <!--formulario de datos de equipo -->
                        <div class="col-md-4 col-lg-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                            <label class="control-label">Código</label>
                                            <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                        </div>
                                        <label for="exampleInputEmail1" class="mb-2">Serie:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="serie" name="serie" placeholder="Ingrese # de serie">
                                        <label for="exampleInputEmail1" class="mb-2">Margesi:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="margesi" name="margesi" placeholder="Ingrese Margesi">
                                        <label for="exampleInputEmail1" class="mb-2">Tipo de equipo:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example" id="selTipoEquipo" name="selTipoEquipo">
                                            <option selected>Seleccione el tipo</option>
                                            <option value="1">Impresora</option>
                                            <option value="2">Laptop</option>
                                            <option value="3">Todo en uno</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Marca:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="marca" name="marca" placeholder="Ingrese marca">
                                        <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="modelo" name="modelo" placeholder="Ingrese modelo">
                                        <label for="exampleInputEmail1" class="mb-2">Usuario:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="usuario" name="usuario" placeholder="Ingrese Usuario">
                                        <label for="exampleInputEmail1" class="mb-2">Area:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example" id="selArea" name="selArea">
                                            <option selected>Seleccione el Área</option>
                                            <option value="1">Estadistica</option>
                                            <option value="2">Soporte</option>
                                            <option value="3">Administracion</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Estado:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example" id="selEstado" name="selEstado">
                                            <option selected>Seleccione el estado</option>
                                            <option value="1">Nuevo</option>
                                            <option value="2">Bueno</option>
                                            <option value="3">Regular</option>
                                            <option value="4">Malo</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">MAC:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="mac" name="mac" placeholder="Ingrese MAC">
                                        <label for="exampleInputEmail1" class="mb-2">IP:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="ip" name="ip" placeholder="Ingrese IP">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/formulario de datos de equipo -->

                        <!--tabla temporal de componentes-->
                        <div class="col-md-8 col-lg-9">
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
                                        <div class="table-responsive">
                                            <table class="table" id="tableModal">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><strong>#</strong></th>
                                                        <th scope="col"><strong># Serie</strong></th>
                                                        <th scope="col"><strong>Tipo</strong></th>
                                                        <th scope="col"><strong>Clase</strong></th>
                                                        <th scope="col"><strong>Marca</strong></th>
                                                        <th scope="col"><strong>Modelo</strong></th>
                                                        <th scope="col"><strong>Capacidad</strong></th>
                                                        <th scope="col"><strong>Estado</strong></th>
                                                        <th scope="col"><strong>Opciones</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbEquipos">
                                                    <tr>
                                                        <td>01</td>
                                                        <td>##########</td>
                                                        <td>tipo 1</td>
                                                        <td>clase 1</td>
                                                        <td>marca 1</td>
                                                        <td>modelo 1</td>
                                                        <td>16 tb</td>
                                                        <td>nuevo</td>
                                                        <td>[ ] [ ] [ ]</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- /fin tabla temporal de componentes -->

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
<!-- Fin del modal  -->

<!--Modal añadir componente-->
<div class="modal fade" id="añadirComponente" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="añadirComponente" aria-hidden="true">
    <div class="modal-dialog" modal-sm>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="añadirComponente">Añadir Componente</h5>
                <button type="button" class="btn-close" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEquipos">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="mb-2"># de Serie:</label>
                                <input type="text" class="form-control mb-2" id="codigo" name="codigo" placeholder="Ingrese el #">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" id="btncerrar">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-coreui-dismiss="modal" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal">Guardar</button>
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
                            <div class="col-lg-10 col-sm-4">Lista de Equipos </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirEquipo" onclick="limpiarFormulario()"><strong>Añadir</strong></button></div>
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
                                    <input type="search" class="form-control" id="inputbuscarEquipos" placeholder="Buscar..." size="14" maxlength="14">
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
                                    <th scope="col"><strong>Area</strong></th>
                                    <th scope="col"><strong>Marca</strong></th>
                                    <th scope="col"><strong>Modelo</strong></th>
                                    <th scope="col"><strong># Serie</strong></th>
                                    <th scope="col"><strong>Magesi</strong></th>
                                    <th scope="col"><strong>IP</strong></th>
                                    <th scope="col"><strong>MAC</strong></th>                                    
                                    <th scope="col"><strong>Estado</strong></th>
                                    <th scope="col"><strong>Alta</strong></th>
                                    <th scope='col'><strong>Acciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbEquipos">
                                <tr>
                                    <td><a href="#" id="href" data-coreui-toggle="modal" data-coreui-target="#añadirEquipo">01</a></td>
                                    <td>Logistica</td>
                                    <td>HP</td>
                                    <td>SCR1023</td>
                                    <td>1544816718</td>
                                    <td>######</td>
                                    <td>192.168.2.145</td>
                                    <td>8d:5f:6c:7a:6b</td>                                    
                                    <td>Bueno</td>
                                    <td>22/10/2022</td>
                                    <td><a href="">DEL</a></td>
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

<script src='../js/equiposAjax.js'></script>

<?php
include '../templates/footer.php';
?>