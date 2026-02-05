"use strict";

// Datos simulados de permisos por rol
const permisosXRol = {
  1: ["dashboard_ver", "dashboard_exportar", "clientes_ver", "clientes_crear", "clientes_editar", "ventas_ver", "ventas_crear", "reportes_ver", "reportes_generar", "reportes_exportar", "config_ver", "config_editar", "config_usuarios"],
  2: ["dashboard_ver", "clientes_ver", "clientes_editar", "ventas_ver", "ventas_aprobar", "reportes_ver", "reportes_generar", "config_ver"],
  3: ["dashboard_ver", "clientes_ver", "ventas_ver", "ventas_crear", "reportes_ver"],
  4: ["dashboard_ver", "clientes_ver", "reportes_ver"]
};

// Inicializar eventos cuando DOM esté listo
document.addEventListener("DOMContentLoaded", function() {
  inicializarEventosRoles();
  inicializarEventosPermisos();
  inicializarEventosRolActions();
});

function inicializarEventosRoles() {
  const rolesRadio = document.querySelectorAll(".rol-radio");
  
  rolesRadio.forEach(radio => {
    radio.addEventListener("change", function() {
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
  document.getElementById("rolIdEdit").value = rolId;
  document.getElementById("nombreRol").value = rolName;
  document.getElementById("descripcionRol").value = ""; // Cargar descripción desde BD si existe
  
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
        // TODO: Hacer llamada AJAX para eliminar rol
        Swal.fire({
          title: "¡Eliminado!",
          text: `El rol "${rolName}" ha sido eliminado correctamente.`,
          icon: "success"
        }).then(() => {
          // Recargar la página o actualizar lista de roles
        });
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
  const botonesEditar = document.querySelectorAll(".btn-editar-rol");
  const botonesEliminar = document.querySelectorAll(".btn-eliminar-rol");
  const btnAgregarRol = document.getElementById("btnAdd");

  // Botón agregar rol
  if (btnAgregarRol) {
    btnAgregarRol.addEventListener("click", function() {
      document.getElementById("modalTitle").textContent = "Agregar Rol";
      document.getElementById("rolIdEdit").value = "";
      document.getElementById("nombreRol").value = "";
      document.getElementById("descripcionRol").value = "";
      
      const modal = new bootstrap.Modal(document.getElementById("modalAgregarEditarRol"));
      modal.show();
    });
  }

  // Botones editar
  botonesEditar.forEach(btn => {
    btn.addEventListener("click", function(e) {
      e.preventDefault();
      const rolId = this.getAttribute("data-rol-id");
      editarRol(rolId);
    });
  });

  // Botones eliminar
  botonesEliminar.forEach(btn => {
    btn.addEventListener("click", function(e) {
      e.preventDefault();
      const rolId = this.getAttribute("data-rol-id");
      eliminarRol(rolId);
    });
  });

  // Botón guardar rol
  const btnGuardarRol = document.getElementById("btnGuardarRol");
  if (btnGuardarRol) {
    btnGuardarRol.addEventListener("click", function() {
      guardarRol();
    });
  }
}

// Función para guardar rol (crear o editar)
function guardarRol() {
  const nombreRol = document.getElementById("nombreRol").value.trim();
  const descripcionRol = document.getElementById("descripcionRol").value.trim();
  const rolIdEdit = document.getElementById("rolIdEdit").value;

  if (!nombreRol) {
    alert("Por favor, ingresa el nombre del rol");
    return;
  }

  const tipoOperacion = rolIdEdit ? "actualizado" : "creado";
  const mensajeExito = rolIdEdit 
    ? `El rol "${nombreRol}" ha sido actualizado correctamente.`
    : `El rol "${nombreRol}" ha sido creado correctamente.`;

  // TODO: Hacer llamada AJAX para guardar rol
  console.log("Guardando rol:", {
    id: rolIdEdit,
    nombre: nombreRol,
    descripcion: descripcionRol
  });

  if (typeof Swal !== "undefined") {
    Swal.fire({
      title: "¡Éxito!",
      text: mensajeExito,
      icon: "success"
    }).then(() => {
      // Cerrar modal
      const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarRol"));
      if (modal) modal.hide();
    });
  } else {
    alert(mensajeExito);
    const modal = bootstrap.Modal.getInstance(document.getElementById("modalAgregarEditarRol"));
    if (modal) modal.hide();
  }
}

// Función para inicializar eventos de permisos
function inicializarEventosPermisos() {
  const btnGuardar = document.getElementById("btnGuardarPermisos");

  if (btnGuardar) {
    btnGuardar.addEventListener("click", function() {
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
