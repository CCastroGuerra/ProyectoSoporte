var id;
var numPagina = 1;
var frmServicio = document.getElementById("formServicio");
console.log(numPagina);
buscarServicio();
//listarServicio();
//Evento para el checkBox
const selTipo = document.getElementById("selecTipo");
const nombreServicio = document.getElementById("nombreServicio");
const labelText = document.getElementById("nombreServicio");

const alerta = frmServicio.querySelectorAll(".alerta");

alerta.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});

nombreServicio.addEventListener("input", function () {
  if (this.value.trim().length == 0) {
    document.getElementById("alerta1").innerText =
      "este campo no puede quedar vacío";
  } else {
    document.getElementById("alerta1").innerText = "";
  }
});

selTipo.addEventListener("change", function () {
  if (this.value == 0) {
    document.getElementById("alerta2").innerText =
      "Seleccione una opcíon válida";
  } else {
    document.getElementById("alerta2").innerText = "";
  }
});

///
const modalp = frmServicio.parentNode.parentNode.parentNode.id;
const nombre_servicio = frmServicio.querySelector("#nombreServicio");
const regla = new RegExp("[a-zA-Z]+$");

////

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
      frmServicio.reset();
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar";
      break;
  }
});
/**** */

frmServicio.onsubmit = function (e) {
  var err = 0;
  var enom = 0;
  var esel = 0;
  e.preventDefault();
  if (frmServicio.querySelector("#inputCodigo").value !== "") {
    actualizar(id);
    setTimeout(function () {
      $("#" + modalp).modal("toggle");
    }, 3000);
    console.log("actualizo");
  } else {
    if (nombre_servicio.value.trim().length == 0) {
      document.getElementById("alerta1").innerText =
        "este campo no puede quedar vacío";
      enom = 0;
    } else {
      document.getElementById("alerta1").innerText = "";
      enom = 1;
    }

    if (selTipo.value == 0) {
      document.getElementById("alerta2").innerText =
        "Seleccione una opcíon válida";
      esel = 0;
    } else {
      document.getElementById("alerta2").innerText = "";
      esel = 1;
    }

    err = enom + esel;
    console.log("completos: "+err);

    if (err == 2) {
      guardarServicio();
      buscarServicio();
      console.log("guardo");
      frmServicio.reset();
      $("#" + modalp).modal("toggle");
    }
    //guardarServicio();
  }
};

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  buscarServicio();
});

function listarServicio() {
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/serviciosController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "4");
  data.append("registros", num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const servicio = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (servicio.length > 0) {
      servicio.forEach(function (servicio) {
        template += `
                  <tr>
                      <td>${servicio.id}</td>
                      <td>${servicio.nombre}</td>
                      <td><button type="button" onClick='mostrarEnModal("${servicio.id}") 'id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#servicioModal">Editar</button>
                      <button type="button" onClick = eliminarServicio("${servicio.id}") class="btn btn-danger pelim" data-fila = "${servicio.id}">Borrar</button></td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbServicio");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function buscarServicio() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarServicios");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/serviciosController.php", true);
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
    let servicio = datos.listado;
    console.log(servicio);
    let template = ""; // Estructura de la tabla html
    if (servicio != "vacio") {
      servicio.forEach(function (servicio) {
        template += `
            <tr>
              
              <td>${servicio.nombre}</td>
              <td>
                

                <button type="button" onClick='mostrarEnModal("${servicio.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#servicioModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
              
              <button type="button" onClick='eliminarServicio("${servicio.id}")' class="btn btn-danger pelim" data-fila="${servicio.id}"><i class="fa fa-trash" aria-hidden="true"></i>
              </button>


              </td>
            </tr>
          `;
      });
      var elemento = document.getElementById("tbServicio");
      elemento.innerHTML = template;
      Secretaria();
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${servicio.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbServicio");
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

function guardarServicio() {
  var realizado = "";
  var mensaje = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/serviciosController.php", true);
  var data = new FormData(frmServicio);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarServicio();
    frmServicio.reset();
  };
  ajax.send(data);
}

function mostrarEnModal(servicioId) {
  //console.log(id);
  id = servicioId;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/serviciosController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("nombreServicio").value = datos.nombre;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombreServicio");
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
        ajax.open("POST", "../controller/serviciosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarServicio();
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
  frmServicio.reset();
}

function eliminarServicio(id) {
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
        ajax.open("POST", "../controller/serviciosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarServicio();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbServicio");
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
var cajaBuscar = document.getElementById("inputbuscarServicios");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina = 1;
  buscarServicio();
});

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarServicio();
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
    buscarServicio();
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
    buscarServicio();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarServicio();
  pagFinal.blur();
});
