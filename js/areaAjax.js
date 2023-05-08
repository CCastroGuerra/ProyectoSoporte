var valorBuscar = "";
var numPagina = 1;
var cantidadFilas = 0;
var linkEditar ="";
var linkBorrar= "";

buscarArea('',1,4);
listarArea();

var formArea = document.getElementById("formArea");
var respuesta = document.getElementById("alerta");

/* Control de campos vacios*/
formArea.onsubmit = function (e) {
  var nombre = document.getElementById("nombre_area").value;
  e.preventDefault();
  // console.log(nombre);
  if (nombre.length > 0) {
    guardarArea();
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
function listarArea() {
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
    console.log(respuesta);
    const area = JSON.parse(respuesta);

    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      area.forEach(function (area) {
        template += `
                <tr>
                    <td>${area.id}</td>
                    <td>${area.nombre}</td>
                    <td><button type="button" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#areaModal" data-fila = "${area.id}">Editar</button>
                    <button type="button" onClick = eliminarArea("${area.id}") class="btn btn-danger" data-fila = "${area.id}">Borrar</button></td>

                    
                
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
function guardarArea() {
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
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarArea();
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
function buscarArea(valor = '',pagina = 1, cantidad = 3){
    const ajax = new XMLHttpRequest();
    ajax.open('POST', "../controller/areaController.php", true);
    var data = new FormData();

    data.append('valor',valor);
    data.append('pagina',pagina);
    data.append('cantidad',cantidad);
    data.append('accion','buscar');
    ajax.onload = function(){
        let respuesta = ajax.responseText;
        console.log(respuesta);
        const datos = JSON.parse(respuesta);
        let area = datos.listado;
        let template = "";

        if(area !== 'vacio'){
            area.forEach(function(area){
                template +=  `
                <tr>
                    <td>${area.id}</td>
                    <td>${area.nombre}</td>
                    <td><button type="button" class="btn btn-info" data-coreui-toggle="modal" data-coreui-target="#exampleModal" data-fila = "${area.id}">Editar</button>
                    <button type="button" onClick = eliminarArea("${area.id}") class="btn btn-danger" data-fila = "${area.id}">Borrar</button></td>

                    
                
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
let campoBusqueda = document.getElementById("inputbuscarArea");
campoBusqueda.addEventListener("keyup", function(e){
    var valor = campoBusqueda.value;
    console.log(valor);
    valorBuscar ="where nombre_area like '%"+valor+"%'";
    numPagina = 1;
    cantidadFilas = 3;
    buscarArea(valorBuscar,numPagina,cantidadFilas);


});


function seleccionar(){
  linkEditar = document.querySelectorAll("#tbArea .btn-info");
  var datosInput = document.querySelectorAll('#frmArea input');
  var datosSelect = document.querySelectorAll('#frmArea select');
  
}

/**********ELIMINAR*/
// function eliminar() {
//   linkBorrar = document.querySelectorAll('#tbArea ');
//   btnBorrar = document.querySelectorAll('button');
//   //console.log(linkEditar.length);
//   var elementoRpta = document.getElementById('aviso');
//   for (let i = 0; i < linkBorrar.length; i++) {
//       linkBorrar[i].addEventListener('click', function (e) {
//           var respuesta = '';
//           var mensaje = '';
//           enlaceBorrar = e.target.dataset.fila;
//           var ajax = new XMLHttpRequest();
//           ajax.open('POST', '../controller/areaController.php', true);
//           console.log(enlaceBorrar);
//           var data = new FormData();
//           data.append('valor', enlaceBorrar);
//           data.append('pag', '1');
//           data.append('accion', 'Eliminar');
//           console.log(numPagina);
//           ajax.onload = function () {
//               //console.log(ajax.responseText);
//               respuesta = ajax.responseText;
//               if (respuesta == 'true') {
//                   mensaje = "Los datos se eliminaron con exito.";
//                   elementoRpta.innerHTML = `
//                   <div  class="alert alert-success alert-link" id="msjalerta" role="alert">
//                   <span class="alert-dismissible">`+ mensaje + `</span>
//                   </div>`;
//               }
//               else {
//                   mensaje = "Los datos no se lograron eliminar.";
//                   elementoRpta.innerHTML = `
//                   <div  class="alert alert-danger alert-link" id="msjalerta" role="alert">
//                   <span class="alert-dismissible">`+ mensaje + `</span>
//                   </div>`;
//               }
             
//               buscar();
//               e.preventDefault();
//           }
//           console.log(numPagina);
//           ajax.send(data);
//           // console.log(enlace);
//           // numPagina = e.target.dataset.pagina;
//           e.preventDefault();
//           var alerta = document.querySelector('#aviso');
//           setTimeout(function () { alerta.innerHTML = ''; }, 2000);

//       });
//   }
// }

function eliminarArea(id){
  console.log(id);
  swal
    .fire({
      title: "CRUD",
      text: "Desea Eliminar el Registro?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/areaController.php", true);
        const data = new FormData();
        data.append("id", id);
        //data.append('valor', enlaceBorrar);
        data.append('pag', '1');
        data.append('accion', 'eliminar');
        ajax.onload = function () {
          console.log(ajax.responseText);
          //cargarTabla();
          //listarTareas();
          listarArea();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        console.log("id=" + id);
        ajax.send(data);
      }
    });
}