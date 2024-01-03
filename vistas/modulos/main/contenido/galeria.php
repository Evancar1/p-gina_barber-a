<section class="section gallery" id="gallery" aria-label="photo gallery">
    <div class="container">

        <div class="title-wrapper">

            <div class="text-center">
                <h2 class="h2 section-title">Galería de fotos</h2>

                <p class="section-text">
                    Las mejores fotos de nuestro trabajo
                </p>
            </div>

            <a href="#gallery" class="btn has-before">
                <span class="span">Explorar galería</span>

                <ion-icon name="arrow-forward" aria-hidden="true"></ion-icon>
            </a>

        </div>

        <ul class="grid-list">

            <?php
            $item = null;
            $valor = null;

            $galeriaMain = ControladorGaleria::ctrMostrarGaleria($item, $valor);

            foreach($galeriaMain as $key => $value){
            ?>
            <li>
                <div class="gallery-card">

                    <figure class="card-banner img-holder" style="--width: 422; --height: 550;">
                        <img src="<?php echo $value["imagen"] ?>" width="422" height="550" loading="lazy" alt="Hair Cutting" class="img-cover">
                    </figure>

                
                </div>
            </li>
            <?php
            }
            ?>
        </ul>

    </div>
</section>