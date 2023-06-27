console.log("Starting");
traerTrabajos();
function traerTrabajos() {
  const ajax = new XMLHttpRequest();
  //Se establace la direccion del archivo php que procesara la peticion
  ajax.open("POST", "../controller/dashboardController.php", true);
  var data = new FormData();
  data.append("accion", "mostrarDatos");
  ajax.onload = function () {
    let mes = [];
    let cantidad = [];
    realizado = ajax.responseText;
    let respuesta = JSON.parse(realizado);
    console.log(respuesta);
    for (let i = 0; i < respuesta.length; i++) {
      mes.push(respuesta[i][0]);
      cantidad.push(respuesta[i][1]);
    }
    const ctx = document.getElementById("miCanvas");

    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: mes,
        datasets: [
          {
            label: "Datos",
            data: cantidad,
            backgroundColor: ["rgba(255,99,132,0.2)"],
            borderColor: ["rgba(255,99,132,1)"],
            borderWith: 1.5,
          },
        ],
      },
    });
  };
  ajax.send(data);
}

// const ctx = document.getElementById("miCanvas");
// const nombres = ["Carlos", "Maria"];
// const edades = ["10", "20"];

// const myChart = new Chart(ctx, {
//   type: "bar",
//   data: {
//     labels: nombres,
//     datasets: [
//       {
//         label: "Edad",
//         data: cantidad,
//         backgroundColor: ["rgba(255,99,132,0.2)"],
//         borderColor: ["rgba(255,99,132,1)"],
//         borderWith: 1.5,
//       },
//     ],
//   },
// });
