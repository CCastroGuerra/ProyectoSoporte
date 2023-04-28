var valorBuscar="";
var numPagina=1;
var cantidadFilas = 0;
var linkEditar ="";
var linkBorrar= "";
listar();

var formulario = document.getElementById('frmMarca');
var respuesta = document.getElementById("alerta");



/* Control de campos vacios*/
frmMarca.onsubmit = function (e) {
    var nombre = document.getElementById("nombreMarca").value;
    e.preventDefault();
    console.log(nombre);
    if (nombre.length > 0) {
      guardar();
    } else {
      mensaje = "Completa los campos";
      respuesta.innerHTML = `
      <div class="alert alert-danger" role="alert id="alerta"">
      ${mensaje}
      </div
          `;
    }
  };

function listar(){
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../model/marcaModel.php', true); 
    var data = new FormData();
    data.append('accion','listar');
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    ajax.onload=function(){
        //Se guarda la respuesta del servidor
        let respuesta = ajax.responseText;
        const marca = JSON.parse(respuesta);
        let template = ""; // Estructura de la tabla html
        if(marca.length > 0){
            marca.forEach(function(marca) {
                template += `
                <tr>
                    <td>${marca.id}</td>
                    <td>${marca.nombre}</td>
                    <td><button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-fila = "${marca.id}">Editar</button>
                    <button type="button" class="btn btn-danger" data-fila = "${marca.id}">Borrar</button></td>
                
                </tr>
                `;
                var elemento = document.getElementById("tbMarca");
                elemento.innerHTML = template;
            });
        }
      
    }
    ajax.send(data);
   


}

/* Insertar registros */
function guardar() {
    var respuesta = document.getElementById("alerta");
    var realizado = "";
    var mensaje = "";
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open("POST", "../model/marcaModel.php", true);
    var data = new FormData(frmMarca);
    data.append("accion", "guardar");
    // daa[]
    //Funcion onload, se ejecuta cuando recibe respuesta del servidor
    //console.log(data.nombre);
    ajax.onload = function () {
      realizado = ajax.responseText;
      console.log(realizado);
      if (realizado * 1 > 0) {
        mensaje = "Se registro correctamente";
        respuesta.innerHTML = `
              <div class="alert alert-success" role="alert id="alerta"">
              ${mensaje}
              </div>
              `;
      } else {
        mensaje = "No se registro correctamente";
        respuesta.innerHTML = `
        <div class="alert alert-danger" role="alert id="alerta"">
        ${mensaje}
        </div
              `;
      }
      buscar();
      frmMarca.reset();
    };
    ajax.send(data);
  }

  //Buscar elementos
let campoBusqueda = document.getElementById("txtBuscarMarca");
campoBusqueda.addEventListener("keyup", function(e){
    var valor = campoBusqueda.value;
    console.log(valor);
    valorBuscar ="where nombre_marca like '%"+valor+"%'";
    numPagina = 1;
    cantidadFilas = 3;
    listar(valorBuscar,numPagina,cantidadFilas);


});

/********Buscar en tabla*/
function buscar(valor = '',pagina = 1, cantidad = 3){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', '../model/marcaModel.php', true);
    var data = new FormData();

    data.append('valor',valor);
    data.append('pagina',pagina);
    data.append('cantidad',cantidad);
    data.append('accion','buscar');
    ajax.onload = function(){
        let respuesta = ajax.responseText;
        const datos = JSON.parse(respuesta);
        let marca = datos.listado;
        console.log(respuesta);
        console.log(datos);
        let template = "";

        if (marca !== 'vacio'){
         marca.forEach(function (marca){
                template +=  `
                <tr>
                    <td>${marca.id}</td>
                    <td>${marca.nombre}</td>
                    <td><button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-fila = "${marca.id}">Editar</button>
                    <button type="button" class="btn btn-danger" data-fila = "${marca.id}">Borrar</button></td>

                    
                
                </tr>
                `;

            });
            var elemento = document.getElementById("tbMarca");
            elemento.innerHTML = template;
        }else{
            var aviso = document.getElementById("alerta");
            aviso.innerHTML = `No se encontraron datos`;
        }
        
        
    }
    ajax.send(data);
}