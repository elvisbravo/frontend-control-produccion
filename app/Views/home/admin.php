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
    });
</script>
<?= $this->endSection() ?>