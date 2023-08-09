let numPagina = 1;
buscarEntrada();
buscarSalida();
buscarResumen();
let formulario = document.getElementById("formInventario");
let modalp = formulario.parentNode.parentNode.parentNode.id;
let cbxAccion = document.getElementById("selAccion");
let inproducto = document.getElementById("nombreproducto");
let inctd = document.getElementById("cantidad");
let msgs = document.querySelectorAll(".error-message");
let frmInventario = document.getElementById("formInventario");

//mensajes de error
let alac = document.getElementById("errorAccion");
let alprod = document.getElementById("errorProducto");
let alctd = document.getElementById("errorCantidad");

//variables de control
var vac = 0;
var vprod = 0;
var vctd = 0;
var vcon = 0;

msgs.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});

cbxAccion.addEventListener("change", function (e) {
  console.log("cambio en select tipo");
  if (this.value == 0) {
    alac.innerText = "Selecione una opción valida";
  } else {
    alac.innerText = "";
  }
});

inproducto.addEventListener("input", function () {
  if (this.value.trim().length == 0) {
    alprod.innerText = "El Codigo de Producto es obligatorio";
  } else {
    alprod.innerText = "";
  }
});

inctd.addEventListener("input", function () {
  if (this.value.trim().length == 0) {
    alctd.innerText = "La cantidad es obligatoria";
  } else {
    if (this.value == 0) {
      alctd.innerText = "La cantidad no debe ser 0";
    } else {
      alctd.innerText = "";
    }
  }
});

/***************************/
// let frmInventario = document.getElementById("formInventario");

// frmInventario.onsubmit = function (e) {
//   e.preventDefault();

//   if (cbxAccion.value == 1) {
//     entradaProductos();
//     console.log("Entrada...!!");
//   } else {
//     salidaProductos();
//     console.log("Salida...!!");
//   }

//   //traerNombreProducto();
// };

//cambiar titulo de modal
const modal = document.getElementById(modalp);
modal.addEventListener("show.coreui.modal", (event) => {
  console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  console.log("el modal fue levantado por: " + button.id);
  var modalTitle = modal.querySelector(".modal-title");
  msgs.forEach((element) => {
    element.innerText = "";
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

formulario.addEventListener("submit", function (event) {
  event.preventDefault();
  console.log("validando accion");
  if (cbxAccion.value == 0) {
    vac = 0;
    alac.innerText = "Selecione una opción valida";
  } else {
    vac = 1;
    alac.innerText = "";
  }

  console.log("validando producto");
  if (inproducto.value.trim().length == 0) {
    vprod = 0;
    alprod.innerText = "El Codigo de Producto es obligatorio";
  } else {
    vprod = 1;
    alprod.innerText = "";
  }

  console.log("validando ctd");
  if (inctd.value.trim().length == 0) {
    vctd = 0;
    alctd.innerText = "La cantidad es obligatoria";
  } else {
    if (inctd.value == 0) {
      vctd = 0;
      alctd.innerText = "La cantidad no debe ser 0";
    } else {
      vctd = 1;
      alctd.innerText = "";
    }
  }

  vcon = vac + vprod + vctd;
  if (vcon == 3) {
    console.log("todo ok");
    //aqui pondrí my funcion guardar si tuviera una, pero son 2
    if (cbxAccion.value == 1) {
      console.log("entrada");
      entradaProductos();
    } else {
      console.log("salida");
      salidaProductos();
    }
    $("#inventarioModal").modal("hide");
  }
});

function traerNombreProducto() {
  let codigoProducto = document.getElementById("nombreproducto").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  let data = new FormData();
  data.append("codProducto", codigoProducto);
  data.append("accion", "traerNombreProducto");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (datos) {
      // Verificar si hay datos en la respuesta
      template += `
        <tr>
          <td>${datos.nombre_productos}</td>
          <td>${datos.cantidad_productos}</td>
        </tr>
      `;
      let idCodigo = document.getElementById("idProducto");
      idCodigo = datos.id_productos;
      var elemento = document.getElementById("tbInventario");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function salidaProductos() {
  let codigoProducto = document.getElementById("nombreproducto").value;
  let cantidad = document.getElementById("cantidad").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData(frmInventario);
  console.log(codigoProducto, ": ", cantidad);
  data.append("codProducto", codigoProducto);
  data.append("cantidad", cantidad);
  data.append("accion", "salidaProducto");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);

    if (respuesta === "1") {
      console.log("Cantidad actualizada");
      guardaSalida(codigoProducto, cantidad);
    } else {
      swal.fire("AVISO DEL SISTEMA", "Error, cantidad no disponible", "error");
      console.log("Erro al actualizar");
    }
  };
  ajax.send(data);
}

function entradaProductos() {
  let codigoProducto = document.getElementById("nombreproducto").value;
  let cantidad = document.getElementById("cantidad").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData(frmInventario);
  data.append("codProducto", codigoProducto);
  data.append("cantidad", cantidad);
  data.append("accion", "entradaProducto");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);

    if (respuesta === "1") {
      guardarEntrada();
      console.log("Cantidad actualizada");
    } else {
      swal.fire("AVISO DEL SISTEMA", "Error al registrar entrada, Producto no existe", "error");
      console.log("Error al actualizar");
    }
  };
  ajax.send(data);
}

function guardarEntrada() {
  let codigoProducto = document.getElementById("nombreproducto").value;
  let cantidad = document.getElementById("cantidad").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData(frmInventario);
  data.append("codProducto", codigoProducto);
  data.append("cantidad", cantidad);
  data.append("selAccion", "1");
  data.append("accion", "guardarEntrada");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    buscarEntrada();
    buscarResumen();
    swal.fire(
      "AVISO DEL SISTEMA",
      "Se registro correctamente la entrada.",
      "success"
    );
  };
  ajax.send(data);
  document.getElementById("formInventario").reset();
}

function guardaSalida(codigoProducto, cantidad) {
  /* let codigoProducto = document.getElementById("nombreproducto").value;
  let cantidad = document.getElementById("cantidad").value;
   */
  console.log("registrando movimiento " + codigoProducto + ": " + cantidad);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData(frmInventario);
  data.append("codProducto", codigoProducto);
  data.append("cantidad", cantidad);
  data.append("selAccion", "2");
  data.append("accion", "guardarSalida");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    buscarSalida();
    buscarResumen();
    swal.fire(
      "AVISO DEL SISTEMA",
      "Se registro correctamente la salida.",
      "success"
    );
  };
  ajax.send(data);
  document.getElementById("formInventario").reset();
}
/*limit para el select*/
var numRegistors = document.getElementById("numRegistrosResumen");
numRegistors.addEventListener("change", function () {
  numPagina = 1;
  buscarResumen();
});
var numRegistorsEntradas = document.getElementById("numRegistrosEntradas");
numRegistorsEntradas.addEventListener("change", function () {
  numPagina = 1;
  buscarEntrada();
});
var numRegistorsSalidas = document.getElementById("numRegistrosSalidas");
numRegistorsSalidas.addEventListener("change", function () {
  numPagina = 1;
  buscarSalida();
});

