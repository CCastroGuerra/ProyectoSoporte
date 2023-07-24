var frmLogin = document.getElementById("formLogin");
var toastT = document.getElementById("login-mensaje");
var toast = new coreui.Toast(toastT);

//visbilidad de  contraseña
$("#togglePassword").on("click", function () {
  console.log("click" + $(this));
  var typ = $(this).parent().parent().find("#passwd").attr("type");
  console.log("input: " + typ);
  var rvisible = "img/icons8-visible-16.png";
  var rinvisible = "img/icons8-invisible-16.png";
  if (typ == "password") {
    $(this).attr("src", rvisible);
    $(this).parent().parent().find("#passwd").attr("type", "text");
  } else {
    $(this).attr("src", rinvisible);
    $(this).parent().parent().find("#passwd").attr("type", "password");
  }
});

frmLogin.onsubmit = function (e) {
  e.preventDefault();
  
  var elemento = document.getElementById("login-mensaje");
  var eus= (document.querySelector("#usuario").value=="") ? 1:0;
  var eps= (document.querySelector("#passwd").value=="") ? 2:0;
  var error = eus + eps;
  console.log("eus: "+eus);
  console.log("eps: "+eps);
  console.log("error: "+error);
  switch (error) {
    case 1:
      elemento.querySelector("#msg").innerHTML = `<strong>El usuario está vacío<strong>`;
      break;
    case 2:
      elemento.querySelector("#msg").innerHTML = `<strong>La contraseña está vacía</strong>`;
      break;
    case 3:
      elemento.querySelector("#msg").innerHTML = `<strong>El usuario o la contraseña están vacíos<strong>`;
      break;
  }
  if (error == 0  ) {
    console.log("inicio de sesión");
    buscarUsuario();
  } else {
    console.log("los campos no pueden estar vacíos"); ///no hay usuario
    //elemento.querySelector("#msg").innerText = `El usuario o la contraseña son erroneos`;
    toast.show();
    /* elemento.classList.remove("hide");
    elemento.classList.add("show"); */
  }
  //frmLogin.reset();
};

frmLogin.querySelector("#usuario").addEventListener("input", () => {
  //escribiendo usuario
  if (
    document.getElementById("login-mensaje").querySelector("#msg").value != ""
  ) {
    document.getElementById("login-mensaje").querySelector("#msg").innerText =
      "";
    var elemento = document.getElementById("login-mensaje");
    if (elemento.classList.contains("show")) {
      toast.hide();
    }
    /* elemento.classList.remove("show");
    elemento.classList.add("hide"); */
  }
});

frmLogin.querySelector("#passwd").addEventListener("input", () => {
  //escribiendo contraseña
  if (
    document.getElementById("login-mensaje").querySelector("#msg").value != ""
  ) {
    document.getElementById("login-mensaje").querySelector("#msg").innerText =
      "";
    var elemento = document.getElementById("login-mensaje");
    if (elemento.classList.contains("show")) {
      toast.hide();
    }
    /* elemento.classList.remove("show");
    elemento.classList.add("hide"); */
  }
});

function buscarUsuario() {
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "controller/loginController.php", true);

  var data = new FormData(frmLogin);
  // var user= document.getElementById("usuario");
  // data.append("usuario", user.value);
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    console.log(respuesta);
    const datos = JSON.parse(respuesta);
    console.log(datos);
    let template = ""; // Estructura de la tabla html
    if (!datos.hasOwnProperty("negativo")) {
      ///redireccion windows.replace
      //template += `<p>Estas dentro</p>`;
      window.location.replace("view/dashboardView-cv.php");
      //var elemento = document.getElementById("login-mensaje");
      //elemento.innerHTML = template;
    } else {
      var elemento = document.getElementById("login-mensaje"); ///no hay usuario
      elemento.querySelector(
        "#msg"
      ).innerHTML = `<strong>El usuario o la contraseña son erroneoss</strong>`;
      frmLogin.querySelector("#passwd").value = "";
      toast.show();
    }
  };
  ajax.send(data);
}
