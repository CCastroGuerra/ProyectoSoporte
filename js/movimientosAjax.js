listarSelecTecnicos();
listarSelecArea();

/***********************************/
let selecAccion = document.getElementById("selTipo").value;
let idEquipo = document.getElementById("codEquipo");
/***********************************/

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
