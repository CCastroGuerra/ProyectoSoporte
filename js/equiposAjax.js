
buscarEquipo();
listarTablaTemp();
listarSelectTipo();
listarSelectMarca();
listarSelectArea();
listarSelectEstado();
listarResponsable();
let frmComponentes = document.getElementById('formEquipos');
let frmEquipos = document.getElementById('formAEquipo');
let selecModelo = document.getElementById("selModeloEquipo");
let selecMarca = document.getElementById("selMarcaEquipo");
let selectTipo = document.getElementById("selTipoEquipo");
let selectEstado = document.getElementById("selEstado");


frmComponentes.onsubmit = function (e) {
    e.preventDefault();
    guardarComponentes();

};

frmEquipos.onsubmit = function (e) {
  e.preventDefault();
  guardarEquipo();


};


selecModelo.disabled = true;
selecMarca.addEventListener("change", () => {
  let marcaId = selecMarca.value;
  console.log(marcaId);
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarModel");
  data.append("id", marcaId);
  selecModelo.disabled = false;
  ajax.onload = () => {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let marcas = JSON.parse(respuesta);
    console.log(marcas);
    let options = "<option value=''>Seleccione una Modelo</option>";
    if (marcas.length > 0) {
      marcas.forEach(function (marcas) {
        options += `
            <option value='${marcas.id}'>${marcas.nombre}</option>
                      `;
      });
    } else {
      selecModelo.disabled = true;
    }
    //Actualizar combo
    document.getElementById("selModeloEquipo").innerHTML = options;
  };
  ajax.send(data);
});

