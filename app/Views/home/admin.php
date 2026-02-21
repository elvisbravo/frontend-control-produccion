<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .editor-content img {
        max-width: 100%;
        height: auto;
        display: block;
    }

    .image-modal {
        display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 50px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 90%;
    }

    .close {
        position: absolute;
        top: 20px;
        right: 40px;
        color: white;
        font-size: 40px;
        cursor: pointer;
    }
</style>

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

    <!-- Nav Tabs -->
    <div class="row mb-4">
        <div class="col-12">
            <ul class="nav nav-tabs adminuiux-nav-tabs border-0 mb-3" id="adminTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tasks-tab" data-bs-toggle="tab" data-bs-target="#tasks-tab-pane" type="button" role="tab" aria-controls="tasks-tab-pane" aria-selected="true">
                        <i class="bi bi-list-task me-2"></i>Tareas
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="calendar-tab" data-bs-toggle="tab" data-bs-target="#calendar-tab-pane" type="button" role="tab" aria-controls="calendar-tab-pane" aria-selected="false">
                        <i class="bi bi-calendar3 me-2"></i>Calendario
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="adminTabContent">
                <!-- Tab Tareas Asignadas -->
                <div class="tab-pane fade show active" id="tasks-tab-pane" role="tabpanel" aria-labelledby="tasks-tab" tabindex="0">
                    <div class="row align-items-center mb-4">
                        <div class="col">
                            <h4 class="mb-1">Gestión de <span class="text-gradient">Tareas</span></h4>
                            <p class="text-secondary small">Administra las actividades y monitorea su progreso en tiempo real.</p>
                        </div>
                        <div class="col-auto">
                            <div class="row g-2 align-items-center bg-light p-2 rounded-4 shadow-sm">
                                <div class="col-auto">
                                    <label class="form-label small fw-bold mb-0 text-secondary ps-2">Desde:</label>
                                    <input type="date" id="filtro-fecha-inicio" class="form-control form-control-sm border-0 bg-transparent" value="<?= date('Y-m-d', strtotime('-7 days')) ?>">
                                </div>
                                <div class="col-auto h-100 d-flex align-items-center">
                                    <div class="vr h-50 my-auto"></div>
                                </div>
                                <div class="col-auto">
                                    <label class="form-label small fw-bold mb-0 text-secondary ps-2">Hasta:</label>
                                    <input type="date" id="filtro-fecha-fin" class="form-control form-control-sm border-0 bg-transparent" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-theme-1 btn-sm rounded-pill px-3" id="btn-filtrar-tareas">
                                        <i class="bi bi-filter me-1"></i>Filtrar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- project progress list -->
                    <div class="row gx-3 gx-lg-4">
                        <div class="col-12 col-md-4 col-lg-3 mb-3">
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 bg-theme-1 theme-yellow text-white rounded">
                                        <i class="bi bi-list-task h5"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="mb-0">Pendientes</h6>
                                    <p class="text-secondary small">Lista de tareas</p>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown d-inline-block">
                                        <a class="btn btn-square btn-link no-caret dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static" role="button">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                            <li><a class="dropdown-item text-danger" href="javascript:void(0)">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="todocolumn" class="dragzonecard">


                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3 mb-3">
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 bg-blue text-white rounded">
                                        <i class="bi bi-clock h5"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="mb-0">En Proceso</h6>
                                    <p class="text-secondary small">Tareas en proceso</p>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown d-inline-block">
                                        <a class="btn btn-square btn-link no-caret dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static" role="button">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                            <li><a class="dropdown-item text-danger" href="javascript:void(0)">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="inprogresscolumn" class="dragzonecard">

                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3 mb-3">
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 bg-green text-white rounded">
                                        <i class="bi bi-clipboard-check h5"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="mb-0">Finalizadas</h6>
                                    <p class="text-secondary small">Tareas finalizadas</p>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown d-inline-block">
                                        <a class="btn btn-square btn-link no-caret dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static" role="button">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                            <li><a class="dropdown-item text-danger" href="javascript:void(0)">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="completedcolumn" class="dragzonecard">

                            </div>
                        </div>

                        <div class="col-12 col-md-4 col-lg-3 mb-3">
                            <div class="row gx-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <div class="avatar avatar-40 bg-pink text-white rounded">
                                        <i class="bi bi-server h5"></i>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="mb-0">Pausadas</h6>
                                    <p class="text-secondary small">Tareas pausadas</p>
                                </div>
                                <div class="col-auto">
                                    <div class="dropdown d-inline-block">
                                        <a class="btn btn-square btn-link no-caret dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static" role="button">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="javascript:void(0)">Edit</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0)">Move</a></li>
                                            <li><a class="dropdown-item text-danger" href="javascript:void(0)">Delete</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div id="approvedcolumn" class="dragzonecard">

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Detalle de Tarea -->
                <div class="modal fade" id="modalDetalleTarea" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title">Detalle de la Tarea</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formEmpezarTarea">
                                <div class="modal-body p-4">
                                    <input type="hidden" name="id_actividad" id="dt-id-tarea">
                                    <input type="hidden" name="id_prospecto" id="dt-id-prospecto">
                                    <div class="text-center mb-4">
                                        <div class="avatar avatar-60 bg-theme-1-subtle text-theme-1 rounded-circle mb-3 mx-auto">
                                            <i class="bi bi-info-circle h3 mb-0"></i>
                                        </div>
                                        <h4 id="dt-nombre-tarea" class="mb-1">Nombre de la Tarea</h4>
                                        <p id="dt-nombre-asignado" class="mb-1"></p>
                                    </div>

                                    <div class="row g-4">
                                        <!-- Información del Prospecto -->
                                        <div class="col-md-7">
                                            <h6 class="mb-3"><span class="badge bg-secondary">Información del Potencial Cliente</span></h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-8">
                                                    <p class="text-secondary small mb-2"><i class="bi bi-person-badge me-1"></i>Nombre(s) Completo(s)</p>
                                                    <div id="dt-cliente-nombre-container" class="d-flex flex-column gap-1">
                                                        <h6 class="mb-0 fw-bold">--</h6>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4">
                                                    <p class="text-secondary small mb-2"><i class="bi bi-telephone me-1"></i>Contacto(s)</p>
                                                    <div id="dt-cliente-celular-container" class="d-flex flex-wrap gap-2">
                                                        <h6 class="mb-0">--</h6>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-secondary small mb-1">Origen</p>
                                                    <h6 id="dt-cliente-origen" class="mb-0">--</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-secondary small mb-1">Nivel Académico</p>
                                                    <h6 id="dt-cliente-nivel" class="mb-0">--</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-secondary small mb-1">Universidad</p>
                                                    <h6 id="dt-cliente-universidad" class="mb-0">--</h6>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-secondary small mb-1">Carrera</p>
                                                    <h6 id="dt-cliente-carrera" class="mb-0">--</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Detalles de Entrega y Tarea -->
                                        <div class="col-md-5">
                                            <h6 class="mb-3"><span class="badge bg-secondary">Detalles técnicos</span></h6>
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <div class="p-2 border rounded-3 bg-light">
                                                        <p class="text-secondary small mb-1">Fecha Entrega Tentativa</p>
                                                        <h6 id="dt-entrega-tentativa" class="mb-0 text-primary">--/--/----</h6>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-secondary small mb-1">Fecha Registro</p>
                                                    <h6 id="dt-fecha" class="mb-0">--/--/----</h6>
                                                </div>
                                                <div class="col-6">
                                                    <p class="text-secondary small mb-1">Hora Registro</p>
                                                    <h6 id="dt-hora" class="mb-0">--:-- --</h6>
                                                </div>
                                                <div class="col-12">
                                                    <p class="text-secondary small mb-1">Prioridad</p>
                                                    <h6 id="dt-prioridad" class="mb-0">--</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <h6 class="mb-3"><span class="badge bg-secondary">Descripción / Notas</span></h6>
                                            <div class="p-3 border rounded-3 bg-light">
                                                <div id="dt-detalle" class="mb-0 small text-dark editor-content">No hay descripción disponible.</div>
                                            </div>
                                        </div>

                                        <!-- Campos Editables -->
                                        <div class="col-md-12">
                                            <label for="dt-link-drive" class="form-label small fw-bold text-secondary mb-2">
                                                <i class="bi bi-cloud-arrow-up me-1"></i>Enlace de Material (Google Drive)
                                            </label>
                                            <div class="input-group shadow-sm rounded-4 overflow-hidden border">
                                                <span class="input-group-text border-0 bg-light-subtle px-3">
                                                    <i class="bi bi-google text-primary"></i>
                                                </span>
                                                <input type="text" class="form-control border-0 py-2 px-3" id="dt-link-drive"
                                                    placeholder="Pegue aquí el enlace del drive..."
                                                    name="dt-link-drive"
                                                    style="font-size: 0.9rem;">

                                                <!-- Botón para Guardar (se activará al escribir) -->
                                                <button type="button" class="btn btn-success border-0 px-3 d-none" id="btn-save-link-drive" title="Guardar Enlace">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>

                                                <!-- Botón para Ir al Link -->
                                                <a href="#" id="dt-link-drive-btn" target="_blank"
                                                    class="btn btn-primary border-0 px-3 d-flex align-items-center disabled"
                                                    title="Abrir Carpeta">
                                                    <i class="bi bi-box-arrow-up-right"></i>
                                                </a>
                                            </div>
                                            <div id="link-status-msg" class="small mt-1 text-muted ms-2" style="font-size: 0.75rem;">
                                                <i class="bi bi-info-circle me-1"></i>El enlace se habilita cuando detecta contenido válido.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-0 justify-content-center">
                                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Tab Calendario -->
                <div class="tab-pane fade" id="calendar-tab-pane" role="tabpanel" aria-labelledby="calendar-tab" tabindex="0">
                    <div class="row justify-content-center">
                        <div class="col-10 col-md-4 col-xl-4">
                            <h4 class="text-center">Calendario de Proyectos</h4>
                            <h6 class="mb-3 text-center">Elige el trabajador</h6>
                            <div class="dropdown w-100 mb-4">
                                <button class="btn btn-link dropdown-toggle text-start no-caret w-100 worker-dropdown-btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <li class="px-3 py-2">
                                        <input type="text" class="form-control form-control-sm worker-search" placeholder="Buscar trabajador...">
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item worker-item" href="javascript:void(0)">
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
                                        <a class="dropdown-item worker-item" href="javascript:void(0)">
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
                                        <a class="dropdown-item worker-item" href="javascript:void(0)">
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card adminuiux-card mb-3">
                                <div class="card-body">
                                    <div id="calendar"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div id="imageModal" class="image-modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="js/admin/projects.js"></script>
<script src="js/admin/tareas.js"></script>
<script src="assets/js/adminux/adminux-calendar.js"></script>

<?= $this->endSection() ?>