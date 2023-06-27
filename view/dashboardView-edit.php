<?php
include('../templates/cabecera.php');
?>


<!-- contenido -->
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card mb-4 text-white bg-primary">
          <div class="card-body pb-0 d-flex justify-content-between align-items-start">
            <div>
              <div class="fs-4 fw-semibold">26K</div>
              <div>Usuarios</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
              <div class="fs-4 fw-semibold">$6.200 </div>
              <div>Productos</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
              <div class="fs-4 fw-semibold">2.49% </div>
              <div>Trabajos Realizados</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
              <div class="fs-4 fw-semibold">44K </div>
              <div>Bajas</div>
            </div>
            <div class="dropdown">
              <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">Traffic</h4>
            <div class="small text-medium-emphasis">January - July 2022</div>
          </div>

        </div>
        <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
          <canvas class="chart" id="main-chart" height="300"></canvas>
        </div>
      </div>

    </div>
    <!-- /.card.mb-4-->

    <!-- <div class="row">
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


    <!-- /.row-->
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">

        </div>
      </div>
      <!-- /.col-->
    </div>

    <!-- /.row-->
  </div>
</div>
<!-- /contenido -->

<section class="content">
  <h1>Graficos</h1>
  <canvas id="miCanvas" height="300" width="300"></canvas>
</section>

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