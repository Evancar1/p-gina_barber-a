<section class="section pricing has-bg-image has-before" id="pricing" aria-label="pricing" style="background-image: url('vistas/estilosA/assets/images/pricing-bg.jpg')">
  <div class="container">

    <h2 class="h2 section-title text-center">Precios y Planes</h2>

    <p class="section-text text-center">
      Tenemos los mejores planes y precios a tu disposición.
    </p>

    <div class="pricing-tab-container" id="Servicios">


      <ul class="tab-filter">
        <li>
          <a class="filter-btn" href="index.php?idS=todo#Servicios">
            <p class="btn-text">Todos los precios</p>
          </a>
        </li>
        <?php
        $item = null;
        $valor = null;

        $servicioPlanPrecio = ControladorServicio::ctrMostrarServicio($item, $valor);

        foreach ($servicioPlanPrecio as $key => $value) {
        ?>


          <li>
            <a class="filter-btn" href="index.php?idS=<?= $value['id_servicio'] ?>#Servicios" style="color: none;">
              <p class="btn-text"><?php echo $value["titulos"] ?></p>
            </a>
          </li>

        <?php
        }
        ?>
      </ul>


      <ul class="grid-list">
        <?php
        $item = null;
        $valor = null;

        $precioMain = ControladorPrecio::ctrMostrarPrecio($item, $valor);

        foreach ($precioMain as $key => $value) {
          if (isset($_GET["idS"])) {

            if ($_GET["idS"] == $value["id_servicio"]) {
        ?>
              <li data-filter="shaving">
                <div class="pricing-card">

                  <figure class="card-banner img-holder" style="--width: 50; --height: 50;">
                    <img src="<?php echo $value["imagen"] ?>" width="90" height="90" alt="Hair Cutting & Fitting">
                  </figure>

                  <div class="wrapper">
                    <h3 class="h3 card-title"><?php echo $value["titulop"] ?></h3>

                    <p class="card-text"><?php echo $value["descripcion"]; ?></p>
                  </div>

                  <data class="card-price"><?php echo $value["precio"] ?></data>

                </div>
              </li>

            <?php
            }

            if ($_GET["idS"] == "todo") {
            ?>
              <li data-filter="shaving">
                <div class="pricing-card">

                  <figure class="card-banner img-holder" style="--width: 50; --height: 50;">
                    <img src="<?php echo $value["imagen"] ?>" width="90" height="90" alt="Hair Cutting & Fitting">
                  </figure>

                  <div class="wrapper">
                    <h3 class="h3 card-title"><?php echo $value["titulop"] ?></h3>

                    <p class="card-text"><?php echo $value["descripcion"]; ?></p>
                  </div>

                  <data class="card-price"><?php echo $value["precio"] ?></data>

                </div>
              </li>

            <?php
            }
          } else {
            ?>
            <li data-filter="shaving">
              <div class="pricing-card">

                <figure class="card-banner img-holder" style="--width: 50; --height: 50;">
                  <img src="<?php echo $value["imagen"] ?>" width="90" height="90" alt="Hair Cutting & Fitting">
                </figure>

                <div class="wrapper">
                  <h3 class="h3 card-title"><?php echo $value["titulop"] ?></h3>

                  <p class="card-text"><?php echo $value["descripcion"]; ?></p>
                </div>

                <data class="card-price"><?php echo $value["precio"] ?></data>

              </div>
            </li>

        <?php
          }
        }
        ?>


      </ul>

    </div>

  </div>
</section>