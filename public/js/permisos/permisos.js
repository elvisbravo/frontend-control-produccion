"use strict";

// Datos simulados de permisos por rol
const permisosXRol = {
  1: ["dashboard_ver", "dashboard_exportar", "clientes_ver", "clientes_crear", "clientes_editar", "ventas_ver", "ventas_crear", "reportes_ver", "reportes_generar", "reportes_exportar", "config_ver", "config_editar", "config_usuarios"],
  2: ["dashboard_ver", "clientes_ver", "clientes_editar", "ventas_ver", "ventas_aprobar", "reportes_ver", "reportes_generar", "config_ver"],
  3: ["dashboard_ver", "clientes_ver", "ventas_ver", "ventas_crear", "reportes_ver"],
  4: ["dashboard_ver", "clientes_ver", "reportes_ver"]
};

// Inicializar eventos cuando DOM esté listo
document.addEventListener("DOMContentLoaded", function () {
  inicializarEventosRoles();
  inicializarEventosPermisos();
  inicializarEventosRolActions();
  loadRoles();
});

function inicializarEventosRoles() {
  const rolesRadio = document.querySelectorAll(".rol-radio");

  rolesRadio.forEach(radio => {
    radio.addEventListener("change", function () {
      const rolId = this.value;
      const rolNombre = this.getAttribute("data-rol-name");
      console.log("Rol seleccionado:", rolNombre, "ID:", rolId);

      // Cargar permisos del rol seleccionado
      cargarPermisosDelRol(rolId);
    });
  });
}

// Función para cargar permisos del rol seleccionado
function cargarPermisosDelRol(rolId) {
  const permisosDelRol = permisosXRol[rolId] || [];
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  // Desmarcar todos los checkboxes
  checkboxes.forEach(checkbox => {
    checkbox.checked = false;
  });

  // Marcar los permisos del rol seleccionado
  permisosDelRol.forEach(permiso => {
    const checkbox = document.querySelector(`input[value="${permiso}"]`);
    if (checkbox) {
      checkbox.checked = true;
    }
  });

  // Mostrar mensaje
  console.log(`Permisos cargados para el rol ${rolId}`);
}

// Función para editar rol
function editarRol(rolId) {
  const rolElement = document.querySelector(`.rol-radio[value="${rolId}"]`);
  const rolName = rolElement.getAttribute("data-rol-name");

  document.getElementById("modalTitle").textContent = "Editar Rol";
  document.getElementById("rolId").value = rolId;
  document.getElementById("nombreRol").value = rolName; // Cargar descripción desde BD si existe

  const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarRol"));
  modal.show();
}

// Función para eliminar rol
function eliminarRol(rolId) {
  const rolElement = document.querySelector(`.rol-radio[value="${rolId}"]`);
  const rolName = rolElement.getAttribute("data-rol-name");

  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "¿Eliminar rol?",
      text: `¿Estás seguro de que deseas eliminar el rol "${rolName}"?`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#dc3545",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(`/permisos/eliminar-rol/${rolId}`)
          .then(res => res.json())
          .then(data => {
            if (data.status === 'success') {
              Swal.fire({
                title: "¡Eliminado!",
                text: `El rol "${rolName}" ha sido eliminado correctamente.`,
                icon: "success"
              }).then(() => {
                loadRoles();
              });
            }

          })

      }
    });
  } else {
    if (confirm(`¿Eliminar el rol "${rolName}"?`)) {
      // TODO: Hacer llamada AJAX para eliminar rol
      alert("Rol eliminado correctamente");
    }
  }
}

// Función para inicializar eventos de acciones de rol (editar/eliminar botones)
function inicializarEventosRolActions() {
  const btnAgregarRol = document.getElementById("btnAdd");

  // Botón agregar rol
  if (btnAgregarRol) {
    btnAgregarRol.addEventListener("click", function () {
      document.getElementById("modalTitle").textContent = "Agregar Rol";
      document.getElementById("rolId").value = "0";
      document.getElementById("nombreRol").value = "";

      const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarRol"));
      modal.show();
    });
  }
}

