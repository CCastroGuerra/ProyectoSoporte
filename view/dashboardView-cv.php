<?php
include('../templates/cabecera.php');
?>
<!-- Plugins and scripts required by this view-->
<script src="../vendors/chart.js/js/chart.min.js"></script>

<script src="../vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
<script src="../vendors/@coreui/utils/js/coreui-utils.js"></script>

<script src="../js/dashboard.js"></script>





<!-- contenido -->
<div class="body flex-grow-1 px-3">
  <div class="container-lg">

    <div class="row">
      <?php
      //Consultas para total de productos
      require_once("../config/conexion.php");
      $conectarObj = new Conectar(); // Crear una instancia de la clase Conectar
      $conectar = $conectarObj->Conexion();

      $consulta = "SELECT COUNT(id_productos) AS totalProductos
FROM productos WHERE `esActivo` = 1;";
      $consulta = $conectar->prepare($consulta);
      if ($consulta->execute()) {
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        $total_productos = $resultado['totalProductos'];
      } else {
        echo 'Error al ejecutar la consulta.';
      }

      //Consultas para total de Usuarios
      $consulta2 = "SELECT COUNT(*) totalUsuarios
from usuario
where `esActivo` = 1;";
      $consulta2 = $conectar->prepare($consulta2);
      if ($consulta2->execute()) {
        $resultado2 = $consulta2->fetch(PDO::FETCH_ASSOC);
        $total_usuarios = $resultado2['totalUsuarios'];
      } else {
        echo 'Error al ejecutar la consulta.';
      }

      //Consultas para total de trabajos
      $consulta3 = "SELECT COUNT(*) totalTrabajos
FROM trabajos";
      $consulta3 = $conectar->prepare($consulta3);
      if ($consulta3->execute()) {
        $resultado3 = $consulta3->fetch(PDO::FETCH_ASSOC);
        $total_trabajos = $resultado3['totalTrabajos'];
      } else {
        echo 'Error al ejecutar la consulta.';
      }

      //Consultas para total de bajas
      $consulta4 = "SELECT COUNT(*) totalBajas
