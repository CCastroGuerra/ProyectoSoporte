listarSelectRol();
let frmAsignarRol = document.getElementById('formARoles');
let dni ='';
frmAsignarRol.onsubmit = function (e) {
  e.preventDefault();
  if (frmAsignarRol.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    // actualizar(id);
  } else {
   
    guardarDatos();
   
  }
  frmAsignarRol.reset();
};



function listarSelectRol() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/asignarRolesController.php", true);
    var data = new FormData();
    data.append("accion", "listarCombo");
    
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const rol = JSON.parse(respuesta);
      let template = ""; // Estructura de la tabla html
      if (rol.length > 0) {
        template = `<option value="0">Seleccione Marca</option>
        `;
        rol.forEach(function (rol) {
          template += `
                   
                    <option value="${rol.id}">${rol.nombre}</option>
                
                    `;
        });
        var elemento = document.getElementById("selAroles");
        elemento.innerHTML = template;
       
      }
    };
    ajax.send(data);
}



function guardarDatos() {
  var idRolSeleccionado = document.getElementById("selAroles").value;
  var dni = document.getElementById("inputDni").value;

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/asignarRolesController.php", true);
  var data = new FormData();
  data.append('dni', dni);
  data.append('accion', 'listar');
  ajax.onload = function() {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    if (respuesta !== '') {
      let datos = JSON.parse(respuesta);
      console.log(datos);

      // let apellidos = datos.apellidos;
      // let nombre  = datos.nombre;

      let apellidos = datos[0].apellidos;
      let nombre = datos[0].nombre;

      const ajaxGuardar = new XMLHttpRequest();
      ajaxGuardar.open("POST", "../controller/asignarRolesController.php", true);
      let dataGuardar = new FormData();
      dataGuardar.append('accion', 'guardar');
      dataGuardar.append('apellidos', apellidos);
      dataGuardar.append('nombre', nombre);
      dataGuardar.append('combo', idRolSeleccionado);
      ajaxGuardar.onload = function() {
        let resp = ajaxGuardar.responseText;
        console.log(resp);
        if (resp === '1') {
          console.log("Datos guardados correctamente");
          swal.fire(
            "Registrado!",
            "Se registro correctamente.",
            "success"
          );
        } else {
          console.log("Error al guardar los datos");
          swal.fire(
            "ERROR!",
            "Error al guardar los datos",
            "error"
          );
        }
      }
      ajaxGuardar.send(dataGuardar);
    } else {
      console.log('NO SE ENCONTRO EL DNI');
      swal.fire(
        "ERROR!",
        "No se encontro el DNI.",
        "error"
      );
      
    }
  }
  ajax.send(data);
}


