/*! For license information please see adminux-project-projects.js.LICENSE.txt */
"use strict";

document.addEventListener("DOMContentLoaded", function () {
    // --- Dragula (Drag and Drop) ---
    const drake = dragula([
        document.querySelector("#todocolumn"),
        document.querySelector("#inprogresscolumn"),
        document.querySelector("#completedcolumn"),
        document.querySelector("#approvedcolumn"),
    ]);

    initBoard();

    // Evento para el botón de filtrar
    const btnFiltrar = document.getElementById('btn-filtrar-tareas');
    if (btnFiltrar) {
        btnFiltrar.addEventListener('click', initBoard);
    }

    // Variables para guardar la posición original
    let originalSource, originalSibling;

    drake.on('drag', function (el, source) {
        // Guardamos el contenedor original y el hermano siguiente para poder revertir manualmente
        originalSource = source;
        originalSibling = el.nextElementSibling;
    });

    drake.on('drop', function (el, target, source, sibling) {
        // Si el destino es el mismo que el origen, no hacemos nada
        if (target.id === source.id) return;

        // Regla 1: Solo se puede mover a "En Proceso" si la columna está vacía
        if (target.id === 'inprogresscolumn') {
            const currentTasks = target.querySelectorAll('.card').length;

            if (currentTasks > 1) {
                drake.cancel(true); // Esto funciona aquí porque es síncrono

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Trabajo en curso',
                        text: 'Ya hay un trabajo en proceso. Finalízalo o paúsalo antes de empezar otro.',
                        confirmButtonColor: '#ffc107'
                    });
                } else {
                    alert('Hay un trabajo en proceso');
                }

                return;
            }
        }

        // Regla 2: La columna de "Pausadas" solo acepta tareas desde "En Proceso"
        if (target.id === 'approvedcolumn') {
            if (source.id !== 'inprogresscolumn') {
                drake.cancel(true);

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Movimiento no permitido',
                        text: 'Solo puedes pausar tareas que están actualmente "En Proceso".',
                        confirmButtonColor: '#dc3545'
                    });
                } else {
                    alert('Solo se puede pausar desde En Proceso');
                }
                return;
            }
        }

        const idTarea = el.dataset.id;
        const estadoProgreso = el.dataset.progreso;
        const prospecto_id = el.dataset.prospecto;

        // --- Confirmación de cambio ---
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: '¿Confirmar cambio?',
                text: "¿Deseas mover esta tarea a la nueva columna?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#198754',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, mover',
                cancelButtonText: 'Cancelar',
                reverseButtons: true,
                allowOutsideClick: false // Evita que se cierre haciendo clic fuera
            }).then((result) => {
                if (result.isConfirmed) {
                    updateEstadoTarea(idTarea, estadoProgreso, prospecto_id);

                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: 'El estado de la tarea ha sido actualizado.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // Aquí puedes añadir la llamada fetch para actualizar en BD
                } else {
                    // Si cancela, devolvemos el elemento manualmente a su lugar original
                    // ya que drake.cancel(true) no funciona de forma asíncrona tras el drop
                    if (originalSibling) {
                        originalSource.insertBefore(el, originalSibling);
                    } else {
                        originalSource.appendChild(el);
                    }
                }
            });
        } else {
            if (!confirm('¿Deseas confirmar el cambio de columna?')) {
                if (originalSibling) {
                    originalSource.insertBefore(el, originalSibling);
                } else {
                    originalSource.appendChild(el);
                }
            }
        }
    });

});

/**
 * Inicializa todas las columnas del tablero Kanban
 */
function initBoard() {
    getActividadesByEstado('Pendiente', 'todocolumn');
    getActividadesByEstado('En proceso', 'inprogresscolumn');
    getActividadesByEstado('Finalizado', 'completedcolumn');
    getActividadesByEstado('Pausado', 'approvedcolumn');
}

/**
 * Obtiene las actividades desde el servidor filtradas por estado y fecha
 */
function getActividadesByEstado(estado, contenedorId) {
    const filtro_fecha_inicio = document.getElementById('filtro-fecha-inicio');
    const filtro_fecha_fin = document.getElementById('filtro-fecha-fin');

    const formData = new FormData();
    formData.append('fecha_inicio', filtro_fecha_inicio.value);
    formData.append('fecha_fin', filtro_fecha_fin.value);
    formData.append('estado_progreso', estado);

    fetch('getEstadosActividades', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status == 'success') {
                renderizarActividades(data.result, contenedorId);
            } else {
                console.error(`Error en estado ${estado}: ${data.message}`);
            }
        })
        .catch(error => console.error('Error:', error));
}

/**
 * Renderiza el HTML de las tareas en una columna específica
 */
