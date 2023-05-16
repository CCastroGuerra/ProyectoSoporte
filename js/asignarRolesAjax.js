let frmAsignarRol = document.getElementById('formARoles');
let dni ='';
var numPagina = 1;



document.body.onload = ()=>{
  listarSelectRol();
  listarAsignarRol();
}
//buscar();


frmAsignarRol.onsubmit = function (e) {
  e.preventDefault();
  if (frmAsignarRol.querySelector("#inputCodigo").value !== "") {
    console.log("actualizo");
    actualizar(id);
  } else {
   
    guardarDatos();
    listarAsignarRol();

  }
  frmAsignarRol.reset();
};



function listarSelectRol() {
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

function guardarDatos() {
  var idRolSeleccionado = document.getElementById("selAroles").value;
  var dni = document.getElementById("inputDni").value;

  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/asignarRolesController.php", true);
  var data = new FormData();
  data.append('dni', dni);
  data.append('accion', 'listar');
  ajax.onload = function() {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    if (respuesta !== '') {
      let datos = JSON.parse(respuesta);
      console.log(datos);

      // let apellidos = datos.apellidos;
      // let nombre  = datos.nombre;
      let id = datos[0].id;
      // let apellidos = datos[0].apellidos;
      // let nombre = datos[0].nombre;

      const ajaxGuardar = new XMLHttpRequest();
      ajaxGuardar.open("POST", "../controller/asignarRolesController.php", true);
      let dataGuardar = new FormData();
      dataGuardar.append('accion', 'guardar');
      dataGuardar.append('id', id);
      dataGuardar.append('combo', idRolSeleccionado);
      ajaxGuardar.onload = function() {
        let resp = ajaxGuardar.responseText;
        console.log(resp);
        if (resp === '1') {
          console.log("Datos guardados correctamente");
          listarAsignarRol();
          swal.fire(
            "Registrado!",
            "Se registro correctamente.",
            "success"
          );
        } else {
          console.log("Error al guardar los datos");
          swal.fire(
            "ERROR!",
            "Error al guardar los datos",
            "error"
          );
        }
      }
      ajaxGuardar.send(dataGuardar);
    } else {
      console.log('NO SE ENCONTRO EL DNI');
      swal.fire(
        "ERROR!",
        "No se encontro el DNI.",
        "error"
      );
      
    }
  }
  ajax.send(data);
  listarAsignarRol();
}

function listarAsignarRol() {
  let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/asignarRolesController.php", true);
  var data = new FormData();
  data.append("accion", "listarTabla");
  data.append("valor", "");
  data.append("cantidad", "4");
  data.append('registros',num_registros);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const asigRol = JSON.parse(respuesta);
    let template = ""; // Estructura de la tabla html
    if (asigRol.length > 0) {
      asigRol.forEach(function (asigRol) {
        template += `
                  <tr>
                      <td>${asigRol.id}</td>
                      <td>${asigRol.nombre}</td>
                      <td>${asigRol.apellidos}</td>
                      <td>${asigRol.nombreRol}</td>
                      <td><button type="button" onClick=mostrarEnModal("${asigRol.id}") id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#rolesModal" data-fila = "${asigRol.id}">Editar</button>
                      <button type="button" onClick = eliminar("${asigRol.id}") class="btn btn-danger" data-fila = "${asigRol.id}">Borrar</button></td>
                  </tr>
                  `;
      });
      var elemento = document.getElementById("tbRoles");
      elemento.innerHTML = template;
     
    }else{
      var elemento = document.getElementById("tbRoles");
      elemento.innerHTML = `
        <tr>
          <td colspan="6" class="text-center">No se encontraron datos</td>
        </tr>
      `;  
    }
  };
  ajax.send(data);
}

var elemento = document.getElementById("selAroles");
elemento.onchange = function() {
    var valorSeleccionado = elemento.value;
    console.log("Valor seleccionado:", valorSeleccionado);
};

function actualizar(id) {
  const dni = document.getElementById("inputDni").value;
  // Obtener los valores actualizados desde los elementos del modal
  
  const combo = elemento.value;
  swal
    .fire({
      title: "",
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
        ajax.open("POST", "../controller/asignarRolesController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("combo", combo);
        data.append("accion", "actualizar");
        ajax.onload = function () {
          console.log(ajax.responseText);
          listarAsignarRol();
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

function eliminar(id) {
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
        ajax.open("POST", "../controller/asignarRolesController.php", true);
        const data = new FormData();
        data.append("id", id);
        data.append("accion", "eliminar");
        ajax.onload = function () {
          var respuesta = ajax.responseText;
          console.log(respuesta);
          listarAsignarRol();
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

function mostrarEnModal(asigPerId){
  id = asigPerId;
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/asignarRolesController.php", true);
  const data = new FormData();
  data.append("id", id);
  data.append("accion", "mostrar");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    let datos = JSON.parse(respuesta);
    console.log(datos);
    document.getElementById("inputDni").value = datos.dni;
    document.getElementById("selAroles").value = datos.nombreRol;
    document.getElementById("inputCodigo").value = datos.id;
  };
  ajax.send(data);
}

/*limit para el select*/
var numRegistors = document.getElementById('numRegistros');
numRegistors.addEventListener("change", listarAsignarRol);

function buscar() {
  var cajaBuscar = document.getElementById("inputbuscarARoles");
  const textoBusqueda = cajaBuscar.value;
  let num_registros = document.getElementById('numRegistros').value;
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/asignarRolesController.php", true);
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
      let asigRol = datos.listado;
      let template = ""; // Estructura de la tabla html
      if (asigRol != 'vacio') {
        asigRol.forEach(function (asigRol) {
          template +=  `
          <tr>
              <td>${asigRol.id}</td>
              <td>${asigRol.nombre}</td>
              <td>${asigRol.apellidos}</td>
              <td>${asigRol.nombreRol}</td>
              <td><button type="button" onClick=mostrarEnModal("${asigRol.id}") id="btnEditar" class="btn btn-info btn-outline" data-coreui-toggle="modal" data-coreui-target="#rolesModal" data-fila = "${asigRol.id}">Editar</button>
              <button type="button" onClick = eliminar("${asigRol.id}") class="btn btn-danger" data-fila = "${asigRol.id}">Borrar</button></td>
          </tr>
          `;
        });
        var elemento = document.getElementById("tbRoles");
        elemento.innerHTML = template;
        document.getElementById('txtPagVista').value = numPagina;
        document.getElementById('txtPagTotal').value = datos.paginas;

      } else {
        var elemento = document.getElementById("tbRoles");
        elemento.innerHTML = `
          <tr>
            <td colspan="6" class="text-center">No se encontraron resultados</td>
          </tr>
        `; 
        document.getElementById('txtPagVista').value = 0;
        document.getElementById('txtPagTotal').value = 0; 
      }
    };
    ajax.send(data);
}

/*BUSCAR*/
var cajaBuscar = document.getElementById("inputbuscarARoles");
cajaBuscar.addEventListener("keyup", function (e) {
  const textoBusqueda = cajaBuscar.value;
  console.log(textoBusqueda);
  if (textoBusqueda.trim() == "") {
    listarAsignarRol();
  } else{

    buscar();
  }
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
        buscar();
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
        buscar();
        pagSiguiente.blur();
    }
});
let pagFinal = document.querySelector('#btnUltimo');
pagFinal.addEventListener('click', function (e) {
    numPagina = document.getElementById('txtPagTotal').value;
    document.getElementById('txtPagVista').value = numPagina;
    console.log(numPagina);
    buscar();
    pagFinal.blur();
});