from bajas
WHERE `esActivo` = 1;";
      $consulta4 = $conectar->prepare($consulta4);
      if ($consulta4->execute()) {
        $resultado4 = $consulta4->fetch(PDO::FETCH_ASSOC);
        $total_bajas = $resultado4['totalBajas'];
      } else {
        echo 'Error al ejecutar la consulta.';
      }
      ?>

      <!-- Usuarios -->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div class="">
              <div class="fs-4 fw-semibold"><?php echo  $total_usuarios; ?>
                <div class="fs-6 fw-normal">Usuarios</div>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3">
            <!-- <canvas class="chart" id="card-chart1" height="70"></canvas> -->
            <div class="text-end">
              <img src="../img/user-interface.png" width="" height="" style="margin-left: 0px;width: 35%;" class="text-end">
            </div>
          </div>
        </div>
      </div>
      <!-- Usuarios -->

      <!-- Productos -->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div class="">
              <div class="fs-4 fw-semibold"><?php echo  $total_productos; ?>
                <div class="fs-6 fw-normal">Productos</div>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3">
            <!-- <canvas class="chart" id="card-chart1" height="70"></canvas> -->
            <div class="text-end">
              <img src="../img/box_full_products_14639.png" width="" height="" style="margin-left: 0px;width: 35%;" class="text-end">
            </div>
          </div>
        </div>
      </div>
      <!-- Productos -->

      <!-- Trabajos -->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div class="">
              <div class="fs-4 fw-semibold"><?php echo $total_trabajos; ?>
                <div class="fs-6 fw-normal">Trabajos</div>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3">
            <!-- <canvas class="chart" id="card-chart1" height="70"></canvas> -->
            <div class="text-end">
              <img src="../img/work-tools.png" width="" height="" style="margin-left: 0px;width: 35%;" class="text-end">
            </div>
          </div>
        </div>
      </div>
      <!-- Trabajos -->

      <!-- Bajas -->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div class="">
              <div class="fs-4 fw-semibold"><?php echo $total_bajas; ?>
                <div class="fs-6 fw-normal">Bajas</div>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
              </div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3">
            <!-- <canvas class="chart" id="card-chart1" height="70"></canvas> -->
            <div class="text-end">
              <img src="../img/icons8-reciclar-64(1).png" width="" height="" style="margin-left: 0px;width: 35%;" class="text-end">
            </div>
          </div>
        </div>
      </div>
      <!-- Bajas -->
    </div>
    <!-- /row -->

    <!-- primer grafico -->
    <div class="card mb-4">
      <div class="card-body">
        <!-- encabezado -->
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">Trabajos</h4>
            <div class="small text-medium-emphasis">Por mes</div>
          </div>

        </div>
        <!-- /encabezado -->
        <!-- grafico -->
        <div class="c-chart-wrapper row justify-content-center align-items-center text-center" style="height:300px;margin-top:40px;">

          <canvas class="chart" id="miCanvas" height="300"></canvas>
          <script>
            traerTrabajosxMes();
          </script>
          <div id="no-data" style="display: none;position: absolute;  padding: 50px 0;text-align: center;font-size: 3rem;top: 30%;  width: 100%;">No hay datos</div>
        </div>
        <!-- /grafico -->
      </div>
      <div class="card-footer" id="Foot1">
        <div class="row row-cols-1 row-cols-md-5 text-center" id="Foot1-content">

        </div>
      </div>
    </div>
    <!-- /primer grafico -->

    <!-- segundo grafico -->
    <div class="card mb-4">
      <div class="card-body">
        <!-- encabezado -->
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">Trabajos</h4>
            <div class="small text-medium-emphasis">Por Area</div>
          </div>

        </div>
        <!-- /encabezado -->
        <!-- grafico -->
        <div class="c-chart-wrapper row justify-content-center align-items-center text-center" style="height:300px;margin-top:40px;">
          <canvas class="chart" id="miCanvas2" height="300"></canvas>
          <div id="no-data2" style="display: none;position: absolute;  padding: 50px 0;text-align: center;font-size: 3rem;top: 30%;  width: 100%;">No hay datos</div>
        </div>
        <!-- /grafico -->
      </div>
      <div class="card-footer" id="Foot2">
        <div class="row row-cols-1 row-cols-md-5 text-center" id="Foot2-content">
          <div class="col mb-sm-2 mb-0">
            <div class="text-medium-emphasis">Visits</div>
            <div class="fw-semibold">29.703 Users (40%)</div>
            <div class="progress progress-thin mt-2">
              <div class="progress-bar bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col mb-sm-2 mb-0">
            <div class="text-medium-emphasis">Unique</div>
            <div class="fw-semibold">24.093 Users (20%)</div>
            <div class="progress progress-thin mt-2">
              <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col mb-sm-2 mb-0">
            <div class="text-medium-emphasis">Pageviews</div>
            <div class="fw-semibold">78.706 Views (60%)</div>
            <div class="progress progress-thin mt-2">
              <div class="progress-bar bg-warning" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col mb-sm-2 mb-0">
            <div class="text-medium-emphasis">New Users</div>
            <div class="fw-semibold">22.123 Users (80%)</div>
            <div class="progress progress-thin mt-2">
              <div class="progress-bar bg-danger" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
          <div class="col mb-sm-2 mb-0">
            <div class="text-medium-emphasis">Bounce Rate</div>
            <div class="fw-semibold">40.15%</div>
            <div class="progress progress-thin mt-2">
              <div class="progress-bar" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /segundo grafico -->

    <!-- /.row-->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">Productos</div>
          <div class="card-body">

            <!-- /.row-->
            <div class="table-responsive" style="height:400px;">
              <table class="table table-hover border mb-0">
                <thead class="table-dark fw-semibold" style="position:sticky;top:0;">
                  <tr class="align-middle">
                    <th class="text-center">
                      <svg class="icon">
                        <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-list-numbered"></use>
                      </svg>
                    </th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Unidad</th>
                    <th class="text-center">Cantidad</th>
                    <th>Actividad</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id="productos_Terminar">
                  <tr class="align-middle">
                    <td class="text-center">
                      <div><span>[E0000001]</span></div>
                    </td>
                    <td>
                      <div>[nombre]</div>
                      <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td>[Tipo]</td>
                    <td>[Unidad]</td>
                    <td class="text-center">
                      <div><span>[10]</span></div>
                    </td>

                    <td>
                      <div class="small text-medium-emphasis">[movimiento]</div>
                      <div class="fw-semibold">10 sec ago</div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#">Info</a>
                          <a class="dropdown-item" href="#">Edit</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->


  </div>
