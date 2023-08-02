var numPagina = 1;
let dni = "";
var frmUsuario = document.getElementById("formEmpleados");

const modalp = frmUsuario.parentNode.parentNode.parentNode.id;
buscarUsuario();
let codpersonal = document.getElementById("codPersonal");
let usernam = document.getElementById("username");
let userpass = document.getElementById("userpass");

let alertacod = document.getElementById("alcod");
let alertauser = document.getElementById("aluser");
let alertapass = document.getElementById("alpass");

//variables de control
var vcod = 0;
var vuser = 0;
var vpass = 0;
var vcon = 0;

let msgal = document.querySelectorAll(".alerta");
/* estableciendo estilo de mensajes de error */
msgal.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});

//validacion al llenar los input
codpersonal.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    alertacod.innerText = "";
  }
});

usernam.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    alertauser.innerText = "";
  }
});

userpass.addEventListener("input", function () {
  if (this.value.trim().length > 0) {
    alertapass.innerText = "";
  }
});
//visbilidad de  contraseña
$("#togglePassword").on("click", function () {
  console.log("click" + $(this));
  var typ = $(this).parent().parent().find("#userpass").attr("type");
  console.log("input: " + typ);
  var rvisible = "../img/icons8-visible-16.png";
  var rinvisible = "../img/icons8-invisible-16.png";
  if (typ == "password") {
    $(this).attr("src", rvisible);
    $(this).parent().parent().find("#userpass").attr("type", "text");
  } else {
    $(this).attr("src", rinvisible);
    $(this).parent().parent().find("#userpass").attr("type", "password");
  }
});

//cambiar titulo de modal
const modal = document.getElementById(modalp);
modal.addEventListener("show.coreui.modal", (event) => {
  console.log("el modal se ha levantado");
  //reconocer que boton ha sido el que efectuo el evento
  var button = event.relatedTarget;
  console.log("el modal fue levantado por: " + button.id);
  var modalTitle = modal.querySelector(".modal-title");
  var msgal = document.querySelectorAll("#formEmpleados .alerta");
  msgal.forEach((element) => {
    element.innerText = "";
  });
  switch (button.id) {
    case "":
      modalTitle.textContent = "Guardar";
      frmUsuario.reset();
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar";
      break;
  }
});
/**** */

frmUsuario.onsubmit = function (e) {
  console.log("click submit");
  e.preventDefault();
  if (frmUsuario.querySelector("#inputCodigo").value !== "") {
    //console.log("actualizo");
    //actualizar(id);
  } else {
    if (codpersonal.value.trim().length == 0) {
      vcod = 0;
      alertacod.innerText = "El código no puede estar vacío";
    } else {
      vcod = 1;
    }
    if (usernam.value.trim().length == 0) {
      vuser = 0;
      alertauser.innerText = "El usuario no puede estar vacío";
    } else {
      vuser = 1;
    }
    if (userpass.value.trim().length == 0) {
      vpass = 0;
      alertapass.innerText = "La contraseña no puede estar vacía";
    } else {
      vpass = 1;
    }
    vcon = vcod + vuser + vpass;
    if (vcon == 3) {
      console.log("todo lleno");
      guardarDatos();
      console.log("registro");
      frmUsuario.reset();
      $("#añadirUsuario").modal("hide");
    }
  }
};

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", () => {
  numPagina = 1;
  buscarUsuario();
});

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarUsuario");
cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  buscarUsuario();
});

function guardarDatos() {
  console.log("guardar datos");
  var dni = document.getElementById("codPersonal").value;
  let usuario = document.getElementById("username").value;
  let pass = document.getElementById("userpass").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/usuariosController.php", true);
  var data = new FormData();
  data.append("codPersonal", dni);
  data.append("accion", "listar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    if (respuesta !== "") {
      let datos = JSON.parse(respuesta);
      console.log(datos);

      // let apellidos = datos.apellidos;
      // let nombre  = datos.nombre;
      let id = datos[0].id;
      // let apellidos = datos[0].apellidos;
      // let nombre = datos[0].nombre;

      const ajaxGuardar = new XMLHttpRequest();
      ajaxGuardar.open("POST", "../controller/usuariosController.php", true);
      let dataGuardar = new FormData();
      dataGuardar.append("accion", "guardar");
      dataGuardar.append("id", id);
      //dataGuardar.append("codPersonal", dni);
      dataGuardar.append("username", usuario);
      dataGuardar.append("userpass", pass);

      /*data.append("username", usuario);
      data.append("userpass", pass);*/
      ajaxGuardar.onload = function () {
        let resp = ajaxGuardar.responseText;
        console.log(resp);
        if (resp === "1") {
          console.log("Datos guardados correctamente");
          buscarUsuario();
          swal.fire("Registrado!", "Se registro correctamente.", "success");
        } else {
          console.log("Error al guardar los datos");
          swal.fire("ERROR!", "Error al guardar los datos", "error");
        }
      };
      ajaxGuardar.send(dataGuardar);
    } else {
      console.log("NO SE ENCONTRO EL DNI");
      swal.fire("ERROR!", "No se encontro el DNI.", "error");
    }
  };
  ajax.send(data);
  buscarUsuario();
}

function buscarUsuario() {
  //let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarUsuario");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/usuariosController.php", true);
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
    let usuario = datos.listado;
    let template = ""; // Estructura de la tabla html
    if (usuario != "vacio") {
      usuario.forEach(function (usuario) {
        template += `
            <tr>
                
                <td>${usuario.dni}</td>
                <td>${usuario.apellidos}</td>
                <td>${usuario.nombre}</td>
                <td>${usuario.nombreCargo}</td>
                <td>${usuario.usuario}</td>
                <td>
  
                
                <button type="button" onClick='eliminar("${usuario.id}")' class="btn btn-danger pelim" data-fila="${usuario.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                </button>
  
                </td>
            </tr>
            `;
      });
      var elemento = document.getElementById("tbUsuarios");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
        <p><span id="totalRegistros">Mostrando ${usuario.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    } else {
      var elemento = document.getElementById("tbUsuarios");
      elemento.innerHTML = `
            <tr>
              <td colspan="6" class="text-center">No se encontraron resultados</td>
            </tr>
          `;
      document.getElementById("txtPagVista").value = 0;
      document.getElementById("txtPagTotal").value = 0;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
            <p><span id="totalRegistros">Mostrando 0 de 0 registros</span></p>`;
      registros.innerHTML = mostrarRegistro;
    }
  };
  ajax.send(data);
}

function eliminar(id) {
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
        ajax.open("POST", "../controller/usuariosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          //listarAsignarRol();
          buscarUsuario();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        let tab = document.getElementById("tbUsuarios");
        if (tab.rows.length == 1) {
          if (numPagina == 1) {
            numPagina = 1;
          } else {
            numPagina = numPagina - 1;
          }
        }
        ajax.send(data);
      }
    });
}

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector("#btnPrimero");
pagInicio.addEventListener("click", function (e) {
  numPagina = 1;
  document.getElementById("txtPagVista").value = numPagina;
  buscarUsuario();
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
    buscarUsuario();
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
    buscarUsuario();
    pagSiguiente.blur();
  }
});
let pagFinal = document.querySelector("#btnUltimo");
pagFinal.addEventListener("click", function (e) {
  numPagina = document.getElementById("txtPagTotal").value;
  document.getElementById("txtPagVista").value = numPagina;
  console.log(numPagina);
  buscarUsuario();
  pagFinal.blur();
});
