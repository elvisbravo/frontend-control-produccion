"use strict";

let prospectosTable;

document.addEventListener("DOMContentLoaded", function () {
  initDataTable();
});

let editorInstance;

ClassicEditor.create(document.querySelector("#editor"))
  .then((editor) => {
    editorInstance = editor;
    editor.plugins.get("FileRepository").createUploadAdapter = (loader) => {
      return {
        upload: () => {
          return loader.file.then(
            (file) =>
              new Promise((resolve) => {
                const reader = new FileReader();
                reader.onload = () => {
                  resolve({
                    default: reader.result,
                  });
                };
                reader.readAsDataURL(file);
              }),
          );
        },
      };
    };
  })
  .catch((error) => console.error(error));

// Function to properly close a modal and clean up backdrop
function cerrarModal(modalId) {
  var modalElement = document.getElementById(modalId);
  if (modalElement) {
    var modal = bootstrap.Modal.getInstance(modalElement);
    if (modal) {
      modal.hide();

      // Escuchar cuando termina la animación de cierre
      modalElement.addEventListener(
        "hidden.bs.modal",
        function handler() {
          // Limpiar todos los backdrops que hayan quedado
          var backdrops = document.querySelectorAll(".modal-backdrop");
          backdrops.forEach(function (backdrop) {
            backdrop.remove();
          });

          // Asegurar que no hay modal-open en el body
          document.body.classList.remove("modal-open");
          document.body.style.overflow = "";
          document.body.style.paddingRight = "";

          // Remover el listener después de usarlo
          modalElement.removeEventListener("hidden.bs.modal", handler);
        },
        { once: true },
      );
    }
  }
}

// Function to initialize DataTable when jQuery is ready
function initDataTable() {
  // Check if jQuery is available
  if (typeof $ === "undefined") {
    setTimeout(initDataTable, 100);
    return;
  }

  prospectosTable = $("#prospectoTable").DataTable({
    ajax: {
      url: "prospecto/get-all",
      type: "GET",
      dataSrc: "result",
    },
    columns: [
      { data: "id" },
      { data: "fecha_contacto" },
      {
        data: null,
        render: function (data, type, row) {
          const contactos = row.personas;
          console.log(contactos);

          let contactoHtml = "";

          contactos.forEach((contact) => {
            contactoHtml += `
            <p class="mb-0">${contact.nombres} ${contact.apellidos}</p>
            <p class="text-secondary">${contact.celular}</p>
            `;
          });

          return contactoHtml;
        },
      },
      { data: "nivel_academico" },
      { data: "carrera" },
      { data: "institucion" },
      { data: "estado" },
      { data: "fecha_entrega" },
      {
        data: null,
        render: function (data, type, row) {
          return `
                        <button type="button" class="btn btn-square btn-link btn-ver-detalle" data-bs-toggle="tooltip" title="Ver Más" data-id="5">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <div class="dropdown d-inline-block">
                                    <a class="btn btn-link no-caret" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="javascript:void(0)" onclick="editarProspecto(${row.id})">Editar</a></li>
                                        <li><a class="dropdown-item btn-ficha-enfoque" href="javascript:void(0)" data-id="5">Ficha de Enfoque</a></li>
                                        <li><a class="dropdown-item btn-simular-disponibilidad" href="javascript:void(0)" data-id="5">Simular Disponibilidad</a></li>
                                        <li><a class="dropdown-item btn-convertir-cliente" href="javascript:void(0)" data-id="5">Convertir a cliente</a></li>
                                        <li><a class="dropdown-item theme-red" href="javascript:void(0)">Eliminar</a></li>
                                    </ul>
                                </div>
                    `;
        },
      },
    ],
    responsive: true,
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json",
    },
    paging: true,
    pageLength: 10,
  });

  // Initialize Modal Event Listeners
  initializeModalEvents();
  initializeDetallesEvents();
  initializeFichaEnfoqueEvents();
  initializeConvertirClienteEvents();
  initializeSimuladorDisponibilidadEvents();
  initializeContactosEvents();
  initializeGuardarEstadoEvents();

  selectRoles();
}

