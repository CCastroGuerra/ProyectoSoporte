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
                        <td>${personal.nombre}</td>
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
