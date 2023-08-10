//console.log("iniciando");

const generarColorAleatorio = () => {
  const r = Math.floor(Math.random() * 255);
  const g = Math.floor(Math.random() * 255);
  const b = Math.floor(Math.random() * 255);
  return `rgba(${r},${g},${b},0.85)`;
};

//traerTrabajosXArea();
//productosxterminar();

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
  //console.log("traerTrabajosxMes");
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
    //console.log(realizado);
    if (realizado == "") {
      //execute
      //console.log("vacio");
      mes.push(null);
      cantidad.push(null);
      document.getElementById("miCanvas").setAttribute("style", "display:none");
      document.getElementById("no-data").style.display = "block";
    } else {
      let respuesta = JSON.parse(realizado);
      //console.log(respuesta);
      for (let i = 0; i < respuesta.length; i++) {
        mes.push(respuesta[i].mes);
        cantidad.push(respuesta[i].cantidad);
        colores.push(generarColorAleatorio());
        //console.log(respuesta[i].mes + " " + respuesta[i].cantidad);
      }

      const ctx = document.getElementById("miCanvas");
      const myChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: mes,
          /* labels: [
              "Enero",
              "Febrero",
              "Marzo",
              "Abril",
              "Mayo",
              "Junio",
              "Julio",
            ], */
          datasets: [
            {
              label: "Trabajos",
              backgroundColor: colores,
              /*backgroundColor: [
                  generarColorAleatorio(),
                  generarColorAleatorio(),
                  generarColorAleatorio(),
                  generarColorAleatorio(),
                  generarColorAleatorio(),
                  generarColorAleatorio(),
                  generarColorAleatorio(),
                ] ,*/
              //backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle('--cui-info'), 10), //para line
              //borderColor: coreui.Utils.getStyle('--cui-info'),
              //pointHoverBackgroundColor: '#fff',
              //borderWidth: 2,
              //pointBackgroundColor: coreui.Utils.getStyle("--cui-primary"),
              /* data: cantidad, */
              data: cantidad,
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
              /* console.log("firstSet: " + firstSet);
                console.log("datasum: " + dataSum);

                if (dataSum === 0) {
                  console.log("se cumple ocultando");
                  document.getElementById("no-data").style.display = "block";
                  document.getElementById("miCanvas").style.display = "none";
                } */
            },
          },
        },
      });
      var firstSet = myChart.config.data.datasets[0].data;
      var ejex = myChart.config.data.labels;
      var dataSum = firstSet.reduce(
        (accumulator, currentValue) => accumulator + currentValue
      );
      var colrs = myChart.config.data.datasets[0].backgroundColor;
      var template = "";
      //console.log("firstset:" + firstSet);
      //console.log("datasum: " + dataSum);
      var foot = document.getElementById("Foot1-content");
      for (let index = 0; index < ejex.length; index++) {
        var perc = ((firstSet[index] / dataSum) * 100).toFixed(2);
        //console.log("("+ejex[index]+","+firstSet[index]+")=> "+perc+"% "+"c: "+colrs[index]+"");
        //console.log( `(${ejex[index]}, ${firstSet[index]})=> ${perc}% c: ${colrs[index]}`);
        template += `<div class="col mb-sm-2 mb-0">
          <div class="text-medium-emphasis"></div>
          <div class="fw-semibold">${ejex[index]}: ${firstSet[index]}  (${perc}%)</div>
          <div class="progress progress-thin mt-2">
            <div class="progress-bar" role="progressbar" style="width: ${perc}%; background-color:${colrs[index]}" aria-valuenow="${perc}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>`;
      }
      foot.innerHTML = template;
    }
  };
  ajax.send(data);
}

function traerTrabajosXArea() {
  //console.log("traerTrabajosXArea");
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/dashboardController.php", true);
  var data = new FormData();
  data.append("accion", "mostrarTrabajosArea");
  ajax.onload = function () {
    const colores = [];
    let area = [];
    let cantidad2 = [];
    realizado = ajax.responseText;
    if (realizado == "") {
      //execute
      //console.log("vacio");
      area.push(null);
      cantidad2.push(null);
      document.getElementById("miCanvas").setAttribute("style", "display:none");
      document.getElementById("no-data2").style.display = "block";
    } else {
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
      var firstSet = myChart2.config.data.datasets[0].data;
      var ejex = myChart2.config.data.labels;
      var dataSum = firstSet.reduce(
        (accumulator, currentValue) => accumulator + currentValue
      );
      var colrs = myChart2.config.data.datasets[0].backgroundColor;
      var template = "";
      //console.log("dataSum: "+dataSum);
      for (let index = 0; index < ejex.length; index++) {
        var perc = ((firstSet[index] / dataSum) * 100).toFixed(2);
        //console.log( `(${ejex[index]}, ${firstSet[index]})=> ${perc}% c: ${colrs[index]}`);
        template += `<div class="col mb-sm-2 mb-0">
          <div class="text-medium-emphasis"></div>
          <div class="fw-semibold">${ejex[index]}: ${firstSet[index]}  (${perc}%)</div>
          <div class="progress progress-thin mt-2">
            <div class="progress-bar" role="progressbar" style="width: ${perc}%; background-color:${colrs[index]}" aria-valuenow="${perc}" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>`;
      }
      var foot = document.getElementById("Foot2-content");
      foot.innerHTML = template;
      
      
    }

  };
  ajax.send(data);
}

function productosxterminar() {
  //console.log("productosxterminar()");
  const ajax = new XMLHttpRequest();
  ajax.open("POST", "../controller/dashboardController.php", true);
  var data = new FormData();
  data.append("accion", "productosporterminarse");
  ajax.onload = function () {
    let respuesta = ajax.responseText;
    //console.log(respuesta);
    const datos = JSON.parse(respuesta);
    var template = ""; // Estructura de la tabla html
    //console.log(datos);
    datos.forEach((element) => {
      let movStyle =
        element.movimiento === "SALIDA" ? "color: green;" : "color: red;";
      switch (element.movimiento) {
        case "SALIDA":
          movStyle = "color: red !important; font-weight: bold;";
          break;
        case "ENTRADA":
          movStyle = "color: green !important; font-weight: bold;";
          break;
        default:
          movStyle = "color: blue !important; font-weight: bold;";
          break;
      }
      // Establecer estilo según el estado
      template += `
      <tr class="align-middle">
        <td class="text-center">
          <div><span>${element.codigo}</span></div>
        </td>
        <td>
          <div style="font-weight:bold;">${element.nombre}</div>
          <div class="small text-medium-emphasis"><span>${element.tiempo}</span>Registrado: ${element.fecha_reg}</div>
        </td>
        <td>
        <div>${element.tipo}</div>
        </td>
        <td>
        <div>${element.presentacion}</div>
        </td>
        <td class="text-center">
          <div><span>${element.cantidad}</span></div>
        </td>

        <td>
          <div class="small text-medium-emphasis" style="${movStyle}">${element.movimiento}</div>
          <div class="fw-semibold">${element.fecha_mod}</div>
        </td>
        <td>
          <div class="dropdown">
            <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end">              
              <a class="dropdown-item" href="../view/productosView.php">Editar</a>
            </div>
          </div>
        </td>
      </tr>`;
    });
    var tablaprod = document.getElementById("productos_Terminar");
    tablaprod.innerHTML = template;
  };

  ajax.send(data);
}
