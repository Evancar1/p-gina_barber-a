<section class="section appoin" id="reservar" aria-label="appointment">
    <div class="container">

        <div class="appoin-card">

            <figure class="card-banner img-holder" style="--width: 250; --height: 774;">
                <img src="vistas/estilosA/assets/images/appoin-banner-1.jpg" width="250" height="774" loading="lazy" alt="" class="img-cover">
            </figure>

            <div class="card-content">

                <h2 class="h2 section-title">Reservar</h2>

                <p class="section-text">
                    Reserva su horario de atención
                </p>

                <form class="appoin-form" method="post">

                    <div class="input-wrapper">
                        <input type="text" name="nuevoNombreR" placeholder="Su nombre completo" required class="input-field">

                        <input type="email" name="nuevoCorreoR" placeholder="Correo electrónico" required class="input-field">
                    </div>

                    <div class="input-wrapper">
                        <input type="text" name="nuevoTelefonoR" placeholder="Teléfono" required class="input-field">

                        <select name="nuevoPrecioR" class="input-field form-select" style="font-size: 15px;">

                            <option value="">Selecciona el servicio</option>
                            <?php
                            $item = null;
                            $valor = null;
                            $precioSelect = ControladorPrecio::ctrMostrarPrecio($item, $valor);
                            foreach ($precioSelect as $key => $value) {
                                echo '<option value="' . $value["id_precio"] . '">' . $value["titulop"] . '</option>';
                            }
                            ?>

                        </select>
                    </div>

                    <input type="date" name="nuevoFechaR" required class="input-field date">
                    <input type="time" name="nuevoHoraR" min="8:00" max="5:00"  required class="input-field">

                    <textarea name="nuevoMensajeR" placeholder="Ingresa el mensaje" required class="input-field"></textarea>

                    <button type="submit" class="form-btn">
                        <span class="span">Reservar</span>

                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                    </button>
                    <?php
                    $reservar = new ControladorReserva();
                    $reservar->ctrCrearReserva();

                    ?>
                </form>

            </div>

            <figure class="card-banner img-holder" style="--width: 250; --height: 774;">
                <img src="vistas/estilosA/assets/images/appoin-banner-2.jpg" width="250" height="774" loading="lazy" alt="" class="img-cover">
            </figure>

        </div>

    </div>
</section>