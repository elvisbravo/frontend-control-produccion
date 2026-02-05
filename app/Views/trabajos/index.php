<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Clientes</h5>
            <p class="text-secondary small">Trabajos</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">Trabajos</p>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="mb-4">
                <table class="table w-100 nowrap" id="trabajosGrid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Contactos</th>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Entrega</th>
                            <th>Auxiliares</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- datos cargados por JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal de Disponibilidad de Auxiliares -->
<div class="modal fade" id="modalDisponibilidad" tabindex="-1" aria-labelledby="disponibilidadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title h5" id="disponibilidadLabel">Simulador de Disponibilidad</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="trabajoIdDisp" value="">

                <div class="mb-3">
                    <label class="form-label fw-bold">Auxiliares Disponibles</label>
                    <div id="listadoDisponibles">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label fw-bold">Reporte de Carga General</label>
                    <div id="reporteCarga">
                        <small class="text-secondary">Cargando reporte...</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/trabajos/trabajos.js"></script>
<?= $this->endSection() ?>