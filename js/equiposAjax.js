console.log('hola?');
let serie ='';
let frmComponentes = document.getElementById('formEquipos');

frmComponentes.onsubmit = function (e) {
    e.preventDefault();
    guardarComponentes();

  };


function guardarComponentes() {
    var serie = document.getElementById("codigo").value;
  
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/equiposController.php", true);
    var data = new FormData();
    data.append("serie", serie);
    data.append("accion", "traerComponentes");
    ajax.onload = function () {
        let respuesta = ajax.responseText;
        console.log(respuesta);

      /*let respuesta = ajax.responseText;
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
        ajaxGuardar.open(
          "POST",
          "../controller/asignarRolesController.php",
          true
        );
        let dataGuardar = new FormData();
        dataGuardar.append("accion", "guardar");
        dataGuardar.append("id", id);
        dataGuardar.append("combo", idRolSeleccionado);
        ajaxGuardar.onload = function () {
          let resp = ajaxGuardar.responseText;
          console.log(resp);
          if (resp === "1") {
            console.log("Datos guardados correctamente");
            buscar();
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
      }*/
    };
    ajax.send(data);
    //buscar();
  }