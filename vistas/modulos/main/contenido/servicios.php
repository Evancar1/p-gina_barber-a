<section class="section service" id="services" aria-label="services">
    <div class="container">

        <h2 class="h2 section-title text-center">SERVICIO QUE BRINDAMOS</h2>

        <p class="section-text text-center">
        Adaptamos tus necesidades a un servicio puro y exclusivo, dándote los mejores resultados mediante el uso de diferentes técnicas, tradicionales o más novedosas incluyendo secado y peinado con productos de fijación.
        </p>

        <ul class="grid-list">
            <?php


            function cortarFraseServicio($frase, $maxPalabras = 30, $noTerminales = ["de"])
            {
                $palabras = explode(" ", $frase);
                $numPalabras = count($palabras);
                if ($numPalabras > $maxPalabras) {
                    $offset = $maxPalabras - 1;
                    while (in_array($palabras[$offset], $noTerminales) && $offset < $numPalabras) {
                        $offset++;
                    }
                    return implode(" ", array_slice($palabras, 0, $offset + 1));
                }
                return $frase;
            }

            $item = null;
            $valor = null;

            $servicios = ControladorServicio::ctrMostrarServicio($item, $valor);

            foreach($servicios as $key => $value){

            
            ?>
            <li>
                <div class="service-card">

                    <div class="card-text">
                        <img src="<?php echo $value["imagen"] ?>" width="80%" alt="Hair Cutting" style="border-radius: 100%; margin-left: 10%" >
                    </div>

                    <h3 class="h3">
                        <a href="#reservar" class="card-title"><?php echo $value["titulos"] ?></a>
                    </h3>

                    <p class="card-text">
                        <?php echo cortarFraseServicio($value["texto"]) ?>
                    </p>

                    <a href="#reservar" class="card-btn" aria-label="more">
                        <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
                    </a>

                </div>
            </li>
            <?php
             }
            ?>
        </ul>

    </div>
</section>