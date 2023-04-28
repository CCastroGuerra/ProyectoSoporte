<?php
include('../templates/cabecera.php');
?>
<div class="col-lg-12 ">
    <div class="col-xs-1-12">
        <div class="card">
            <div class="card-body">
                <label for="exampleInputEmail1" class="mb-2">Inventario:</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar Producto" aria-label="Recipient's username" aria-describedby="button-addon2" name="txtBuscarArea" id="txtBuscarArea">
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><strong>#</strong></th>
                            <th scope="col"><strong>Producto</strong></th>
                            <th scope="col"><strong>Cantidad</strong></th>
                        </tr>
                    </thead>
                    <tbody id="tbArea">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="../js/inventarioAjax.js"></script>
<?php
include '../templates/footer.php';
?>