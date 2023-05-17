var numPagina = 1;
let id ='';
listarSelectMarca();
buscarModelo();
//listarMarca();
let frmModelo = document.getElementById('formModelo');

frmModelo.onsubmit = function (e) {
  e.preventDefault();
  if (frmModelo.querySelector("#codigoModelo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarModelo();
    listarModelo();
    console.log("guardo");
  }
  frmModelo.reset();
};

function listarSelectMarca() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/modeloController.php", true);
    var data = new FormData();
    data.append("accion", "listarCombo");
    // data.append("valor", "");
    // data.append("cantidad", "4");
    // data.append('registros',num_registros);
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const marca = JSON.parse(respuesta);
      let template = ""; // Estructura de la tabla html
      if (marca.length > 0) {
        template = `<option value="0">Seleccione Marca</option>
        `;
        marca.forEach(function (marca) {
          template += `
                   
                    <option value="${marca.id}">${marca.nombre}</option>
                
                    `;
        });
        var elemento = document.getElementById("selMarca");
        elemento.innerHTML = template;
       
      }
    };
    ajax.send(data);
  }


  var elemento = document.getElementById("selMarca");
  elemento.onchange = function() {
    var valorSeleccionado = elemento.value;
    console.log("Valor seleccionado:", valorSeleccionado);
  };

function guardarModelo() {
    var realizado = "";
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open("POST", "../controller/modeloController.php", true);
    var data = new FormData(frmModelo);
    data.append("accion", "guardar");
    ajax.onload = function () {
      realizado = ajax.responseText;
      console.log(realizado);
      if (realizado * 1 > 0) {
        swal.fire("Registrado!", "Registrado correctamente.", "success");
      }
      //buscarArea();
      listarModelo();
      frmModelo.reset();
    };
    ajax.send(data);
}

function listarModelo() {
  let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "4");
  data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const modelo = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (modelo.length > 0) {
      modelo.forEach(function (modelo) {
        template += `
                  <tr>
                      <td>${modelo.id}</td>
                      <td>${modelo.nombre}</td>
                      <td>${modelo.nombreMarca}</td>
                      <td><button type="button" onClick=mostrarEnModal("${modelo.id}") id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirModal" data-fila = "${modelo.id}">Editar</button>
                      <button type="button" onClick = eliminarModelo("${modelo.id}") class="btn btn-danger" data-fila = "${modelo.id}">Borrar</button></td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbModelo");
      elemento.innerHTML = template;
     
    }
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombreModelo");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
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
        ajax.open("POST", "../controller/modeloController.php", true);
        const data = new FormData(frmModelo);
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("combo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          listarModelo();
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

function eliminarModelo(id) {
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
        ajax.open("POST", "../controller/modeloController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarModelo();
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

/*limit para el select*/
var numRegistors = document.getElementById('numRegistros');
numRegistors.addEventListener("change", listarModelo);

function buscarModelo() {
  var cajaBuscar = document.getElementById("inputbuscarModelo");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
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
      let modelo = datos.listado;
      console.log(modelo);
      let template = ""; // Estructura de la tabla html
      if (modelo != 'vacio') {
        modelo.forEach(function (modelo) {
          template += `
                  <tr>
                      <td>${modelo.id}</td>
                      <td>${modelo.nombre}</td>
                      <td>${modelo.nombreMarca}</td>
                      <td><button type="button" onClick=mostrarEnModal("${modelo.id}") id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirModal" data-fila = "${modelo.id}">Editar</button>
                      <button type="button" onClick = eliminarModelo("${modelo.id}") class="btn btn-danger" data-fila = "${modelo.id}">Borrar</button></td>
                  </tr>
                  `;
        });
        var elemento = document.getElementById("tbModelo");
        elemento.innerHTML = template;
        document.getElementById('txtPagVista').value = numPagina;
        document.getElementById('txtPagTotal').value = datos.paginas;

      } else {
        var elemento = document.getElementById("tbModelo");
        elemento.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
      }
    };
    ajax.send(data);
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarModelo");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  if (textoBusqueda.trim() == "") {
    listarModelo();
  } else{
    buscarModelo();
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

function mostrarEnModal(modeloId){
  id = modeloId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/modeloController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    //console.log(datos);
    document.getElementById("nombreModelo").value = datos.nombre;
    document.getElementById("selMarca").value = datos.nombreMarca; 
    document.getElementById("codigoModelo").value = datos.id;
  };
  ajax.send(data);
}


/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector('#btnPrimero');
pagInicio.addEventListener('click', function (e) {
    numPagina = 1;
    document.getElementById('txtPagVista').value = numPagina;
    buscarModelo();
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
        buscarModelo();
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
        buscarModelo();
        pagSiguiente.blur();
    }
});
let pagFinal = document.querySelector('#btnUltimo');
pagFinal.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotal').value;
    document.getElementById('txtPagVista').value = numPagina;
    console.log(numPagina);
    buscarModelo();
    pagFinal.blur();
});