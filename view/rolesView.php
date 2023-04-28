<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
</head>
<body>
   <form  method="post" id="frmRoles">
    <div class="form-group">
        <label for="nombreRol">Nombre Rol :</label>
        <input type="text" class="form-control" id="nombreRol" name="nombreRol" >

    <button type="submit" class="btn btn-primary">Enviar</button>
    <input type="hidden" name="csrf_token" value="${csrf_token}"/>
    </form>
    <div id="aviso" ">
      
    </div>

    
   
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Rol</th>
                
            </tr>
        </thead>
        <tbody id="tbRoles">
            <tr>
            
                
            </tr>
        </tbody>
    </table>

  

</body>
<script src='../js/roles.js'></script>
</html>