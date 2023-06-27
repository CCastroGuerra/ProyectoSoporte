var numPagina = 1;
let id = "";
listarSelectMarca();
buscarModelo();
//listarMarca();
let frmModelo = document.getElementById("formModelo");

////
const modalp = frmModelo.parentNode.parentNode.parentNode.id;
const alerta = frmModelo.querySelector("#alerta1");
const alerta2 = frmModelo.querySelector("#alerta2");
const calert = frmModelo.querySelectorAll(".alerta");
const nombre_modelo = frmModelo.querySelector("#nombreModelo");
const categ = frmModelo.querySelector("#selMarca");
const regla = new RegExp("[a-zA-Z]+$");

var ofr = document.querySelectorAll("#formModelo .alerta");

ofr.forEach((element) => {
  element.style.color = "red";
});
nombre_modelo.onkeypress = function (evento) {
  alerta.innerText = "";
  alerta2.innerText = "";
};
////

frmModelo.onsubmit = function (e) {
  e.preventDefault();
  var band=0;
  if (frmModelo.querySelector("#codigoModelo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    if (nombre_modelo.value.trim().length == 0) {
      band++;
      alerta.innerText = "el elemento esta vacío";
    } else {
      if (regla.test(nombre_modelo.value) == false) {
        band++;
        alerta.innerText = "el elemento no debe contener numeros";
      }
    }
    if (categ.value == 0) {
      band++;
      alerta2.innerText = "no se ha selecionado una categoria";
    }
    if (band == 0) {
      guardarModelo();
      buscarModelo();
      console.log("guardo");
      $("#" + modalp).modal("toggle");
      frmModelo.reset();
    }
  }
  return false;
};

function listarSelectMarca() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
  var data = new FormData();
  data.append("accion", "listarCombo");
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

var elemento = document.getElementById("selMarca");
elemento.onchange = function () {
  var valorSeleccionado = elemento.value;
  console.log("Valor seleccionado:", valorSeleccionado);
  if (this.value==0) {
    alerta2.innerText="Seleccione una marca válida";
  } else {
    alerta2.innerText="";
  }
};

function guardarModelo() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/modeloController.php", true);
  var data = new FormData(frmModelo);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    //buscarArea();
    buscarModelo();
    frmModelo.reset();
  };
  ajax.send(data);
}

function buscarModelo() {
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const modelo = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (modelo.length > 0) {
      modelo.forEach(function (modelo) {
        template += `
                  <tr>
                      <!-- <td>${modelo.nro}</td> -->
                      <td>${modelo.nombre}</td>
                      <td>${modelo.nombreMarca}</td>
                      <td>
                      
                      <button type="button" onClick='mostrarEnModal("${modelo.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button type="button" onClick='eliminarModelo("${modelo.id}")' class="btn btn-danger" data-fila="${modelo.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                      
                      
                     
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbModelo");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${modelo.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    }
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombreModelo");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
  const combo = elemento.value;
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
        ajax.open("POST", "../controller/modeloController.php", true);
        const data = new FormData(frmModelo);
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("combo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarModelo();
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

function eliminarModelo(id) {
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
        ajax.open("POST", "../controller/modeloController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarModelo();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbModelo");
        if (tab.rows.length == 1) {
          //document.getElementById('txtPagVistaPre').value = numPagina - 1;
          numPagina = numPagina - 1;
        }
        ajax.send(data);
      }
    });
}

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", function () {
  numPagina = 1;
  buscarModelo();
});

function buscarModelo() {
  let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarModelo");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
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
    let modelo = datos.listado;
    console.log(modelo);
    let template = ""; // Estructura de la tabla html
    if (modelo != "vacio") {
      modelo.forEach(function (modelo) {
        template += `
                  <tr>
                      <td>${modelo.nombre}</td>
                      <td>${modelo.nombreMarca}</td>
                      <td>

                      <button type="button" onClick='mostrarEnModal("${modelo.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button type="button" onClick='eliminarModelo("${modelo.id}")' class="btn btn-danger" data-fila="${modelo.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbModelo");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${modelo.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbModelo");
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

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarModelo");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina = 1;
  buscarModelo();
});

function mostrarEnModal(modeloId) {
  id = modeloId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    //console.log(datos);
    document.getElementById("nombreModelo").value = datos.nombre;
    document.getElementById("selMarca").value = datos.nombreMarca;
    document.getElementById("codigoModelo").value = datos.id;
  };
  ajax.send(data);
}

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarModelo();
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
    buscarModelo();
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
    buscarModelo();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarModelo();
  pagFinal.blur();
});
