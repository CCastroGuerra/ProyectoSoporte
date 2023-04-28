var valorBuscar="";
var numPagina=1;
buscar();
var frmRol = document.getElementById('frmRoles');
//Validacion para campos vacios
frmRol.onsubmit = function(e){
  
    //console.log('Me diste click');
    var nombreRol = document.getElementById('nombreRol').value;
    e.preventDefault();
    if(nombreRol.length > 0){
        guardar();

    }else{
        mensaje = 'Complete los campos ';
        aviso.innerHTML=`
        <div style="color: red; class="alert alert-success alert-link" id="msjalerta" role="alert">
        <span class="alert-dismissible">${mensaje}</span>
        </div>
        `;
    }
    
};

function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/rolesModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const roles = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(roles.length > 0){
            roles.forEach(function(roles) {
                template += `
                <tr>
                    <td>${roles.id}</td>
                    <td>${roles.nombre}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbRoles");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}
function guardar(){
    var aviso = document.getElementById('aviso');
    var realizado ="";
    var mensaje ="";
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/roles.php', true); 
    var data = new FormData(frmRol);
    data.append('accion','guardar');
    console.log(data.get('nombreRol'));
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
       realizado = ajax.responseText;
       //console.log(realizado);
        if((realizado*1)>0){
            mensaje = 'Rol registrado correctamente';
            aviso.innerHTML=`
            <div style="color: green;  class="alert alert-success alert-link" id="msjalerta" role="alert">
            <span class="alert-dismissible">${mensaje}</span>
            </div>`
            
            
        }else{
            mensaje = 'Error al registrar el rol';
            aviso.innerHTML=`
            <div  class="alert alert-success alert-link" id="msjalerta" role="alert">
            <span class="alert-dismissible">${mensaje}</span>
            </div>
            `;
        }
        buscar();
        frmRol.reset();

      
    }
    ajax.send(data);
}