selectRoles();

function editarProspecto(id) {
  var modalElement = document.getElementById("modalPotencial");
  var modal = new bootstrap.Modal(modalElement);
  modal.show();

  const lgmodalLabel = document.getElementById("lgmodalLabel");
  lgmodalLabel.textContent = "Editar Potencial Cliente";

  fetch("prospecto/get-row/" + id)
    .then((res) => res.json())
    .then((data) => {
      console.log(data);
    });
}

// Function to initialize modal events
function initializeModalEvents() {
  var btnAdd = document.getElementById("btnAdd");

  if (btnAdd) {
    btnAdd.addEventListener("click", function (e) {
      e.preventDefault();
      console.log("Add button clicked, opening modal...");

      editorInstance.setData("");

      // Resetear el formulario cuando se abre el modal
      resetFormModal();

      // Use Bootstrap Modal API to show modal
      if (typeof bootstrap !== "undefined") {
        var modalElement = document.getElementById("modalPotencial");
        if (modalElement) {
          var modal = new bootstrap.Modal(modalElement);
          modal.show();
          console.log("Modal opened successfully!");

          const lgmodalLabel = document.getElementById("lgmodalLabel");
          lgmodalLabel.textContent = "Agregar Potencial Cliente";
        } else {
          console.error("Modal element not found");
        }
      } else {
        console.error("Bootstrap not loaded");
      }
    });
  } else {
    console.warn("btnAdd button not found");
  }
}

// Function to initialize contacts management
function initializeContactosEvents() {
  var btnAgregarContacto = document.getElementById("btnAgregarContacto");

  if (btnAgregarContacto) {
    btnAgregarContacto.addEventListener("click", function (e) {
      e.preventDefault();
      agregarContacto();
    });
  }
}

// Function to add a new contact
function agregarContacto() {
  var contactosAdicionalesContainer = document.getElementById(
    "contactosAdicionalesContainer",
  );
  var totalContactos = document.querySelectorAll(".contacto-block").length;
  var nuevoNumero = totalContactos + 1;

  var nuevoContacto = document.createElement("div");
  nuevoContacto.className = "contacto-block mb-4 pb-4 border-bottom";
  nuevoContacto.setAttribute("data-contacto", nuevoNumero);
  nuevoContacto.innerHTML = `
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="mb-0">
        <span class="badge bg-theme">Contacto ${nuevoNumero}</span>
      </h6>
      <button type="button" class="btn btn-sm btn-outline-danger btn-eliminar-contacto" data-contacto="${nuevoNumero}">
        <i class="bi bi-trash"></i> Eliminar
      </button>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label for="nombre_${nuevoNumero}" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre_${nuevoNumero}" name="nombres[]" placeholder="Ingrese nombre" required>
      </div>
      <div class="col-md-4">
        <label for="apellido_${nuevoNumero}" class="form-label">Apellido</label>
        <input type="text" class="form-control" id="apellido_${nuevoNumero}" name="apellidos[]" placeholder="Ingrese apellido" required>
      </div>
      <div class="col-md-4">
        <label for="celular_${nuevoNumero}" class="form-label">Celular</label>
        <input type="tel" class="form-control" id="celular_${nuevoNumero}" name="celular[]" placeholder="Ej: 51922502947" required>
      </div>
    </div>
  `;

  contactosAdicionalesContainer.appendChild(nuevoContacto);

  // Agregar evento al botón eliminar
  var btnEliminar = nuevoContacto.querySelector(".btn-eliminar-contacto");
  btnEliminar.addEventListener("click", function (e) {
    e.preventDefault();
    eliminarContacto(nuevoNumero);
  });

  // Actualizar contador
  actualizarContadorContactos();

  console.log("Contacto agregado:", nuevoNumero);
}

// Function to remove a contact
function eliminarContacto(numeroContacto) {
  var contactoElement = document.querySelector(
    `[data-contacto="${numeroContacto}"]`,
  );
  if (contactoElement) {
    contactoElement.remove();
    actualizarContadorContactos();
    console.log("Contacto eliminado:", numeroContacto);
  }
}

