console.log("Starting");
traerTrabajos();

function traerTrabajos() {
  const ajax = new XMLHttpRequest();
  // Se establece la dirección del archivo php que procesará la petición
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
      mes.push(respuesta[i].mes);
      cantidad.push(respuesta[i].cantidad);
    }
    const ctx = document.getElementById("miCanvas");

    const myChart = new Chart(ctx, {
      type: "bar",
      data: {
        labels: mes,
        datasets: [
          {
            label: "Trabajos",
            data: cantidad,
            backgroundColor: ["rgba(17,60,255)"],
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
          tooltip: {
            enable: true,
          },
        },
      },
    });
  };
  ajax.send(data);
}
