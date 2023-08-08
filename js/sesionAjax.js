var el = document.getElementById("sessRol");
el.dataset.sess;
var rolespermitidos = ["1"];
var ro = document.getElementById("sessRol");

//para rol Secretaria = 2
/*
-no puede editar (botones editar anulados/ocultos)
-vista de reportes
*/
$("#tbProductos").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbProductos tr");
  console.log("la tabla cambió: " + tabla.length);
  Secretaria();
});

$("#tbComponentes").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbComponentes tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

$("#tbBajas").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbBajas tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

$("#tbMarca").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbMarca tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

$("#tbModelo").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbModelo tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

$("#tbArea").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbArea tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

$("#tbRoles").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbRoles tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

$("#tbServicio").bind("MutationObserver", function () {
  var tabla = document.querySelectorAll("#tbServicio tr");
  //console.log("la tabla cambió, componentes: " + tabla.length);
  Secretaria();
});

/////////

//para rol Tecnico = 3
/*

*/

function Secretaria() {
  var rolespermitidos = ["1"];
  var ro = document.getElementById("sessRol");//obtiene el rol de quien se a logueado
  var permSecretaria = ["2","3","4"];
  var permAdmin =["1"];
  //console.log("funcion secretaria");
  if (permSecretaria.includes(ro.dataset.sess)) {
    //console.log("susuario secretaria");
    sinEliminar();
  }
  if (permAdmin.includes(ro.dataset.sess)) {
    conEdicion();
    conEliminar();
  }
}

function sinEdicion(){
  botonEdit = document.querySelectorAll("#btnEditar");
    botonEdit.forEach((element) => {
      element.disabled = true;
    });
}

function conEdicion() {
  botonEdit = document.querySelectorAll("#btnEditar");
    botonEdit.forEach((element) => {
      element.disabled = false;
    });
}

function sinEliminar(){
  botonEliminar = document.querySelectorAll(".pelim");    
    botonEliminar.forEach((element) => {
      element.disabled = true;
    });
}
function conEliminar() {
  botonEliminar = document.querySelectorAll(".pelim");    
    botonEliminar.forEach((element) => {
      element.disabled = false;
    });
}
