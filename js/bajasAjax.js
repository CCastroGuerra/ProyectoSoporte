var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/bajasModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const bajas = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(bajas.length > 0){
            bajas.forEach(function(bajas) {
                template += `
                <tr>
                    <td>${bajas.id}</td>
                    <td>${bajas.motivo}</td>
                    <td>${bajas.descripcion}</td>
                    <td>${bajas.fecha}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbBajas");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}