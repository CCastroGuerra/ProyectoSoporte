let numPagina = 1;

let id = "";
let clickBuscar = false;
let frmProductos = document.getElementById("formProducto");
let frmPresentacion = document.getElementById("formPresentacion");
buscarProducto();
//listarProductos();
buscarPresentacion();

frmProductos.onsubmit = function (e) {
  e.preventDefault();
  if (frmProductos.querySelector("#inputIDPro").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarProdcutos();
    console.log("guardo");
    cajaBuscar.disabled = false;
  }
  frmProductos.reset();
};


frmPresentacion.onsubmit = (e) => {
  e.preventDefault();
  if (frmPresentacion.querySelector("#inputID").value !== "") {
    console.log("actualizo");
    //actualizar(id);
  } else {
    // guardarArea();
    // listarArea();
    guardarPresentacion();
    console.log("guardo");
    //cajaBuscar.disabled = false;
  }
  frmPresentacion.reset();

}

// function listarProductos() {
//   let num_registros = document.getElementById('numRegistros').value;
//   const ajax = new XMLHttpRequest();
//   ajax.open("POST", "../controller/productosController.php", true);
//   var data = new FormData();
//   data.append("accion", "listar");
//   data.append("valor", "");
//   data.append("cantidad", "4");
//   data.append('registros',num_registros);
//   ajax.onload = function () {
//     let respuesta = ajax.responseText;
//     console.log(respuesta);
//     const producto = JSON.parse(respuesta);
//     let template = ""; // Estructura de la tabla html
//     if (producto.length > 0) {
//       producto.forEach(function (producto) {
//         template +=  `
//         <tr>
//             <td>${producto.id}</td>
//             <td>${producto.codigo}</td>
//             <td>${producto.nombre}</td>
//             <td>${producto.unidad}</td>
//             <td>${producto.cantidad}</td>
//             <td>${producto.almacen}</td>

//             <td>
//               <button type="button" onClick='mostrarEnModal("${producto.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal">Editar</button>
//               <button type="button" onClick='eliminarProducto("${producto.id}")' class="btn btn-danger" data-fila="${producto.id}">Borrar</button>
//             </td>
//         </tr>
//         `;
//       });
//       var elemento = document.getElementById("tbProductos");
//       elemento.innerHTML = template;
//     }
//   };
//   ajax.send(data);
// }

function guardarProdcutos() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData(frmProductos);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarProducto();
    //listarArea();
    frmProductos.reset();
  };
  ajax.send(data);
}

function guardarPresentacion() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData(frmPresentacion);
  data.append("accion", "guardarPresentacion");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    buscarPresentacion();
    frmPresentacion.reset();
    cajaBuscarPre.value ='';
  };
  ajax.send(data);
}

function mostrarEnModal(productoId) {
  id = productoId;
  console.log(id);

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    document.getElementById("nombreProducto").value = datos.nombre;
    document.getElementById("selTipoProducto").value = datos.tipoId;
    document.getElementById("selUnidad").value = datos.presentacionId;
    document.getElementById("ctdProducto").value = datos.cantidad;
    document.getElementById("selAlmacen").value = datos.almacenId;
    document.getElementById("detalleProducto").value = datos.descripcion;
    document.getElementById("inputIDPro").value = datos.id;
  };
  ajax.send(data);
}

let elemento = document.getElementById("selAlmacen");
elemento.onchange = function () {
  var valorSeleccionado = elemento.value;
  console.log("Valor seleccionado:", valorSeleccionado);
};

let elemento2 = document.getElementById("selTipoProducto");
elemento2.onchange = function () {
  var valorSeleccionado = elemento2.value;
  console.log("Valor seleccionado:", valorSeleccionado);
};

let elemento3 = document.getElementById("selUnidad");
elemento3.onchange = function () {
  var valorSeleccionado = elemento3.value;
  console.log("Valor seleccionado:", valorSeleccionado);
};

