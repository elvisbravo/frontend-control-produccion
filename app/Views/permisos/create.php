<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- page title -->
<div class="container-fluid py-3">
    <div class="row gx-3 gx-lg-4 align-items-center page-title">
        <div class="col col-sm mb-3 mb-sm-0 order-1">
            <h5 class="mb-0">Seguridad</h5>
            <p class="text-secondary small">Permisos</p>
        </div>
    </div>
</div>

<div class="container mt-3" id="main-content">
    <p>Create Permisos</p>
</div>

<?= $this->endSection() ?>
</div>
</div>
</div>

<div class="container mt-3" id="main-content">

    <div class="card adminuiux-card">
        <div class="card-header">
            <p class="h6">Solicitar Nuevo Permiso</p>
        </div>
        <div class="card-body">
            <form id="formNuevoPermiso" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tipo_id" class="form-label">Tipo de Permiso</label>
                        <select class="form-select" id="tipo_id" name="tipo_id" required>
                            <option value="">-- Selecciona un tipo --</option>
                            <?php foreach ($tipos as $tipo): ?>
                                <option value="<?= $tipo['id'] ?>">
                                    <?= esc($tipo['nombre']) ?>
                                    <?= $tipo['es_remunerado'] ? '(Remunerado)' : '(No Remunerado)' ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="es_tiempo_completo" class="form-label">Tipo de Ausencia</label>
                        <select class="form-select" id="es_tiempo_completo" name="es_tiempo_completo">
                            <option value="1">Tiempo Completo</option>
                            <option value="0">Medio Tiempo / Parcial</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="dias" class="form-label">Cantidad de Días</label>
                        <input type="number" step="0.5" class="form-control" id="dias" name="dias" value="1" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="adjunto" class="form-label">Documento Adjunto (Opcional)</label>
                        <input type="file" class="form-control" id="adjunto" name="adjunto" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted">Máx 5MB. Formatos: PDF, DOC, DOCX, JPG, PNG</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo del Permiso</label>
                    <textarea class="form-control" id="motivo" name="motivo" rows="4" placeholder="Describe el motivo de tu permiso..." required></textarea>
                </div>

                <div class="alert alert-info" role="alert">
                    <strong>Nota:</strong> Tu solicitud será enviada para aprobación. Te notificaremos una vez que sea revisada.
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-theme" id="btnGuardarPermiso">Enviar Solicitud</button>
                    <a href="/permisos" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    document.getElementById('formNuevoPermiso').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const fechaInicio = new Date(document.getElementById('fecha_inicio').value);
        const fechaFin = new Date(document.getElementById('fecha_fin').value);

        if (fechaInicio > fechaFin) {
            alert('La fecha de inicio no puede ser posterior a la fecha de fin');
            return;
        }

        try {
            const response = await fetch('/permisos/store', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin'
            });

            const result = await response.json();

            if (result.success) {
                alert('Permiso solicitado exitosamente');
                window.location.href = '/permisos';
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error en la conexión');
        }
    });
</script>
<?= $this->endSection() ?>