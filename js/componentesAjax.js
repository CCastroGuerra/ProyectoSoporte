var valorBuscar="";
var numPagina=1;
listarSelectComponentes();
listarSelectMarca();
listarSelectClase();
listarSelectEstado();
buscarComponente();
let selecModelo = document.getElementById('selModelo');
let selecMarca = document.getElementById('selMarca');
let frmComponentes = document.getElementById("formAcomponente");

formAcomponente.onsubmit = function (e) {
  e.preventDefault();
  if (frmComponentes.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    //actualizar(id);
  } else {
    guardarComponente();
    //buscarModelo();
    console.log("guardo");
  }
  frmComponentes.reset();
};



selecModelo.disabled = true;
selecMarca.addEventListener('change',() =>{
    let marcaId = selecMarca.value;
    console.log(marcaId);
    const ajax = new XMLHttpRequest();
    //Se establace la direccion del archivo php que procesara la peticion
    ajax.open('POST', '../controller/componentesController.php', true); 
    var data = new FormData();
    data.append('accion','listarModel');
    data.append('id',marcaId);
    selecModelo.disabled = false;
    ajax.onload = () =>{
        let respuesta = ajax.responseText;
        console.log(respuesta);
        let marcas = JSON.parse(respuesta);
        console.log(marcas);
        let options = "<option value=''>Seleccione una Modelo</option>";
       if(marcas.length > 0){
        marcas.forEach(function (marcas) {
            options += `
            <option value='${marcas.id}'>${marcas.nombre}</option>
                      `;
          });
        }else{
            selecModelo.disabled = true;

        }
        //Actualizar combo
        document.getElementById('selModelo').innerHTML=options;

    }
    ajax.send(data);
});

function listarSelectMarca() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/componentesController.php", true);
    var data = new FormData();
    data.append("accion", "listarMarca");
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

function listarSelectComponentes() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/componentesController.php", true);
    var data = new FormData();
    data.append("accion", "listarComponentes");
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const componentes = JSON.parse(respuesta);
      let template = ""; // Estructura de la tabla html
      if (componentes.length > 0) {
        template = `<option value="0">Seleccione el tipo</option>
          `;
          componentes.forEach(function (componentes) {
          template += `
                     
                      <option value="${componentes.id}">${componentes.nombre}</option>
                  
                      `;
        });
        var elemento = document.getElementById("selTipo");
        elemento.innerHTML = template;
      }
    };
    ajax.send(data);
}


function listarSelectClase() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/componentesController.php", true);
    var data = new FormData();
    data.append("accion", "listarClases");
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const clase = JSON.parse(respuesta);
      let template = ""; // Estructura de la tabla html
      if (clase.length > 0) {
        template = `<option value="0">Seleccione la clase</option>
          `;
          clase.forEach(function (clase) {
          template += `
                     
                      <option value="${clase.id}">${clase.nombre}</option>
                  
                      `;
        });
        var elemento = document.getElementById("selClase");
        elemento.innerHTML = template;
      }
    };
    ajax.send(data);
}

function listarSelectEstado() {
    //let num_registros = document.getElementById('numeroRegistros').value;
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/componentesController.php", true);
    var data = new FormData();
    data.append("accion", "listarEstado");
    ajax.onload = function () {
      let respuesta = ajax.responseText;
      console.log(respuesta);
      const estado = JSON.parse(respuesta);
      let template = ""; // Estructura de la tabla html
      if (estado.length > 0) {
        template = `<option value="0">Seleccione estado</option>
          `;
          estado.forEach(function (estado) {
          template += `
                     
                      <option value="${estado.id}">${estado.nombre}</option>
                  
                      `;
        });
        var elemento = document.getElementById("selEstado");
        elemento.innerHTML = template;
      }
    };
    ajax.send(data);
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarComponentes");
cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  numPagina = 1;
  buscarComponente();
});


function buscarComponente() {
  var cajaBuscar = document.getElementById("inputbuscarComponentes");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData();
  data.append("accion", "buscar");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let componentes = datos.listado;
    console.log(componentes);
    let template = ""; // Estructura de la tabla html
    if (componentes != "vacio") {
      componentes.forEach(function (componentes) {
        template += `
                  <tr>
                      <td>${componentes.nombreTipo}</td>
                      <td>${componentes.nombreClase}</td>
                      <td>${componentes.nombreMarca}</td>
                      <td>${componentes.nombreModelo}</td>
                      <td>${componentes.serie}</td>
                      <td>${componentes.capacidad}</td>
                      <td>${componentes.estado}</td>
                      <td>${componentes.Fecha}</td>
                      <td>

                      <button type="button" onClick='mostrarEnModal("${componentes.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button type="button" onClick='eliminarComponentes("${componentes.id}")' class="btn btn-danger" data-fila="${componentes.id}"><i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = template;
      document.getElementById("txtPagVista").value = numPagina;
      document.getElementById("txtPagTotal").value = datos.paginas;

      /* Mostrando mensaje de los registros*/
      let registros = document.getElementById("txtcontador");
      let mostrarRegistro = `
      <p><span id="totalRegistros">Mostrando ${componentes.length} de ${datos.total} registros</span></p>`;
      registros.innerHTML = mostrarRegistro;

    } else {
      var elemento = document.getElementById("tbEquipos");
      elemento.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">No se encontraron resultados</td>
          </tr>
        `;

      // document.getElementById("txtPagVista").value = 0;
      // document.getElementById("txtPagTotal").value = 0;
    }
  };
  ajax.send(data);
}

function guardarComponente() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/componentesController.php", true);
  var data = new FormData(frmModelo);
  data.append("accion", "guardar");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    //buscarArea();
    buscarModelo();
    frmModelo.reset();
  };
  ajax.send(data);
}