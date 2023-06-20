buscarBajas();
let id = 0;
var numPagina = 1;

let frmBajas = document.getElementById("formBajas");
//let alertEquipo = document.getElementById("Equipo");
let btnGuardar = document.getElementById("btnGuardar");
let aletCombo = document.getElementById("combo");
//let alertMotivo = document.getElementById("txtMotivo");
//let equipo = document.getElementById("codigoEquipo").value;

frmBajas.onsubmit = function (e) {
  e.preventDefault();
  if (frmBajas.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarBajas();
    //listarArea();
    console.log("guardo");
  }
  frmBajas.reset();
};

let mouse = document.querySelector(".modal-footer");

btnGuardar.disabled = true;
/*mouse.addEventListener("mouseover", function (e) {
  console.log("mouseenter");
  let tipoSelect = document.getElementById("selArea").value;
  let motivo = document.getElementById("motivo").value;
  //console.log(tipoSelect);
  let equipo = document.getElementById("codigoEquipo").value;
  

  if (equipo === "" || equipo.trim().length == 0 || equipo.trim().length < 6) {
    alertEquipo.innerText = "Por favor, ingresa una serie valida.";
  } else {
    alertEquipo.innerText = "";
  }

  if (tipoSelect == 0 || tipoSelect == "") {
    aletCombo.innerText = "Por favor, seleccione un tipo de baja.";
  } else {
    aletCombo.innerText = "";
  }

  if (motivo === "") {
    alertMotivo.innerText = "Por favor ingrese el motivo de la baja.";
  } else {
    alertMotivo.innerText = "";
  }
});
*/

/*********************************/
// Obtener referencias a los elementos del formulario
let equipoInput = document.getElementById("codigoEquipo");
let tipoSelect = document.getElementById("selArea");
let motivoInput = document.getElementById("motivo");
// Reemplaza "tuFormulario" con el ID de tu formulario

// Mensajes de error
let alertEquipo = document.getElementById("Equipo");
let alertTipo = document.getElementById("combo");
let alertMotivo = document.getElementById("txtMotivo");

// Función para realizar las validaciones
function validarFormulario() {
  let equipo = equipoInput.value;
  let tipo = tipoSelect.value;
  let motivo = motivoInput.value;

  // Validar campo de equipo
  if (equipo === "" || equipo.trim().length == 0 || equipo.trim().length < 6) {
    alertEquipo.innerText = "Por favor, ingresa una serie válida.";
  } else {
    alertEquipo.innerText = "";
  }

  // Validar campo de tipo
  if (tipo === "" || tipo === "0") {
    alertTipo.innerText = "Por favor, selecciona un tipo de baja.";
  } else {
    alertTipo.innerText = "";
  }

  // Validar campo de motivo
  if (motivo === "") {
    alertMotivo.innerText = "Por favor, ingrese el motivo de la baja.";
  } else {
    alertMotivo.innerText = "";
    btnGuardar.disabled = false;
  }
}

// Asignar la función de validación a los eventos input de los campos
equipoInput.addEventListener("input", validarFormulario);
tipoSelect.addEventListener("input", validarFormulario);
motivoInput.addEventListener("input", validarFormulario);

// Asignar la función de validación al evento mouseover del formulario
mouse.addEventListener("mouseover", validarFormulario);

/********************************/

function guardarBajas() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/bajasController.php", true);
  var data = new FormData(frmBajas);
  data.append("accion", "guardarBajas");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    buscarBajas();

    swal.fire(
      "AVISO DEL SISTEMA",
      "Se registro correctamente la baja.",
      "success"
    );
  };
  ajax.send(data);
}

function editarEstadoEquipo() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/bajasController.php", true);
  var data = new FormData(frmBajas);
  data.append("accion", "editarEstadoEquipo");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    console.log("Se cambio el estado del equipo");
  };
  ajax.send(data);
}

// function buscarBajas() {
//   let numPagina = 1;
//   var cajaBuscar = document.getElementById("inputbuscarBajas");
//   const textoBusqueda = cajaBuscar.value;
//   let num_registros = document.getElementById("numRegistros").value;
//   const ajax = new XMLHttpRequest();
//   ajax.open("POST", "../controller/bajasController.php", true);
//   var data = new FormData();
//   data.append("accion", "buscarBajas");
//   data.append("cantidad", "4");
//   data.append("registros", num_registros);
//   data.append("pag", numPagina);
//   data.append("textoBusqueda", textoBusqueda);
//   ajax.onload = function () {
//     let respuesta = ajax.responseText;
//     console.log(respuesta);
//     const datos = JSON.parse(respuesta);
//     console.log(datos);
//     let bajas = datos.listado;
//     console.log(bajas);
//     let template = ""; // Estructura de la tabla html
//     if (bajas != "vacio") {
//       bajas.forEach(function (bajas) {
//         let estadoStyle =
//           bajas.tipoBajas === "TEMPORAL" ? "color: #bbaf1b;" : "color: red;";
//         template += `
//               <tr>

