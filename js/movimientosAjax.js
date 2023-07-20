//listarTablaMovimientos();
let id;
let numPagina = 1;
listarSelecTecnicos();
listarSelecArea();
buscarMovimientos();
/***********************************/
let selecAccion = document.getElementById("selTipo");
let selecTecnico =document.getElementById("selTecnico");
let idEquipo = document.getElementById("codEquipo");
let frmMovimientos = document.getElementById("frmTrabajoa");
let frmAgregarEquipos = document.getElementById("formServicios");
let btnAñadir = document.getElementById("btnServicio");
let cajaIdMovimiento = document.getElementById("idMov");
let btnGuardarEquipo = document.getElementById("guardarEquipo");

//modal equipos
let areaOrig = document.getElementById("areaORId");
let areaDest = document.getElementById("selServicio");
/***********************************/
/***** alertas */
let alTipo = document.getElementById("alerta1");
let alTecnico = document.getElementById("alerta2");
let msg0 = "";
let msgT = "Seleccione una opcion válida";
let msgTc = "Asigne un Técnico autorizado";
var ofr = document.querySelectorAll(`#${frmMovimientos.id} .alerta`);
ofr.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});
/************* */
/******variables de control */
let btipo=1;
let btecnico=1;
/************************** */
/******eventos de error */
function activar_botondet(){
  if(validarFormulario()){
    btnAñadir.disabled=false;    
  } else{    
    btnAñadir.disabled=true;
  }
}


selecAccion.addEventListener("change",(e)=>{
  console.log("seleccionado: "+selecAccion.value);
  if (selecAccion.value == 0) {
    alTipo.innerText=msgT;
    btipo=1;
  } else {
    alTipo.innerText=msg0;
    btipo=0;
  }  
  activar_botondet();
});
selecTecnico.addEventListener("change",(e)=>{
  if (selecTecnico.value == 0) {
    alTecnico.innerText=msgTc;
    btecnico=1;
  } else {
    alTecnico.innerText=msg0;
    btecnico=0;    
  }
  activar_botondet();
});
function validarFormulario(){
  let cont = btipo + btecnico;
  let ret;
  console.log(cont);
  if (cont==0) {
    ret = true
  } else {
    ret = false;
  }
  return ret;
}



//cambiar titulo de modal
const modal = document.getElementById("TrabajoModal");
modal.addEventListener("show.coreui.modal", (event) => {
  //console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  //console.log("el modal fue levantado por: " + button.id);
  var modalTitle = modal.querySelector(".modal-title");
  btipo=1;
  btecnico=1;
  //limpiar mensajes de error
  alTipo.innerText="";
  alTecnico.innerText="";
  //modelo debe estar bloqueado
  switch (button.id) {
    case "btmodal":
      modalTitle.textContent = "Registrar Movimiento";
      btnAñadir.disabled=true;
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar Movimiento";
      btnAñadir.disabled =false;
      break;
  }
});


/********************** */
frmMovimientos.onsubmit = function (e) {
  e.preventDefault();
  let cajaid = frmMovimientos.querySelector("#idMov").value;
  console.log("id a guardar: "+ cajaid);
  
    //actualizar
    actualizar(cajaid);
  
};

idEquipo.addEventListener("input", function () {
  mostrarAreaXId();
});

btnAñadir.addEventListener("click", function () {
  if (cajaIdMovimiento.value.trim().length == "") {
    guardarMovimiento();
  } else {
    console.log("a agregar detalle");
  }
});

btnGuardarEquipo.addEventListener("click", function () {
  let id = cajaIdMovimiento.value;
  if (id.length > 0) {
    console.log("id de movimiento es: " + id);
  }
  guardarEquipos();
});

function listarSelecTecnicos() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
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
      //var elemento = document.getElementById("selTecnico");
      selecTecnico.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelecArea() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("accion", "listarArea");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const area = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      template = `<option value="0">Seleccione Area</option>
              `;
      area.forEach(function (area) {
        template += `
                         
                          <option value="${area.id}">${area.nombre}</option>
                      
                          `;
      });
      //var elemento = document.getElementById("selServicio");
      areaDest.innerHTML = template;
    }
  };
  ajax.send(data);
}

function mostrarAreaXId() {
  let idEqu = idEquipo.value;
  console.log(idEqu);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  const data = new FormData();
  data.append("codEquipo", idEqu);
  data.append("accion", "mostrarAreaXEquipo");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    if (respuesta == "") {
      //alserie.innerText = "el # de Serie no existe";
      console.log("el # de Serie no existe");
    } else {
      let datos = JSON.parse(respuesta);
      console.log(datos);
      document.getElementById("areaOR").value = datos.nombreArea;
      areaOrig.value = datos.areaId;
    }
  };

  ajax.send(data);
}

