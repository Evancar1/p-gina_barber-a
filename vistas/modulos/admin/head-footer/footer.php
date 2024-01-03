  <!-- Right bar overlay-->
  <div class="rightbar-overlay"></div>

  <!-- JAVASCRIPT -->
  <script src="vistas/estilosB/assets/libs/jquery/jquery.min.js"></script>
  <script src="vistas/estilosB/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vistas/estilosB/assets/libs/metismenu/metisMenu.min.js"></script>
  <script src="vistas/estilosB/assets/libs/simplebar/simplebar.min.js"></script>
  <script src="vistas/estilosB/assets/libs/node-waves/waves.min.js"></script>
  <script src="vistas/estilosB/assets/libs/feather-icons/feather.min.js"></script>
  <!-- pace js -->
  <script src="vistas/estilosB/assets/libs/pace-js/pace.min.js"></script>

  <!--   Alerta -->


  <!-- Required datatable js -->
  <script src="vistas/estilosB/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/estilosB/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
  <!-- Buttons examples -->
  <script src="vistas/estilosB/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="vistas/estilosB/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
  <script src="vistas/estilosB/assets/libs/jszip/jszip.min.js"></script>
  <script src="vistas/estilosB/assets/libs/pdfmake/build/pdfmake.min.js"></script>
  <script src="vistas/estilosB/assets/libs/pdfmake/build/vfs_fonts.js"></script>
  <script src="vistas/estilosB/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="vistas/estilosB/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="vistas/estilosB/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

  <!-- Responsive examples -->
  <script src="vistas/estilosB/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="vistas/estilosB/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

  <!-- Datatable init js -->
  <script src="vistas/estilosB/assets/js/pages/datatables.init.js"></script>

  <script src="vistas/estilosB/chart.js/Chart.min.js"></script>

  <!-- Plugins js-->
  <script src="vistas/estilosB/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="vistas/estilosB/assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
  <!-- dashboard init -->
  <script src="vistas/estilosB/assets/js/pages/dashboard.init.js"></script>

  <script src="vistas/estilosB/assets/js/app.js"></script>



  <?php


  if (isset($_GET["fechaInicial"])) {
    $fechaInicial = $_GET["fechaInicial"];
    $fechaFinal = $_GET["fechaFinal"];
  } else {
    $fechaInicial = null;
    $fechaFinal = null;
  }

  $respuesta = ControladorVisitas::ctrRangoFechasVisitas($fechaInicial, $fechaFinal);

  $arrayFechas = array();
  $arrayVisitas = array();
  $sumaVisitas = array();

  foreach ($respuesta as $key => $value) {
    #Capturamos solo el año y el mes
    $fecha = substr($value["fecha_visitas"], 0, 7);

    #Introducir las fechas en arrayFechas
    array_push($arrayFechas, $fecha);

    #capturamos las visitas
    $arrayVisitas = array($fecha => $value["total_visitas"]);

    #Sumamos las vistas que ocurrieron el mismo mes

    foreach ($arrayVisitas as $key => $value) {
      $sumaVisitas[$key] += $value;
    }
  }
  $noRepetirFechas = array_unique($arrayFechas);
  sort($noRepetirFechas);
  ?>
<script>
  /* global Chart:false */

  $(function() {
    "use strict";

    var ticksStyle = {
      fontColor: "#495057",
      fontStyle: "bold",
    };

    var mode = "index";
    var intersect = true;
    var $salesChart = $("#sales-chart");
    // eslint-disable-next-line no-unused-vars
    <?php
    if ($noRepetirFechas != null) {
    ?>
    var salesChart = new Chart($salesChart, {
      type: "bar",
      data: {
        labels: [<?php
              foreach($noRepetirFechas as $key){
                echo '"'.$key.'"'.',';
            }
          ?>],
        datasets: [{
            backgroundColor: "#007bff",
            borderColor: "#007bff",
            data: [<?php
            foreach($noRepetirFechas as $key){
              echo $sumaVisitas[$key].',';
            }
            ?>],
          },
          {
            backgroundColor: "#ced4da",
            borderColor: "#ced4da",
            data: [
              0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
              0,
            ],
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect,
        },
        hover: {
          mode: mode,
          intersect: intersect,
        },
        legend: {
          display: false,
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: "4px",
              color: "rgba(0, 0, 0, .2)",
              zeroLineColor: "transparent",
            },
            ticks: $.extend({
                beginAtZero: true,

                // Include a dollar sign in the ticks
                callback: function(value) {
                  if (value >= 1000) {
                    value /= 1000;
                    value += "k";
                  }

                  return " " + value;
                },
              },
              ticksStyle
            ),
          }, ],
          xAxes: [{
            display: true,
            gridLines: {
              display: false,
            },
            ticks: ticksStyle,
          }, ],
        },
      },
    });
    <?php
    }
    ?>


  });
</script>




  <!--   ===========================
  SCRIPTS DE TABLAS
  =========================== -->

  <script src="vistas/js/admin/script-user.js"></script>
  <script src="vistas/js/admin/empresa.js"></script>
  <script src="vistas/js/admin/script-seo.js"></script>
  <script src="vistas/js/admin/servicio.js"></script>
  <script src="vistas/js/admin/jprecio.js"></script>
  <script src="vistas/js/admin/script-galeria.js"></script>
  <script src="vistas/js/admin/reserva.js"></script>
  <script src="vistas/js/admin/suscriptor.js"></script>


  </body>


  <!-- Mirrored from themesbrand.com/minia/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Feb 2023 22:08:04 GMT -->

  </html>