// Function to update counter
function actualizarContadorContactos() {
  var totalContactos = document.querySelectorAll(".contacto-block").length;
  var contadorElement = document.getElementById("contadorContactos");

  if (contadorElement) {
    var texto =
      totalContactos === 1 ? "1 contacto" : totalContactos + " contactos";
    contadorElement.textContent = texto;
  }
}

// Function to reset form modal
function resetFormModal() {
  var form = document.getElementById("formPotencialCliente");
  if (form) {
    form.reset();
  }

  // Limpiar contenedor de contactos adicionales
  var contactosAdicionalesContainer = document.getElementById(
    "contactosAdicionalesContainer",
  );
  if (contactosAdicionalesContainer) {
    contactosAdicionalesContainer.innerHTML = "";
  }

  actualizarContadorContactos();
}

// Function to initialize details events
function initializeDetallesEvents() {
  var botonesDetalle = document.querySelectorAll(".btn-ver-detalle");

  if (botonesDetalle.length > 0) {
    botonesDetalle.forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        var idCliente = this.getAttribute("data-id");
        abrirModalDetalle(idCliente);
      });
    });
  }
}

// Function to open detail modal
function abrirModalDetalle(idCliente) {
  // Datos de ejemplo - En producción estos vendrían del servidor
  var datosCliente = {
    id: idCliente,
    nivelAcademico: "POSGRADO",
    universidad: "UNSM",
    carrera: "Economía",
    fechaEntrega: "28-02-2026",
    fechaIngreso: "05-02-2026",
    estado: "Contactado",
    jefeValoracion: "Juan López - Jefe de Producción",
    contactos: [
      {
        nombre: "Elvis",
        apellido: "Bravo Sandoval",
        celular: "51922502947",
      },
      {
        nombre: "María",
        apellido: "García López",
        celular: "51987654321",
      },
    ],
  };

  // Llenar los campos del modal
  document.getElementById("detalle-nivelAcademico").textContent =
    datosCliente.nivelAcademico || "-";
  document.getElementById("detalle-universidad").textContent =
    datosCliente.universidad || "-";
  document.getElementById("detalle-carrera").textContent =
    datosCliente.carrera || "-";
  document.getElementById("detalle-fechaEntrega").textContent =
    datosCliente.fechaEntrega || "-";
  document.getElementById("detalle-fechaIngreso").textContent =
    datosCliente.fechaIngreso || "-";

  // Establecer el estado en el selector
  var estadoSelect = document.getElementById("detalleEstado");
  var estadoValue = datosCliente.estado.toUpperCase().replace(/ /g, "_");
  if (estadoSelect) {
    estadoSelect.value = estadoValue;
  }

  document.getElementById("detalle-jefeValoracion").textContent =
    datosCliente.jefeValoracion || "-";

  // Guardar el ID del cliente para usarlo al guardar cambios
  document
    .getElementById("detalleEstado")
    .setAttribute("data-cliente-id", idCliente);

  // Llenar contactos
  var contactosHtml = "";
  if (datosCliente.contactos && datosCliente.contactos.length > 0) {
    datosCliente.contactos.forEach(function (contacto, index) {
      contactosHtml += `
        <div class="card mb-2">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-md-4">
                <small class="text-secondary">Nombre</small>
                <p class="mb-0 fw-bold">${contacto.nombre}</p>
              </div>
              <div class="col-md-4">
                <small class="text-secondary">Apellido</small>
                <p class="mb-0 fw-bold">${contacto.apellido}</p>
              </div>
              <div class="col-md-4">
                <small class="text-secondary">Celular</small>
                <p class="mb-0 fw-bold">${contacto.celular}</p>
              </div>
            </div>
          </div>
        </div>
      `;
    });
  } else {
    contactosHtml = '<p class="text-secondary">Sin contactos registrados</p>';
  }
  document.getElementById("detalle-contactos").innerHTML = contactosHtml;

  // Abrir modal
  if (typeof bootstrap !== "undefined") {
    var modalElement = document.getElementById("modalDetalleCliente");
    if (modalElement) {
      var modal = new bootstrap.Modal(modalElement);
      modal.show();
      console.log("Modal de detalle abierto para cliente:", idCliente);
    }
  }
}

