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
                                        <label for="exampleInputEmail1" class="mb-2">Codigo:</label>
                                        <input type="text" class="form-control form-control-sm mb-2" id="codigo" name="codigo" placeholder="Ingrese codigo">
                                        <label for="exampleInputEmail1" class="mb-2">Tipo de equipo:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">Impresora</option>
                                            <option value="2">Laptop</option>
                                            <option value="3">Todo en uno</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Marca:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="marca" name="marca" placeholder="Ingrese marca">
                                        <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="modelo" name="modelo" placeholder="Ingrese modelo">
                                        <label for="exampleInputEmail1" class="mb-2">Serie:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="serie" name="serie" placeholder="Ingrese # de serie">
                                        <label for="exampleInputEmail1" class="mb-2">Margesi:</label>
                                        <input type="text" class="form-control  form-control-sm mb-2" id="margesi" name="margesi" placeholder="Ingrese Margesi">
                                        <label for="exampleInputEmail1" class="mb-2">Area:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">Estadisitiaca</option>
                                            <option value="2">Soporte</option>
                                            <option value="3">Administracion</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Estado:</label>
                                        <select class="form-select form-select-sm" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">Bueno</option>
                                            <option value="2">Regular</option>
                                            <option value="3">Malo</option>
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

                            <div class="row ">
                                <div class="col-xs-1-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h3 class="card-title mb-4">
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
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col"><strong>#</strong></th>
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
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /fin tabla temporal de componentes -->
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
<!-- Fin del modal  -->

<!--Modal añadir componente-->
<div class="modal fade" id="añadirComponente" tabindex="-1" aria-labelledby="añadirComponente" aria-hidden="true">
    <div class="modal-dialog" modal-sm>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="añadirComponente">Añadir Componente</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="formAcomponente">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="mb-2">Codigo:</label>
                                <input type="text" class="form-control mb-2" id="codigo" name="codigo" placeholder="Ingrese codigo">

                                <label for="exampleInputEmail1" class="mb-2">Tipo de Componente:</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">CPU</option>
                                    <option value="2">Disco Duro</option>
                                    <option value="3">Memoria RAM</option>
                                </select>

                                <label for="exampleInputEmail1" class="mb-2">Clase de Componente </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Clase 1</option>
                                    <option value="2">Clase 2</option>
                                    <option value="3">Clase 3</option>
                                </select>

                                <label for="exampleInputEmail1" class="mb-2">Marca </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Clase 1</option>
                                    <option value="2">Clase 2</option>
                                    <option value="3">Clase 3</option>
                                </select>

                                <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                <input type="text" class="form-control mb-2" id="modelo" name="modelo" placeholder="Ingrese modelo">

                                <label for="exampleInputEmail1" class="mb-2"># Serie:</label>
                                <input type="text" class="form-control mb-2" id="serie" name="serie" placeholder="Ingrese serie">

                                <label for="exampleInputEmail1" class="mb-2">Capacidad:</label>
                                <input type="text" class="form-control mb-2" id="capacidad" name="capacidad" placeholder="Ingrese capacidad">

                                <label for="exampleInputEmail1" class="mb-2">Estado: </label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
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
                    <button type="button" class="btn btn-secondary" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
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
                    <h3 class="card-title mb-4">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista de Equipos </div>
                            <div class="col-lg-2 col-sm-4 text-end"><button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirEquipo"><strong>Añadir</strong></button></div>
                        </div>
                    </h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Marca</span>
                                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon1" name="txtBuscarMarca" id="txtBuscarMarca">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon2">Área</span>
                                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Margesi</span>
                                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-1-12">
            <div class="card">
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
                                <th scope="col"><strong>Estado</strong></th>
                                <th scope="col"><strong>IP</strong></th>
                                <th scope="col"><strong>MAC</strong></th>
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
                                <td>Bueno</td>
                                <td>192.168.2.145</td>
                                <td>8d:5f:6c:7a:6b</td>
                                <td>22/10/2022</td>
                                <td><a href="">DEL</a></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='../js/equiposAjax.js'></script>

<?php
include '../templates/footer.php';
?>