var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/permisosModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const permisos = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(permisos.length > 0){
            permisos.forEach(function(permisos) {
                template += `
                <tr>
                    <td>${permisos.id}</td>
                    <td>${permisos.nombre}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbPermisos");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}