// Function to initialize guardar estado events
function initializeGuardarEstadoEvents() {
  var btnGuardarEstado = document.getElementById("btnGuardarEstado");

  if (btnGuardarEstado) {
    btnGuardarEstado.addEventListener("click", function (e) {
      e.preventDefault();
      guardarNuevoEstado();
    });
  }
}

// Function to save new status
function guardarNuevoEstado() {
  var selectEstado = document.getElementById("detalleEstado");
  var clienteId = selectEstado.getAttribute("data-cliente-id");
  var nuevoEstado = selectEstado.value;

  console.log(
    "Guardando nuevo estado para cliente:",
    clienteId,
    "Estado:",
    nuevoEstado,
  );

  // Mapeo de estados a valores de tabla y colores
  var estadosMap = {
    NUEVO: { texto: "Nuevo", color: "text-bg-secondary" },
    CONTACTADO: { texto: "Contactado", color: "text-bg-info" },
    INTERESADO: { texto: "Interesado", color: "text-bg-success" },
    EN_SEGUIMIENTO: { texto: "En Seguimiento", color: "text-bg-warning" },
    DESCARTADO: { texto: "Descartado", color: "text-bg-danger" },
  };

  var estadoInfo = estadosMap[nuevoEstado];

  if (estadoInfo) {
    // Actualizar la tabla
    var fila = document.querySelector("tr[data-id='" + clienteId + "']");
    if (!fila) {
      // Buscar en todas las filas
      var filas = document.querySelectorAll("tbody tr");
      filas.forEach(function (tr) {
        var botones = tr.querySelectorAll("[data-id]");
        botones.forEach(function (btn) {
          if (btn.getAttribute("data-id") === clienteId) {
            fila = tr;
          }
        });
      });
    }

    if (fila) {
      // Encontrar la celda de estado y actualizar el badge
      var celdaEstado = fila.querySelector("td:nth-child(7)");
      if (celdaEstado) {
        celdaEstado.innerHTML =
          '<span class="badge rounded-pill ' +
          estadoInfo.color +
          '">' +
          estadoInfo.texto +
          "</span>";
      }
    }

    // Mostrar confirmación
    if (typeof Swal !== "undefined") {
      Swal.fire({
        title: "¡Éxito!",
        text: "El estado ha sido actualizado a: " + estadoInfo.texto,
        icon: "success",
        confirmButtonText: "OK",
      }).then((result) => {
        if (result.isConfirmed) {
          // Cerrar el modal
          cerrarModal("modalDetalleCliente");
        }
      });
    } else {
      alert("El estado ha sido actualizado a: " + estadoInfo.texto);
      cerrarModal("modalDetalleCliente");
    }
  }
}

// Function to initialize ficha de enfoque events
function initializeFichaEnfoqueEvents() {
  var botonesFicha = document.querySelectorAll(".btn-ficha-enfoque");

  if (botonesFicha.length > 0) {
    botonesFicha.forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        var idCliente = this.getAttribute("data-id");
        abrirModalFichaEnfoque(idCliente);
      });
    });
  }

  // Event listener para el formulario de ficha de enfoque
  var formFicha = document.getElementById("formFichaEnfoque");
  if (formFicha) {
    formFicha.addEventListener("submit", function (e) {
      e.preventDefault();
      guardarFichaEnfoque();
    });
  }
}

// Function to open ficha de enfoque modal
function abrirModalFichaEnfoque(idCliente) {
  var fichaClienteId = document.getElementById("fichaClienteId");
  if (fichaClienteId) {
    fichaClienteId.value = idCliente;
  }

  // Limpiar formulario
  var formFicha = document.getElementById("formFichaEnfoque");
  if (formFicha) {
    formFicha.reset();
  }

  if (typeof bootstrap !== "undefined") {
    var modalElement = document.getElementById("modalFichaEnfoque");
    if (modalElement) {
      var modal = new bootstrap.Modal(modalElement);
      modal.show();
      console.log("Modal de ficha de enfoque abierto para cliente:", idCliente);
    }
  }
}

