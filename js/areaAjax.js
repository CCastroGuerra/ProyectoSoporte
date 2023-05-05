var formulario = document.getElementById("formArea");

function init() {
  formulario.onsubmit = function (e) {
    //guardarTarea(e);
   
    guardarArea(e);
    document.getElementById("id_area").value ="";
    document.getElementById("nombre_area").value ="";
    // if(formulario.querySelector("#id").value !== ""){
    //   console.log("actualizo");
    //   actualizar();
    // }else{
    //   gu
    //   console.log("guardo");
    // }
    e.preventDefault();
  };
}

/*********************/
// Función para inicializar el DataTable
function inicializarTabla() {
  const tabla = document.getElementById('tablaAreas');
  const dataTable = new DataTable(tabla, {
    columns: [
      { title: "ID", data: "id_area" },
      { title: "Nombre", data: "nombre_area" },
      {
        data: "id_area",
        render: function(data, type, row) {
          return `<td><button type="button" onClick="document.getElementById('tituloModal').innerText='Editar Área';mostrarEnModal(${data})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#areaModal" id="${data}">Editar</button></td>`;
        }
      },
      {
        data: "id_area",
        render: function(data, type, row) {
          return `<td><button type="button" onClick="eliminar(${data})" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal" id="${data}">Eliminar</button></td>`;
        }
      },
      
    ],
    lengthMenu: [5, 10, 15, 20, 100, 200, 500],
    pageLength: 3,
    destroy: true,
    responsive:true,
    language: {
      decimal: ".",
      emptyTable: "No hay datos disponibles en esta tabla",
      info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
      infoEmpty: "Mostrando 0 de 0 de 0 entradas",
      infoFiltered: "(Filtrado de _MAX_ total entradas)",
      "infoPostFix": "",
      thousands: ",",
      lengthMenu: "Mostrar _MENU_ Entradas",
      loadingRecords: "Cargando...",
      processing: "Procesando...",
      search: "Buscar:",
      zeroRecords: "Sin resultados encontrados",
      paginate: {
        first: "Primero",
        last: "Ultimo",
        next: ">",
        previous: "<"
      },
      search: "_INPUT_",
      searchPlaceholder: "Buscar..."
    },
    pagingType: "full_numbers",
    pagingTag: "button",
  "columnDefs": [{
     "targets": [-1],

 "searchable": false,

   }]

  });
  return dataTable;
}

// Función para cargar los datos desde la base de datos
function cargarDatos() {
  const url = "../controller/areaController.php?opcion=listar";
  const ajax = new XMLHttpRequest();
  ajax.onreadystatechange = function() {
    if (this.readyState === 4 && this.status === 200) {
      //const data = ajax.responseText;
      const datos = JSON.parse(this.responseText);
      //console.log(data);
      dataTable.clear().rows.add(datos).draw();
    }
  };
  ajax.open("GET", url, true);
  ajax.send();
}

// Llamamos a la función para inicializar el DataTable
const dataTable = inicializarTabla();

// Llamamos a la función para cargar los datos desde la base de datos
cargarDatos();

/********************/

let fromModal = document.getElementById("formArea");
function actualizar() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php?opcion=actualizar", true);
  const data = new FormData(fromModal);
  ajax.onload = function () {
    console.log(ajax.responseText);
  };
  ajax.send(data);
}


function eliminar(id) {
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
        ajax.open("POST", "../controller/areaController.php?opcion=eliminar", true);
        const data = new FormData();
        data.append("id", id);
        ajax.onload = function () {
          console.log(ajax.responseText);
          //cargarTabla();
          //listarTareas();
          cargarDatos();
          swal.fire(
            "Eliminado!",
            "El registro se elimino correctamente.",
            "success"
          );
        };
        console.log("id=" + id);
        ajax.send(data);
      }
    });
}

function guardarArea(e) {
  e.preventDefault();
  var data = new FormData(formulario);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php?opcion=guardaryeditar", true);
  ajax.onload = function () {
    let respueta = ajax.responseText;
    console.log(respueta);
    cargarDatos();
    swal.fire("Registrado!", "Registrado correctamente.", "success");
  };
  formulario.reset();
  ajax.send(data);
}

const modal = document.getElementById("exampleModal");

// function actualizar(id) {
//   const nombreInput = modal.querySelector("#nombre");
//   //const descripcionInput = modal.querySelector("#descripcion");

//   // Obtener los valores actualizados desde los elementos del modal
//   const nombre = nombreInput.value;
//   //const descripcion = descripcionInput.value;

//   swal
//     .fire({
//       title: "CRUD",
//       text: "Desea actualizar el registro?",
//       icon: "question",
//       showCancelButton: true,
//       confirmButtonText: "Si",
//       cancelButtonText: "No",
//       reverseButtons: true,
//     })
//     .then((result) => {
//       if (result.isConfirmed) {
//         const ajax = new XMLHttpRequest();
//         ajax.open(
//           "POST",
//           "../controller/areaController.php?opcion=actualizar",
//           true
//         );
//         const data = new FormData();
//         data.append("id", id);
//         data.append("nombre", nombre);
//         ajax.onload = function () {
//           console.log(ajax.responseText);
//           cargarDatos();
//           swal.fire(
//             "Actualizado!",
//             "El registro se actualizó correctamente.",
//             "success"
//           );
//           // cerrar el modal después de actualizar
//           modal.classList.remove("show");
//           modal.setAttribute("aria-hidden", "true");
//           modal.setAttribute("style", "display: none");
//           document.body.classList.remove("modal-open");
//           document.body.removeAttribute("style");
//           document.querySelector(".modal-backdrop").remove();
//         };
//         ajax.send(data);
//       }
//     });
// }

function mostrarEnModal(id) {
  console.log(id);
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/areaController.php?opcion=mostrar", true);
  const data = new FormData();
  data.append("id", id);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    let datos = JSON.parse(respuesta);
    console.log(respuesta);
    document.getElementById("id_area").value = datos.id_area;
    document.getElementById("nombre_area").value = datos.nombre_area;
  };
  ajax.send(data);
}

function guardaryeditar(e) {
  e.preventDefault();
  var formData = new FormData(document.querySelector("#formArea"));
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../controller/areaController.php?opcion=guardaryeditar");
  xhr.onload = function () {
  if (xhr.status === 200) {
  Swal.fire(
  'Registro!',
  'El registro correctamente.',
  'success'
  );
  } else {
    console.log("Hubo un error al intentar guardar o editar el registro.");
  }
  };
  xhr.send(formData);
}

init();
