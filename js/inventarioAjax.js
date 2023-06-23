buscarEntrada();
buscarSalida();
buscarResumen();
let cbxAccion = document.getElementById("selAccion");
let inproducto = document.getElementById("nombreproducto");
let inctd = document.getElementById("cantidad");
let msgs= document.querySelectorAll(".error-message");

msgs.forEach((element)=>{
  element.setAttribute("style","color:red !important");
});

cbxAccion.addEventListener("change", function (e) {
  console.log("cambio en select tipo");
  if(cbxAccion.value==0){
    document.getElementById("errorAccion").innerText="Selecione una opción valida";
  }else{document.getElementById("errorAccion").innerText="";}
});

inproducto.addEventListener("input", function (){
  if (this.value.trim().length==0) {
    document.getElementById("errorProducto").innerText="El Codigo de Producto es obligatorio";
  }else{
    document.getElementById("errorProducto").innerText="";
  }
});

inctd.addEventListener("input", function (){
  if (this.value.trim().length==0) {
    document.getElementById("errorProducto").innerText="La cantidad es obligatoria";
  }else{
    
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

document.getElementById("formInventario").addEventListener("submit", function (event) {
    if (!this.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
      this.classList.add("was-validated");
    } else {
      // Resto del código para guardar los datos

      // Cerrar el modal manualmente
      var modal = document.getElementById("inventarioModal");
      var coreuiModal = new bootstrap.Modal(modal);
      coreuiModal.hide();
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
  data.append("codProducto", codigoProducto);
  data.append("cantidad", cantidad);
  data.append("accion", "salidaProducto");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);

    if (respuesta === "1") {
      console.log("Cantidad actualizada");
      guardaSalida();
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
      swal.fire("AVISO DEL SISTEMA", "Error al registrar entrada", "error");
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
}

function guardaSalida() {
  let codigoProducto = document.getElementById("nombreproducto").value;
  let cantidad = document.getElementById("cantidad").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/inventarioController.php", true);
  var data = new FormData(frmInventario);
  data.append("codProducto", codigoProducto);
  data.append("cantidad", cantidad);
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
  let numPagina = 1;
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
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

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
  let numPagina = 1;
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
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

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
  let numPagina = 1;
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
    }
  };

  ajax.send(data);
}