// Function to save ficha de enfoque
function guardarFichaEnfoque() {
  var fichaClienteId = document.getElementById("fichaClienteId").value;
  var titulotrabajo = document.getElementById("titulotrabajo").value;
  var variables = document.getElementById("variables").value;
  var objetivos = document.getElementById("objetivos").value;
  var descripcion = document.getElementById("descripcion").value;

  console.log("Ficha de enfoque guardada:", {
    clienteId: fichaClienteId,
    titulo: titulotrabajo,
    variables: variables,
    objetivos: objetivos,
    descripcion: descripcion,
  });

  // Aquí iría la llamada AJAX para guardar en el servidor
  alert("Ficha de enfoque guardada correctamente");

  // Cerrar modal
  cerrarModal("modalFichaEnfoque");
}

// Function to initialize convertir cliente events
function initializeConvertirClienteEvents() {
  var botonesConvertir = document.querySelectorAll(".btn-convertir-cliente");

  if (botonesConvertir.length > 0) {
    botonesConvertir.forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        var idCliente = this.getAttribute("data-id");
        mostrarConfirmacionConvertirCliente(idCliente);
      });
    });
  }
}

// Function to show confirmation for convertir cliente
function mostrarConfirmacionConvertirCliente(idCliente) {
  // Verificar si SweetAlert está disponible
  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "Convertir a Cliente",
      text: "¿Está seguro de que desea convertir este potencial cliente a cliente?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, convertir",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        convertirCliente(idCliente);
      }
    });
  } else {
    // Fallback si SweetAlert no está disponible
    if (
      confirm(
        "¿Está seguro de que desea convertir este potencial cliente a cliente?",
      )
    ) {
      convertirCliente(idCliente);
    }
  }
}

// Function to convert prospect to client
function convertirCliente(idCliente) {
  console.log("Convirtiendo cliente con ID:", idCliente);

  // Aquí iría la llamada AJAX para convertir el cliente
  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "¡Éxito!",
      text: "El potencial cliente ha sido convertido a cliente correctamente.",
      icon: "success",
      confirmButtonText: "OK",
    }).then((result) => {
      if (result.isConfirmed) {
        // Aquí podrías recargar la tabla o actualizar los datos
        location.reload();
      }
    });
  } else {
    alert("El potencial cliente ha sido convertido a cliente correctamente.");
    location.reload();
  }
}

/* responsive last visible table cell after cell hides*/
function lastvisibletd() {
  $(".table tbody tr td").removeClass("lastvisible");
  $(".table tbody tr").each(function () {
    var thisis = $(this);
    thisis.find("td:visible:last").addClass("lastvisible");
  });
}

// ============ SIMULADOR DE DISPONIBILIDAD PARA PROSPECTOS ============

function initializeSimuladorDisponibilidadEvents() {
  document
    .querySelectorAll(".btn-simular-disponibilidad")
    .forEach(function (btn) {
      btn.addEventListener("click", function (e) {
        e.preventDefault();
        var prospectoId = this.getAttribute("data-id");
        abrirSimuladorProspectos(prospectoId);
      });
    });
}

function abrirSimuladorProspectos(prospectoId) {
  var modal = document.getElementById("modalSimuladorProspectos");
  document.getElementById("prospectoIdSimular").value = prospectoId;

  // Mostrar modal
  if (typeof bootstrap !== "undefined") {
    var bsModal = new bootstrap.Modal(modal);
    bsModal.show();
  }

  // Cargar disponibilidad
  cargarDisponibilidadProspectos();
  cargarReporteDisponibilidadProspectos();
}

