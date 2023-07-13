<?php
include('../templates/cabecera.php');
?>


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
FROM trabajos
WHERE es_activo = 1;";
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

    <!-- row -->
    <div class="row">

      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                  <svg class="icon">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                  </svg>)</span></div>
              <div>Users</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <canvas class="chart" id="card-chart1" height="70"></canvas>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                  <svg class="icon">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                  </svg>)</span></div>
              <div>Income</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <canvas class="chart" id="card-chart2" height="70"></canvas>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                  <svg class="icon">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                  </svg>)</span></div>
              <div>Conversion Rate</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3" style="height:70px;">
            <canvas class="chart" id="card-chart3" height="70"></canvas>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                  <svg class="icon">
                    <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                  </svg>)</span></div>
              <div>Sessions</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg class="icon">
                  <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                </svg>
              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <canvas class="chart" id="card-chart4" height="70"></canvas>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->

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
        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">

          <canvas class="chart" id="miCanvas" height="300"></canvas>
        </div>
        <!-- /grafico -->
      </div>
      <div class="card-footer">
        <div class="row row-cols-1 row-cols-md-5 text-center">
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
    <!-- /primer grafico -->

    <!-- primer grafico -->
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
        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">

          <canvas class="chart" id="miCanvas2" height="300"></canvas>
        </div>
        <!-- /grafico -->
      </div>
      <div class="card-footer">
        <div class="row row-cols-1 row-cols-md-5 text-center">
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
    <!-- /primer grafico -->

    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">Traffic</h4>
            <div class="small text-medium-emphasis">January - July 2022</div>
          </div>
          <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
            <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
              <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">
              <label class="btn btn-outline-secondary"> Day</label>
              <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked="">
              <label class="btn btn-outline-secondary active"> Month</label>
              <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">
              <label class="btn btn-outline-secondary"> Year</label>
            </div>
            <button class="btn btn-primary" type="button">
              <svg class="icon">
                <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
              </svg>
            </button>
          </div>
        </div>
        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
          <canvas class="chart" id="main-chart" height="300"></canvas>
        </div>
      </div>
      <div class="card-footer">
        <div class="row row-cols-1 row-cols-md-5 text-center">
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
    <!-- /.card.mb-4-->
    <div class="row">
      <div class="col-sm-6 col-lg-4">
        <div class="card mb-4" style="--cui-card-cap-bg: #3b5998">
          <div class="card-header position-relative d-flex justify-content-center align-items-center">
            <svg class="icon icon-3xl text-white my-4">
              <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
            </svg>
            <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
              <canvas id="social-box-chart-1" height="90"></canvas>
            </div>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="fs-5 fw-semibold">89k</div>
              <div class="text-uppercase text-medium-emphasis small">friends</div>
            </div>
            <div class="vr"></div>
            <div class="col">
              <div class="fs-5 fw-semibold">459</div>
              <div class="text-uppercase text-medium-emphasis small">feeds</div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-4">
        <div class="card mb-4" style="--cui-card-cap-bg: #00aced">
          <div class="card-header position-relative d-flex justify-content-center align-items-center">
            <svg class="icon icon-3xl text-white my-4">
              <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-twitter"></use>
            </svg>
            <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
              <canvas id="social-box-chart-2" height="90"></canvas>
            </div>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="fs-5 fw-semibold">973k</div>
              <div class="text-uppercase text-medium-emphasis small">followers</div>
            </div>
            <div class="vr"></div>
            <div class="col">
              <div class="fs-5 fw-semibold">1.792</div>
              <div class="text-uppercase text-medium-emphasis small">tweets</div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-4">
        <div class="card mb-4" style="--cui-card-cap-bg: #4875b4">
          <div class="card-header position-relative d-flex justify-content-center align-items-center">
            <svg class="icon icon-3xl text-white my-4">
              <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-linkedin"></use>
            </svg>
            <div class="chart-wrapper position-absolute top-0 start-0 w-100 h-100">
              <canvas id="social-box-chart-3" height="90"></canvas>
            </div>
          </div>
          <div class="card-body row text-center">
            <div class="col">
              <div class="fs-5 fw-semibold">500+</div>
              <div class="text-uppercase text-medium-emphasis small">contacts</div>
            </div>
            <div class="vr"></div>
            <div class="col">
              <div class="fs-5 fw-semibold">292</div>
              <div class="text-uppercase text-medium-emphasis small">feeds</div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-header">Traffic &amp; Sales</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-6">
                    <div class="border-start border-start-4 border-start-info px-3 mb-3"><small class="text-medium-emphasis">New Clients</small>
                      <div class="fs-5 fw-semibold">9.123</div>
                    </div>
                  </div>
                  <!-- /.col-->
                  <div class="col-6">
                    <div class="border-start border-start-4 border-start-danger px-3 mb-3"><small class="text-medium-emphasis">Recuring Clients</small>
                      <div class="fs-5 fw-semibold">22.643</div>
                    </div>
                  </div>
                  <!-- /.col-->
                </div>
                <!-- /.row-->
                <hr class="mt-0">
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Monday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 34%" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 78%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Tuesday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 94%" aria-valuenow="94" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Wednesday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 12%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 67%" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Thursday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 91%" aria-valuenow="91" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Friday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 73%" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Saturday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 82%" aria-valuenow="82" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-4">
                  <div class="progress-group-prepend"><span class="text-medium-emphasis small">Sunday</span></div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-info" role="progressbar" style="width: 9%" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-danger" role="progressbar" style="width: 69%" aria-valuenow="69" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-6">
                <div class="row">
                  <div class="col-6">
                    <div class="border-start border-start-4 border-start-warning px-3 mb-3"><small class="text-medium-emphasis">Pageviews</small>
                      <div class="fs-5 fw-semibold">78.623</div>
                    </div>
                  </div>
                  <!-- /.col-->
                  <div class="col-6">
                    <div class="border-start border-start-4 border-start-success px-3 mb-3"><small class="text-medium-emphasis">Organic</small>
                      <div class="fs-5 fw-semibold">49.123</div>
                    </div>
                  </div>
                  <!-- /.col-->
                </div>
                <!-- /.row-->
                <hr class="mt-0">
                <div class="progress-group">
                  <div class="progress-group-header">
                    <svg class="icon icon-lg me-2">
                      <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                    </svg>
                    <div>Male</div>
                    <div class="ms-auto fw-semibold">43%</div>
                  </div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group mb-5">
                  <div class="progress-group-header">
                    <svg class="icon icon-lg me-2">
                      <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-user-female"></use>
                    </svg>
                    <div>Female</div>
                    <div class="ms-auto fw-semibold">37%</div>
                  </div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-warning" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group">
                  <div class="progress-group-header">
                    <svg class="icon icon-lg me-2">
                      <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-google"></use>
                    </svg>
                    <div>Organic Search</div>
                    <div class="ms-auto fw-semibold me-2">191.235</div>
                    <div class="text-medium-emphasis small">(56%)</div>
                  </div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 56%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group">
                  <div class="progress-group-header">
                    <svg class="icon icon-lg me-2">
                      <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-facebook-f"></use>
                    </svg>
                    <div>Facebook</div>
                    <div class="ms-auto fw-semibold me-2">51.223</div>
                    <div class="text-medium-emphasis small">(15%)</div>
                  </div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group">
                  <div class="progress-group-header">
                    <svg class="icon icon-lg me-2">
                      <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-twitter"></use>
                    </svg>
                    <div>Twitter</div>
                    <div class="ms-auto fw-semibold me-2">37.564</div>
                    <div class="text-medium-emphasis small">(11%)</div>
                  </div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 11%" aria-valuenow="11" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
                <div class="progress-group">
                  <div class="progress-group-header">
                    <svg class="icon icon-lg me-2">
                      <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-linkedin"></use>
                    </svg>
                    <div>LinkedIn</div>
                    <div class="ms-auto fw-semibold me-2">27.319</div>
                    <div class="text-medium-emphasis small">(8%)</div>
                  </div>
                  <div class="progress-group-bars">
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 8%" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row--><br>
            <div class="table-responsive">
              <table class="table table-hover border mb-0">
                <thead class="table-light fw-semibold">
                  <tr class="align-middle">
                    <th class="text-center">
                      <svg class="icon">
                        <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                      </svg>
                    </th>
                    <th>User</th>
                    <th class="text-center">Country</th>
                    <th>Usage</th>
                    <th class="text-center">Payment Method</th>
                    <th>Activity</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td>
                      <div>Yiorgos Avraamu</div>
                      <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/flag.svg#cif-us"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="float-start">
                          <div class="fw-semibold">50%</div>
                        </div>
                        <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="small text-medium-emphasis">Last login</div>
                      <div class="fw-semibold">10 sec ago</div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/2.jpg" alt="user@email.com"><span class="avatar-status bg-danger"></span></div>
                    </td>
                    <td>
                      <div>Avram Tarasios</div>
                      <div class="small text-medium-emphasis"><span>Recurring</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/flag.svg#cif-br"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="float-start">
                          <div class="fw-semibold">10%</div>
                        </div>
                        <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-cc-visa"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="small text-medium-emphasis">Last login</div>
                      <div class="fw-semibold">5 minutes ago</div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/3.jpg" alt="user@email.com"><span class="avatar-status bg-warning"></span></div>
                    </td>
                    <td>
                      <div>Quintin Ed</div>
                      <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/flag.svg#cif-in"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="float-start">
                          <div class="fw-semibold">74%</div>
                        </div>
                        <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 74%" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-cc-stripe"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="small text-medium-emphasis">Last login</div>
                      <div class="fw-semibold">1 hour ago</div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/4.jpg" alt="user@email.com"><span class="avatar-status bg-secondary"></span></div>
                    </td>
                    <td>
                      <div>Enéas Kwadwo</div>
                      <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/flag.svg#cif-fr"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="float-start">
                          <div class="fw-semibold">98%</div>
                        </div>
                        <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 98%" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-cc-paypal"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="small text-medium-emphasis">Last login</div>
                      <div class="fw-semibold">Last month</div>
                    </td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/5.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                    </td>
                    <td>
                      <div>Agapetus Tadeáš</div>
                      <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/flag.svg#cif-es"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="float-start">
                          <div class="fw-semibold">22%</div>
                        </div>
                        <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 22%" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-cc-apple-pay"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="small text-medium-emphasis">Last login</div>
                      <div class="fw-semibold">Last week</div>
                    </td>
                    <td>
                      <div class="dropdown dropup">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                      </div>
                    </td>
                  </tr>
                  <tr class="align-middle">
                    <td class="text-center">
                      <div class="avatar avatar-md"><img class="avatar-img" src="../assets/img/avatars/6.jpg" alt="user@email.com"><span class="avatar-status bg-danger"></span></div>
                    </td>
                    <td>
                      <div>Friderik Dávid</div>
                      <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/flag.svg#cif-pl"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="clearfix">
                        <div class="float-start">
                          <div class="fw-semibold">43%</div>
                        </div>
                        <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                      </div>
                      <div class="progress progress-thin">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 43%" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </td>
                    <td class="text-center">
                      <svg class="icon icon-xl">
                        <use xlink:href="../vendors/@coreui/icons/svg/brand.svg#cib-cc-amex"></use>
                      </svg>
                    </td>
                    <td>
                      <div class="small text-medium-emphasis">Last login</div>
                      <div class="fw-semibold">Yesterday</div>
                    </td>
                    <td>
                      <div class="dropdown dropup">
                        <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <svg class="icon">
                            <use xlink:href="../vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                          </svg>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
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

