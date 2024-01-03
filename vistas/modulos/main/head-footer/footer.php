  <!-- 
    - #FOOTER
  -->

  <footer class="footer has-bg-image" style="background-image: url('vistas/estilosA/assets/images/footer-bg.png')">
    <div class="container">

      <div class="footer-top">

        <div class="footer-brand">

          <?php
          $item = null;
          $valor = null;
          $Logo = ControladorEmpresa::ctrMostrarEmpresa($item, $valor);
          foreach ($Logo as $key => $value) {
          ?>
            <a href="#" class="logo">
              <?php echo $value["nombre"] ?>
              <span class="span">Hair Salon</span>
            </a>
          <?php
          }
          ?>

          <form  class="input-wrapper" method="post">

            <input type="email" name="nuevoCorreoS" placeholder="Ingrese su correo" required class="email-field">

            <button type="submit" class="btn has-before">
              <span class="span">Suscríbase ahora</span>

              <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </button>
            <?php
            $nuevoSuscriptor = new ControladorSuscriptor();
            $nuevoSuscriptor->ctrCrearSuscriptor();
            ?>
          </form>

        </div>

        <div class="footer-link-box text-center">

          <ul class="footer-list">

            <li>
              <p class="footer-list-title">Enlaces</p>
            </li>

            <li>
              <a href="#services" class="footer-link has-before">Servicios</a>
            </li>

            <li>
              <a href="#pricing" class="footer-link has-before">Precios</a>
            </li>

            <li>
              <a href="#gallery" class="footer-link has-before">Galería</a>
            </li>

            <li>
              <a href="#contacto" class="footer-link has-before">Contacto</a>
            </li>

            <li>
              <a href="#reservar" class="footer-link has-before">Reservar</a>
            </li>

          </ul>

          <ul class="footer-list">

            <li>
              <p class="footer-list-title">Services</p>
            </li>
            <?php
            $item = null;
            $valor = null;

            $servicios = ControladorServicio::ctrMostrarServicio($item, $valor);
            foreach ($servicios as $key => $value) {
            ?>
              <li>
                <a href="#" class="footer-link has-before"><?php echo $value["titulos"] ?></a>
              </li>

            <?php
            }
            ?>
          </ul>


          <ul class="footer-list">
            <?php
            foreach ($Logo as $key => $value) {
            ?>
              <li>
                <p class="footer-list-title">Contact Us</p>
              </li>

              <li class="footer-list-item">
                <ion-icon name="location-outline" aria-hidden="true"></ion-icon>

                <address class="contact-link">
                  <?php echo $value["direccion"] ?>
                </address>
              </li>

              <li class="footer-list-item">
                <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

                <a href="tel:+0123456789" class="contact-link"><?php echo $value["telefono"] ?></a>
              </li>

              <li class="footer-list-item">
                <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                <span class="contact-link"><?php echo $value["horario"] ?></span>
              </li>

              <li class="footer-list-item">
                <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>

                <a href="https://mail.google.com/" class="contact-link" target="_blank"><?php echo $value["correo"] ?></a>
              </li>
            <?php
            }
            ?>


          </ul>

        </div>

      </div>

      <div class="footer-bottom">
        <p class="copyright">
          <?php
          foreach ($Logo as $key => $value) {
          ?>
            &copy; 2023 <a href="#" class="copyright-link"><?php echo $value["nombre"] ?></a>. Todos los derechos reservados.
          <?php
          }
          ?>
        </p>
      </div>

    </div>
  </footer>


  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>



  <!-- 
    - custom js link
  -->
  <script src="vistas/estilosA/assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="vistas/estilosA/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vistas/estilosA/jquery/jquery.min.js"></script>
  <script src="vistas/js/main/login.js"></script>