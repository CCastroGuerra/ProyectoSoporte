

function guardarDatos(){
    
}

function listarSelectMarca() {
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