function cargarDisponibilidadProspectos() {
  var listado = document.getElementById("listadoDisponiblesProspectos");
  listado.innerHTML =
    '<div class="spinner-border spinner-border-sm" role="status"><span class="visually-hidden">Cargando...</span></div>';

  fetch("/trabajos/sugerir?cantidad=10", { credentials: "same-origin" })
    .then(function (r) {
      return r.json();
    })
    .then(function (json) {
      if (!json || !json.success) {
        listado.innerHTML =
          '<p class="text-danger">Error al cargar disponibilidad</p>';
        return;
      }

      var html = "";
      json.data.forEach(function (aux) {
        var estadoColor =
          {
            disponible: "success",
            moderado: "warning",
            ocupado: "danger",
          }[aux.estado] || "secondary";

        var barraAncho = Math.min(aux.porcentaje, 100);
        html += `
          <div class="card mb-2">
            <div class="card-body p-3">
              <div class="row align-items-center">
                <div class="col-md-1">
                  <input type="checkbox" class="form-check-input aux-checkbox" value="${aux.id}" data-aux-name="${aux.nombre} ${aux.apellidos}">
                </div>
                <div class="col-md-3">
                  <strong>${aux.nombre} ${aux.apellidos}</strong><br>
                  <small class="text-secondary">@${aux.usuario}</small><br>
                  <span class="badge bg-${estadoColor}">${aux.estado.toUpperCase()}</span>
                </div>
                <div class="col-md-8">
                  <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-${estadoColor}" role="progressbar" 
                         style="width: ${barraAncho}%" 
                         aria-valuenow="${aux.porcentaje}" aria-valuemin="0" aria-valuemax="100">
                      ${Math.round(aux.porcentaje)}% - ${aux.horas_actuales}/${aux.capacidad_maxima} horas
                    </div>
                  </div>
                  <small class="text-secondary">Trabajos activos: ${aux.trabajos_en_curso}</small>
                </div>
              </div>
            </div>
          </div>
        `;
      });

      listado.innerHTML = html;

      // Agregar eventos a checkboxes
      document.querySelectorAll(".aux-checkbox").forEach(function (checkbox) {
        checkbox.addEventListener("change", actualizarBtnAsignar);
      });

      actualizarBtnAsignar();
    })
    .catch(function (err) {
      console.error("Error:", err);
      listado.innerHTML = '<p class="text-danger">Error de red</p>';
    });
}

function cargarReporteDisponibilidadProspectos() {
  var reporte = document.getElementById("reporteCargaProspectos");
  reporte.innerHTML =
    '<small class="text-secondary">Cargando reporte...</small>';

  fetch("/trabajos/reporte", { credentials: "same-origin" })
    .then(function (r) {
      return r.json();
    })
    .then(function (json) {
      if (!json || !json.success) {
        reporte.innerHTML =
          '<p class="text-danger">Error al cargar reporte</p>';
        return;
      }

      var res = json.reporte.resumen;
      var html = `
        <div class="row text-center">
          <div class="col-md-4">
            <div class="card border-success">
              <div class="card-body">
                <h5 class="card-title text-success">${res.disponible}</h5>
                <p class="card-text small">Disponibles</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-warning">
              <div class="card-body">
                <h5 class="card-title text-warning">${res.moderado}</h5>
                <p class="card-text small">Carga Moderada</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card border-danger">
              <div class="card-body">
                <h5 class="card-title text-danger">${res.ocupado}</h5>
                <p class="card-text small">Ocupados</p>
              </div>
            </div>
          </div>
        </div>
      `;
      reporte.innerHTML = html;
    })
    .catch(function (err) {
      console.error("Error:", err);
      reporte.innerHTML = '<p class="text-danger">Error de red</p>';
    });
}
function actualizarBtnAsignar() {
  var checkboxes = document.querySelectorAll(".aux-checkbox:checked");
  var btn = document.getElementById("btnAsignarSeleccionados");

  if (checkboxes.length > 0) {
    btn.style.display = "inline-block";
  } else {
    btn.style.display = "none";
  }
}

