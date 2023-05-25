var frmLogin = document.getElementById("formLogin");

frmLogin.onsubmit = function (e) {
  e.preventDefault();
  if (
    frmLogin.querySelector("#usuario").value !== "" &&
    frmLogin.querySelector("#passwd").value !== ""
  ) {
    console.log("inicio de sesión");
    buscarUsuario();
  } else {
    console.log("los campos no pueden estar vacíos");
    var elemento = document.getElementById("login-mensaje"); ///no hay usuario
    elemento.innerHTML = `<p>El usuario o la contraseña son erroneos</p>`;
  }
  frmLogin.reset();
};

function buscarUsuario() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/loginController.php", true);
  
  var data = new FormData(frmLogin);
 // var user= document.getElementById("usuario");
 // data.append("usuario", user.value);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let template = ""; // Estructura de la tabla html
    if (!datos.hasOwnProperty('negativo')) {
      ///redireccion windows.replace
      //template += `<p>Estas dentro</p>`;
      window.location.replace("../view/dashboardView.php");
      //var elemento = document.getElementById("login-mensaje");
      //elemento.innerHTML = template;
    } else {
      var elemento = document.getElementById("login-mensaje"); ///no hay usuario
      elemento.innerHTML = `<p>El usuario o la contraseña son erroneos</p>`;
    }
  };
  ajax.send(data);
}
