<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h4>Feriados</h4>
            <p class="text-secondary small">Administrar feriados nacionales y regionales</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <label>Año</label>
            <select id="yearSelect" class="form-select">
                <?php $year = date('Y');
                for ($i = $year; $i <= $year + 5; $i++): ?>
                    <option value="<?= $i ?>"><?= $i ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-8 d-flex align-items-end">
            <button id="generateEaster" class="btn btn-outline-primary me-2">Generar Semana Santa</button>
            <button id="addHolidayBtn" class="btn btn-theme">Agregar feriado</button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <table class="table table-striped" id="holidaysTable">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Modal agregar -->
    <div class="modal fade" id="holidayModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Feriado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" id="holidayDate" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" id="holidayName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select id="holidayType" class="form-select">
                            <option value="nacional">Nacional</option>
                            <option value="regional">Regional</option>
                        </select>
                    </div>
                    <div class="mb-3" id="regionGroup" style="display:none;">
                        <label class="form-label">Región</label>
                        <input type="text" id="holidayRegion" class="form-control" placeholder="Nombre de la región">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" id="saveHoliday" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="js/mantenimientos/feriados.js"></script>
<?= $this->endSection() ?>