/**************BUSCAR ENTRADA*******************/
let cajaBuscarEntrada = document.getElementById("inputbuscarEntradas");

cajaBuscarEntrada.addEventListener("keyup", function (e) {
  const textoBusquedaEntrada = cajaBuscarEntrada.value;
  console.log(textoBusquedaEntrada);
  numPagina = 1;
  buscarEntrada();
});

function buscarEntrada() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarEntradas");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistrosEntradas").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData();
  data.append("accion", "buscarEntradas");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let entrada = datos.listado;
    console.log(entrada);
    let template = ""; // Estructura de la tabla html

    if (entrada != "vacio" && entrada.length > 0) {
      entrada.forEach(function (entrada) {
        template += `
        <tr>
          
            <td>${entrada.nombreProducto}</td>
            <td>${entrada.cantidad}</td>
            
        </tr>
        `;
      });
      var elemento = document.getElementById("tbEntradas");
      elemento.innerHTML = template;
      document.getElementById("txtPagVistaEn").value = numPagina;
      document.getElementById("txtPagTotalEn").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${entrada.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbEntradas");
      elemento.innerHTML = `
          <tr>
            <td colspan="8" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
      document.getElementById("txtPagVistaEn").value = 1;
      document.getElementById("txtPagTotalEn").value = 1;
      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
          <p><span id="totalRegistros">Mostrando 0 de 0 registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    }
  };

  ajax.send(data);
}

/**************BUSCAR SALIDA*******************/
let cajaBuscarSalida = document.getElementById("inputbuscarSalidas");

cajaBuscarSalida.addEventListener("keyup", function (e) {
  const textoBusquedaSalida = cajaBuscarSalida.value;
  console.log(textoBusquedaSalida);
  numPagina = 1;
  buscarSalida();
});

function buscarSalida() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarSalidas");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistrosSalidas").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData();
  data.append("accion", "buscarSalidas");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let salida = datos.listado;
    console.log(salida);
    let template = ""; // Estructura de la tabla html

    if (salida != "vacio" && salida.length > 0) {
      salida.forEach(function (salida) {
        template += `
        <tr>
          
            <td>${salida.nombreProducto}</td>
            <td>${salida.cantidad}</td>
            
        </tr>
        `;
      });
      var elemento = document.getElementById("tbSalidas");
      elemento.innerHTML = template;
      document.getElementById("txtPagVistaSa").value = numPagina;
      document.getElementById("txtPagTotalSa").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${salida.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbSalidas");
      elemento.innerHTML = `
          <tr>
            <td colspan="8" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
      document.getElementById("txtPagVistaSa").value = 1;
      document.getElementById("txtPagTotalSa").value = 1;
      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
          <p><span id="totalRegistros">Mostrando 0 de 0 registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    }
  };

  ajax.send(data);
}

