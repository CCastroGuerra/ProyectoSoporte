var id;
var numPagina = 1;
var frmArea = document.getElementById("formArea");
console.log(numPagina);
buscarArea();

/// variables para validacion
const modalp = frmArea.parentNode.parentNode.parentNode.id;
const alerta = frmArea.querySelector("#alerta");
const nombre_area = frmArea.querySelector("#nombre_area");
/** estilo dinamico de mensaje de error */
alerta.style.color = "red";
/* cuando se escribe se limpia el mensaje de error */
nombre_area.oninput = function (evento) {
  alerta.innerText = "";
};
////

frmArea.onsubmit = function (e) {
  e.preventDefault();
  if (frmArea.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
    setTimeout(function () {
      $("#" + modalp).modal("hide");
    }, 3000);
  } else {
    if (frmArea.querySelector("#nombre_area").value.trim().length > 0) {
      regla = new RegExp("[a-zA-Z0-9]+$");
      if (regla.test(frmArea.querySelector("#nombre_area").value)) {
        guardarArea();
        console.log("guardo");
        frmArea.reset();
        $("#" + modalp).modal("hide");
      } else {
        console.log("no cumple, reabriendo el modal: " + modalp);
        $("#" + modalp).modal("show");
        alerta.innerText = "El nombre no es válido";
      }
    } else {
      console.log("elemento vacío, reabriendo el modal: " + modalp);
      $("#" + modalp).modal("show");
      alerta.innerText = "Este campo es necesario";
    }
  }
};

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  numPagina = 1;
  buscarArea();
});

// function listarArea() {
//   let num_registros = document.getElementById("numRegistros").value;
//   const ajax = new XMLHttpRequest();
//   ajax.open("POST", "../controller/areaController.php", true);
//   var data = new FormData();
//   data.append("accion", "listar");
//   data.append("valor", "");
//   data.append("cantidad", "4");
//   data.append("registros", num_registros);
//   ajax.onload = function () {
//     let respuesta = ajax.responseText;
//     console.log(respuesta);
//     const area = JSON.parse(respuesta);
//     let template = ""; // Estructura de la tabla html
//     if (area.length > 0) {
//       area.forEach(function (area) {
//         template += `
//                   <tr>

//                       <td>${area.nombre}</td>
//                       <td>
//                       <button type="button" class="btn btn-success btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal"><i class="fa fa-plus" aria-hidden="true"></i>

//                       <button type="button" onClick='eliminarPresentacion("${area.id}")' class="btn btn-danger pelim" ><i class="fa fa-trash" aria-hidden="true"></i>
//                       </button>
//             </td>
//                   </tr>
//                   `;
//       });
//       var elemento = document.getElementById("tbArea");
//       elemento.innerHTML = template;
//     }
//   };
//   ajax.send(data);
// }

//cambiar titulo de modal
const modal = document.getElementById(modalp);
modal.addEventListener("show.coreui.modal", (event) => {
  console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  console.log("el modal fue levantado por: " + button.id);
  var modalTitle = modal.querySelector(".modal-title");
  alerta.innerText = "";
  switch (button.id) {
    case "":
      modalTitle.textContent = "Guardar";
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar";
      break;
  }
});
/**** */

function buscarArea() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarArea");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData();
  data.append("accion", "buscar");
  data.append("cantidad", "4");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let area = datos.listado;
    console.log(area);
    let template = ""; // Estructura de la tabla html
    if (area != "vacio") {
      area.forEach(function (area) {
        template += `
            <tr>
              
              <td>${area.nombre}</td>
              <td>
              <button type="button" onClick='mostrarEnModal("${area.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#areaModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>

                      
              <button type="button" onClick='eliminarArea("${area.id}")' class="btn btn-danger pelim" ><i class="fa fa-trash" aria-hidden="true"></i>
              </button>
              </td>
            </tr>
          `;
      });
      var elemento = document.getElementById("tbArea");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${area.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbArea");
      elemento.innerHTML = `
          <tr>
            <td colspan="3" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
      document.getElementById("txtPagVista").value = 1;
      document.getElementById("txtPagTotal").value = 1;
      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando 0 de 0 registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    }
  };
  ajax.send(data);
}

function guardarArea() {
  var realizado = "";
  var mensaje = "";
  const ajax = new XMLHttpRequest();

  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData(frmArea);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }

    buscarArea();
    //listarArea();
    frmArea.reset();
  };
  ajax.send(data);
}

function mostrarEnModal(areaid) {
  id = areaid;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("nombre_area").value = datos.nombre;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombre_area");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea actualizar el registro?",
      icon: "question",
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
        data.append("nombre", nombre);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarArea();
          swal.fire(
            "Actualizado!",
            "El registro se actualizó correctamente.",
            "success"
          );
        };
        cajaBuscar.value = "";
        ajax.send(data);
      }
    });
}

function limpiarFormulario() {
  frmArea.reset();
}

function eliminarArea(id) {
  console.log(id);
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea Eliminar el Registro?",
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
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);

          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
          buscarArea();
        };
        let tab = document.getElementById("tbArea");
        if (tab.rows.length == 1) {
          if (numPagina == 1) {
            numPagina = 1;
          } else {
            numPagina = numPagina - 1;
          }
        }
        ajax.send(data);
      }
    });
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarArea");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  numPagina = 1;
  buscarArea();
});

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarArea();
  pagInicio.blur();
});
let pagAnterior = document.querySelector("#btnAnterior");
pagAnterior.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagDestino = 0;
  if (pagVisitada - 1 >= 1) {
    pagDestino = pagVisitada - 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarArea();
    pagAnterior.blur();
  }
});
let pagSiguiente = document.querySelector("#btnSiguiente");
pagSiguiente.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagFinal = parseInt(document.getElementById("txtPagTotal").value);
  var pagDestino = 0;
  if (pagVisitada + 1 <= pagFinal) {
    pagDestino = pagVisitada + 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarArea();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarArea();
  pagFinal.blur();
});
