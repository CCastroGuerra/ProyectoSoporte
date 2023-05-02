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
            <div class="modal-body">
                <form id="frmEmpleados">
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
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
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
                    <h3 class="card-title mb-4">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista del Personal </div>
                            <div class="col-lg-2 col-sm-5 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirEmpleado">
                                    <strong>Añadir</strong>
                                </button>
                            </div>
                        </div>
                    </h3>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon1">Nombre</span>
                                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon1" name="txtBuscarMarca" id="txtBuscarMarca">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="basic-addon2">Apellidos</span>
                                <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
                            </div>
                        </div>
                        <div class="col-md-3">

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
                                <td><a href="#" id="href" data-coreui-toggle="modal" data-coreui-target="#ModalName">01</a></td>
                                <td>Viera Burneo</td>
                                <td>Cristian</td>
                                <td>Practicante</td>
                                <td>CrisVieraB</td>
                                <td><form><input type="password" id="contra-01" value="contraseña" size=11 disabled autocomplete="on"></form></td>
                                <td><a onclick="var x = document.getElementById('contra-01');if (x.type=='password') {x.setAttribute('type','text');} else{x.setAttribute('type','password');}">DEL</a></td>
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