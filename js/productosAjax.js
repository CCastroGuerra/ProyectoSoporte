let numPagina = 1;
let id = "";
let clickBuscar = false;
let frmProductos = document.getElementById("formProducto");
let frmPresentacion = document.getElementById("formPresentacion");
buscarProducto();
listarSelecPresentacion();
buscarPresentacion();

////
const nombre_producto = document.querySelector("#nombreProducto");
const tipo_producto = document.querySelector("#selTipoProducto");
const tipo_presentacion = document.querySelector("#selUnidad");
const ctd_producto = document.querySelector("#ctdProducto");
const almacen = document.querySelector("#selAlmacen");
const detalle_producto = document.querySelector("#detalleProducto");

const modalp = frmProductos.parentNode.parentNode.parentNode.id;

var regla = new RegExp("[a-zA-Z]+$");
var alerta1 = document.querySelector("#alerta1");
var alerta2 = document.querySelector("#alerta2");
var alerta3 = document.querySelector("#alerta3");
var alerta4 = document.querySelector("#alerta4");
var alerta5 = document.querySelector("#alerta5");
var alerta6 = document.querySelector("#alerta6");

var ofr = document.querySelectorAll("#formProducto .alerta");
ofr.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});

nombre_producto.oninput = function () {
  alerta1.innerText = "";
};
tipo_producto.oninput = function () {
  alerta2.innerText = "";
};
ctd_producto.oninput = function () {
  alerta4.innerText = "";
};
ctd_producto.addEventListener("keypress", function (evt) {
  console.log("keypress");
  if (
    (evt.keyCode != 8 && evt.keyCode != 0 && evt.keyCode < 48) ||
    evt.keyCode > 57
  ) {
    evt.preventDefault();
  }
});
detalle_producto.oninput = function () {
  alerta6.innerText = "";
};

////

//cambiar titulo de modal
const modal = document.getElementById(modalp);
modal.addEventListener("show.coreui.modal", (event) => {
  console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  console.log("el modal fue levantado por: " + button.id);
  var modalTitle = modal.querySelector(".modal-title");
  var ofr = document.querySelectorAll("#formProducto .alerta");
  ofr.forEach((element) => {
    element.innerText="";
  });
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

frmProductos.onsubmit = function (e) {
  e.preventDefault();
  var band = 0;
  if (frmProductos.querySelector("#inputID").value !== "") {
    console.log("actualizo");
    actualizar(id);
    setTimeout(function () {
      $("#" + modalp).modal("toggle");
    }, 3000);
  } else {
    if (nombre_producto.value.trim().length == 0) {
      band++;
      alerta1.innerText = "El nombre no puede estar vacío";
    } else {
      if (regla.test(nombre_producto.value) == false) {
        band++;
        alerta1.innerText = "El nombre no puede contener numeros";
      }
    }

    if (tipo_producto.value == "0") {
      band++;
      alerta2.innerText = "No ha selecionado el tipo";
    }
    if (tipo_presentacion.value == 0) {
      band++;
      alerta3.innerText = "No ha seleccionado la presentacion";
    }

    if (ctd_producto.value == 0 || ctd_producto.value == "") {
      band++;
      alerta4.innerText = "la cantidad no puede ser 0";
    }

    if (almacen.value == 0) {
      band++;
      alerta5.innerText = "Seleccione el almacen";
    }

    if (detalle_producto.value == "") {
      band++;
      alerta6.innerText = "el detalle no puede ser vacío";
    }
    console.log("errores: " + band);
    if (band == 0) {
      guardarProdcutos();
      $("#" + modalp).modal("toggle");
      console.log("guardo");
      cajaBuscar.disabled = false;
      frmProductos.reset();
    }
  }
  return false;
};

frmPresentacion.onsubmit = (e) => {
  e.preventDefault();
  if (frmPresentacion.querySelector("#inputIDpres").value !== "") {
    console.log("actualizo");
    //actualizar(id);
  } else {
    // guardarArea();
    // listarArea();
    guardarPresentacion();
    console.log("guardo");
    //cajaBuscar.disabled = false;
  }
  frmPresentacion.reset();
};

function listarSelecPresentacion() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData();
  data.append("accion", "listarCombo");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const presentacion = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (presentacion.length > 0) {
      template = `<option value="0">Seleccione Presentacion</option>
      `;
      presentacion.forEach(function (presentacion) {
        template += `
                 
                  <option value="${presentacion.id}">${presentacion.nombre}</option>
              
                  `;
      });
      var elemento = document.getElementById("selUnidad");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function guardarProdcutos() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData(frmProductos);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarProducto();
    //listarArea();
    frmProductos.reset();
  };
  ajax.send(data);
}

function guardarPresentacion() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData(frmPresentacion);
  data.append("accion", "guardarPresentacion");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarPresentacion();
    listarSelecPresentacion();
    frmPresentacion.reset();
    cajaBuscarPre.value = "";
  };
  ajax.send(data);
}

