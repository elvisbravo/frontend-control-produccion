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
                                    <h5 class="mb-0">Mis Tareas Pendientes</h5>
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
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title">Detalle de la Tarea</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="text-center mb-4">
                                    <div class="avatar avatar-60 bg-theme-1-subtle text-theme-1 rounded-circle mb-3 mx-auto">
                                        <i class="bi bi-info-circle h3 mb-0"></i>
                                    </div>
                                    <h4 id="dt-nombre-tarea" class="mb-1">Nombre de la Tarea</h4>
                                    <p id="dt-proyecto" class="text-secondary small">Proyecto Relacionado</p>
                                </div>

                                <div class="row g-3">
                                    <div class="col-6">
                                        <div class="p-3 border rounded-3 bg-light">
                                            <p class="text-secondary small mb-1">Fecha Registro</p>
                                            <h6 id="dt-fecha" class="mb-0">--/--/----</h6>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-3 border rounded-3 bg-light">
                                            <p class="text-secondary small mb-1">Hora Registro</p>
                                            <h6 id="dt-hora" class="mb-0">--:-- --</h6>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 border rounded-3 bg-light">
                                            <p class="text-secondary small mb-1">Prioridad</p>
                                            <h6 id="dt-prioridad" class="mb-0">--</h6>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="p-3 border rounded-3 bg-light">
                                            <p class="text-secondary small mb-1">Descripción / Notas</p>
                                            <p id="dt-detalle" class="mb-0 small text-dark">No hay descripción disponible.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0 justify-content-center">
                                <button type="button" class="btn btn-theme-1 rounded-pill px-4" data-bs-dismiss="modal">Entendido</button>
                            </div>
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
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="assets/js/adminux/adminux-calendar.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Buscador de trabajadores en el dropdown
        const workerSearch = document.querySelector('.worker-search');
        if (workerSearch) {
            workerSearch.addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const items = document.querySelectorAll('.worker-item');

                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.parentElement.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            });
        }

        // Seleccionar trabajador
        const workerItems = document.querySelectorAll('.worker-item');
        workerItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();

                // Obtener datos del trabajador
                const workerImg = this.querySelector('img');
                const workerNameEl = this.querySelector('.col p:first-of-type');
                const workerRoleEl = this.querySelector('.col p:last-of-type');

                if (!workerImg || !workerNameEl || !workerRoleEl) {
                    console.error('No se encontraron los elementos del trabajador');
                    return;
                }

                const workerImgSrc = workerImg.src;
                const workerName = workerNameEl.textContent.trim();
                const workerRole = workerRoleEl.textContent.trim();

                // Actualizar el botón con los datos del trabajador
                const dropdownButton = document.querySelector('.worker-dropdown-btn');

                if (!dropdownButton) {
                    console.error('No se encontró el botón dropdown');
                    return;
                }

                // Logs de debug
                console.log('dropdownButton:', dropdownButton);
                console.log('HTML del button:', dropdownButton.innerHTML);

                // Buscar todos los elementos dentro del button
                const allImgs = dropdownButton.querySelectorAll('img');
                const allH6s = dropdownButton.querySelectorAll('h6');
                const allPs = dropdownButton.querySelectorAll('p');

                console.log('Todas las imágenes encontradas:', allImgs.length);
                console.log('Todos los h6 encontrados:', allH6s.length);
                console.log('Todos los p encontrados:', allPs.length);

                // Usar los primeros encontrados
                const imgElement = allImgs[0];
                const nameElement = allH6s[0];
                const roleElement = allPs[0];

                if (!imgElement || !nameElement || !roleElement) {
                    console.error('No se encontraron elementos en el botón para actualizar', {
                        img: imgElement,
                        name: nameElement,
                        role: roleElement
                    });
                    return;
                }

                console.log('Elementos encontrados correctamente');

                imgElement.src = workerImgSrc;
                nameElement.textContent = workerName;
                roleElement.textContent = workerRole;

                // Marcar como seleccionado
                document.querySelectorAll('.worker-item').forEach(el => {
                    el.classList.remove('active');
                });
                this.classList.add('active');

                // Limpiar el buscador
                if (workerSearch) {
                    workerSearch.value = '';
                }

                // Cerrar el dropdown
                const dropdown = bootstrap.Dropdown.getInstance(dropdownButton);
                if (dropdown) {
                    dropdown.hide();
                }
            });
        });

        // Función para cargar tareas desde la API
        function cargarTareasPendientes() {
            const container = document.getElementById('listaTareasAsignadas');
            if (!container) return;

            fetch("horario-by-id")
                .then(res => res.json())
                .then(data => {
                    const tareas = data.result;
                    let html = '';

                    if (!tareas || tareas.length === 0) {
                        html = `
                            <div class="text-center py-5">
                                <i class="bi bi-clipboard-x h2 text-secondary opacity-50 d-block mb-3"></i>
                                <p class="text-secondary">No hay tareas pendientes en este momento.</p>
                            </div>`;
                    } else {
                        tareas.forEach(tarea => {
                            // Formatear la fecha y hora de creado
                            const fechaObj = new Date(tarea.created_at);
                            const fechaFormateada = fechaObj.toLocaleDateString('es-PE', {
                                day: '2-digit',
                                month: '2-digit',
                                year: 'numeric'
                            });
                            const horaFormateada = fechaObj.toLocaleTimeString('es-PE', {
                                hour: '2-digit',
                                minute: '2-digit',
                                hour12: true
                            });

                            // Mapeo de estilos
                            let iconClass = "bi-journal-check";
                            let badgeClass = "bg-primary";
                            let bgClass = "bg-light";

                            html += `
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0 rounded-3 mb-2 ${bgClass} p-3 btn-ver-detalle-tarea" 
                                   data-id="${tarea.id}" 
                                   data-nombre="${tarea.title}" 
                                   data-fecha="${fechaFormateada}"
                                   data-hora="${horaFormateada}" 
                                   data-proyecto="${tarea.proyecto || 'General'}" 
                                   data-prioridad="Normal" 
                                   data-detalle="${tarea.contenido || 'Sin descripción adicional.'}">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar avatar-40 bg-info text-white rounded-circle">
                                                <i class="bi ${iconClass}"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0">${tarea.title}</h6>
                                            <p class="text-secondary small mb-0">ID: #${tarea.id} | <span class="text-dark">${tarea.proyecto || 'General'}</span></p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <div class="text-dark small fw-bold mb-1"><i class="bi bi-calendar-event me-1"></i>${fechaFormateada}</div>
                                            <div class="text-secondary small mb-2"><i class="bi bi-clock me-1"></i>${horaFormateada}</div>
                                            <span class="badge ${badgeClass}">Normal</span>
                                        </div>
                                    </div>
                                </a>`;
                        });
                    }

                    container.innerHTML = html;
                    asignarEventosDetalle();
                })
                .catch(err => {
                    console.error("Error cargando tareas:", err);
                    container.innerHTML = `<div class="alert alert-danger mx-3">Error al cargar las tareas pendientes.</div>`;
                });
        }

        function asignarEventosDetalle() {
            const btns = document.querySelectorAll('.btn-ver-detalle-tarea');
            const modalElement = document.getElementById('modalDetalleTarea');
            if (!modalElement) return;

            const modalDetalle = new bootstrap.Modal(modalElement);

            btns.forEach(btn => {
                btn.addEventListener('click', function() {
                    document.getElementById('dt-nombre-tarea').textContent = this.getAttribute('data-nombre');
                    document.getElementById('dt-proyecto').textContent = this.getAttribute('data-proyecto');
                    document.getElementById('dt-fecha').textContent = this.getAttribute('data-fecha');
                    document.getElementById('dt-hora').textContent = this.getAttribute('data-hora');
                    document.getElementById('dt-prioridad').textContent = this.getAttribute('data-prioridad');
                    document.getElementById('dt-detalle').textContent = this.getAttribute('data-detalle');
                    modalDetalle.show();
                });
            });
        }

        // Cargar tareas al iniciar
        cargarTareasPendientes();
    });
</script>
<?= $this->endSection() ?>