function listarSelectMarca() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
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
      var elemento = document.getElementById("selMarcaEquipo");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectArea() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarArea");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const area = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (area.length > 0) {
      template = `<option value="0">Seleccione Área</option>
          `;
      area.forEach(function (area) {
        template += `
                     
                      <option value="${area.id}">${area.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selArea");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function listarSelectEstado() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarEstado");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const estado = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (estado.length > 0) {
      template = `<option value="0">Seleccione Estado</option>
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

function listarResponsable() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarResponsable");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const responsable = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (responsable.length > 0) {
      template = `<option value="0">Seleccione Estado</option>
          `;
      responsable.forEach(function (responsable) {
        template += `
                     
                      <option value="${responsable.id}">${responsable.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("responsable");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}


function listarSelectTipo() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarTipo");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const tipo = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (tipo.length > 0) {
      template = `<option value="0">Seleccione Área</option>
          `;
      tipo.forEach(function (tipo) {
        template += `
                     
                      <option value="${tipo.id}">${tipo.nombre}</option>
                  
                      `;
      });
      var elemento = document.getElementById("selTipoEquipo");
      elemento.innerHTML = template;
    }
  };
  ajax.send(data);
}

function guardarComponentes() {
    var codigo = document.getElementById("codigo").value;
  
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/equiposController.php", true);
    var data = new FormData();
    data.append("codigo", codigo);
    data.append("accion", "traerComponentes");
    ajax.onload = function () {
      let respuesta = ajax.responseText;
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
          "../controller/equiposController.php",
          true
        );
        let dataGuardar = new FormData();
        dataGuardar.append("accion", "guardarTempo");
        dataGuardar.append("id", id);
        dataGuardar.append("codigo", codigo);

        ajaxGuardar.onload = function () {
          let resp = ajaxGuardar.responseText;
          console.log(resp);
          if (resp === "1") {
            console.log("Datos guardados correctamente");
            listarTablaTemp();
            swal.fire("Registrado!", "Se registro correctamente.", "success");
          } else {
            console.log("Error al guardar los datos");
            swal.fire("ERROR!", "Error al guardar los datos", "error");
          }
        };
        ajaxGuardar.send(dataGuardar);
      } else {
        console.log("NO SE ENCONTRO EL COMPONENTE");
        swal.fire("ERROR!", "No se encontro el componente.", "error");
      }
    };
    ajax.send(data);
    listarTablaTemp ();
}

function listarTablaTemp() {
  //let num_registros = document.getElementById('numeroRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "listarTablaTempo");
  // data.append("valor", "");
  // data.append("cantidad", "4");
  // data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const temp = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (temp.length > 0) {
      template = ``;
      temp.forEach(function (temp) {
        template += `
        <tr>
        <td>${temp.serie}</td>
        <td>${temp.nombreTipo}</td>
        <td>${temp.nombreClase}</td>
        <td>${temp.nombreMarca}</td>
        <td>${temp.nombreModelo}</td>
        <td>${temp.capacidad}</td>
        <td>${temp.estado}</td>
        <td>
        <button type="button" onClick='eliminarComponentesTemp("${temp.id}")' class="btn btn-danger" data-fila="${temp.id}"><i class="fa fa-trash" aria-hidden="true"></i>
        </button>
        </td>
        </tr>
                      
                  
                      `;
      });
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = template;
    }else{
      var elemento = document.getElementById("tbComponentes");
      elemento.innerHTML = ` <tr>
      <td colspan="6" class="text-center">No se encontraron datos</td>
    </tr>`;
    }
  };
  ajax.send(data);


}

function guardarEquipo() {
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData(frmEquipos);
  data.append("accion", "guardarEquipo");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      guardarEquipoComponente();
      swal.fire("Registrado!", "Registrado correctamente.", "success");
    }
    //buscarArea();
    //buscarComponente();
    frmEquipos.reset();
  };
  ajax.send(data);
  var elemento = document.getElementById("tbComponentes");
  elemento.innerHTML = ``;
}

function guardarEquipoComponente() {
  let serie = document.getElementById('serie').value;
  var realizado = "";
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append('serie', serie);
  data.append("accion", "guardarEquipoComponente");
  ajax.onload = function () {
    realizado = ajax.responseText;
    console.log(realizado);
    if (realizado * 1 > 0) {
      console.log('Equipo Componente registrado correctamente');
    }
    //buscarArea();
    //buscarComponente();
    frmEquipos.reset();
  };
  ajax.send(data);
}

function eliminarComponentesTemp(id) {
  console.log(id);
  swal
    .fire({
      title: "AVISO DEL SISTEMA",
      text: "¿Desea Eliminar el Registro?",
      icon: "error",
      showCancelButton: true,
      confirmButtonText: "Si",
      cancelButtonText: "No",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "../controller/equiposController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminarComponenteTemp");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarTablaTemp();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        //let tab = document.getElementById("tbComponentes");
        // if (tab.rows.length == 1) {
        //   //document.getElementById('txtPagVistaPre').value = numPagina - 1;
        //   numPagina = numPagina - 1;
        // }
        ajax.send(data);
      }
    });
}

function buscarEquipo() {
  let numPagina = 1;
  var cajaBuscar = document.getElementById("inputbuscarEquipos");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById("numRegistros").value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/equiposController.php", true);
  var data = new FormData();
  data.append("accion", "buscarEquipos");
  data.append("cantidad", "5");
  data.append("registros", num_registros);
  data.append("pag", numPagina);
  data.append("textoBusqueda", textoBusqueda);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let equipos = datos.listado;
    console.log(equipos);
    let template = ""; // Estructura de la tabla html
    if (equipos != "vacio") {
      equipos.forEach(function (equipos) {
        template += `
                  <tr>
                     
                      <td>${equipos.nombreArea}</td>
                      <td>${equipos.nombreMarca}</td>
                      <td>${equipos.nombreModelo}</td>
                      <td>${equipos.serie}</td>
                      <td>${equipos.margesi}</td>
                      <td>${equipos.ip}</td>
                      <td>${equipos.mac}</td>
                      <td>${equipos.estado}</td>
                      <td>

                      <button type="button" onClick='mostrarEnModal("${equipos.id}")' id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#añadirComponente"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                      </button>
                      <button type="button" onClick='eliminarComponentes("${equipos.id}")' class="btn btn-danger" data-fila="${equipos.id}"><i class="fa fa-trash" aria-hidden="true"></i>
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
      <p><span id="totalRegistros">Mostrando ${equipos.length} de ${datos.total} registros</span></p>`;
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