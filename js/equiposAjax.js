let numPagina = 1;
buscarEquipo();
buscarResponsable();
//listarTablaTemp();
listarSelectTipo();
listarSelectMarca();
listarSelectArea();
listarSelectEstado();

let frmComponentes = document.getElementById("formEquipos");
let frmEquipos = document.getElementById("formAEquipo");
let modalp = frmEquipos.parentNode.parentNode.parentNode.id;
let modalc = document.getElementById("añadirComponente");
let frmResponsable = document.getElementById("formResponsable");
let selecModelo = document.getElementById("selModeloEquipo");
let selecMarca = document.getElementById("selMarcaEquipo");
let selectTipo = document.getElementById("selTipoEquipo");
let selectArea = document.getElementById("selArea");
let selectEstado = document.getElementById("selEstado");
let btnComponente = document.getElementById("btnComponente");
let btnCerrar = document.getElementById("cerrarBot");
let btnX = document.getElementById("cerrarSup");
let btnmodal = document.getElementById("btmodal");
var serieinp = document.getElementById("codigo");
let inpip = document.getElementById("ip");
var btmcomp = document.getElementById("btmcomp");
let id = 0;

//Mensajes de error
let alertTipo = document.getElementById("alertaTipo");
let alertMarca = document.getElementById("alertaMarca");
let alertModelo = document.getElementById("alertaModelo");
let alertArea = document.getElementById("alertaArea");
let alertEstado = document.getElementById("alertaEstado");
let alertMargesi = document.getElementById("alertaMargesi");
let alertaMComp = document.getElementById("alertaMcomp");

//variables de control
var btipo = 0;
var bmarca = 0;
var bmodelo = 0;
var barea = 0;
var bestado = 0;
var bmargesi = 0;
var bnadir = 0;

// cuando se recargue la pagina se limpiará la tabla temporal
document.addEventListener("keydown", function (evt) {
  var tecla = evt.key;
  //console.log(evt.key);
  var retorno = false;
  if (tecla === "F5") {
    evt.preventDefault();
    if (
      confirm(
        "Si recarga la página perdera todos los datos ingresados,\n ¿Deseas recargar la página?"
      ) == true
    ) {
      //console.log("preiosnaste si");
      let promesa = limpiarreiniciar();
      promesa.then(
        (e) => {
          //console.log("valor: "+e);
          location.reload();
        } //cuando terminó el método sin errores, ejecuta esto:
      );
    } else {
      console.log("presionaste no");
      retorno = false;
    }
  } else {
    retorno = true;
  }
  return retorno;
});

var wasPressed = false;
function Verificar() {
  var tecla = window.event.keyCode;
  if (tecla == 116) {
    confirm(
      'Si recarga la página perdera todos los datos ingresados,<br> ¿Deseas recargar la página?"',
      function (result) {
        if (result) {
          location.reload();
        } else {
          event.keyCode = 0;
          event.returnValue = false;
        }
      }
    );
  }
}
function fkey(e) {
  e = e || window.event;
  e.stopPropagation();
  e.preventDefault;
  if (wasPressed) return;

  if (e.keyCode == 116) {
    cerrarEditar();
    alert("f5 pressed");
    wasPressed = true;
    //return true;
  } else {
    alert("Window closed");
  }
}

//tabla de componentes
//boton guardar ->desactivado por defecto a menos que la tabla tbComponentes tenga elementos
let btmguardar = document.getElementById("btmGuardar");

$("#tbComponentes").bind("MutationObserver", function () {
  var tablacomponentes = document.querySelectorAll("#tbComponentes tr");
  console.log("la tabla cambió, componentes: " + tablacomponentes.length);
  if (tablacomponentes.length > 0) {
    //console.log("es mayor a 0");
    console.log(tablacomponentes[0].innerText.trim());
    if (
      tablacomponentes[0].innerText.trim() === "No se encontraron datos".trim()
    ) {
      //console.log(tablacomponentes[0].innerText + "-> igual a cadena");
      btmguardar.disabled = false;
    } else {
      //console.log("no es un igual a la cadena");
      btmguardar.disabled = false;
    }
  } else {
    console.log("no es 0");
  }
});

//estilo css de los mensajes de error
var ofr = document.querySelectorAll("#formAEquipo .alerta");
ofr.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});
var ofr = document.querySelectorAll("#frmComponentes .alerta");
ofr.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});

