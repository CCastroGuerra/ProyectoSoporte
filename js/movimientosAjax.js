//listarTablaMovimientos();
let numPagina = 1;
listarSelecTecnicos();
listarSelecArea();
buscarMovimientos();
/***********************************/
let selecAccion = document.getElementById("selTipo").value;
let idEquipo = document.getElementById("codEquipo");
let frmMovimientos = document.getElementById("frmTrabajoa");
let frmAgregarEquipos = document.getElementById("formServicios");
let btnAñadir = document.getElementById("btnServicio");
let cajaIdMovimiento = document.getElementById("idMov");
let btnGuardarEquipo = document.getElementById("guardarEquipo");

/***********************************/
frmMovimientos.onsubmit = function (e) {
  e.preventDefault();
  actualizar(id);
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
  let id = document.getElementById("idMov").value;
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
      var elemento = document.getElementById("selTecnico");
      elemento.innerHTML = template;
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
      var elemento = document.getElementById("selServicio");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function mostrarAreaXId() {
  let idEquipo = document.getElementById("codEquipo").value;
  console.log(idEquipo);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  const data = new FormData();
  data.append("codEquipo", idEquipo);
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
      document.getElementById("areaORId").value = datos.areaId;
    }
  };

  ajax.send(data);
}

function guardarMovimiento() {
  let tipoMovimiento = document.getElementById("selTipo").value;
  let idTecnico = document.getElementById("selTecnico").value;
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
      document.getElementById("idMov").value = realizado;
    }

    // buscarArea();
    // //listarArea();
    // frmArea.reset();
  };
  ajax.send(data);
}

function guardarEquipos() {
  let cajaIdMovimiento = document.getElementById("idMov").value;
  let codigoEquipo = document.getElementById("codEquipo").value;
  let areaOrigne = document.getElementById("areaORId").value;
  let areaDestino = document.getElementById("selServicio").value;
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("idMov", cajaIdMovimiento);
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
    listarTablaMovimientos(cajaIdMovimiento);
    frmAgregarEquipos.reset();
  };
  ajax.send(data);
}

function listarTablaMovimientos() {
  let cajaIdMovimiento = document.getElementById("idMov").value;
  console.log(cajaIdMovimiento);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/movimientosController.php", true);
  var data = new FormData();
  data.append("idMov", cajaIdMovimiento);
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
                      <td><button type="button" onClick='eliminarEquipoMovimiento("${area.idEquipo}")' class="btn btn-danger pelim" ><i class="fa fa-trash" aria-hidden="true"></i>
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
    document.getElementById("idMov").value = datos.id;
    document.getElementById("selTipo").value = datos.tipoMovimientoId;
    document.getElementById("selTecnico").value = datos.tecnicoId;
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
  let selectTecnico = document.getElementById("selTecnico").value;
  let tipoMovimientoInput = document.getElementById("selTipo").value;
  let observacion = document.getElementById("fallaObservada").value;
  // Obtener los valores actualizados desde los elementos del modal

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
          swal.fire(
            "Actualizado!",
            "El registro se actualizó correctamente.",
            "success"
          );
        };
        //cajaBuscar.value = "";
        ajax.send(data);
      }
    });
}
