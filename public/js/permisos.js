/**
 * Placeholder para permisos
 */
console.log("Permisos JS loaded");

function setupEventListeners() {
  // Filtros
  document.getElementById("btnRefresh").addEventListener("click", loadPermisos);
  document
    .getElementById("filterEstado")
    .addEventListener("change", loadPermisos);
  document
    .getElementById("filterTipo")
    .addEventListener("change", loadPermisos);
  document
    .getElementById("filterFecha")
    .addEventListener("change", loadPermisos);

  // Modal de revisión
  document
    .getElementById("formRevision")
    .addEventListener("submit", handleRevision);
}

/**
 * Carga lista de permisos con filtros
 */
async function loadPermisos() {
  try {
    const response = await fetch("/permisos/list", {
      method: "GET",
      credentials: "same-origin",
    });

    const permisos = await response.json();
    renderPermisos(filterPermisos(permisos));
  } catch (error) {
    console.error("Error loading permisos:", error);
    alert("Error al cargar permisos");
  }
}

/**
 * Filtra permisos según los valores seleccionados
 */
function filterPermisos(permisos) {
  const estado = document.getElementById("filterEstado").value;
  const tipo = document.getElementById("filterTipo").value;
  const fecha = document.getElementById("filterFecha").value;

  return permisos.filter((p) => {
    if (estado && p.estado !== estado) return false;
    if (tipo && p.tipo_id != tipo) return false;
    if (fecha && p.fecha_inicio !== fecha && p.fecha_fin !== fecha)
      return false;
    return true;
  });
}

/**
 * Renderiza la tabla de permisos
 */
function renderPermisos(permisos) {
  const tbody = document.getElementById("permisosBody");
  tbody.innerHTML = "";

  if (permisos.length === 0) {
    tbody.innerHTML =
      '<tr><td colspan="8" class="text-center text-muted">No hay permisos registrados</td></tr>';
    return;
  }

  const esAdmin =
    document.querySelector("[data-es-admin]")?.dataset.esAdmin === "true";

  permisos.forEach((permiso) => {
    const row = document.createElement("tr");

    const estadoBadge = getEstadoBadge(permiso.estado);
    const tcText = permiso.es_tiempo_completo ? "Completo" : "Parcial";

    let html = `
            <td>${esc(permiso.tipo_nombre)}</td>
            <td>${truncate(permiso.motivo, 30)}</td>
            <td>${formatDate(permiso.fecha_inicio)}</td>
            <td>${formatDate(permiso.fecha_fin)}</td>
            <td>${permiso.dias} (${tcText})</td>
            <td>${estadoBadge}</td>
        `;

    if (esAdmin) {
      html += `<td>${esc(permiso.usuario_nombre)} ${esc(permiso.usuario_apellidos)}</td>`;
    }

    html += `
            <td>
                <div class="btn-group btn-group-sm" role="group">
                    <button class="btn btn-outline-primary btn-detalle" data-id="${permiso.id}" title="Ver detalle">
                        <i class="bi bi-eye"></i>
                    </button>
                    ${getAccionesPermisoHTML(permiso, esAdmin)}
                </div>
            </td>
        `;

    row.innerHTML = html;
    tbody.appendChild(row);
  });

  // Event listeners para botones
  document.querySelectorAll(".btn-detalle").forEach((btn) => {
    btn.addEventListener("click", (e) =>
      showDetallePermiso(e.currentTarget.dataset.id),
    );
  });

  document.querySelectorAll(".btn-aprobar").forEach((btn) => {
    btn.addEventListener("click", (e) =>
      showRevisionModal(e.currentTarget.dataset.id, "approve"),
    );
  });

  document.querySelectorAll(".btn-rechazar").forEach((btn) => {
    btn.addEventListener("click", (e) =>
      showRevisionModal(e.currentTarget.dataset.id, "reject"),
    );
  });

  document.querySelectorAll(".btn-cancelar").forEach((btn) => {
    btn.addEventListener("click", (e) =>
      cancelarPermiso(e.currentTarget.dataset.id),
    );
  });
}

/**
 * Retorna HTML de acciones según estado y permisos
 */
function getAccionesPermisoHTML(permiso, esAdmin) {
  let html = "";

  if (esAdmin && permiso.estado === "pendiente") {
    html += `<button class="btn btn-outline-success btn-aprobar" data-id="${permiso.id}" title="Aprobar"><i class="bi bi-check"></i></button>`;
    html += `<button class="btn btn-outline-danger btn-rechazar" data-id="${permiso.id}" title="Rechazar"><i class="bi bi-x"></i></button>`;
  }

  if (!esAdmin && permiso.estado === "pendiente") {
    html += `<button class="btn btn-outline-warning btn-cancelar" data-id="${permiso.id}" title="Cancelar"><i class="bi bi-trash"></i></button>`;
  }

  return html;
}

/**
 * Muestra modal con detalles del permiso
 */