</div>
<!-- /contenido -->



<?php
include '../templates/footer.php';
?>

<!-- <script>
  Chart.defaults.pointHitDetectionRadius = 1;
  Chart.defaults.plugins.tooltip.enabled = false;
  Chart.defaults.plugins.tooltip.mode = 'index';
  Chart.defaults.plugins.tooltip.position = 'nearest';
  Chart.defaults.plugins.tooltip.external = coreui.ChartJS.customTooltips;
  Chart.defaults.defaultFontColor = '#646470';
  const random = (min, max) =>
    // eslint-disable-next-line no-mixed-operators
    Math.floor(Math.random() * (max - min + 1) + min);

  function traerTrabajosxMes() {
    const ajax = new XMLHttpRequest();
    // Se establece la dirección del archivo php que procesará la petición
    ajax.open("POST", "../controller/dashboardController.php", true);
    var data = new FormData();
    data.append("accion", "mostrarDatos");
    ajax.onload = function() {
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

      const myChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: mes,
          /* labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'], */
          datasets: [{
            label: "Trabajos",
            backgroundColor: colores,
            /* borderColor: coreui.Utils.getStyle('--cui-info'),
            borderWidth: 2, */
            data: cantidad,
            /* data: [random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200)], */
            fill: false,
          }, ],
        },
        options: {
          responsive: true, // Hace que el gráfico sea responsive
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            },
            tooltip: {
              enabled: true,
              external: null,
              position: 'average'

            }
          },
          // Permite ajustar el tamaño del gráfico
          //indexAxis: "y", //cambiar de posicion el grafico
          scales: {
            x: {
              grid: {
                drawOnChartArea: false,

              }
            },
            y: {
              ticks: {
                beginAtZero: true,
                maxTicksLimit: 5,
                stepSize: Math.ceil(250 / 5),
                max: 100,
              }
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
              hoverBorderWidth: 3
            }

          }
        },
      });
    };
    ajax.send(data);
  };

  function traerTrabajosXArea() {
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "../controller/dashboardController.php", true);
    var data = new FormData();
    data.append("accion", "mostrarTrabajosArea");
    ajax.onload = function() {
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
      let colors = ['#44FF07', '#FED60A', '#FB0007', '#3700FF', '#FB13F3'];
      const myChart2 = new Chart(canva, {
        type: "pie",
        data: {
          labels: area,
          datasets: [{
            label: "",
            data: cantidad2,
            backgroundColor: colores,
            /* borderColor: ["rgba(1,5,22,1)"],
            borderWidth: 2, */
          }, ],
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
                drawBorder: false
              },
              ticks: {
                display: false
              }
            },
            y: {
              beginAtZero: true,
              grid: {
                display: false
              },
              ticks: {
                display: false
              }
            },
          },
          plugins: {
            tooltip: {
              enabled: true,
              external: null,
              position: 'average'

            }
          },
        },
      });
    };
    ajax.send(data);
  };

  const generarColorAleatorio = () => {
    const r = Math.floor(Math.random() * 255);
    const g = Math.floor(Math.random() * 255);
    const b = Math.floor(Math.random() * 255);
    return `rgba(${r},${g},${b},0.85)`;
  };
  traerTrabajosxMes();
  traerTrabajosXArea();
</script> -->