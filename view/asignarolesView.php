<?php
include('../templates/cabecera.php');
?>
<script type="text/javascript">
    var rolespermitidos=['1'];
    var ro= document.getElementById("sessRol");
    

if(!rolespermitidos.includes(ro.dataset.sess)){
    window.location.replace("../index.php");
}
</script>
<!-- Modal Roles -->
<div class="modal fade" id="rolesModal" tabindex="-1" data-coreui-backdrop="static" data-coreui-keyboard="false"  aria-labelledby="rolesModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Roles</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formARoles">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="visually-hidden">
                                    <label for="inputCodigo" class="control-label">Código</label>
                                    <input type="text" class="form-control" id="inputCodigo" placeholder="Código" readonly>

                                </div>
                                <div class="form-group">
                                    <label for="inputDni" class="mb-2">DNI:</label>
                                    <div id="nombreEmpleado"></div>
                                    <input type="text" class="form-control mb-2" id="inputDni" name="inputDni" placeholder="Ingrese DNI" maxlength="8">
                                    <small class="alerta" id="alerta1"></small>
                                </div>
                                <div class="form-group">
                                    <label for="selAroles" class="mb-2">Rol:</label>
                                    <select class="form-select" aria-label="ARoles" id="selAroles" name="selAroles">
                                        <option selected>Seleccione el rol</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Técnico</option>
                                        <option value="3">Secretaria</option>
                                    </select>
                                    <small class="alerta" id="alerta2"></small>
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
<!-- /*Fin del modal roles*/ -->

<!--Contenido-->
<div class="col-md-12 col-lg-12 ">
    <div class="row ">
        <div class="col-xs-1-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title mb-auto">
                        <div class="row">
                            <div class="col-lg-10 col-sm-6">Asignación de Roles </div>
                            <div class="col-lg-2 col-sm-4 text-end">
                                <button type="button" class="btn btn-outline-primary" data-coreui-toggle="modal" data-coreui-target="#rolesModal" onclick=""><strong>Añadir</strong></button>
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
                                        <select name="tbRoles-length" aria-controls="tbRoles" id="numRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                        </select>
                                        Entradas</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 text-end">
                                <div class="mb-auto">
                                    <input type="search" class="form-control" id="inputbuscarARoles" placeholder="Buscar..." size="14" maxlength="14">
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
                                    <th scope="col"><strong>Nombre</strong></th>
                                    <th scope="col"><strong>Apellidos</strong></th>
                                    <th scope="col"><strong>Rol</strong></th>
                                    <th scope="col"><strong>Opciones</strong></th>
                                </tr>
                            </thead>
                            <tbody id="tbRoles">
                                <tr>
                                    <td>Nombre 1</td>
                                    <td>Apellidos 1</td>
                                    <td>Rol 1</td>
                                    <td>[] [] []</td>
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
<!--/Contenido-->
<script src="../js/limpiarForm.js"></script>
<script src="../js/asignarRolesAjax.js"></script>
<?php
include '../templates/footer.php';
?>