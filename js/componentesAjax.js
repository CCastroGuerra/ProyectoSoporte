var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/componentesModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const componentes = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(componentes.length > 0){
            componentes.forEach(function(componentes) {
                template += `
                <tr>
                    <td>${componentes.id}</td>
                    <td>${componentes.serie}</td>
                    <td>${componentes.fecha_alta}</td>                
                </tr>
                `;
                var elemento = document.getElementById("tbComponentes");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}