function mostrarEnModal(productoId) {
  id = productoId;
  console.log(id);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("nombreProducto").value = datos.nombre;
    document.getElementById("selTipoProducto").value = datos.tipoId;
    document.getElementById("selUnidad").value = datos.nombrePresentacion;
    document.getElementById("ctdProducto").value = datos.cantidad;
    document.getElementById("selAlmacen").value = datos.almacenId;
    document.getElementById("detalleProducto").value = datos.descripcion;
    document.getElementById("inputID").value = datos.id;
  };
  ajax.send(data);
}

let elemento = document.getElementById("selAlmacen");
elemento.onchange = function () {
  var valorSeleccionado = elemento.value;
  console.log("Valor seleccionado:", valorSeleccionado);
  if (this.value == 0) {
    alerta5.innerText = "Seleccione un almacén válido";
  } else {
    alerta5.innerText = "";
  }
};

let elemento2 = document.getElementById("selTipoProducto");
elemento2.onchange = function () {
  var valorSeleccionado = elemento2.value;
  console.log("Valor seleccionado:", valorSeleccionado);
  if (this.value == 0) {
    alerta2.innerText = "Seleccione un tipo válido";
  } else {
    alerta2.innerText = "";
  }
};

let elemento3 = document.getElementById("selUnidad");
elemento3.onchange = function () {
  var valorSeleccionado = elemento3.value;
  console.log("Valor seleccionado:", valorSeleccionado);
};

function actualizar(id) {
  const nombreInput = document.getElementById("nombreProducto");
  const cantInput = document.getElementById("ctdProducto");
  const descripcionInput = document.getElementById("detalleProducto");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
  const cantidad = cantInput.value;
  const comboAlmacen = elemento.value;
  const comboProducto = elemento2.value;
  const comboUnidad = elemento3.value;
  const descripcion = descripcionInput.value;

  swal
    .fire({
      title: "Aviso del sistema",
      text: "Desea actualizar el registro?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("cantidad", cantidad);
        data.append("selAlmacen", comboAlmacen);
        data.append("selTipoProducto", comboProducto);
        data.append("selUnidad", comboUnidad);
        data.append("detalleProducto", descripcion);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarProducto();
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

function eliminarProducto(id) {
  console.log(id);
  swal
    .fire({
      title: "",
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
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarProducto();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbProductos");
        if (tab.rows.length == 1) {
          //document.getElementById('txtPagVistaPre').value = numPagina - 1;
          numPagina = numPagina - 1;
        }
        ajax.send(data);
      }
    });
}

function limpiarFormulario() {
  frmProductos.reset();
}

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", function () {
  numPagina = 1;
  buscarProducto();
});

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarProducto");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina = 1;
  buscarProducto();
});

