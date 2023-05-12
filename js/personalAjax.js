var numPagina = 1;
let id ='';
let frmPersonal = document.getElementById('formEmpleados');
listarPersonal();

frmPersonal.onsubmit = function (e) {
    e.preventDefault();
    if (frmPersonal.querySelector("#inputCodigo").value !== "") {
      console.log("actualizo");
      actualizar(id);
    } else {
      guardarPersonal();
      listarPersonal();
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

function mostrarEnModal(personalId){
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
    //console.log(datos);
    document.getElementById("apellidos").value = datos.apellidos;
    document.getElementById("nombre").value = datos.nombre;
    document.getElementById("selCargo").value = datos.cargoId;
    document.getElementById("usuario").value = datos.nombreUsuario;
    document.getElementById("password").value = datos.contraseña;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
  }
function eliminarPersonal(){

  }
function actualizar(id){

  const apellidosInput = document.getElementById("apellido");
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
      title: "CRUD",
      text: "Desea actualizar el registro?",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/marcaController.php", true);
        const data = new FormData(frmMarca);
        data.append("id", id);
        data.append("apellido",apellido);
        data.append("nombre", nombre);
        data.append("usuario", usuario);
        data.append("password", password);
        data.append("codigo", codigo);
        data.append("combo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          listarPersonal();
          swal.fire(
            "Actualizado!",
            "El registro se actualizó correctamente.",
            "success"
          );
        };
        cajaBuscar.value ='';
        ajax.send(data);
      }
    });
}

function guardarPersonal(){
    let realizado = "";
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open("POST", "../controller/personalController.php", true);
    let data = new FormData(frmPersonal);
    data.append("accion", "guardar");
    ajax.onload = function () {
      realizado = ajax.responseText;
      console.log(realizado);
      if (realizado * 1 > 0) {
        swal.fire("Registrado!", "Registrado correctamente.", "success");
      }
      //buscarArea();
      listarPersonal();
      frmPersonal.reset();
    };
    ajax.send(data);
}

function limpiarFormulario() {
    frmPersonal.reset();
  }

let elemento = document.getElementById("selCargo");
  elemento.onchange = function() {
    var valorSeleccionado = elemento.value;
    console.log("Valor seleccionado:", valorSeleccionado);
  };
