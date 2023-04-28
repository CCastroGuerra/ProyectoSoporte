<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Componentes</title>
</head>
<body>
   <form  method="post">
    <div class="form-group">
        <label for="serie">Serie:</label>
        <input type="text" class="form-control" id="serie" name="serie">
    </div>
    <div class="form-group">
        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
    <input type="hidden" name="csrf_token" value="${csrf_token}"/>
    </form>
   
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Serie</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody id="tbComponentes">
            <tr>
            
                
            </tr>
        </tbody>
    </table>

</body>
<script src='../js/componentes.js'></script>
</html>