// Event listener para botón de asignar seleccionados
document.addEventListener("DOMContentLoaded", function () {
  var btnAsignar = document.getElementById("btnAsignarSeleccionados");
  if (btnAsignar) {
    btnAsignar.addEventListener("click", function () {
      var checkboxes = document.querySelectorAll(".aux-checkbox:checked");
      var seleccionados = [];

      checkboxes.forEach(function (checkbox) {
        seleccionados.push({
          id: checkbox.value,
          nombre: checkbox.getAttribute("data-aux-name"),
        });
      });

      var prospectoId = document.getElementById("prospectoIdSimular").value;

      if (seleccionados.length === 0) {
        alert("Selecciona al menos un auxiliar");
        return;
      }

      // Mostrar confirmación
      var nombres = seleccionados
        .map(function (s) {
          return s.nombre;
        })
        .join(", ");

      if (typeof Swal !== "undefined") {
        Swal.fire({
          title: "Confirmar Asignación",
          html:
            "<p>¿Asignar este trabajo a:</p><strong>" + nombres + "</strong>?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Sí, asignar",
          cancelButtonText: "Cancelar",
        }).then(function (result) {
          if (result.isConfirmed) {
            Swal.fire(
              "Éxito",
              "Trabajo asignado a " + seleccionados.length + " auxiliar(es)",
              "success",
            ).then(function () {
              bootstrap.Modal.getInstance(
                document.getElementById("modalSimuladorProspectos"),
              ).hide();
              location.reload();
            });
          }
        });
      } else {
        if (confirm("¿Asignar este trabajo a: " + nombres + "?")) {
          alert("Trabajo asignado a " + seleccionados.length + " auxiliar(es)");
          bootstrap.Modal.getInstance(
            document.getElementById("modalSimuladorProspectos"),
          ).hide();
          location.reload();
        }
      }
    });
  }
});

const formPotencialCliente = document.getElementById("formPotencialCliente");

formPotencialCliente.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(formPotencialCliente);
  const contenido = editorInstance.getData();

  formData.append("contenido", contenido);

  fetch("prospectos/crear", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status == "success") {
        Swal.fire("¡Éxito!", data.message, "success").then(() => {
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("modalPotencial"),
          );
          if (modal) modal.hide();
          // Aquí podrías recargar la tabla o actualizar el estado local
          prospectosTable.ajax.reload(null, false); // Si usas AJAX para cargar datos, de lo contrario actualiza localmente
        });
      } else {
        Swal.fire(
          "Error",
          "Error al guardar el potencial cliente: " + data.message,
          "error",
        );
      }
    });
});

const selectRoleValoracion = document.getElementById("selectRoleValoracion");
const tareaRealizar = document.getElementById("tareaRealizar");
const personal = document.getElementById("personal");

function selectRoles() {
  fetch("permisos/lista-roles")
    .then((res) => res.json())
    .then((data) => {
      const datos = data.result;

      let html = '<option value="">-- Selecciona un rol --</option>';

      datos.forEach((rol) => {
        html += `<option value="${rol.id}">${rol.nombre}</option>`;
      });

      selectRoleValoracion.innerHTML = html;
    });
}

selectRoleValoracion.addEventListener("change", (e) => {
  const roleId = e.target.value;

  fetch(`tareas/get-by-rol/${roleId}`)
    .then((res) => res.json())
    .then((data) => {
      let html = '<option value="">-- Selecciona una tarea --</option>';
      let htmlUsers = '<option value="">-- Selecciona un usuario --</option>';

      const tareas = data.result.tareas;
      const usuarios = data.result.users;

      tareas.forEach((tarea) => {
        let prioridad = "";
        if (tarea.prioridad == 0) {
          prioridad = "C";
        } else {
          prioridad = "P";
        }
        html += `<option value="${tarea.id}">${tarea.nombre} | ${prioridad}</option>`;
      });

      usuarios.forEach((user) => {
        htmlUsers += `<option value="${user.id}">${user.nombres} ${user.apellidos}</option>`;
      });

      tareaRealizar.innerHTML = html;
      personal.innerHTML = htmlUsers;
    });
});
