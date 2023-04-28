var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/clientesModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const clientes = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(clientes.length > 0){
            clientes.forEach(function(clientes) {
                template += `
                <tr>
                    <td>${clientes.id}</td>
                    <td>${clientes.nombre}</td>
                    <td>${clientes.apellidos}</td>
                    <td>${clientes.correo}</td>
                    <td>${clientes.telefono}</td>
                </tr>
                `;
                var elemento = document.getElementById("tbClientes");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}