btnComponente.addEventListener("click", function (e) {
  e.preventDefault();
  if (frmEquipos.querySelector("#inputCodigo").value !== "") {
    // Realiza alguna acción cuando se envíe el formulario
    //actualizarCompoentesTempo();
    //console.log("guardando componentes actualizados");
  } else {
    guardarEquipo();

    console.log("guardados los datos del equipo...");
  }
  //frmEquipos.reset();
});

/***Evento para controlar boton cerrar al momento de editar***/
btnCerrar.addEventListener("click", function (e) {
  e.preventDefault();
  cerrarEditar();
});
btnX.addEventListener("click", function (e) {
  e.preventDefault();
  cerrarEditar();
});
/***********************************************************/

/*Habilitar o deshabilitar boton de añador*/
let margesi = document.getElementById("margesi");
var contbtañadir = 0;
selectTipo.addEventListener("change", function () {
  //verifica si se ha sellecionado una opcion valida de tipo
  if (selectTipo.value == 0) {
    alertTipo.innerText = "Seleccione una opcion válida";
    btipo = 0;
  } else {
    alertTipo.innerText = "";
    btipo = 1;
  }
});
selecMarca.addEventListener("change", function () {
  //verifica si se ha sellecionado una opcion valida de marca
  console.log("cambio marca");
  if (selecMarca.value == 0) {
    alertMarca.innerText = "Seleccione una opcion válida";
    console.log("el valor es 0");
    bmarca = 0;
    bmodelo = 0;
    selecModelo.disabled = true;
  } else {
    alertMarca.innerText = "";
    bmarca = 1;
    selecModelo.disabled = false;
    listarSelectModelo();
  }
});
selecModelo.addEventListener("change", function () {
  //verifica si se ha sellecionado una opcion valida de modelo
  if (selecModelo.value == 0) {
    alertModelo.innerText = "Seleccione una opcion válida";
    bmodelo = 0;
  } else {
    alertModelo.innerText = "";
    bmodelo = 1;
  }
});

selectArea.addEventListener("change", function () {
  //Verifica si se ha seleccionado una opcion valida de area
  if (selectArea.value == 0) {
    alertArea.innerText = "Seleccione una opcion válida";
    barea = 0;
  } else {
    alertArea.innerText = "";
    barea = 1;
  }
});

selectEstado.addEventListener("change", function () {
  //Verifica si se ha seleccionado una opcion valida de estado
  if (selectEstado.value == 0) {
    alertEstado.innerText = "Seleccione una opcion válida";
    bestado = 0;
  } else {
    alertEstado.innerText = "";
    bestado = 1;
  }
});