function renderizarActividades(data, contenedorId) {
    let html = "";
    const container = document.getElementById(contenedorId);
    if (!container) return;

    if (!data || data.length === 0) {
        container.innerHTML = `
            <div class="text-center py-4 opacity-50">
                <i class="bi bi-inbox small d-block mb-1"></i>
                <p class="small mb-0">Sin tareas</p>
            </div>`;
        return;
    }

    data.forEach(task => {
        const fechaObj = new Date(task.created_at);
        const fechaFormateada = fechaObj.toLocaleDateString('es-PE', { day: '2-digit', month: '2-digit', year: 'numeric' });
        const horaFormateada = fechaObj.toLocaleTimeString('es-PE', { hour: '2-digit', minute: '2-digit', hour12: true });

        // Determinar estilos según prioridad
        let badgeClass = "bg-secondary";
        let borderColor = "#6c757d";
        const prioridad = (task.prioridad || 'Media').toUpperCase();

        if (prioridad === 'ALTA') {
            badgeClass = "bg-danger";
            borderColor = "#dc3545";
        } else if (prioridad === 'MEDIA') {
            badgeClass = "bg-warning text-dark";
            borderColor = "#ffc107";
        } else if (prioridad === 'BAJA') {
            badgeClass = "bg-success";
            borderColor = "#198754";
        }

        let badgeSigla = "";
        if (task.sigla) {
            badgeSigla = `
                <span class="badge bg-theme-1-subtle text-theme-1 border border-theme-1-subtle" style="font-size: 0.7rem;">
                    ${task.sigla}
                </span>`;
        }

        html += `
        <div class="card adminuiux-card shadow-sm mb-3 border-0 overflow-hidden" 
             data-id="${task.id}"
             style="border-left: 5px solid ${borderColor} !important; border-bottom: 1px solid #eee;" id="todocolumnone-${task.id}" data-progreso="${task.estado_progreso}" data-prospecto="${task.prospecto_id}">
            <div class="card-body p-3">
                <div class="row gx-2 mb-2 align-items-start">
                    <div class="col">
                        <div class="d-flex flex-wrap gap-1 mb-1">
                            <span class="badge ${badgeClass}" style="font-size: 0.7rem;">${prioridad}</span>
                            ${badgeSigla}
                        </div>
                    </div>
                    <div class="col text-end lh-1">
                        <div class="text-dark fw-bold" style="font-size: 0.9rem;">${fechaFormateada}</div>
                        <div class="text-secondary small" style="font-size: 0.8rem;">${horaFormateada}</div>
                    </div>
                </div>

                <h6 class="card-title text-dark mb-3" style="font-size: 0.9rem; line-height: 1.3; font-weight: 600;">
                    ${task.nombre}
                </h6>

                <div class="pt-2 border-top d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-25 bg-light text-theme-1 rounded-circle d-flex align-items-center justify-content-center me-2 border" 
                             style="width: 24px; height: 24px; font-size: 0.65rem; font-weight: 700;">
                            ${(task.nombres ? task.nombres[0] : 'A')}${(task.apellidos ? task.apellidos[0] : '')}
                        </div>
                        <div class="lh-1">
                            <p class="mb-1 text-secondary" style="font-size: 0.7rem; text-transform: uppercase; font-weight: 700;">Asignado por:</p>
                            <p class="mb-0 text-dark fw-medium" style="font-size: 0.75rem;">
                                ${task.nombres || 'Admin'} ${task.apellidos || ''}
                            </p>
                        </div>
                    </div>
                    <button class="btn btn-link btn-square p-0 text-secondary btn-sm" onclick="verDetalleActividad(${task.id}, '${fechaFormateada}', '${horaFormateada}')">
                        <i class="bi bi-chat-right-dots"></i>
                    </button>
                </div>
            </div>
        </div>`;
    });

    container.innerHTML = html;
}