function actualizar(id) {
  const nombreInput = document.getElementById("nombreProducto");
  const cantInput = document.getElementById("ctdProducto");
  const descripcionInput = document.getElementById("detalleProducto");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
  const cantidad = cantInput.value;
  const comboAlmacen = elemento.value;
  const comboProducto = elemento2.value;
  const comboUnidad = elemento3.value;
  const descripcion = descripcionInput.value;

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
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("cantidad", cantidad);
        data.append("selAlmacen", comboAlmacen);
        data.append("selTipoProducto", comboProducto);
        data.append("selUnidad", comboUnidad);
        data.append("detalleProducto", descripcion);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          buscarProducto();
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

function eliminarProducto(id) {
  console.log(id);
  swal
    .fire({
      title: "",
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
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarProducto();
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

function limpiarFormulario() {
  frmProductos.reset();
}

/*limit para el select*/
var numRegistors = document.getElementById("numRegistros");
numRegistors.addEventListener("change", buscarProducto);

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarProducto");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  buscarProducto();
});

// function buscarProducto() {
//   var cajaBuscar = document.getElementById("inputbuscarProducto");
//   const textoBusqueda = cajaBuscar.value;
//   let num_registros = document.getElementById("numRegistros").value;
//   const ajax = new XMLHttpRequest();
//   ajax.open("POST", "../controller/productosController.php", true);
//   var data = new FormData();
//   data.append("accion", "buscar");
//   data.append("cantidad", "4");
//   data.append("registros", num_registros);
//   data.append("pag", numPagina);
//   data.append("textoBusqueda", textoBusqueda);
//   ajax.onload = function () {
//     let respuesta = ajax.responseText;
//     console.log(respuesta);
//     const datos = JSON.parse(respuesta);
//     console.log(datos);
//     let producto = datos.listado;
//     console.log(producto);
//     let template = ""; // Estructura de la tabla html
//     if (producto != "vacio") {
//       producto.forEach(function (producto) {
//         template += `
//         <tr>
//             <td>${producto.id}</td>
//             <td>${producto.nombre}</td>
//             <td>${producto.cantidad}</td>
//             <td>${producto.almacen}</td>
//             <td><button type="button" onClick='mostrarEnModal("${producto.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal">Editar</button>
//             <button type="button" onClick = eliminarProducto("${producto.id}") class="btn btn-danger" data-fila = "${producto.id}">Borrar</button></td>
//         </tr>
//         `;
//       });
//       var elemento = document.getElementById("tbProductos");
//       elemento.innerHTML = template;
//       document.getElementById("txtPagVista").value = numPagina;
//       document.getElementById("txtPagTotal").value = datos.paginas;
//     }

//     else {
//     if(clickBuscar === true){
//         var elemento = document.getElementById("tbProductos");
//         elemento.innerHTML = `
//             <tr>
//               <td colspan="7" class="text-center">No se encontraron datos</td>
//             </tr>
//           `;
//     }else{
//         var elemento = document.getElementById("tbProductos");
//         elemento.innerHTML = `
//             <tr>
//               <td colspan="7" class="text-center">VACIO</td>
//             </tr>
//           `;
//     }

//     }
//   };
//  //clickBuscar = false;
//   ajax.send(data);
// }

function buscarProducto() {
  var cajaBuscar = document.getElementById("inputbuscarProducto");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
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
    let producto = datos.listado;
    console.log(producto);
    let template = ""; // Estructura de la tabla html

    if (producto != "vacio" && producto.length > 0) {
      producto.forEach(function (producto) {
        template += `
        <tr>
            <td>${producto.id}</td>
            <td>${producto.codigo}</td>
            <td>${producto.nombre}</td>
            <td>${producto.tipo}</td>
            <td>${producto.presentacion}</td>
            <td>${producto.cantidad}</td>
            <td>${producto.almacen}</td>
            <td>
              <button type="button" onClick='mostrarEnModal("${producto.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
              <button type="button" onClick='eliminarProducto("${producto.id}")' class="btn btn-danger" data-fila="${producto.id}"><i class="fa fa-trash" aria-hidden="true"></i>
              </button>
              
 
            </td>
        </tr>
        `;
      });
      var elemento = document.getElementById("tbProductos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /** */
    } else {
      if (textoBusqueda.trim() === "") {
        var elemento = document.getElementById("tbProductos");
        elemento.innerHTML = `
            <tr>
              <td colspan="5" class="text-center">VACIO</td>
            </tr>
          `;
        cajaBuscar.disabled = true;
      } else {
        var elemento = document.getElementById("tbProductos");
        elemento.innerHTML = `
            <tr>
              <td colspan="5" class="text-center">No se encontraron resultados</td>
            </tr>
          `;
      }
    }
  };

  ajax.send(data);
}

/*BUSCAR PRESENTACION*/
var cajaBuscarPre = document.getElementById("BuscarPre");

cajaBuscarPre.addEventListener("keyup", function (e) {
  const textoBusquedaPre = cajaBuscarPre.value;
  console.log(textoBusquedaPre);
  buscarPresentacion();
});
function buscarPresentacion() {
  var cajaBuscarPre = document.getElementById("BuscarPre");
  const textoBusquedaPre = cajaBuscarPre.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/productosController.php", true);
  var data = new FormData();
  data.append("accion", "buscarPresentacion");
  data.append("cantidad", "4");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusquedaPre);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let presentacion = datos.listado;
    console.log(presentacion);
    let template = ""; // Estructura de la tabla html

    if (presentacion != "vacio" && presentacion.length > 0) {
      presentacion.forEach(function (presentacion) {
        template += `
        <tr>
            <td>${presentacion.id}</td>
            <td>${presentacion.nombre}</td>

            <td>
            <button type="button" class="btn btn-success btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal"><i class="fa fa-plus" aria-hidden="true"></i>

              </button>
              <button type="button" onClick='mostrarEnModalPre("${presentacion.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </button>
              <button type="button" onClick='eliminarPresentacion("${presentacion.id}")' class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i>
              </button>

              
              
 
            </td>
        </tr>
        `;
      });
      var elemento = document.getElementById("tbPres");
      elemento.innerHTML = template;
      document.getElementById("txtPagVistaPre").value = numPagina;
      document.getElementById("txtPagTotalPre").value = datos.paginas;

      /* Seleccionar datos de la tabla */
      /*Modal presentación*/
      let modalPre = document.getElementById("presentacionModal");
      // Obtén una referencia a la tabla después de su generación
      const tabla = document.getElementById("tbPres");

      // Obtén todas las filas de la tabla
      const filas = tabla.getElementsByTagName("tr");

      // Itera sobre las filas y agrega un evento de clic a cada una
      for (let i = 0; i < filas.length; i++) {
        const fila = filas[i];
        fila.addEventListener("click", function () {
          // Seleccionar la fila
          console.log("Fila seleccionada:", fila);

          // Obtener los datos de las celdas
          const celdas = fila.getElementsByTagName("td");
          const nombre = celdas[1].innerText;

          const select = document.getElementById("selUnidad");
          // Mostrar los datos en el combo o select

          const option = document.createElement("option");
          option.text = nombre;
          option.value = nombre;
          select.appendChild(option);
          //Seleccionar la opción en el combo o select
          select.value = nombre;
          frmPresentacion.reset();
          //buscarPresentacion();
          console.log(select.value);
        });
      }
    } else {
      if (textoBusquedaPre.trim() === "") {
        var elemento = document.getElementById("tbPres");
        elemento.innerHTML = `
            <tr>
              <td colspan="5" class="text-center">VACIO</td>
            </tr>
          `;
        cajaBuscar.disabled = true;
      } else {
        var elemento = document.getElementById("tbPres");
        elemento.innerHTML = `
            <tr>
              <td colspan="5" class="text-center">No se encontraron resultados</td>
            </tr>
          `;
      }
    }
  };

  ajax.send(data);
}

