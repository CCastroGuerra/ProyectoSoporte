var id;
var numPagina = 1;
var frmArea = document.getElementById("formArea");
console.log(numPagina);
buscarArea();

//listarArea();
frmArea.onsubmit = function (e) {
  e.preventDefault();
  if (frmArea.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarArea();
    listarArea();
    console.log("guardo");
  }
  frmArea.reset();
};

/*limit para el select*/
var numRegistors = document.getElementById('numeroRegistros');
numRegistors.addEventListener("change", listarArea);

function listarArea() {
  let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "4");
  data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const area = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      area.forEach(function (area) {
        template += `
                  <tr>
                      <td>${area.id}</td>
                      <td>${area.nombre}</td>
                      <td><button type="button" onClick=mostrarEnModal("${area.id}") id="btnEditar" class="btn btn-info btn-outline" data-bs-toggle="modal" data-bs-target="#modalArea" data-fila = "${area.id}">Editar</button>
                      <button type="button" onClick = eliminarArea("${area.id}") class="btn btn-danger" data-fila = "${area.id}">Borrar</button></td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbArea");
      elemento.innerHTML = template;
     
    }
  };
  ajax.send(data);
}

function buscarArea() {
  var cajaBuscar = document.getElementById("inputbuscarArea");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData();
  data.append("accion", "buscar");
  data.append("cantidad", "4");
  data.append('registros',num_registros);
  data.append('pag',numPagina);
  data.append("textoBusqueda", textoBusqueda);
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const datos = JSON.parse(respuesta);
      console.log(datos);
      let area = datos.listado;
      console.log(area);
      let template = ""; // Estructura de la tabla html
      if (area != 'vacio') {
        area.forEach(function (area) {
          template += `
            <tr>
              <td>${area.id}</td>
              <td>${area.nombre}</td>
              <td>
                <button type="button" onClick=mostrarEnModal("${area.id}") id="btnEditar" class="btn btn-info btn-outline" data-bs-toggle="modal" data-bs-target="#modalArea" data-fila="${area.id}">
                  Editar
                </button>
                <button type="button" onClick=eliminarArea("${area.id}") class="btn btn-danger" data-fila="${area.id}">
                  Borrar
                </button>
              </td>
            </tr>
          `;
        });
        var elemento = document.getElementById("tbArea");
        elemento.innerHTML = template;
        document.getElementById('txtPagVista').value = numPagina;
        document.getElementById('txtPagTotal').value = datos.paginas;

      } else {
        var elemento = document.getElementById("tbArea");
        elemento.innerHTML = `
          <tr>
            <td colspan="3" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
      }
    };
    ajax.send(data);
}

function guardarArea() {
  var realizado = "";
  var mensaje = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/areaController.php", true);
  var data = new FormData(frmArea);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarArea();
    //listarArea();
    frmArea.reset();
  };
  ajax.send(data);
}

function mostrarEnModal(areaid) {
  console.log(id);
  id = areaid;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("nombre_area").value = datos.nombre;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombre_area");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
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
        ajax.open("POST", "../controller/areaController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          listarArea();
          swal.fire(
            "Actualizado!",
            "El registro se actualizó correctamente.",
            "success"
          );
        };
        ajax.send(data);
      }
    });
}

function limpiarFormulario() {
  frmArea.reset();
}

function eliminarArea(id) {
  console.log(id);
  swal
    .fire({
      title: "CRUD",
      text: "Desea Eliminar el Registro?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/areaController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarArea();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        ajax.send(data);
      }
    });
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarArea");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  if (textoBusqueda.trim() == "") {
    listarArea();
  } else{
    buscarArea();
  }//{
  //   data.append("textoBusqueda", textoBusqueda);
  //   const ajax = new XMLHttpRequest();
  //   ajax.open("POST", "../controller/areaController.php", true);
  //   ajax.onload = function () {
  //     let respuesta = ajax.responseText;
  //     console.log(respuesta);
  //     const datos = JSON.parse(respuesta);
  //     let area = datos.listado;
  //     console.log(area);
  //     let template = ""; // Estructura de la tabla html
  //     if (area != 'vacio') {
  //       area.forEach(function (area) {
  //         template += `
  //           <tr>
  //             <td>${area.id}</td>
  //             <td>${area.nombre}</td>
  //             <td>
  //               <button type="button" onClick=mostrarEnModal("${area.id}") id="btnEditar" class="btn btn-info btn-outline" data-bs-toggle="modal" data-bs-target="#modalArea" data-fila="${area.id}">
  //                 Editar
  //               </button>
  //               <button type="button" onClick=eliminarArea("${area.id}") class="btn btn-danger" data-fila="${area.id}">
  //                 Borrar
  //               </button>
  //             </td>
  //           </tr>
  //         `;
  //       });
  //       var elemento = document.getElementById("tbArea");
  //       elemento.innerHTML = template;
  //       document.getElementById('txtPagVista').value = numPagina;
  //       document.getElementById('txtPagTotal').value = datos.paginas;

  //     } else {
  //       var elemento = document.getElementById("tbArea");
  //       elemento.innerHTML = `
  //         <tr>
  //           <td colspan="3" class="text-center">No se encontraron resultados</td>
  //         </tr>
  //       `;
  //     }
  //   };
  //   ajax.send(data);
  // }
});

/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector('#btnPrimero');
pagInicio.addEventListener('click', function (e) {
    numPagina = 1;
    document.getElementById('txtPagVista').value = numPagina;
    buscarArea();
    pagInicio.blur();
});
let pagAnterior = document.querySelector('#btnAnterior');
pagAnterior.addEventListener('click', function (e) {
    var pagVisitada = parseInt(document.getElementById('txtPagVista').value);
    var pagDestino = 0;
    if ((pagVisitada - 1) >= 1) {
        pagDestino = pagVisitada - 1;
        numPagina = pagDestino;
        document.getElementById('txtPagVista').value = numPagina;
        buscarArea();
        pagAnterior.blur();
    }
});
let pagSiguiente = document.querySelector('#btnSiguiente');
pagSiguiente.addEventListener('click', function (e) {
    var pagVisitada = parseInt(document.getElementById('txtPagVista').value);
    var pagFinal = parseInt(document.getElementById('txtPagTotal').value);
    var pagDestino = 0;
    if ((pagVisitada + 1) <= pagFinal) {
        pagDestino = pagVisitada + 1;
        numPagina = pagDestino;
        document.getElementById('txtPagVista').value = numPagina;
        buscarArea();
        pagSiguiente.blur();
    }
});
let pagFinal = document.querySelector('#btnUltimo');
pagFinal.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotal').value;
    document.getElementById('txtPagVista').value = numPagina;
    console.log(numPagina);
    buscarArea();
    pagFinal.blur();
});

