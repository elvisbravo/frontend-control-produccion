<?= $this->extend('layouts/main') ?>    

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Home</h5>
            <p class="text-secondary small">Dashboard del sistema</p>
        </div>
    </div>
</div>

<!-- content -->
<div class="container mt-3" id="main-content">

    <!-- content -->
    <div class="row gx-3 gx-lg-4">
        <!-- summary blocks -->
        <div class="col-12 col-md-6 col-lg-6 col-xxl-3">
            <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="row gx-3 gx-lg-4 align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-60 h5 bg-theme-1-subtle text-theme-1 theme-green rounded-circle">
                                <i class="bi bi-calendar-check"></i>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-secondary small mb-1">Entregas Hoy</p>
                            <h5>0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-6 col-xxl-3">
            <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="row gx-3 gx-lg-4 align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-60 h5 bg-theme-1-subtle text-theme-1 theme-yellow rounded-circle">
                                <i class="bi bi-bag-check-fill"></i>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-secondary small mb-1">Pendientes Hoy</p>
                            <h5>0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 col-xxl-3">
            <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="row gx-3 gx-lg-4 align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-60 h5 bg-theme-1-subtle text-theme-1 theme-green rounded-circle">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-secondary small mb-1">Entregados Semana</p>
                            <h5>0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6 col-xxl-3">
            <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4">
                <div class="card-body">
                    <div class="row gx-3 gx-lg-4 align-items-center">
                        <div class="col-auto">
                            <div class="avatar avatar-60 h5 bg-theme-1-subtle text-theme-1 rounded-circle">
                                <i class="bi bi-card-checklist"></i>
                            </div>
                        </div>
                        <div class="col">
                            <p class="text-secondary small mb-1">Pendientes Semana</p>
                            <h5>0</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-10 col-md-4 col-xl-4 mx-auto">
            <h4 class="text-center">Calendario de Proyectos</h4>
            <h6 class="mb-3 text-center">Elige el trabajador</h6>
            <div class="dropdown w-100 mb-4">
                <button class="btn btn-link dropdown-toggle text-start no-caret w-100" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="row align-items-center gx-3">
                        <div class="col-auto">
                            <figure class="avatar avatar-40 rounded-circle coverimg">
                                <img src="assets/img/modern-ai-image/user-4.jpg" alt="">
                            </figure>
                        </div>
                        <div class="col">
                            <h6 class="mb-1">Seleccione...</h6>
                            <p class="opacity-75 small"></p>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-chevron-down small"></i>
                        </div>
                    </span>
                </button>
                <ul class="dropdown-menu w-100">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40 rounded-circle coverimg">
                                        <img src="assets/img/modern-ai-image/user-4.jpg" alt="">
                                    </figure>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Hajick</p>
                                    <p class="opacity-75 small">Jefe de Producción</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40 rounded-circle coverimg">
                                        <img src="assets/img/modern-ai-image/user-5.jpg" alt="">
                                    </figure>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Diana</p>
                                    <p class="opacity-75 small">Auxiliar</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="javascript:void(0)">
                            <div class="row align-items-center gx-3">
                                <div class="col-auto">
                                    <figure class="avatar avatar-40 rounded-circle coverimg">
                                        <img src="assets/img/modern-ai-image/user-7.jpg" alt="">
                                    </figure>
                                </div>
                                <div class="col">
                                    <p class="mb-1">Flor</p>
                                    <p class="opacity-75 small">Auxiliar</p>
                                </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <div class="col-12 col-md-12 col-xl">
            <!-- Calendar Third party -->
            <div class="card adminuiux-card mb-3">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>


</div>
<?= $this->endSection() ?>