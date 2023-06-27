<?php
include('../templates/cabecera.php');
?>
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

<!-- contenido -->
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold"><?php echo  $total_usuarios; ?></div>
              <div>Usuarios</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <img src="../img/user-interface.png" alt="">
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class=" col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-info">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold"><?php echo  $total_productos; ?></div>
              <div>Productos</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <img src="../img/box_full_products_14639.png" alt="">
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-warning">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold"><?php echo $total_trabajos; ?></div>
              <div>Trabajos</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3" style="height:70px;">
            <!-- LOGO DE TRABAJOS -->
            <img src="../img//work-tools.png" alt="">
          </div>
        </div>
      </div>
      <!-- /.col-->
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-danger">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold"><?php echo $total_bajas; ?></div>
              <div>Bajas</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

              </button>
              <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
            <img src="../img/icons8-reciclar-64(1).png" alt="imagen de bajas">
          </div>
        </div>
      </div>
      <!-- /.col-->
    </div>
    <!-- /.row-->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h3 class="card-title mb-0" style="color: black;">Estadísticas de trabajos </h3>
            <div class="small text-medium-emphasis">Trabajos por mes</div>
          </div>

        </div>
        <div class="c-chart-wrapper" style="height:400px;">
          <canvas id="miCanvas"></canvas>
        </div>
      </div>
    </div>

    <!-- card propia -->
    <!-- <div class="card mt-4">
      <div class="card-body">
        <section class="content">
          <h1>Gráficos</h1>
          <canvas id="miCanvas"></canvas>
        </section>
      </div>
    </div> -->

    <!-- /.card.mb-4-->

    <!-- <div class=" row">
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
    <!-- <div class="col-sm-6 col-lg-4">
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
      </div> -->
    <!-- /.col-->
    <!-- <div class="col-sm-6 col-lg-4">
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
      </div> -->
    <!-- /.col-->
    <!-- </div> -->
  </div>
</div>
<!-- /contenido -->


<!-- Prueba estilos -->
<style>
  .card-title,
  p {
    color: white;
    font-weight: bold;
  }

  div img {
    width: 70px;
    margin-left: 135px;
    margin-top: -10px;

  }

  .cajaPrueba {
    height: 162px;
    width: 250px;
    background-color: blue;
  }
</style>
<!-- Fin de prueba -->
<!-- <div class="container mt-5">
  <div class="row">
    <div class="col-md-8">
      <div class="card cajaPrueba">
        <div class="card-body">
          <h5 class="card-title"><?php echo $total_productos; ?></h5>
          <p class="card-text">Productos</p>
          <div>
            <img src="../img/box_full_products_14639.png" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">

    </div>
  </div>
</div> -->
<!-- <div class="row">
  <div class="col-lg-12 col-md-12">
  </div>
</div> -->






<?php
include '../templates/footer.php';
?>

<!-- Plugins and scripts required by this view-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.0/chart.min.js" integrity="sha512-mlz/Fs1VtBou2TrUkGzX4VoGvybkD9nkeXWJm3rle0DPHssYYx4j+8kIS15T78ttGfmOjH0lLaBXGcShaVkdkg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../vendors/chart.js/js/chart.min.js"></script>
<script src="../vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
<script src="../vendors/@coreui/utils/js/coreui-utils.js"></script>

<script src="../js/main.js"></script>
<script src="../js/dashboard.js"></script>