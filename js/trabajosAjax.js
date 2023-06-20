listarSelecServicios();
listarSelecTecnicos();
//listarTablaTempServicios();
buscarTrabajos();
/****************************************/
let frmServicios = document.getElementById("formServicios");
let frmTrabajos = document.getElementById("frmTrabajoa");
let btnCerrar = document.getElementById("btncerrar");
let btnServicios = document.getElementById("btnServicio");
/***************************************/

frmServicios.onsubmit = function (e) {
  e.preventDefault();
  guardarServiciosTempo();
};

frmTrabajos.onsubmit = function (e) {
  e.preventDefault();
  guardarTrabajo();
};

let btnBuscarEquipo = document.getElementById("testBusca");
btnBuscarEquipo.addEventListener("click", function (e) {
  e.preventDefault();
  mostrarDatosEquipoXSerie();
});

btnServicios.addEventListener("click", function (e) {
  e.preventDefault();
  if (frmTrabajos.querySelector("#inputCodigo").value !== "") {
    console.log("No deberia de hacer nada");
  } else {
    guardarTrabajo();
    console.log("Trabjo guardado");
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
                      
                      </td>

                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbTrabajos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

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
  frmTrabajos.reset();
  var elemento = document.getElementById("tbEquipos");
  elemento.innerHTML = ``;
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
