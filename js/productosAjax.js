var numPagina = 1;
let id = "";
let clickBuscar = false;
var frmProductos = document.getElementById("formProducto");
buscarProducto();
//listarPersonal();

frmProductos.onsubmit = function (e) {
  e.preventDefault();
  if (frmProductos.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    // guardarArea();
    // listarArea();
    guardarProdcutos();
    console.log("guardo");
    cajaBuscar.disabled = false;
  }
  frmProductos.reset();
};

// function listarProductos() {
//   // let num_registros = document.getElementById('numRegistros').value;
//   const ajax = new XMLHttpRequest();
//   ajax.open("POST", "../controller/productosController.php", true);
//   var data = new FormData();
//   data.append("accion", "listar");
//   data.append("valor", "");
//   data.append("cantidad", "4");
//   // data.append('registros',num_registros);
//   ajax.onload = function () {
//     let respuesta = ajax.responseText;
//     console.log(respuesta);
//     const producto = JSON.parse(respuesta);
//     let template = ""; // Estructura de la tabla html
//     if (producto.length > 0) {
//       producto.forEach(function (producto) {
//         template += `
//                     <tr>
//                         <td>${producto.id}</td>
//                         <td>${producto.nombre}</td>
//                         <td>${producto.cantidad}</td>
//                         <td>${producto.almacen}</td>
//                         <td><button type="button" onClick='mostrarEnModal("${producto.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal">Editar</button>
//                         <button type="button" onClick = eliminarProducto("${producto.id}") class="btn btn-danger" data-fila = "${producto.id}">Borrar</button></td>
//                     </tr>
//                     `;
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
    document.getElementById("ctdProducto").value = datos.cantidad;
    document.getElementById("selAlmacen").value = datos.almacen;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

let elemento = document.getElementById("selAlmacen");
elemento.onchange = function () {
  var valorSeleccionado = elemento.value;
  console.log("Valor seleccionado:", valorSeleccionado);
};

function actualizar(id) {
  const nombreInput = document.getElementById("nombreProducto");
  const cantInput = document.getElementById("ctdProducto");
  const codigoInput = document.getElementById("inputCodigo");
  // Obtener los valores actualizados desde los elementos del modal
  const nombre = nombreInput.value;
  const cantidad = cantInput.value;
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
        ajax.open("POST", "../controller/productosController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("cantidad", cantidad);
        data.append("codigo", codigo);
        data.append("selAlmacen", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          listarProductos();
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
            <td>${producto.nombre}</td>
            <td>${producto.cantidad}</td>
            <td>${producto.almacen}</td>
            <td>
              <button type="button" onClick='mostrarEnModal("${producto.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#productosModal">Editar</button>
              <button type="button" onClick='eliminarProducto("${producto.id}")' class="btn btn-danger" data-fila="${producto.id}">Borrar</button>
            </td>
        </tr>
        `;
      });
      var elemento = document.getElementById("tbProductos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;
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



