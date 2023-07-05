var numPagina = 1;
let id = "";
listarSelectMarca();
buscarMarca();
//listarMarca();
let frmMarca = document.getElementById("formMarca");
///
const modalp = frmMarca.parentNode.parentNode.parentNode.id;
const alerta = frmMarca.querySelector("#alerta1");
const alerta2 = frmMarca.querySelector("#alerta2");
const calert = frmMarca.querySelectorAll(".alerta");
const nombre_marca = frmMarca.querySelector("#nombreMarca");
const categ = frmMarca.querySelector("#selMarca");
const regla = new RegExp("[a-zA-Z]+$");

var ofr = document.querySelectorAll("#formMarca .alerta");

ofr.forEach((element) => {
  element.style.color = "red";
});
nombre_marca.onkeypress = function (evento) {
  alerta.innerText = "";
  alerta2.innerText = "";
};

////

//cambiar titulo de modal
const modal = document.getElementById(modalp);
modal.addEventListener('show.coreui.modal', event =>{
  console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  console.log("el modal fue levantado por: "+button.id);
  var modalTitle= modal.querySelector('.modal-title');
  alerta.innerText = "";
  alerta2.innerText = "";
  
  switch (button.id) {
    case "":
      modalTitle.textContent = "Guardar";
      frmMarca.reset()
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar";
      break;
  }
});
/**** */

frmMarca.onsubmit = function (e) {
  e.preventDefault();
  var band = 0;
  if (frmMarca.querySelector("#codigoMarca").value !== "") {
    console.log("actualizo");
    actualizar(id);
    setTimeout(function () {
      $("#" + modalp).modal("toggle");
    }, 3000);
  } else {
    if (nombre_marca.value.trim() == 0) {
      band++;
      alerta.innerText = "el elemento esta vacío";
    } else {
      if (regla.test(nombre_marca.value) == false) {
        band++;
        alerta.innerText = "el elemento no debe contener numeros";
      }else{
        alerta.innerText="";
      }
    }
    if (categ.value == 0) {
      band++;
      //console.log("no se ha seleccionado una categoria");
      alerta2.innerText = "no se ha seleccionado una categoria";
    }

    if (band == 0) {
      guardarMarca();
      buscarMarca();
      console.log("guardo");
      frmMarca.reset();
      $("#" + modalp).modal("toggle");
    }
  }
  return false;
};

function listarSelectMarca() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/marcaController.php", true);
  var data = new FormData();
  data.append("accion", "listarCombo");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const rol = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (rol.length > 0) {
      template = `<option value="0">Seleccione Marca</option>
        `;
      rol.forEach(function (rol) {
        template += `
                   
                    <option value="${rol.id}">${rol.nombre}</option>
                
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
  if (this.value == 0) {
    alerta2.innerText = "Marca no válida";
  } else {
    console.log("Valor seleccionado:", valorSeleccionado);
    alerta2.innerText = "";
  }
};

function guardarMarca() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/marcaController.php", true);
  var data = new FormData(frmMarca);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarMarca();
    //buscarArea();
    //listarArea();
    frmMarca.reset();
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombreMarca");
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
        ajax.open("POST", "../controller/marcaController.php", true);
        const data = new FormData(frmMarca);
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("combo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarMarca();
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

function eliminarMarcas(id) {
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
        ajax.open("POST", "../controller/marcaController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarMarca();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbMarca");
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
  buscarMarca();
});

function buscarMarca() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarMarca");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/marcaController.php", true);
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
    let marca = datos.listado;
    console.log(marca);
    let template = ""; // Estructura de la tabla html
    if (marca != "vacio") {
      marca.forEach(function (marca) {
        template += `
                  <tr>
                      <td>${marca.nombre}</td>
                      <td>${marca.nombreCategoria}</td>

                      <td>
                      <button type="button" onClick='mostrarEnModal("${marca.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#marcaModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button type="button" onClick='eliminarMarcas("${marca.id}")' class="btn btn-danger pelim" data-fila="${marca.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                      </td>

                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbMarca");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${marca.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbMarca");
      elemento.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
    }
  };
  ajax.send(data);
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarMarca");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina = 1;
  buscarMarca();
});

function mostrarEnModal(marcaId) {
  id = marcaId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/marcaController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    //console.log(datos);
    document.getElementById("nombreMarca").value = datos.nombre;
    document.getElementById("selMarca").value = datos.nombreCategoria;
    document.getElementById("codigoMarca").value = datos.id;
  };
  ajax.send(data);
}

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarMarca();
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
    buscarMarca();
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
    buscarMarca();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarMarca();
  pagFinal.blur();
});
