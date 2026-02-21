document.addEventListener('DOMContentLoaded', function () {
    // Buscador de trabajadores en el dropdown
    const workerSearch = document.querySelector('.worker-search');
    if (workerSearch) {
        workerSearch.addEventListener('keyup', function () {
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
        item.addEventListener('click', function (e) {
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

        fetch("actividades")
            .then(res => res.json())
            .then(data => {
                const actividades = data.result;
                let html = '';

                if (!actividades || actividades.length === 0) {
                    html = `
                            <div class="text-center py-5">
                                <i class="bi bi-clipboard-x h2 text-secondary opacity-50 d-block mb-3"></i>
                                <p class="text-secondary">No hay Actividades pendientes en este momento.</p>
                            </div>`;
                } else {
                    actividades.forEach(actividad => {
                        // Formatear la fecha y hora de creado
                        const fechaObj = new Date(actividad.created_at);
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
                        let badgeClass = "bg-secondary";
                        let bgClass = "bg-light";

                        const prioridadLabel = (actividad.prioridad || 'Media').toUpperCase();
                        if (prioridadLabel === 'ALTA') {
                            badgeClass = "bg-danger";
                        } else if (prioridadLabel === 'MEDIA') {
                            badgeClass = "bg-warning text-dark";
                        } else if (prioridadLabel === 'BAJA') {
                            badgeClass = "bg-success";
                        }

                        let sBadgeClass = '';
                        let sBadgeStyle = '';
                        let sLabel = '';

                        if (actividad.seguimiento == 'Pendiente') {
                            sBadgeClass = 'bg-secondary';
                            sBadgeStyle = '';
                            sLabel = 'Pendiente';
                        } else if (actividad.seguimiento == 'En proceso') {
                            sBadgeClass = 'bg-warning text-dark';
                            sBadgeStyle = '';
                            sLabel = 'En Proceso';
                        } else if (actividad.seguimiento == 'Pausado') {
                            sBadgeClass = '';
                            sBadgeStyle = 'style="background-color: #fd7e14; color: white;"';
                            sLabel = 'Pausado';
                        } else if (actividad.seguimiento == 'Finalizado') {
                            sBadgeClass = 'bg-success';
                            sBadgeStyle = '';
                            sLabel = 'Finalizado';
                        }

                        html += `
                                <a href="javascript:void(0)" class="list-group-item list-group-item-action border-0 rounded-3 mb-2 ${bgClass} p-3 btn-ver-detalle-tarea" data-id="${actividad.id}" data-fecha="${fechaFormateada}" data-hora="${horaFormateada}" data-nombre="${actividad.nombre}" data-prioridad="${actividad.prioridad}" data-prospecto-id="${actividad.prospecto_id}">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar avatar-40 bg-info text-white rounded-circle">
                                                <i class="bi ${iconClass}"></i>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h6 class="mb-0">${actividad.nombre}</h6>
                                            <p class="text-secondary small mb-0">ID: #${actividad.id} | <span class="badge rounded-pill ${sBadgeClass}" ${sBadgeStyle}>${sLabel}</span></p>
                                            <p class="text-secondary small mb-0">${actividad.nombres} ${actividad.apellidos}</p>
                                        </div>
                                        <div class="col-auto text-end">
                                            <div class="text-dark small fw-bold mb-1"><i class="bi bi-calendar-event me-1"></i>${fechaFormateada}</div>
                                            <div class="text-secondary small mb-2"><i class="bi bi-clock me-1"></i>${horaFormateada}</div>
                                            <span class="badge ${badgeClass}">${actividad.prioridad}</span>
                                        </div>
                                        </div>
                                        </a>`;
                    });
                }

                container.innerHTML = html;
                asignarEventosDetalle();
            })
            .catch(err => {
                console.error("Error cargando actividades:", err);
                container.innerHTML = `<div class="alert alert-danger mx-3">Error al cargar las actividades pendientes.</div>`;
            });
    }

    function asignarEventosDetalle() {
        const btns = document.querySelectorAll('.btn-ver-detalle-tarea');
        const modalElement = document.getElementById('modalDetalleTarea');
        if (!modalElement) return;

        const modalDetalle = new bootstrap.Modal(modalElement);

        btns.forEach(btn => {
            btn.addEventListener('click', function () {
                fetch('getActividadRow/' + this.getAttribute('data-id'))
                    .then(res => res.json())
                    .then(data => {
                        const datos = data.result;

                        document.getElementById('dt-id-tarea').value = this.getAttribute('data-id');
                        document.getElementById('dt-id-prospecto').value = this.getAttribute('data-prospecto-id');
                        document.getElementById('dt-nombre-tarea').textContent = this.getAttribute('data-nombre');
                        document.getElementById('dt-nombre-asignado').textContent = datos.nombres + ' ' + datos.apellidos;
                        document.getElementById('dt-fecha').textContent = this.getAttribute('data-fecha');
                        document.getElementById('dt-hora').textContent = this.getAttribute('data-hora');
                        document.getElementById('dt-prioridad').textContent = this.getAttribute('data-prioridad');

                        document.getElementById('dt-link-drive').value = datos.link_drive;
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
            });
        });

        // Evento para "Empezar" tarea
        const btnActualizar = document.getElementById('btnActualizarTarea');
        const formEmpezarTarea = document.getElementById('formEmpezarTarea');
        if (formEmpezarTarea) {
            formEmpezarTarea.onsubmit = function (e) {
                e.preventDefault();

                const id = document.getElementById('dt-id-tarea').value;
                const nombreTarea = document.getElementById('dt-nombre-tarea').textContent;

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: `Vas a empezar a trabajar en: "${nombreTarea}"`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#198754',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, empezar ahora',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            ejecutarInicioTarea(id);
                        }
                    });
                } else {
                    if (confirm(`¿Deseas empezar la tarea: ${nombreTarea}?`)) {
                        ejecutarInicioTarea(id);
                    }
                }
            };
        }

        function ejecutarInicioTarea(id) {
            // Bloquear botón
            btnActualizar.disabled = true;
            btnActualizar.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Iniciando...';

            console.log("Iniciando actividad:", id);

            // Aquí podrías hacer tu fetch real al backend para cambiar el estado de la tarea

            const formData = new FormData(formEmpezarTarea);

            fetch("update-proceso-actividad", {
                method: "POST",
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status == 'success') {
                        btnActualizar.disabled = false;
                        btnActualizar.innerHTML = 'Empezar';
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: '¡Actividad Iniciada!',
                                text: 'Has empezado a trabajar en esta actividad.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        } else {
                            alert('Actividad iniciada correctamente');
                        }
                        modalDetalle.hide();
                        cargarTareasPendientes();
                    }
                })

        }

        // Actualizar el enlace del botón de drive cuando se escribe en el input
        document.getElementById('dt-link-drive').addEventListener('input', function () {
            const btnDrive = document.getElementById('dt-link-drive-btn');
            if (this.value) {
                btnDrive.href = this.value;
                btnDrive.classList.remove('disabled');
            } else {
                btnDrive.classList.add('disabled');
            }
        });
    }

    // Cerrar modal de imagen
    const closeBtn = document.querySelector(".close");
    if (closeBtn) {
        closeBtn.onclick = function () {
            const modal = document.getElementById("imageModal");
            if (modal) modal.style.display = "none";
        }
    }

    // También cerrar si se hace clic fuera de la imagen
    const modalImgContainer = document.getElementById("imageModal");
    if (modalImgContainer) {
        modalImgContainer.onclick = function (e) {
            if (e.target === modalImgContainer) {
                modalImgContainer.style.display = "none";
            }
        }
    }

    // Cargar tareas al iniciar
    cargarTareasPendientes();
});