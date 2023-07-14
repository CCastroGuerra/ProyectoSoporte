console.log("iniciando");
traerTrabajosXArea();
traerTrabajosxMes();
Chart.defaults.pointHitDetectionRadius = 1;
Chart.defaults.plugins.tooltip.enabled = false;
Chart.defaults.plugins.tooltip.mode = "index";
Chart.defaults.plugins.tooltip.position = "nearest";
Chart.defaults.plugins.tooltip.external = coreui.ChartJS.customTooltips;
Chart.defaults.defaultFontColor = "#646470";
const random = (min, max) =>
  // eslint-disable-next-line no-mixed-operators
  Math.floor(Math.random() * (max - min + 1) + min);

function traerTrabajosxMes() {
  console.log("traerTrabajosxMes");
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
    console.log(realizado);
    if (realizado == "") {
      //execute
      console.log("vacio");
      mes.push(null);
      cantidad.push(null);
      document.getElementById("miCanvas").setAttribute("style","display:none");
      document.getElementById("no-data").style.display = "block";
    } else {
      let respuesta = JSON.parse(realizado);
      console.log(respuesta);
      for (let i = 0; i < respuesta.length; i++) {
        mes.push(respuesta[i].mes);
        cantidad.push(respuesta[i].cantidad);
        colores.push(generarColorAleatorio());
        const ctx = document.getElementById("miCanvas");

        const myChart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: mes,
            /* labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], */
            datasets: [
              {
                label: "Trabajos",
                backgroundColor: colores,
                /* borderColor: coreui.Utils.getStyle('--cui-info'),
                borderWidth: 2, */
                data: cantidad,
                /* data: [random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200)], */
                fill: false,
              },
            ],
          },
          options: {
            responsive: true, // Hace que el gráfico sea responsive
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false,
              },
              tooltip: {
                enabled: true,
                external: null,
                position: "average",
              },
            },
            // Permite ajustar el tamaño del gráfico
            //indexAxis: "y", //cambiar de posicion el grafico
            scales: {
              x: {
                grid: {
                  drawOnChartArea: false,
                },
              },
              y: {
                ticks: {
                  beginAtZero: true,
                  maxTicksLimit: 5,
                  stepSize: Math.ceil(250 / 5),
                  max: 100,
                },
              },
            },
            elements: {
              line: {
                tension: 0.4,
              },
              point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4,
                hoverBorderWidth: 3,
              },
            },
            animation: {
              oncomplete: function (animation) {
                var firstSet = animation.chart.config.data.datasets[0].data,
                  dataSum = firstSet.reduce(
                    (accumulator, currentValue) => accumulator + currentValue
                  );
                console.log("firstSet: "+firstSet);
                console.log("datasum: "+dataSum);
    
                if (typeof firstSet !== "object" || dataSum === 0) {
                  console.log("se cumple ocultando");
                  document.getElementById("no-data").style.display = "block";
                  document.getElementById("miCanvas").style.display =
                    "none";
                }
              },
            },
          },
        });
      }
    }

   
  };
  ajax.send(data);
}

function traerTrabajosXArea() {
  console.log("traerTrabajosXArea");
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/dashboardController.php", true);
  var data = new FormData();
  data.append("accion", "mostrarTrabajosArea");
  ajax.onload = function () {
    const colores = [];
    let area = [];
    let cantidad2 = [];
    realizado = ajax.responseText;
    let respuesta = JSON.parse(realizado);
    //console.log(respuesta);
    for (let i = 0; i < respuesta.length; i++) {
      area.push(respuesta[i].area);
      cantidad2.push(respuesta[i].cantidad);
      colores.push(generarColorAleatorio());
    }
    const canva = document.getElementById("miCanvas2");
    let colors = ["#44FF07", "#FED60A", "#FB0007", "#3700FF", "#FB13F3"];
    const myChart2 = new Chart(canva, {
      type: "pie",
      data: {
        labels: area,
        datasets: [
          {
            label: "",
            data: cantidad2,
            backgroundColor: colores,
            /* borderColor: ["rgba(1,5,22,1)"],
            borderWidth: 2, */
          },
        ],
      },
      options: {
        responsive: true, // Hace que el gráfico sea responsive
        maintainAspectRatio: false,
        // Permite ajustar el tamaño del gráfico
        //indexAxis: "y", //cambiar de posicion el grafico
        scales: {
          x: {
            grid: {
              display: false,
              drawOnChartArea: false,
              drawBorder: false,
            },
            ticks: {
              display: false,
            },
          },
          y: {
            beginAtZero: true,
            grid: {
              display: false,
            },
            ticks: {
              display: false,
            },
          },
        },
        plugins: {
          tooltip: {
            enabled: true,
            external: null,
            position: "average",
          },
        },
      },
    });
  };
  ajax.send(data);
}

const generarColorAleatorio = () => {
  const r = Math.floor(Math.random() * 255);
  const g = Math.floor(Math.random() * 255);
  const b = Math.floor(Math.random() * 255);
  return `rgba(${r},${g},${b},0.85)`;
};