margesi.addEventListener("input", function () {
  // Verifica si el valor del input no está vacío
  if (margesi.value.trim().length > 0) {
    // Habilita el botón
    alertMargesi.innerText = "";
    bmargesi = 1;
  } else {
    // Deshabilita el botón
    btnComponente.disabled = true;
    alertMargesi.innerText = "es un valor obligatorio";
    bmargesi = 0;
  }
});
var pattern =
  /\b(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/;
x = 46;
$("#ip")
  .keypress(function (e) {
    if (
      e.which != 8 &&
      e.which != 0 &&
      e.which != x &&
      (e.which < 48 || e.which > 57)
    ) {
      console.log(e.which);
      return false;
    }
  })
  .keyup(function () {
    var this1 = $(this);
    if (!pattern.test(this1.val())) {
      $("#alertaIP").text("No es un IP válido");
      while (this1.val().indexOf("..") !== -1) {
        this1.val(this1.val().replace("..", "."));
      }
      x = 46;
    } else {
      x = 0;
      var lastChar = this1.val().substr(this1.val().length - 1);
      if (lastChar == ".") {
        this1.val(this1.val().slice(0, -1));
      }
      var ip = this1.val().split(".");
      if (ip.length == 4) {
        $("#alertaIP").text("");
      }
    }
  });

frmEquipos.addEventListener("input", function () {
  console.log("cambio detectado en el formulario");
  validarFormulario();
});

frmEquipos.addEventListener("change", function () {
  console.log("cambio detectado en el formulario");
  validarFormulario();
});

function validarFormulario() {
  bnadir = btipo + bmarca + bmodelo + barea + bestado + bmargesi;
  console.log("completos: " + bnadir);
  if (bnadir == 6) {
    btnComponente.disabled = false;
  } else {
    btnComponente.disabled = true;
  }
}

//cambiar titulo de modal
const modal = document.getElementById(modalp);
modal.addEventListener("show.coreui.modal", (event) => {
  console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  console.log("el modal fue levantado por: " + button.id);
  var modalTitle = modal.querySelector(".modal-title");
  //limpiar mensajes de error
  alertTipo.innerText = "";
  alertMarca.innerText = "";
  alertModelo.innerText = "";
  alertArea.innerText = "";
  alertEstado.innerText = "";
  alertMargesi.innerText = "";
  //modelo debe estar bloqueado
  switch (button.id) {
    case "btmodal":
      modalTitle.textContent = "Guardar";
      selecModelo.disabled = true;
      btnComponente.disabled = true;
      btmguardar.disabled = false;
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar";
      selecModelo.disabled = false;
      btnComponente.disabled = false;
      btmguardar.disabled = false;
      break;
  }
});

modalc.addEventListener("show.coreui.modal", (event) => {
  document.getElementById("formEquipos").reset();
  btmcomp.disabled = false;
});
/**** */

btnmodal.addEventListener("click", function () {
  //condiciones iniciales del modal equipos
  console.log("modal abierto");
  btnComponente.disabled = true;
  btmguardar.disabled = false;
});
/***************************************/
//----validar modal componentes//

btmcomp.disabled = true;
serieinp.addEventListener("input", function () {
  if (serieinp.value.trim().length > 0) {
    alertaMComp.innerText = "";
    btmcomp.disabled = false;
  } else {
    alertaMComp.innerText = "el elemento no puede estar vacío";
  }
});

/***************************************/

frmComponentes.onsubmit = function (e) {
  e.preventDefault();
  guardarComponentes();
  //frmEquipos.reset();
};

/*
frmComponentes.onsubmit = function (e) {
  e.preventDefault();
  var elemento = document.getElementById("tbComponentes");

  if (elemento.rows.length === 0) {
    console.log("Ejecutando solo guardar");
    guardarComponentes();
  } else {
    console.log("Ejecutando guardar-Actualizar");
    //insertarTempParaActualizar();
    actualizarCompoentesTempo(equipoID);
    }

  //frmEquipos.reset();
};*/

frmEquipos.onsubmit = function (e) {
  e.preventDefault();
  //validar elementos
  if (selectTipo.value == 0) {
    alertTipo.innerText = "Seleccione una opcion válida";
    btipo = 0;
  } else {
    alertTipo.innerText = "";
    btipo = 1;
  }
  if (selecMarca.value == 0) {
    alertMarca.innerText = "Seleccione una opcion válida";
    console.log("el valor es 0");
    bmarca = 0;
    bmodelo = 0;
    selecModelo.disabled = true;
  } else {
    alertMarca.innerText = "";
    bmarca = 1;
    selecModelo.disabled = false;
    listarSelectModelo();
  }
  if (selecModelo.value == 0) {
    alertModelo.innerText = "Seleccione una opcion válida";
    bmodelo = 0;
  } else {
    alertModelo.innerText = "";
    bmodelo = 1;
  }
  if (selectArea.value == 0) {
    alertArea.innerText = "Seleccione una opcion válida";
    barea = 0;
  } else {
    alertArea.innerText = "";
    barea = 1;
  }
  if (selectEstado.value == 0) {
    alertEstado.innerText = "Seleccione una opcion válida";
    bestado = 0;
  } else {
    alertEstado.innerText = "";
    bestado = 1;
  }
  if (margesi.value.trim().length > 0) {
    // Habilita el botón
    alertMargesi.innerText = "";
    bmargesi = 1;
  } else {
    // Deshabilita el botón
    btnComponente.disabled = true;
    alertMargesi.innerText = "es un valor obligatorio";
    bmargesi = 0;
  }

  bnadir = btipo + bmarca + bmodelo + barea + bestado + bmargesi;
  console.log("completos: " + bnadir);
  if (bnadir == 6) {
    guardarEquipo();
    swal.fire("Registrado!", "Se registro correctamente.", "success");
    $("#" + modalp).modal("hide");
  }

  // guardarEquipoComponente();
};
/*
frmResponsable.onsubmit = function (e) {
  e.preventDefault();
 
};*/

/* selecModelo.disabled = true;
selecMarca.addEventListener("change", () => {
  console.log("cambio marca");
  listarSelectModelo();
}); */

function listarSelectModelo() {
  return new Promise(function (resolve, reject) {
    console.log("selctMarca cambio");
    let marcaId = selecMarca.value;
    console.log(marcaId);
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open("POST", "../controller/equiposController.php", true);
    var data = new FormData();
    data.append("accion", "listarModel");
    data.append("id", marcaId);
    selecModelo.disabled = false;
    ajax.onload = () => {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      let marcas = JSON.parse(respuesta);
      console.log(marcas);
      let options = "<option value=''>Seleccione un Modelo</option>";
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
      document.getElementById("selModeloEquipo").innerHTML = options;
      resolve("terminado");
    };
    ajax.send(data);
  });
}

function listarSelectMarca() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
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
      var elemento = document.getElementById("selMarcaEquipo");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectArea() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarArea");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const area = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      template = `<option value="0">Seleccione Área</option>
          `;
      area.forEach(function (area) {
        template += `
                     
                      <option value="${area.id}">${area.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selArea");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectEstado() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarEstado");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const estado = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (estado.length > 0) {
      template = `<option value="0">Seleccione Estado</option>
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

/**************BUSCAR RESPONSABLE*************/
let cajaBuscarrResp = document.getElementById("buscaRes");

cajaBuscarrResp.addEventListener("keyup", function (e) {
  const textoBusquedaPre = cajaBuscarrResp.value;
  console.log(textoBusquedaPre);
  numPagina = 1;
  buscarResponsable();
});
/**************BUSCAR EQUIPO*******************/
let cajaBuscaREquipo = document.getElementById("inputbuscarEquipos");

cajaBuscaREquipo.addEventListener("keyup", function (e) {
  const textoBusquedaEquipo = cajaBuscarrResp.value;
  console.log(textoBusquedaEquipo);
  numPagina = 1;
  buscarEquipo();
});

/*********limit para el select***********/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  numPagina = 1;
  buscarEquipo();
});

/*********************************************/

function buscarResponsable() {
  let numPagina = 1;
  var cajaBuscar = document.getElementById("buscaRes");
  const textoBusqueda = cajaBuscar.value;
  //let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "buscarResponsable");
  data.append("cantidad", "5");
  //data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("buscaRes", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let responsable = datos.listado;
    //console.log(equipos);
    let template = ""; // Estructura de la tabla html
    if (responsable != "vacio") {
      responsable.forEach(function (responsable) {
        template += `
                  <tr>
                      <td style="visibility:collapse; display:none;">${responsable.id}</td>
                      <td>${responsable.dni}</td>
                      <td>${responsable.nombre}</td>
                      <td>
                      <button type="button" class="btn btn-success btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirEquipo"><i class="fa fa-plus" aria-hidden="true"></i>

                      </td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbresp");
      elemento.innerHTML = template;
      document.getElementById("txtPagVistaPre").value = numPagina;
      document.getElementById("txtPagTotalPre").value = datos.paginas;

      /* Seleccionar datos de la tabla */
      /*Modal presentación*/

      // Obtén una referencia a la tabla después de su generación
      const tabla = document.getElementById("tbresp");

      // Obtén todas las filas de la tabla
      const filas = tabla.getElementsByTagName("tr");

      //Obteniendo referencia del input
      const inputResponsable = document.getElementById("responsable");
      const inputIdResponsable = document.getElementById("respValue");

      // Itera sobre las filas y agrega un evento de clic a cada una
      for (let i = 0; i < filas.length; i++) {
        const fila = filas[i];
        fila.addEventListener("click", function () {
          // Seleccionar la fila
          console.log("Fila seleccionada:", fila);

          // Obtener los datos de las celdas
          const celdas = fila.getElementsByTagName("td");
          const id = celdas[0].innerText;
          const nombre = celdas[2].innerText;
          console.log(nombre);
          console.log("Id del cliente: " + id);

          // Mostrar valor en input
          inputResponsable.value = nombre;
          inputIdResponsable.value = id;
          frmResponsable.reset();
        });
      }
    } else {
      var elemento = document.getElementById("tbresp");
      elemento.innerHTML = `
          <tr>
            <td colspan="10" class="text-center">No se encontraron resultados</td>
          </tr>
        `;

      // document.getElementById("txtPagVista").value = 0;
      // document.getElementById("txtPagTotal").value = 0;
    }
  };
  ajax.send(data);
}