// Función para inicializar eventos de permisos
function inicializarEventosPermisos() {
  const btnGuardar = document.getElementById("btnGuardarPermisos");

  if (btnGuardar) {
    btnGuardar.addEventListener("click", function () {
      guardarPermisos();
    });
  }
}

// Función para guardar permisos
function guardarPermisos() {
  const rolSeleccionado = document.querySelector('input[name="rolSeleccionado"]:checked');

  if (!rolSeleccionado) {
    alert("Por favor, selecciona un rol primero");
    return;
  }

  const rolId = rolSeleccionado.value;
  const rolNombre = rolSeleccionado.getAttribute("data-rol-name");

  // Obtener permisos seleccionados
  const checkboxesSeleccionados = document.querySelectorAll('input[type="checkbox"]:checked');
  const permisosSeleccionados = Array.from(checkboxesSeleccionados).map(cb => cb.value);

  console.log("Guardando permisos:", {
    rolId: rolId,
    rolNombre: rolNombre,
    permisos: permisosSeleccionados
  });

  // Mostrar confirmación
  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "¡Éxito!",
      text: `Permisos del rol "${rolNombre}" han sido actualizados correctamente.`,
      icon: "success",
      confirmButtonText: "OK"
    });
  } else {
    alert(`Permisos del rol "${rolNombre}" han sido actualizados correctamente.`);
  }

  // Aquí iría la llamada AJAX para guardar en el servidor
  // Ejemplo:
  // fetch('/api/roles/permisos', {
  //   method: 'POST',
  //   headers: { 'Content-Type': 'application/json' },
  //   body: JSON.stringify({ rolId, permisos: permisosSeleccionados })
  // })
}

const rolesList = document.getElementById("roles-list");

function loadRoles() {
  fetch('/permisos/lista-roles')
    .then(res => res.json())
    .then(data => {
      const datos = data.result;
      let html = "";

      datos.forEach(rol => {
        let opciones = "";

        if (rol.id != 1 && rol.id != 2) {
          opciones += `
        <div class="col ms-auto text-end">
          <div class="dropdown">
              <button class="btn btn-link btn-sm no-caret p-0" data-bs-toggle="dropdown">
                  <i class="bi bi-three-dots-vertical"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                  <li><a class="dropdown-item btn-editar-rol" href="javascript:void(0)" onclick="editarRol(${rol.id})" data-rol-id="${rol.id}">Editar</a></li>
                  <li><a class="dropdown-item text-danger btn-eliminar-rol" onclick="eliminarRol(${rol.id})" href="javascript:void(0)" data-rol-id="${rol.id}">Eliminar</a></li>
              </ul>
          </div>
        </div>
        `;
        }

        html += `
      <div class="role-item p-3 border-bottom">
        <div class="row align-items-center gx-0">
          <div class="col-auto">
            <div class="form-check">
              <input class="form-check-input rol-radio" type="radio" name="rolSeleccionado" id="rol_${rol.id}" value="${rol.id}" data-rol-name="${rol.nombre}">
                <label class="form-check-label" for="rol_${rol.id}">
                  ${rol.nombre}
              </label>
            </div>
          </div>
          ${opciones}                     
        </div>
      </div>
      `;
      });

      rolesList.innerHTML = html;

    })
}

const formRol = document.getElementById("formRol");

formRol.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(formRol);

  fetch('/permisos/guardar-rol', {
    method: 'POST',
    body: formData
  })
    .then(res => res.json())
    .then(data => {

      if (data.status === 'success') {
        // Cerrar modal
        const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarRol"));
        modal.hide();
        // Recargar lista de roles
        loadRoles();

        return false;
      }

      alert("Error al guardar el rol: " + data.message);
    })
    .catch(err => {
      console.error("Error al guardar rol:", err);
      Swal.fire({
        title: "Error",
        text: "Ocurrió un error al guardar el rol. Por favor, intenta nuevamente.",
        icon: "error",
        confirmButtonText: "OK"
      });
    });
})