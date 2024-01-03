<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

<div data-simplebar class="h-100">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" data-key="t-menu">Menu</li>

            <li>
                <a href="admin-inicio">
                    <i data-feather="home" class="bi bi-house"></i>
                    <span data-key="t-dashboard"><b>Inicio</b></span>
                </a>
            </li>
            <?php
            if($_SESSION["perfil_usuario"] == "Administrador"){
                echo '<li>
                        <a href="admin-usuarios">
                            <i data-feather="user"></i>
                            <span data-key="t-horizontal">Usuario</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-empresa">
                            <i data-feather="" class="bx bx-building-house"></i>
                            <span data-key="t-horizontal">Empresa</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-seo">
                            <i data-feather="" class="bx bx-search-alt-2"></i>
                            <span data-key="t-horizontal">Seo</span>
                        </a>
                    </li>
                    ';
            }
            if($_SESSION["perfil_usuario"]=="Administrador" || $_SESSION["perfil_usuario"] == "Ayudante"){
                echo '
                    <li>
                        <a href="admin-servicio">
                            <i data-feather="" class="bx bx-detail"></i>
                            <span data-key="t-horizontal">Servicio</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-precio">
                            <i data-feather="" class=" bx bx-money"></i>
                            <span data-key="t-horizontal">Precio</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-galeria">
                            <i data-feather="" class="bx bx-images"></i>
                            <span data-key="t-horizontal">Galeria</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-reservas">
                            <i data-feather="" class="bx bxs-city"></i>
                            <span data-key="t-horizontal">Reservas</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-suscriptor">
                            <i data-feather="" class="bx bxs-user-plus"></i>
                            <span data-key="t-horizontal">Suscriptores</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin-vista">
                            <i data-feather="" class="bx bx-happy-heart-eyes"></i>
                            <span data-key="t-horizontal">Vistas</span>
                        </a>
                    </li>
                    ';
            }
            ?>
            

            
        </ul>

    </div>
    <!-- Sidebar -->
</div>
</div>
<!-- Left Sidebar End -->