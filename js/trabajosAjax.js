listarSelecServicios();
listarSelecTecnicos();
//listarTablaTempServicios();
buscarTrabajos();
/****************************************/
let frmServicios = document.getElementById("formServicios");
let frmTrabajos = document.getElementById("frmTrabajoa");
let btnCerrar = document.getElementById("btncerrar");
let btnServicios = document.getElementById("btnServicio"); //btn que levanta modal servicio
btnServicios.disabled = true;
/***************************************/

/***********recorrer elememntos a validar****************/
let inpserie = document.getElementById("nroSerie");
let inpmargesi = document.getElementById("marquesi");
let inpusuario = document.getElementById("nombreUsuario");
let inparea = document.getElementById("selArea");
let inpequipo = document.getElementById("selEquipo");
let inpmarca = document.getElementById("selMarca");
let inpmodelo = document.getElementById("selModelo");
let inpfalla = document.getElementById("fallaObservada");
let snptecnico = document.getElementById("selTecnico");
let inpsol = document.getElementById("textSolucion");
let inprecom = document.getElementById("textrecom");

//Mensajes de error
let alserie = document.getElementById("alserie");
let almargesi = document.getElementById("almargesi");
let alusuario = document.getElementById("alusuario");
let alarea = document.getElementById("alarea");
let alequipo = document.getElementById("alequipo");
let almarca = document.getElementById("almarca");
let almodelo = document.getElementById("almodelo");
let alfalla = document.getElementById("alfalla");
let altecnico = document.getElementById("altecnico");
let alsolucion = document.getElementById("alsolucion");
let alrecom = document.getElementById("alrecom");

//variables de control
var bserie = 0;
var bfalla = 0;
var btecnico = 0;
var bsol = 0;
var brecom = 0;
var contro = 0;
/*******************************************************/

/*****************estilo de las alertas****************/
let msgal = document.querySelectorAll(".alerta");
msgal.forEach((element) => {
  element.setAttribute("style", "color:red !important;");
});

var botonesEd = "";
/******************************************************/

/* Activar boton añadir con validaciones*/
inpserie.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    bserie = 1;
    alserie.innerText = "";
    mostrarDatosEquipoXSerie();
  } else {
    bserie = 0;
    alserie.innerText = "nro de serie no válido";
  }
});

inpfalla.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    bfalla = 1;
    alfalla.innerText = "";
  } else {
    bfalla = 0;
    alfalla.innerText = "Debe registrar una falla observada";
  }
});

snptecnico.addEventListener("input", function () {
  console.log("valor cambiado");
  if (this.value > 0) {
    btecnico = 1;
    altecnico.innerText = "";
  } else {
    btecnico = 0;
    altecnico.innerText = "Seleccione una opción válida";
  }
});

inpsol.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    bsol = 1;
    alsolucion.innerText = "";
  } else {
    bsol = 0;
  }
});

inprecom.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    brecom = 1;
    alrecom.innerText = "";
  } else {
    brecom = 0;
  }
});

frmTrabajos.addEventListener("change", function () {
  var contro = 0;
  contro = bserie + bfalla + btecnico;
  console.log("se esta escribiendo, elementos: " + contro);
  if (contro == 3) {
    btnServicios.disabled = false;
    console.log("boton habilitado");
  } else {
    btnServicios.disabled = true;
  }
});
/************************/

/**********validaciones para la vista de edicion*******/
/* btnEditar.addEventListener("click", function () {
  inpserie.disabled = true;
  inpmargesi.disabled = true;
  inpusuario.disabled = true;
  inparea.disabled = true;
  inpequipo.disabled = true;
  inpmarca.disabled = true;
  inpmodelo.disabled = true;
}); */
/******************************************************/

frmServicios.onsubmit = function (e) {
  e.preventDefault();
  guardarServiciosTempo();
};

frmTrabajos.onsubmit = function (e) {
  e.preventDefault();
  //contro = bserie + bfalla + btecnico;
  console.log("campos: " + contro);
  guardarTrabajo();
  $("#TrabajoModal").modal("hide");
  setTimeout(cerrarEditar(), 5000);
};

let btnBuscarEquipo = document.getElementById("testBusca");
btnBuscarEquipo.addEventListener("click", function (e) {
  e.preventDefault();
  mostrarDatosEquipoXSerie();
});

btnServicios.addEventListener("click", function (e) {
  e.preventDefault();
  console.log("click en añadir servicios");
  var contro = 0;
  contro = bserie + bfalla + btecnico;
  if (frmTrabajos.querySelector("#inputCodigo").value !== "") {
    console.log("No deberia de hacer nada");
  } else {
    if (contro == 3) {
      guardarTrabajo();
      console.log("Trabajo guardado");
    }
  }
});

/**************BUSCAR TRABAJOS*************/
let cajaBuscarTrabajos = document.getElementById("inputbuscarTrabajo");

cajaBuscarTrabajos.addEventListener("keyup", function (e) {
  const textoBusquedaPre = cajaBuscarTrabajos.value;
  console.log(textoBusquedaPre);
  numPagina = 1;
  buscarTrabajos();
});

