<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permisos</title>
</head>
<body>
   <form  method="post">
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control" id="nombre" name="nombre">

    <button type="submit" class="btn btn-primary">Enviar</button>
    <input type="hidden" name="csrf_token" value="${csrf_token}"/>
    </form>
   
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Permisos</th>
                
            </tr>
        </thead>
        <tbody id="tbPermisos">
            <tr>
            
                
            </tr>
        </tbody>
    </table>

</body>
<script src='../js/permisos.js'></script>
</html>