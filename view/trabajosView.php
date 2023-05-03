<?php
include('../templates/cabecera.php');
?>


<!-- Modal Trabajo-->
<div class="modal fade" id="TrabajoModal" tabindex="-1" aria-labelledby="TrabajoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Trabajos</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="frmTrabajoa">
                <div class="modal-body">
                    <div class="row">
                        <!--formulario cabecera-->
                        <div class="col-md-4 col-lg-3 ">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1" class="mb-2">Usuario:</label>
                                        <input type="text" class="form-control mb-2" id="nombreUsuario" name="nombreUsuario" placeholder="Ingrese Usuario">
                                        <label for="exampleInputEmail1" class="mb-2">Area:</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Selecciona el área</option>
                                            <option value="1">Administración</option>
                                            <option value="2">Adminsion</option>
                                            <option value="3">Laboratorio</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Equipo:</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Selecciona el equipo</option>
                                            <option value="1">Monitor</option>
                                            <option value="2">Laptop</option>
                                            <option value="3">Computadora</option>
                                            <option value="4">Impresora</option>
                                            <option value="5">Otros</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Marca:</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Seleccione la marca</option>
                                            <option value="1">HP</option>
                                            <option value="2">ASUS</option>
                                            <option value="3">LG</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Seleccione el modelo</option>
                                            <option value="1">Elite QP</option>
                                            <option value="2">Asus X555Y</option>
                                            <option value="3">Sentrix N4</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2"># de Serie:</label>
                                        <input type="text" class="form-control mb-2" id="nroSerie" name="nroSerie" placeholder="Ingrese # de Serie">
                                        <label for="exampleInputEmail1" class="mb-2">Marquesi:</label>
                                        <input type="text" class="form-control mb-2" id="marquesi" name="marquesi" placeholder="Ingrese el Marquesi">
                                        <label for="exampleInputEmail1" class="mb-2">Falla observada:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        <label for="exampleInputEmail1" class="mb-2">Tecnico:</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">Técnico 1</option>
                                            <option value="2">Técnico 2</option>
                                            <option value="3">Técnico 3</option>
                                            <option value="4">Técnico 4</option>
                                        </select>
                                        <label for="exampleFormControlTextarea2" class="form-label">Recomendación:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea2" rows="3"></textarea>
                                        <div id="alerta"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="card">

                            </div>
                        </div>
                        <!-- /formulario cabecera-->

                        <!--tabla temporal-->
                        <div class="col-md-8 col-lg-9">
                            <div class="row ">
                                <div class="col-xs-1-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title mb-4">
                                                <div class="row">
                                                    <div class="col-lg-10 col-sm-4">Servicios Aplicados </div>
                                                    <div class="col-lg-2 col-sm-4 text-end">
                                                        <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#ServiciosModal"><strong>Añadir</strong></button>
                                                    </div>
                                                </div>
                                            </h5>
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
                                                        <th scope="col"><strong>Servicio</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbEquipos">
                                                    <tr>
                                                        <td>01</td>
                                                        <td>formateo</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /tabla temporal-->
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

<!-- /*Fin del modal Trabajo*/ -->

<!--modal servicios-->
<div class="modal fade" id="ServiciosModal" tabindex="-1" aria-labelledby="ServiciosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ServiciosModalLabel">Servicios</h5>
                <button type="button" class="btn-close" data-coreui-target="#TrabajoModal" data-coreui-toggle="modal" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formServicios">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-form">
                                <label for="exampleInputEmail1" class="mb-2">Servicio:</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">Servicio 1</option>
                                    <option value="2">Servicio 2</option>
                                    <option value="3">Servicio 3</option>
                                    <option value="4">Servicio 4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-coreui-target="#TrabajoModal" data-coreui-toggle="modal" data-coreui-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--/modal servicios-->

<!--contenido ventana-->
<div class="col-md-8 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-4">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista Trabajos
                            </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#TrabajoModal">Añadir</button>
                            </div>
                        </div>
                    </h3>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Buscar Área" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
                    </div>

                </div>
            </div>
        </div>


        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>#</strong></th>
                                    <th scope="col"><strong># Serie</strong></th>
                                    <th scope="col"><strong>Marquesi</strong></th>
                                    <th scope="col"><strong>Usuario</strong></th>
                                    <th scope="col"><strong>Area</strong></th>
                                    <th scope="col"><strong>Técnico</strong></th>
                                    <th scope="col"><strong>Fecha</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbArea">
                                <tr>
                                    <td>01</td>
                                    <td>48961871</td>
                                    <td>14768498</td>
                                    <td>Usuario</td>
                                    <td>Administración</td>
                                    <td>Técnico 1</td>
                                    <td>27/04/2023</td>
                                    <td>[][][]</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
<!--/contenido ventana -->
<script src="../js/trabajosAjax.js"></script>
<?php
include '../templates/footer.php';
?>