function listarSelectTipo() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarTipo");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const tipo = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (tipo.length > 0) {
      template = `<option value="0">Seleccione Tipo Equipo</option>
          `;
      tipo.forEach(function (tipo) {
        template += `
                     
                      <option value="${tipo.id}">${tipo.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selTipoEquipo");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function guardarComponentes() {
  let codigo = document.getElementById("codigo").value;
  let margesi = document.getElementById("margesi").value;
  let inputCodigo = document.getElementById("inputCodigo").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("codigo", codigo);
  data.append("accion", "traerComponentes");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    if (respuesta !== "") {
      let datos = JSON.parse(respuesta);
      console.log(datos);

      // let apellidos = datos.apellidos;
      // let nombre  = datos.nombre;
      id = datos[0].id;
      // let apellidos = datos[0].apellidos;
      // let nombre = datos[0].nombre;

      const ajaxGuardar = new XMLHttpRequest();
      ajaxGuardar.open("POST", "../controller/equiposController.php", true);
      let dataGuardar = new FormData();
      dataGuardar.append("accion", "guardarTempo");
      dataGuardar.append("id", id);
      dataGuardar.append("codigo", codigo);
      dataGuardar.append("margesi", margesi);
      dataGuardar.append("inputCodigo", inputCodigo);

      ajaxGuardar.onload = function () {
        let resp = ajaxGuardar.responseText;
        console.log(resp);
        if (resp === "1") {
          console.log("Datos guardados correctamente");
          listarTablaTemp();
          swal.fire("Registrado!", "Se registro correctamente.", "success");
        } else {
          console.log("Error al guardar los datos");
          swal.fire("ERROR!", "Error al guardar los datos", "error");
        }
      };
      ajaxGuardar.send(dataGuardar);
    } else {
      console.log("NO SE ENCONTRO EL COMPONENTE");
      swal.fire(
        "ERROR!",
        "No se encontro el componente o ya esta ingresado",
        "error"
      );
    }
  };
  ajax.send(data);
  listarTablaTemp();
}

function listarTablaTemp() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarTablaTempo");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const temp = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (temp.length > 0) {
      template = ``;
      temp.forEach(function (temp) {
        template += `
        <tr>
        <td>${temp.serie}</td>
        <td>${temp.nombreTipo}</td>
        <td>${temp.nombreClase}</td>
        <td>${temp.nombreMarca}</td>
        <td>${temp.nombreModelo}</td>
        <td>${temp.capacidad}</td>
        <td>${temp.estado}</td>
        <td>
        <button type="button" onClick='eliminarComponentesTemp("${temp.id}")' class="btn btn-danger" data-fila="${temp.serie}"><i class="fa fa-trash" aria-hidden="true"></i>
  
        </button>
        </td>
        </tr>             
              `;
      });
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = template;
    } else {
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = ` <tr>
      <td colspan="8" class="text-center">No se encontraron datos</td>
    </tr>`;
    }
  };
  ajax.send(data);
}

function guardarEquipo() {
  var realizado = "";
  let resp = document.getElementById("responsable");
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData(frmEquipos);
  //data.append("responsable",resp);
  data.append("accion", "guardarEquipo");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log("Contenido de realizado: " + realizado);
    let respuesta = JSON.parse(realizado);
    //console.log("Contenido de respuesta.listado =" + respuesta.listado);
    if (respuesta.listado * 1 > 0) {
      document.getElementById("inputCodigo").value = respuesta.listado;

      guardarEquipoComponente();
    }
    buscarEquipo();
  };
  ajax.send(data);
  var elemento = document.getElementById("tbComponentes");
  elemento.innerHTML = ``;
}

function guardarEquipoComponente() {
  let inputCodigo = document.getElementById("inputCodigo").value;
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  /*data.append("serie", serie);
  data.append("margesi",margesi);*/
  data.append("inputCodigo", inputCodigo);
  data.append("accion", "guardarEquipoComponente");
  ajax.onload = function () {
    realizado = ajax.responseText;

    console.log(realizado);
    if (realizado * 1 > 0) {
      /*no quitar */

      console.log("Equipo Componente registrado correctamente");
    }
    //buscarArea();
    //buscarComponente();
    //frmEquipos.reset();
  };
  ajax.send(data);
}

function buscarEquipo() {
  var cajaBuscar = document.getElementById("inputbuscarEquipos");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "buscarEquipos");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let equipos = datos.listado;
    console.log(equipos);
    let template = ""; // Estructura de la tabla html
    if (equipos != "vacio") {
      equipos.forEach(function (equipos) {
        template += `
                  <tr>                    
                      <td>${equipos.codigo}</td>
                      <td>${equipos.nombreArea}</td>
                      <td>${equipos.nombreMarca}</td>
                      <td>${equipos.nombreModelo}</td>
                      <td>${equipos.serie}</td>
                      <td>${equipos.margesi}</td>
                      <td>${equipos.ip}</td>
                      <td>${equipos.mac}</td>
                      <td>${equipos.estado}</td>
                      <td>${equipos.Fecha}</td>
                      <td class="text-center">
                        <button type="button" onClick='mostrarEnModal("${equipos.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirEquipo"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </button>                      
                      </td>

                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${equipos.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = `
          <tr>
            <td colspan="10" class="text-center">No se encontraron resultados</td>
          </tr>
        `;

      // document.getElementById("txtPagVista").value = 0;
      // document.getElementById("txtPagTotal").value = 0;
    }
  };
  ajax.send(data);
}

