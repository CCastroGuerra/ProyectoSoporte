var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/trabajosModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const trabajos = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(trabajos.length > 0){
            trabajos.forEach(function(trabajos) {
                template += `
                <tr>
                    <td>${trabajos.id}</td>
                    <td>${trabajos.nombre}</td>
                    <td>${trabajos.descripcion}</td>
                </tr>
                `;
                var elemento = document.getElementById("tbTrabajos");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}