function guardarMovimiento() {
  let tipoMovimiento = selecAccion.value;
  let idTecnico = selecTecnico.value;
  let observacion = document.getElementById("fallaObservada").value;
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("selTipo", tipoMovimiento);
  data.append("selTecnico", idTecnico);
  data.append("fallaObservada", observacion);
  data.append("accion", "guardarMovimiento");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      //swal.fire("Registrado!", "Registrado correctamente.", "success");
      cajaIdMovimiento.value = realizado;
    }

    // buscarArea();
    // //listarArea();
    // frmArea.reset();
  };
  ajax.send(data);
}

function guardarEquipos() {
  let cajaIdMov = cajaIdMovimiento.value;
  let codigoEquipo = idEquipo.value;
  let areaOrigne = areaOrig.value;
  let areaDestino = areaDest.value;
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("idMov", cajaIdMov);
  data.append("codEquipo", codigoEquipo);
  data.append("areaOR", areaOrigne);
  data.append("selServicio", areaDestino);
  data.append("accion", "guardarEquipo");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      // swal.fire("Registrado!", "Registrado correctamente.", "success");
      console.log("Se registro Correctamente el equipo");
    }
    listarTablaMovimientos(cajaIdMov);
    frmAgregarEquipos.reset();
  };
  ajax.send(data);
}

function listarTablaMovimientos() {
  let cajaIdMov = cajaIdMovimiento.value;
  console.log(cajaIdMov);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("idMov", cajaIdMov);
  data.append("accion", "listarTablaMovimiento");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const area = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      area.forEach(function (area) {
        template += `
                  <tr>
                      <td>${area.idEquipo}</td>
                      <td>${area.areaOrigen}</td>
                      <td>${area.areaDestino}</td>
                      <td><button type="button" onClick='eliminarEquipoMovimiento("${area.idEquipo}")' class="btn btn-danger pelim" id="btnEditar"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button></td>
                    
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function buscarMovimientos() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarTrabajo");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("accion", "buscarMovimiento");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let movimientos = datos.listado;
    console.log(movimientos);
    let template = ""; // Estructura de la tabla html
    if (movimientos != "vacio") {
      movimientos.forEach(function (movimientos) {
        template += `
        <tr>
        <td>${movimientos.id}</td>
        <td>${movimientos.tipo}</td>
        <td>${movimientos.nombreTecnico}</td>
        <td>${movimientos.observacion}</td>
        <td>${movimientos.fecha}</td>
        <td>
            <div class="row">
                <div class="col-lg-6 col-sm-6 px-5">
                    <button type="button" onClick='mostrarEnModal("${movimientos.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#TrabajoModal"><i class="fa fa-pencil-square-o text-white" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <button class="btn" style="background-color: green" type="button" onClick='imprimir("${movimientos.id}")' id="btnImprimir"> <i class="fa fa-print text-white" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
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
      <p><span id="totalRegistros">Mostrando ${movimientos.length} de ${datos.total} registros</span></p>`;
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

function mostrarEnModal(idMovimiento) {
  id = idMovimiento;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  const data = new FormData();
  data.append("idMov", id);
  data.append("accion", "mostrarMovimientoXid");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    console.log(datos);
    cajaIdMovimiento.value = datos.id;
    selecAccion.value = datos.tipoMovimientoId;
    selecTecnico.value = datos.tecnicoId;
    document.getElementById("fallaObservada").value = datos.observacion;
    listarTablaMovimientos(id);
  };

  ajax.send(data);
}

function eliminarEquipoMovimiento(id) {
  console.log(id);
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea Eliminar el Equipo?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/movimientosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminarEquipoMov");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);

          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
          listarTablaMovimientos(id);
        };
        let tab = document.getElementById("tbEquipos");
        if (tab.rows.length == 1) {
          numPagina = numPagina - 1;
        }
        ajax.send(data);
      }
    });
}

function actualizar(id) {
  let selectTecnico = selecTecnico.value;
  let tipoMovimientoInput = selecAccion.value;
  let observacion = document.getElementById("fallaObservada").value;
  // Obtener los valores actualizados desde los elementos del modal

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("selTipo", tipoMovimientoInput);
  data.append("selTecnico", selectTecnico);
  data.append("fallaObservada", observacion);
  data.append("accion", "actualizarMovimientos");
  ajax.onload = function () {
    console.log(ajax.responseText);
    buscarMovimientos();
    swal.fire("Registrado!", "Datos registrados correctamente.", "success");
  };
  //cajaBuscar.value = "";
  ajax.send(data);
}

function imprimir(idMovimiento) {
  let link = "../view/reporteEntregaRetiro.php?id=" + idMovimiento;

  window.open(link, "_blank");
}