/*********limit para el select***********/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  numPagina = 1;
  buscarTrabajos();
});

/***Evento para controlar boton cerrar al momento de editar***/
btnCerrar.addEventListener("click", function (e) {
  e.preventDefault();
  cerrarEditar();
});

function mostrarDatosEquipoXSerie() {
  let idSerie = document.getElementById("nroSerie").value;
  console.log(idSerie);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  const data = new FormData();
  data.append("serie", idSerie);
  data.append("accion", "mostrarDetallesEquipo");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    if (respuesta == "") {
      alserie.innerText = "el # de Serie no existe";
    } else {
      let datos = JSON.parse(respuesta);
      console.log(datos);
      document.getElementById("idEquipo").value = datos.id;
      document.getElementById("marquesi").value = datos.margesi;
      document.getElementById("nombreUsuario").value = datos.nombrePersonal;
      document.getElementById("nombreUsuarioID").value = datos.nombrePersonalId;
      document.getElementById("selArea").value = datos.nombreArea;
      document.getElementById("selAreaID").value = datos.areaID;
      document.getElementById("selEquipo").value = datos.nombreTipo;
      document.getElementById("selMarca").value = datos.nombreMarca;
      document.getElementById("selModelo").value = datos.nombreModelo;
    }
  };

  ajax.send(data);
}