function buscarProducto() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarProducto");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
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
    let producto = datos.listado;
    console.log(producto);
    let template = ""; // Estructura de la tabla html

    if (producto != "vacio" && producto.length > 0) {
      producto.forEach(function (producto) {
        template += `
        <tr>
             <td class="visually-hidden" >${producto.nro}</td>
            <td>${producto.codigo}</td>
            <td>${producto.nombre}</td>
            <td>${producto.tipo}</td>
            <td>${producto.presentacion}</td>
            <td>${producto.cantidad}</td>
            <td>${producto.almacen}</td>
            <td>
              <button type="button" onClick='mostrarEnModal("${producto.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
              
              <button type="button" onClick='eliminarProducto("${producto.id}")' class="btn btn-danger pelim" data-fila="${producto.id}"><i class="fa fa-trash" aria-hidden="true"></i>
              </button>
              
            </td>
        </tr>
        `;
      });
      var elemento = document.getElementById("tbProductos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${producto.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbProductos");
      elemento.innerHTML = `
          <tr>
            <td colspan="8" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
    }
  };

  ajax.send(data);
}

/*BUSCAR PRESENTACION*/
var cajaBuscarPre = document.getElementById("BuscarPre");

cajaBuscarPre.addEventListener("keyup", function (e) {
  const textoBusquedaPre = cajaBuscarPre.value;
  console.log(textoBusquedaPre);
  numPagina = 1;
  buscarPresentacion();
});

function buscarPresentacion() {
  var cajaBuscarPre = document.getElementById("BuscarPre");
  const textoBusquedaPre = cajaBuscarPre.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData();
  data.append("accion", "buscarPresentacion");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusquedaPre);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    const datos = JSON.parse(respuesta);
    let presentacion = datos.listado;

    let template = ""; // Estructura de la tabla html

    if (presentacion != "vacio" && presentacion.length > 0) {
      presentacion.forEach(function (presentacion) {
        template += `
        <tr>
          <td style="visibility:collapse; display:none;">${presentacion.id}</td>
          <td>${presentacion.nombre}</td>
          <td>
              <button type="button" class="btn btn-success btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal"><i class="fa fa-plus" aria-hidden="true"></i>
              <button type="button" onClick='eliminarPresentacion("${presentacion.id}")' class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
              </button>
          </td>
        </tr>
        `;
      });
      var elemento = document.getElementById("tbPres");
      elemento.innerHTML = template;
      document.getElementById("txtPagVistaPre").value = numPagina;
      document.getElementById("txtPagTotalPre").value = datos.paginas;
      console.log("Pagina ultima: " + numPagina);

      /* Seleccionar datos de la tabla */
      /*Modal presentación*/

      // Obtén una referencia a la tabla después de su generación
      const tabla = document.getElementById("tbPres");

      // Obtén todas las filas de la tabla
      const filas = tabla.getElementsByTagName("tr");

      //Obteniendo referencia del input
      const inputUnidad = document.getElementById("selUnidad");
      const inputId = document.getElementById("presValue");
      // Itera sobre las filas y agrega un evento de clic a cada una
      for (let i = 0; i < filas.length; i++) {
        const fila = filas[i];
        fila.addEventListener("click", function () {
          // Seleccionar la fila
          console.log("Fila seleccionada:", fila);

          // Obtener los datos de las celdas
          const celdas = fila.getElementsByTagName("td");
          const nombre = celdas[1].innerText;
          const id = celdas[0].innerText;
          console.log("Id de presentacion: " + id);
          console.log(nombre);

          // Mostrar valor en input
          inputUnidad.value = nombre;
          inputId.value = id;
          //data.append('id',inputId);

          frmPresentacion.reset();
        });
      }
    } else {
      let elemento = document.getElementById("tbPres");
      elemento.innerHTML = `
            <tr>
              <td colspan="5" class="text-center">No se encontraron resultados</td>
            </tr>
          `;
    }
  };
  ajax.send(data);
}

function eliminarPresentacion(idPre) {
  console.log(idPre);
  swal
    .fire({
      title: "",
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
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("idPre", idPre);
        data.append("accion", "eliminarPre");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarPresentacion();
          listarSelecPresentacion();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbPres");
        if (tab.rows.length == 1) {
          //document.getElementById('txtPagVistaPre').value = numPagina - 1;
          numPagina = numPagina - 1;
        }

        ajax.send(data);
      }
    });
}

/**************************/
/* BOTONES DE PAGINACIÓN PRODUCTO*/
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarProducto();
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
    buscarProducto();
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
    console.log(numPagina);
    buscarProducto();
    console.log("despues de buscar" + numPagina);
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarProducto();
  pagFinal.blur();
});

/*BOTONES PAGINACION PRESENTACION */

let pagInicioPre = document.querySelector("#btnPrimeroPre");
pagInicioPre.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVistaPre").value = numPagina;
  buscarPresentacion();
  pagInicioPre.blur();
});
let pagAnteriorPre = document.querySelector("#btnAnteriorPre");
pagAnteriorPre.addEventListener("click", function (e) {
  var pagVisitadaPre = parseInt(
    document.getElementById("txtPagVistaPre").value
  );
  var pagDestinoPre = 0;
  if (pagVisitadaPre - 1 >= 1) {
    pagDestinoPre = pagVisitadaPre - 1;
    numPagina = pagDestinoPre;
    document.getElementById("txtPagVista").value = numPagina;
    buscarPresentacion();
    pagAnteriorPre.blur();
  }
});
let pagSiguientePre = document.querySelector("#btnSiguientePre");
pagSiguientePre.addEventListener("click", function (e) {
  var pagVisitadaPre = parseInt(
    document.getElementById("txtPagVistaPre").value
  );
  var pagFinalPre = parseInt(document.getElementById("txtPagTotalPre").value);
  var pagDestinoPre = 0;
  if (pagVisitadaPre + 1 <= pagFinalPre) {
    pagDestinoPre = pagVisitadaPre + 1;
    numPagina = pagDestinoPre;
    document.getElementById("txtPagVistaPre").value = numPagina;
    buscarPresentacion();
    pagSiguientePre.blur();
  }
});
let pagFinalPre = document.querySelector("#btnUltimoPre");
pagFinalPre.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotalPre").value;
  document.getElementById("txtPagVistaPre").value = numPagina;
  console.log(numPagina);
  buscarPresentacion();
  pagFinalPre.blur();
});
