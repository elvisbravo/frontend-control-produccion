<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">

        <!-- main sidebar toggle -->
        <button class="btn btn-link btn-square sidebar-toggler" type="button" onclick="initSidebar()">
            <i class="sidebar-svg" data-feather="menu"></i>
        </button>

        <!-- logo -->
        <a class="navbar-brand" href="adminux-dashboard.html">
            <img data-bs-img="light" src="assets/img/logo-light.svg" alt="">
            <img data-bs-img="dark" src="assets/img/logo.svg" alt="">
            <div class="">
                <span class="h4 text-gradient">Grupo<span class="fw-bold"> ES</span></span>
                <p class="company-tagline">Sistema Mia</p>
            </div>
        </a>

        <!-- right icons button -->
        <div class="ms-auto">
            <!-- global search toggle -->
            <button class="btn btn-link btn-square btn-icon btn-link-header d-lg-none" type="button" onclick="openSearch()">
                <i data-feather="search"></i>
            </button>

            <!-- dark mode -->
            <button class="btn btn-link btn-square btnsunmoon btn-link-header" id="btn-layout-modes-dark-page">
                <i class="sun mx-auto" data-feather="sun"></i>
                <i class="moon mx-auto" data-feather="moon"></i>
            </button>

            <!-- notification dropdown -->
            <button class="btn btn-link btn-square btn-icon btn-link-header dropdown-toggle position-relative no-caret" type="button" data-bs-toggle="offcanvas" data-bs-target="#view-notification" aria-expanded="false">
                <i data-feather="bell"></i>
                <span class="position-absolute top-0 end-0 badge rounded-pill bg-danger p-1">
                    <small>0+</small>
                    <span class="visually-hidden">unread messages</span>
                </span>
            </button>

            <!-- profile dropdown -->
            <div class="dropdown d-inline-block">
                <a class="dropdown-toggle btn btn-link btn-square btn-link-header style-none no-caret px-0" id="userprofiledd" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                    <div class="row gx-0 d-inline-flex">
                        <div class="col-auto align-self-center">
                            <figure class="avatar avatar-28 rounded-circle coverimg align-middle">
                                <img src="assets/img/modern-ai-image/user-6.jpg" alt="" id="userphotoonboarding2">
                            </figure>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end width-300 px-0 pt-0" aria-labelledby="userprofiledd">
                    <div class="p-3 bg-r-gradient rounded mb-2">
                        <a href="adminux-myprofile.html" class="dropdown-item">
                            <div class="row gx-3">
                                <div class="col-auto ">
                                    <figure class="avatar avatar-50 rounded-circle coverimg align-middle">
                                        <img src="assets/img/modern-ai-image/user-6.jpg" alt="">
                                    </figure>
                                </div>
                                <div class="col align-self-center ">
                                    <h5 class="mb-1"><?= session()->get('nombres')." ". session()->get('apellidos') ?></h5>
                                    <p class="small"><i class="bi bi-trophy me-2"></i> <?= session()->get('rol') ?></p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="px-2">
                        <div>
                            <a class="dropdown-item" href="adminux-myprofile.html"><i data-feather="user" class="avatar avatar-18 me-1"></i> Mi Perfil</a>
                        </div>

                        <div>
                            <a class="dropdown-item theme-red" href="<?= base_url('auth/logout') ?>">
                                <i data-feather="power" class="avatar avatar-18 me-1"></i> Salir
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</nav>