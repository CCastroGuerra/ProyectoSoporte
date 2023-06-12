var id;
var numPagina = 1;
var frmServicio = document.getElementById("formServicio");
console.log(numPagina);
buscarServicio();
//listarServicio();

frmServicio.onsubmit = function (e) {
  e.preventDefault();
  if (frmServicio.querySelector("#inputCodigo").value !== "") {
    actualizar(id);
    console.log("actualizo");
  } else {
    guardarServicio();
    //listarServicio();
    console.log("guardo");
  }
  frmServicio.reset();
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
                      <button type="button" onClick = eliminarServicio("${servicio.id}") class="btn btn-danger" data-fila = "${servicio.id}">Borrar</button></td>
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
  let numPagina = 1;
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
              
              <button type="button" onClick='eliminarServicio("${servicio.id}")' class="btn btn-danger" data-fila="${servicio.id}"><i class="fa fa-trash" aria-hidden="true"></i>
              </button>


              </td>
            </tr>
          `;
      });
      var elemento = document.getElementById("tbServicio");
      elemento.innerHTML = template;
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
          //document.getElementById('txtPagVistaPre').value = numPagina - 1;
          numPagina = numPagina - 1;
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
