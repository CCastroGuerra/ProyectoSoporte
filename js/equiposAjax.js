var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/equiposModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const equipos = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(equipos.length > 0){
            equipos.forEach(function(equipos) {
                template += `
                <tr>
                    <td>${equipos.id}</td>
                    <td>${equipos.codigo}</td>
                    <td>${equipos.ip}</td>
                    <td>${equipos.mac}</td>
                    <td>${equipos.fecha}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbEquipos");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}