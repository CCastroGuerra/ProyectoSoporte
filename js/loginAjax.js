var frmLogin = document.getElementById("formLogin");
var toastT= document.getElementById("login-mensaje");
var toast = new coreui.Toast(toastT);

//visbilidad de  contraseña
$("#togglePassword").on("click", function () {
  console.log("click"+$(this));
  var typ = $(this).parent().parent().find("#passwd").attr("type");
  console.log("input: "+typ);
  var rvisible="img/icons8-visible-16.png";
  var rinvisible="img/icons8-invisible-16.png";
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
  if (
    frmLogin.querySelector("#usuario").value !== "" &&
    frmLogin.querySelector("#passwd").value !== ""
  ) {
    console.log("inicio de sesión");
    buscarUsuario();
  } else {
    console.log("los campos no pueden estar vacíos");
    var elemento = document.getElementById("login-mensaje"); ///no hay usuario
    elemento.querySelector("#msg").innerText = `El usuario o la contraseña son erroneos`;
    toast.show();
    /* elemento.classList.remove("hide");
    elemento.classList.add("show"); */
    
  }
  frmLogin.reset();
}; 

frmLogin.querySelector("#usuario").addEventListener("input", ()=>{
  //escribiendo usuario
  if (document.getElementById("login-mensaje").querySelector("#msg").value!="") {
    document.getElementById("login-mensaje").querySelector("#msg").innerText="";
    var elemento = document.getElementById("login-mensaje");
    if(elemento.classList.contains("show")){
      toast.hide();
    }
    /* elemento.classList.remove("show");
    elemento.classList.add("hide"); */
  }
});

frmLogin.querySelector("#passwd").addEventListener("input", ()=>{
  //escribiendo contraseña
  if (document.getElementById("login-mensaje").querySelector("#msg").value!="") {
    document.getElementById("login-mensaje").querySelector("#msg").innerText="";
    var elemento = document.getElementById("login-mensaje");
    if(elemento.classList.contains("show")){
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
    if (!datos.hasOwnProperty('negativo')) {
      ///redireccion windows.replace
      //template += `<p>Estas dentro</p>`;
      window.location.replace("view/dashboardView-edit.php");
      //var elemento = document.getElementById("login-mensaje");
      //elemento.innerHTML = template;
    } else {
      var elemento = document.getElementById("login-mensaje"); ///no hay usuario
      elemento.innerHTML = `<p>El usuario o la contraseña son erroneos</p>`;
    }
  };
  ajax.send(data);
}
