var numPagina = 1;
let id = "";
var frmPersonal = document.getElementById("formEmpleados");
buscarPersonal();
//listarPersonal();

frmPersonal.onsubmit = function (e) {
  e.preventDefault();
  if (frmPersonal.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    //actualizar(id);
    actualizar(id);
  } else {
    // guardarArea();
    // listarArea();
    guardarPersonal();
    console.log("guardo");
  }
  frmPersonal.reset();
};

function listarPersonal() {
  // let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/personalController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const personal = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (personal.length > 0) {
      personal.forEach(function (personal) {
        template += `
                    <tr>
                        <td>${personal.id}</td>
                        <td>${personal.apellidos}</td>
                        <td>${personal.nombre}</td>
                        <td>${personal.cargoPersonal}</td>
                        <td>${personal.nombreUsuario}</td>
                        <td>${personal.contraseña}</td>
                        <td><button type="button" onClick='mostrarEnModal("${personal.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirEmpleado">Editar</button>
                        <button type="button" onClick = eliminarPersonal("${personal.id}") class="btn btn-danger" data-fila = "${personal.id}">Borrar</button></td>
                    </tr>
                    `;
      });
      var elemento = document.getElementById("tbPersonal");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function guardarPersonal() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/personalController.php", true);
  var data = new FormData(frmPersonal);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarPersonal();
    //listarArea();
    frmPersonal.reset();
  };
  ajax.send(data);
}

function mostrarEnModal(personalId) {
  id = personalId;
  console.log(id);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/personalController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("apellidos").value = datos.apellidos;
    document.getElementById("nombre").value = datos.nombre;
    document.getElementById("selCargo").value = datos.cargoId;
    document.getElementById("usuario").value = datos.nombreUsuario;
    document.getElementById("password").value = datos.contraseña;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const apellidosInput = document.getElementById("apellidos");
  const nombreInput = document.getElementById("nombre");
  const usuarioInput = document.getElementById("usuario");
  const passworInput = document.getElementById("password");
  const codigoInput = document.getElementById("inputCodigo");
  // Obtener los valores actualizados desde los elementos del modal
  const apellido = apellidosInput.value;
  const nombre = nombreInput.value;
  const usuario = usuarioInput.value;
  const password = passworInput.value;
  const codigo = codigoInput.value;
  const combo = elemento.value;
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
        ajax.open("POST", "../controller/personalController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("apellido", apellido);
        data.append("nombre", nombre);
        data.append("usuario", usuario);
        data.append("password", password);
        data.append("codigo", codigo);
        data.append("selCargo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarPersonal();
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

function eliminarPersonal(id) {
  console.log(id);
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
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
        ajax.open("POST", "../controller/personalController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarPersonal();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbPersonal");
        if (tab.rows.length == 1) {
          //document.getElementById('txtPagVistaPre').value = numPagina - 1;
          numPagina = numPagina - 1;
        }
        ajax.send(data);
      }
    });
}

function limpiarFormulario() {
  frmPersonal.reset();
}

let elemento = document.getElementById("selCargo");
elemento.onchange = function () {
  var valorSeleccionado = elemento.value;
  console.log("Valor seleccionado:", valorSeleccionado);
};

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  numPagina = 1;
  buscarPersonal();
});

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarPersonal");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina=1;
  buscarPersonal();
});

function buscarPersonal() {
  var cajaBuscar = document.getElementById("inputbuscarPersonal");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/personalController.php", true);
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
    let personal = datos.listado;
    console.log(personal);
    let template = ""; // Estructura de la tabla html
    if (personal != "vacio") {
      personal.forEach(function (personal) {
        template += `
          <tr>
          
          <td>${personal.apellidos}</td>
          <td>${personal.nombre}</td>
          <td>${personal.cargoPersonal}</td>
          <td>${personal.nombreUsuario}</td>
          <td>${personal.contraseña}</td>

          <td>
          

          <button type="button" onClick='mostrarEnModal("${personal.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirEmpleado"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </button>
              
          <button type="button" onClick='eliminarPersonal("${personal.id}")' class="btn btn-danger" data-fila="${personal.id}"><i class="fa fa-trash" aria-hidden="true"></i>
          </button>

          </td>
      </tr>
      `;
      });
      var elemento = document.getElementById("tbPersonal");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
       <p><span id="totalRegistros">Mostrando ${personal.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbPersonal");
      elemento.innerHTML = `
          <tr>
            <td colspan="7" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
    }
  };
  ajax.send(data);
}

/**************************/
/* BOTONES DE PAGINACIÓN PRODUCTO*/
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarPersonal();
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
    buscarPersonal();
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
    buscarPersonal();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarPersonal();
  pagFinal.blur();
});