//                 <td>${bajas.nombreTipoEquipo}</td>
//                 <td>${bajas.nombreArea}</td>
//                 <td>${bajas.motivo}</td>
//                 <td>${bajas.fecha}</td>
//                 <td style = "${estadoStyle}; font-weight: bold;">${bajas.tipoBajas}</td>
//                 <td>
//                 <button type="button" onClick='mostrarEnModal("${bajas.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#bajasModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
//                 </button>
//                 <button type="button" onClick='eliminarBajas("${bajas.id}")' class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
//                 </button>

//                 </td>
//               </tr>
//             `;
//       });
//       var elemento = document.getElementById("tbBajas");
//       elemento.innerHTML = template;
//       document.getElementById("txtPagVista").value = numPagina;
//       document.getElementById("txtPagTotal").value = datos.paginas;

//       /* Mostrando mensaje de los registros*/
//       let registros = document.getElementById("txtcontador");
//       let mostrarRegistro = `
//         <p><span id="totalRegistros">Mostrando ${bajas.length} de ${datos.total} registros</span></p>`;
//       registros.innerHTML = mostrarRegistro;
//     } else {
//       var elemento = document.getElementById("tbBajas");
//       elemento.innerHTML = `
//             <tr>
//               <td colspan="3" class="text-center">No se encontraron resultados</td>
//             </tr>
//           `;
//     }
//   };
//   ajax.send(data);
// }

function buscarBajas() {
  let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarBajas");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/bajasController.php", true);
  var data = new FormData();
  data.append("accion", "buscarBajas");
  data.append("cantidad", "4");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let bajas = datos.listado;
    console.log(bajas);
    let template = ""; // Estructura de la tabla html
    if (bajas != "vacio") {
      bajas.forEach(function (bajas) {
        let estadoStyle =
          bajas.tipoBajas === "TEMPORAL" ? "color: #bbaf1b;" : "color: red;";
        let botonEliminar =
          bajas.tipoBajas === "TEMPORAL"
            ? `<button type="button" onClick='eliminarBajas("${bajas.id}")' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>`
            : "";

        template += `
          <tr>
            <td>${bajas.nombreTipoEquipo}</td>
            <td>${bajas.nombreArea}</td>
            <td>${bajas.motivo}</td>
            <td>${bajas.fecha}</td>
            <td style="${estadoStyle}; font-weight: bold;">${bajas.tipoBajas}</td>
            <td>
              <button type="button" onClick='mostrarEnModal("${bajas.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#bajasModal">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
              ${botonEliminar}
            </td>
          </tr>
        `;
      });
      var elemento = document.getElementById("tbBajas");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
        <p><span id="totalRegistros">Mostrando ${bajas.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbBajas");
      elemento.innerHTML = `
        <tr>
          <td colspan="3" class="text-center">No se encontraron resultados</td>
        </tr>
      `;
    }
  };
  ajax.send(data);
}

function mostrarEnModal(bajasId) {
  id = bajasId;
  console.log(id);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/bajasController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrarBajas");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("codigoEquipo").value = datos.serie;
    document.getElementById("selArea").value = datos.nombreTipoId;
    document.getElementById("motivo").value = datos.motivo;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  let selArea = document.getElementById("selArea").value;
  let motivo = document.getElementById("motivo").value;
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
        ajax.open("POST", "../controller/bajasController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("selArea", selArea);
        data.append("motivo", motivo);
        data.append("accion", "actualizarBaja");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarBajas();
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

function eliminarBajas(id) {
  let codigoEquipo = document.getElementById("codigoEquipo").value;

  console.log(id);
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea Eliminar la baja?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/bajasController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("codigoEquipo", codigoEquipo);
        data.append("accion", "eliminarBaja");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarBajas();
          swal.fire(
            "Eliminado!",
            "La baja se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbBajas");
        if (tab.rows.length == 1) {
          numPagina = numPagina - 1;
        }
        ajax.send(data);
      }
    });
}
