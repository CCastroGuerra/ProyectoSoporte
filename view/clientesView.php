<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>
<body>
   <form  method="post">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">
        <label for="apellidos">Apellidos:</label>
        <input type="text" class="form-control" id="apellidos" name="apellidos">
        <label for="correo">Correo:</label>
        <input type="text" class="form-control" id="correo" name="correo">
        <label for="telefono">Telefono:</label>
        <input type="text" class="form-control" id="telefono" name="telefono">

    <button type="submit" class="btn btn-primary">Enviar</button>
    <input type="hidden" name="csrf_token" value="${csrf_token}"/>
    </form>
   
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody id="tbClientes">
            <tr>
            
                
            </tr>
        </tbody>
    </table>

</body>
<script src='../js/clientes.js'></script>
</html>