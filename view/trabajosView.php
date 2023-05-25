<?php
include('../templates/cabecera.php');
?>


<!-- Modal Trabajo-->
<div class="modal fade" id="TrabajoModal" tabindex="-1" aria-labelledby="TrabajoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Trabajos</h5>
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
                                        <div class="visually-hidden" id="divcodigo" name="divcodigo">
                                            <label class="control-label">Código</label>
                                            <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                        </div>
                                        <label for="exampleInputEmail1" class="mb-2"># de Serie:</label>
                                        <input type="text" class="form-control mb-2" id="nroSerie" name="nroSerie" placeholder="Ingrese # de Serie">
                                        <label for="exampleInputEmail1" class="mb-2">Marquesi:</label>
                                        <input type="text" class="form-control mb-2" id="marquesi" name="marquesi" placeholder="Ingrese el Marquesi">
                                        <label for="exampleInputEmail1" class="mb-2">Usuario del Equipo:</label>
                                        <input type="text" class="form-control mb-2" id="nombreUsuario" name="nombreUsuario" placeholder="Ingrese Usuario">
                                        <label for="exampleInputEmail1" class="mb-2">Area:</label>
                                        <select class="form-select" aria-label="Default select example" id="selArea" name="selArea">
                                            <option selected>Selecciona el área</option>
                                            <option value="1">Administración</option>
                                            <option value="2">Adminsion</option>
                                            <option value="3">Laboratorio</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Equipo:</label>
                                        <select class="form-select" aria-label="Default select example" id="selEquipo" name="selEquipo">
                                            <option selected>Selecciona el equipo</option>
                                            <option value="1">Monitor</option>
                                            <option value="2">Laptop</option>
                                            <option value="3">Computadora</option>
                                            <option value="4">Impresora</option>
                                            <option value="5">Otros</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Marca:</label>
                                        <select class="form-select" aria-label="Default select example" id="selMarca" name="selMarca">
                                            <option selected>Seleccione la marca</option>
                                            <option value="1">HP</option>
                                            <option value="2">ASUS</option>
                                            <option value="3">LG</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Modelo:</label>
                                        <select class="form-select" aria-label="Default select example" id="selModelo" name="selModelo">
                                            <option selected>Seleccione el modelo</option>
                                            <option value="1">Elite QP</option>
                                            <option value="2">Asus X555Y</option>
                                            <option value="3">Sentrix N4</option>
                                        </select>
                                        <label for="exampleInputEmail1" class="mb-2">Falla observada:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        <label for="exampleInputEmail1" class="mb-2">Técnico:</label>
                                        <select class="form-select" aria-label="Default select example" id="selTecnico" name="selTecnico">
                                            <option selected>Seleccione el Técnico</option>
                                            <option value="1">Técnico 1</option>
                                            <option value="2">Técnico 2</option>
                                            <option value="3">Técnico 3</option>
                                            <option value="4">Técnico 4</option>
                                        </select>
                                        <label for="exampleFormControlTextarea2" class="form-label">Recomendación:</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea2" rows="3" id="recomendacion" name="recomendacion"></textarea>
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
                                            <h5 class="card-title mb-auto">
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
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle text-center" id="tableModal">
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

                        </div>
                        <!-- /tabla temporal-->
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal" id="btncerrar" name="btncerrar">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-coreui-dismiss="modal">Guardar</button>

                </div>
            </form>
        </div>
    </div>
</div>

<!-- /*Fin del modal Trabajo*/ -->

<!--modal servicios-->
<div class="modal fade" id="ServiciosModal" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="ServiciosModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ServiciosModalLabel">Agregar Servicios</h5>
                <button type="button" class="btn-close" data-coreui-target="#TrabajoModal" data-coreui-toggle="modal" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formServicios">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-form">
                                <label for="exampleInputEmail1" class="mb-2">Servicio:</label>
                                <select class="form-select" aria-label="Default select example" id="selServicio" name="selServicio">
                                    <option selected>Seleccione el Servicio</option>
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
                    <button type="button" class="btn btn-secondary" data-coreui-target="#TrabajoModal" data-coreui-toggle="modal" data-coreui-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-coreui-target="#TrabajoModal" data-coreui-toggle="modal" data-coreui-dismiss="modal">Guardar</button>
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
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Lista Trabajos
                            </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#TrabajoModal">Añadir</button>
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
                                        <select name="tbTrabajos-length" aria-controls="tbTrabajos" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarTrabajo" placeholder="Buscar..." size="14" maxlength="14">
                                </div>
                                </>
                            </div>
                        </div>
                    </div>
                    <!-- /encabezado--->
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">
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
                            <tbody id="tbTrabajos">
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


<!--/contenido ventana -->
<script src="../js/trabajosAjax.js"></script>
<?php
include '../templates/footer.php';
?>