/*function componentesEquipoEnModal(equipoIdTemp) {
  equipoIdTemp = id;
  console.log("id para mostrar detalles de equipo: " + equipoIdTemp);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  const data = new FormData();
  data.append("id", equipoIdTemp);
  data.append("accion", "mostrarComponentesEquipos");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let componentes = datos.listado;
    console.log(componentes);

    console.log(componentes);
    let template = ""; // Estructura de la tabla html
    if (componentes != "vacio") {
      componentes.forEach(function (componentes) {
        template += `
                  <tr>
                      <td>${componentes.serie}</td>
                      <td>${componentes.nombreTipo}</td>
                      <td>${componentes.nombreClase}</td>
                      <td>${componentes.nombreMarca}</td>
                      <td>${componentes.nombreModelo}</td>
                      <td>${componentes.capacidad}</td>
                      <td>${componentes.estado}</td>
                      <td>
                      <button type="button" onClick='eliminarComponentesTemp("${componentes.serie}")' class="btn btn-danger" data-fila="${datos.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                      </td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = template;
    } else {
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
    }
  };
  ///mostrarEnModal();
  listarTablaTemp();
  ajax.send(data);
  //listarTablaTemp();
}*/

function mostrarEnModal(equipoID) {
  btnComponente.disabled = false;
  btmguardar.disabled = false;
  id = equipoID;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    console.log(datos);
    document.getElementById("selMarcaEquipo").value = datos.nombreMarca;
    /* var promise = listarSelectModelo();
    console.log(promise); */
    let promise = listarSelectModelo();
    promise.then((e) => {
      console.log("values: " + e);
      console.log("message: termino listar SelectModelo");
      selecModelo.value = datos.nombreModelo;
      console.log("modelo seleccionado: " + datos.nombreModelo);
    });

    document.getElementById("selTipoEquipo").value = datos.nombreTipo;
    document.getElementById("serie").value = datos.serie;
    document.getElementById("margesi").value = datos.margesi;
    document.getElementById("respValue").value = datos.nombrePersonalId;
    document.getElementById("responsable").value = datos.nombrePersonal;
    document.getElementById("selArea").value = datos.area;
    document.getElementById("selEstado").value = datos.estado;
    document.getElementById("mac").value = datos.mac;
    document.getElementById("ip").value = datos.ip;
    /*Evento necesario para el combo anidado */

    document.getElementById("inputCodigo").value = datos.id;
  };
  //insertarTempParaActualizar();
  setTimeout(() => {
    insertarTempParaActualizar();
    //listarTablaTemp();
  }, 750);
  /* setTimeout(() => {
    selecModelo.value = datos.nombreModelo;
    console.log("modelo seleccionado: "+datos.nombreModelo);
  }, 500); */
  ajax.send(data);
  //componentesEquipoEnModal();
}