function listarSelecServicios() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  data.append("accion", "listarServicios");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const servicios = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (servicios.length > 0) {
      template = `<option value="0">Seleccione Servicios</option>
          `;
      servicios.forEach(function (servicios) {
        template += `
                     
                      <option value="${servicios.id}">${servicios.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selServicio");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelecTecnicos() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  data.append("accion", "listarTecnicos");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const tecnicos = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (tecnicos.length > 0) {
      template = `<option value="0">Seleccione Técnico</option>
          `;
      tecnicos.forEach(function (tecnicos) {
        template += `
                     
                      <option value="${tecnicos.id}">${tecnicos.nombreTecnico}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selTecnico");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarTablaTempServicios() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  data.append("accion", "listarTablaTempServicios");
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
        <td>${temp.nombreServicio}</td>
        <td>
        <button type="button" onClick='eliminarServiciosTemp("${temp.idtemp}")' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        </td>
        </tr>             `;
      });
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = template;
    } else {
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = ` <tr>
      <td colspan="6" class="text-center">No se encontraron datos</td>
    </tr>`;
    }
  };
  ajax.send(data);
}

function guardarServiciosTempo() {
  // let idServicios = document.getElementById().value;
  let idTrabajo = document.getElementById("inputCodigo").value;
  let idEquipo = document.getElementById("idEquipo").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  let dataGuardar = new FormData(frmServicios);
  //dataGuardar.append("idServicios", idServicios);
  dataGuardar.append("idtrabajo", idTrabajo);
  dataGuardar.append("idEquipo", idEquipo);
  dataGuardar.append("accion", "guardarServiciosTemp");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);

    if (respuesta === "1") {
      console.log("Datos guardados correctamente");
      swal.fire("Registrado!", "Se registro correctamente.", "success");
      listarTablaTempServicios();
    } else {
      console.log("Error al guardar servicio");
      swal.fire("ERROR!", "Error al guardar los datos", "error");
    }
  };
  ajax.send(dataGuardar);
}

function guardarTrabajo() {
  let realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData(frmTrabajos);
  //data.append("responsable",resp);
  data.append("accion", "guardarTrabajos");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log("Contenido de realizado: " + realizado);
    let respuesta = JSON.parse(realizado);
    //console.log("Contenido de respuesta.listado =" + respuesta.listado);
    if (respuesta.listado * 1 > 0) {
      document.getElementById("inputCodigo").value = respuesta.listado;

      guardarTrabajosServicios();
    }

    buscarTrabajos();
  };
  ajax.send(data);
  var elemento = document.getElementById("tbEquipos");
  elemento.innerHTML = ``;
}

function guardarTrabajosServicios() {
  let inputCodigo = document.getElementById("inputCodigo").value;
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  /*data.append("serie", serie);
  data.append("margesi",margesi);*/
  data.append("inputCodigo", inputCodigo);
  data.append("accion", "guardarTrabajosServicios");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      /*swal.fire(
        "Registrado!",
        "El equipo se registro correctamente.",
        "success"
      );*/
      console.log("Trabajos-Servicios registrado correctamente");
    }
    buscarTrabajos();
    //buscarArea();
    //buscarComponente();
    //frmEquipos.reset();
  };
  ajax.send(data);
}

function buscarTrabajos() {
  let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarTrabajo");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  data.append("accion", "buscarTrabajos");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let trabajos = datos.listado;
    console.log(trabajos);
    let template = ""; // Estructura de la tabla html
    if (trabajos != "vacio") {
      trabajos.forEach(function (trabajos) {
        template += `
                  <tr>
                      <td>${trabajos.serie}</td>
                      <td>${trabajos.margesi}</td>
                      <td>${trabajos.nombreResponsable}</td>
                      <td>${trabajos.nombreArea}</td>
                      <td>${trabajos.nombreTecnico}</td>
                      <td>${trabajos.fecha}</td>
                      <td>
                      <button type="button" onClick='mostrarEnModal("${trabajos.idTrabajo}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#TrabajoModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button class="btn" style="background-color: green" type="button" onClick='imprimir("${trabajos.idTrabajo}")' id="btnImprimir"<i class="fa fa-print" aria-hidden="true"></i>
                      </button>
                      </td>

                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbTrabajos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;
      botonesEd = document.querySelectorAll("#btnEditar");
      botonesEd.forEach((el) => {
        el.addEventListener("click", function () {
          inpserie.disabled = true;
          inpmargesi.disabled = true;
          inpusuario.disabled = true;
          inparea.disabled = true;
          inpequipo.disabled = true;
          inpmarca.disabled = true;
          inpmodelo.disabled = true;
          btnServicios.disabled = false;
        });
      });

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${trabajos.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbTrabajos");
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

function mostrarEnModal(trabajoId) {
  //btnComponente.disabled = false;
  id = trabajoId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    console.log(datos);
    document.getElementById("idEquipo").value = datos.idEquipos;
    document.getElementById("nroSerie").value = datos.serie;
    document.getElementById("marquesi").value = datos.margesi;
    document.getElementById("nombreUsuario").value = datos.nombreResponsable;
    document.getElementById("nombreUsuarioID").value = datos.nombrePersonalId;
    document.getElementById("selArea").value = datos.nombreArea;
    document.getElementById("selAreaID").value = datos.areaID;
    document.getElementById("selEquipo").value = datos.tipoEquipo;
    document.getElementById("selMarca").value = datos.nombreMarca;
    document.getElementById("selModelo").value = datos.nombreModelo;
    document.getElementById("fallaObservada").value = datos.falla;
    document.getElementById("selTecnico").value = datos.nombreTecnico;
    document.getElementById("textSolucion").value = datos.solucion;
    document.getElementById("textrecom").value = datos.recomendacion;
    document.getElementById("inputCodigo").value = datos.id;
  };
  //guardarTempParaActualizar();
  insertarTempParaActualizar();
  ajax.send(data);
  //componentesEquipoEnModal();
  listarTablaTempServicios();
  buscarTrabajos();
}

/*Funcion para cargar los componentes de los equipos existentes*/
function insertarTempParaActualizar(trabajoId) {
  //let codigo = document.getElementById("codigo").value;
  trabajoId = id;
  console.log("id del componente para guarda: " + trabajoId);
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  data.append("id", trabajoId);
  data.append("accion", "inserTablaTempActualizar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      console.log("se insertaron datos en la tabla temporal");
      listarTablaTempServicios();
    }
    /*buscarArea();
    buscarComponente();
    buscarEquipo();
    frmEquipos.reset();
    */
  };
  ajax.send(data);

  var elemento = document.getElementById("tbTrabajos");
  elemento.innerHTML = ``;
  //actualizarCompoentesTempo(equipoIdTemp);
}

function eliminarServiciosTemp(idcomponente) {
  console.log(
    "Id para eliminar componentes de tabla temporal: " + idcomponente
  );
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea Eliminar el Servicio?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/trabajosController.php", true);
        const data = new FormData();
        data.append("id", idcomponente);
        data.append("accion", "eliminarServiciosTemp");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarTablaTempServicios();
          swal.fire(
            "Eliminado!",
            "El servicio se elimino correctamente.",
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
  let idTrabajo = document.getElementById("inputCodigo").value;
  console.log("id equipo boton: " + idTrabajo);
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/trabajosController.php", true);
  var data = new FormData();
  data.append("id", idTrabajo);
  data.append("accion", "botonCerrar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      console.log("Se borro datos de temporal");
      //listarTablaTemp();
    }
  };
  //frmTrabajos.reset();
  var elemento = document.getElementById("tbEquipos");
  elemento.innerHTML = ``;
  ajax.send(data);
}

function imprimir(idTrabajo) {
  //let link = "../view/reportesTrabajosTabla.php?id=" + idTrabajo;
  // let link = "../view/reportesTrabajosTabla.php?id=" + idTrabajo;
  // window.open(link, "_blank");
  id = idTrabajo;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/trabajosController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrarEnTabla");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    console.log(datos.idTipoTrabajo);
    let link;
    if (datos.idTipoTrabajo == 0) {
      link = "../view/reportesTrabajosTabla.php?id=" + idTrabajo;
    } else {
      link = "../view/reporteImpresora.php?id=" + idTrabajo;
    }
    window.open(link, "_blank");
    //document.getElementById("nombre").value = datos.nombrePersonal;
  };
  ajax.send(data);
}

/*********Paginación trabajos***********/
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarTrabajos();
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
    buscarTrabajos();
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
    buscarTrabajos();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarTrabajos();
  pagFinal.blur();
});
