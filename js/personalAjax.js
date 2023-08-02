var numPagina = 1;
let id = "";
var frmPersonal = document.getElementById("formEmpleados");

const modalp = frmPersonal.parentNode.parentNode.parentNode.id;
let apelli = document.getElementById("apellidos");
let nombrs = document.getElementById("nombre");
let inpdni = document.getElementById("dniusuario");
let intelf = document.getElementById("telefono");
let incorr = document.getElementById("correo");
let selcarg = document.getElementById("selCargo");
let msgal = document.querySelectorAll(".alerta");
//small de alerta
let aapelli = msgal[0];
let anombrs = msgal[1];
let adni = msgal[2];
let atelf = msgal[3];
let acorr = msgal[4];
let acarg = msgal[5];
//variables de control
let vapp = 0;
let vnoms = 0;
let vdni = 0;
let vtelf = 0;
let vcorr = 0;
let vcargo = 0;
buscarPersonal();
//listarPersonal();

msgal.forEach((element) => {
  element.setAttribute("style", "color:red !important");
});

apelli.addEventListener("input", function () {
  if (apelli.value.trim().length == 0) {
    aapelli.innerText = "El apellido no puede estar vacío";
    vapp = 0;
  } else {
    aapelli.innerText = "";
    vapp = 1;
  }
});

nombrs.addEventListener("input", function () {
  if (nombrs.value.trim().length == 0) {
    anombrs.innerText = "El nombre no puede estar vacío";
    vnoms = 0;
  } else {
    anombrs.innerText = "";
    vnoms = 1;
  }
});

inpdni.addEventListener("input", function () {
  regla = new RegExp("[0-9]$");

  if (this.value.length > this.maxLength)
    this.value = this.value.slice(0, this.maxLength);
  if (this.value.trim().length > 0 && this.value.trim().length <= 8) {
    if (regla.test(this.value) == false) {
      console.log("solo numeros");
      adni.innerText = "El dni solo tiene números";
    } else {
      if (this.value.trim().length < 8) {
        adni.innerText = "El dni tiene 8 dígitos";
      }
    }
  }
  if (regla.test(this.value) == true && this.value.trim().length == 8) {
    adni.innerText = "";
  }
  if (this.value.length > this.maxLength)
    this.value = this.value.slice(0, this.maxLength);
});

inpdni.addEventListener("keypress", function (evt) {
  //console.log(evt.keyCode);
  if (
    (evt.keyCode != 8 && evt.keyCode != 0 && evt.keyCode < 48) ||
    evt.keyCode > 57
  ) {
    evt.preventDefault();
  }
});

intelf.addEventListener("keypress", function (evt) {
  //console.log(evt.keyCode);
  if (
    (evt.keyCode != 8 && evt.keyCode != 0 && evt.keyCode < 48) ||
    evt.keyCode > 57
  ) {
    evt.preventDefault();
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
  msgal.forEach((element) => {
    element.innerText = "";
  });
  switch (button.id) {
    case "":
      modalTitle.textContent = "Guardar";
      frmPersonal.reset();
      break;
    case "btnEditar":
      modalTitle.textContent = "Editar";
      break;
  }
});
/**** */

frmPersonal.onsubmit = function (e) {
  e.preventDefault();
  bcontrol = 0;
  if (frmPersonal.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    //actualizar(id);
    actualizar(id);
    setTimeout(function () {
      $("#" + modalp).modal("toggle");
    }, 3000);
  } else {
    // guardarArea();
    if (apelli.value.trim().length == 0) {
      aapelli.innerText = "El apellido no puede estar vacío";
      vapp = 0;
    } else {
      aapelli.innerText = "";
      vapp = 1;
    }
    if (nombrs.value.trim().length == 0) {
      anombrs.innerText = "El nombre no puede estar vacío";
      vnoms = 0;
    } else {
      anombrs.innerText = "";
      vnoms = 1;
    }
    if (inpdni.value.trim().length == 0) {
      adni.innerText = "El DNI no es válido";
      vdni = 0;
    } else {
      adni.innerText = "";
      vdni = 1;
    }
    if (intelf.value.trim().length == 0) {
      atelf.innerText = " no valido";
      vtelf = 0;
    } else {
      atelf.innerText = "";
      vtelf = 1;
    }
    if (incorr.value.trim().length == 0) {
      acorr.innerText = "Ingrese un correo válido";
      vcorr = 0;
    } else {
      acorr.innerText = "";
      vcorr = 1;
    }
    if (selcarg.value == 0) {
      acarg.innerText = "Seleccione un cargo";
      vcargo = 0;
    } else {
      acarg.innerText = "";
      vcargo = 1;
    }
    // listarArea();
    bcontrol = vapp + vnoms + vdni + vtelf + vcorr + vcargo;
    if (bcontrol == 6) {
      $("#" + modalp).modal("hide");
      guardarPersonal();
      console.log("guardo");
    }
  }
  return false;
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
    console.log(datos);
    document.getElementById("apellidos").value = datos.apellidos;
    document.getElementById("nombre").value = datos.nombre;
    document.getElementById("dniusuario").value = datos.dniusuario;
    document.getElementById("telefono").value = datos.telefono;
    document.getElementById("correo").value = datos.correo;
    document.getElementById("selCargo").value = datos.cargoId;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const apellidosInput = document.getElementById("apellidos");
  const nombreInput = document.getElementById("nombre");
  const dniInput = document.getElementById("dniusuario");
  const telefonoInput = document.getElementById("telefono");
  const correoInput = document.getElementById("correo");
  const codigoInput = document.getElementById("inputCodigo");
  // Obtener los valores actualizados desde los elementos del modal
  const apellido = apellidosInput.value;
  const nombre = nombreInput.value;
  const dni = dniInput.value;
  const telefono = telefonoInput.value;
  const correo = correoInput.value;
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
        data.append("dniusuario", dni);
        data.append("telefono", telefono);
        data.append("correo", correo);
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
  numPagina = 1;
  buscarPersonal();
});

function buscarPersonal() {
  //let numPagina = 1;
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
          <td>${personal.dni}</td>
          <td>${personal.telefono}</td>
          <td>${personal.correo}</td>
          <td>${personal.cargoPersonal}</td>
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
      var elemento = document.getElementById("tbPersonal");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = 1;
      document.getElementById("txtPagTotal").value = 1;
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