// function eliminarComponentes(id) {
//   console.log(id);
//   swal
//     .fire({
//       title: "AVISO DEL SISTEMA",
//       text: "¿Desea Eliminar el Componente?",
//       icon: "error",
//       showCancelButton: true,
//       confirmButtonText: "Si",
//       cancelButtonText: "No",
//       reverseButtons: true,
//     })
//     .then((result) => {
//       if (result.isConfirmed) {
//         const ajax = new XMLHttpRequest();
//         ajax.open("POST", "../controller/equiposController.php", true);
//         const data = new FormData();
//         data.append("id", id);
//         data.append("accion", "eliminarComponente");
//         ajax.onload = function () {
//           var respuesta = ajax.responseText;
//           console.log(respuesta);
//           listarTablaTemp();
//           swal.fire(
//             "Eliminado!",
//             "El registro se elimino correctamente.",
//             "success"
//           );
//         };
//         /*let tab = document.getElementById("tbComponentes");
//         if (tab.rows.length == 1) {
//           //document.getElementById('txtPagVistaPre').value = numPagina - 1;
//           numPagina = numPagina - 1;
//         }*/
//         ajax.send(data);
//       }
//     });
// }

/*Funcion para cargar los componentes de los equipos existentes*/
function insertarTempParaActualizar(equipoID) {
  //let codigo = document.getElementById("codigo").value;
  equipoID = id;
  console.log("id del componente para guarda: " + equipoID);
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("id", equipoID);
  data.append("accion", "inserTablaTempActualizar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      console.log("se insertaron datos en la tabla temporal");
      listarTablaTemp();
    }
    /*buscarArea();
    buscarComponente();
    buscarEquipo();
    frmEquipos.reset();
    */
  };
  ajax.send(data);

  var elemento = document.getElementById("tbComponentes");
  elemento.innerHTML = ``;
  //actualizarCompoentesTempo(equipoIdTemp);
}

