var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/inventarioModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const inventario = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(inventario.length > 0){
            inventario.forEach(function(inventario) {
                template += `
                <tr>
                    <td>${inventario.id}</td>
                    <td>${inventario.cantidad}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbInventario");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}