function verDetalleActividad(id, fecha, hora) {
    const modalElement = document.getElementById('modalDetalleTarea');
    if (!modalElement) return;

    const modalDetalle = new bootstrap.Modal(modalElement);

    fetch('getActividadRow/' + id)
        .then(res => res.json())
        .then(data => {
            const datos = data.result;

            document.getElementById('dt-id-tarea').value = id;
            document.getElementById('dt-id-prospecto').value = datos.prospecto_id;
            document.getElementById('dt-nombre-tarea').textContent = datos.tarea;
            document.getElementById('dt-nombre-asignado').textContent = datos.nombres + ' ' + datos.apellidos;
            document.getElementById('dt-fecha').textContent = fecha;
            document.getElementById('dt-hora').textContent = hora;
            document.getElementById('dt-prioridad').textContent = datos.prioridad;

            document.getElementById('dt-link-drive').value = datos.link_drive || '';

            // Inicializar estado del botón de ir al link
            const btnGo = document.getElementById('dt-link-drive-btn');
            const btnSave = document.getElementById('btn-save-link-drive');

            if (datos.link_drive && datos.link_drive.trim() !== "") {
                btnGo.href = datos.link_drive;
                btnGo.classList.remove('disabled');
            } else {
                btnGo.classList.add('disabled');
            }
            btnSave.classList.add('d-none'); // Ocultar por defecto al abrir

            document.getElementById('dt-cliente-nivel').textContent = datos.nivel_academico == null ? '--' : datos.nivel_academico;
            document.getElementById('dt-cliente-universidad').textContent = datos.institucion == null ? '--' : datos.institucion;
            document.getElementById('dt-cliente-carrera').textContent = datos.carrera == null ? '--' : datos.carrera;
            document.getElementById('dt-cliente-origen').textContent = datos.origen == null ? '--' : datos.origen;
            const detalleDiv = document.getElementById('dt-detalle');
            detalleDiv.innerHTML = datos.contenido == '' ? '--' : datos.contenido;

            const contactos = datos.contactos;
            let htmlContactos = "";
            let htmlCelular = "";

            contactos.forEach(contacto => {
                let nombre_completo = "--";
                if (contacto.nombres != "") {
                    nombre_completo = contacto.nombres + " " + contacto.apellidos;
                }

                htmlContactos += `<h6 class="mb-0 fw-bold">${nombre_completo}</h6>`;

                htmlCelular += `<h6 class="mb-0">${contacto.celular}</h6>`;

            });

            document.getElementById('dt-cliente-nombre-container').innerHTML = htmlContactos;
            document.getElementById('dt-cliente-celular-container').innerHTML = htmlCelular;

            // Aplicar zoom a las imágenes recién cargadas
            detalleDiv.querySelectorAll('img').forEach(img => {
                img.style.cursor = "zoom-in";
                img.addEventListener("click", function () {
                    const modal = document.getElementById("imageModal");
                    const modalImg = document.getElementById("modalImage");
                    if (modal && modalImg) {
                        modal.style.display = "block";
                        modalImg.src = this.src;
                    }
                });
            });

            modalDetalle.show();

        })
}

// Lógica para el input de Link del Drive
document.addEventListener('DOMContentLoaded', function () {
    const inputLink = document.getElementById('dt-link-drive');
    const btnGo = document.getElementById('dt-link-drive-btn');
    const btnSave = document.getElementById('btn-save-link-drive');

    if (inputLink) {
        inputLink.addEventListener('input', function () {
            const value = this.value.trim();

            // Gestionar botón de "Ir"
            if (value !== "") {
                btnGo.href = value;
                btnGo.classList.remove('disabled');
            } else {
                btnGo.classList.add('disabled');
            }

            // Mostrar botón de "Guardar" si hay cambios
            btnSave.classList.remove('d-none');
        });
    }

    if (btnSave) {
        btnSave.addEventListener('click', function () {
            const id = document.getElementById('dt-id-tarea').value;
            const link = inputLink.value.trim();
            const id_prospecto = document.getElementById('dt-id-prospecto').value;

            if (id) {
                guardarSoloLink(id, link, id_prospecto);
            }
        });
    }
});

function guardarSoloLink(id, link, id_prospecto) {
    const btnSave = document.getElementById('btn-save-link-drive');
    btnSave.disabled = true;
    btnSave.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';

    const formData = new FormData();
    formData.append('id_actividad', id);
    formData.append('id_prospecto', id_prospecto);
    formData.append('dt-link-drive', link);

    fetch('update-link-drive', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Enlace Guardado!',
                    text: 'El link se ha actualizado correctamente.',
                    timer: 1500,
                    showConfirmButton: false
                });
                btnSave.classList.add('d-none');
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error:', error))
        .finally(() => {
            btnSave.disabled = false;
            btnSave.innerHTML = '<i class="bi bi-check-lg"></i>';
        });
}

function updateEstadoTarea(id, estadoProgreso, prospecto_id) {
    const formData = new FormData();
    formData.append('id_actividad', id);
    formData.append('id_prospecto', prospecto_id);
    formData.append('estado_progreso', estadoProgreso);

    fetch('update-estado-tarea', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {

                const el = document.querySelector(`[data-id="${id}"]`);
                if (el) el.dataset.progreso = nuevoEstado;

                Swal.fire({
                    icon: 'success',
                    title: '¡Estado Actualizado!',
                    text: 'El estado de la tarea se ha actualizado correctamente.',
                    timer: 1500,
                    showConfirmButton: false
                });
            } else {
                console.error(data.message);
            }
        })
        .catch(error => console.error('Error:', error))
        .finally(() => {
            console.log("finally");

        });
}
