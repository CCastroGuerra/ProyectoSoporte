var valorBuscar = "";
var numPagina = 1;
listarSelectComponentes();
listarSelectMarca();
listarSelectClase();
listarSelectEstado();
buscarComponente();
let selecModelo = document.getElementById("selModelo");
let selecMarca = document.getElementById("selMarca");
let frmComponentes = document.getElementById("formAcomponente");

formAcomponente.onsubmit = function (e) {
  e.preventDefault();
  if (frmComponentes.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarComponente();
    //buscarModelo();
    console.log("guardo");
  }
  frmComponentes.reset();
};

selecModelo.disabled = true;
selecMarca.addEventListener("change", () => {
  let marcaId = selecMarca.value;
  console.log(marcaId);
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "listarModel");
  data.append("id", marcaId);
  selecModelo.disabled = false;
  ajax.onload = () => {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let marcas = JSON.parse(respuesta);
    console.log(marcas);
    let options = "<option value=''>Seleccione una Modelo</option>";
    if (marcas.length > 0) {
      marcas.forEach(function (marcas) {
        options += `
            <option value='${marcas.id}'>${marcas.nombre}</option>
                      `;
      });
    } else {
      selecModelo.disabled = true;
    }
    //Actualizar combo
    document.getElementById("selModelo").innerHTML = options;
  };
  ajax.send(data);
});

function listarSelectMarca() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "listarMarca");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const marca = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (marca.length > 0) {
      template = `<option value="0">Seleccione Marca</option>
          `;
      marca.forEach(function (marca) {
        template += `
                     
                      <option value="${marca.id}">${marca.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selMarca");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectComponentes() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "listarComponentes");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const componentes = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (componentes.length > 0) {
      template = `<option value="0">Seleccione el tipo</option>
          `;
      componentes.forEach(function (componentes) {
        template += `
                     
                      <option value="${componentes.id}">${componentes.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selTipo");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectClase() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "listarClases");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const clase = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (clase.length > 0) {
      template = `<option value="0">Seleccione la clase</option>
          `;
      clase.forEach(function (clase) {
        template += `
                     
                      <option value="${clase.id}">${clase.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selClase");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectEstado() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "listarEstado");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const estado = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (estado.length > 0) {
      template = `<option value="0">Seleccione estado</option>
          `;
      estado.forEach(function (estado) {
        template += `
                     
                      <option value="${estado.id}">${estado.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selEstado");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarComponentes");
cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina = 1;
  buscarComponente();
});

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", function () {
  numPagina = 1;
  buscarComponente();
});

function buscarComponente() {
  var cajaBuscar = document.getElementById("inputbuscarComponentes");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "buscar");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let componentes = datos.listado;
    console.log(componentes);
    let template = ""; // Estructura de la tabla html
    if (componentes != "vacio") {
      componentes.forEach(function (componentes) {
        template += `
                  <tr>
                      <td>${componentes.nombreTipo}</td>
                      <td>${componentes.nombreClase}</td>
                      <td>${componentes.nombreMarca}</td>
                      <td>${componentes.nombreModelo}</td>
                      <td>${componentes.serie}</td>
                      <td>${componentes.capacidad}</td>
                      <td>${componentes.estado}</td>
                      <td>${componentes.Fecha}</td>
                      <td>

                      <button type="button" onClick='mostrarEnModal("${componentes.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirComponente"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button type="button" onClick='eliminarComponentes("${componentes.id}")' class="btn btn-danger" data-fila="${componentes.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${componentes.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">No se encontraron resultados</td>
          </tr>
        `;

      // document.getElementById("txtPagVista").value = 0;
      // document.getElementById("txtPagTotal").value = 0;
    }
  };
  ajax.send(data);
}

function guardarComponente() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData(frmComponentes);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    //buscarArea();
    buscarComponente();
    frmComponentes.reset();
  };
  ajax.send(data);
}

function eliminarComponentes(id) {
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
        ajax.open("POST", "../controller/componentesController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarComponente();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbComponentes");
        if (tab.rows.length == 1) {
          //document.getElementById('txtPagVistaPre').value = numPagina - 1;
          numPagina = numPagina - 1;
        }
        ajax.send(data);
      }
    });
}

function mostrarEnModal(componenteId) {
  id = componenteId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  selecModelo.disabled = false;
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    console.log("Mostrando fecha: " + datos.fecha);
    console.log(datos);
    document.getElementById("selTipo").value = datos.nombreTipo;
    document.getElementById("selClase").value = datos.nombreClase;
    document.getElementById("selMarca").value = datos.nombreMarca;
    document.getElementById("selModelo").value = datos.nombreModelo;
    document.getElementById("serie").value = datos.serie;
    document.getElementById("capacidad").value = datos.capacidad;
    document.getElementById("selEstado").value = datos.estado;
    var fechaParts = datos.fecha.split("/"); // Divide la cadena de fecha en partes: día, mes y año
    var fechaFormateada =
      "20" + fechaParts[2] + "-" + fechaParts[1] + "-" + fechaParts[0]; // Formatea la fecha como "yyyy-mm-dd"
    document.getElementById("Fecha").value = fechaFormateada;

    //document.getElementById("Fecha").value = datos.fecha;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombreModelo");
  let nombreTipo = document.getElementById("selTipo").value;
  let nombreClase = document.getElementById("selClase").value;
  let nombreMarca = document.getElementById("selMarca").value;
  let nombreModelo = document.getElementById("selModelo").value;
  let serie = document.getElementById("serie").value;
  let capacidad = document.getElementById("capacidad").value;
  let estado = document.getElementById("selEstado").value;
  let fecha = document.getElementById("Fecha").value;
  // Obtener los valores actualizados desde los elementos del modal
  // const nombre = nombreInput.value;
  // const combo = elemento.value;
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
        ajax.open("POST", "../controller/componentesController.php", true);
        const data = new FormData(frmComponentes);
        data.append("id", id);
        data.append("nombreTipo", nombreTipo);
        data.append("nombreClase", nombreClase);
        data.append("nombreMarca", nombreMarca);
        data.append("nombreModelo", nombreModelo);
        data.append("serie", serie);
        data.append("capacidad", capacidad);
        data.append("estado", estado);
        data.append("fecha", fecha);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarComponente();
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

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarComponente();
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
    buscarComponente();
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
    buscarComponente();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarComponente();
  pagFinal.blur();
});
