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

function mostrarEnModal(){

  }
function eliminarPersonal(){

  }
function actualizar(){

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