function eliminarPresentacion (idPre){
  console.log(idPre);
  swal
    .fire({
      title: "",
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
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("idPre", idPre);
        data.append("accion", "eliminarPre");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          buscarProducto();
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


/**************************/
/* BOTONES DE PAGINACIÓN PRODUCTO*/
let pagInicio = document.querySelector('#btnPrimero');
pagInicio.addEventListener('click', function (e) {
    numPagina = 1;
    document.getElementById('txtPagVista').value = numPagina;
    buscarProducto();
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
        buscarProducto();
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
        buscarProducto();
        pagSiguiente.blur();
    }
});
let pagFinal = document.querySelector('#btnUltimo');
pagFinal.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotal').value;
    document.getElementById('txtPagVista').value = numPagina;
    console.log(numPagina);
    buscarProducto();
    pagFinal.blur();
});

/*BOTONES PAGINACION PRESENTACION */

let pagInicioPre = document.querySelector('#btnPrimeroPre');
pagInicioPre.addEventListener('click', function (e) {
    numPagina = 1;
    document.getElementById('txtPagVistaPre').value = numPagina;
    buscarPresentacion();
    pagInicioPre.blur();
});
let pagAnteriorPre = document.querySelector('#btnAnteriorPre');
pagAnteriorPre.addEventListener('click', function (e) {
    var pagVisitadaPre = parseInt(document.getElementById('txtPagVistaPre').value);
    var pagDestinoPre = 0;
    if ((pagVisitadaPre - 1) >= 1) {
        pagDestinoPre = pagVisitadaPre - 1;
        numPagina = pagDestinoPre;
        document.getElementById('txtPagVista').value = numPagina;
        buscarPresentacion();
        pagAnteriorPre.blur();
    }
});
let pagSiguientePre = document.querySelector('#btnSiguientePre');
pagSiguientePre.addEventListener('click', function (e) {
    var pagVisitadaPre = parseInt(document.getElementById('txtPagVistaPre').value);
    var pagFinalPre = parseInt(document.getElementById('txtPagTotalPre').value);
    var pagDestinoPre = 0;
    if ((pagVisitadaPre + 1) <= pagFinalPre) {
      pagDestinoPre = pagVisitadaPre + 1;
        numPagina = pagDestinoPre;
        document.getElementById('txtPagVistaPre').value = numPagina;
        buscarPresentacion();
        pagSiguientePre.blur();
    }
});
let pagFinalPre = document.querySelector('#btnUltimoPre');
pagFinalPre.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotalPre').value;
    document.getElementById('txtPagVistaPre').value = numPagina;
    console.log(numPagina);
    buscarPresentacion();
    pagFinalPre.blur();
});