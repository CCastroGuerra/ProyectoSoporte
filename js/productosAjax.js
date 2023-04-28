var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/productosModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const productos = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(productos.length > 0){
            productos.forEach(function(productos) {
                template += `
                <tr>
                    <td>${productos.id}</td>
                    <td>${productos.nombre_productos}</td>
                    <td>${productos.cantidad}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbProductos");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);


}