/**************BUSCAR RESUMEN*******************/
let cajaBuscarResumen = document.getElementById("inputbuscarInventario");

cajaBuscarResumen.addEventListener("keyup", function (e) {
  const textoBusquedaResumen = cajaBuscarResumen.value;
  console.log(textoBusquedaResumen);
  numPagina = 1;
  buscarResumen();
});

function buscarResumen() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarInventario");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistrosResumen").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData();
  data.append("accion", "buscarResumen");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let resumen = datos.listado;
    console.log(resumen);
    let template = ""; // Estructura de la tabla html

    if (resumen != "vacio" && resumen.length > 0) {
      resumen.forEach(function (resumen) {
        let estadoStyle =
          resumen.estado === "ENTRADA" ? "color: green;" : "color: red;"; // Establecer estilo según el estado

        template += `
        <tr>
          
            <td >${resumen.nombreProducto}</td>
            <td>${resumen.cantidad}</td>
            <td style = "${estadoStyle}; font-weight: bold;" >${resumen.estado}</td>

            
        </tr>
        `;
      });
      var elemento = document.getElementById("tbInventario");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${resumen.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbInventario");
      elemento.innerHTML = `
          <tr>
            <td colspan="8" class="text-center">No se encontraron resultados</td>
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

/****PAGINACIÓN RESUMEN****/
let pagInicio = document.querySelector("#btnPrimeroRe");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarResumen();
  pagInicio.blur();
});
let pagAnterior = document.querySelector("#btnAnteriorRe");
pagAnterior.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagDestino = 0;
  if (pagVisitada - 1 >= 1) {
    pagDestino = pagVisitada - 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarResumen();
    pagAnterior.blur();
  }
});
let pagSiguiente = document.querySelector("#btnSiguienteRe");
pagSiguiente.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagFinal = parseInt(document.getElementById("txtPagTotal").value);
  var pagDestino = 0;
  if (pagVisitada + 1 <= pagFinal) {
    pagDestino = pagVisitada + 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarResumen();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimoRe");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarResumen();
  pagFinal.blur();
});

/****PAGINACIÓN ENTRADA****/
let pagInicioEn = document.querySelector("#btnPrimeroEn");
pagInicioEn.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarEntrada();
  pagInicioEn.blur();
});
let pagAnteriorEn = document.querySelector("#btnAnteriorEn");
pagAnteriorEn.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagDestino = 0;
  if (pagVisitada - 1 >= 1) {
    pagDestino = pagVisitada - 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarEntrada();
    pagAnteriorEn.blur();
  }
});
let pagSiguienteEn = document.querySelector("#btnSiguienteEn");
pagSiguienteEn.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagFinal = parseInt(document.getElementById("txtPagTotal").value);
  var pagDestino = 0;
  if (pagVisitada + 1 <= pagFinal) {
    pagDestino = pagVisitada + 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarEntrada();
    pagSiguienteEn.blur();
  }
});
let pagFinalEn = document.querySelector("#btnUltimoEn");
pagFinalEn.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarEntrada();
  pagFinalEn.blur();
});

/****PAGINACIÓN SALIDA****/
let pagInicioSa = document.querySelector("#btnPrimeroSa");
pagInicioSa.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarSalida();
  pagInicioSa.blur();
});
let pagAnteriorSa = document.querySelector("#btnAnteriorSa");
pagAnteriorSa.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagDestino = 0;
  if (pagVisitada - 1 >= 1) {
    pagDestino = pagVisitada - 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarSalida();
    pagAnteriorSa.blur();
  }
});
let pagSiguienteSa = document.querySelector("#btnSiguienteSa");
pagSiguienteSa.addEventListener("click", function (e) {
  var pagVisitada = parseInt(document.getElementById("txtPagVista").value);
  var pagFinal = parseInt(document.getElementById("txtPagTotal").value);
  var pagDestino = 0;
  if (pagVisitada + 1 <= pagFinal) {
    pagDestino = pagVisitada + 1;
    numPagina = pagDestino;
    document.getElementById("txtPagVista").value = numPagina;
    buscarSalida();
    pagSiguienteSa.blur();
  }
});
let pagFinalSa = document.querySelector("#btnUltimoSa");
pagFinalSa.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarSalida();
  pagFinalSa.blur();
});