/*function actualizarCompoentesTempo(actuaId) {
  actuaId = id;
  console.log("id para actuañozar componenete: " + actuaId);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  const data = new FormData();
  data.append("id", actuaId);
  data.append("accion", "actualizarTempComponentes");
  ajax.onload = function () {
    var respuesta = ajax.responseText;
    console.log(respuesta);
    //listarTablaTemp();
    // swal.fire(
    //   "Eliminado!",
    //   "El registro se elimino correctamente.",
    //   "success"
    // );
    console.log("Se actualizo correctamente en la temporal...!!!");
    listarTablaTemp();

  };
  //let tab = document.getElementById("tbComponentes");
  // if (tab.rows.length == 1) {
  //   //document.getElementById('txtPagVistaPre').value = numPagina - 1;
  //   numPagina = numPagina - 1;
  // }
  ajax.send(data);
  guardarEquipoComponente();
}*/

function eliminarComponentesTemp(serie) {
  console.log("Id para eliminar componentes de tabla temporal: " + serie);
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea Eliminar el Componente?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/equiposController.php", true);
        const data = new FormData();
        data.append("id", serie);
        data.append("accion", "eliminarComponenteTemp");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarTablaTemp();
          swal.fire(
            "Eliminado!",
            "El componente se elimino correctamente.",
            "success"
          );
        };
        //let tab = document.getElementById("tbComponentes");
        // if (tab.rows.length == 1) {
        //   //document.getElementById('txtPagVistaPre').value = numPagina - 1;
        //   numPagina = numPagina - 1;
        // }
        ajax.send(data);
      }
    });
}

function cerrarEditar() {
  let idEquipo = document.getElementById("inputCodigo").value;
  console.log("id equipo boton: " + idEquipo);
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("id", idEquipo);
  data.append("accion", "botonCerrar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      console.log("Se borro datos de temporal");
      //listarTablaTemp();
    }
  };
  frmEquipos.reset();
  var elemento = document.getElementById("tbComponentes");
  elemento.innerHTML = ``;
  ajax.send(data);
}

function limpiarreiniciar() {
  return new Promise(function (resolve, reject) {
    let idEquipo = document.getElementById("inputCodigo").value;
    console.log("id equipo boton: " + idEquipo);
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open("POST", "../controller/equiposController.php", true);
    var data = new FormData();
    data.append("id", idEquipo);
    data.append("accion", "botonCerrar");
    ajax.onload = function () {
      realizado = ajax.responseText;
      console.log(realizado);
      if (realizado * 1 > 0) {
        console.log("Se borro datos de temporal");
        resolve("terminado->a reiniciar");
        //listarTablaTemp();
      } else {
        reject("algo ha fallado");
      }
      frmEquipos.reset();
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = ``;
    };

    ajax.send(data);
  });
}

/*********Paginación equipo***********/
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarEquipo();
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
    buscarEquipo();
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
    buscarEquipo();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarEquipo();
  pagFinal.blur();
});
