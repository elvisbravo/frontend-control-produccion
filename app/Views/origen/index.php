<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Mantenimiento</h5>
            <p class="text-secondary small">Origen</p>
        </div>
    </div>
</div>


<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card mb-4">
        <div class="card-header">
            <div class="row gx-3 gx-lg-4 align-items-center">
                <div class="col">
                    <p class="h6">origen</p>
                </div>
                <div class="col-auto">
                    <button class="btn btn-theme" id="btnAdd"><i class="bi bi-person-plus vm me-2"></i> Nuevo</button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="origenTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Origen</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- DataTable cargará aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="modalAgregarEditarOrigen" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Agregar Origen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formOrigen">
                <div class="modal-body">

                    <input type="hidden" id="origenId" name="origenId" value="0">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="name_origen" class="form-label">Origen</label>
                                <input type="text" class="form-control" name="name_origen" id="name_origen" placeholder="Ingresa el origen" required>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-theme" id="btnGuardarUsuario">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script defer src="js/origen/lista.js"></script>
<?= $this->endSection() ?>