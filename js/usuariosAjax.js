var valorBuscar="";
var numPagina=1;
buscar();
function buscar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/usuariosModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const usuarios = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(usuarios.length > 0){
            usuarios.forEach(function(usuarios) {
                template += `
                <tr>
                    <td>${usuarios.id}</td>
                    <td>${usuarios.nombre}</td>
                </tr>
                `;
                var elemento = document.getElementById("tbUsuarios");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}