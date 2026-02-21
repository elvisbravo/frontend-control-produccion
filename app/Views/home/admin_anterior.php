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
                    <h6 class="mb-0">To-Do list</h6>
                    <p class="text-secondary small">Pickup a task</p>
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
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4" id="todocolumnone">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">10:45 am | 3 hrs</p>
                                <h6>Signup Payment</h6>
                                <p class="text-secondary small mb-3">Create Sign up flow with payment scheduling. Must have bank details.</p>
                                <span class="badge badge-light text-bg-theme-1 theme-red">UIUX</span>
                                <span class="badge badge-light text-bg-theme-1 theme-green">Prototype</span>
                            </div>
                        </div>
                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Dhanitara">
                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Shrivalli">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 bg-theme-1-subtle text-theme-1 rounded-circle me-1">
                                    <p class="small">2+</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card adminuiux-card shadow-sm bg-l-gradient-light text-theme-1 theme-yellow mb-3 mb-lg-4">
                    <div class="card-body">
                        These cards in columns are draggable to another column.
                    </div>
                </div>
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">9:30 am | 5 hrs</p>
                                <h6>Searchbar Header</h6>
                                <p class="text-secondary small mb-3">Get the tabbed categories result and clubbed result in main tab.</p>
                                <div class="coverimg rounded height-110 overflow-hidden mb-3">
                                    <img src="assets/img/modern-ai-image/user-7.jpg" class="w-100" alt="" />
                                </div>
                                <span class="badge badge-light text-bg-theme-1 theme-blue">Code</span>
                                <span class="badge badge-light text-bg-theme-1 theme-pink">Development</span>
                            </div>
                        </div>
                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Dhanitara">
                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Shrivalli">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 bg-theme-1-subtle text-theme-1 rounded-circle me-1">
                                    <p class="small">2+</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <h6 class="mb-0">In-Progress</h6>
                    <p class="text-secondary small">Working on tasks</p>
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
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4" id="todocolumntwo">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">2:30 pm | 3 hrs</p>
                                <h6>Cart Product</h6>
                                <p class="text-secondary small mb-3">Create cart and product add list flow.</p>
                                <span class="badge badge-light text-bg-theme-1 theme-pink">Development</span>
                                <span class="badge badge-light text-bg-theme-1 theme-cyan">Testing</span>
                            </div>
                        </div>

                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="AdminUIUX">
                                    <img src="assets/img/modern-ai-image/user-1.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Danish">
                                    <img src="assets/img/modern-ai-image/user-4.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4" id="todocolumnthree">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">9:30 am | 5 hrs</p>
                                <h6>Signin</h6>
                                <p class="text-secondary small mb-3">Create Sign in flow with forget password. Validation and Resend OTP flow consider.</p>
                                <span class="badge badge-light text-bg-theme-1 theme-red">UIUX</span>
                                <span class="badge badge-light text-bg-theme-1 theme-green">Prototype</span>
                            </div>
                        </div>
                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Dhanitara">
                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Shrivalli">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 bg-theme-1-subtle text-theme-1 rounded-circle me-1">
                                    <p class="small">2+</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <h6 class="mb-0">Completed</h6>
                    <p class="text-secondary small">Under QA review</p>
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
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">1:00 am | 2 hrs</p>
                                <h6>Menu Access</h6>
                                <p class="text-secondary small mb-3">Menu and router link work. Classis view of menu colored menu with style selection should be there. </p>
                                <div class="coverimg rounded height-110 overflow-hidden mb-3">
                                    <img src="assets/img/modern-ai-image/user-5.jpg" class="w-100" alt="" />
                                </div>
                                <span class="badge badge-light text-bg-theme-1 theme-blue">Code</span>
                                <span class="badge badge-light text-bg-theme-1 theme-pink">Development</span>
                            </div>
                        </div>
                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Dhanitara">
                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Shrivalli">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 bg-theme-1-subtle text-theme-1 rounded-circle me-1">
                                    <p class="small">2+</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4" id="todocolumnfour">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">10:00 am | 6 hrs</p>
                                <h6>Favorite Items</h6>
                                <p class="text-secondary small mb-3">Favorite items in the list and in the cart. Wishlist item till user choose it to be remove from wishlist. Connection wishlist items show.</p>
                                <span class="badge badge-light text-bg-theme-1 theme-yellow">Requirement</span>
                                <span class="badge badge-light text-bg-theme-1 theme-purple">Sales</span>
                            </div>
                        </div>
                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="AdminUIUX">
                                    <img src="assets/img/modern-ai-image/user-1.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <h6 class="mb-0">Approved</h6>
                    <p class="text-secondary small">Reay for Publish</p>
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
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4" id="todocolumn2">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">9:30 am | 5 hrs</p>
                                <h6>Landing page and Loader</h6>
                                <p class="text-secondary small mb-3">Landing page and Loader design based on logo. There will be best combinations of colors and styles.</p>
                                <span class="badge badge-light text-bg-theme-1 theme-red">UIUX</span>
                                <span class="badge badge-light text-bg-theme-1 theme-green">Prototype</span>
                            </div>
                        </div>

                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Dhanitara">
                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Shrivalli">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 bg-theme-1-subtle text-theme-1 rounded-circle me-1">
                                    <p class="small">2+</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card adminuiux-card shadow-sm mb-3 mb-lg-4" id="todocolumnfive">
                    <div class="card-body">
                        <div class="row gx-2 align-items-center mb-3">
                            <div class="col">
                                <p class="text-secondary small">10:00 am | 6 hrs</p>
                                <h6>Prototype user flow</h6>
                                <p class="text-secondary small mb-3">Create and get the approval for userflow. Provide it to tester to create initial use-cases. Business development team reiterate and provide gaps information.</p>
                                <span class="badge badge-light text-bg-theme-1 theme-red">UIUX</span>
                                <span class="badge badge-light text-bg-theme-1 theme-green">Prototype</span>
                            </div>
                        </div>
                        <div class="row gx-2 align-items-center">
                            <div class="col">
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Dhanitara">
                                    <img src="assets/img/modern-ai-image/user-2.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 coverimg rounded-circle me-1" data-bs-toggle="tooltip" title="Shrivalli">
                                    <img src="assets/img/modern-ai-image/user-3.jpg" alt="">
                                </div>
                                <div class="avatar avatar-30 bg-theme-1-subtle text-theme-1 rounded-circle me-1">
                                    <p class="small">2+</p>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-link btn-square theme-grey">
                                    <i class="bi bi-paperclip"></i>
                                </button>
                                <button class="btn btn-link btn-square">
                                    <i class="bi bi-chat-right-dots"></i>
                                </button>
                            </div>
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
                        <i class="bi bi-list-task me-2"></i>Tareas Asignadas
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
                    <div class="card adminuiux-card">
                        <div class="card-body">
                            <div class="row align-items-center mb-4">
                                <div class="col">
                                    <h5 class="mb-0">Mis Tareas</h5>
                                    <p class="text-secondary small">Visualiza y gestiona tus tareas asignadas</p>
                                </div>
                            </div>
                            <!-- Lista de tareas dinámica -->
                            <div class="list-group list-group-flush" id="listaTareasAsignadas">
                                <div class="text-center py-5" id="loaderTareas">
                                    <div class="spinner-border text-theme-1 mb-3" role="status">
                                        <span class="visually-hidden">Cargando...</span>
                                    </div>
                                    <p class="text-secondary">Cargando tareas pendientes...</p>
                                </div>
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
                                            <label for="dt-link-drive" class="form-label fw-bold">Link del Drive</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="dt-link-drive" placeholder="https://drive.google.com/..." name="dt-link-drive" required>
                                                <a href="#" id="dt-link-drive-btn" target="_blank" class="btn btn-outline-theme-1"><i class="bi bi-box-arrow-up-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer border-0 pt-0 justify-content-center">
                                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-outline-success rounded-pill px-4" id="btnActualizarTarea">Empezar</button>
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