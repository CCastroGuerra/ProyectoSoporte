<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bajas</title>
</head>
<body>
   <form  method="post">
    <div class="form-group">
        <label for="motivo">Motivo:</label>
        <input type="text" class="form-control" id="motivo" name="motivo">
        <label for="descripcion">Descripcion:</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion">
        <label for="fecha">Fecha:</label>
        <input type="date" class="form-control" id="fecha" name="fecha">

    <button type="submit" class="btn btn-primary">Enviar</button>
    <input type="hidden" name="csrf_token" value="${csrf_token}"/>
    </form>
   
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Motivo</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                
            </tr>
        </thead>
        <tbody id="tbBajas">
            <tr>
            
                
            </tr>
        </tbody>
    </table>

</body>
<script src='../js/bajas.js'></script>
</html>