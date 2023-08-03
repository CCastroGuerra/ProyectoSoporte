<?php
include('../templates/cabecera.php');
?>

<!-- modal responsable -->
<div class="modal" tabindex="-1" id="responsableModal" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Responsable</h5>
                <button type="button" class="btn-close" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="formResponsable">
                    <div class="form-group">
                        <div class="form-group visually-hidden" id="divmargesi" name="divmargesi">
                            <label for="margesiRef" class="control-label">ID</label>
                            <input type="text" class="form-control" id="margesiRef" name="margesiRef" placeholder="ID" readonly>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="input-group mb-3">
                                    <input type="search" class="form-control" placeholder="Busca al responsable" aria-label="busca_resp" id="buscaRes" name="buscaRes" aria-describedby="button-addon2" size="10" maxlength="10">

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Código</strong></th>
                                    <th scope="col"><strong>Nombre</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbresp">
                                <tr>
                                    <td>#</td>
                                    <td>Nombre ##</td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Paginador Inicio -->
                        <div class="row paginador">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <button id="btnPrimeroPre" class="btn btn-outline-info"><i class="fa fa-backward"></i></button>
                                <button id="btnAnteriorPre" class="btn btn-outline-info"><i class="fa fa-caret-left"></i></button>
                                <input type="text" id="txtPagVistaPre" class="cuadrosPaginas" readonly>
                                <label for="txtPagVistaPre">&nbsp;de&nbsp;</label>
                                <input type="text" id="txtPagTotalPre" class="cuadrosPaginas" readonly>
                                <label for="txtPagTotalPre">&nbsp;paginas.&nbsp;</label>
                                <button id="btnSiguientePre" class="btn btn-outline-info"><i class="fa fa-caret-right"></i></button>
                                <button id="btnUltimoPre" class="btn btn-outline-info"><i class="fa fa-forward"></i></button>
                            </div>
                        </div>
                        <!-- Paginador Final -->
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btncerrar" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" id="btncerrarResp">Cerrar</button>
            </div>

        </div>
    </div>
</div>
<!-- /modal responsable -->
<!-- estilos css -->
<style>
    .pdf-button {
        display: inline-block;
        /* align-items: center;
        justify-content: center; */
        padding: 10px 20px;
        background-color: #d72121;
        color: #fff;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        font-size: 16px;
    }
</style>

<!-- fin de estilos -->

<!-- Modal  añadir equipo-->
<div class="modal fade" id="añadirEquipo" tabindex="-1" data-coreui-backdrop="static" data-coreui-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Añadir Equipo</h5>
                <button id="cerrarSup" name="cerrarSup" type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
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
                                            <label for="inputCodigo" class="control-label">Código</label>
                                            <input type="text" class="form-control" id="inputCodigo" name="inputCodigo" placeholder="Código" readonly>
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="nomEquipo" class="mb-2">Nombre Equipo:</label>
                                            <input type="text" class="form-control form-control-sm mb-2" id="nomEquipo" name="nomEquipo" placeholder="PC-000">
                                            <small class="alerta" id="alertaUSL"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="selTipoEquipo" class="mb-2">Tipo de equipo:</label>
                                            <select class="form-select form-select-sm mb-2" aria-label="Default select example" id="selTipoEquipo" name="selTipoEquipo">
                                                <option selected>Seleccione el tipo</option>
                                                <option value="1">Impresora</option>
                                                <option value="2">Laptop</option>
                                                <option value="3">Todo en uno</option>
                                            </select>
                                            <small class="alerta" id="alertaTipo"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="serie" class="mb-2">Serie:</label>
                                            <input type="text" class="form-control form-control-sm mb-2" id="serie" name="serie" placeholder="Ingrese # de serie" maxlength="16">
                                        </div>

                                        <div class="form-group">
                                            <label for="margesi" class="mb-2">Margesi:</label>
                                            <input type="text" class="form-control form-control-sm mb-2" id="margesi" name="margesi" placeholder="Ingrese Margesi" maxlength="12">
                                            <small class="alerta" id="alertaMargesi"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="selMarcaEquipo" class="mb-2">Marca:</label>
                                            <select class="form-select form-select-sm mb-2" aria-label="Default select example" id="selMarcaEquipo" name="selMarcaEquipo">
                                                <option selected>Seleccione la marca</option>
                                                <option value="1">Marca 1</option>
                                                <option value="2">Marca 2</option>
                                                <option value="3">Marca 3</option>
                                            </select>
                                            <small class="alerta" id="alertaMarca"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="selModeloEquipo" class="mb-2">Modelo:</label>
                                            <select class="form-select form-select-sm mb-2" aria-label="Default select example" id="selModeloEquipo" name="selModeloEquipo">
                                                <option selected>Seleccione el modelo</option>
                                                <option value="1">Modelo 1</option>
                                                <option value="2">Modelo 2</option>
                                                <option value="3">Modelo 3</option>
                                            </select>
                                            <small class="alerta" id="alertaModelo"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="responsable" class="mb-2">Responsable:</label>
                                            <button type="button" class="btn btn-outline-primary visually-hidden" data-coreui-toggle="modal" data-coreui-target="#responsableModal"></button>
                                            <input type="text" class="form-control  form-control-sm mb-2" id="responsable" name="responsable" placeholder="Seleccione responsable" data-coreui-toggle="modal" data-coreui-target="#responsableModal" readonly>
                                            <input type="text" id="respValue" name="respValue" class="form-control  form-control-sm mb-2 visually-hidden">
                                        </div>
                                        <div class="form-group">
                                            <label for="selArea" class="mb-2">Area:</label>
                                            <select class="form-select form-select-sm mb-2" aria-label="Default select example" id="selArea" name="selArea">
                                                <option selected>Seleccione el Área</option>
                                                <option value="1">Estadistica</option>
                                                <option value="2">Soporte</option>
                                                <option value="3">Administracion</option>
                                            </select>
                                            <small class="alerta" id="alertaArea"></small>
                                        </div>
                                        <div class="form-group"><label for="selEstado" class="mb-2">Estado:</label>
                                            <select class="form-select form-select-sm mb-2" aria-label="Default select example" id="selEstado" name="selEstado">
                                                <option selected>Seleccione el estado</option>
                                                <option value="1">Nuevo</option>
                                                <option value="2">Bueno</option>
                                                <option value="3">Regular</option>
                                                <option value="4">Malo</option>
                                                <option value="5">En Reparación</option>
                                            </select>
                                            <small class="alerta" id="alertaEstado"></small>
                                        </div>
                                        <div class="form-group">
                                            <label for="mac" class="mb-2">MAC:</label>
                                            <input type="text" class="form-control form-control-sm mb-2" id="mac" name="mac" placeholder="Ingrese MAC ##:##:##:##:##:##">
                                        </div>
                                        <div class="form-group">
                                            <label for="ip" class="mb-2">IP:</label>
                                            <input type="text" class="form-control form-control-sm mb-2" id="ip" name="ip" placeholder="Ingrese IP ###.###.###.###">
                                            <small class="alerta" id="alertaIP"></small>
                                        </div>

                                        <div class="form-group">
                                            <label for="usLocal" class="mb-2">Usuario Local:</label>
                                            <input type="text" class="form-control form-control-sm mb-2" id="usLocal" name="usLocal" placeholder="[AREA]-PC##/HLMP">
                                            <small class="alerta" id="alertaUSL"></small>
                                        </div>



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
                                                <div class="col-lg-2 col-sm-4 text-end">
                                                    <button type="submit" class="btn btn-outline-primary" id="btnComponente" name="btnComponente" data-coreui-toggle="modal" data-coreui-target="#añadirComponente"><strong>Añadir</strong></button>
                                                </div>
                                            </div>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-1-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover align-middle" id="tableModal">
                                                <thead>
                                                    <tr>

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
                                                <tbody id="tbComponentes">

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
                    <button type="button" id="cerrarBot" name="cerrarBot" class="btn btn-secondary btncerrar" data-coreui-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btmGuardar">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin del modal  -->

