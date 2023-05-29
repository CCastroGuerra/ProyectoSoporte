var id;
var numPagina = 1;
var frmRol = document.getElementById("formRoles");
console.log(numPagina);
buscarRol();
//listarRoles();
frmRol.onsubmit = function (e) {
  e.preventDefault();
  if (frmRol.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarRol();

    console.log("guardo");
  }
  frmRol.reset();
};

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  buscarRol();
});

function listarRoles() {
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/rolesController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "4");
  data.append("registros", num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const rol = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (rol.length > 0) {
      rol.forEach(function (rol) {
        template += `
                  <tr>
                      <td>${rol.id}</td>
                      <td>${rol.nombre}</td>
                      <td><button type="button" onClick='mostrarEnModal("${rol.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#rolesModal">Editar</button>
                      <button type="button" onClick = eliminarRol("${rol.id}") class="btn btn-danger" data-fila = "${rol.id}">Borrar</button></td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbRoles");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function buscarRol() {
  let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarRoles");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/rolesController.php", true);
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
    let rol = datos.listado;
    console.log(rol);
    let template = ""; // Estructura de la tabla html
    if (rol != "vacio") {
      rol.forEach(function (rol) {
        template += `
            <tr>
              
              <td>${rol.nombre}</td>
              <td>
              <button type="button" onClick='mostrarEnModal("${rol.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#rolesModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>

            
              <button type="button" onClick='eliminarRol("${rol.id}")' class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
              </button>


                
              </td>
            </tr>
          `;
      });
      var elemento = document.getElementById("tbRoles");
      elemento.innerHTML = template;
      // document.getElementById('txtPagVista').value = numPagina;
      // document.getElementById('txtPagTotal').value = datos.paginas;
      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${rol.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbRoles");
      elemento.innerHTML = `
          <tr>
            <td colspan="3" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
    }
  };
  ajax.send(data);
}

function guardarRol() {
  var realizado = "";
  var mensaje = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/rolesController.php", true);
  var data = new FormData(frmRol);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarRol();
    //listarArea();
    frmRol.reset();
  };
  ajax.send(data);
}

function mostrarEnModal(rolid) {
  id = rolid;
  console.log(id);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/rolesController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("inputRol").value = datos.nombre;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("inputRol");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
  swal
    .fire({
      title: "Aviso del Sistema",
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
        ajax.open("POST", "../controller/rolesController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarRol();
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

function limpiarFormulario() {
  frmRol.reset();
}

function eliminarRol(id) {
  console.log(id);
  swal
    .fire({
      title: "Aviso del Sistema",
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
        ajax.open("POST", "../controller/rolesController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarRoles();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        ajax.send(data);
      }
    });
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarRoles");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  buscarRol();
});
