console.log("Starting");
traerTrabajosxMes();
traerTrabajosXArea();
function traerTrabajosxMes() {
  const ajax = new XMLHttpRequest();
  // Se establece la dirección del archivo php que procesará la petición
  ajax.open("POST", "../controller/dashboardController.php", true);
  var data = new FormData();
  data.append("accion", "mostrarDatos");
  ajax.onload = function () {
    let mes = [];
    let cantidad = [];
    const colores = [];
    realizado = ajax.responseText;
    let respuesta = JSON.parse(realizado);
    console.log(respuesta);
    for (let i = 0; i < respuesta.length; i++) {
      mes.push(respuesta[i].mes);
      cantidad.push(respuesta[i].cantidad);
      colores.push(generarColorAleatorio());
    }
    const ctx = document.getElementById("miCanvas");

    //Codigo para generar colores para las distintas barras
    // const datasets = mes.map((m, index) => {
    //   return {
    //     label: m,
    //     data: [cantidad[index]],
    //     backgroundColor: [colores[index]],
    //     borderColor: "rgba(1,5,22,1)",
    //     borderWidth: 2,
    //   };
    // });

    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: mes,

        datasets: [
          {
            label: "Trabajos",
            data: cantidad,
            backgroundColor: ["rgba(70,216,255,1)"],
            borderColor: ["rgba(1,5,22,1)"],
            borderWidth: 2,
          },
        ],
      },
      options: {
        responsive: true, // Hace que el gráfico sea responsive
        maintainAspectRatio: false,
        // Permite ajustar el tamaño del gráfico
        //indexAxis: "y", //cambiar de posicion el grafico
        scales: {
          y: {
            beginAtZero: true,
          },
        },
        plugins: {
          tooltip: {},
        },
      },
    });
  };
  ajax.send(data);
}
const generarColorAleatorio = () => {
  const r = Math.floor(Math.random() * 256);
  const g = Math.floor(Math.random() * 256);
  const b = Math.floor(Math.random() * 256);
  return `rgba(${r},${g},${b},1)`;
};

function traerTrabajosXArea() {
  const ajax = new XMLHttpRequest();
  // Se establece la dirección del archivo php que procesará la petición
  ajax.open("POST", "../controller/dashboardController.php", true);
  var data = new FormData();
  data.append("accion", "mostrarTrabajosArea");
  ajax.onload = function () {
    const colores = [];
    let area = [];
    let cantidad2 = [];
    realizado = ajax.responseText;
    let respuesta = JSON.parse(realizado);
    console.log(respuesta);
    for (let i = 0; i < respuesta.length; i++) {
      area.push(respuesta[i].area);
      cantidad2.push(respuesta[i].cantidad);
      colores.push(generarColorAleatorio());
    }
    const canva = document.getElementById("miCanvas2");

    const myChart2 = new Chart(canva, {
      type: "pie",
      data: {
        labels: area,
        datasets: [
          {
            label: "",
            data: cantidad2,
            backgroundColor: colores,
            borderColor: ["rgba(1,5,22,1)"],
            borderWidth: 2,
          },
        ],
      },
      options: {
        responsive: true, // Hace que el gráfico sea responsive
        maintainAspectRatio: false,
        // Permite ajustar el tamaño del gráfico
        //indexAxis: "y", //cambiar de posicion el grafico
        scales: {
          y: {
            beginAtZero: true,
          },
        },
        plugins: {
          tooltip: {},
        },
      },
    });
  };
  ajax.send(data);
}
