var valorBuscar = "";
var numPagina = 1;
var cantidadFilas = 0;
var linkEditar ="";
var linkBorrar= "";
buscar('',1,4);
//listar();
var formArea = document.getElementById("frmArea");
var respuesta = document.getElementById("alerta");

/* Control de campos vacios*/
formArea.onsubmit = function (e) {
  var nombre = document.getElementById("nombreArea").value;
  e.preventDefault();
  // console.log(nombre);
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
/*Listar datos */
function listar() {
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData();
  //data.append("accion", "listar");
  data.append('accion','listar');
  data.append('valor','');
  data.append('pagina','1');
  data.append('cantidad','4');
  //Funcion onload, se ejecuta cuando recibe respuesta del servidor
  ajax.onload = function () {
    //Se guarda la respuesta del servidor
    let respuesta = ajax.responseText;
    const area = JSON.parse(respuesta);
    console.log(area);
    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      area.forEach(function (area) {
        template += `
                <tr>
                    <td>${area.id}</td>
                    <td>${area.nombre}</td>
                    <td><button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-fila = "${area.id}">Editar</button>
                    <button type="button" class="btn btn-danger" data-fila = "${area.id}">Borrar</button></td>

                    
                
                </tr>
                `;
       
        seleccionar();

      });

      var elemento = document.getElementById("tbArea");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}
/* Insertar registros */
function guardar() {
  // var respuesta = document.getElementById("alerta");
  var realizado = "";
  var mensaje = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData(formArea);
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
    formArea.reset();
  };
  ajax.send(data);
}


/* **********Terminar */
function seleccionar(){
    linkEditar = document.querySelectorAll("#tbArea .btn-info");

    for(let i=0; i<linkEditar.length; i++){
        linkEditar[i].addEventListener('click', function(e){
           // console.log(linkEditar[i]);
           var enlace ='';
           enlace = e.target.dataset.fila;
           console.log(enlace);
           ajax.open('POST', "../controller/areaController.php",true);
           var data = new FormData();
           data.append("valor", "enlace");
           data.append("accion", "Seleccionar");
           ajax.onload = function(){
           const respuesta = ajax.responseText;
           console.log(respuesta);

          
        }});
       
    }
}
/********Buscar en tabla*/
function buscar(valor = '',pagina = 1, cantidad = 3){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', "../controller/areaController.php", true);
    var data = new FormData();

    data.append('valor',valor);
    data.append('pagina',pagina);
    data.append('cantidad',cantidad);
    data.append('accion','buscar');
    ajax.onload = function(){
        let respuesta = ajax.responseText;
        const datos = JSON.parse(respuesta);
        let area = datos.listado;
        console.log(respuesta);
        console.log(datos);
        let template = "";

        if(area !== 'vacio'){
            area.forEach(function(area){
                template +=  `
                <tr>
                    <td>${area.id}</td>
                    <td>${area.nombre}</td>
                    <td><button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-fila = "${area.id}">Editar</button>
                    <button type="button" class="btn btn-danger" data-fila = "${area.id}">Borrar</button></td>

                    
                
                </tr>
                `;

            });
            var elemento = document.getElementById("tbArea");
            elemento.innerHTML = template;
            document.getElementById('txtPagVista').value = numPagina;
            document.getElementById('txtPagTotal').value = datos.paginas;

        }else{
            // var aviso = document.getElementById("alerta");
            template = `No se encontraron datos`;
            var elemento = document.getElementById("tbArea");
            elemento.innerHTML =template;
            document.getElementById('txtPagVista').value = 0;
            document.getElementById('txtPagTotal').value = 0;

        }
        
        
    }
    ajax.send(data);
}
let pagInicio = document.querySelector('#btnPrimero');
pagInicio.addEventListener('click', function (e) {
    numPagina = 1;
    document.getElementById('txtPagVista').value = numPagina;
    buscar('',1,3);
    pagInicio.blur();
});
let pagAnterior = document.querySelector('#btnAnterior');
pagAnterior.addEventListener('click', function (e) {
    var pagVisitada = parseInt(document.getElementById('txtPagVista').value);
    var pagDestino = 0;
    if ((pagVisitada - 1) >= 1) {
        pagDestino = pagVisitada - 1;
        numPagina = pagDestino;
        document.getElementById('txtPagVista').value = numPagina;
        buscar('',numPagina,3);
        pagAnterior.blur();
    }
});
let pagSiguiente = document.querySelector('#btnSiguiente');
pagSiguiente.addEventListener('click', function (e) {
    var pagVisitada = parseInt(document.getElementById('txtPagVista').value);
    var pagFinal = parseInt(document.getElementById('txtPagTotal').value);
    var pagDestino = 0;
    if ((pagVisitada + 1) <= pagFinal) {
        pagDestino = pagVisitada + 1;
        numPagina = pagDestino;
        document.getElementById('txtPagVista').value = numPagina;
        buscar('',numPagina,3);
        pagSiguiente.blur();
    }
});
let pagFinal = document.querySelector('#btnUltimo');
pagFinal.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotal').value;
    document.getElementById('txtPagVista').value = numPagina;
    console.log(numPagina);
    buscar('',numPagina,3);
    pagFinal.blur();
});

/****************************/
//Buscar elementos
let campoBusqueda = document.getElementById("txtBuscarArea");
campoBusqueda.addEventListener("keyup", function(e){
    var valor = campoBusqueda.value;
    console.log(valor);
    valorBuscar ="where nombre_area like '%"+valor+"%'";
    numPagina = 1;
    cantidadFilas = 3;
    buscar(valorBuscar,numPagina,cantidadFilas);


});


function seleccionar(){
  linkEditar = document.querySelectorAll("#tbArea .btn-info");
  var datosInput = document.querySelectorAll('#frmArea input');
  var datosSelect = document.querySelectorAll('#frmArea select');
  
}