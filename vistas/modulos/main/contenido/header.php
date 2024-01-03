<header class="header">

  <?php
  $item = null;
  $valor = null;

  $empresa = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
  foreach($empresa as $key => $value){
  ?>
  <div class="header-top">
    <div class="container">

      <ul class="header-top-list">

        <li class="header-top-item">
          <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

          <p class="item-title">LLámenos :</p>

          <a href="#" class="item-link"><?php echo $value["telefono"] ?></a>
        </li>

        <li class="header-top-item">
          <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

          <p class="item-title">Horario de atención:</p>

          <p class="item-text"><?php echo $value["horario"] ?></p>
        </li>

        <li>
          <ul class="social-list">

            <li>
              <a href="<?php echo $value["link_facebook"] ?>" class="social-link" target="_blank">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>
            <li>
              <a href="<?php echo $value["link_youtube"] ?>" class="social-link" target="_blank">
                <ion-icon name="logo-youtube"></ion-icon>
              </a>
            </li>
          </ul>
        </li>

      </ul>

    </div>
  </div>
    <?php
     }
    ?>
  <div class="header-bottom" data-header>
    <div class="container">

      <?php
      $item = null;
      $valor = null;

      $Logo = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
      foreach ($Logo as $key => $value) {
      ?>
        <a href="#" class="logo">
          <?php echo $value["nombre"] ?>
        </a>
      <?php
      }
      ?>

      <nav class="navbar container" data-navbar>
        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-nav-link>Inicio</a>
          </li>

          <li class="navbar-item">
            <a href="#services" class="navbar-link" data-nav-link>Servicios</a>
          </li>

          <li class="navbar-item">
            <a href="#pricing" class="navbar-link" data-nav-link>Precio</a>
          </li>

          <li class="navbar-item">
            <a href="#gallery" class="navbar-link" data-nav-link>Galería</a>
          </li>

          <li class="navbar-item">
            <a href="#reservar" class="navbar-link" data-nav-link>Reservar</a>
          </li>
          <li class="navbar-item">
            <a href="#" class="navbar-link" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" data-nav-link>Login</a>
          </li>

        </ul>
      </nav>

      <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true"></ion-icon>
      </button>

      <a href="#reservar" class="btn has-before">
        <span class="span">Reservar</span>

        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
      </a>

    </div>
  </div>

</header>