<?php
include('../templates/cabecera.php');
?>
<!--Modal añadirEmpleado-->
<div class="modal fade" id="añadirEmpleado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Personal</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="frmEmpleados">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="mb-2">Apellidos:</label>
                                <input type="text" class="form-control form-control-sm mb-2" id="codigo" name="codigo" placeholder="Ingrese codigo">
                                <label for="exampleInputEmail1" class="mb-2">Nombre:</label>
                                <input type="text" class="form-control  form-control-sm mb-2" id="marca" name="marca" placeholder="Ingrese marca">
                                <label for="exampleInputEmail1" class="mb-2">Cargo:</label>
                                <select class="form-select form-select-sm" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Impresora</option>
                                    <option value="2">Laptop</option>
                                    <option value="3">Todo en uno</option>
                                </select>
                                <label for="exampleInputEmail1" class="mb-2">Usuario:</label>
                                <input type="text" class="form-control  form-control-sm mb-2" id="modelo" name="modelo" placeholder="Ingrese modelo">
                                <label for="exampleInputEmail1" class="mb-2">Contraseña:</label>
                                <input type="text" class="form-control  form-control-sm mb-2" id="serie" name="serie" placeholder="Ingrese # de serie">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirEmpleado">
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
                            <div class="col-lg-10 col-sm-4">
                                <div class="table-length my-1 text-start">
                                    <label>Mostrar
                                        <select name="tablaAreas_length" aria-controls="tablaAreas">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <div class="mb-2">
                                    <input type="search" class="form-control" id="inputbuscarArea" placeholder="Buscar..." size="14" maxlength="14">
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
                                    <th scope="col"><strong>Apellidos</strong></th>
                                    <th scope="col"><strong>Nombre</strong></th>
                                    <th scope="col"><strong>Cargo</strong></th>
                                    <th scope="col"><strong>Usuario</strong></th>
                                    <th scope="col"><strong>Contraseña</strong></th>
                                    <th scope='col'><strong>Acciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbEquipos">
                                <tr>
                                    <td scope="col">01</td>
                                    <td scope="col">Viera Burneo</td>
                                    <td scope="col">Cristian</td>
                                    <td scope="col">Practicante</td>
                                    <td scope="col">CrisVieraB</td>
                                    <td scope="col">
                                        <form><input type="password" id="contra-01" value="contraseña" size=7 disabled autocomplete="on"></form>
                                    </td>
                                    <td scope="col"><a onclick="var x = document.getElementById('contra-01');if (x.type=='password') {x.setAttribute('type','text')} else{x.setAttribute('type','password');}">DEL</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>


<script src='../js/equiposAjax.js'></script>

<?php
include '../templates/footer.php';
?>