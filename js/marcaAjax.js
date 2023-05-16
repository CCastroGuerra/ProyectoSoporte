var numPagina = 1;
let id ='';
listarSelectMarca();
buscarMarca();
//listarMarca();
let frmMarca = document.getElementById('frmMarca');

frmMarca.onsubmit = function (e) {
  e.preventDefault();
  if (frmMarca.querySelector("#codigoMarca").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
    guardarMarca();
    listarMarca();
    console.log("guardo");
  }
  frmMarca.reset();
};

function listarSelectMarca() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/marcaController.php", true);
    var data = new FormData();
    data.append("accion", "listarCombo");
    // data.append("valor", "");
    // data.append("cantidad", "4");
    // data.append('registros',num_registros);
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

function guardarMarca() {
    var realizado = "";
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open("POST", "../controller/marcaController.php", true);
    var data = new FormData(frmMarca);
    data.append("accion", "guardar");
    ajax.onload = function () {
      realizado = ajax.responseText;
      console.log(realizado);
      if (realizado * 1 > 0) {
        swal.fire("Registrado!", "Registrado correctamente.", "success");
      }
      //buscarArea();
      //listarArea();
      frmMarca.reset();
    };
    ajax.send(data);
}

function listarMarca() {
  let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/marcaController.php", true);
  var data = new FormData();
  data.append("accion", "listar");
  data.append("valor", "");
  data.append("cantidad", "4");
  data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const marca = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (marca.length > 0) {
      marca.forEach(function (marca) {
        template += `
                  <tr>
                      <td>${marca.id}</td>
                      <td>${marca.nombre}</td>
                      <td>${marca.nombreCategoria}</td>
                      <td><button type="button" onClick=mostrarEnModal("${marca.id}") id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#marcaModal" data-fila = "${marca.id}">Editar</button>
                      <button type="button" onClick = eliminarMarcas("${marca.id}") class="btn btn-danger" data-fila = "${marca.id}">Borrar</button></td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbMarca");
      elemento.innerHTML = template;
     
    }
  };
  ajax.send(data);
}

function actualizar(id) {
  const nombreInput = document.getElementById("nombreMarca");
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
        ajax.open("POST", "../controller/marcaController.php", true);
        const data = new FormData(frmMarca);
        data.append("id", id);
        data.append("nombre", nombre);
        data.append("combo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          listarMarca();
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

function eliminarMarcas(id) {
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
        ajax.open("POST", "../controller/marcaController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarMarca();
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
numRegistors.addEventListener("change", listarMarca);

function buscarMarca() {
  var cajaBuscar = document.getElementById("inputbuscarMarca");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/marcaController.php", true);
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
      let marca = datos.listado;
      console.log(marca);
      let template = ""; // Estructura de la tabla html
      if (marca != 'vacio') {
        marca.forEach(function (marca) {
          template += `
                  <tr>
                      <td>${marca.id}</td>
                      <td>${marca.nombre}</td>
                      <td>${marca.nombreCategoria}</td>
                      <td><button type="button" onClick=mostrarEnModal("${marca.id}") id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#marcaModal" data-fila = "${marca.id}">Editar</button>
                      <button type="button" onClick = eliminarMarcas("${marca.id}") class="btn btn-danger" data-fila = "${marca.id}">Borrar</button></td>
                  </tr>
                  `;
        });
        var elemento = document.getElementById("tbMarca");
        elemento.innerHTML = template;
        document.getElementById('txtPagVista').value = numPagina;
        document.getElementById('txtPagTotal').value = datos.paginas;

      } else {
        var elemento = document.getElementById("tbMarca");
        elemento.innerHTML = `
          <tr>
            <td colspan="3" class="text-center">No se encontraron resultados</td>
          </tr>
        `;
      }
    };
    ajax.send(data);
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarMarca");
const data = new FormData();
data.append("accion", "buscar");

cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  if (textoBusqueda.trim() == "") {
    listarMarca();
  } else{
    buscarMarca();
  }
});

function mostrarEnModal(marcaId){
  id = marcaId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/marcaController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    //console.log(datos);
    document.getElementById("nombreMarca").value = datos.nombre;
    document.getElementById("selMarca").value = datos.nombreCategoria;
    document.getElementById("codigoMarca").value = datos.id;
  };
  ajax.send(data);
}


/**************************/
/* BOTONES DE PAGINACIÓN */
let pagInicio = document.querySelector('#btnPrimero');
pagInicio.addEventListener('click', function (e) {
    numPagina = 1;
    document.getElementById('txtPagVista').value = numPagina;
    buscarMarca();
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
        buscarMarca();
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
        buscarMarca();
        pagSiguiente.blur();
    }
});
let pagFinal = document.querySelector('#btnUltimo');
pagFinal.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotal').value;
    document.getElementById('txtPagVista').value = numPagina;
    console.log(numPagina);
    buscarMarca();
    pagFinal.blur();
});