<!--Modal añadir componente-->
<div class="modal fade" id="añadirComponente" data-coreui-backdrop="static" data-coreui-keyboard="false" tabindex="-1" aria-labelledby="añadirComponente" aria-hidden="true" aria-modal="true">
    <div class="modal-dialog" modal-sm>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="añadirComponentetitle">Añadir Componente</h5>
                <button type="button" class="btn-close" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEquipos">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="codigo" class="mb-2"># de Serie:</label>
                                <input type="text" class="form-control mb-2" id="codigo" name="codigo" placeholder="Ingrese el #" maxlength="16">
                                <small class="alerta" id="alertaMcomp"></small>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btncerrar" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" id="btncerrarcomp">Cerrar</button>
                    <button type="submit" class="btn btn-primary" data-coreui-dismiss="modal" data-coreui-target="#añadirEquipo" data-coreui-toggle="modal" id="btmcomp">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Fin del modal  -->

<!-- Tabla -->
<div class="col-md-12 col-lg-12" style="padding-left: 0px;    padding-right: 0px;">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-9 col-sm-8">Lista de Equipos </div>
                            <div class="col-lg-3 col-sm-4 text-end row">
                                <!-- Boton para generar pdf -->
                                <div class="text-center col-lg-6 col-sm-6 ">
                                    <a href="reportesEquipos.php" class="pdf-button" target="_blank">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <!--  -->
                                <div class="text-center col-lg-6 col-sm-6">
                                    <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#añadirEquipo" onclick="" id="btmodal"><strong>Añadir</strong></button>
                                </div>
                            </div>
                        </div>
                    </h3>
                </div>
            </div>
        </div>
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body" style="padding-left: 8px;padding-right: 8px;">
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
                                    <input type="search" class="form-control" id="inputbuscarEquipos" placeholder="Buscar..." size="14" maxlength="14">
                                </div>
                                </>
                            </div>
                        </div>
                    </div>
                    <!-- /encabezado--->

                    <div class="table-responsive-xxl">
                        <table class="table table-hover align-middle table-sm">
                            <thead>
                                <tr>
                                    <th scope="col"><strong>Codigo</strong></th>
                                    <th scope="col"><strong>Area</strong></th>
                                    <th scope="col"><strong>Marca</strong></th>
                                    <th scope="col"><strong>Modelo</strong></th>
                                    <th scope="col"><strong># Serie</strong></th>
                                    <th scope="col"><strong>Magesi</strong></th>
                                    <th scope="col"><strong>IP</strong></th>
                                    <th scope="col"><strong>MAC</strong></th>
                                    <th scope="col"><strong>Estado</strong></th>
                                    <th scope="col"><strong>Fecha</strong></th>
                                    <th scope='col'><strong>Acciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbEquipos">

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

<script src='../js/equiposAjax.js'></script>
<script src="../js/sesionAjax.js"></script>


<?php
include '../templates/footer.php';
?>