<!-- Plugins and scripts required by this view-->
<script src="../vendors/chart.js/js/chart.min.js"></script>
<script src="../vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
<script src="../vendors/@coreui/utils/js/coreui-utils.js"></script>

<script src="../js/main.js"></script>
<script>
  // Disable the on-canvas tooltip
Chart.defaults.pointHitDetectionRadius = 1;
Chart.defaults.plugins.tooltip.enabled = false;
Chart.defaults.plugins.tooltip.mode = 'index';
Chart.defaults.plugins.tooltip.position = 'nearest';
Chart.defaults.plugins.tooltip.external = coreui.ChartJS.customTooltips;
Chart.defaults.defaultFontColor = '#646470';
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
        type: "line",
        data: {
          /* labels: mes, */
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
          datasets: [{
            label: "Trabajos",
            backgroundColor: coreui.Utils.hexToRgba(coreui.Utils.getStyle('--cui-info'), 10),
            borderColor: coreui.Utils.getStyle('--cui-info'),
            borderWidth: 2,
            /* data: cantidad, */
            data: [random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200), random(50, 200)],
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
              enabled:true,
              external:null,
              position:'average'

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
    let colors=['#44FF07','#FED60A','#FB0007','#3700FF','#FB13F3'];
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
          x:{
            grid:{
              display:false,
              drawOnChartArea: false,
              drawBorder:false
            },
            ticks:{
              display:false
            }
          },
          y: {
            beginAtZero: true,
            grid:{
              display:false
            },
            ticks:{
              display:false
            }
          },
        },
        plugins: {
          tooltip: {
              enabled:true,
              external:null,
              position:'average'

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
</script>