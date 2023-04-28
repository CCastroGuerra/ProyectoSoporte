var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/modeloModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const modelo = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(modelo.length > 0){
            modelo.forEach(function(modelo) {
                template += `
                <tr>
                    <td>${modelo.id}</td>
                    <td>${modelo.nombre}</td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbModelo");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}