async function showDetallePermiso(id) {
  try {
    const response = await fetch(`/permisos/show/${id}`, {
      method: "GET",
      credentials: "same-origin",
    });

    if (!response.ok) throw new Error("No encontrado");

    const permiso = await response.json();
    const modal = new bootstrap.Modal(
      document.getElementById("modalDetallePermiso"),
    );

    let html = `
            <div class="row mb-3">
                <div class="col-sm-6">
                    <strong>Tipo de Permiso:</strong>
                    <p>${esc(permiso.tipo_nombre)}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Estado:</strong>
                    <p>${getEstadoBadge(permiso.estado)}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <strong>Fecha Inicio:</strong>
                    <p>${formatDate(permiso.fecha_inicio)}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Fecha Fin:</strong>
                    <p>${formatDate(permiso.fecha_fin)}</p>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <strong>Cantidad de Días:</strong>
                    <p>${permiso.dias}</p>
                </div>
                <div class="col-sm-6">
                    <strong>Tipo de Ausencia:</strong>
                    <p>${permiso.es_tiempo_completo ? "Tiempo Completo" : "Medio Tiempo"}</p>
                </div>
            </div>

            <div class="mb-3">
                <strong>Motivo:</strong>
                <p>${esc(permiso.motivo)}</p>
            </div>
        `;

    if (permiso.adjunto) {
      html += `
                <div class="mb-3">
                    <strong>Documento Adjunto:</strong><br>
                    <a href="/writable/uploads/${esc(permiso.adjunto)}" target="_blank" class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-download"></i> Descargar
                    </a>
                </div>
            `;
    }

    if (permiso.comentario_revision) {
      html += `
                <div class="alert alert-info">
                    <strong>Comentario de Revisión:</strong><br>
                    ${esc(permiso.comentario_revision)}
                </div>
            `;
    }

    html += `
            <div class="text-muted small">
                <p class="mb-1"><strong>Creado:</strong> ${formatDate(permiso.created_at)}</p>
                ${permiso.revisado_en ? `<p><strong>Revisado:</strong> ${formatDate(permiso.revisado_en)}</p>` : ""}
            </div>
        `;

    document.getElementById("detalleContent").innerHTML = html;
    modal.show();
  } catch (error) {
    console.error("Error:", error);
    alert("Error al cargar detalle");
  }
}

/**
 * Muestra modal para aprobar/rechazar
 */
function showRevisionModal(id, accion) {
  document.getElementById("permisoIdRevision").value = id;
  document.getElementById("accionRevision").value = accion;
  document.getElementById("comentarioRevision").value = "";

  const titulo = accion === "approve" ? "Aprobar Permiso" : "Rechazar Permiso";
  document.querySelector("#modalRevision .modal-title").textContent = titulo;

  const modal = new bootstrap.Modal(document.getElementById("modalRevision"));
  modal.show();
}

/**
 * Maneja envío de revisión (aprobar/rechazar)
 */
async function handleRevision(e) {
  e.preventDefault();

  const id = document.getElementById("permisoIdRevision").value;
  const accion = document.getElementById("accionRevision").value;
  const comentario = document.getElementById("comentarioRevision").value;

  const endpoint =
    accion === "approve" ? `/permisos/approve/${id}` : `/permisos/reject/${id}`;

  try {
    const response = await fetch(endpoint, {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: `comentario=${encodeURIComponent(comentario)}`,
      credentials: "same-origin",
    });

    const result = await response.json();

    if (result.success) {
      alert(result.message);
      bootstrap.Modal.getInstance(
        document.getElementById("modalRevision"),
      ).hide();
      loadPermisos();
    } else {
      alert("Error: " + result.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("Error en la conexión");
  }
}

/**
 * Cancela un permiso
 */
async function cancelarPermiso(id) {
  if (!confirm("¿Estás seguro que deseas cancelar este permiso?")) return;

  try {
    const response = await fetch(`/permisos/cancel/${id}`, {
      method: "POST",
      credentials: "same-origin",
    });

    const result = await response.json();

    if (result.success) {
      alert(result.message);
      loadPermisos();
    } else {
      alert("Error: " + result.message);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("Error en la conexión");
  }
}

/**
 * Utilidades
 */
function getEstadoBadge(estado) {
  const badges = {
    pendiente: '<span class="badge bg-warning">Pendiente</span>',
    aprobado: '<span class="badge bg-success">Aprobado</span>',
    rechazado: '<span class="badge bg-danger">Rechazado</span>',
    cancelado: '<span class="badge bg-secondary">Cancelado</span>',
  };
  return badges[estado] || estado;
}

function formatDate(dateString) {
  if (!dateString) return "-";
  const date = new Date(dateString);
  return date.toLocaleDateString("es-ES", {
    year: "numeric",
    month: "long",
    day: "numeric",
  });
}

function truncate(text, length = 50) {
  if (!text) return "";
  return text.length > length ? text.substring(0, length) + "..." : text;
}

function esc(text) {
  if (!text) return "";
  const div = document.createElement("div");
  div.textContent = text;
  return div.innerHTML;
}
